<?php 
 //WARNING: The contents of this file are auto-generated


    $dictionary['Expan_Solicitud']['fields']['phone_home']['unified_search'] = true;


// created: 2014-08-01 18:54:09
$dictionary["Expan_Solicitud"]["fields"]["expan_solicitud_expan_gestionsolicitudes_1"] = array (
  'name' => 'expan_solicitud_expan_gestionsolicitudes_1',
  'type' => 'link',
  'relationship' => 'expan_solicitud_expan_gestionsolicitudes_1',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
);


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


 // created: 2014-08-18 23:22:52
$dictionary['Expan_Solicitud']['fields']['alt_address_country']['comments']='Country for alternate address';
$dictionary['Expan_Solicitud']['fields']['alt_address_country']['merge_filter']='disabled';

 

 // created: 2014-09-22 19:26:00
$dictionary['Expan_Solicitud']['fields']['date_entered']['enable_range_search']='1';

 

 // created: 2014-09-22 19:25:51
$dictionary['Expan_Solicitud']['fields']['date_modified']['comments']='Date record last modified';
$dictionary['Expan_Solicitud']['fields']['date_modified']['merge_filter']='disabled';

 

 // created: 2014-09-22 19:25:29
$dictionary['Expan_Solicitud']['fields']['envio_documentacion']['options']='date_range_search_dom';
$dictionary['Expan_Solicitud']['fields']['envio_documentacion']['enable_range_search']='1';

 

 // created: 2014-09-22 19:25:18
$dictionary['Expan_Solicitud']['fields']['fecha_primer_contacto']['options']='date_range_search_dom';
$dictionary['Expan_Solicitud']['fields']['fecha_primer_contacto']['enable_range_search']='1';

 

 // created: 2014-09-24 18:15:45
$dictionary['Expan_Solicitud']['fields']['franquicias_secundarias']['default']='';
$dictionary['Expan_Solicitud']['fields']['franquicias_secundarias']['required']=true;

 

 // created: 2014-11-14 11:24:51
$dictionary['Expan_Solicitud']['fields']['franquicia_principal']['required']=false;

 

 // created: 2014-08-18 23:21:35
$dictionary['Expan_Solicitud']['fields']['no_correos_c']['labelValue']='No enviar correo';

 

 // created: 2014-08-18 23:23:17
$dictionary['Expan_Solicitud']['fields']['pais_c']['labelValue']='pais';

 

 // created: 2014-08-17 10:09:27
$dictionary['Expan_Solicitud']['fields']['phone_home']['comments']='Home phone number of the contact';
$dictionary['Expan_Solicitud']['fields']['phone_home']['merge_filter']='disabled';
$dictionary['Expan_Solicitud']['fields']['phone_home']['unified_search']=false;

 

 // created: 2014-08-17 10:24:52
$dictionary['Expan_Solicitud']['fields']['sectores_de_interes']['default']='';

 
?>