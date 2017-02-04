<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

class prune_wfm_monitor_tables {

	function prune_wfm_monitor_tables(&$bean, $event, $arguments) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('asol', "\$bean->module_dir=[{$bean->module_dir}], \$bean->name=[{$bean->name}], \$bean->id=[{$bean->id}], \$event=[{$event}]", __FILE__, __METHOD__, __LINE__);
		
		global $db, $sugar_config;

		$module = $bean->module_dir;
		$table = $bean->table_name;

		if ($event == 'after_delete') {
			$db->query("DELETE FROM {$table} WHERE deleted = 1")	;		
		}
		
		wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	}
}

?>