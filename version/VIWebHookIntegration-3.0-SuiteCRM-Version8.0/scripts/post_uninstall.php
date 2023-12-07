<?php
 
//post_uninstall logic
	global $db;
	$db->dropTableName('vi_enable_webhooksintegration');
	
	$sqlWebHookIntegration = "DELETE from config where name = 'webhook-integration'";
	$result = $GLOBALS['db']->query($sqlWebHookIntegration);

	$sqlLicenseKey = "DELETE from config where name = 'lic_webhook-integration'";
	$result2 = $GLOBALS['db']->query($sqlLicenseKey);
?>