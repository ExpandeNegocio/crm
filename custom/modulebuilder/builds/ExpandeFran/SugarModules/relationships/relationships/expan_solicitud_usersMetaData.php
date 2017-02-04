<?php
// created: 2014-07-31 19:38:10
$dictionary["expan_solicitud_users"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'expan_solicitud_users' => 
    array (
      'lhs_module' => 'Expan_Solicitud',
      'lhs_table' => 'expan_solicitud',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_solicitud_users_c',
      'join_key_lhs' => 'expan_solicitud_usersexpan_solicitud_ida',
      'join_key_rhs' => 'expan_solicitud_usersusers_idb',
    ),
  ),
  'table' => 'expan_solicitud_users_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'expan_solicitud_usersexpan_solicitud_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expan_solicitud_usersusers_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_solicitud_usersspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_solicitud_users_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expan_solicitud_usersexpan_solicitud_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'expan_solicitud_users_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'expan_solicitud_usersusers_idb',
      ),
    ),
  ),
);