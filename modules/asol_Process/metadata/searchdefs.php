<?php
$module_name = 'asol_Process';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'current_user_only' => 
      array (
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'width' => '10%',
        'default' => true,
        'name' => 'current_user_only',
      ),
      'status' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'name' => 'status',
      ),
      'alternative_database' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_REPORT_USE_ALTERNATIVE_DB',
        'width' => '10%',
        'name' => 'alternative_database',
      ),
      'trigger_module' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TRIGGER_MODULE',
        'width' => '10%',
        'default' => true,
        'name' => 'trigger_module',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
