<?php
// created: 2014-08-17 00:21:23
$dictionary["Expan_Documentacion"]["fields"]["expan_franquicia_expan_documentacion"] = array (
  'name' => 'expan_franquicia_expan_documentacion',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_documentacion',
  'source' => 'non-db',
  'module' => 'Expan_Franquicia',
  'bean_name' => 'Expan_Franquicia',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_DOCUMENTACION_FROM_EXPAN_FRANQUICIA_TITLE',
  'id_name' => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
);
$dictionary["Expan_Documentacion"]["fields"]["expan_franquicia_expan_documentacion_name"] = array (
  'name' => 'expan_franquicia_expan_documentacion_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_DOCUMENTACION_FROM_EXPAN_FRANQUICIA_TITLE',
  'save' => true,
  'id_name' => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
  'link' => 'expan_franquicia_expan_documentacion',
  'table' => 'expan_franquicia',
  'module' => 'Expan_Franquicia',
  'rname' => 'name',
);
$dictionary["Expan_Documentacion"]["fields"]["expan_franquicia_expan_documentacionexpan_franquicia_ida"] = array (
  'name' => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_documentacion',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_DOCUMENTACION_FROM_EXPAN_DOCUMENTACION_TITLE',
);
