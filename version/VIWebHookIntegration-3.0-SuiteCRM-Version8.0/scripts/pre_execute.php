<?php
 
//pre_execute logic
$now = date("Y-m-d");

//EntryPoint
if(is_dir('custom/VIWebhookIntegration')) {
    $changeVIWebhookIntegrationFolderName = 'VIWebhookIntegration'.$now;
    rename("custom/VIWebhookIntegration","custom/".$changeVIWebhookIntegrationFolderName);
}


//include
if(is_dir('custom/include/VIWebHookIntegration')) {
    $changeVIWebhookIntegrationFolderName = 'VIWebHookIntegration'.$now;
    rename("custom/include/VIWebHookIntegration","custom/include/".$changeVIWebhookIntegrationFolderName);
} 


//Webhook Inetgartion
//css
if(file_exists('custom/modules/Administration/css/VIWebhookIntegrationConfig.css')) {
    $nowWICss = 'VIWebhookIntegrationConfig'.$now.'.'.'css';
    rename("custom/modules/Administration/css/VIWebhookIntegrationConfigcss","custom/modules/Administration/css/".$nowWICss);
}

//js
if(file_exists('custom/modules/Administration/js/VIWebhookIntegrationConfig.js')) {
    $nowWIJs = 'VIWebhookIntegrationConfig'.$now.'.'.'js';
    rename("custom/modules/Administration/js/VIWebhookIntegrationConfig.js","custom/modules/Administration/js/".$nowWIJs);
}

//tpl
if(file_exists('custom/modules/Administration/tpl/vi_webhookintegrationconfig.tpl')) {
    $nowWITpl = 'vi_webhookintegrationconfig'.$now.'.'.'tpl';
    rename("custom/modules/Administration/tpl/vi_webhookintegrationconfig.tpl","custom/modules/Administration/tpl/".$nowWITpl);
}

//views
if(file_exists('custom/modules/Administration/views/view.vi_webhookintegrationconfig.php')) {
    $nowWIView = 'view.vi_webhookintegrationconfig'.$now.'.'.'php';
    rename("custom/modules/Administration/views/view.vi_webhookintegrationconfig.php","custom/modules/Administration/views/".$nowWIView);
}

//images
if(file_exists('themes/suite8/images/WebhookIntegration.png')) {
    $nowsuite8WIPNG = 'WebhookIntegration'.$now.'.'.'png';
    rename("themes/suite8/images/WebhookIntegration.png","themes/suite8/images/".$nowsuite8WIPNG);
}
if(file_exists('themes/suite8/images/WebhookIntegration.svg')) {
    $nowsuite8WISVG = 'WebhookIntegration'.$now.'.'.'svg';
    rename("themes/suite8/images/WebhookIntegration.svg","themes/suite8/images/".$nowsuite8WISVG);
}
?>