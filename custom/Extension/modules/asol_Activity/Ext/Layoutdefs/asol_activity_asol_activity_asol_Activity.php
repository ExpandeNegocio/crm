<?php
// created: 2011-04-05 11:16:36
$index = (isset($_REQUEST['record'])) ? $_REQUEST['record'] : "";

$layout_defs["asol_Activity"]["subpanel_setup"]["asol_activ898activity_ida"] = array (
  'order' => 100,
  'module' => 'asol_Activity',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_ACTIVITY_ASOL_ACTIVITY_FROM_ASOL_ACTIVITY_R_TITLE',
  'get_subpanel_data' => 'asol_activ898activity_ida',
  'top_buttons' => 
  array (
    0 => 
    array (
      //'widget_class' => 'SubPanelTopButtonQuickCreate',
      'widget_class' => 'SubPanelTopButtonAsolCreateNextActivity',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect&parent_module=asol_Activity&parent_id='.$index,
    ),
  ),
);
