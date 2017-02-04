<?php
// created: 2014-02-26 13:28:27
$dictionary["asol_project_users"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'asol_project_users' => 
    array (
      'lhs_module' => 'asol_Project',
      'lhs_table' => 'asol_project',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'asol_project_users_c',
      'join_key_lhs' => 'asol_project_usersasol_project_ida',
      'join_key_rhs' => 'asol_project_usersusers_idb',
    ),
  ),
  'table' => 'asol_project_users_c',
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
      'name' => 'asol_project_usersasol_project_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'asol_project_usersusers_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'asol_project_usersspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'asol_project_users_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'asol_project_usersasol_project_ida',
        1 => 'asol_project_usersusers_idb',
      ),
    ),
  ),
);