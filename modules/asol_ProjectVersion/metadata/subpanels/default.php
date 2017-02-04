<?php
require_once('modules/asol_Project/asolProjectUtils.php');
require_once('modules/asol_Project/resources/jQueryGantt-master/server/ganttServerUtils.php');

global $current_user;

$asolProject = $GLOBALS['FOCUS'];

// Can user see not published AsolProjectVersions?
$where = "asol_projectversion.type = 'baseline'";
$where .= (checkIfCanViewNotPublishedAsolProjectVersion($asolProject->id, $current_user->id)) ? '' : ' AND asol_projectversion.is_published = 1';

$module_name='asol_ProjectVersion';
$subpanel_layout = array (
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'popup_module' => 'asol_ProjectVersion',
    ),
  ),
  'where' => $where,
  'list_fields' => 
  array (
    'version_number' => 
    array (
      'type' => 'int',
      'vname' => 'LBL_VERSION_NUMBER',
      'width' => '10%',
      'default' => true,
    ),
    'name' => 
    array (
      'vname' => 'LBL_NAME',
      'widget_class' => 'SubPanelDetailViewLink',
      'width' => '45%',
      'default' => true,
    ),
    'assigned_user_name' => 
    array (
      'link' => false,
      'type' => 'relate',
      'vname' => 'LBL_ASSIGNED_TO_NAME',
      'id' => 'ASSIGNED_USER_ID',
      'width' => '10%',
      'default' => true,
      //'widget_class' => 'SubPanelDetailViewLink',
      'target_module' => 'Users',
      'target_record_key' => 'assigned_user_id',
    ),
    'is_published' => 
    array (
      'type' => 'bool',
      'default' => true,
      'vname' => 'LBL_IS_PUBLISHED',
      'width' => '10%',
    ),
    'published_datetime' => 
    array (
      'type' => 'datetimecombo',
      'vname' => 'LBL_PUBLISHED_DATETIME',
      'width' => '10%',
      'default' => true,
    ),
	  'description' => 
	  array (
	    'type' => 'text',
	    'vname' => 'LBL_DESCRIPTION',
	    'sortable' => false,
	    'width' => '10%',
	    'default' => true,
	  ),
	  
    'edit_button' => 
    array (
      'vname' => 'LBL_EDIT_BUTTON',
      'widget_class' => 'SubPanelEditButton',
      'module' => 'asol_ProjectVersion',
      'width' => '4%',
      'default' => true,
    ),
    'remove_button' => 
    array (
      'vname' => 'LBL_REMOVE',
      'widget_class' => 'SubPanelRemoveButtonAsolProjectVersion',
      'module' => 'asol_ProjectVersion',
      'width' => '5%',
      'default' => true,
    ),
    
  ),
);
