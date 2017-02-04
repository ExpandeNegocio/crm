<?php
// created: 2014-05-26 17:26:47
$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_expan_intermediacion_franquicia"] = array (
  'name' => 'expan_franquicia_expan_intermediacion_franquicia',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_intermediacion_franquicia',
  'source' => 'non-db',
  'module' => 'Expan_intermediacion_franquicia',
  'bean_name' => 'Expan_intermediacion_franquicia',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_INTERMEDIACION_FRANQUICIA_FROM_EXPAN_INTERMEDIACION_FRANQUICIA_TITLE',
  'id_name' => 'expan_fran841cnquicia_idb',
);
$dictionary["Expan_Franquicia"]["fields"]["expan_franquicia_expan_intermediacion_franquicia_name"] = array (
  'name' => 'expan_franquicia_expan_intermediacion_franquicia_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_INTERMEDIACION_FRANQUICIA_FROM_EXPAN_INTERMEDIACION_FRANQUICIA_TITLE',
  'save' => true,
  'id_name' => 'expan_fran841cnquicia_idb',
  'link' => 'expan_franquicia_expan_intermediacion_franquicia',
  'table' => 'expan_intermediacion_franquicia',
  'module' => 'Expan_intermediacion_franquicia',
  'rname' => 'name',
);
$dictionary["Expan_Franquicia"]["fields"]["expan_fran841cnquicia_idb"] = array (
  'name' => 'expan_fran841cnquicia_idb',
  'type' => 'link',
  'relationship' => 'expan_franquicia_expan_intermediacion_franquicia',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_EXPAN_FRANQUICIA_EXPAN_INTERMEDIACION_FRANQUICIA_FROM_EXPAN_INTERMEDIACION_FRANQUICIA_TITLE',
);
