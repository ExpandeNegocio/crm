<?php
// created: 2014-07-12 10:50:00
$dictionary["Expan_Franquicia"]["fields"]["expan_solicitud_expan_franquicia"] = array (
  'name' => 'expan_solicitud_expan_franquicia',
  'type' => 'link',
  'relationship' => 'expan_solicitud_expan_franquicia',
  'source' => 'non-db',
  'module' => 'Expan_Solicitud',
  'bean_name' => 'Expan_Solicitud',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_FRANQUICIA_FROM_EXPAN_SOLICITUD_TITLE',
  'id_name' => 'expan_solicitud_expan_franquiciaexpan_solicitud_ida',
);
$dictionary["Expan_Franquicia"]["fields"]["expan_solicitud_expan_franquicia_name"] = array (
  'name' => 'expan_solicitud_expan_franquicia_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_FRANQUICIA_FROM_EXPAN_SOLICITUD_TITLE',
  'save' => true,
  'id_name' => 'expan_solicitud_expan_franquiciaexpan_solicitud_ida',
  'link' => 'expan_solicitud_expan_franquicia',
  'table' => 'expan_solicitud',
  'module' => 'Expan_Solicitud',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Expan_Franquicia"]["fields"]["expan_solicitud_expan_franquiciaexpan_solicitud_ida"] = array (
  'name' => 'expan_solicitud_expan_franquiciaexpan_solicitud_ida',
  'type' => 'link',
  'relationship' => 'expan_solicitud_expan_franquicia',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_EXPAN_FRANQUICIA_FROM_EXPAN_FRANQUICIA_TITLE',
);
