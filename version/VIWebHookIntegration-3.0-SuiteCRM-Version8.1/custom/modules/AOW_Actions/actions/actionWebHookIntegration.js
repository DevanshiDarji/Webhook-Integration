 

function addHeader(){
    var parameterValueInfoLable = '"'+SUGAR.language.get('AOW_Actions','LBL_PARAMETER_VALUE_INFO')+'"';
    var parameterHeader = "<tr rowspan='4' id='parameter_header'><td width='159'></td><td></td><td id='paramtersRow'><p><b>"+SUGAR.language.get('AOW_Actions','LBL_PARAMETER_NAME')+"</b></p></td><td id='parametersValue' style='width:60%;'><p><b>"+SUGAR.language.get('AOW_Actions','LBL_PARAMETER_VALUE')+"</b><img src='custom/themes/SuiteP/images/helpInline.gif'  class='image' alt='Info Inline' height='15' width='15' onclick='return SUGAR.util.showHelpTips(this,"+parameterValueInfoLable+");'></p></td></tr>";
    return parameterHeader;
}

var flow_module = $('#flow_module').val();

function showModuleFields(flow_module,line){
    flow_module = flow_module;
    if(flow_module == "Securitygroups"){
        flow_module = "SecurityGroups";
    }
    
    if(flow_module == "Project_resources"){
        flow_module = "Project";
    }

    if(flow_module == "Therevisions"){
        flow_module = "DocumentRevisions";
    }

    if(flow_module == "Aos_products_purchases"){
        flow_module = "AOS_Products";
    }
    if(flow_module != ''){
        var callback = {
            success: function(result) {
                var sourceModuleFields =  new Array();    
                sourceModuleFields = result.responseText;
                var parameterHeader = addHeader();
                var parameterRow = parseInt($('#parameterRowValue'+line).val());
                var num = parameterRow + 1;
                var tableId = $('.tbl_action_parameters'+line);
                if(parameterRow == 0){
                    addRow = $("<tr rowspan='4' id=''>");
                    addRow.append(parameterHeader);
                    tableId.append(parameterHeader);
                }
                newRow =  $("<tr id='parameterRow"+num+"'>");
                var parameterValueId = 'aow_actions_param_parameter_field_value_'+line+'_'+num;
                var parameterName = 'aow_actions_param['+line+'][action_parameters][parameter_field_name]['+num+']';
                var parameterValue = 'aow_actions_param['+line+'][action_parameters][parameter_field_value]['+num+']';

                var plainTextName = 'aow_actions_param['+line+'][action_parameters][plain_text]['+num+']';
                var plainTextId = 'aow_actions_param_plain_text_'+line+'_'+num;

                var parameterFieldsId = 'aow_actions_param_parameter_fields_'+line+'_'+num;

                var personalizedMsgTextId = 'aow_actions_param_personalized_msg_text_'+line+'_'+num;
                var personalizedMsgTextName = 'aow_actions_param['+line+'][action_parameters][personalized_msg_text]['+num+']';

                newRow.append("<td width='159'></td><td>"+"<button type='button' class='button btn_parameter_minus' onclick='removeParameter(this,"+line+","+num+")' name='remove'>-</button><br>"+"</td>"+"<td>"+"<input type='text' name='"+parameterName+"' value='' style='width: auto;' class='parameter_field_name'></td><td><select name='"+parameterValue+"'  id= '"+parameterValueId+"' class='parameter_field_value' value='' onchange='changeParameterValue("+line+","+num+");'>"+sourceModuleFields+"</select>"+"<input type='text' name='"+plainTextName+"' id='"+plainTextId+"' style='display:none;width:265px;' class='plain_text'><select name='parameter_fields' id='"+parameterFieldsId+"' style='display:none;width:275px;' onchange='addParameterFields("+line+","+num+");'>"+sourceModuleFields+"</select></td>"+"</tr>");

                tableId.append(newRow);

                textAreaRow = $("<tr id='personalized_msg_row_"+line+'_'+num+"'>");

                textAreaRow.append("<td width='137'></td><td style='width:48%;'></td><td></td><td></td><td style='width:37%;'><textarea name='"+personalizedMsgTextName+"' id='"+personalizedMsgTextId+"' rows='3' cols='60' style='display:none;'></textarea></td></tr>");

                $('select[id="'+parameterFieldsId+'"] option[value="plain_text"]').remove();
                $('select[id="'+parameterFieldsId+'"] option[value="personalized_msg"]').remove();

                tableId.append(textAreaRow);
                parameterRow += 1;
                $("#parameterRowValue"+line).val(parameterRow);
            }
        }
        YAHOO.util.Connect.asyncRequest ("GET", "index.php?entryPoint=VIWebHookIntegrationFetchModuleFields&aow_module="+flow_module,callback);
    }
}
   

