<?php

$index = (isset($_REQUEST['record'])) ? $_REQUEST['record'] : "";

$layout_defs["asol_Process"]["subpanel_setup"]["asol_process_asol_events2"] = array (
  'order' => 100,
  'module' => 'asol_Events',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROCESS_ASOL_EVENTS_FROM_ASOL_EVENTS_TITLE',
  'get_subpanel_data' => 'asol_process_asol_events',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonAsolCreateEvent',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect&parent_module=asol_Process&parent_id='.$index,
    ),
  ),
);
?>
