<?php
// created: 2014-08-01 18:54:09
$dictionary["expan_empresa_competidores"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'expan_empresa_competidores' => 
    array (
      'lhs_module' => 'Expan_Empresa',
      'lhs_table' => 'expan_empresa',
      'lhs_key' => 'id',
      'rhs_module' => 'Expan_Empresa',
      'rhs_table' => 'expan_empresa',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expan_empresa_competidores',
      'join_key_lhs' => 'competidor_id',
      'join_key_rhs' => 'empresa_id',
    ),
       
  ),
  'table' => 'expan_empresa_competidores_c',
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
      'name' => 'empresa_id',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'competidor_id',
      'type' => 'varchar',
      'len' => 36,
    ),
    5 =>
     array (
      'name' => 'tipo_competidor',
      'type' => 'varchar',
      'options' => 'lst_tipo_competidor',      
      'len' => '3',
      'default' => '',
    ),
    6 => 
    array (
      'name' => 'competidor_principal',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),   
    
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expan_empresa_competidorespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expan_empresa_competidores_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'empresa_id',
      ),
    ),
    2 => 
    array (
      'name' => 'expan_empresa_competidores_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'competidor_id',
      ),
    ),
  ),
);