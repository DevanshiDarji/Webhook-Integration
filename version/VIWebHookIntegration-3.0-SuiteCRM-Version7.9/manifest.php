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
$manifest = array (
   0 => 
  array (
    'acceptable_sugar_versions' => 
    array (
      0 => '',
    ),
  ),
  1 => 
  array (
    'acceptable_sugar_flavors' => 
    array (
      0 => 'CE',
      1 => 'PRO',
      2 => 'ENT',
    ),
  ),
  'key' => '',
  'name' => 'WebHook Integration',
  'description' => 'WebHook Integration',
  'author' => 'Variance Infotech PVT LTD',
  'version' => 'v3.0',
  'is_uninstallable' => true,
  'published_date' => '2020-09-16 17:00:00',
  'type' => 'module',
  'readme' => '',
  'icon' => '',
  'remove_tables' => 'prompt',
);

$installdefs = array (
  'id' => 'WebHook Integration',
  'beans' => 
    array (
      array (
        'module' => 'VI_WebHook_Integration_Log',
        'class' => 'VI_WebHook_Integration_Log',
        'path' => 'modules/VI_WebHook_Integration_Log/VI_WebHook_Integration_Log.php',
        'tab' => true,
      ),
      array (
        'module' => 'VIWebHookIntegrationLicenseAddon',
        'class' => 'VIWebHookIntegrationLicenseAddon',
        'path' => 'modules/VIWebHookIntegrationLicenseAddon/VIWebHookIntegrationLicenseAddon.php',
        'tab' => false,
      ),
    ),
  'post_execute' => array(  0 =>  '<basepath>/scripts/post_execute.php',),
  'post_install' => array(  0 =>  '<basepath>/scripts/post_install.php',),
  'post_uninstall' => array( 0 =>  '<basepath>/scripts/post_uninstall.php',),
  'pre_execute' => array(  0 =>  '<basepath>/scripts/pre_execute.php',),
  'copy' => array (
    0 => array (
      'from' => '<basepath>/custom/Extension/application/Ext/EntryPointRegistry/VIWebHookIntegration_EntryPoint.php',
      'to' => 'custom/Extension/application/Ext/EntryPointRegistry/VIWebHookIntegration_EntryPoint.php',
    ),
    1 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/ActionViewMap/VIWebHookIntegrationAction_View_Map.ext.php',
      'to' => 'custom/Extension/modules/Administration/Ext/ActionViewMap/VIWebHookIntegrationAction_View_Map.ext.php',
    ),
    2 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Administration/VIWebHookIntegrationAdministration.ext.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Administration/VIWebHookIntegrationAdministration.ext.php',
    ),
    3 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Actions/VIWebHookIntegrationActions.ext.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Actions/VIWebHookIntegrationActions.ext.php',
    ),
    4 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_method_c.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_method_c.php',
    ),
    5 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_module_name_c.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_module_name_c.php',
    ),
    6 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_module_record_id_c.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_module_record_id_c.php',
    ),
    7 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_response_record_id_c.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_response_record_id_c.php',
    ),
    8 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_status_c.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_status_c.php',
    ),
    9 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_workflow_c.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Vardefs/sugarfield_workflow_c.php',
    ),
    10 => array (
      'from' => '<basepath>/custom/modules/Administration/css/VIWebhookIntegrationConfig.css',
      'to' => 'custom/modules/Administration/css/VIWebhookIntegrationConfig.css',
    ),
    11 => array (
      'from' => '<basepath>/custom/modules/Administration/js/VIWebhookIntegrationConfig.js',
      'to' => 'custom/modules/Administration/js/VIWebhookIntegrationConfig.js',
    ),
    12 => array (
      'from' => '<basepath>/custom/modules/Administration/tpl/vi_webhookintegrationconfig.tpl',
      'to' => 'custom/modules/Administration/tpl/vi_webhookintegrationconfig.tpl',
    ),
    13 => array (
      'from' => '<basepath>/custom/modules/Administration/views/view.vi_webhookintegrationconfig.php',
      'to' => 'custom/modules/Administration/views/view.vi_webhookintegrationconfig.php',
    ),
    14 => array (
      'from' => '<basepath>/custom/modules/AOW_Actions/actions/actionWebHookIntegration.css',
      'to' => 'custom/modules/AOW_Actions/actions/actionWebHookIntegration.css',
    ),
    15 => array (
      'from' => '<basepath>/custom/modules/AOW_Actions/actions/actionWebHookIntegration.js',
      'to' => 'custom/modules/AOW_Actions/actions/actionWebHookIntegration.js',
    ),
    16 => array (
      'from' => '<basepath>/custom/modules/AOW_Actions/actions/actionWebHookIntegration.php',
      'to' => 'custom/modules/AOW_Actions/actions/actionWebHookIntegration.php',
    ),
    17 => array (
      'from' => '<basepath>/custom/modules/VI_WebHook_Integration_Log/',
      'to' => 'custom/modules/VI_WebHook_Integration_Log/',
    ),
    18 => array (
      'from' => '<basepath>/custom/themes/SuiteP/images/helpInline.gif',
      'to' => 'custom/themes/SuiteP/images/helpInline.gif',
    ),
    19 => array (
      'from' => '<basepath>/custom/themes/SuiteP/images/WebhookIntegration.png',
      'to' => 'custom/themes/SuiteP/images/WebhookIntegration.png',
    ),
    20 => array (
      'from' => '<basepath>/custom/themes/SuiteP/images/WebhookIntegration.svg',
      'to' => 'custom/themes/SuiteP/images/WebhookIntegration.svg',
    ),
    21 => array (
      'from' => '<basepath>/custom/Extension/application/Ext/LogicHooks/VIWebHookIntegration_Hook.php',
      'to' => 'custom/Extension/application/Ext/LogicHooks/VIWebHookIntegration_Hook.php',
    ),
    22 => array (
      'from' => '<basepath>/custom/VIWebhookIntegration/VICheckWebHookIntegrationStatus.php',
      'to' => 'custom/VIWebhookIntegration/VICheckWebHookIntegrationStatus.php',
    ),
    23 => array (
      'from' => '<basepath>/custom/VIWebhookIntegration/VIWebHookIntegrationFetchModuleFields.php',
      'to' => 'custom/VIWebhookIntegration/VIWebHookIntegrationFetchModuleFields.php',
    ),
    24 => array (
      'from' => '<basepath>/custom/VIWebhookIntegration/VIWebHookIntegrationFunction.php',
      'to' => 'custom/VIWebhookIntegration/VIWebHookIntegrationFunction.php',
    ),
    25 => array (
      'from' => '<basepath>/custom/VIWebhookIntegration/VIWebhookIntegrationConfigEnable.php',
      'to' => 'custom/VIWebhookIntegration/VIWebhookIntegrationConfigEnable.php',
    ),
    26 => array (
      'from' => '<basepath>/custom/Extension/modules/VIWebHookIntegrationLicenseAddon/',
      'to' => 'custom/Extension/modules/VIWebHookIntegrationLicenseAddon/',
    ),
    27 => array (
      'from' => '<basepath>/custom/modules/VIWebHookIntegrationLicenseAddon/',
      'to' => 'custom/modules/VIWebHookIntegrationLicenseAddon/',
    ),
    28 => array (
      'from' => '<basepath>/modules/VIWebHookIntegrationLicenseAddon/',
      'to' => 'modules/VIWebHookIntegrationLicenseAddon/',
    ),
    29 => array (
      'from' => '<basepath>/modules/VI_WebHook_Integration_Log/',
      'to' => 'modules/VI_WebHook_Integration_Log/',
    ),
    30 => array (
      'from' => '<basepath>/custom/Extension/application/Ext/Include/VIWebHookIntegrationModules.ext.php',
      'to' => 'custom/Extension/application/Ext/Include/VIWebHookIntegrationModules.ext.php',
    ),
    31 => array (
      'from' => '<basepath>/custom/Extension/application/Ext/Language/VIWebHookIntegrationen_us.lang.ext.php',
      'to' => 'custom/Extension/application/Ext/Language/VIWebHookIntegrationen_us.lang.ext.php',
    ),
    32 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.de_DE.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.de_DE.lang.php',
    ),
    33 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.en_us.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.en_us.lang.php',
    ),
    34 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.es_ES.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.es_ES.lang.php',
    ),
    35 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.fr_FR.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.fr_FR.lang.php',
    ),
    36 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.hu_HU.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.hu_HU.lang.php',
    ),
    37 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.it_IT.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.it_IT.lang.php',
    ),
    38 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.nl_NL.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.nl_NL.lang.php',
    ),
    39 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.pt_BR.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.pt_BR.lang.php',
    ),
    40 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.ru_RU.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.ru_RU.lang.php',
    ),
    41 => array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.ua_UA.lang.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/VIWebHookIntegration.ua_UA.lang.php',
    ),
    42 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.de_DE.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.de_DE.lang.php',
    ),
    43 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.en_us.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.en_us.lang.php',
    ),
    44 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.es_ES.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.es_ES.lang.php',
    ),
    45 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.fr_FR.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.fr_FR.lang.php',
    ),
    46 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.hu_HU.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.it_IT.lang.php',
    ),
    47 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.nl_NL.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.nl_NL.lang.php',
    ),
    48 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.pt_BR.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.pt_BR.lang.php',
    ),
    49 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.ru_RU.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.ru_RU.lang.php',
    ),
    50 => array (
      'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.ua_UA.lang.php',
      'to' => 'custom/Extension/modules/AOW_Actions/Ext/Language/VIWebHookIntegrationActions.ua_UA.lang.php',
    ),
    51 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.de_DE.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.de_DE.lang.php',
    ),
    52 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.en_us.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.en_us.lang.php',
    ),
    53 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.es_ES.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.es_ES.lang.php',
    ),
    54 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.fr_FR.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.fr_FR.lang.php',
    ),
    55 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.hu_HU.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.hu_HU.lang.php',
    ),
    56 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.it_IT.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.it_IT.lang.php',
    ),
    57 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.nl_NL.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.nl_NL.lang.php',
    ),
    58 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.pt_BR.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.pt_BR.lang.php',
    ),
    59 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.ru_RU.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.ru_RU.lang.php',
    ),
    60 => array (
      'from' => '<basepath>/custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.ua_UA.lang.php',
      'to' => 'custom/Extension/modules/VI_WebHook_Integration_Log/Ext/Language/VIWebHookIntegrationLog.ua_UA.lang.php',
    ),
  ),
);
?>