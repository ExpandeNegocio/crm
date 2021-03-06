<?php
// created: 2014-11-13 18:13:41
$searchFields['Calls'] = array (
  'name' => 
  array (
    'query_type' => 'default',
  ),
  'telefono' => array( 'query_type'=>'default'),
  'contact_name' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'contacts.first_name',
      1 => 'contacts.last_name',
    ),
  ),
  
  'provincia_apertura_1' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'select c.id from 
              expan_gestionsolicitudes g,
              expan_solicitud s,
              expan_solicitud_expan_gestionsolicitudes_1_c gs,
              calls c
            where
              g.id = gs.expan_soli5dcccitudes_idb AND
              c.parent_id=g.id AND
              s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.provincia_apertura_1 in ({0})',
    'db_field' => 
    array (
      0 => 'id',
    ),
    'vname' => 'LBL_PROVINCIA_APERTURA_1',
  ),
  
  'disp_contacto' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'select c.id from 
              expan_gestionsolicitudes g,
              expan_solicitud s,
              expan_solicitud_expan_gestionsolicitudes_1_c gs,
              calls c
            where
              g.id = gs.expan_soli5dcccitudes_idb AND
              c.parent_id=g.id AND
              s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.disp_contacto in ({0})',
    'db_field' => 
    array (
      0 => 'id',
    ),
    'vname' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO',
  ),
  
  
  
  
  'date_start' => 
  array (
    'query_type' => 'default',
  ),
  'location' => 
  array (
    'query_type' => 'default',
  ),
  'current_user_only' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'assigned_user_id',
    ),
    'my_items' => true,
    'vname' => 'LBL_CURRENT_USER_FILTER',
    'type' => 'bool',
  ),
  'assigned_user_id' => 
  array (
    'query_type' => 'default',
  ),
  'status' => 
  array (
    'query_type' => 'default',
    'options' => 'call_status_dom',
    'template_var' => 'STATUS_FILTER',
  ),
  'open_only' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'status',
    ),
    'operator' => 'not in',
    'closed_values' => 
    array (
      0 => 'Held',
      1 => 'Not Held',
    ),
    'type' => 'bool',
  ),

 
  
  'range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_start' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_start' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_start' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_end' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_end' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_end' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'address_country' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'primary_address_country',
      1 => 'alt_address_country',
    ),
  ),
  
  
);