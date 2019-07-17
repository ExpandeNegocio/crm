<?php 
 $GLOBALS["dictionary"]["EmailTemplate"]=array (
  'table' => 'email_templates',
  'comment' => 'Templates used in email processing',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'vname' => 'LBL_ID',
      'type' => 'id',
      'required' => true,
      'reportable' => false,
      'comment' => 'Unique identifier',
    ),
    'date_entered' => 
    array (
      'name' => 'date_entered',
      'vname' => 'LBL_DATE_ENTERED',
      'type' => 'datetime',
      'required' => true,
      'comment' => 'Date record created',
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'vname' => 'LBL_DATE_MODIFIED',
      'type' => 'datetime',
      'required' => true,
      'comment' => 'Date record last modified',
    ),
    'modified_user_id' => 
    array (
      'name' => 'modified_user_id',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_ASSIGNED_TO',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'reportable' => true,
      'isnull' => 'false',
      'dbType' => 'id',
      'comment' => 'User who last modified record',
    ),
    'created_by' => 
    array (
      'name' => 'created_by',
      'vname' => 'LBL_CREATED_BY',
      'type' => 'varchar',
      'len' => '36',
      'comment' => 'User who created record',
    ),
    'published' => 
    array (
      'name' => 'published',
      'vname' => 'LBL_PUBLISHED',
      'type' => 'varchar',
      'len' => '3',
      'comment' => '',
    ),
    'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_NAME',
      'type' => 'varchar',
      'len' => '255',
      'comment' => 'Email template name',
      'importable' => 'required',
      'required' => true,
    ),
    'description' => 
    array (
      'name' => 'description',
      'vname' => 'LBL_DESCRIPTION',
      'type' => 'text',
      'comment' => 'Email template description',
    ),
    'subject' => 
    array (
      'name' => 'subject',
      'vname' => 'LBL_SUBJECT',
      'type' => 'varchar',
      'len' => '255',
      'comment' => 'Email subject to be used in resulting email',
    ),
    'body' => 
    array (
      'name' => 'body',
      'vname' => 'LBL_BODY',
      'type' => 'text',
      'comment' => 'Plain text body to be used in resulting email',
    ),
    'body_html' => 
    array (
      'name' => 'body_html',
      'vname' => 'LBL_PLAIN_TEXT',
      'type' => 'html',
      'comment' => 'HTML formatted email body to be used in resulting email',
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'vname' => 'LBL_DELETED',
      'type' => 'bool',
      'required' => false,
      'reportable' => false,
      'comment' => 'Record deletion indicator',
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
      'relationship' => 'emailtemplates_assigned_user',
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
    'text_only' => 
    array (
      'name' => 'text_only',
      'vname' => 'LBL_TEXT_ONLY',
      'type' => 'bool',
      'required' => false,
      'reportable' => false,
      'comment' => 'Should be checked if email template is to be sent in text only',
    ),
    'type' => 
    array (
      'name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'enum',
      'required' => false,
      'reportable' => false,
      'options' => 'emailTemplates_type_list',
      'comment' => 'Type of the email template',
    ),
    'franquicia' => 
    array (
      'required' => false,
      'name' => 'franquicia',
      'vname' => 'LBL_FRANQUICIA',
      'type' => 'enum',
      'massupdate' => '1',
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
      'len' => 100,
      'size' => '20',
      'options' => 'franquicia_list',
      'studio' => 'visible',
      'dependency' => false,
    ),
    'modeloneg' => 
    array (
      'required' => false,
      'name' => 'modeloneg',
      'vname' => 'LBL_MODELO_NEGOCIO',
      'type' => 'enum',
      'massupdate' => '1',
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
      'len' => 100,
      'size' => '20',
      'options' => 'modelo_negocio_list',
      'studio' => 'visible',
      'dependency' => false,
    ),
    'revisedby_user_id' => 
    array (
      'name' => 'revisedby_user_id',
      'rname' => 'user_name',
      'id_name' => 'revisedby_user_id',
      'vname' => 'LBL_REVISEDBY_TO_ID',
      'group' => 'revisedby_user_name',
      'type' => 'relate',
      'table' => 'users',
      'module' => 'Users',
      'reportable' => true,
      'isnull' => 'false',
      'dbType' => 'id',
      'audited' => true,
      'duplicate_merge' => 'disabled',
    ),
    'revisedby_user_name' => 
    array (
      'name' => 'revisedby_user_name',
      'link' => 'revisedby_user_link',
      'vname' => 'LBL_REVISEDBY_TO_NAME',
      'rname' => 'user_name',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'revisedby_user_id',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
    ),
    'revisedby_user_link' => 
    array (
      'name' => 'revisedby_user_link',
      'type' => 'link',
      'relationship' => 'emailtemplates_revisedby_user',
      'vname' => 'LBL_REVISEDBY_TO_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
      'duplicate_merge' => 'enabled',
      'rname' => 'user_name',
      'id_name' => 'revisedby_user_id',
      'table' => 'users',
    ),
    'f_revision' => 
    array (
      'required' => false,
      'name' => 'f_revision',
      'vname' => 'LBL_F_REVISION',
      'type' => 'date',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'size' => '20',
      'enable_range_search' => false,
      'display_default' => 'now',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'email_templatespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_email_template_name',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'name',
      ),
    ),
  ),
  'relationships' => 
  array (
    'emailtemplates_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'EmailTemplates',
      'rhs_table' => 'email_templates',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'emailtemplates_revisedby_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'EmailTemplates',
      'rhs_table' => 'email_templates',
      'rhs_key' => 'revisedby_user_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'custom_fields' => false,
);