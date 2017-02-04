<?php
// created: 2016-11-29 19:35:37
$dictionary["Expan_IncidenciaCorreo"]["fields"]["expan_gestionsolicitudes_expan_incidenciacorreo_1"] = array (
  'name' => 'expan_gestionsolicitudes_expan_incidenciacorreo_1',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_expan_incidenciacorreo_1',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_EXPAN_INCIDENCIACORREO_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'id_name' => 'expan_gest1b5ecitudes_ida',
);
$dictionary["Expan_IncidenciaCorreo"]["fields"]["expan_gestionsolicitudes_expan_incidenciacorreo_1_name"] = array (
  'name' => 'expan_gestionsolicitudes_expan_incidenciacorreo_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_EXPAN_INCIDENCIACORREO_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'save' => true,
  'id_name' => 'expan_gest1b5ecitudes_ida',
  'link' => 'expan_gestionsolicitudes_expan_incidenciacorreo_1',
  'table' => 'expan_gestionsolicitudes',
  'module' => 'Expan_GestionSolicitudes',
  'rname' => 'name',
);
$dictionary["Expan_IncidenciaCorreo"]["fields"]["expan_gest1b5ecitudes_ida"] = array (
  'name' => 'expan_gest1b5ecitudes_ida',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_expan_incidenciacorreo_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_EXPAN_INCIDENCIACORREO_1_FROM_EXPAN_INCIDENCIACORREO_TITLE',
);
