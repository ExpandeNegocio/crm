<?php 
 $GLOBALS["dictionary"]["asol_ProjectVersion"]=array (
  'table' => 'asol_projectversion',
  'audited' => true,
  'duplicate_merge' => true,
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
      'relationship' => 'asol_projectversion_created_by',
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
      'relationship' => 'asol_projectversion_modified_user',
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
      'relationship' => 'asol_projectversion_assigned_user',
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
    'version_number' => 
    array (
      'name' => 'version_number',
      'vname' => 'LBL_VERSION_NUMBER',
      'type' => 'int',
      'readonly' => true,
      'len' => 11,
      'required' => true,
      'unified_search' => true,
      'full_text_search' => 
      array (
        'boost' => 3,
      ),
      'comment' => 'Visual unique identifier',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
      'studio' => 
      array (
        'quickcreate' => false,
      ),
    ),
    'json_gantt_tasks' => 
    array (
      'required' => false,
      'name' => 'json_gantt_tasks',
      'vname' => 'LBL_JSON_GANTT_TASKS',
      'type' => 'text',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'size' => '20',
      'studio' => 'visible',
      'rows' => '4',
      'cols' => '20',
    ),
    'is_published' => 
    array (
      'required' => false,
      'name' => 'is_published',
      'vname' => 'LBL_IS_PUBLISHED',
      'type' => 'bool',
      'massupdate' => 0,
      'default' => '0',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
    ),
    'published_datetime' => 
    array (
      'required' => false,
      'name' => 'published_datetime',
      'vname' => 'LBL_PUBLISHED_DATETIME',
      'type' => 'datetimecombo',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'size' => '20',
      'enable_range_search' => false,
      'dbType' => 'datetime',
    ),
    'user_id_c' => 
    array (
      'required' => false,
      'name' => 'user_id_c',
      'vname' => 'LBL_CURRENT_EDITOR_USER_ID',
      'type' => 'id',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => 0,
      'audited' => false,
      'reportable' => false,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 36,
      'size' => '20',
    ),
    'current_editor' => 
    array (
      'required' => false,
      'source' => 'non-db',
      'name' => 'current_editor',
      'vname' => 'LBL_CURRENT_EDITOR',
      'type' => 'relate',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'id_name' => 'user_id_c',
      'ext2' => 'Users',
      'module' => 'Users',
      'rname' => 'name',
      'quicksearch' => 'enabled',
      'studio' => 'visible',
    ),
    'last_editor_call' => 
    array (
      'required' => false,
      'name' => 'last_editor_call',
      'vname' => 'LBL_LAST_EDITOR_CALL',
      'type' => 'datetimecombo',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'size' => '20',
      'enable_range_search' => false,
      'dbType' => 'datetime',
    ),
    'wiki_link' => 
    array (
      'required' => false,
      'name' => 'wiki_link',
      'vname' => 'LBL_WIKI_LINK',
      'type' => 'url',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'dbType' => 'varchar',
      'gen' => '',
      'link_target' => '_self',
    ),
    'wiki_link_alias' => 
    array (
      'required' => false,
      'name' => 'wiki_link_alias',
      'vname' => 'LBL_WIKI_LINK_ALIAS',
      'type' => 'url',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'dbType' => 'varchar',
      'gen' => '',
      'link_target' => '_self',
    ),
    'log' => 
    array (
      'required' => false,
      'name' => 'log',
      'vname' => 'LBL_LOG',
      'type' => 'text',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'size' => '20',
      'studio' => 'visible',
      'rows' => '4',
      'cols' => '20',
    ),
    'type' => 
    array (
      'required' => false,
      'name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'enum',
      'massupdate' => 0,
      'default' => 'start',
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => 100,
      'size' => '20',
      'options' => 'asol_projectversion_type_list',
      'studio' => 'visible',
      'dependency' => false,
    ),
    'jquery_gantt' => 
    array (
      'name' => 'jquery_gantt',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_JQUERY_GANTT',
    ),
    'asol_project_asol_projectversion' => 
    array (
      'name' => 'asol_project_asol_projectversion',
      'type' => 'link',
      'relationship' => 'asol_project_asol_projectversion',
      'source' => 'non-db',
      'module' => 'asol_Project',
      'bean_name' => 'asol_Project',
      'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
      'id_name' => 'asol_project_asol_projectversionasol_project_ida',
    ),
    'asol_project_asol_projectversion_name' => 
    array (
      'name' => 'asol_project_asol_projectversion_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
      'save' => true,
      'id_name' => 'asol_project_asol_projectversionasol_project_ida',
      'link' => 'asol_project_asol_projectversion',
      'table' => 'asol_project',
      'module' => 'asol_Project',
      'rname' => 'name',
    ),
    'asol_project_asol_projectversionasol_project_ida' => 
    array (
      'name' => 'asol_project_asol_projectversionasol_project_ida',
      'type' => 'link',
      'relationship' => 'asol_project_asol_projectversion',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECTVERSION_TITLE',
    ),
  ),
  'relationships' => 
  array (
    'asol_projectversion_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_ProjectVersion',
      'rhs_table' => 'asol_projectversion',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'asol_projectversion_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_ProjectVersion',
      'rhs_table' => 'asol_projectversion',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'asol_projectversion_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_ProjectVersion',
      'rhs_table' => 'asol_projectversion',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'optimistic_locking' => true,
  'unified_search' => true,
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'asol_projectversionpk',
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