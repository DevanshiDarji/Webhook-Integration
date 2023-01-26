/*********************************************************************************
 * This file is part of package WebHook Integration.
 * 
 * Author : Variance InfoTech PVT LTD (http://www.varianceinfotech.com)
 * All rights (c) 2022 by Variance InfoTech PVT LTD
 *
 * This Version of WebHook Integration is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of Variance InfoTech PVT LTD
 * 
 * You can contact via email at info@varianceinfotech.com
 * 
 ********************************************************************************/
$('#enabled_webhook_integration').on('change', function() {
	var check_value;
	if($(this).is(':checked')){
		check_value = 1;
	}else{
	  	check_value = 0;
	}

	$.ajax({
      	url : 'index.php?entryPoint=VIWebhookIntegrationConfigEnable',
      	type: 'POST',
      	data : {val : check_value},
      	success : function(data) {
		    if(check_value == 1) {
			    alert(SUGAR.language.get('Administration','LBL_WEBHOOK_INTEGRATION_ENABLED'));
		    }else{
		    	alert(SUGAR.language.get('Administration','LBL_WEBHOOK_INTEGRATION_DISABLED'));
		    }
     	}
  	});
});