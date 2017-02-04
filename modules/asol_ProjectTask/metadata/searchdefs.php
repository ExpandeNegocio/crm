<?php
$module_name = 'asol_ProjectTask';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
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
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'date_modified' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_modified',
      ),
      'modified_user_id' => 
      array (
        'type' => 'assigned_user_name',
        'label' => 'LBL_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'modified_user_id',
      ),
      'created_by' => 
      array (
        'type' => 'assigned_user_name',
        'label' => 'LBL_CREATED',
        'width' => '10%',
        'default' => true,
        'name' => 'created_by',
      ),
      'description' => 
      array (
        'type' => 'text',
        'label' => 'LBL_DESCRIPTION',
        'sortable' => false,
        'width' => '10%',
        'default' => true,
        'name' => 'description',
      ),
      'date_start' => 
      array (
        'type' => 'date',
        'label' => 'LBL_DATE_START',
        'width' => '10%',
        'default' => true,
        'name' => 'date_start',
      ),
      'date_end' => 
      array (
        'type' => 'date',
        'label' => 'LBL_DATE_END',
        'width' => '10%',
        'default' => true,
        'name' => 'date_end',
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
      'start_is_milestone' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_START_IS_MILESTONE',
        'width' => '10%',
        'name' => 'start_is_milestone',
      ),
      'end_is_milestone' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_END_IS_MILESTONE',
        'width' => '10%',
        'name' => 'end_is_milestone',
      ),
      'dependencies' => 
      array (
        'type' => 'text',
        'studio' => 'visible',
        'label' => 'LBL_DEPENDENCIES',
        'sortable' => false,
        'width' => '10%',
        'default' => true,
        'name' => 'dependencies',
      ),
      'task_order' => 
      array (
        'type' => 'int',
        'label' => 'LBL_TASK_ORDER',
        'width' => '10%',
        'default' => true,
        'name' => 'task_order',
      ),
      'duration' => 
      array (
        'type' => 'decimal',
        'label' => 'LBL_DURATION',
        'width' => '10%',
        'default' => true,
        'name' => 'duration',
      ),
      'progress' => 
      array (
        'type' => 'int',
        'label' => 'LBL_PROGRESS',
        'width' => '10%',
        'default' => true,
        'name' => 'progress',
      ),
      'asol_project_asol_projecttask_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASOL_PROJECT_ASOL_PROJECTTASK_FROM_ASOL_PROJECT_TITLE',
        'id' => 'ASOL_PROJECT_ASOL_PROJECTTASKASOL_PROJECT_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'asol_project_asol_projecttask_name',
      ),
      'current_user_only' => 
      array (
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'width' => '10%',
        'default' => true,
        'name' => 'current_user_only',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
