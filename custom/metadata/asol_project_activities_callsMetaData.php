<?php
// created: 2014-02-26 13:28:27
$dictionary["asol_project_activities_calls"] = array (
  'relationships' => 
  array (
    'asol_project_activities_calls' => 
    array (
      'lhs_module' => 'asol_Project',
      'lhs_table' => 'asol_project',
      'lhs_key' => 'id',
      'rhs_module' => 'Calls',
      'rhs_table' => 'calls',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'asol_Project',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);