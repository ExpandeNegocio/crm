<?php
// created: 2014-05-26 17:29:11
$dictionary["expan_franquicia_expan_intermediacion_franquicia"] = array (
  'true_relationship_type' => 'one-to-one',
  'relationships' => 
  array (
    'expan_franquicia_expan_intermediacion_franquicia' => 
    array (
      'lhs_module' => 'Expan_Franquicia',
      'lhs_table' => 'expan_franquicia',
      'lhs_key' => 'id',
      'rhs_module' => 'Expan_intermediacion_franquicia',
      'rhs_table' => 'expan_intermediacion_franquicia',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_franquicia_expan_intermediacion_franquicia_c',
      'join_key_lhs' => 'expan_franefc3nquicia_ida',
      'join_key_rhs' => 'expan_fran841cnquicia_idb',
    ),
  ),
  'table' => 'expan_franquicia_expan_intermediacion_franquicia_c',
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
      'name' => 'expan_franefc3nquicia_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expan_fran841cnquicia_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_franquicia_expan_intermediacion_franquiciaspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_franquicia_expan_intermediacion_franquicia_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expan_franefc3nquicia_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'expan_franquicia_expan_intermediacion_franquicia_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expan_fran841cnquicia_idb',
      ),
    ),
  ),
);