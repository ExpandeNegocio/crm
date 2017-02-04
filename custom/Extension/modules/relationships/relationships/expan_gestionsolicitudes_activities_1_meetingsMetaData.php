<?php
// created: 2014-12-20 18:56:25
$dictionary["expan_gestionsolicitudes_activities_1_meetings"] = array (
  'relationships' => 
  array (
    'expan_gestionsolicitudes_activities_1_meetings' => 
    array (
      'lhs_module' => 'Expan_GestionSolicitudes',
      'lhs_table' => 'expan_gestionsolicitudes',
      'lhs_key' => 'id',
      'rhs_module' => 'Meetings',
      'rhs_table' => 'meetings',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Expan_GestionSolicitudes',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);