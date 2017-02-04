<?php
// created: 2014-08-01 17:17:40
$dictionary["expan_franquicia_expan_evento"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'expan_franquicia_expan_evento' => 
    array (
      'lhs_module' => 'Expan_Franquicia',
      'lhs_table' => 'expan_franquicia',
      'lhs_key' => 'id',
      'rhs_module' => 'Expan_Evento',
      'rhs_table' => 'expan_evento',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_franquicia_expan_evento_c',
      'join_key_lhs' => 'expan_franquicia_expan_eventoexpan_franquicia_ida',
      'join_key_rhs' => 'expan_franquicia_expan_eventoexpan_evento_idb',
    ),
  ),
  'table' => 'expan_franquicia_expan_evento_c',
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
      'name' => 'expan_franquicia_expan_eventoexpan_franquicia_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expan_franquicia_expan_eventoexpan_evento_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
    5=>
     array (
      'name' => 'participacion',
      'type' => 'varchar',
      'options' => 'lst_tipo_participa_Evento',      
      'len' => '2',
      'default' => '',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_franquicia_expan_eventospk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_franquicia_expan_evento_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'expan_franquicia_expan_eventoexpan_franquicia_ida',
        1 => 'expan_franquicia_expan_eventoexpan_evento_idb',
      ),
    ),
  ),
);