<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

require_once("include/SugarEmailAddress/SugarEmailAddress.php");

class wfm_hook_process {

	function execute_process(&$bean, $event, $arguments='login_failed') {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
				
		global $sugar_config;
		
		// Disable wfm_hook if needed
		$WFM_disable_wfm_completely = ((isset($sugar_config['WFM_disable_wfm_completely'])) && ($sugar_config['WFM_disable_wfm_completely'])) ? true : false;
		$WFM_disable_wfmHook = ((isset($sugar_config['WFM_disable_wfmHook'])) && ($sugar_config['WFM_disable_wfmHook'])) ? true : false;
		
		if ($WFM_disable_wfm_completely || $WFM_disable_wfmHook) {
			wfm_utils::wfm_log('asol', "EXIT by sugar_config WFM_disable", __FILE__, __METHOD__, __LINE__);
			return;
		}
		
		wfm_utils::wfm_log('debug', "\$bean->module_dir=[{$bean->module_dir}], \$bean->name=[{$bean->name}], \$bean->id=[{$bean->id}], \$event=[{$event}]", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', '$bean=['.print_r($bean, true).']', __FILE__, __METHOD__, __LINE__);

		wfm_utils::wfm_log('debug', '***********LOGIC_HOOK**************', __FILE__, __METHOD__, __LINE__);

		global $current_user, $sugar_config, $db;

		$trigger_module = (!empty($bean->module_dir)) ? $bean->module_dir : $_REQUEST['module'];
		$trigger_event = "";
		$bean_id = $bean->id;

		if (isset($bean->emailAddress)) { // Not all modules have emailAddresses
			// Get old emails from this module (get them from DB)
			$emailAddressObject = new SugarEmailAddress();
			$old_emails = $emailAddressObject->getAddressesByGUID($bean_id, $trigger_module);
			//wfm_utils::wfm_log('debug', "wfm_hook \$old_emails=[".print_r($old_emails,true)."]", __FILE__, __METHOD__, __LINE__);
			$old_emails_string = "";
			foreach($old_emails as $key => $value) {
				$old_emails_string .= $old_emails[$key]['email_address'] . ',';
			}
			$old_emails_string = substr($old_emails_string, 0, -1);

			// Get new emails from this module (get them from $bean)
			$new_emails = $bean->emailAddress->addresses;
			//wfm_utils::wfm_log('debug', "\$new_emails=[".print_r($new_emails,true)."]", __FILE__, __METHOD__, __LINE__);
			$new_emails_string = "";
			foreach($new_emails as $key => $value) {
				$new_emails_string .= $new_emails[$key]['email_address'] . ',';
			}
			$new_emails_string = substr($new_emails_string, 0, -1);
		}

		// Sugar strangely doesn't populate event on login_failed
		if (empty($event)) {
			$event = 'login_failed';
		}

		// Bifurcate event
		switch ($event) {

			case 'before_save':

				if (!empty($bean->fetched_row)) {
					$trigger_event = "on_modify__before_save";

					// old_bean
					$old_bean = (empty($bean->fetched_row)) ? Array() : $bean->fetched_row; // email1 is within $bean->fetched_row
					$old_bean['asol_email_list'] = $old_emails_string;
				} else {
					$trigger_event = "on_create__before_save";

					// old_bean
					$old_bean = Array();
				}

				// new_bean
				$new_bean = wfm_utils::wfm_get_bean_variable_array_from_bean_field_defs_non_db($bean);
				$new_bean['email1'] = $bean->email1;
				$new_bean['asol_email_list'] = $new_emails_string;
				$new_bean['date_entered'] = $old_bean['date_entered']; // date_entered is null within $bean

				// CAC disabled fields => bean->field=NULL
				foreach ($new_bean as $key_field => $value_field) {
					if ((!isset($_REQUEST[$key_field])) && ($bean->$key_field === null)) {// disabled field, empty field(not disabled), date_modified(not in $_REQUEST but in $bean)
						$new_bean[$key_field] = $old_bean[$key_field];
					}
				}

				// Save within php-session the arrays for passing them from before-save to after-save logic_hook-execution
				$_SESSION['old_bean'] = $old_bean;
				$_SESSION['new_bean'] = $new_bean;

				break;

			case 'after_save':

				if (!empty($bean->fetched_row)) {

					$trigger_event = "on_modify";

					// Get from  php-session the bean-arrays
					if (isset($_SESSION['old_bean'])) {
						$old_bean = $_SESSION['old_bean'];
						unset($_SESSION['old_bean']);
					}
					if (isset($_SESSION['new_bean'])) {
						$new_bean = $_SESSION['new_bean'];
						unset($_SESSION['new_bean']);
					}
				} else {

					$trigger_event = "on_create";

					$old_bean = Array();

					if (isset($_SESSION['new_bean'])) {
						$new_bean = $_SESSION['new_bean'];
						unset($_SESSION['new_bean']);
					}
				}

				break;
					
			case 'before_delete':

				$trigger_event = "on_delete";
					
				$old_bean = (empty($bean->fetched_row)) ? Array() : $bean->fetched_row;// email1 is in $bean->fetched_row
				$old_bean['asol_email_list'] = $old_emails_string;

				$new_bean = Array();
					
				break;

			case 'after_delete':
				// Do nothing
				break;

			case 'login_failed':
			case 'after_login':
			case 'before_logout':
				$trigger_event = $event;
				break;
		}

		// Get fields from database
		if (isset($sugar_config['WFM_get_fields_from_db'][$bean->table_name])) {
			foreach ($sugar_config['WFM_get_fields_from_db'][$bean->table_name] as $field) {
				$field_query = $db->query("SELECT {$field} FROM {$bean->table_name} WHERE id='{$bean->id}'");
				$field_row = $db->fetchByAssoc($field_query);
				$new_bean[$field] = $field_row[$field];
				$old_bean[$field] = $new_bean[$field];
			}
		}

		// Only for CAC // login_failed -> user does not have domain, because there is actually no user
		if (isset($sugar_config['WFM_asolDefaultDomain_whenEmptyDomain'])) {
			if (empty($new_bean['asol_default_domain'])) {
				$new_bean['asol_default_domain'] = $sugar_config['WFM_asolDefaultDomain_whenEmptyDomain'];
			}
		}

		// Debug
		wfm_utils::wfm_log('debug', "\$trigger_event=[{$trigger_event}]", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('asol_debug', '$old_bean=['.var_export($old_bean, true).']', __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('asol_debug', '$new_bean=['.var_export($new_bean, true).']', __FILE__, __METHOD__, __LINE__);

		// Avoid infinite-loops
		$WFM_MAX_loops = (isset($sugar_config['WFM_MAX_loops'])) ? $sugar_config['WFM_MAX_loops'] : 10;
		$bean_ungreedy_count = (empty($bean->ungreedy_count)) ? 0 : $bean->ungreedy_count;
		wfm_utils::wfm_log('debug', '$bean_ungreedy_count=['.var_export($bean_ungreedy_count, true).']', __FILE__, __METHOD__, __LINE__);

		if (($WFM_MAX_loops != 'unlimited') && ($bean_ungreedy_count >= $WFM_MAX_loops)) { // To avoid that the code crash when the user defines a process that performs an action that triggers its execution (trigger=on_modify, task_type=modify_object; trigger=on_create, task_type=create_object with objectModule=trigger_module).
			wfm_utils::wfm_log('fatal', '$WFM_MAX_loops reached!', __FILE__, __METHOD__, __LINE__);
			return;
		}

		// Calculate current_user_array
		if (!empty($current_user->id)) {
			$userRoles_array = ACLRole::getUserRoles($current_user->id);

			$userRoles = implode(',', $userRoles_array);
			$isAdmin = $current_user->is_admin;
		} else {
			$userRoles = '-';
			$isAdmin = '-';
		}

		$current_user_array = array(
			'id' => $current_user->id,
			'is_admin' => $isAdmin,
			'roles' => $userRoles,
			'asol_default_domain' => $current_user->asol_default_domain
		);

		// urlencode_serialized bean_variable_arrays and custom_variables
		$urlencode_serialized_old_bean = wfm_utils::wfm_convert_array_to_curl_parameter($old_bean);
		$urlencode_serialized_new_bean = wfm_utils::wfm_convert_array_to_curl_parameter($new_bean);
		$aux_server = $_SERVER;
		$aux_server['client_ip'] = wfm_utils::getRealIP();
		$server = wfm_utils::wfm_convert_array_to_curl_parameter($aux_server);
		$request = wfm_utils::wfm_convert_array_to_curl_parameter($_REQUEST);
		$urlencode_serialized_current_user_array = wfm_utils::wfm_convert_array_to_curl_parameter($current_user_array);
		$env = wfm_utils::wfm_convert_array_to_curl_parameter($_ENV);

		$current_user_id = (!empty($current_user->id)) ? $current_user->id : $bean->modified_user_id;
		$current_user_id = (!empty($current_user_id)) ? $current_user_id : '1'; // login_failed. WFM always need a user_id in order to get datetimes
		
		$session_id = session_id();

		//**********cURL***********//
		// To fork execution and web-user-control (we don´t want to make the user wait)
		wfm_utils::wfm_log('debug', "********** cURL=[fork execution and web-user-control] **********", __FILE__, __METHOD__, __LINE__);

		$query_string = "entryPoint=wfm_engine&execution_type=logic_hook&trigger_module={$trigger_module}&trigger_event={$trigger_event}&bean_id={$bean_id}&current_user_id={$current_user_id}&bean_ungreedy_count={$bean_ungreedy_count}&old_bean={$urlencode_serialized_old_bean}&new_bean={$urlencode_serialized_new_bean}&server={$server}&request={$request}&current_user_array={$urlencode_serialized_current_user_array}&env={$env}&session_id={$session_id}";
		wfm_utils::wfm_curl('post', null, $query_string, false, 1);
		ob_clean(); //TODO clear response, if there is an ajax that expects a json as response, and there is some save-records; the WFM will add unexpected(if any php-error, ...) text to the response
		//**********cURL***********//

		wfm_utils::wfm_log('debug', "\$bean->module_dir=[{$bean->module_dir}], \$bean->name=[{$bean->name}], \$bean->id=[{$bean->id}], \$event=[{$event}]", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	}
}

?>