<?php
$module_name = 'asol_Task';
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
      'delay_type' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_DELAY_TYPE',
        'width' => '10%',
        'name' => 'delay_type',
      ),
      'delay' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DELAY',
        'width' => '10%',
        'default' => true,
        'name' => 'delay',
      ),
      'task_type' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TASK_TYPE',
        'width' => '10%',
        'name' => 'task_type',
      ),
      'task_order' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_TASK_ORDER',
        'width' => '10%',
        'name' => 'task_order',
      ),
      'asol_activity_asol_task_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASOL_ACTIVITY_ASOL_TASK_FROM_ASOL_ACTIVITY_TITLE',
        'id' => 'ASOL_ACTIV5B86CTIVITY_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'asol_activity_asol_task_name',
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
