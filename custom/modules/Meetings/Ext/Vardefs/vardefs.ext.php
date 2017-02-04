<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2014-02-26 13:28:29
$dictionary["Meeting"]["fields"]["asol_projecttask_activities_meetings"] = array (
  'name' => 'asol_projecttask_activities_meetings',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_meetings',
  'source' => 'non-db',
  'module' => 'asol_ProjectTask',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_MEETINGS_FROM_ASOL_PROJECTTASK_TITLE',
);


// created: 2014-02-26 13:28:27
$dictionary["Meeting"]["fields"]["asol_project_activities_meetings"] = array (
  'name' => 'asol_project_activities_meetings',
  'type' => 'link',
  'relationship' => 'asol_project_activities_meetings',
  'source' => 'non-db',
  'module' => 'asol_Project',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECT_ACTIVITIES_MEETINGS_FROM_ASOL_PROJECT_TITLE',
);


// created: 2014-12-20 18:56:25
$dictionary["Meeting"]["fields"]["expan_gestionsolicitudes_activities_1_meetings"] = array (
  'name' => 'expan_gestionsolicitudes_activities_1_meetings',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_activities_1_meetings',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_ACTIVITIES_1_MEETINGS_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
);


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

?>