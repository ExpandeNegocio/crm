<?php
// created: 2012-06-15 10:55:29
$dictionary["zr2_reportcontainer_zr2_report"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'zr2_reportcontainer_zr2_report' => 
    array (
      'lhs_module' => 'zr2_ReportContainer',
      'lhs_table' => 'zr2_reportcontainer',
      'lhs_key' => 'id',
      'rhs_module' => 'zr2_Report',
      'rhs_table' => 'zr2_report',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'zr2_reportcontainer_zr2_report_c',
      'join_key_lhs' => 'zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida',
      'join_key_rhs' => 'zr2_reportcontainer_zr2_reportzr2_report_idb',
    ),
  ),
  'table' => 'zr2_reportcontainer_zr2_report_c',
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
      'name' => 'zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'zr2_reportcontainer_zr2_reportzr2_report_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'zr2_reportcontainer_zr2_reportspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'zr2_reportcontainer_zr2_report_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'zr2_reportcontainer_zr2_report_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'zr2_reportcontainer_zr2_reportzr2_report_idb',
      ),
    ),
  ),
);