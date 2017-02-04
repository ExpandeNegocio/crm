<?php
// created: 2011-03-22 13:25:17
$dictionary["asol_Events"]["fields"]["asol_process_asol_events"] = array (
  'name' => 'asol_process_asol_events',
  'type' => 'link',
  'relationship' => 'asol_process_asol_events',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_PROCESS_ASOL_EVENTS_FROM_ASOL_PROCESS_TITLE',
);
$dictionary["asol_Events"]["fields"]["asol_process_asol_events_name"] = array (
  'name' => 'asol_process_asol_events_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ASOL_PROCESS_ASOL_EVENTS_FROM_ASOL_PROCESS_TITLE',
  'save' => true,
  'id_name' => 'asol_proce6f14process_ida',
  'link' => 'asol_process_asol_events',
  'table' => 'asol_process',
  'module' => 'asol_Process',
  'rname' => 'name',
);
$dictionary["asol_Events"]["fields"]["asol_proce6f14process_ida"] = array (
  'name' => 'asol_proce6f14process_ida',
  'type' => 'link',
  'relationship' => 'asol_process_asol_events',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ASOL_PROCESS_ASOL_EVENTS_FROM_ASOL_EVENTS_TITLE',
);
