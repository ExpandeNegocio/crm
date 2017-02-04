<?php
// created: 2011-06-21 13:32:53
$dictionary["asol_events_asol_activity"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'asol_events_asol_activity' => 
    array (
      'lhs_module' => 'asol_Events',
      'lhs_table' => 'asol_events',
      'lhs_key' => 'id',
      'rhs_module' => 'asol_Activity',
      'rhs_table' => 'asol_activity',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'asol_eventssol_activity_c',
      'join_key_lhs' => 'asol_event87f4_events_ida',
      'join_key_rhs' => 'asol_event8042ctivity_idb',
    ),
  ),
  'table' => 'asol_eventssol_activity_c',
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
      'name' => 'asol_event87f4_events_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'asol_event8042ctivity_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'asol_events_asol_activityspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'asol_events_asol_activity_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'asol_event87f4_events_ida',
        1 => 'asol_event8042ctivity_idb',
      ),
    ),
  ),
);
?>