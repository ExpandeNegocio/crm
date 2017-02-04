<?php
// created: 2014-03-28 12:34:39
$dictionary["asol_project_asol_projectversion"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'asol_project_asol_projectversion' => 
    array (
      'lhs_module' => 'asol_Project',
      'lhs_table' => 'asol_project',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_ProjectVersion',
      'rhs_table' => 'asol_projectversion',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'asol_project_asol_projectversion_c',
      'join_key_lhs' => 'asol_project_asol_projectversionasol_project_ida',
      'join_key_rhs' => 'asol_project_asol_projectversionasol_projectversion_idb',
    ),
  ),
  'table' => 'asol_project_asol_projectversion_c',
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
      'name' => 'asol_project_asol_projectversionasol_project_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'asol_project_asol_projectversionasol_projectversion_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'asol_project_asol_projectversionspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'asol_project_asol_projectversion_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'asol_project_asol_projectversionasol_project_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'asol_project_asol_projectversion_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'asol_project_asol_projectversionasol_projectversion_idb',
      ),
    ),
  ),
);