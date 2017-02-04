<?php
$index = (isset($_REQUEST['record'])) ? $_REQUEST['record'] : "";

$layout_defs["asol_Events"]["subpanel_setup"]["asol_events_asol_activity"] = array (
  'order' => 100,
  'module' => 'asol_Activity',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_EVENTS_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_TITLE',
  'get_subpanel_data' => 'asol_events_asol_activity',
  'top_buttons' => 
  array (
    0 => 
    array (
      //'widget_class' => 'SubPanelTopButtonQuickCreate',
      'widget_class' => 'SubPanelTopButtonAsolCreateActivity',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect&parent_module=asol_Events&parent_id='.$index,
    ),
  ),
);
?>