<?php
$dashletData['CallsDashlet']['searchFields'] = array (
  'name' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => 
    array (
      0 => 'Planned',
    ),
  ),
  'date_entered' => 
  array (
    'default' => '',
  ),
  'call_type' => 
  array (
    'default' => '',
  ),
  'date_start' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'type' => 'assigned_user_name',
    'label' => 'LBL_ASSIGNED_TO',
    'default' => 'Administrator',
  ),
);
$dashletData['CallsDashlet']['columns'] = array (
  'set_complete' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_CLOSE',
    'default' => true,
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'status',
      1 => 'recurring_source',
    ),
    'name' => 'set_complete',
  ),
  'call_type' => 
  array (
    'label' => 'LBL_CALL_TYPE',
    'width' => '30%',
    'default' => true,
    'name' => 'call_type',
  ),
  'parent_name' => 
  array (
    'width' => '29%',
    'label' => 'LBL_LIST_RELATED_TO',
    'sortable' => false,
    'dynamic_module' => 'PARENT_TYPE',
    'link' => true,
    'id' => 'PARENT_ID',
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'default' => true,
    'name' => 'parent_name',
  ),
  'date_start' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'time_start',
    ),
    'name' => 'date_start',
  ),
  'set_accept_links' => 
  array (
    'width' => '10%',
    'label' => '¿Aceptar?',
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'status',
    ),
    'default' => true,
    'name' => 'set_accept_links',
  ),
  'status' => 
  array (
    'width' => '8%',
    'label' => 'LBL_STATUS',
    'default' => true,
    'name' => 'status',
  ),
  'duration' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DURATION',
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'duration_hours',
      1 => 'duration_minutes',
    ),
    'name' => 'duration',
    'default' => false,
  ),
  'direction' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DIRECTION',
    'name' => 'direction',
    'default' => false,
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'name' => 'date_entered',
    'default' => false,
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
);
