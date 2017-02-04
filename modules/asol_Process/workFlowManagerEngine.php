<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $sugar_config;

// Disable workFlowManagerEngine if needed
$WFM_disable_wfm_completely = ((isset($sugar_config['WFM_disable_wfm_completely'])) && ($sugar_config['WFM_disable_wfm_completely'])) ? true : false;
$WFM_disable_workFlowManagerEngine = ((isset($sugar_config['WFM_disable_workFlowManagerEngine'])) && ($sugar_config['WFM_disable_workFlowManagerEngine'])) ? true : false;

if ($WFM_disable_wfm_completely || $WFM_disable_workFlowManagerEngine) {
	wfm_utils::wfm_log('asol', "EXIT by sugar_config WFM_disable", __FILE__, __METHOD__, __LINE__);
	exit();
}

require_once("modules/asol_Process/wfm_engine_functions.php");

wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

$executionType = (!isset($_REQUEST['execution_type'])) ? "logic_hook" : $_REQUEST['execution_type'];

switch ($executionType) {

	case 'logic_hook':
		wfm_utils::wfm_log('asol', "logic_hook execution", __FILE__, __METHOD__, __LINE__);

		// Retrieve bean_variable_arrays
		$old_bean = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['old_bean']);
		$new_bean = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['new_bean']);
		$server = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['server']);
		$request = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['request']);
		$current_user_array = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['current_user_array']);
		$env = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['env']);

		$working_nodes = instanciate_processes__logic_hook($_REQUEST['trigger_module'], $_REQUEST['trigger_event'], $_REQUEST['bean_id'], $_REQUEST['current_user_id'], $_REQUEST['bean_ungreedy_count'], $old_bean, $new_bean, $server, $request, $current_user_array, $env);

		if (count($working_nodes) > 0) {
			execute_WFM($working_nodes);
			execute_WFM(); // more than 1 next_activity => current_working_node dies and WFM creates new working_nodes
		}

		break;

	case 'on_hold':
		wfm_utils::wfm_log('asol', "on_hold execution", __FILE__, __METHOD__, __LINE__);

		//execute_WFM(); // In logic_hooks.php is set the order -> first wfm_on_hold and then wfm_hook in order to not wait until 1 minute(crontab) to execute the WFM // and with this is not necessary a curl-request from wfm_on_hold

		break;

	case 'crontab':
		wfm_utils::wfm_log('debug', "crontab execution", __FILE__, __METHOD__, __LINE__);

		wfm_utils::wfm_echo('crontab', "WFM is going to be executed...");
		execute_WFM();
		wfm_utils::wfm_echo('crontab', "<b>WFM executed.</b>");

		break;

	case 'scheduled':
		wfm_utils::wfm_log('asol', "scheduled execution", __FILE__, __METHOD__, __LINE__);

		switch ($_REQUEST['scheduled_type']) {
			case 'sequential':
				$scheduled_event_info = wfm_utils::wfm_convert_curl_parameter_to_array($_REQUEST['scheduled_event_info']);
				instanciate_processes__scheduled_sequential($scheduled_event_info);
				break;
			case 'parallel':
				instanciate_processes__scheduled_parallel($_REQUEST['event_id'], $_REQUEST['alternative_database'], $_REQUEST['trigger_module'], $_REQUEST['num_objects'], $_REQUEST['iter_object'], $_REQUEST['object_id']);
				break;
		}

		execute_WFM();

		break;
}

wfm_utils::wfm_log('debug', "EXIT", __FILE__);
?>