<?php
$dashletData['Expan_SolicitudDashlet']['searchFields'] = array (
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
  'candidatura_caliente'=>
  array (
    'default' => '',
  ),
    'oportunidad_inmediata'=>
  array (
    'default' => '',
  ),
);
$dashletData['Expan_SolicitudDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '30',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
  ),
  'date_entered' => 
  array (
    'width' => '15',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  'date_modified' => 
  array (
    'width' => '15',
    'label' => 'LBL_DATE_MODIFIED',
  ),
  'created_by' => 
  array (
    'width' => '8',
    'label' => 'LBL_CREATED',
  ),
  'assigned_user_name' => 
  array (
    'width' => '8',
    'label' => 'LBL_LIST_ASSIGNED_USER',
  ),
  
   'provincia_apertura_1' => 
  array (
    'label' => 'LBL_PROVINCIA_APERTURA_1',
    'width' => '10%',
    'default' => true,
  ),
  
  'candidatura_caliente'=>
  array (
    'width' => '8',
    'type' => 'bool',
    'label' => 'Caliente',
    'default' => true,
  ),
  
  'candidatura_avanzada'=>
  array (
    'width' => '8',
    'type' => 'bool',
    'label' => 'Avanzada',
    'default' => true,
  ),
  
   'prioridad' => 
  array (
    'width' => '8',
    'label' => 'LBL_PRIORIDAD',
    'default' => true,
  ),
  
    'franquicia_principal' => 
  array (
    'label' => 'LBL_FRANQUICIA_PRINCIPAL',
    'link' => true,
    'width' => '10',
    'default' => true,
  ),
  
);
