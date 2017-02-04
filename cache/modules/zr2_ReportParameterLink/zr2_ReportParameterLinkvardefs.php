<?php 
 $GLOBALS["dictionary"]["zr2_ReportParameterLink"]=array (
  'table' => 'zr2_reportparameterlink',
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
      'relationship' => 'zr2_reportparameterlink_created_by',
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
      'relationship' => 'zr2_reportparameterlink_modified_user',
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
      'relationship' => 'zr2_reportparameterlink_assigned_user',
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
    'default_value' => 
    array (
      'name' => 'default_value',
      'vname' => 'LBL_PARAM_LINK_DEFAULTVALUE',
      'required' => false,
      'type' => 'varchar',
      'len' => 255,
    ),
    'bind_to_module_name' => 
    array (
      'name' => 'bind_to_module_name',
      'vname' => 'LBL_PARAM_LINK_MODULENAME',
      'required' => false,
      'type' => 'varchar',
      'len' => 255,
    ),
    'friendly_name' => 
    array (
      'name' => 'friendly_name',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_PARAM_LINK_PARAM',
    ),
    'range_description' => 
    array (
      'name' => 'range_description',
      'type' => 'varchar',
      'source' => 'non-db',
      'vname' => 'LBL_PARAM_LINK_RANGE',
    ),
    'zr2_reportparameterlink_zr2_querytemplate' => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_querytemplate',
      'type' => 'link',
      'relationship' => 'zr2_reportparameterlink_zr2_querytemplate',
      'source' => 'non-db',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_QUERYTEMPLATE_TITLE',
      'id_name' => 'zr2_query313cemplate_ida',
    ),
    'zr2_reportparameterlink_zr2_querytemplate_name' => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_querytemplate_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_QUERYTEMPLATE_TITLE',
      'save' => true,
      'id_name' => 'zr2_query313cemplate_ida',
      'link' => 'zr2_reportparameterlink_zr2_querytemplate',
      'table' => 'zr2_querytemplate',
      'module' => 'zr2_QueryTemplate',
      'rname' => 'name',
    ),
    'zr2_query313cemplate_ida' => 
    array (
      'name' => 'zr2_query313cemplate_ida',
      'type' => 'link',
      'relationship' => 'zr2_reportparameterlink_zr2_querytemplate',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_REPORTPARAMETERLINK_TITLE',
    ),
    'zr2_reportparameterlink_zr2_reportparameter' => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_reportparameter',
      'type' => 'link',
      'relationship' => 'zr2_reportparameterlink_zr2_reportparameter',
      'source' => 'non-db',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETER_TITLE',
      'id_name' => 'zr2_report29aerameter_ida',
    ),
    'zr2_reportparameterlink_zr2_reportparameter_name' => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_reportparameter_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETER_TITLE',
      'save' => true,
      'id_name' => 'zr2_report29aerameter_ida',
      'link' => 'zr2_reportparameterlink_zr2_reportparameter',
      'table' => 'zr2_reportparameter',
      'module' => 'zr2_ReportParameter',
      'rname' => 'name',
    ),
    'zr2_report29aerameter_ida' => 
    array (
      'name' => 'zr2_report29aerameter_ida',
      'type' => 'link',
      'relationship' => 'zr2_reportparameterlink_zr2_reportparameter',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETERLINK_TITLE',
    ),
    'zr2_reportparameterlink_zr2_reporttemplate' => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_reporttemplate',
      'type' => 'link',
      'relationship' => 'zr2_reportparameterlink_zr2_reporttemplate',
      'source' => 'non-db',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTTEMPLATE_TITLE',
      'id_name' => 'zr2_report313cemplate_ida',
    ),
    'zr2_reportparameterlink_zr2_reporttemplate_name' => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_reporttemplate_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTTEMPLATE_TITLE',
      'save' => true,
      'id_name' => 'zr2_report313cemplate_ida',
      'link' => 'zr2_reportparameterlink_zr2_reporttemplate',
      'table' => 'zr2_reporttemplate',
      'module' => 'zr2_ReportTemplate',
      'rname' => 'name',
    ),
    'zr2_report313cemplate_ida' => 
    array (
      'name' => 'zr2_report313cemplate_ida',
      'type' => 'link',
      'relationship' => 'zr2_reportparameterlink_zr2_reporttemplate',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTPARAMETERLINK_TITLE',
    ),
  ),
  'relationships' => 
  array (
    'zr2_reportparameterlink_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'zr2_ReportParameterLink',
      'rhs_table' => 'zr2_reportparameterlink',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'zr2_reportparameterlink_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'zr2_ReportParameterLink',
      'rhs_table' => 'zr2_reportparameterlink',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'zr2_reportparameterlink_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'zr2_ReportParameterLink',
      'rhs_table' => 'zr2_reportparameterlink',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'zr2_reportparameterlinkpk',
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