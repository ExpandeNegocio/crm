<?php
$module_name = 'Expan_GestionSolicitudes';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '100%',
    'label' => 'Hola',
    'default' => true,
    'link' => true,
  ),
  'EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_SOLICITUD_TITLE',
    'width' => '10%',
    'default' => true,
    'id' => 'EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1EXPAN_SOLICITUD_IDA',
  ),
  'CANDIDATURA_AVANZADA' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Avanzada',
    'width' => '10%',
  ),
  'CANDIDATURA_CALIENTE' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Caliente',
    'width' => '10%',
  ),
  
  'CHK_ENVIO_DOCUMENTACION' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Envio de doc',
    'width' => '10%',
  ),
  'CHK_RESOLUCION_DUDAS' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Resol dudas',
    'width' => '10%',
  ),
  
  'CHK_SOL_AMP_INFO' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Amp info',
    'width' => '10%',
  ),
  
  'CHK_RECEPCIO_CUESTIONARIO' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Recep cuestiona',
    'width' => '10%',
  ),
  'CHK_INFORMACION_ADICIONAL' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Envio info adicional',
    'width' => '10%',
  ),
  
  'CHK_ENTREVISTA' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Entrevista',
    'width' => '10%',
  ),
  'CHK_VISITADO_FRAN' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Visitado franciado/ unidad propia',
    'width' => '10%',
  ),
  'CHK_ENVIO_PRECONTRATO' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Envio precont',
    'width' => '10%',
  ),
  'CHK_VISITA_LOCAL' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Info de local',
    'width' => '10%',
  ),
  'CHK_ENVIO_CONTRATO' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Envío de contrato',
    'width' => '10%',
  ),
  'CHK_VISITA_CENTRAL' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Visita a la Central',
    'width' => '10%',
  ),
  'FRANQUICIA' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_FRANQUICIA',
    'width' => '10%',
    'default' => true,
  ),
  'ESTADO_SOL' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'default' => true,
    'label' => 'Estado',
    'width' => '10%',
  ),
  
  'subestado' => 
  array (
    'width' => '5%',
    'label' => 'LBL_SUBESTADO',
    'default' => true,
  ),
  
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
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
  
    'prioridad' => 
  array (
    'width' => '5%',
    'label' => 'LBL_PRIORIDAD',
    'default' => true,
  ),  
  'oportunidad_inmediata' => 
  array (
    'width' => '5%',
    'label' => 'Oport. Inme.',
    'default' => true,
  ),
  
  'provincia_apertura_1' => 
  array (
    'width' => '5%',
    'label' => 'LBL_PROVINCIA_APERTURA_1',
    'default' => true,
  ),
      
  'rating' => 
  array (
    'width' => '5%',
    'label' => 'LBL_RATING',
    'default' => true,
  ),
  
  'telefono' => 
  array (
    'width' => '5%',
    'label' => 'LBL_TELEFONO',
    'default' => true,
  ),
  
  'perfil_ideoneo' => 
  array (
    'width' => '5%',
    'label' => 'LBL_PERFIL_IDONEO',
    'default' => true,
  ),
  
  'Accesos' => 
  array (
    'width' => '1%',
    'label' => 'Acc',
    'type' => 'relate',
    'sortable' => false,
    'link' => true,
    'id'=>'id',
    'customCode' => '<input type="image" src="themes/Sugar5/images/abrirtodo.gif" onclick="abrirGestionEdicion(\'{$ID}\');   abrirSolicitudLlamadas(\'{$ID}\',\'{$EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1EXPAN_SOLICITUD_IDA}\');  return false;"/>',
    'default' => true,
  ),
  
  
);
?>
