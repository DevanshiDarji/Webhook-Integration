<?php
 
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