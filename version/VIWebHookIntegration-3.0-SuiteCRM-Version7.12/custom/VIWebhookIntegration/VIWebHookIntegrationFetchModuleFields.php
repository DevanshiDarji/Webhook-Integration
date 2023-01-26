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
require_once('custom/VIWebhookIntegration/VIWebHookIntegrationFunction.php');
class VIWebHookIntegrationFetchModuleFields{
    public function __construct(){
        $this->getModuleFields();
    }
    
   //Get Primary Module Fields
    function getFields($module,$override = array(),$addFields){
        $fields = getPrimaryModuleFields($module,$override = array(),$addFields);
        $value = '';
        return get_select_options_with_id($fields, $value);
    }

    public function getModuleFields(){
        if (!empty($_REQUEST['aow_module']) && $_REQUEST['aow_module'] != '') {
            if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
                $module = getRelatedModule($_REQUEST['aow_module'], $_REQUEST['rel_field']);
            } else {
                $module = $_REQUEST['aow_module'];
            }
           $override = array();
            if (isset($_REQUEST['override']) && is_array($_REQUEST['override'])) {
                $override = $_REQUEST['override'];
            }
            $view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'EditView';
            $value = isset($_REQUEST['aow_value']) ? $_REQUEST['aow_value'] : '';
            echo $this->getFields($module,$override = array(),1);
        }
        die;
    }//end of function
}//end of class
new VIWebHookIntegrationFetchModuleFields();
?>