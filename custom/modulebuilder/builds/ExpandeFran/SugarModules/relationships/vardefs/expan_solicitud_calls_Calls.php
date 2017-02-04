<?php
// created: 2014-08-17 00:21:22
$dictionary["Call"]["fields"]["expan_solicitud_calls"] = array (
  'name' => 'expan_solicitud_calls',
  'type' => 'link',
  'relationship' => 'expan_solicitud_calls',
  'source' => 'non-db',
  'module' => 'Expan_Solicitud',
  'bean_name' => 'Expan_Solicitud',
  'vname' => 'LBL_EXPAN_SOLICITUD_CALLS_FROM_EXPAN_SOLICITUD_TITLE',
  'id_name' => 'expan_solicitud_callsexpan_solicitud_ida',
);
$dictionary["Call"]["fields"]["expan_solicitud_calls_name"] = array (
  'name' => 'expan_solicitud_calls_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_SOLICITUD_CALLS_FROM_EXPAN_SOLICITUD_TITLE',
  'save' => true,
  'id_name' => 'expan_solicitud_callsexpan_solicitud_ida',
  'link' => 'expan_solicitud_calls',
  'table' => 'expan_solicitud',
  'module' => 'Expan_Solicitud',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Call"]["fields"]["expan_solicitud_callsexpan_solicitud_ida"] = array (
  'name' => 'expan_solicitud_callsexpan_solicitud_ida',
  'type' => 'link',
  'relationship' => 'expan_solicitud_calls',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_CALLS_FROM_CALLS_TITLE',
);
