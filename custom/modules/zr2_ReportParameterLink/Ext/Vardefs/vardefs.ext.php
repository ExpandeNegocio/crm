<?php 
 //WARNING: The contents of this file are auto-generated


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


// created: 2012-06-15 10:55:30
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_reportparameterlink_zr2_reportparameter"] = array (
  'name' => 'zr2_reportparameterlink_zr2_reportparameter',
  'type' => 'link',
  'relationship' => 'zr2_reportparameterlink_zr2_reportparameter',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETER_TITLE',
  'id_name' => 'zr2_report29aerameter_ida',
);
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_reportparameterlink_zr2_reportparameter_name"] = array (
  'name' => 'zr2_reportparameterlink_zr2_reportparameter_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETER_TITLE',
  'save' => true,
  'id_name' => 'zr2_report29aerameter_ida',
  'link' => 'zr2_reportparameterlink_zr2_reportparameter',
  'table' => 'zr2_reportparameter',
  'module' => 'zr2_ReportParameter',
  'rname' => 'name',
);
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_report29aerameter_ida"] = array (
  'name' => 'zr2_report29aerameter_ida',
  'type' => 'link',
  'relationship' => 'zr2_reportparameterlink_zr2_reportparameter',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETERLINK_TITLE',
);


// created: 2012-06-15 10:55:30
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_reportparameterlink_zr2_reporttemplate"] = array (
  'name' => 'zr2_reportparameterlink_zr2_reporttemplate',
  'type' => 'link',
  'relationship' => 'zr2_reportparameterlink_zr2_reporttemplate',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTTEMPLATE_TITLE',
  'id_name' => 'zr2_report313cemplate_ida',
);
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_reportparameterlink_zr2_reporttemplate_name"] = array (
  'name' => 'zr2_reportparameterlink_zr2_reporttemplate_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTTEMPLATE_TITLE',
  'save' => true,
  'id_name' => 'zr2_report313cemplate_ida',
  'link' => 'zr2_reportparameterlink_zr2_reporttemplate',
  'table' => 'zr2_reporttemplate',
  'module' => 'zr2_ReportTemplate',
  'rname' => 'name',
);
$dictionary["zr2_ReportParameterLink"]["fields"]["zr2_report313cemplate_ida"] = array (
  'name' => 'zr2_report313cemplate_ida',
  'type' => 'link',
  'relationship' => 'zr2_reportparameterlink_zr2_reporttemplate',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTPARAMETERLINK_TITLE',
);

?>