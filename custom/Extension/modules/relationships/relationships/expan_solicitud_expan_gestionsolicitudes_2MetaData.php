<?php
// created: 2014-08-01 18:35:59
$dictionary["expan_solicitud_expan_gestionsolicitudes_2"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'expan_solicitud_expan_gestionsolicitudes_2' => 
    array (
      'lhs_module' => 'Expan_Solicitud',
      'lhs_table' => 'expan_solicitud',
      'lhs_key' => 'id',
      'rhs_module' => 'Expan_GestionSolicitudes',
      'rhs_table' => 'expan_gestionsolicitudes',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_solicitud_expan_gestionsolicitudes_2_c',
      'join_key_lhs' => 'expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida',
      'join_key_rhs' => 'expan_soli2369citudes_idb',
    ),
  ),
  'table' => 'expan_solicitud_expan_gestionsolicitudes_2_c',
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
      'name' => 'expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expan_soli2369citudes_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_solicitud_expan_gestionsolicitudes_2spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_solicitud_expan_gestionsolicitudes_2_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'expan_solicitud_expan_gestionsolicitudes_2_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'expan_soli2369citudes_idb',
      ),
    ),
  ),
);