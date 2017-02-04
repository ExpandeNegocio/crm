<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('modules/asol_Project/asolProjectUtils.php');
require_once('modules/asol_Project/resources/jQueryGantt-master/server/ganttServerUtils.php');

asolProjectUtils::log('debug', "ENTRY", __FILE__);

class deleteAsolProject {

	function deleteAsolProject(&$bean, $event, $arguments) {
		asolProjectUtils::log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		asolProjectUtils::log('warn', "\$bean->module_dir=[{$bean->module_dir}], \$bean->name=[{$bean->name}], \$bean->id=[{$bean->id}], \$event=[{$event}]", __FILE__, __METHOD__, __LINE__);

		$module = $bean->module_dir;
		$table = $bean->table_name;
		$asolProjectId = $bean->id;

		switch ($event) {

			case 'before_delete':

				$deletedAsolProjectTasksIds = getIds(getGanttTasks($asolProjectId, false));
				$_SESSION['deletedAsolProjectTasksIds'] = $deletedAsolProjectTasksIds;

				$deletedAsolProjectVersionsIds = getIds(getAllAsolProjectVersionsFromAsolProjectId($asolProjectId));
				$_SESSION['deletedAsolProjectVersionsIds'] = $deletedAsolProjectVersionsIds;

				break;
					
			case 'after_delete':

				$deletedAsolProjectTasksIds = $_SESSION['deletedAsolProjectTasksIds'];
				asolProjectUtils::log('warn', '$deletedAsolProjectTasksIds=['.var_export($deletedAsolProjectTasksIds, true).']', __FILE__, __METHOD__, __LINE__);
				if (count($deletedAsolProjectTasksIds) > 0) {
					deleteAsolProjectTasks($deletedAsolProjectTasksIds);
				}

				$deletedAsolProjectVersionsIds = $_SESSION['deletedAsolProjectVersionsIds'];
				asolProjectUtils::log('warn', '$deletedAsolProjectVersionsIds=['.var_export($deletedAsolProjectVersionsIds, true).']', __FILE__, __METHOD__, __LINE__);
				if (count($deletedAsolProjectVersionsIds) > 0) {
					deleteAsolProjectVersions($deletedAsolProjectVersionsIds);
				}

				//				$urlencode_serialized_deletedAsolProjectTasksIds = asolProjectUtils::convertArrayToCurlParameter($deletedAsolProjectTasksIds);
				//				$urlencode_serialized_deletedAsolProjectVersionsIds = asolProjectUtils::convertArrayToCurlParameter($deletedAsolProjectVersionsIds);
				//
				//				//**********cURL***********//
				//				// To fork execution and web-user-control (we don´t want to make the user wait)
				//				asolProjectUtils::log('debug', "********** cURL=[fork execution and web-user-control] **********", __FILE__, __METHOD__, __LINE__);
				//
				//				$query_string = "entryPoint=ganttServerCanEditMode&action=deleteAsolProject&deletedAsolProjectTasksIds={$urlencode_serialized_deletedAsolProjectTasksIds}&deletedAsolProjectVersionsIds={$urlencode_serialized_deletedAsolProjectVersionsIds}";
				//				asolProjectUtils::sendCurl('post', null, $query_string, false, 1);
				//				ob_clean(); //TODO clear response, if there is an ajax that expects a json as response, and there is some save-records; the WFM will add unexpected(if any php-error, ...) text to the response
				//				//**********cURL***********//

				break;
		}

		asolProjectUtils::log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	}
}

?>