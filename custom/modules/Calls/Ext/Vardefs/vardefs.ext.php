<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2014-02-26 13:28:29
$dictionary["Call"]["fields"]["asol_projecttask_activities_calls"] = array (
  'name' => 'asol_projecttask_activities_calls',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_calls',
  'source' => 'non-db',
  'module' => 'asol_ProjectTask',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_CALLS_FROM_ASOL_PROJECTTASK_TITLE',
);


// created: 2014-02-26 13:28:27
$dictionary["Call"]["fields"]["asol_project_activities_calls"] = array (
  'name' => 'asol_project_activities_calls',
  'type' => 'link',
  'relationship' => 'asol_project_activities_calls',
  'source' => 'non-db',
  'module' => 'asol_Project',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECT_ACTIVITIES_CALLS_FROM_ASOL_PROJECT_TITLE',
);


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


// created: 2014-12-20 18:56:34
$dictionary["Call"]["fields"]["expan_gestionsolicitudes_activities_1_calls"] = array (
  'name' => 'expan_gestionsolicitudes_activities_1_calls',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_activities_1_calls',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_ACTIVITIES_1_CALLS_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
);


// created: 2014-08-01 19:02:05
$dictionary["Call"]["fields"]["expan_gestionsolicitudes_calls_1"] = array (
  'name' => 'expan_gestionsolicitudes_calls_1',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_calls_1',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_CALLS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'id_name' => 'expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida',
);
$dictionary["Call"]["fields"]["expan_gestionsolicitudes_calls_1_name"] = array (
  'name' => 'expan_gestionsolicitudes_calls_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_CALLS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'save' => true,
  'id_name' => 'expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida',
  'link' => 'expan_gestionsolicitudes_calls_1',
  'table' => 'expan_gestionsolicitudes',
  'module' => 'Expan_GestionSolicitudes',
  'rname' => 'name',
);
$dictionary["Call"]["fields"]["expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida"] = array (
  'name' => 'expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_calls_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_CALLS_1_FROM_CALLS_TITLE',
);

?>