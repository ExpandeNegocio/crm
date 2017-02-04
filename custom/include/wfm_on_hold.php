<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

class wfm_hook_on_hold {

	function wakeup_on_hold(&$bean, $event, $arguments) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('asol', "\$bean->module_dir=[{$bean->module_dir}], \$bean->name=[{$bean->name}], \$bean->id=[{$bean->id}], \$event=[{$event}]", __FILE__, __METHOD__, __LINE__);
		
		global $db, $sugar_config;

		$object_module = $bean->module_dir; // Calls or Tasks modules
		$bean_id = $bean->id;
		$working_node_id = "";

		$sendCurlRequest = false;

		if (	($event == "after_save")  
											&&  (  (($object_module == "Calls")&&($bean->status == "Held"))  ||  (($object_module == "Tasks")&&($bean->status == "Completed"))  )   
			||	($event == "before_delete") 
		) {  // When clicking on close/delete button of a sugar-call/task

			$on_hold_query = $db->query("
											SELECT asol_workingnodes_id_c 
											FROM asol_onhold 
											WHERE parent_id = '{$bean_id}' AND parent_type = '{$object_module}' 
											LIMIT 1
										  ");
			$on_hold_row = $db->fetchByAssoc($on_hold_query);

			$working_node_id = $on_hold_row['asol_workingnodes_id_c'];

			if (!empty($working_node_id)) {
				
				$date_modified = gmdate('Y-m-d H:i:s');
				
				$db->query("
								UPDATE asol_workingnodes
								SET status = 'in_progress', date_modified = '{$date_modified}'
								WHERE status = 'held' AND id = '{$working_node_id}'
						  ");

				$db->query("
								DELETE FROM asol_onhold
								WHERE asol_workingnodes_id_c = '{$working_node_id}'
						   ");
				/*
				// This code is intended to not wait until 1 minute(crontab) to execute the WFM// Not needed because of the logic_hooks order (first wfm_on_hold, second wfm_hook)
				wfm_utils::wfm_log('debug', "ENTRY cURL REQUEST (class wfm_hook_on_hold function wakeup_on_hold)***************************************", __FILE__, __METHOD__, __LINE__);
				$ch = curl_init();

				// set URL and other appropriate options
				curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/sugarcrm/index.php?entryPoint=wfm_engine&execution_type=on_hold");
				wfm_utils::wfm_log('debug', "cURL=http://127.0.0.1/sugarcrm/index.php?entryPoint=wfm_engine&execution_type=on_hold********************", __FILE__, __METHOD__, __LINE__);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_TIMEOUT, 1);
				// grab URL and pass it to the browser
				curl_exec($ch);

				// close cURL resource, and free up system resources
				curl_close($ch);
				wfm_utils::wfm_log('debug', "EXIT cURL REQUEST (class wfm_hook_on_hold function wakeup_on_hold)*****************************************", __FILE__, __METHOD__, __LINE__);
				*/
			}
		}
		
		wfm_utils::wfm_log('asol', "\$bean->module_dir=[{$bean->module_dir}], \$bean->name=[{$bean->name}], \$bean->id=[{$bean->id}], \$event=[{$event}]", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	}
}

?>