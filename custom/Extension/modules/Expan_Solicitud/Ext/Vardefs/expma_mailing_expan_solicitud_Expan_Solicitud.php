<?php
// created: 2015-01-29 17:00:56
$dictionary["Expan_Solicitud"]["fields"]["expma_mailing_expan_solicitud"] = array (
  'name' => 'expma_mailing_expan_solicitud',
  'type' => 'link',
  'relationship' => 'expma_mailing_expan_solicitud',
  'source' => 'non-db',
  'module' => 'Expma_Mailing',
  'bean_name' => 'Expma_Mailing',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_SOLICITUD_FROM_EXPMA_MAILING_TITLE',
  'id_name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
);
$dictionary["Expan_Solicitud"]["fields"]["expma_mailing_expan_solicitud_name"] = array (
  'name' => 'expma_mailing_expan_solicitud_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_SOLICITUD_FROM_EXPMA_MAILING_TITLE',
  'save' => true,
  'id_name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
  'link' => 'expma_mailing_expan_solicitud',
  'table' => 'expma_mailing',
  'module' => 'Expma_Mailing',
  'rname' => 'name',
);
$dictionary["Expan_Solicitud"]["fields"]["expma_mailing_expan_solicitudexpma_mailing_ida"] = array (
  'name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
  'type' => 'link',
  'relationship' => 'expma_mailing_expan_solicitud',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_SOLICITUD_FROM_EXPAN_SOLICITUD_TITLE',
);


$dictionary['Expan_Solicitud']['fields']['e_evento'] =
 array (
 'name' => 'e_evento',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'mailing_id', 'enviado' => 'correo_enviado', 'motivo_no_envio'=>'motivo_no_envio'),
 'vname' => 'LBL_CONT_ACCEPT_CANCELLED',
 'type' => 'relate',
 'link' => 'expma_mailing_expan_solicitud',
 'link_type' => 'relationship_info',
 'join_link_name' => 'expma_mailing_expan_solicitud',
 'source' => 'non-db',
 'importable' => 'false',
 'duplicate_merge'=> 'disabled',
 'studio' => false,
 'join_primary' => false,
 );
 
$dictionary['Expan_Solicitud']['fields']['correo_enviado'] =
 array(
 'massupdate' => false,
 'name' => 'correo_enviado',
 'type' => 'bool',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'LBL_LIST_ACCEPT_CANCELLED',
 'importable' => 'false',
 );
 
 $dictionary['Expan_Solicitud']['fields']['motivo_no_envio'] =
 array(
 'massupdate' => false,
 'name' => 'motivo_no_envio',
 'type' => 'varchar',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Motivo No Enviado',
 'importable' => 'false',
 );
 
$dictionary['Expan_Solicitud']['fields']['mailing_id'] =
 array(
 'name' => 'mailing_id',
 'type' => 'varchar',
 'source' => 'non-db',
 'vname' => 'LBL_LIST_ACCEPT_CANCELLED',
 'studio' => array('listview' => false),
 );
