<?php
/*********************************************************************************
 * This file is part of package WebHook Integration.
 * 
 * Author : Variance InfoTech PVT LTD (http://www.varianceinfotech.com)
 * All rights (c) 2020 by Variance InfoTech PVT LTD
 *
 * This Version of WebHook Integration is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of Variance InfoTech PVT LTD
 * 
 * You can contact via email at info@varianceinfotech.com
 * 
 ********************************************************************************/
    //Convert array to XML 
    function convertArrayToXML($data, $wrap='root',$upper=true){
        $xmlArray = '';
        if ($wrap != null) {
            $xmlArray .= "<$wrap>\n";
        }
        foreach ($data as $key=>$values) {
            $xmlArray .= "<$key>\n";
            foreach ($values as $k=>$value) {
                if ($upper == true) {
                    $k = $k;
                }
                $xmlArray .= "<$k>" . htmlspecialchars(trim($value)) . "</$k>";
            }
            $xmlArray .= "\n</$key>\n";
        }
        if ($wrap != null) {
            $xmlArray .= "\n</$wrap>\n";
        }
       return $xmlArray;
    }//end of function

    //Get Module Fields
    function getModuleFieldsDropdown($modulename,$parameterSecondFieldValue,$addFields){
        $moduleFields = getFields($modulename,$override = array(),$addFields);
        $optionsString = "";
        foreach ($moduleFields as $key => $value) {
            if($parameterSecondFieldValue == $key){
                $optionsString .= "<option value='$key' selected='selected'>$value</option>";
            }else{
                $optionsString .= "<option value='$key'>$value</option>";
            }
        }
        return $optionsString;
    }//end of function

    //get fields
    function getFields($module,$override = array(),$addFields) {
        $fields = getPrimaryModuleFields($module,$override = array(),$addFields);
        return $fields;
    }//end of function

    //Get Primary Module Fields
    function getPrimaryModuleFields($module,$override = array(),$addFields){
        global $app_strings, $beanList, $current_user;
        $blockedModuleFields = array(
            // module = array( ... fields )
            'Users' => array(
                'id',
                'is_admin',
                'name',
                'user_hash',
                'user_name',
                'system_generated_password',
                'pwd_last_changed',
                'authenticate_id',
                'sugar_login',
                'external_auth_only',
                'deleted',
                'is_group',
            )
        );

        $fields = array('' => $app_strings['LBL_NONE']);
        if($addFields == 1){
            $fields['plain_text'] = translate('LBL_PLAIN_TEXT','AOW_Actions');
            $fields['personalized_msg'] = translate('LBL_PERSONALIZED_MSG','AOW_Actions');
        }//end of if
        
        $unset = array();
        if ($module !== '') {
            if (isset($beanList[$module]) && $beanList[$module]) {
                $mod = new $beanList[$module]();

                foreach ($mod->field_defs as $name => $arr){
                    if (ACLController::checkAccess($mod->module_dir, 'list', true)) {
                        if (array_key_exists($mod->module_dir, $blockedModuleFields)) {
                            if (in_array($arr['name'],$blockedModuleFields[$mod->module_dir]) && !$current_user->isAdmin()) {
                                $GLOBALS['log']->debug('hiding ' . $arr['name'] . ' field from ' . $current_user->name);
                                continue;
                            }
                        }
                       
                        if ($arr['type'] !== 'link'  && ((!isset($arr['source']) || $arr['source'] !== 'non-db')  || ($arr['type'] === 'relate' && isset($arr['id_name'])) || in_array($name, $override))) {
                            if (isset($arr['vname']) && $arr['vname'] !== '') {
                               $fields[$name] = rtrim(translate($arr['vname'], $mod->module_dir), ':');
                            } else {
                                $fields[$name] = $name;
                            }
                            
                            if ($arr['type'] === 'relate' && isset($arr['id_name']) && $arr['id_name'] !== '') {
                                $unset[] = $arr['id_name'];
                            }
                        }
                        if(isset($arr['function'])){
                            if(in_array("getEmailAddressWidget",$arr['function'])){
                                if (isset($arr['vname']) && $arr['vname'] !== '') {
                                    $fields[$name] = rtrim(translate($arr['vname'], $mod->module_dir), ':');
                                } else {
                                    $fields[$name] = $name;
                                }
                            }
                        }   
                    }
                } //End loop.
    
                foreach ($unset as $name) {
                    if (isset($fields[$name])) {
                        unset($fields[$name]);
                    }
                } //End loop.
            }
        }
        return $fields;
    }//end of function

    function getWebHookIntegrationConfig(){
        $selData = "SELECT enable FROM vi_enable_webhooksintegration";
        $resultData = $GLOBALS['db']->fetchOne($selData);
        return $resultData;
    }//end of function


    function getWebHookIntegrationData($tablename,$fieldNames,$where){
        $selectWebhookInetgrationData = '';
        //select
        $selectWebhookInetgrationData .= "SELECT ";
        foreach($fieldNames as $key => $value){
            if($key == 0){
                $selectWebhookInetgrationData .= $value;
            }else{
                $selectWebhookInetgrationData .= ",".$value;
            }
        }

        $selectWebhookInetgrationData .= " from $tablename"; 
        $whereFieldName = array_keys($where); //where condition field name
        $whereFieldValue = array_values($where); // where condition field value

        $j=0;
        if(!empty($where)){
            $selectWebhookInetgrationData .= " WHERE";
        }
        $count = count($where);
        foreach($where as $key => $w){
            $fieldName = $whereFieldName[$j];
            $fieldValue = $whereFieldValue[$j];
            if($count > 1 && $j >= 1){
                $selectWebhookInetgrationData .=" AND $fieldName='$fieldValue'";
            }else{
                $selectWebhookInetgrationData .=" $fieldName='$fieldValue'";
            }
            $j++;
        }//end of foreach
        return $selectWebhookInetgrationData;
    }//end of function

    function webHookJSONDataValidator($data=NULL) {
        if (!empty($data)) {
            @json_decode($data);
            return (json_last_error() === JSON_ERROR_NONE);
        }//end of if
        return false;
    }//end of fuction

    function webHookXMLDataValidator($content){
        $content = trim($content);
        if (empty($content)) {
            return false;
        }//end of if

        //html go to hell!
        if (stripos($content, '<!DOCTYPE html>') !== false) {
            return false;
        }//end of if

        libxml_use_internal_errors(true);
        simplexml_load_string($content);
        $errors = libxml_get_errors();          
        libxml_clear_errors();  

        return empty($errors);
    }//end of function

    function addWebHookIntegrationLog($bean,$responseStatus,$workflowName,$workflowId,$params,$responseRecordId,$method,$description){
        $webhookSyncLogBean = BeanFactory::newBean('VI_WebHook_Integration_Log');
        $webhookSyncLogBean->module_name_c = $bean->module_dir;
        $webhookSyncLogBean->status_c = $responseStatus;
        $webhookSyncLogBean->module_record_id_c = $bean->id;
        $webhookSyncLogBean->workflow_c = $workflowName;
        $webhookSyncLogBean->workflow_id_c =  $workflowId;
        
        if($description != ''){
            $webhookSyncLogBean->description = $description;
        }else{
            $webhookSyncLogBean->description = $params['action_description'];
        }//end of else

        $webhookSyncLogBean->name = $params['action_title'];
        $webhookSyncLogBean->assigned_user_id = '1';
        $webhookSyncLogBean->response_record_id_c = $responseRecordId;
        $webhookSyncLogBean->method_c = $method;
        $webhookSyncLogBean->save();  //Save Record
    }//end of function

    function getWebHookIntegrationHelpBoxHtml($url){
        global $suitecrm_version, $theme, $current_language;
        
        $helpBoxContent = '';
        $curl = curl_init();

        $postData = json_encode(array("suiteCRMVersion" => $suitecrm_version, "themeName" => $theme, 'currentLanguage' => $current_language));
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
        
        $data = curl_exec($curl);
        $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        if($httpCode == 200){
            $helpBoxContent = $data;
        }//end of if
        curl_close($curl);

        return $helpBoxContent;
    }//end of function
?>