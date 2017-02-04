<?php
$module_name = 'asol_ProjectVersion';
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
      'version_number' => 
      array (
        'type' => 'int',
        'label' => 'LBL_VERSION_NUMBER',
        'width' => '10%',
        'default' => true,
        'name' => 'version_number',
      ),
      'json_gantt_tasks' => 
      array (
        'type' => 'text',
        'studio' => 'visible',
        'label' => 'LBL_JSON_GANTT_TASKS',
        'sortable' => false,
        'width' => '10%',
        'default' => true,
        'name' => 'json_gantt_tasks',
      ),
      'is_published' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_IS_PUBLISHED',
        'width' => '10%',
        'name' => 'is_published',
      ),
      'published_datetime' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_PUBLISHED_DATETIME',
        'width' => '10%',
        'default' => true,
        'name' => 'published_datetime',
      ),
      'asol_project_asol_projectversion_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
        'id' => 'ASOL_PROJECT_ASOL_PROJECTVERSIONASOL_PROJECT_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'asol_project_asol_projectversion_name',
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
