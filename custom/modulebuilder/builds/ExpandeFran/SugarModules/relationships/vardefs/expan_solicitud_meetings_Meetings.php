<?php
// created: 2014-08-17 00:21:22
$dictionary["Meeting"]["fields"]["expan_solicitud_meetings"] = array (
  'name' => 'expan_solicitud_meetings',
  'type' => 'link',
  'relationship' => 'expan_solicitud_meetings',
  'source' => 'non-db',
  'module' => 'Expan_Solicitud',
  'bean_name' => 'Expan_Solicitud',
  'vname' => 'LBL_EXPAN_SOLICITUD_MEETINGS_FROM_EXPAN_SOLICITUD_TITLE',
  'id_name' => 'expan_solicitud_meetingsexpan_solicitud_ida',
);
$dictionary["Meeting"]["fields"]["expan_solicitud_meetings_name"] = array (
  'name' => 'expan_solicitud_meetings_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_SOLICITUD_MEETINGS_FROM_EXPAN_SOLICITUD_TITLE',
  'save' => true,
  'id_name' => 'expan_solicitud_meetingsexpan_solicitud_ida',
  'link' => 'expan_solicitud_meetings',
  'table' => 'expan_solicitud',
  'module' => 'Expan_Solicitud',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Meeting"]["fields"]["expan_solicitud_meetingsexpan_solicitud_ida"] = array (
  'name' => 'expan_solicitud_meetingsexpan_solicitud_ida',
  'type' => 'link',
  'relationship' => 'expan_solicitud_meetings',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_MEETINGS_FROM_MEETINGS_TITLE',
);