function  addFieldMapping(line){
    showModuleFields(flow_module,line);   
}

function addAuthentication(line){
    var authenticationRow = parseInt($('#authenticationRowValue'+line).val());
    var num = authenticationRow + 1;
    var tableId = $(".tbl_authorization_type"+line),
    newRow =  $("<tr id ='authenticationRow"+num+"'>");
    var authenticationName = 'aow_actions_param['+line+'][action_authentication][auth_field_name]['+num+']';
    var authenticationValue = 'aow_actions_param['+line+'][action_authentication][auth_field_value]['+num+']';
    newRow.append("<td width='159'></td><td>"+"<button type='button'  class='button btn_minus' onclick='removeAuthentication(this,"+line+")' name='remove'>-</button>"+"<input type='text' name='"+authenticationName+"' value='' style='width: auto;'>"+"<input type='text' name='"+authenticationValue+"' value='' id='authFieldValue'>"+"</td>"+"</tr>");
    tableId.append(newRow);
    authenticationRow += 1;
    $("#authenticationRowValue"+line).val(authenticationRow);
}

function removeAuthentication(obj,line){
    var authenticationTableClass = $(obj).closest('table').attr('class');
    $(obj).closest('tr').remove();
    var authenticationRow = parseInt($('#authenticationRowValue'+line).val());
    authenticationRow --;
    $("#authenticationRowValue"+line).val(authenticationRow);
    var i = 1;
    var row = $("tr[id^='authenticationRow']");
    $("."+authenticationTableClass+" > tbody > tr[id^='authenticationRow']").each(function(){
       $(this).attr('id','authenticationRow'+i);
       $(this).find('td').each(function(){
            $(this).find('input').attr('name','aow_actions_param['+line+'][action_authentication][auth_field_name]['+i+']');
            $(this).find('input:nth-child(even)').attr('name','aow_actions_param['+line+'][action_authentication][auth_field_value]['+i+']');
       });
       i++;
    });
}

function removeParameter(obj,line,num){
    var parameterstableClass = $(obj).closest('table').attr('class');
    $(obj).closest('tr').remove();
    var parameterRow = parseInt($('#parameterRowValue'+line).val());
    parameterRow --;
    if(parameterRow == 0){
        $('tr#parameter_header').remove();
    }
    $('tr#personalized_msg_row_'+line+'_'+num).remove();
    $("#parameterRowValue"+line).val(parameterRow);
    var i = 1;
    var row = $("tr[id^='parameterRow']");
    $("."+parameterstableClass+" > tbody > tr[id^='parameterRow']").each(function(){
       $(this).attr('id','parameterRow'+i);
       $(this).find('td').each(function(){
            $(this).find('input[class="parameter_field_name"]').attr('name','aow_actions_param['+line+'][action_parameters][parameter_field_name]['+i+']');
            $(this).find('select[class="parameter_field_value"]').attr('name','aow_actions_param['+line+'][action_parameters][parameter_field_value]['+i+']');
            $(this).find('input[class="plain_text"]').attr('name','aow_actions_param['+line+'][action_parameters][plain_text]['+i+']');
       });
       i++;
    });

    var i = 1;
    $("."+parameterstableClass+" > tbody > tr[id^='personalized_msg_row_']").each(function(){
       $(this).attr('id','personalized_msg_row_'+line+'_'+i);
       $(this).find('td').each(function(){
            $(this).find('textarea').attr('name','aow_actions_param['+line+'][action_parameters][personalized_msg_text]['+i+']');
       });
       i++;
    });
}

