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
require_once('custom/VIWebhookIntegration/VIWebHookIntegrationFunction.php');
class Viewvi_webhookintegrationconfig extends SugarView {
  public function __construct() {
    parent::init();
  }
  public function display(){
    global $mod_strings,$theme;
    
    $administrationView = "index.php?module=Administration&action=index";
    
    $webhookIntegrationConfig = getWebHookIntegrationConfig();

    if(!empty($webhookIntegrationConfig)) {
      $enable = $webhookIntegrationConfig['enable'];
    }else{
      $enable = 0;
    }//end of if

    $url = "https://suitehelp.varianceinfotech.com";

    $helpBoxContent = getWebHookIntegrationHelpBoxHtml($url);

    $smarty = new Sugar_Smarty();
   
    $smarty->assign('MOD',$mod_strings);
    $smarty->assign('THEME',$theme);
    $smarty->assign('ADMINISTRATIONVIEW',$administrationView);
    $smarty->assign("ENABLE",$enable);
    $smarty->assign('HELP_BOX_CONTENT',$helpBoxContent);
    $smarty->display('custom/modules/Administration/tpl/vi_webhookintegrationconfig.tpl');
  }//end of display
}//end of class
?>

