<?php 
 $GLOBALS["dictionary"]["Task"]=array (
  'table' => 'tasks',
  'audited' => true,
  'unified_search' => true,
  'full_text_search' => true,
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
      'vname' => 'LBL_SUBJECT',
      'dbType' => 'varchar',
      'type' => 'name',
      'len' => '50',
      'unified_search' => true,
      'full_text_search' => 
      array (
        'boost' => 3,
      ),
      'importable' => 'required',
      'required' => 'true',
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
      'relationship' => 'tasks_created_by',
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
      'relationship' => 'tasks_modified_user',
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
      'relationship' => 'tasks_assigned_user',
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
    'status' => 
    array (
      'name' => 'status',
      'vname' => 'LBL_STATUS',
      'type' => 'enum',
      'options' => 'task_status_dom',
      'audited' => true,
      'len' => 100,
      'required' => 'true',
      'default' => 'Not Started',
    ),
    'date_due_flag' => 
    array (
      'name' => 'date_due_flag',
      'vname' => 'LBL_DATE_DUE_FLAG',
      'type' => 'bool',
      'default' => 0,
      'group' => 'date_due',
      'studio' => false,
    ),
    'date_due' => 
    array (
      'name' => 'date_due',
      'vname' => 'LBL_DUE_DATE',
      'type' => 'datetimecombo',
      'dbType' => 'datetime',
      'group' => 'date_due',
      'studio' => 
      array (
        'required' => true,
        'no_duplicate' => true,
      ),
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
    ),
    'time_due' => 
    array (
      'name' => 'time_due',
      'vname' => 'LBL_DUE_TIME',
      'type' => 'datetime',
      'source' => 'non-db',
      'importable' => 'false',
      'massupdate' => false,
    ),
    'date_start_flag' => 
    array (
      'name' => 'date_start_flag',
      'vname' => 'LBL_DATE_START_FLAG',
      'type' => 'bool',
      'group' => 'date_start',
      'default' => 0,
      'studio' => false,
    ),
    'date_start' => 
    array (
      'name' => 'date_start',
      'vname' => 'LBL_START_DATE',
      'type' => 'datetimecombo',
      'dbType' => 'datetime',
      'group' => 'date_start',
      'audited' => true,
      'validation' => 
      array (
        'type' => 'isbefore',
        'compareto' => 'date_due',
        'blank' => false,
      ),
      'studio' => 
      array (
        'required' => true,
        'no_duplicate' => true,
      ),
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
    ),
    'parent_type' => 
    array (
      'name' => 'parent_type',
      'vname' => 'LBL_PARENT_NAME',
      'type' => 'parent_type',
      'dbType' => 'varchar',
      'group' => 'parent_name',
      'options' => 'parent_type_display',
      'required' => false,
      'len' => '255',
      'comment' => 'The Sugar object to which the call is related',
    ),
    'parent_name' => 
    array (
      'name' => 'parent_name',
      'parent_type' => 'record_type_display',
      'type_name' => 'parent_type',
      'id_name' => 'parent_id',
      'vname' => 'LBL_LIST_RELATED_TO',
      'type' => 'parent',
      'group' => 'parent_name',
      'source' => 'non-db',
      'options' => 'parent_type_display',
    ),
    'parent_id' => 
    array (
      'name' => 'parent_id',
      'type' => 'id',
      'group' => 'parent_name',
      'audited' => true,
      'reportable' => false,
      'vname' => 'LBL_PARENT_ID',
    ),
    'contact_id' => 
    array (
      'name' => 'contact_id',
      'type' => 'id',
      'group' => 'contact_name',
      'audited' => true,
      'reportable' => false,
      'vname' => 'LBL_CONTACT_ID',
    ),
    'prioridad' => 
    array (
      'name' => 'prioridad',
      'vname' => 'LBL_PRIORIDAD',
      'type' => 'int',
      'len' => '3',
      'default' => 'Media',
      'comment' => 'Prioridad de la Tarea',
    ),
    'contact_name' => 
    array (
      'name' => 'contact_name',
      'rname' => 'name',
      'db_concat_fields' => 
      array (
        0 => 'first_name',
        1 => 'last_name',
      ),
      'source' => 'non-db',
      'len' => '510',
      'group' => 'contact_name',
      'vname' => 'LBL_CONTACT_NAME',
      'reportable' => false,
      'id_name' => 'contact_id',
      'join_name' => 'contacts',
      'type' => 'relate',
      'module' => 'Contacts',
      'link' => 'contacts',
      'table' => 'contacts',
    ),
    'contact_phone' => 
    array (
      'name' => 'contact_phone',
      'type' => 'phone',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACT_PHONE',
      'studio' => 
      array (
        'listview' => true,
      ),
    ),
    'contact_email' => 
    array (
      'name' => 'contact_email',
      'type' => 'varchar',
      'vname' => 'LBL_EMAIL_ADDRESS',
      'source' => 'non-db',
      'studio' => false,
    ),
    'priority' => 
    array (
      'name' => 'priority',
      'vname' => 'LBL_PRIORITY',
      'type' => 'enum',
      'options' => 'task_priority_dom',
      'audited' => true,
      'len' => 100,
      'required' => 'true',
    ),
    'contacts' => 
    array (
      'name' => 'contacts',
      'type' => 'link',
      'relationship' => 'contact_tasks',
      'source' => 'non-db',
      'side' => 'right',
      'vname' => 'LBL_CONTACT',
    ),
    'accounts' => 
    array (
      'name' => 'accounts',
      'type' => 'link',
      'relationship' => 'account_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_ACCOUNT',
    ),
    'opportunities' => 
    array (
      'name' => 'opportunities',
      'type' => 'link',
      'relationship' => 'opportunity_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_OPPORTUNITY',
    ),
    'cases' => 
    array (
      'name' => 'cases',
      'type' => 'link',
      'relationship' => 'case_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_CASE',
    ),
    'bugs' => 
    array (
      'name' => 'bugs',
      'type' => 'link',
      'relationship' => 'bug_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_BUGS',
    ),
    'leads' => 
    array (
      'name' => 'leads',
      'type' => 'link',
      'relationship' => 'lead_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_LEADS',
    ),
    'projects' => 
    array (
      'name' => 'projects',
      'type' => 'link',
      'relationship' => 'projects_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_PROJECTS',
    ),
    'project_tasks' => 
    array (
      'name' => 'project_tasks',
      'type' => 'link',
      'relationship' => 'project_tasks_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_PROJECT_TASKS',
    ),
    'notes' => 
    array (
      'name' => 'notes',
      'type' => 'link',
      'relationship' => 'tasks_notes',
      'module' => 'Notes',
      'bean_name' => 'Note',
      'source' => 'non-db',
      'vname' => 'LBL_NOTES',
    ),
    'contact_parent' => 
    array (
      'name' => 'contact_parent',
      'type' => 'link',
      'relationship' => 'contact_tasks_parent',
      'source' => 'non-db',
      'reportable' => false,
    ),
    'task_type' => 
    array (
      'name' => 'task_type',
      'vname' => 'LBL_TASK_TYPE',
      'type' => 'enum',
      'len' => 100,
      'options' => 'tipo_tarea_list',
      'comment' => 'Tipo de la tarea',
      'required' => true,
      'audited' => true,
      'importable' => 'required',
    ),
    'oportunidad_inmediata' => 
    array (
      'required' => false,
      'name' => 'oportunidad_inmediata',
      'vname' => 'LBL_OPORTUNIDAD_INMEDIATA',
      'type' => 'bool',
      'massupdate' => 1,
      'default' => '0',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'size' => '10',
    ),
    'ERM_tasks_id' => 
    array (
      'name' => 'ERM_tasks_id',
      'type' => 'id',
      'group' => 'contact_name',
      'audited' => true,
      'reportable' => false,
    ),
    'fran_type' => 
    array (
      'name' => 'fran_type',
      'vname' => 'Tipo',
      'type' => 'varchar',
      'len' => '255',
      'source' => 'non-db',
    ),
    'asol_projecttask_activities_tasks' => 
    array (
      'name' => 'asol_projecttask_activities_tasks',
      'type' => 'link',
      'relationship' => 'asol_projecttask_activities_tasks',
      'source' => 'non-db',
      'module' => 'asol_ProjectTask',
      'bean_name' => false,
      'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_TASKS_FROM_ASOL_PROJECTTASK_TITLE',
    ),
    'asol_project_activities_tasks' => 
    array (
      'name' => 'asol_project_activities_tasks',
      'type' => 'link',
      'relationship' => 'asol_project_activities_tasks',
      'source' => 'non-db',
      'module' => 'asol_Project',
      'bean_name' => false,
      'vname' => 'LBL_ASOL_PROJECT_ACTIVITIES_TASKS_FROM_ASOL_PROJECT_TITLE',
    ),
    'expan_franquicia_tasks_1' => 
    array (
      'name' => 'expan_franquicia_tasks_1',
      'type' => 'link',
      'relationship' => 'expan_franquicia_tasks_1',
      'source' => 'non-db',
      'module' => 'Expan_Franquicia',
      'bean_name' => 'Expan_Franquicia',
      'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_EXPAN_FRANQUICIA_TITLE',
      'id_name' => 'expan_franquicia_tasks_1expan_franquicia_ida',
    ),
    'expan_franquicia_tasks_1_name' => 
    array (
      'name' => 'expan_franquicia_tasks_1_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_EXPAN_FRANQUICIA_TITLE',
      'save' => true,
      'id_name' => 'expan_franquicia_tasks_1expan_franquicia_ida',
      'link' => 'expan_franquicia_tasks_1',
      'table' => 'expan_franquicia',
      'module' => 'Expan_Franquicia',
      'rname' => 'name',
    ),
    'expan_franquicia_tasks_1expan_franquicia_ida' => 
    array (
      'name' => 'expan_franquicia_tasks_1expan_franquicia_ida',
      'type' => 'link',
      'relationship' => 'expan_franquicia_tasks_1',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_TASKS_TITLE',
    ),
    'expan_gestionsolicitudes_activities_1_tasks' => 
    array (
      'name' => 'expan_gestionsolicitudes_activities_1_tasks',
      'type' => 'link',
      'relationship' => 'expan_gestionsolicitudes_activities_1_tasks',
      'source' => 'non-db',
      'module' => 'Expan_GestionSolicitudes',
      'bean_name' => 'Expan_GestionSolicitudes',
      'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_ACTIVITIES_1_TASKS_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
    ),
    'expan_gestionsolicitudes_tasks_1' => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1',
      'type' => 'link',
      'relationship' => 'expan_gestionsolicitudes_tasks_1',
      'source' => 'non-db',
      'module' => 'Expan_GestionSolicitudes',
      'bean_name' => 'Expan_GestionSolicitudes',
      'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
      'id_name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
    ),
    'expan_gestionsolicitudes_tasks_1_name' => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
      'save' => true,
      'id_name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
      'link' => 'expan_gestionsolicitudes_tasks_1',
      'table' => 'expan_gestionsolicitudes',
      'module' => 'Expan_GestionSolicitudes',
      'rname' => 'name',
    ),
    'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida' => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
      'type' => 'link',
      'relationship' => 'expan_gestionsolicitudes_tasks_1',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_TASKS_TITLE',
    ),
  ),
  'relationships' => 
  array (
    'tasks_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'tasks_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'tasks_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'tasks_notes' => 
    array (
      'lhs_module' => 'Tasks',
      'lhs_table' => 'tasks',
      'lhs_key' => 'id',
      'rhs_module' => 'Notes',
      'rhs_table' => 'notes',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'taskspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    0 => 
    array (
      'name' => 'idx_tsk_name',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'name',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_task_con_del',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'contact_id',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_task_par_del',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'parent_id',
        1 => 'parent_type',
        2 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'idx_task_assigned',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'assigned_user_id',
      ),
    ),
    4 => 
    array (
      'name' => 'idx_task_status',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'status',
      ),
    ),
  ),
  'optimistic_locking' => true,
  'templates' => 
  array (
    'assignable' => 'assignable',
    'basic' => 'basic',
  ),
  'custom_fields' => false,
);