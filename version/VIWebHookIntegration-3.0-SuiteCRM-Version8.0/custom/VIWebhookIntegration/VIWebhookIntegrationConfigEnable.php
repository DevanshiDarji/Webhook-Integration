<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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
class VIWebhooksIntegrationConfigEnable{
    public function __construct(){
    	$this->webhooks_integration_config();
    } 
    public function webhooks_integration_config(){
    	$enableWebhooksIntegration = $_REQUEST['val'];
        $selData = "SELECT enable FROM vi_enable_webhooksintegration";
        $resultData = $GLOBALS['db']->fetchOne($selData);
        
        if(empty($resultData)) {
            $queryEnableWebHooks = "INSERT INTO vi_enable_webhooksintegration(enable) values('$enableWebhooksIntegration')";                     
            $resultEnableWebHooks = $GLOBALS['db']->query($queryEnableWebHooks); 
        }else{
            $queryUpdateWebHooks = "UPDATE vi_enable_webhooksintegration SET enable = '$enableWebhooksIntegration'";                   
            $resultUpdateWebHooks = $GLOBALS['db']->query($queryUpdateWebHooks);
        } 
    }//end of function
}//end of class
new VIWebhooksIntegrationConfigEnable();
?>