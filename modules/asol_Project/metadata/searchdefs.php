<?php
$module_name = 'asol_Project';
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
      'assigned_user_name' => 
      array (
        'link' => true,
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_ASSIGNED_TO_NAME',
        'id' => '_ID1_C',
        'width' => '10%',
        'default' => true,
        'name' => 'assigned_user_name',
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
      'priority' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PRIORITY',
        'width' => '10%',
        'name' => 'priority',
      ),
      'log' => 
      array (
        'type' => 'text',
        'studio' => 'visible',
        'label' => 'LBL_LOG',
        'sortable' => false,
        'width' => '10%',
        'default' => true,
        'name' => 'log',
      ),
      'working_version' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_WORKING_VERSION',
        'id' => 'ASOL_PROJECTVERSION_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'working_version',
      ),
      'last_published_version' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_LAST_PUBLISHED_VERSION',
        'id' => 'ASOL_PROJECTVERSION_ID1_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'last_published_version',
      ),
      'asol_release_asol_project_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASOL_RELEASE_ASOL_PROJECT_FROM_ASOL_RELEASE_TITLE',
        'id' => 'ASOL_RELEASE_ASOL_PROJECTASOL_RELEASE_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'asol_release_asol_project_name',
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
