<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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