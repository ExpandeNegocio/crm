<?php
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
 
 $dictionary['Expan_Franquicia']['fields']['e_gastos_asociados'] =
 array (
 'name' => 'e_gastos_asociados',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'franquicia_id', 'gastos_asociados' => 'gastos_asociados'),
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

$dictionary['Expan_Franquicia']['fields']['gastos_asociados'] =
 array(
 'massupdate' => false,
 'name' => 'gastos_asociados',
 'type' => 'currency',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Gastos Asociados',
 'importable' => 'false',
 'precision' => 2,
 );
 
$dictionary['Expan_Franquicia']['fields']['e_coste_accion'] =
 array (
 'name' => 'e_coste_accion',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'franquicia_id', 'coste_accion' => 'coste_accion'),
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

$dictionary['Expan_Franquicia']['fields']['coste_accion'] =
 array(
 'massupdate' => false,
 'name' => 'coste_accion',
 'type' => 'currency',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Coste Acción',
 'importable' => 'false',
 'precision' => 2,
 );
 
$dictionary['Expan_Franquicia']['fields']['franquicia_id'] =
 array(
 'name' => 'franquicia_id',
 'type' => 'varchar',
 'source' => 'non-db',
 'vname' => 'Franquicia Id',
 'studio' => array('listview' => false),
 );
 
 ?>