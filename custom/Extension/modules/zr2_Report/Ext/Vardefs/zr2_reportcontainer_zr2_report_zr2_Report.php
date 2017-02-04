<?php
// created: 2012-06-15 10:55:29
$dictionary["zr2_Report"]["fields"]["zr2_reportcontainer_zr2_report"] = array (
  'name' => 'zr2_reportcontainer_zr2_report',
  'type' => 'link',
  'relationship' => 'zr2_reportcontainer_zr2_report',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTCONTAINER_ZR2_REPORT_FROM_ZR2_REPORTCONTAINER_TITLE',
  'id_name' => 'zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida',
);
$dictionary["zr2_Report"]["fields"]["zr2_reportcontainer_zr2_report_name"] = array (
  'name' => 'zr2_reportcontainer_zr2_report_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ZR2_REPORTCONTAINER_ZR2_REPORT_FROM_ZR2_REPORTCONTAINER_TITLE',
  'save' => true,
  'id_name' => 'zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida',
  'link' => 'zr2_reportcontainer_zr2_report',
  'table' => 'zr2_reportcontainer',
  'module' => 'zr2_ReportContainer',
  'rname' => 'name',
);
$dictionary["zr2_Report"]["fields"]["zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida"] = array (
  'name' => 'zr2_reportcontainer_zr2_reportzr2_reportcontainer_ida',
  'type' => 'link',
  'relationship' => 'zr2_reportcontainer_zr2_report',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ZR2_REPORTCONTAINER_ZR2_REPORT_FROM_ZR2_REPORT_TITLE',
);
