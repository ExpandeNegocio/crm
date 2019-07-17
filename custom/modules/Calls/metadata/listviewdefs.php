<?php
$listViewDefs ['Calls'] = 
array (
  'SET_COMPLETE' => 
  array (
    'width' => '1%',
    'label' => 'LBL_LIST_CLOSE',
    'link' => true,
    'sortable' => false,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'status',
    ),
  ),
  'DIRECTION' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_DIRECTION',
    'link' => false,
    'default' => true,
  ),
  'TELEFONO' => 
  array (
    'type' => 'phone',
    'label' => 'LBL_TELEFONO',
    'width' => '5%',
    'default' => true,
  ),
  'CALL_TYPE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CALL_TYPE',
    'link' => true,
    'default' => true,
  ),
  'EXPAN_GESTIONSOLICITUDES_CALLS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_EXPAN_GESTIONSOLICITUDES_CALLS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
    'id' => 'EXPAN_GESTIONSOLICITUDES_CALLS_1EXPAN_GESTIONSOLICITUDES_IDA',
    'width' => '20%',
    'default' => true,
  ),
  
  'franquicia'=>
  array(
    'link' => false,
    'label' => 'LBL_FRANQUICIA',
    'width' => '10%',
    'default' => true,
  ),
  
  'DATE_START' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_DATE',
    'link' => false,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'time_start',
    ),
  ),
  
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  
  'STATUS' => 
  array (
    'width' => '5%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => TRUE,
  ),
  'origen' => 
  array (
    'width' => '5%',
    'label' => 'LBL_ORIGEN',
    'link' => false,
    'default' => TRUE,
  ),
  
  'provincia_apertura_1' => 
  array (
    'width' => '5%',
    'label' => 'LBL_PROVINCIA_APERTURA_1',
    'default' => true,
  ),
  
  'prioridad' => 
  array (
    'width' => '5%',
    'label' => 'LBL_PRIORIDAD',
    'default' => true,
  ),
  
  'oportunidad_inmediata' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
    'default' => true,
  ),
  
  'gestion_agrupada' =>
    array (
    'width' => '10%',
    'label' => 'LBL_GESTION_AGRUPADA',
    'default' => true,
  ),
  
  'repeticiones' => 
  array (
    'width' => '5%',
    'label' => 'LBL_REPETICIONES',
    'default' => true,
  ),
  
  
  'Accesos' => 
  array (
    'width' => '1%',
    'label' => 'LBL_ACCESOS',
    'type' => 'relate',
    'sortable' => false,
    'link' => true,
    'id'=>'id',
    'customCode' => '
    <script type="text/javascript"  src="include/javascript/EditLlamadas.js"></script> 
    <input type="image" src="themes/Sugar5/images/abrirtodo.gif" 
        onclick="abrirLlamadaEdicion(\'{$ID}\');   
            abrirSolicitudEdicion(\'{$EXPAN_GESTIONSOLICITUDES_CALLS_1EXPAN_GESTIONSOLICITUDES_IDA}\');
            abrirGestionesAgrupadas(\'{$ID}\');
            return false;"/>',
    'default' => true,
  ),
  
);
?>
