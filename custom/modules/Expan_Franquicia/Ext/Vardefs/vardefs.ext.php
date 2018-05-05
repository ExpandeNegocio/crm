<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2015-12-22 07:59:48
$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_calls_1"] = array (
  'name' => 'expan_franquicia_calls_1',
  'type' => 'link',
  'relationship' => 'expan_franquicia_calls_1',
  'source' => 'non-db',
  'module' => 'Calls',
  'bean_name' => 'Call',
  'side' => 'right',
  'vname' => 'LBL_EXPAN_FRANQUICIA_CALLS_1_FROM_CALLS_TITLE',
);


// created: 2015-12-19 19:32:32
$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_documents_1"] = array (
  'name' => 'expan_franquicia_documents_1',
  'type' => 'link',
  'relationship' => 'expan_franquicia_documents_1',
  'source' => 'non-db',
  'module' => 'Documents',
  'bean_name' => 'Document',
  'vname' => 'LBL_EXPAN_FRANQUICIA_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);


// created: 2014-08-01 17:17:40
$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_expan_documentacion"] = array (
  'name' => 'expan_franquicia_expan_documentacion',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_documentacion',
  'source' => 'non-db',
  'module' => 'Expan_Documentacion',
  'bean_name' => 'Expan_Documentacion',
  'side' => 'right',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_DOCUMENTACION_FROM_EXPAN_DOCUMENTACION_TITLE',
);


// created: 2014-08-01 17:17:40

//http://sugarmods.co.uk/how-to-add-custom-fields-to-a-relationship-table-and-display-them-in-a-subpanel-sugarcrm-suitecrm/

$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_expan_evento"] = array (
  'name' => 'expan_franquicia_expan_evento',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_evento',
  'source' => 'non-db',
  'module' => 'Expan_Evento',
  'bean_name' => 'Expan_Evento',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_EVENTO_FROM_EXPAN_EVENTO_TITLE',
);

$dictionary['Expan_Franquicia']['fields']['e_participacion'] =
 array (
 'name' => 'e_participacion',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'franquicia_id', 'participacion' => 'tipo_participacion'),
 'vname' => 'LBL_CONT_ACCEPT_CANCELLED',
 'type' => 'relate',
 'link' => 'expan_franquicia_expan_evento',
 'link_type' => 'relationship_info',
 'join_link_name' => 'expan_franquicia_expan_evento',
 'source' => 'non-db',
 'importable' => 'false',
 'duplicate_merge'=> 'disabled',
 'studio' => false,
 'join_primary' => false,
 );

$dictionary['Expan_Franquicia']['fields']['tipo_participacion'] =
 array(
 'massupdate' => false,
 'name' => 'tipo_participacion',
 'type' => 'enum',
 'options' => 'lst_tipo_participa_Evento',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Tipo Participa',
 'importable' => 'false',
 );
 
$dictionary['Expan_Franquicia']['fields']['e_formato_participacion'] =
 array (
 'name' => 'e_formato_participacion',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'franquicia_id', 'formato_participacion' => 'formato_participacion'),
 'vname' => 'LBL_CONT_ACCEPT_CANCELLED',
 'type' => 'relate',
 'link' => 'expan_franquicia_expan_evento',
 'link_type' => 'relationship_info',
 'join_link_name' => 'expan_franquicia_expan_evento',
 'source' => 'non-db',
 'importable' => 'false',
 'duplicate_merge'=> 'disabled',
 'studio' => false,
 'join_primary' => false,
 );

$dictionary['Expan_Franquicia']['fields']['formato_participacion'] =
 array(
 'massupdate' => false,
 'name' => 'formato_participacion',
 'type' => 'enum',
 'options' => 'lst_formato_participa_Evento',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Formato Participa',
 'importable' => 'false',
 );
 
$dictionary['Expan_Franquicia']['fields']['franquicia_id'] =
 array(
 'name' => 'franquicia_id',
 'type' => 'varchar',
 'source' => 'non-db',
 'vname' => 'Franquicia Id',
 'studio' => array('listview' => false),
 );
 
 

// created: 2015-12-22 08:00:19
$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_tasks_1"] = array (
  'name' => 'expan_franquicia_tasks_1',
  'type' => 'link',
  'relationship' => 'expan_franquicia_tasks_1',
  'source' => 'non-db',
  'module' => 'Tasks',
  'bean_name' => 'Task',
  'side' => 'right',
  'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_TASKS_TITLE',
);


 // created: 2014-11-10 20:13:05
$dictionary['Expan_Franquicia']['fields']['filtro_solicitudes_c']['labelValue']='filtro solicitudes';

 

 // created: 2014-11-10 20:13:05

 
?>