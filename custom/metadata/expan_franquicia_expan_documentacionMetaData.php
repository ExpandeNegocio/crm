<?php
// created: 2014-08-01 17:17:40
$dictionary["expan_franquicia_expan_documentacion"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'expan_franquicia_expan_documentacion' => 
    array (
      'lhs_module' => 'Expan_Franquicia',
      'lhs_table' => 'expan_franquicia',
      'lhs_key' => 'id',
      'rhs_module' => 'Expan_Documentacion',
      'rhs_table' => 'expan_documentacion',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_franquicia_expan_documentacion_c',
      'join_key_lhs' => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
      'join_key_rhs' => 'expan_franquicia_expan_documentacionexpan_documentacion_idb',
    ),
  ),
  'table' => 'expan_franquicia_expan_documentacion_c',
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
      'name' => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expan_franquicia_expan_documentacionexpan_documentacion_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_franquicia_expan_documentacionspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_franquicia_expan_documentacion_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'expan_franquicia_expan_documentacion_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'expan_franquicia_expan_documentacionexpan_documentacion_idb',
      ),
    ),
  ),
);