function checkAuthenticationType(obj,line){
    var authenticationType = $(obj).val();
    var row = $('#authenticationRowValue'+line).val();
    if(authenticationType == "Basic Authentication"){
        for(var i=1;i<=row;i++){
            $('tr#authenticationRow'+i).show();
        }
        $('.btn_add_authentication').show();
        $('.btn_test_authentication').show();
    }else{
        for(var i=1;i<=row;i++){
            $('tr#authenticationRow'+i).hide();
        }
        $('.btn_add_authentication').hide();
        $('.btn_test_authentication').hide();
    }
}

changeActionDropDownAttr();
function changeActionDropDownAttr(){
    $('table#actionLines>tr').each(function(){
        var trId = $(this).attr('id');
        var replaceText = trId.replace(/[^0-9]/gi, ''); // Replace everything that is not a number with nothing
        var number = parseInt(replaceText, 10);
        $('select[id="aow_actions_action'+number+'"]').attr('onchange','checkWebHookIntegrationStatus('+number+');');
    });
    setTimeout(function(){
        changeActionDropDownAttr();
    },1000);
}

function checkWebHookIntegrationStatus(cnt){
    var actionName = $('#aow_actions_action'+cnt).val();
    if(actionName == 'WebHookIntegration'){
        $.ajax({
            url:"index.php?entryPoint=VICheckWebHookIntegrationStatus",
            type:"POST",
            dataType: "json",
            success:function(result){
                if(result.enable == 1){
                   getView(cnt);
                }else{
                    alert(SUGAR.language.get('AOW_Actions','LBL_WEBHOOK_INTEGRATION_FEATURE'));
                    $('#aow_actions_action'+cnt).val('');
                    $('#action_parameter'+cnt).html('');
                }
            }
        });
    }else{
        getView(cnt);
    }
}
function testAuthentication(line){
    var formData = $('form');
    formData = formData.serialize();
    var action_url = $('#action_url').val();
    $.ajax({
        type: "POST",
        url: action_url,
        data: {data:formData,
        authentication : 1},
        dataType: "json",
        success: function(data) {
            alert(data.msg);
        },
    });
}

function changeParameterValue(line,i){
    var parameterFieldVal = $('#aow_actions_param_parameter_field_value_'+line+'_'+i).val();
    
    $('#aow_actions_param_plain_text_'+line+'_'+i).val('');
    $('#aow_actions_param_parameter_fields_'+line+'_'+i).val('');
    $('#aow_actions_param_personalized_msg_text_'+line+'_'+i).val('');
    
    if(parameterFieldVal == 'plain_text'){
        $('#aow_actions_param_plain_text_'+line+'_'+i).show();
        $('#aow_actions_param_parameter_fields_'+line+'_'+i).hide();
        $('#aow_actions_param_personalized_msg_text_'+line+'_'+i).hide();
    }else if(parameterFieldVal == 'personalized_msg'){
        $('#aow_actions_param_plain_text_'+line+'_'+i).hide();
        $('#aow_actions_param_parameter_fields_'+line+'_'+i).show();
        $('#aow_actions_param_personalized_msg_text_'+line+'_'+i).show();
    }else{
        $('#aow_actions_param_plain_text_'+line+'_'+i).hide();
        $('#aow_actions_param_parameter_fields_'+line+'_'+i).hide();
        $('#aow_actions_param_personalized_msg_text_'+line+'_'+i).hide();
    }//end of else
}//end of function

function addParameterFields(line,no){
    var parameterFields = $('#aow_actions_param_parameter_fields_'+line+'_'+no).val();
    $('#aow_actions_param_parameter_fields_'+line+'_'+no).val('');
    if(parameterFields != ''){
        var oldVal = $('#aow_actions_param_personalized_msg_text_'+line+'_'+no).val();
        parameterFields = '$'+parameterFields;
        $('#aow_actions_param_personalized_msg_text_'+line+'_'+no).val(oldVal+parameterFields);
    }//end of if
}//end of function