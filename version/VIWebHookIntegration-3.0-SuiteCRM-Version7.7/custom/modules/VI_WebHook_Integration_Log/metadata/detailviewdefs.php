<?php
$module_name = 'VI_WebHook_Integration_Log';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'module_name_c',
            'label' => 'LBL_MODULE_NAME',
          ),
          1 => 
          array (
            'name' => 'status_c',
            'label' => 'LBL_STATUS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'module_record_id_c',
            'comment' => 'Text Field Comment Text',
            'label' => 'LBL_MODULE_RECORD_ID',
          ),
          1 => 
          array (
            'name' => 'workflow_c',
            'label' => 'LBL_WORKFLOW',
          ),
        ),
        2 => 
        array (
          0 => 'description',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'response_record_id_c',
            'comment' => 'Text Field Comment Text',
            'label' => 'LBL_RESPONSE_RECORD_ID',
          ),
          1 => 'name',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'method_c',
            'label' => 'Method',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
;
?>
