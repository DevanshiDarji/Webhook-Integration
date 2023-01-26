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
if(!isset($hook_array) || !is_array($hook_array)) {
	$hook_array = array();
}

if(!isset($hook_array['after_ui_frame']) || !is_array($hook_array['after_ui_frame'])) {
	$hook_array['after_ui_frame'] = array();
}

$hook_array['after_ui_frame'][] = array(
	1, //Hook version
	'VIWebHookIntegration',  //Label
  	'custom/include/VIWebHookIntegration/VIWebHookIntegrationLogicHook.php', //Include file
	'VIWebHookIntegrationLogicHook', //Class
	'viwebhookintegration' //Method
);
?>