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
//post_uninstall logic
	global $db;
	$db->dropTableName('vi_enable_webhooksintegration');
	
	$sqlWebHookIntegration = "DELETE from config where name = 'webhook-integration'";
	$result = $GLOBALS['db']->query($sqlWebHookIntegration);

	$sqlLicenseKey = "DELETE from config where name = 'lic_webhook-integration'";
	$result2 = $GLOBALS['db']->query($sqlLicenseKey);
?>