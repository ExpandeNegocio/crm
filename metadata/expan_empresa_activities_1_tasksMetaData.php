<?php
// created: 2014-12-20 18:56:34
$dictionary["expan_empresa_activities_1_tasks"] = array (
  'relationships' => 
  array (
    'expan_empresa_activities_1_tasks' => 
    array (
      'lhs_module' => 'Expan_Empresa',
      'lhs_table' => 'expan_empresa',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Expan_Empresa',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);