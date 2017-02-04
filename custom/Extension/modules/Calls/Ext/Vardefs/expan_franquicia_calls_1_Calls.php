<?php
// created: 2015-12-22 07:59:48
$dictionary["Call"]["fields"]["expan_franquicia_calls_1"] = array (
  'name' => 'expan_franquicia_calls_1',
  'type' => 'link',
  'relationship' => 'expan_franquicia_calls_1',
  'source' => 'non-db',
  'module' => 'Expan_Franquicia',
  'bean_name' => 'Expan_Franquicia',
  'vname' => 'LBL_EXPAN_FRANQUICIA_CALLS_1_FROM_EXPAN_FRANQUICIA_TITLE',
  'id_name' => 'expan_franquicia_calls_1expan_franquicia_ida',
);
$dictionary["Call"]["fields"]["expan_franquicia_calls_1_name"] = array (
  'name' => 'expan_franquicia_calls_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_FRANQUICIA_CALLS_1_FROM_EXPAN_FRANQUICIA_TITLE',
  'save' => true,
  'id_name' => 'expan_franquicia_calls_1expan_franquicia_ida',
  'link' => 'expan_franquicia_calls_1',
  'table' => 'expan_franquicia',
  'module' => 'Expan_Franquicia',
  'rname' => 'name',
);
$dictionary["Call"]["fields"]["expan_franquicia_calls_1expan_franquicia_ida"] = array (
  'name' => 'expan_franquicia_calls_1expan_franquicia_ida',
  'type' => 'link',
  'relationship' => 'expan_franquicia_calls_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_FRANQUICIA_CALLS_1_FROM_CALLS_TITLE',
);
