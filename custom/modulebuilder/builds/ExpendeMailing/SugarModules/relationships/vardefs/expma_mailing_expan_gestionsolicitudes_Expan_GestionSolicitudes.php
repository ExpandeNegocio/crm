<?php
// created: 2015-01-29 10:43:56
$dictionary["Expan_GestionSolicitudes"]["fields"]["expma_mailing_expan_gestionsolicitudes"] = array (
  'name' => 'expma_mailing_expan_gestionsolicitudes',
  'type' => 'link',
  'relationship' => 'expma_mailing_expan_gestionsolicitudes',
  'source' => 'non-db',
  'module' => 'Expma_Mailing',
  'bean_name' => 'Expma_Mailing',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_GESTIONSOLICITUDES_FROM_EXPMA_MAILING_TITLE',
  'id_name' => 'expma_mailing_expan_gestionsolicitudesexpma_mailing_ida',
);
$dictionary["Expan_GestionSolicitudes"]["fields"]["expma_mailing_expan_gestionsolicitudes_name"] = array (
  'name' => 'expma_mailing_expan_gestionsolicitudes_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_GESTIONSOLICITUDES_FROM_EXPMA_MAILING_TITLE',
  'save' => true,
  'id_name' => 'expma_mailing_expan_gestionsolicitudesexpma_mailing_ida',
  'link' => 'expma_mailing_expan_gestionsolicitudes',
  'table' => 'expma_mailing',
  'module' => 'Expma_Mailing',
  'rname' => 'name',
);
$dictionary["Expan_GestionSolicitudes"]["fields"]["expma_mailing_expan_gestionsolicitudesexpma_mailing_ida"] = array (
  'name' => 'expma_mailing_expan_gestionsolicitudesexpma_mailing_ida',
  'type' => 'link',
  'relationship' => 'expma_mailing_expan_gestionsolicitudes',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_GESTIONSOLICITUDES_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
);
