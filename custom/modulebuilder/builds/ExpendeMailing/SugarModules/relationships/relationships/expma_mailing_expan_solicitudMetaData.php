<?php
// created: 2015-01-29 12:03:33
$dictionary["expma_mailing_expan_solicitud"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'expma_mailing_expan_solicitud' => 
    array (
      'lhs_module' => 'Expma_Mailing',
      'lhs_table' => 'expma_mailing',
      'lhs_key' => 'id',
      'rhs_module' => 'Expan_Solicitud',
      'rhs_table' => 'expan_solicitud',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'expma_mailing_expan_solicitud_c',
      'join_key_lhs' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
      'join_key_rhs' => 'expma_mailing_expan_solicitudexpan_solicitud_idb',
    ),
  ),
  'table' => 'expma_mailing_expan_solicitud_c',
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
      'name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'expma_mailing_expan_solicitudexpan_solicitud_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'expma_mailing_expan_solicitudspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'expma_mailing_expan_solicitud_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'expma_mailing_expan_solicitudexpma_mailing_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'expma_mailing_expan_solicitud_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'expma_mailing_expan_solicitudexpan_solicitud_idb',
      ),
    ),
  ),
);