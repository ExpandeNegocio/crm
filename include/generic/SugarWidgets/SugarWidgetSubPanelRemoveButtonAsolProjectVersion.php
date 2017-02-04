<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class SugarWidgetSubPanelRemoveButtonAsolProjectVersion extends SugarWidgetField
{
	function displayHeaderCell(&$layout_def)
	{
		return '&nbsp;';
	}

	function displayList(&$layout_def)
	{

		global $app_strings;
		global $subpanel_item_count;

		$unique_id = $layout_def['subpanel_id']."_remove_".$subpanel_item_count; //bug 51512

		$parent_record_id = $_REQUEST['record'];
		$parent_module = $_REQUEST['module'];

		$action = 'DeleteRelationship';
		$record = $layout_def['fields']['ID'];
		$current_module=$layout_def['module'];

		$hideremove=false;

		// ASOL
		if ($current_module=='asol_ProjectVersion') {

			global $current_user;
				
			$asolProject = $GLOBALS['FOCUS'];
			$asolProjectId = $parent_record_id;
			$asolProjectVersionId = $record;
			$asolProjectVersionAssignedUserid = $layout_def['fields']['ASSIGNED_USER_ID'];

			if (!  (($current_user->id == $asolProject->assigned_user_id) || ($current_user->id == $asolProjectVersionAssignedUserid) || $current_user->is_admin)  ) {
				$hideremove=true;
			}
		}
		// ASOL

		$return_module = $_REQUEST['module'];
		$return_action = 'SubPanelViewer';
		$subpanel = $layout_def['subpanel_id'];
		$return_id = $_REQUEST['record'];
		if (isset($layout_def['linked_field_set']) && !empty($layout_def['linked_field_set'])) {
			$linked_field= $layout_def['linked_field_set'] ;
		} else {
			$linked_field = $layout_def['linked_field'];
		}
		$refresh_page = 0;
		if(!empty($layout_def['refresh_page'])){
			$refresh_page = 1;
		}
		$return_url = "index.php?module=$return_module&action=$return_action&subpanel=$subpanel&record=$return_id&sugar_body_only=1&inline=1";

		$icon_remove_text = strtolower($app_strings['LBL_ID_FF_REMOVE']);

		if($linked_field == 'get_emails_by_assign_or_link')
		$linked_field = 'emails';
		//based on listview since that lets you select records
		if($layout_def['ListView'] && !$hideremove) {
			$retStr = "<a href=\"javascript:sub_p_rem('$subpanel', '$linked_field'"
			.", '$record', $refresh_page);\""
			. ' class="listViewTdToolsS1"'
			. "id=$unique_id"
			. " onclick=\"return sp_rem_conf();\""
			. ">$icon_remove_text</a>";
			return $retStr;

		}else{
			return '';
		}
	}
}
