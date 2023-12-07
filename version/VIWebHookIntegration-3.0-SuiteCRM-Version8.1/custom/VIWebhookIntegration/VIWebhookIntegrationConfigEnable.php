<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
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