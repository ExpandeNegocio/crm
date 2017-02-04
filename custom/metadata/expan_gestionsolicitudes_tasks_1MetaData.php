<?php
// created: 2014-08-01 19:44:14
$dictionary["expan_gestionsolicitudes_tasks_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'expan_gestionsolicitudes_tasks_1' => 
    array (
      'lhs_module' => 'Expan_GestionSolicitudes',
      'lhs_table' => 'expan_gestionsolicitudes',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_gestionsolicitudes_tasks_1_c',
      'join_key_lhs' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
      'join_key_rhs' => 'expan_gestionsolicitudes_tasks_1tasks_idb',
    ),
  ),
  'table' => 'expan_gestionsolicitudes_tasks_1_c',
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
      'name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1tasks_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'expan_gestionsolicitudes_tasks_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'expan_gestionsolicitudes_tasks_1tasks_idb',
      ),
    ),
  ),
);