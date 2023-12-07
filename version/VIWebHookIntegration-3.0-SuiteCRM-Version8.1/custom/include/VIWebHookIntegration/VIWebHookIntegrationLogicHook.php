<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
class VIWebHookIntegrationLogicHook{
	public function viwebhookintegration($event,$arguments){
		global $suitecrm_version;
		if($GLOBALS['app']->controller->module  == "Administration" || $GLOBALS['app']->controller->action == 'index'){
			if (version_compare($suitecrm_version, '7.10.2', '>=')){
    			echo '<link rel="stylesheet" type="text/css" href="custom/include/VIWebHooIntegrationIcon.css">';
      		}
		}
	}//end of function
}//end of class
?>