<?php
// created: 2012-06-15 10:55:30
$dictionary["zr2_reportparameterlink_zr2_querytemplate"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'zr2_reportparameterlink_zr2_querytemplate' => 
    array (
      'lhs_module' => 'zr2_QueryTemplate',
      'lhs_table' => 'zr2_querytemplate',
      'lhs_key' => 'id',
      'rhs_module' => 'zr2_ReportParameterLink',
      'rhs_table' => 'zr2_reportparameterlink',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'zr2_reportparameterlink_zr2_querytemplate_c',
      'join_key_lhs' => 'zr2_query313cemplate_ida',
      'join_key_rhs' => 'zr2_report0ed1terlink_idb',
    ),
  ),
  'table' => 'zr2_reportparameterlink_zr2_querytemplate_c',
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
      'name' => 'zr2_query313cemplate_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'zr2_report0ed1terlink_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_querytemplatespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_querytemplate_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'zr2_query313cemplate_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'zr2_reportparameterlink_zr2_querytemplate_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'zr2_report0ed1terlink_idb',
      ),
    ),
  ),
);