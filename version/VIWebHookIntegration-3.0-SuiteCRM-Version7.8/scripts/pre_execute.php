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
//pre_execute logic
$now = date("Y-m-d");
//Function File
if(file_exists('custom/VIWebhookIntegration/VIVIWebHookIntegrationFunction.php')) {
    $nowAddWebHookIntegrationFunctionFile = 'VIVIWebHookIntegrationFunction'.$now.'.'.'php';
    rename("custom/VIWebhookIntegration/VIVIWebHookIntegrationFunction.php","custom/".$nowAddWebHookIntegrationFunctionFile);
}

//EntryPoint
if(file_exists('custom/VIWebhookIntegration/VIWebHookIntegrationFetchModuleFields.php')) {
    $nowAddModuleFieldsFile = 'VIWebHookIntegrationFetchModuleFields'.$now.'.'.'php';
    rename("custom/VIWebhookIntegration/VIWebHookIntegrationFetchModuleFields.php","custom/".$nowAddModuleFieldsFile);
}
if(file_exists('custom/VIWebhookIntegration/VIWebhookIntegrationConfigEnable.php')) {
    $nowConfigEnableFile = 'VIWebhookIntegrationConfigEnable'.$now.'.'.'php';
    rename("custom/VIWebhookIntegration/VIWebhookIntegrationConfigEnable.php","custom/".$nowConfigEnableFile);
}
?>