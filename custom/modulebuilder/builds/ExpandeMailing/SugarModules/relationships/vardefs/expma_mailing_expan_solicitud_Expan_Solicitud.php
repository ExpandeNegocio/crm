<?php
// created: 2015-01-31 10:20:16
$dictionary["Expan_Solicitud"]["fields"]["expma_mailing_expan_solicitud"] = array (
  'name' => 'expma_mailing_expan_solicitud',
  'type' => 'link',
  'relationship' => 'expma_mailing_expan_solicitud',
  'source' => 'non-db',
  'module' => 'Expma_Mailing',
  'bean_name' => 'Expma_Mailing',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_SOLICITUD_FROM_EXPMA_MAILING_TITLE',
  'id_name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
);
$dictionary["Expan_Solicitud"]["fields"]["expma_mailing_expan_solicitud_name"] = array (
  'name' => 'expma_mailing_expan_solicitud_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_SOLICITUD_FROM_EXPMA_MAILING_TITLE',
  'save' => true,
  'id_name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
  'link' => 'expma_mailing_expan_solicitud',
  'table' => 'expma_mailing',
  'module' => 'Expma_Mailing',
  'rname' => 'name',
);
$dictionary["Expan_Solicitud"]["fields"]["expma_mailing_expan_solicitudexpma_mailing_ida"] = array (
  'name' => 'expma_mailing_expan_solicitudexpma_mailing_ida',
  'type' => 'link',
  'relationship' => 'expma_mailing_expan_solicitud',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPMA_MAILING_EXPAN_SOLICITUD_FROM_EXPAN_SOLICITUD_TITLE',
);
