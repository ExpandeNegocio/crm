<?php 
 $GLOBALS["dictionary"]["asol_Activity"]=array (
  'table' => 'asol_activity',
  'audited' => true,
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'vname' => 'LBL_ID',
      'type' => 'id',
      'required' => true,
      'reportable' => true,
      'comment' => 'Unique identifier',
    ),
    'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_NAME',
      'type' => 'name',
      'link' => true,
      'dbType' => 'varchar',
      'len' => 255,
      'unified_search' => true,
      'full_text_search' => 
      array (
        'boost' => 3,
      ),
      'required' => true,
      'importable' => 'required',
      'duplicate_merge' => 'enabled',
      'merge_filter' => 'selected',
    ),
    'date_entered' => 
    array (
      'name' => 'date_entered',
      'vname' => 'LBL_DATE_ENTERED',
      'type' => 'datetime',
      'group' => 'created_by_name',
      'comment' => 'Date record created',
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'vname' => 'LBL_DATE_MODIFIED',
      'type' => 'datetime',
      'group' => 'modified_by_name',
      'comment' => 'Date record last modified',
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
    ),
    'modified_user_id' => 
    array (
      'name' => 'modified_user_id',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_MODIFIED',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'group' => 'modified_by_name',
      'dbType' => 'id',
      'reportable' => true,
      'comment' => 'User who last modified record',
      'massupdate' => false,
    ),
    'modified_by_name' => 
    array (
      'name' => 'modified_by_name',
      'vname' => 'LBL_MODIFIED_NAME',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'rname' => 'user_name',
      'table' => 'users',
      'id_name' => 'modified_user_id',
      'module' => 'Users',
      'link' => 'modified_user_link',
      'duplicate_merge' => 'disabled',
      'massupdate' => false,
    ),
    'created_by' => 
    array (
      'name' => 'created_by',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_CREATED',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'dbType' => 'id',
      'group' => 'created_by_name',
      'comment' => 'User who created record',
      'massupdate' => false,
    ),
    'created_by_name' => 
    array (
      'name' => 'created_by_name',
      'vname' => 'LBL_CREATED',
      'type' => 'relate',
      'reportable' => false,
      'link' => 'created_by_link',
      'rname' => 'user_name',
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'created_by',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
      'importable' => 'false',
      'massupdate' => false,
    ),
    'description' => 
    array (
      'name' => 'description',
      'vname' => 'LBL_DESCRIPTION',
      'type' => 'text',
      'comment' => 'Full text of the note',
      'rows' => 6,
      'cols' => 80,
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'vname' => 'LBL_DELETED',
      'type' => 'bool',
      'default' => '0',
      'reportable' => false,
      'comment' => 'Record deletion indicator',
    ),
    'created_by_link' => 
    array (
      'name' => 'created_by_link',
      'type' => 'link',
      'relationship' => 'asol_activity_created_by',
      'vname' => 'LBL_CREATED_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
    ),
    'modified_user_link' => 
    array (
      'name' => 'modified_user_link',
      'type' => 'link',
      'relationship' => 'asol_activity_modified_user',
      'vname' => 'LBL_MODIFIED_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
    ),
    'assigned_user_id' => 
    array (
      'name' => 'assigned_user_id',
      'rname' => 'user_name',
      'id_name' => 'assigned_user_id',
      'vname' => 'LBL_ASSIGNED_TO_ID',
      'group' => 'assigned_user_name',
      'type' => 'relate',
      'table' => 'users',
      'module' => 'Users',
      'reportable' => true,
      'isnull' => 'false',
      'dbType' => 'id',
      'audited' => true,
      'comment' => 'User ID assigned to record',
      'duplicate_merge' => 'disabled',
    ),
    'assigned_user_name' => 
    array (
      'name' => 'assigned_user_name',
      'link' => 'assigned_user_link',
      'vname' => 'LBL_ASSIGNED_TO_NAME',
      'rname' => 'user_name',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'assigned_user_id',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
    ),
    'assigned_user_link' => 
    array (
      'name' => 'assigned_user_link',
      'type' => 'link',
      'relationship' => 'asol_activity_assigned_user',
      'vname' => 'LBL_ASSIGNED_TO_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
      'duplicate_merge' => 'enabled',
      'rname' => 'user_name',
      'id_name' => 'assigned_user_id',
      'table' => 'users',
    ),
    'conditions' => 
    array (
      'required' => false,
      'name' => 'conditions',
      'vname' => 'LBL_CONDITIONS',
      'type' => 'text',
    ),
    'delay' => 
    array (
      'required' => false,
      'name' => 'delay',
      'vname' => 'LBL_DELAY',
      'type' => 'varchar',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => '255',
      'size' => '20',
    ),
    'type' => 
    array (
      'required' => false,
      'name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'enum',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => 100,
      'size' => '20',
      'options' => 'wfm_activity_type_list',
      'studio' => 'visible',
      'dependency' => false,
    ),
    'module_fields' => 
    array (
      'name' => 'module_fields',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_MODULE_FIELDS',
    ),
    'module_conditions' => 
    array (
      'name' => 'module_conditions',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_CONDITIONS',
    ),
    'trigger_module' => 
    array (
      'name' => 'trigger_module',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_TRIGGER_MODULE',
    ),
    'custom_variables' => 
    array (
      'name' => 'custom_variables',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_CUSTOM_VARIABLES',
    ),
    'asol_activity_asol_activity' => 
    array (
      'name' => 'asol_activity_asol_activity',
      'type' => 'link',
      'relationship' => 'asol_activity_asol_activity',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_L_TITLE',
    ),
    'asol_activity_asol_activity_name' => 
    array (
      'name' => 'asol_activity_asol_activity_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_L_TITLE',
      'save' => true,
      'id_name' => 'asol_activ898activity_ida',
      'link' => 'asol_activity_asol_activity',
      'table' => 'asol_activity',
      'module' => 'asol_Activity',
      'rname' => 'name',
    ),
    'asol_activ898activity_ida' => 
    array (
      'name' => 'asol_activ898activity_ida',
      'type' => 'link',
      'relationship' => 'asol_activity_asol_activity',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_R_TITLE',
    ),
    'asol_activity_asol_task' => 
    array (
      'name' => 'asol_activity_asol_task',
      'type' => 'link',
      'relationship' => 'asol_activity_asol_task',
      'source' => 'non-db',
      'side' => 'right',
      'vname' => 'LBL_ASOL_ACTIVITY_ASOL_TASK_FROM_ASOL_TASK_TITLE',
    ),
    'asol_events_asol_activity' => 
    array (
      'name' => 'asol_events_asol_activity',
      'type' => 'link',
      'relationship' => 'asol_events_asol_activity',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_EVENTS_TITLE',
    ),
    'asol_events_asol_activity_name' => 
    array (
      'name' => 'asol_events_asol_activity_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_EVENTS_TITLE',
      'save' => true,
      'id_name' => 'asol_event87f4_events_ida',
      'link' => 'asol_events_asol_activity',
      'table' => 'asol_events',
      'module' => 'asol_Events',
      'rname' => 'name',
    ),
    'asol_event87f4_events_ida' => 
    array (
      'name' => 'asol_event87f4_events_ida',
      'type' => 'link',
      'relationship' => 'asol_events_asol_activity',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_TITLE',
    ),
  ),
  'relationships' => 
  array (
    'asol_activity_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_Activity',
      'rhs_table' => 'asol_activity',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'asol_activity_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_Activity',
      'rhs_table' => 'asol_activity',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'asol_activity_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_Activity',
      'rhs_table' => 'asol_activity',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'optimistic_locking' => true,
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'asol_activitypk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
  ),
  'templates' => 
  array (
    'assignable' => 'assignable',
    'basic' => 'basic',
  ),
  'custom_fields' => false,
);