<?php
// created: 2014-08-01 18:36:00
$dictionary["Expan_GestionSolicitudes"]["fields"]["expan_solicitud_expan_gestionsolicitudes_2"] = array (
  'name' => 'expan_solicitud_expan_gestionsolicitudes_2',
  'type' => 'link',
  'relationship' => 'expan_solicitud_expan_gestionsolicitudes_2',
  'source' => 'non-db',
  'module' => 'Expan_Solicitud',
  'bean_name' => 'Expan_Solicitud',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_2_FROM_EXPAN_SOLICITUD_TITLE',
  'id_name' => 'expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida',
);
$dictionary["Expan_GestionSolicitudes"]["fields"]["expan_solicitud_expan_gestionsolicitudes_2_name"] = array (
  'name' => 'expan_solicitud_expan_gestionsolicitudes_2_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_2_FROM_EXPAN_SOLICITUD_TITLE',
  'save' => true,
  'id_name' => 'expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida',
  'link' => 'expan_solicitud_expan_gestionsolicitudes_2',
  'table' => 'expan_solicitud',
  'module' => 'Expan_Solicitud',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Expan_GestionSolicitudes"]["fields"]["expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida"] = array (
  'name' => 'expan_solicitud_expan_gestionsolicitudes_2expan_solicitud_ida',
  'type' => 'link',
  'relationship' => 'expan_solicitud_expan_gestionsolicitudes_2',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_2_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
);
