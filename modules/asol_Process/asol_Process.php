<?PHP
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

require_once('modules/asol_Process/___common_WFM/php/Basic_wfm.php');

class asol_Process extends Basic_wfm {

	var $new_schema = true;
	var $module_dir = 'asol_Process';
	var $object_name = 'asol_Process';
	var $table_name = 'asol_process';
	var $importable = false;
	var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $modified_by_name;
	var $created_by;
	var $created_by_name;
	var $description;
	var $deleted;
	var $created_by_link;
	var $modified_user_link;
	var $assigned_user_id;
	var $assigned_user_name;
	var $assigned_user_link;
	var $status;
	var $trigger_module;
	var $alternative_database;

	function asol_Process(){
		parent::Basic_wfm();
	}

	function getTriggerModule() {
		return $this->trigger_module;
	}

	function get_list_view_data() {

		$wfm_process_fields = parent::get_list_view_data();

		$LBL_FLOWCHART_BUTTON = translate('LBL_FLOWCHART_BUTTON','asol_Process');
		$LBL_ACTIVATE_WORKFLOW_BUTTON = translate('LBL_ACTIVATE_WORKFLOW_BUTTON','asol_Process');
		$LBL_INACTIVATE_WORKFLOW_BUTTON = translate('LBL_INACTIVATE_WORKFLOW_BUTTON','asol_Process');
		$LBL_DELETE_WORKFLOW_BUTTON = translate('LBL_DELETE_WORKFLOW_BUTTON','asol_Process');
		$LBL_EXPORT_WORKFLOW_BUTTON = translate('LBL_EXPORT_WORKFLOW_BUTTON','asol_Process');
		$LBL_IMPORT_WORKFLOW_BUTTON = translate('LBL_IMPORT_WORKFLOW_BUTTON','asol_Process');
		$LBL_VALIDATE_WORKFLOW_BUTTON = translate('LBL_VALIDATE_WORKFLOW_BUTTON','asol_Process');

		// FLOWCHART
		$flowChart = "<img src='modules/asol_Process/___common_WFM/images/flowChart.png' onClick='openFlowChartPopup(\"{$this->id}\", 100, 100);' title='{$LBL_FLOWCHART_BUTTON}' style='cursor: pointer;' />";
		$wfm_process_fields['FLOWCHART'] = $flowChart;

		// VALIDATE_WORKFLOW
		$validateWorkFlow = "<img src='modules/asol_Process/___common_WFM/images/validate.png' onClick='validateWorkFlow(\"{$this->id}\");' title='{$LBL_VALIDATE_WORKFLOW_BUTTON}' style='cursor: pointer;' />";
		$wfm_process_fields['VALIDATE_WORKFLOW'] = $validateWorkFlow;
				
		// ACTIVATE_INACTIVATE_WORKFLOW
		if ($this->status == 'active') {
			$inactivateWorkFlow = "<img src='modules/asol_Process/___common_WFM/images/inactivate.png' onClick='inactivateWorkFlow(\"{$this->id}\");' title='{$LBL_INACTIVATE_WORKFLOW_BUTTON}' style='cursor: pointer;' />";
			$wfm_process_fields['ACTIVATE_INACTIVATE_WORKFLOW'] = $inactivateWorkFlow;
		} else {
			$activateWorkFlow = "<img src='modules/asol_Process/___common_WFM/images/activate.png' onClick='activateWorkFlow(\"{$this->id}\");' title='{$LBL_ACTIVATE_WORKFLOW_BUTTON}' style='cursor: pointer;' />";
			$wfm_process_fields['ACTIVATE_INACTIVATE_WORKFLOW'] = $activateWorkFlow;
		}

		// DELETE_WORKFLOW
		$deleteWorkFlow = "<img src='modules/asol_Process/___common_WFM/images/delete.png' onClick='deleteWorkFlow(\"{$this->id}\");' title='{$LBL_DELETE_WORKFLOW_BUTTON}' style='cursor: pointer;' />";
		$wfm_process_fields['DELETE_WORKFLOW'] = $deleteWorkFlow;

		// EXPORT_WORKFLOW
		$exportWorkFlow = "<img src='modules/asol_Process/___common_WFM/images/export.png' onClick='return exportWorkFlow(\"{$this->id}\");' title='{$LBL_EXPORT_WORKFLOW_BUTTON}' style='cursor: pointer;' />";
		$wfm_process_fields['EXPORT_WORKFLOW'] = $exportWorkFlow;

		// IMPORT_WORKFLOW
		$importWorkFlow = "<img src='modules/asol_Process/___common_WFM/images/import.png' onClick='importWorkFlow(\"{$this->id}\");' title='{$LBL_IMPORT_WORKFLOW_BUTTON}' style='cursor: pointer;' />";
		$wfm_process_fields['IMPORT_WORKFLOW'] = $importWorkFlow;

		// STATUS
		$process_status = $this->status;
		$process_status_html = wfm_utils::getProcessStatusHtml($process_status);
		$wfm_process_fields['STATUS'] = $process_status_html;

		// ALTERNATIVE_DATABASE
		$focus = $this;
		$focusId = $this->id;
		require('modules/asol_Process/customFields/alternative_database.generate_select.php');
		$process_alternative_database_html = $alternative_database_select;

		$wfm_process_fields['ALTERNATIVE_DATABASE'] = $process_alternative_database_html;

		// TRIGGER_MODULE
		$focus = $this;
		$focusId = $this->id;
		require('modules/asol_Process/customFields/trigger_module.generate_select.php');
		$process_trigger_module_html = $selectModules;

		$wfm_process_fields['TRIGGER_MODULE'] = $process_trigger_module_html;

		return $wfm_process_fields;
	}
}
?>