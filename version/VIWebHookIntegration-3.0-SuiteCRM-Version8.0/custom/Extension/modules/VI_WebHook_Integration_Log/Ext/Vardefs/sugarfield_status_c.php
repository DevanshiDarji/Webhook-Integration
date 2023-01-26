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
      $GLOBALS['dictionary']['VI_WebHook_Integration_Log']['fields']['status_c'] = array (
            'name' => 'status_c',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'module' => 'VI_WebHook_Integration_Log',
            'options' => 'webhook_status_dom',
            'required' => true,
            'massupdate' => false,
            'default' => '',
            'len' => 200,
            'reportable' => true,
            'importable' => false,
            'audited' => true,
      );
?>