 
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