<?php
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
require_once('modules/VIWebHookIntegrationLicenseAddon/license/VIWebHookIntegrationOutfittersLicense.php');
require_once('include/MVC/Controller/SugarController.php');
global $sugar_config;
global $mod_strings;
$siteURL = $sugar_config['site_url'];
$url = $siteURL."/index.php?module=VIWebHookIntegrationLicenseAddon&action=license";
$sqlLicenseCheck = "SELECT * from config where name = 'lic_webhook-integration'";
$result = $GLOBALS['db']->query($sqlLicenseCheck);
$selectResultData = $GLOBALS['db']->fetchRow($GLOBALS['db']->query($sqlLicenseCheck));
if(!empty($selectResultData)){
    $validate_license = VIWebHookIntegrationOutfittersLicense::isValid('VIWebHookIntegrationLicenseAddon');
    if($validate_license !== true) {
        if(is_admin($current_user)) {
         SugarApplication::appendErrorMessage($mod_strings['LBL_LICENCE_ACTIVE_LABEL'].$validate_license.$mod_strings['LBL_LICENCE_ISSUES']. '<a href='.$url.'>'.$mod_strings['LBL_CLICK_HERE'].'</a>');
        }
            echo '<h2><p class="error">'.$mod_strings['LBL_LICENCE_ACTIVE'].'</p></h2><p class="error">'.$mod_strings['LBL_RENEW_LICENCE'].'</p><a href='.$url.'>'.$mod_strings['LBL_CLICK_HERE'].'</a>';
     }else{
        foreach ($admin_group_header as $key => $value) {
            $values[] = $value[0];
        }   
        if (in_array("Other", $values)){
                $array['WebhookIntegration'] = array('WebhookIntegration',
                                                    $mod_strings["LBL_WEBHOOK_INTEGRATION"],
                                                    $mod_strings["LBL_WEBHOOK_INTEGRATION_DESCRIPTION"],
                                                    './index.php?module=Administration&action=vi_webhookintegrationconfig',
                                                    'webhook-integration');
                $admin_group_header['Other'][3]['Administration'] = array_merge($admin_group_header['Other'][3]['Administration'],$array);
        }else{
            $admin_option_defs = array();
            $admin_option_defs['Administration']['WebhookIntegration'] = array(
               //Icon name. Available icons are located in ./themes/default/images
                'WebhookIntegration',
                //Link name label 
                'LBL_WEBHOOK_INTEGRATION',

                //Link description label
                'LBL_WEBHOOK_INTEGRATION_DESCRIPTION',

                //Link URL
                './index.php?module=Administration&action=vi_webhookintegrationconfig',
                'webhook-integration'
            );
            $admin_group_header['Other'] = array(
                //Section header label
                'Other',

                //$other_text parameter for get_form_header()
                '',

                //$show_help parameter for get_form_header()
                false,

                //Section links
                $admin_option_defs,

                //Section description label
                ''
            );
        }   
    }
}else{
    foreach ($admin_group_header as $key => $value) {
        $values[] = $value[0];
    }
    if (in_array("Other", $values))
    {
        $array['WebhookIntegration'] = array('WebhookIntegration',
                                                    $mod_strings["LBL_WEBHOOK_INTEGRATION"],
                                                    $mod_strings["LBL_WEBHOOK_INTEGRATION_DESCRIPTION"],
                                                    './index.php?module=Administration&action=vi_webhookintegrationconfig',
                                                    'webhook-integration');
        $admin_group_header['Other'][3]['Administration'] = array_merge($admin_group_header['other'][3]['Administration'],$array);
    }else{
        $admin_option_defs = array();
        $admin_option_defs['Administration']['WebhookIntegration'] = array(
           //Icon name. Available icons are located in ./themes/default/images
            'WebhookIntegration',

            //Link name label 
            $mod_strings["LBL_WEBHOOK_INTEGRATION"],

            //Link description label
            $mod_strings["LBL_WEBHOOK_INTEGRATION_DESCRIPTION"],

            //Link URL
            './index.php?module=VIWebHookIntegrationLicenseAddon&action=license',
            'webhook-integration'
        );
        $admin_group_header['other'] = array(
            //Section header label
            'Other',

            //$other_text parameter for get_form_header()
            '',

            //$show_help parameter for get_form_header()
            false,

            //Section links
            $admin_option_defs,

            //Section description label
            ''
        );
    }
}
?>