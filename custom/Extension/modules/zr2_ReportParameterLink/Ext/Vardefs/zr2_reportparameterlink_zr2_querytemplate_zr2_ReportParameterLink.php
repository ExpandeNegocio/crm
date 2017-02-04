<?php
// created: 2012-06-15 10:55:30
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_reportparameterlink_zr2_querytemplate"] = array (
  'name' => 'zr2_reportparameterlink_zr2_querytemplate',
  'type' => 'link',
  'relationship' => 'zr2_reportparameterlink_zr2_querytemplate',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_QUERYTEMPLATE_TITLE',
  'id_name' => 'zr2_query313cemplate_ida',
);
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_reportparameterlink_zr2_querytemplate_name"] = array (
  'name' => 'zr2_reportparameterlink_zr2_querytemplate_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_QUERYTEMPLATE_TITLE',
  'save' => true,
  'id_name' => 'zr2_query313cemplate_ida',
  'link' => 'zr2_reportparameterlink_zr2_querytemplate',
  'table' => 'zr2_querytemplate',
  'module' => 'zr2_QueryTemplate',
  'rname' => 'name',
);
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_query313cemplate_ida"] = array (
  'name' => 'zr2_query313cemplate_ida',
  'type' => 'link',
  'relationship' => 'zr2_reportparameterlink_zr2_querytemplate',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_REPORTPARAMETERLINK_TITLE',
);
