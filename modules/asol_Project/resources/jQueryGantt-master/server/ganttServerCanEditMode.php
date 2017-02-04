<?php

require_once('modules/asol_Project/asolProjectUtils.php');
require_once('modules/asol_ProjectTask/asol_ProjectTask.php');
require_once('modules/asol_Project/resources/jQueryGantt-master/server/ganttServerUtils.php');

$GLOBALS['log']->warn('$_REQUEST=['.var_export($_REQUEST, true).']');

global $current_user;

$GLOBALS['log']->warn('$current_user->user_name=['.var_export($current_user->user_name, true).']');

$asolProjectId = $_REQUEST['asolProjectId'];
$asolProjectVersionId = $_REQUEST['asolProjectVersionId'];
$currentUserId = $current_user->id;

$action = $_REQUEST['action'];

switch ($action) {

	case 'load':

		$mode = $_REQUEST['mode'];

		removeCurrentEditorIfNeeded($mode, $asolProjectId, $asolProjectVersionId, $currentUserId);

		sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, 0, $mode);

		break;

	case 'save': // Called from: working_version

		$mode = $_REQUEST['mode'];

		removeCurrentEditorIfNeeded($mode, $asolProjectId, $asolProjectVersionId, $currentUserId);

		$ganttProject = getGanttProject($_REQUEST['jsonGanttProject']);

		saveWorkingVersion($asolProjectVersionId, $ganttProject);

		sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, $ganttProject['selectedRow'], $mode);

		break;

	case 'publish': // Called from: working_version or baseline

		$mode = $_REQUEST['mode'];

		$asolProjectVersion = getAsolProjectVersion($asolProjectVersionId);
		$jsonGanttTasks = $asolProjectVersion['json_gantt_tasks'];

		$asolProject = getAsolProjectFromAsolProjectVersionId($asolProjectVersionId);
		$lastPublishedVersion = getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProject['id'], 'last_published_version');

		// Publish (translate from json to crm-tables)
		$jsonGanttTasks = publishOnCrmTables($asolProject['id'], $jsonGanttTasks);

		// Set this version as published
		$asolProjectVersionBean = BeanFactory::getBean('asol_ProjectVersion', $asolProjectVersion['id']);
		$asolProjectVersionBean->json_gantt_tasks = $jsonGanttTasks; // In order to change jsonSaved to crm-id-format
		$asolProjectVersionBean->is_published = true;
		$asolProjectVersionBean->published_datetime = gmdate('Y-m-d H:i:s');
		$asolProjectVersionBean->save();

		// Copy $jsonGanttTasks to last_published_version
		$lastPublishedVersionBean = BeanFactory::getBean('asol_ProjectVersion', $lastPublishedVersion['id']);
		$lastPublishedVersionBean->json_gantt_tasks = $jsonGanttTasks;
		$lastPublishedVersionBean->is_published = true;
		$lastPublishedVersionBean->published_datetime = gmdate('Y-m-d H:i:s');
		$lastPublishedVersionBean->save();

		updateAsolProjectDates($asolProject['id']);

		sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, $ganttProject['selectedRow'], $mode);

		break;

	case 'editAsWorkingVersion': // Called from: baseline or last_published_version

		if (!empty($asolProjectId)) { // If last_published_version
			$lastPublishedVersion = getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProjectId, 'last_published_version');
			$jsonGanttTasks = $lastPublishedVersion['json_gantt_tasks'];

		} else if (!empty($asolProjectVersionId)) {
			$asolProjectVersion = getAsolProjectVersion($asolProjectVersionId);
			$jsonGanttTasks = $asolProjectVersion['json_gantt_tasks'];

			$asolProject = getAsolProjectFromAsolProjectVersionId($asolProjectVersionId);
			$asolProjectId = $asolProject['id'];
		}

		if (isAnyOtherUserAlreadyEditingThisGantt($asolProjectId, $currentUserId)) {
			$canEditWorkingVersion = false;
			$workingVersionId = null;
		} else {
			$canEditWorkingVersion = true;
			$workingVersion = getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProjectId, 'working_version');
			$workingVersionId = $workingVersion['id'];

			// Override
			$workingVersionBean = BeanFactory::getBean('asol_ProjectVersion', $workingVersion['id']);
			$workingVersionBean->json_gantt_tasks = $jsonGanttTasks;
			$workingVersionBean->is_published = false;
			$workingVersionBean->published_datetime = '';
			$workingVersionBean->save();
		}

		$response = Array(
			'ok' => true,
			'canEditWorkingVersion' => $canEditWorkingVersion,
			'workingVersionId' => $workingVersionId
		);
		echo json_encode($response);

		break;

	case 'createBaseline': // Called from: working_version

		$mode = $_REQUEST['mode'];

		removeCurrentEditorIfNeeded($mode, $asolProjectId, $asolProjectVersionId, $currentUserId);

		$ganttProject = getGanttProject($_REQUEST['jsonGanttProject']);

		$extraParams = array(
			'asolProjectVersionId' => $asolProjectVersionId,
			'ganttProject' => $ganttProject,
			'newAsolProjectVersionName' => $_REQUEST['newAsolProjectVersionName'],
			'newAsolProjectVersionDescription' => $_REQUEST['newAsolProjectVersionDescription'],
		);

		$resultCallEnterpriseFeature = asolProjectUtils::managePremiumFeature("createBaseline", "ganttServerUtilsEnterprise.php", "createBaseline", $extraParams);

		if ($resultCallEnterpriseFeature === false) {
			$response = Array(
				'ok' => false,
			);
			echo json_encode($response);
		} else {
			sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, $ganttProject['selectedRow'], $mode);
		}
		//createBaseline($asolProjectVersionId, $ganttProject, $_REQUEST['newAsolProjectVersionName'], $_REQUEST['newAsolProjectVersionDescription']);

		break;

	case 'clear': // Called from: working_version

		$mode = 'edit_mode';

		$ganttProject = Array(
			'tasks' => Array(),
		);

		saveWorkingVersion($asolProjectVersionId, $ganttProject);

		sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, 0, $mode);

		break;

	case 'export': // Called from: baseline or last_published_version or working_version

		// Fix jsonGanttProject
		$jsonGanttProject = $_REQUEST['jsonGanttProject'];
		$jsonGanttProject = str_replace("&quot;", '"', $jsonGanttProject);

		if (!empty($asolProjectId)) { // If last_published_version
			$lastPublishedVersion = getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProjectId, 'last_published_version');
			$asolProjectVersionId = $lastPublishedVersion['id'];
			$asolProjectVersionName = $lastPublishedVersion['name'];
			$asolProjectVersionNumber = $lastPublishedVersion['version_number'];
			$versionType = 'last_published_version';

		} else if (!empty($asolProjectVersionId)) {
			$asolProjectVersion = getAsolProjectVersion($asolProjectVersionId);
			$asolProjectVersionName = $asolProjectVersion['name'];
			$asolProjectVersionNumber = $asolProjectVersion['version_number'];
			$versionType = $asolProjectVersion['type'];
		}

		$asolProject = getAsolProjectFromAsolProjectVersionId($asolProjectVersionId);
		$asolProjectName = $asolProject['name'];

		// Set file_name
		switch ($versionType) {
			case 'working_version':
			case 'last_published_version':
				$file_name = "{$asolProjectName}.{$asolProjectVersionName}.".date('\DYmd\THi').'.json';
				break;
			case 'baseline':
				$file_name = "{$asolProjectName}.v{$asolProjectVersionNumber}.{$asolProjectVersionName}.".date('\DYmd\THi').'.json';
				break;
		}

		$file_name = str_replace(' ', '_', $file_name);
		$file_name = preg_replace('/[^a-z0-9\-\_\.]/i','',$file_name);

		// Set headers
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Content-Type: application/js");
		header("Content-Transfer-Encoding: binary");
		echo $jsonGanttProject;

		break;

	case 'import': // Called from: working_version

		$mode = 'edit_mode';

		/* Get File */

		$name = $_FILES['Filedata']['name'];
		$tmpName = $_FILES['Filedata']['tmp_name'];
		$target =  getcwd()."/modules/asol_Project/_temp_Imported_Files/".$name."_".time().".txt";
		copy($tmpName, $target);
		$descriptor = fopen($target, "r");
		$jsonGanttProject = fread($descriptor, filesize($target));
		fclose($descriptor);
		unlink($target);

		asolProjectUtils::log('warn', '$jsonGanttProject=['.var_export($jsonGanttProject, true).']', __FILE__, __METHOD__, __LINE__);

		/* Save Gantt */

		$ganttProject = json_decode($jsonGanttProject, true);
		saveWorkingVersion($asolProjectVersionId, $ganttProject);

		/* Send to client */

		sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, 0, $mode);

		break;

	case 'keepAliveEditMode': // Called from: working_version

		$asolProjectVersion = BeanFactory::getBean('asol_ProjectVersion', $asolProjectVersionId);
		$asolProjectVersion->last_editor_call = gmdate('Y-m-d H:i:s');
		$asolProjectVersion->user_id_c = $currentUserId;
		$asolProjectVersion->save();

		$response = Array(
			'ok' => true,
		);
		echo json_encode($response);

		break;

		//	case 'deleteAsolProject':
		//
		//		$deletedAsolProjectTasksIds = asolProjectUtils::convertCurlParamenterToArray($_REQUEST['deletedAsolProjectTasksIds']);
		//		$deletedAsolProjectVersionsIds = asolProjectUtils::convertCurlParamenterToArray($_REQUEST['deletedAsolProjectVersionsIds']);
		//
		//		if (count($deletedAsolProjectTasksIds) > 0) {
		//			deleteAsolProjectTasks($deletedAsolProjectTasksIds);
		//		}
		//
		//		if (count($deletedAsolProjectVersionsIds) > 0) {
		//			deleteAsolProjectVersions($deletedAsolProjectVersionsIds);
		//		}
		//
		//		break;
}

// TODO
/*
 // Remove asolProjectTasks deleted=1
 global $db;
 $db->query("DELETE FROM asol_projecttask WHERE deleted = '1'");
 $db->query("DELETE FROM asol_project_asol_projecttask_c WHERE deleted = '1'");
 */

?>