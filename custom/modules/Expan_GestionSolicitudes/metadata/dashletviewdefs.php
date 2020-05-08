<?php
$dashletData['Expan_GestionSolicitudesDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
  'estado_sol' => 
  array (
    'default' => '',
  ),
  'candidatura_caliente' => 
  array (
    'default' => '',
  ),  
  'candidatura_avanzada' => 
  array (
    'default' => '',
  ),  
  'oportunidad_inmediata' => 
  array (
    'default' => '',
  ),
);
$dashletData['Expan_GestionSolicitudesDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'estado_sol' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'default' => true,
    'label' => 'Estado',
    'width' => '10%',
    'name' => 'estado_sol',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
    'name' => 'date_entered',
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
  'candidatura_caliente' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'Candidatura caliente',
    'width' => '10%',
  ),
  'candidatura_avanzada' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'Candidatura Avanzada',
    'width' => '10%',
  ),
  'chk_firma_corto' =>
    array (
      'type' => 'bool',
      'default' => false,
      'label' => 'LBL_CHK_FIRMA_CORTO',
      'width' => '10%',
    ),
  'provincia_apertura_1' => 
  array (
    'default' => false,
    'label' => 'Provincia',
    'width' => '10%',
  ),
    'prioridad' => 
  array (    
    'default' => false,
    'label' => 'Prioridad',
    'width' => '10%',
  ),
  
);
