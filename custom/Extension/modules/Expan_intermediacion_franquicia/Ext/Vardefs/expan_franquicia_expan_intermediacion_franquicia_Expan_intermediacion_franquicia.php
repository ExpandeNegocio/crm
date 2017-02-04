<?php
// created: 2014-05-26 17:26:47
$dictionary["Expan_intermediacion_franquicia"]["fields"]["expan_franquicia_expan_intermediacion_franquicia"] = array (
  'name' => 'expan_franquicia_expan_intermediacion_franquicia',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_intermediacion_franquicia',
  'source' => 'non-db',
  'module' => 'Expan_Franquicia',
  'bean_name' => 'Expan_Franquicia',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_INTERMEDIACION_FRANQUICIA_FROM_EXPAN_FRANQUICIA_TITLE',
  'id_name' => 'expan_franefc3nquicia_ida',
);
$dictionary["Expan_intermediacion_franquicia"]["fields"]["expan_franquicia_expan_intermediacion_franquicia_name"] = array (
  'name' => 'expan_franquicia_expan_intermediacion_franquicia_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_INTERMEDIACION_FRANQUICIA_FROM_EXPAN_FRANQUICIA_TITLE',
  'save' => true,
  'id_name' => 'expan_franefc3nquicia_ida',
  'link' => 'expan_franquicia_expan_intermediacion_franquicia',
  'table' => 'expan_franquicia',
  'module' => 'Expan_Franquicia',
  'rname' => 'name',
);
$dictionary["Expan_intermediacion_franquicia"]["fields"]["expan_franefc3nquicia_ida"] = array (
  'name' => 'expan_franefc3nquicia_ida',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_intermediacion_franquicia',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_INTERMEDIACION_FRANQUICIA_FROM_EXPAN_FRANQUICIA_TITLE',
);
