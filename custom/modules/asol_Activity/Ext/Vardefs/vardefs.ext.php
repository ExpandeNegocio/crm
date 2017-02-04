<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2011-04-05 11:16:36
$dictionary["asol_Activity"]["fields"]["asol_activity_asol_activity"] = array (
  'name' => 'asol_activity_asol_activity',
  'type' => 'link',
  'relationship' => 'asol_activity_asol_activity',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_L_TITLE',
);
$dictionary["asol_Activity"]["fields"]["asol_activity_asol_activity_name"] = array (
  'name' => 'asol_activity_asol_activity_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_L_TITLE',
  'save' => true,
  'id_name' => 'asol_activ898activity_ida',
  'link' => 'asol_activity_asol_activity',
  'table' => 'asol_activity',
  'module' => 'asol_Activity',
  'rname' => 'name',
);
$dictionary["asol_Activity"]["fields"]["asol_activ898activity_ida"] = array (
  'name' => 'asol_activ898activity_ida',
  'type' => 'link',
  'relationship' => 'asol_activity_asol_activity',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_R_TITLE',
);


// created: 2011-04-05 11:16:12
$dictionary["asol_Activity"]["fields"]["asol_activity_asol_task"] = array (
  'name' => 'asol_activity_asol_task',
  'type' => 'link',
  'relationship' => 'asol_activity_asol_task',
  'source' => 'non-db',
  'side' => 'right',
  'vname' => 'LBL_ASOL_ACTIVITY_ASOL_TASK_FROM_ASOL_TASK_TITLE',
);


// created: 2011-03-22 13:25:17
$dictionary["asol_Activity"]["fields"]["asol_events_asol_activity"] = array (
  'name' => 'asol_events_asol_activity',
  'type' => 'link',
  'relationship' => 'asol_events_asol_activity',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_EVENTS_TITLE',
);
$dictionary["asol_Activity"]["fields"]["asol_events_asol_activity_name"] = array (
  'name' => 'asol_events_asol_activity_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_EVENTS_TITLE',
  'save' => true,
  'id_name' => 'asol_event87f4_events_ida',
  'link' => 'asol_events_asol_activity',
  'table' => 'asol_events',
  'module' => 'asol_Events',
  'rname' => 'name',
);
$dictionary["asol_Activity"]["fields"]["asol_event87f4_events_ida"] = array (
  'name' => 'asol_event87f4_events_ida',
  'type' => 'link',
  'relationship' => 'asol_events_asol_activity',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_TITLE',
);

?>