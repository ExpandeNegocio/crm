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
 'vname' => 'Tipo Parcticipa',
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
 
 ?>