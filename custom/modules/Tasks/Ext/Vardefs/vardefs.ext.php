<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2014-02-26 13:28:29
$dictionary["Task"]["fields"]["asol_projecttask_activities_tasks"] = array (
  'name' => 'asol_projecttask_activities_tasks',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_tasks',
  'source' => 'non-db',
  'module' => 'asol_ProjectTask',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_TASKS_FROM_ASOL_PROJECTTASK_TITLE',
);


// created: 2014-02-26 13:28:27
$dictionary["Task"]["fields"]["asol_project_activities_tasks"] = array (
  'name' => 'asol_project_activities_tasks',
  'type' => 'link',
  'relationship' => 'asol_project_activities_tasks',
  'source' => 'non-db',
  'module' => 'asol_Project',
  'bean_name' => false,
  'vname' => 'LBL_ASOL_PROJECT_ACTIVITIES_TASKS_FROM_ASOL_PROJECT_TITLE',
);


// created: 2015-12-22 08:00:19
$dictionary["Task"]["fields"]["expan_franquicia_tasks_1"] = array (
  'name' => 'expan_franquicia_tasks_1',
  'type' => 'link',
  'relationship' => 'expan_franquicia_tasks_1',
  'source' => 'non-db',
  'module' => 'Expan_Franquicia',
  'bean_name' => 'Expan_Franquicia',
  'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_EXPAN_FRANQUICIA_TITLE',
  'id_name' => 'expan_franquicia_tasks_1expan_franquicia_ida',
);
$dictionary["Task"]["fields"]["expan_franquicia_tasks_1_name"] = array (
  'name' => 'expan_franquicia_tasks_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_EXPAN_FRANQUICIA_TITLE',
  'save' => true,
  'id_name' => 'expan_franquicia_tasks_1expan_franquicia_ida',
  'link' => 'expan_franquicia_tasks_1',
  'table' => 'expan_franquicia',
  'module' => 'Expan_Franquicia',
  'rname' => 'name',
);
$dictionary["Task"]["fields"]["expan_franquicia_tasks_1expan_franquicia_ida"] = array (
  'name' => 'expan_franquicia_tasks_1expan_franquicia_ida',
  'type' => 'link',
  'relationship' => 'expan_franquicia_tasks_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_TASKS_TITLE',
);


// created: 2014-12-20 18:56:29
$dictionary["Task"]["fields"]["expan_gestionsolicitudes_activities_1_tasks"] = array (
  'name' => 'expan_gestionsolicitudes_activities_1_tasks',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_activities_1_tasks',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_ACTIVITIES_1_TASKS_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
);


// created: 2014-08-01 19:44:14
$dictionary["Task"]["fields"]["expan_gestionsolicitudes_tasks_1"] = array (
  'name' => 'expan_gestionsolicitudes_tasks_1',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_tasks_1',
  'source' => 'non-db',
  'module' => 'Expan_GestionSolicitudes',
  'bean_name' => 'Expan_GestionSolicitudes',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'id_name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
);
$dictionary["Task"]["fields"]["expan_gestionsolicitudes_tasks_1_name"] = array (
  'name' => 'expan_gestionsolicitudes_tasks_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'save' => true,
  'id_name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
  'link' => 'expan_gestionsolicitudes_tasks_1',
  'table' => 'expan_gestionsolicitudes',
  'module' => 'Expan_GestionSolicitudes',
  'rname' => 'name',
);
$dictionary["Task"]["fields"]["expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida"] = array (
  'name' => 'expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida',
  'type' => 'link',
  'relationship' => 'expan_gestionsolicitudes_tasks_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_TASKS_TITLE',
);

?>