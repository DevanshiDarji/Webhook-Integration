<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
//At bottom of post_install - redirect to license validation page 
function post_install() {
    //install table for user management
	
	require_once("modules/Administration/QuickRepairAndRebuild.php"); 
	$repairRebuild = new RepairAndClear(); 
	$repairRebuild ->repairAndClearAll(array('clearAll'), array(translate('LBL_ALL_MODULES')), FALSE, TRUE);
	
    //redirect to license validation page - CHANGE NAME BELOW - To your module name
    global $sugar_version;
    if(preg_match( "/^6.*/", $sugar_version)) {
        echo "
            <script>
            document.location = 'index.php?module=VIWebHookIntegrationLicenseAddon&action=license';
            </script>"
        ;
    } else {
        echo "
            <script>
            var app = window.parent.SUGAR.App;
            window.parent.SUGAR.App.sync({callback: function(){
                app.router.navigate('#bwc/index.php?module=VIWebHookIntegrationLicenseAddonn&action=license', {trigger:true});
            }});
            </script>"
        ;
    }
}//end of function
?>