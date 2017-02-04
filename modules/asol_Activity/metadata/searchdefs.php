<?php
$module_name = 'asol_Activity';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
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
      'type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'type',
      ),
      'delay' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DELAY',
        'width' => '10%',
        'default' => true,
        'name' => 'delay',
      ),
      'asol_activity_asol_activity_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_L_TITLE',
        'id' => 'ASOL_ACTIV898ACTIVITY_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'asol_activity_asol_activity_name',
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
