<?php
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
	$entry_point_registry['VIWebhookIntegrationConfigEnable'] = array(
        'file' => 'custom/VIWebhookIntegration/VIWebhookIntegrationConfigEnable.php',
        'auth' => true
    );
    $entry_point_registry['VIWebHookIntegrationFetchModuleFields'] = array(
    	'file' => 'custom/VIWebhookIntegration/VIWebHookIntegrationFetchModuleFields.php',
        'auth' => true
    );
    $entry_point_registry['VICheckWebHookIntegrationStatus'] = array(
    	'file' => 'custom/VIWebhookIntegration/VICheckWebHookIntegrationStatus.php',
        'auth' => true
    );
   
?>