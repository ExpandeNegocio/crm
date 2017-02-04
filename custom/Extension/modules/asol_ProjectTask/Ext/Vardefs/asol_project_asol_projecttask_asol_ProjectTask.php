<?php
// created: 2014-02-26 13:28:28
$dictionary["asol_ProjectTask"]["fields"]["asol_project_asol_projecttask"] = array (
  'name' => 'asol_project_asol_projecttask',
  'type' => 'link',
  'relationship' => 'asol_project_asol_projecttask',
  'source' => 'non-db',
  'module' => 'asol_Project',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTTASK_FROM_ASOL_PROJECT_TITLE',
  'id_name' => 'asol_project_asol_projecttaskasol_project_ida',
);
$dictionary["asol_ProjectTask"]["fields"]["asol_project_asol_projecttask_name"] = array (
  'name' => 'asol_project_asol_projecttask_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTTASK_FROM_ASOL_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'asol_project_asol_projecttaskasol_project_ida',
  'link' => 'asol_project_asol_projecttask',
  'table' => 'asol_project',
  'module' => 'asol_Project',
  'rname' => 'name',
);
$dictionary["asol_ProjectTask"]["fields"]["asol_project_asol_projecttaskasol_project_ida"] = array (
  'name' => 'asol_project_asol_projecttaskasol_project_ida',
  'type' => 'link',
  'relationship' => 'asol_project_asol_projecttask',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ASOL_PROJECT_ASOL_PROJECTTASK_FROM_ASOL_PROJECTTASK_TITLE',
);
