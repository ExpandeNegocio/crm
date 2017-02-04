<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2014-02-26 13:28:29
$dictionary["asol_ProjectTask"]["fields"]["asol_projecttask_activities_calls"] = array (
  'name' => 'asol_projecttask_activities_calls',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_calls',
  'source' => 'non-db',
  'module' => 'Calls',
  'bean_name' => 'Call',
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_CALLS_FROM_CALLS_TITLE',
);


// created: 2014-02-26 13:28:29
$dictionary["asol_ProjectTask"]["fields"]["asol_projecttask_activities_emails"] = array (
  'name' => 'asol_projecttask_activities_emails',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_emails',
  'source' => 'non-db',
  'module' => 'Emails',
  'bean_name' => 'Email',
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_EMAILS_FROM_EMAILS_TITLE',
);


// created: 2014-02-26 13:28:29
$dictionary["asol_ProjectTask"]["fields"]["asol_projecttask_activities_meetings"] = array (
  'name' => 'asol_projecttask_activities_meetings',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_meetings',
  'source' => 'non-db',
  'module' => 'Meetings',
  'bean_name' => 'Meeting',
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_MEETINGS_FROM_MEETINGS_TITLE',
);


// created: 2014-02-26 13:28:29
$dictionary["asol_ProjectTask"]["fields"]["asol_projecttask_activities_notes"] = array (
  'name' => 'asol_projecttask_activities_notes',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_notes',
  'source' => 'non-db',
  'module' => 'Notes',
  'bean_name' => 'Note',
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_NOTES_FROM_NOTES_TITLE',
);


// created: 2014-02-26 13:28:29
$dictionary["asol_ProjectTask"]["fields"]["asol_projecttask_activities_tasks"] = array (
  'name' => 'asol_projecttask_activities_tasks',
  'type' => 'link',
  'relationship' => 'asol_projecttask_activities_tasks',
  'source' => 'non-db',
  'module' => 'Tasks',
  'bean_name' => 'Task',
  'vname' => 'LBL_ASOL_PROJECTTASK_ACTIVITIES_TASKS_FROM_TASKS_TITLE',
);


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

?>