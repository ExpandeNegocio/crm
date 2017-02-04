<?php
// created: 2011-04-05 11:16:36
$dictionary["asol_activity_asol_activity"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'asol_activity_asol_activity' => 
    array (
      'lhs_module' => 'asol_Activity',
      'lhs_table' => 'asol_activity',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_Activity',
      'rhs_table' => 'asol_activity',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'asol_activisol_activity_c',
      'join_key_lhs' => 'asol_activ898activity_ida',
      'join_key_rhs' => 'asol_activ9e2dctivity_idb',
    ),
  ),
  'table' => 'asol_activisol_activity_c',
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
      'name' => 'asol_activ898activity_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'asol_activ9e2dctivity_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'asol_activi_asol_activityspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'asol_activi_asol_activity_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'asol_activ898activity_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'asol_activi_asol_activity_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'asol_activ9e2dctivity_idb',
      ),
    ),
  ),
);
?>
