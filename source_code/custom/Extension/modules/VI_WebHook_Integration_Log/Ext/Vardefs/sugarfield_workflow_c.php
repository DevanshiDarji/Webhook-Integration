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
$GLOBALS['dictionary']['VI_WebHook_Integration_Log']['fields']['workflow_c'] = array (
    'name' => 'workflow_c',
    'vname' => 'LBL_WORKFLOW',
    'type' => 'relate',
    'id_name' => 'workflow_id_c',
    'ext2' => 'AOW_WorkFlow',
    'module' => 'AOW_WorkFlow',
    'len' => '255',
);
$GLOBALS['dictionary']['VI_WebHook_Integration_Log']['fields']['workflow_id_c'] = array (
    'name' => 'workflow_id_c',
    'vname' => 'LBL_WORKFLOW_ID',
    'type' => 'id',
    'len' => '36',
    'size' => '20',
);
?>