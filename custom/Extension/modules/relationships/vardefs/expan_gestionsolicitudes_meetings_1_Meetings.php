<?php
// created: 2014-08-01 19:48:27
$dictionary["Meeting"]["fields"]["expan_gestionsolicitudes_meetings_1"] = array (
  'name' => 'expan_gestionsolicitudes_meetings_1',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_meetings_1',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_MEETINGS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'id_name' => 'expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida',
);
$dictionary["Meeting"]["fields"]["expan_gestionsolicitudes_meetings_1_name"] = array (
  'name' => 'expan_gestionsolicitudes_meetings_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_MEETINGS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'save' => true,
  'id_name' => 'expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida',
  'link' => 'expan_gestionsolicitudes_meetings_1',
  'table' => 'expan_gestionsolicitudes',
  'module' => 'Expan_GestionSolicitudes',
  'rname' => 'name',
);
$dictionary["Meeting"]["fields"]["expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida"] = array (
  'name' => 'expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_meetings_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_MEETINGS_1_FROM_MEETINGS_TITLE',
);
