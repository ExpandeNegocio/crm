<?php
$module_name = 'asol_WorkingNodes';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'status' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
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
      'status' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'process_instance_id' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROCESS_INSTANCE_ID',
        'id' => 'ASOL_PROCESSINSTANCES_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'process_instance_id',
      ),
      'priority' => 
      array (
        'type' => 'int',
        'label' => 'LBL_PRIORITY',
        'width' => '10%',
        'default' => true,
        'name' => 'priority',
      ),
      'event' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_EVENT',
        'id' => 'ASOL_EVENTS_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'event',
      ),
      'current_activity' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_CURRENT_ACTIVITY',
        'id' => 'ASOL_ACTIVITY_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'current_activity',
      ),
      'current_task' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_CURRENT_TASK',
        'id' => 'ASOL_TASK_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'current_task',
      ),
      'delay_wakeup_time' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DELAY_WAKEUP_TIME',
        'width' => '10%',
        'default' => true,
        'name' => 'delay_wakeup_time',
      ),
      'parent_type' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TRIGGER_MODULE',
        'width' => '10%',
        'name' => 'parent_type',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'label' => 'LBL_EXECUTING_OBJECT',
        'link' => true,
        'sortable' => false,
        'ACLTag' => 'PARENT',
        'dynamic_module' => 'PARENT_TYPE',
        'id' => 'PARENT_ID',
        'related_fields' => 
        array (
          0 => 'parent_id',
          1 => 'parent_type',
        ),
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
      ),
      'iter_object' => 
      array (
        'type' => 'int',
        'label' => 'LBL_ITER_OBJECT',
        'width' => '10%',
        'default' => true,
        'name' => 'iter_object',
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
