<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
class VICheckWebHookIntegrationStatus{
    public function __construct(){
        $this->checkStatus();
    } 
    public function checkStatus(){
    	$selData = "SELECT enable FROM vi_enable_webhooksintegration";
    	$resultData = $GLOBALS['db']->fetchOne($selData);
      	echo json_encode($resultData);
    }//end of function
}//end of class
new VICheckWebHookIntegrationStatus();
?>