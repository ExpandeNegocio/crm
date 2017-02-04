<?php
// created: 2014-03-28 12:34:39
$dictionary["asol_ProjectVersion"]["fields"]["asol_project_asol_projectversion"] = array (
  'name' => 'asol_project_asol_projectversion',
  'type' => 'link',
  'relationship' => 'asol_project_asol_projectversion',
  'source' => 'non-db',
  'module' => 'asol_Project',
  'bean_name' => 'asol_Project',
  'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
  'id_name' => 'asol_project_asol_projectversionasol_project_ida',
);
$dictionary["asol_ProjectVersion"]["fields"]["asol_project_asol_projectversion_name"] = array (
  'name' => 'asol_project_asol_projectversion_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'asol_project_asol_projectversionasol_project_ida',
  'link' => 'asol_project_asol_projectversion',
  'table' => 'asol_project',
  'module' => 'asol_Project',
  'rname' => 'name',
);
$dictionary["asol_ProjectVersion"]["fields"]["asol_project_asol_projectversionasol_project_ida"] = array (
  'name' => 'asol_project_asol_projectversionasol_project_ida',
  'type' => 'link',
  'relationship' => 'asol_project_asol_projectversion',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECTVERSION_TITLE',
);
