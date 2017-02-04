<?php
// created: 2014-07-31 19:38:11
$dictionary["User"]["fields"]["expan_solicitud_users"] = array (
  'name' => 'expan_solicitud_users',
  'type' => 'link',
  'relationship' => 'expan_solicitud_users',
  'source' => 'non-db',
  'module' => 'Expan_Solicitud',
  'bean_name' => 'Expan_Solicitud',
  'vname' => 'LBL_EXPAN_SOLICITUD_USERS_FROM_EXPAN_SOLICITUD_TITLE',
  'id_name' => 'expan_solicitud_usersexpan_solicitud_ida',
);
$dictionary["User"]["fields"]["expan_solicitud_users_name"] = array (
  'name' => 'expan_solicitud_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_SOLICITUD_USERS_FROM_EXPAN_SOLICITUD_TITLE',
  'save' => true,
  'id_name' => 'expan_solicitud_usersexpan_solicitud_ida',
  'link' => 'expan_solicitud_users',
  'table' => 'expan_solicitud',
  'module' => 'Expan_Solicitud',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["User"]["fields"]["expan_solicitud_usersexpan_solicitud_ida"] = array (
  'name' => 'expan_solicitud_usersexpan_solicitud_ida',
  'type' => 'link',
  'relationship' => 'expan_solicitud_users',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_USERS_FROM_USERS_TITLE',
);
