<?php
 
require_once('modules/AOW_Actions/actions/actionBase.php');
require_once('custom/VIWebhookIntegration/VIWebHookIntegrationFunction.php');
class actionWebHookIntegration extends actionBase{
    public function loadJS(){
        $randomNumer = rand();
        return array('custom/modules/AOW_Actions/actions/actionWebHookIntegration.js?v='.$randomNumer);
    }
 
    public function run_action(SugarBean $bean,$params = array(),$in_save = false){
        //This is called when the Action is triggerred. It should return Boolean.

        //Get WorkFlow Id
        $tablename = 'aow_actions';
        $aowActionsFieldNames = array('aow_workflow_id');
        $aowActionsWhere = array('id'=>$this->id);

        $selectWorkFlowId = getWebHookIntegrationData($tablename,$aowActionsFieldNames,$aowActionsWhere);
        $selectWorkFlowIdResult = $GLOBALS['db']->fetchOne($selectWorkFlowId);
        $workflow_id = $selectWorkFlowIdResult['aow_workflow_id'];
        
        //Get WorkFlow Name
        $workflowTableName = 'aow_workflow';
        $aowWorkflowFieldNames = array('name');
        $aowWorkflowWhere = array('id'=>$workflow_id);

        $selectWorkflowName = getWebHookIntegrationData($workflowTableName,$aowWorkflowFieldNames,$aowWorkflowWhere);
        $workflowResultData = $GLOBALS['db']->fetchOne($selectWorkflowName);

        //Get WeHook Integration Config data
        $webhookIntegrationConfig = getWebHookIntegrationConfig();
        if(!empty($webhookIntegrationConfig) && $webhookIntegrationConfig['enable'] == 1){
            $moduleName = $bean->module_dir;
            $method = $params['action_method'];
            $endPointUrl = $params['action_url'];
            $url = trim($endPointUrl);

            //Get Authentication Data
            $data = array();
            if(isset($params['action_authentication'])){
                foreach ($params['action_authentication']['auth_field_name'] as $key => $value) {
                    $authFirstFieldValue = $params['action_authentication']['auth_field_name'][$key];
                    $authSecondFieldValue = $params['action_authentication']['auth_field_value'][$key];
                    $data['auth_parameter'][$authFirstFieldValue] = $authSecondFieldValue;
                }
            }//End of if


            //Get Parameters Data
            foreach ($params['action_parameters']['parameter_field_name'] as $key => $value){
                $fieldValue = $params['action_parameters']['parameter_field_value'][$key];
                if($fieldValue == 'plain_text'){
                    $actionParameterFields = $params['action_parameters']['plain_text'][$key];
                }else if($fieldValue == 'personalized_msg'){
                    $personalizedMsgText = $params['action_parameters']['personalized_msg_text'][$key];
                    $actionParameterFields = $personalizedMsgText;
                    preg_match_all('/(\$\w+)/',$personalizedMsgText,$matches);

                    foreach($matches as $mk => $matchValue){  
                        foreach($matchValue as $k => $val){
                            $trimValue = ltrim($val,"$");
                            
                            $fieldValue = $bean->$trimValue;
                            if ($fieldValue != '') {
                                $actionParameterFields = str_replace($val,$fieldValue,$actionParameterFields);  
                            }else{
                                $actionParameterFields = str_replace($val,$val,$actionParameterFields);
                            }//end of else
                        }//end of foreach
                    }//end of foreach
                    $actionParameterFields = strip_tags(html_entity_decode($actionParameterFields));
                }else{
                    $fieldDefinations = $bean->getFieldDefinition($value);
                    if($fieldDefinations['type'] == 'relate'){
                        if(isset($fieldDefinations['id_name'])){
                            $relateFieldIdName = $fieldDefinations['id_name'];
                            $relateFieldIdValue = $bean->$relateFieldIdName;
                            $relateFieldValue = $bean->$value;
                            $actionParameterFields = array('0'=>$relateFieldIdValue,'1'=>$relateFieldValue);
                        }//end of if   
                    }else{
                        $actionParameterFields = $bean->$fieldValue;
                    }//end of else    
                }//end of else
                $data['field_parameter'][$params['action_parameters']['parameter_field_name'][$key]] = $actionParameterFields;    
            }//end of foreach
            
            if($method == "PUT"){
                $webhookIntegrationLogTableName = 'vi_webhook_integration_log';
                $webhookIntegrationLogFieldNames = array('response_record_id_c');
                $webhookIntegrationLogWhere = array('module_name_c'=>$moduleName,'module_record_id_c'=>$bean->id,'status_c'=>'Success','deleted'=>0);
            
                //Get WorkFlow Id
                $selWebHookIntegrationLogData = getWebHookIntegrationData($webhookIntegrationLogTableName,$webhookIntegrationLogFieldNames,$webhookIntegrationLogWhere);
                $resultData = $GLOBALS['db']->fetchOne($selWebHookIntegrationLogData);
                $responseId = $resultData['response_record_id_c'];
                if($responseId){
                    $data['field_parameter']['responseId'] = $responseId;    
                }
            }//end of if

            $validString = 1;
            //Set header and convert data in selected content type
            if($params['action_content'] == 'JSON'){
                $header = array(
                    'Content-Type:application/json'
                );
                $data = json_encode($data);
                $validString = webHookJSONDataValidator($data);
            }elseif($params['action_content'] == 'XML'){
                $header = array(
                    'Content-Type:application/xml'
                );
                $data = convertArrayToXML($data);
                $validString = webHookXMLDataValidator($data);
            }elseif($params['action_content'] == 'FORM'){
                $header = array(
                   "Content-Type: application/x-www-form-urlencoded"
                );
                $data = http_build_query($data);
                $validString = 1;
            }//end of else
            
            if($validString != 1){
                $responseStatus = translate('LBL_WEBHOOK_INTEGRATION_RESPONSE_FAILED','AOW_Actions');

                $description = '';
                if($params['action_content'] == 'JSON'){
                    $description = translate('LBL_JSON_STRING_INVALID','AOW_Actions');
                }else if($params['action_content'] == 'XML'){
                    $description = translate('LBL_XML_STRING_INVALID','AOW_Actions');
                }//end of else if

                addWebHookIntegrationLog($bean,$responseStatus,$workflowResultData['name'],$workflow_id,$params,'',$method,$description);
            }else{
                $curl_request = curl_init();
                curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER,false);
                curl_setopt($curl_request, CURLOPT_URL,$url);
                curl_setopt($curl_request, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($curl_request, CURLOPT_TIMEOUT,0);
                curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST,$method);
                curl_setopt($curl_request, CURLOPT_POSTFIELDS,$data);
                curl_setopt($curl_request, CURLOPT_HTTPHEADER,$header);
            
                // Executing curl
                $response = curl_exec($curl_request);
                $response = json_decode($response); 


                if($response->code == '1'){
                    $responseStatus = translate('LBL_WEBHOOK_INTEGRATION_RESPONSE_SUCCESS','AOW_Actions');
                }else{
                    $responseStatus = translate('LBL_WEBHOOK_INTEGRATION_RESPONSE_FAILED','AOW_Actions');
                }//end of else

                addWebHookIntegrationLog($bean,$responseStatus,$workflowResultData['name'],$workflow_id,$params,$response->responseRecordId,$method,'');

                curl_close($curl_request);
            }//end of else
            return true;
        }//end of if
    }//end of function

    public function edit_display($line, SugarBean $bean = null, $params = array()){
        //Get Module
        $modulename = $bean->module_dir;

        //css
        $html = "<link rel='stylesheet' type='text/css' href='custom/modules/AOW_Actions/actions/actionWebHookIntegration.css' />";
       
        //Action title
        $html .= "<div class='webHookContainer'>";
        $html .= "<fieldset><legend>".translate('LBL_ACTIONS','AOW_Actions')."</legend>";
        $html .= "<div class='webHookParametersContainer'>";
        $html .= "<table class='tbl_action_title'>";
        $html.= "</fieldset>";
        $html .= "</table>";
         if(isset($params['action_title'])){
            $html .= "<input type='text' name='aow_actions_param[".$line."][action_title]' id='action_title' value='".$params['action_title']."'>";
        }else{
            $html .= "<input type='text' name='aow_actions_param[".$line."][action_title]' id='action_title'  value=''>";
        }
        $html .= "</div>";

        //Description
        $html .= "<fieldset><legend>".translate('LBL_DESCRIPTION','AOW_Actions')."</legend>";
        $html .= "<div class='webHookParametersContainer'>";
        $html .= "<table class='tbl_action_desc'>";
        $html.= "</fieldset>";
        $html .= "</table>";
        
        if(isset($params['action_description'])){
            $html .= "<textarea rows='2' cols='50'  name='aow_actions_param[".$line."][action_description]' id='action_description'>".$params['action_description']."</textarea>";
        }else{
            $html .= "<textarea rows='2' cols='50'  name='aow_actions_param[".$line."][action_description]' id='action_description'></textarea>";
        }
        $html .= "</div>";

        //URL To Notify
        $urlNotifyLabel = '"'.translate('LBL_URL_NOTIFY_INFO','AOW_Actions').'"';
        $html .= "<fieldset><legend>".translate('LBL_URL_NOTIFY','AOW_Actions')."<img id='info_img_select_module' src='themes/default/images/helpInline.gif'  class='image' alt='Info Inline' height='15' width='15' onclick='return SUGAR.util.showHelpTips(this,$urlNotifyLabel);' style='cursor: auto;'></legend>";
        $html .= "<div class='webHookParametersContainer'>";
        $html .= "<table class='tbl_action_method'>";
        $html .= "<tr rowspan = '4'>";
        $html .= "<td><select option='select' name='aow_actions_param[".$line."][action_method]'>";
        if(isset($params['action_method']) && $params['action_method'] == "POST"){
            $html .= "<option selected='selected'>".translate('LBL_POST','AOW_Actions')."</option>";
        }else{
            $html .= "<option>".translate('LBL_POST','AOW_Actions')."</option>";
        }
        if(isset($params['action_method']) && $params['action_method'] == "PUT"){
            $html .= "<option selected='selected'>".translate('LBL_PUT','AOW_Actions')."</option></select></td>";
        }else{
            $html .= "<option>".translate('LBL_PUT','AOW_Actions')."</option></select></td>";
        }
        if(isset($params['action_url'])){
            $html .= "<td><input type='text' name='aow_actions_param[".$line."][action_url]' value='".$params['action_url']."' id='action_url' style='width:500px;'></td></tr></fieldset>";
        }else{
            $html .= "<td><input type='text' name='aow_actions_param[".$line."][action_url]' value='' id='action_url' style='width:500px;'></td></tr></fieldset>";
        }
        $html .= "</table>";
        $html .= "</div>";

        //Content Type
        $contentTypeLabel = '"'.translate('LBL_CONTENT_TYPE_INFO','AOW_Actions').'"';
        $html .= "<fieldset><legend>".translate('LBL_CONTENT_TYPE','AOW_Actions')."<img id='info_img_select_module' src='themes/default/images/helpInline.gif'  class='image' alt='Info Inline' height='15' width='15' onclick='return SUGAR.util.showHelpTips(this,$contentTypeLabel);' style='cursor: auto;'></legend>";
        $html .= "<div class='webHookParametersContainer'>";
        $html .= "<table class='tbl_action_content'>";
        $html .= "</fieldset>";
        $html .= "</table>";
        $html .= "<select option='select' name='aow_actions_param[".$line."][action_content]' value='".$params['action_content']."'>";
        if(isset($params['action_content']) && $params['action_content'] == "FORM"){
            $html .= "<option selected='selected'>".translate('LBL_FORM','AOW_Actions')."</option>";
        }else{
            $html .= "<option>".translate('LBL_FORM','AOW_Actions')."</option>";
        }
        if(isset($params['action_content']) && $params['action_content'] == "XML"){
            $html .= "<option selected='selected'>".translate('LBL_XML','AOW_Actions')."</option>";
        }else{
            $html .= "<option>".translate('LBL_XML','AOW_Actions')."</option>";
        }
        if(isset($params['action_content']) && $params['action_content'] == "JSON"){
            $html .= "<option selected='selected'>".translate('LBL_JSON','AOW_Actions')."</option></select>";
        }else{
            $html .= "<option>".translate('LBL_JSON','AOW_Actions')."</option></select>";
        }
        $html .= "</div>";

        //Authorization Type
        $authorizationTypeLabel = '"'.translate('LBL_AUTHENTICATION_TYPE_INFO','AOW_Actions').'"';
        $html .= "<fieldset><legend>".translate('LBL_AUTHORIZATION_TYPE','AOW_Actions')."<img id='info_img_select_module' src='themes/default/images/helpInline.gif'  class='image' alt='Info Inline' height='15' width='15' onclick='return SUGAR.util.showHelpTips(this,$authorizationTypeLabel);' style='cursor: auto;'></legend>";
        $html .= "<div class='webHookParametersContainer'>";
        $html .= "<table class='tbl_authorization_type".$line."'>";
        $html .= "<tr rowspan = '4'><td>";
        if(isset($params['action_type']) && $params['action_type'] == "Basic Authentication"){
            $html .= "<input type='radio' name='aow_actions_param[".$line."][action_type]' class='authentication' value='Basic Authentication'  onclick='checkAuthenticationType(this,$line)' checked>".translate('LBL_BASIC_AUTHENTICATION','AOW_Actions');
        }else{
            $html .= "<input type='radio' name='aow_actions_param[".$line."][action_type]' class='authentication' value='Basic Authentication' onclick='checkAuthenticationType(this,$line)'>".translate('LBL_BASIC_AUTHENTICATION','AOW_Actions');
        }
        $html .= "</td><td>";
        if(isset($params['action_type']) && $params['action_type'] == "No Authentication"){
            $html .= "<input type='radio' name='aow_actions_param[".$line."][action_type]' class='authentication' value='No Authentication'  id='no_authentication' onclick='checkAuthenticationType(this,$line)' checked>".translate('LBL_NO_AUTHENTICATION','AOW_Actions');
        }else{
            $html .= "<input type='radio' name='aow_actions_param[".$line."][action_type]' class='authentication' value='No Authentication' id='no_authentication' onclick='checkAuthenticationType(this,$line)'>".translate('LBL_NO_AUTHENTICATION','AOW_Actions');
        } 
        $html .= "</td></tr>";
       
        if(isset($params['action_authentication'])){
            $count = count($params['action_authentication']['auth_field_name']);
            $html .= "<input type='hidden' name='authenticationRow' id='authenticationRowValue".$line."' value='$count'>";
        }else{
            $html .= "<input type='hidden' name='authenticationRow' id='authenticationRowValue".$line."' value='0'>";
        }
        if(isset($params['action_authentication'])){
            $i = 1;
            foreach($params['action_authentication']['auth_field_name'] as $key=>$value){
                $authFieldLabel = $params['action_authentication']['auth_field_name'][$i];
                $authFieldValue = $params['action_authentication']['auth_field_value'][$i];

                $authFieldLabelName = "aow_actions_param[".$line."][action_authentication][auth_field_name][".$i."]";
                $authFieldValueName = "aow_actions_param[".$line."][action_authentication][auth_field_value][".$i."]";
                
                if(isset($params['action_type']) && $params['action_type'] == "Basic Authentication"){
                    $html .= "<tr id='authenticationRow".$i."'><td width='159'></td><td><button type='button' class='button btn_minus' onclick='removeAuthentication(this,$line)' name='remove' >-</button><input type='text' name='".$authFieldLabelName."' value='".$authFieldLabel."' style='width: auto;'><input type='text' name='".$authFieldValueName."' value='".$authFieldValue."' id='authFieldValue'></td>";
                }else{
                    $html .= "<tr id='authenticationRow".$i."' style='display:none;'><td width='159'></td><td><button type='button'  class='button btn_minus' onclick='removeAuthentication(this,$line)' name='remove'>-</button><input type='text' name='".$authFieldLabelName."' value='".$authFieldLabel."' style='width: auto;'><input type='text' name='".$authFieldValueName."' value='".$authFieldValue."' id='authFieldValue'></td>";
                }
                $html .= "</tr>";
                $i++;
            }
        }
        $html .= "</fieldset>";
        $html .= "</tr>";
        $html .= "</table>";
        if(isset($params['action_type']) && $params['action_type'] == "Basic Authentication"){
            $html .= "<button type='button' class='button btn_add_authentication' name='btn_add_authentication'  onclick = 'addAuthentication($line)' style='margin-left: 195px;'>".translate('LBL_ADD_AUTHORIZATION','AOW_Actions')."</button>";
            $html .= "<button type='button' class='button btn_test_authentication' name='btn_test_authentication' style='margin-left: 13px;' onclick='testAuthentication($line)'>Test Authentication</button>";
        }else{
            $html .= "<button type='button' class='button btn_add_authentication' name='btn_add_authentication'  onclick = 'addAuthentication($line)' style ='display:none;margin-left: 195px;'>".translate('LBL_ADD_AUTHORIZATION','AOW_Actions')."</button>";
            $html .= "<button type='button' class='button btn_test_authentication' name='btn_test_authentication'  style ='display:none;margin-left: 13px;' onclick='testAuthentication($line)'>Test Authentication</button>";
        }
        $html .= "</div>";

        //Actions Parameters
        $parameterTypeLabel = '"'.translate('LBL_PARAMETER_TYPE_INFO','AOW_Actions').'"';
        $html .= "<fieldset><legend>".translate('LBL_PARAMETERS','AOW_Actions')."<img id='info_img_select_module' src='themes/default/images/helpInline.gif'  class='image' alt='Info Inline' height='15' width='15' onclick='return SUGAR.util.showHelpTips(this,$parameterTypeLabel);' style='cursor: auto;'></legend>";
        $html .= "<div class='webHookParametersContainer'>";
        $html .= "<table class='tbl_action_parameters".$line."'>";
        if(isset($params['action_parameters'])){
            $count = count($params['action_parameters']['parameter_field_name']);
            $html .= "<input type='hidden' name='parameterRow' id='parameterRowValue".$line."' value='$count'>";
        }else{
            $html .= "<input type='hidden' name='parameterRow' id='parameterRowValue".$line."' value='0'>";
        }
       
        $parameterValueInfoLable = '"'.translate('LBL_PARAMETER_VALUE_INFO','AOW_Actions').'"';

        if(isset($params['action_parameters'])){
            $html .= "<tr rowspan='4' id='parameter_header'><td width='159'></td><td></td><td id='paramtersRow'><p><b>".translate('LBL_PARAMETER_NAME','AOW_Actions')."</b></p></td><td id='parametersValue' style='width:60%;'><p><b>".translate('LBL_PARAMETER_VALUE','AOW_Actions')."</b><img src='themes/default/images/helpInline.gif'  class='image' alt='Info Inline' height='15' width='15' onclick='return SUGAR.util.showHelpTips(this,$parameterValueInfoLable);'></p></td></tr>";
            $i = 1;

            foreach($params['action_parameters']['parameter_field_name'] as $key=>$value){
                $parameterFieldLabel = $params['action_parameters']['parameter_field_name'][$i];
                $parameterFieldValue = $params['action_parameters']['parameter_field_value'][$i];
                
                $parameterFieldLabelName = "aow_actions_param[".$line."][action_parameters][parameter_field_name][".$i."]";
                $parameterFieldValueName = "aow_actions_param[".$line."][action_parameters][parameter_field_value][".$i."]";

                $parameterFieldValueId = "aow_actions_param_parameter_field_value_".$line."_".$i;

                $plainTextName = 'aow_actions_param['.$line.'][action_parameters][plain_text]['.$i.']';
                $plainTextId = 'aow_actions_param_plain_text_'.$line.'_'.$i;

                $parameterFieldsId = 'aow_actions_param_parameter_fields_'.$line.'_'.$i;                

                $personalizedMsgTextId = 'aow_actions_param_personalized_msg_text_'.$line.'_'.$i;
                $personalizedMsgTextName = 'aow_actions_param['.$line.'][action_parameters][personalized_msg_text]['.$i.']';

                //Get fields 
                $moduleFields = getModuleFieldsDropdown($modulename,$parameterFieldValue,1);
                $parameterRowId = "button_parameter".$line;
                $html .= "<tr id ='parameterRow".$i."'><td width='159'></td><td><button type='button'  class='button btn_parameter_minus' onclick='removeParameter(this,$line,$i)' name='remove'>-</button><br></td><td><input type='text' name='".$parameterFieldLabelName."' value='".$parameterFieldLabel."' class='parameter_field_name' style='width: auto;'>";      
                $html .= "</td>";
                $html .= "<td><select name='".$parameterFieldValueName."' id='".$parameterFieldValueId."' value='' onchange='changeParameterValue(".$line.",".$i.");' class='parameter_field_value'>".$moduleFields."</select>";  

                if(isset($params['action_parameters']['plain_text'][$i]) && !empty($params['action_parameters']['plain_text'][$i])){
                    $plainTextVal = $params['action_parameters']['plain_text'][$i];
                    $html .= '<input type="text" name="'.$plainTextName.'" id="'.$plainTextId.'" style="width:265px;" value="'.$plainTextVal.'" class="plain_text">';
                }else{
                    $html .= '<input type="text" name="'.$plainTextName.'" id="'.$plainTextId.'" style="display:none;width:265px;" class="plain_text">';
                }//end of else 
                
                $parameterFields = getModuleFieldsDropdown($modulename,'',0);

                if(isset($params['action_parameters']['personalized_msg_text'][$i]) && !empty($params['action_parameters']['personalized_msg_text'][$i])){
                    $html .= '<select name="parameter_fields" id="'.$parameterFieldsId.'" style="width:275px;" onchange="addParameterFields('.$line.','.$i.')">'.$parameterFields.'</select>';
                }else{
                    $html .= '<select name="parameter_fields" id="'.$parameterFieldsId.'" style="display:none;width:275px;" onchange="addParameterFields('.$line.','.$i.')">'.$parameterFields.'</select>';
                }//end of else

                $html .= "</td>";    
                $html .= "</tr>";

                $html .= "<tr id='personalized_msg_row_".$line."_".$i."'>";

                if(isset($params['action_parameters']['personalized_msg_text'][$i]) && !empty($params['action_parameters']['personalized_msg_text'][$i])){
                    $personalizedMsgTextVal = $params['action_parameters']['personalized_msg_text'][$i];
                    $html .= "<td width='137'></td><td style='width:48%;'></td><td></td><td></td><td style='width:37%;'><textarea name='".$personalizedMsgTextName."' id='".$personalizedMsgTextId."' rows='3' cols='60'>".$personalizedMsgTextVal."</textarea></td></tr>";
                }else{
                    $html .= "<td width='137'></td><td style='width:48%;'></td><td></td><td></td><td style='width:37%;'><textarea name='".$personalizedMsgTextName."' id='".$personalizedMsgTextId."' rows='3' cols='60' style='display:none;'></textarea></td></tr>";
                }//end of else

                $i++;
            }
        }
        $html .= "</td>";
        $html .= "</fieldset>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "<button type='button' class='button parameterField' name='btn_field' onclick = 'addFieldMapping($line)'>".translate('LBL_ADD_FIELDS','AOW_Actions')."</button>";
        $html .= "</div>";

        $html .= "</div>";
        return $html;
    }//end of function
}
?>
