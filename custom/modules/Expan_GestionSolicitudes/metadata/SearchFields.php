<?php
// created: 2014-12-01 10:52:42
$searchFields['Expan_GestionSolicitudes'] = array (
  'name' => 
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
  
  'provincia_apertura_1' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'select g.id from 
              expan_gestionsolicitudes g,
              expan_solicitud s,
              expan_solicitud_expan_gestionsolicitudes_1_c gs
            where
              g.id = gs.expan_soli5dcccitudes_idb AND
              s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.provincia_apertura_1 in ({0})',
    'db_field' => 
    array (
      0 => 'id',
    ),
    'vname' => 'LBL_PROVINCIA_APERTURA_1',
  ),
  
  'rating' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'select g.id from 
              expan_gestionsolicitudes g,
              expan_solicitud s,
              expan_solicitud_expan_gestionsolicitudes_1_c gs
            where
              g.id = gs.expan_soli5dcccitudes_idb AND
              s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.rating in ({0})',
    'db_field' => 
    array (
      0 => 'id',
    ),
    'vname' => 'LBL_RATING',
  ),
  
  'assigned_user_id' => 
  array (
    'query_type' => 'default',
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
  'range_f_recepcion_cuestionario' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_f_recepcion_cuestionario' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_f_recepcion_cuestionario' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_f_entrevista' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_f_entrevista' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_f_entrevista' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_f_visita_local' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_f_visita_local' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_f_visita_local' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_f_envio_contrato' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_f_envio_contrato' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_f_envio_contrato' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_f_visita_central' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_f_visita_central' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_f_visita_central' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
);