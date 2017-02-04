<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

///////////////////
// AUX FUNCTIONS //
///////////////////

function removeCurrentEditorIfNeeded($mode, $asolProjectId, $asolProjectVersionId, $currentUserId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	if ($mode == 'read_mode') {

		if (!empty($asolProjectId)) { // last_published_version is not editable
		} else if (!empty($asolProjectVersionId)) {

			$asolProjectVersion = getAsolProjectVersion($asolProjectVersionId);

			if ($asolProjectVersion['type'] == 'working_version') { // Only working_version is editable

				$currentEditor = $asolProjectVersion['user_id_c'];
					
				if ($currentEditor == $currentUserId) {
					$asolProjectVersionBean = BeanFactory::getBean('asol_ProjectVersion', $asolProjectVersion['id']);
					$asolProjectVersionBean->last_editor_call = '';
					$asolProjectVersionBean->user_id_c = '';
					$asolProjectVersionBean->save();
				}
			}
		}
	}
}

function getIds($array) {

	$ids = Array();

	foreach ($array as $item) {
		$ids[] = $item['id'];
	}

	return $ids;
}

function getAsolProject($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$asolProjects = Array();

	$sql = "
		SELECT 
			*
		FROM asol_project
		WHERE asol_project.id = '{$asolProjectId}' AND asol_project.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$asolProjects[] = $row;
	}

	return $asolProjects[0];
}

function getAsolProjectFromAsolProjectVersionId($asolProjectVersionId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	// Get asolProject
	$asolProjects = Array();

	$sql = "
		SELECT 
			asol_project.*
		FROM asol_project
		INNER JOIN asol_project_asol_projectversion_c ON asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_project_ida  = asol_project.id
		WHERE asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_projectversion_idb = '{$asolProjectVersionId}' AND asol_project.deleted = 0 AND asol_project_asol_projectversion_c.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$asolProjects[] = $row;
	}

	return $asolProjects[0];
}

function getAsolProjectVersion($asolProjectVersionId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	// Get asolProjectVersion
	$asolProjectVersions = Array();

	$sql = "
		SELECT 
			*
		FROM asol_projectversion
		WHERE asol_projectversion.id = '{$asolProjectVersionId}' AND asol_projectversion.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$asolProjectVersions[] = $row;
	}

	// Fix json_gantt_tasks
	$asolProjectVersions[0]['json_gantt_tasks'] = str_replace("&quot;", '"', $asolProjectVersions[0]['json_gantt_tasks']);

	return $asolProjectVersions[0];
}

function getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProjectId, $versionType) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	// Get asolProjectVersion
	$asolProjectVersions = Array();

	$sql = "
		SELECT 
			asol_projectversion.*
		FROM asol_projectversion
		INNER JOIN asol_project_asol_projectversion_c ON asol_projectversion.id = asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_projectversion_idb
		WHERE asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_project_ida = '{$asolProjectId}' AND asol_projectversion.deleted = 0 AND asol_project_asol_projectversion_c.deleted = 0 AND asol_projectversion.type = '{$versionType}'
		LIMIT 1
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$asolProjectVersions[] = $row;
	}

	// Fix json_gantt_tasks
	$asolProjectVersions[0]['json_gantt_tasks'] = str_replace("&quot;", '"', $asolProjectVersions[0]['json_gantt_tasks']);

	return $asolProjectVersions[0];
}

function getAllAsolProjectVersionsFromAsolProjectId($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	// Get asolProjectVersion
	$asolProjectVersions = Array();

	$sql = "
		SELECT 
			asol_projectversion.*
		FROM asol_projectversion
		INNER JOIN asol_project_asol_projectversion_c ON asol_projectversion.id = asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_projectversion_idb
		WHERE asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_project_ida = '{$asolProjectId}' AND asol_projectversion.deleted = 0 AND asol_project_asol_projectversion_c.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		// Fix json_gantt_tasks
		$row['json_gantt_tasks'] = str_replace("&quot;", '"', $row['json_gantt_tasks']);
		$asolProjectVersions[] = $row;
	}

	return $asolProjectVersions;
}

function prepareJsonGanttTasksToSave($ganttProject) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$ganttTasks = $ganttProject['tasks'];

	foreach ($ganttTasks as $task_order => $ganttTask) {
		if (isNewGanttTask($ganttTasks[$task_order]['id'])) {// tmp_
			$ganttTasks[$task_order]['id'] = str_replace('tmp_', 'jsonSaved_', $ganttTasks[$task_order]['id']);
		}
	}

	$jsonGanttTasks = json_encode($ganttTasks);

	return $jsonGanttTasks;
}

function isValidJson($string) {
	try	{
		// try to decode string
		$object = json_decode($string);

		if ($object === null) {// $ob is null because the json cannot be decoded
			return false;
		} else {
			return true;
		}
	} catch (ErrorException $e)	{
		// exception has been caught which means argument wasn't a string and thus is definitely no json.
		return FALSE;
	}
}

function getGanttProject($jsonGanttProject) {
	$jsonGanttProject = str_replace("&quot;", '"', $jsonGanttProject);
	$ganttProject = json_decode($jsonGanttProject, true);
	return $ganttProject;
}

function sendJsonGanttProjectToClient($asolProjectId, $asolProjectVersionId, $currentUserId, $selectedRow, $mode) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	if (!empty($asolProjectId)) { // If last_published_version
		$lastPublishedVersion = getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProjectId, 'last_published_version');
		$jsonGanttTasks = $lastPublishedVersion['json_gantt_tasks'];
		$asolProject = getAsolProject($asolProjectId);
		$versionType = 'last_published_version';

		// Project Info
		$asolProjectName = $asolProject['name'];
		$asolProjectVersionNumber = $lastPublishedVersion['version_number'];
		$asolProjectVersionName = $lastPublishedVersion['name'];

	} else if (!empty($asolProjectVersionId)) {
		$asolProjectVersion = getAsolProjectVersion($asolProjectVersionId);
		$jsonGanttTasks = $asolProjectVersion['json_gantt_tasks'];
		$asolProject = getAsolProjectFromAsolProjectVersionId($asolProjectVersionId);
		$asolProjectId = $asolProject['id'];
		$versionType = $asolProjectVersion['type'];

		// Project Info
		$asolProjectName = $asolProject['name'];
		$asolProjectVersionNumber = $asolProjectVersion['version_number'];
		$asolProjectVersionName = $asolProjectVersion['name'];
	}

	$ganttTasks = (isValidJson($jsonGanttTasks)) ? json_decode($jsonGanttTasks, true) : Array(); // TODO if not valid, set error

	$resources = getResources($asolProjectId);
	$roles = getRoles();

	$canWrite = checkIfCanWrite($mode, $asolProjectId, $currentUserId, $versionType);
	$canEditMode = checkIfCanEditMode($asolProjectId, $currentUserId);

	$ganttProject = Array(
		'tasks' => $ganttTasks,
		'resources' => $resources,
		'roles' => $roles,
		'canWrite' => $canWrite,
    	'canWriteOnParent' => true,
		'canEditMode' => $canEditMode,
		'mode' => $mode,
    	'selectedRow' => $selectedRow,
    	'deletedTaskIds' => Array(),
		'projectInfo' => Array('asolProjectName' => $asolProjectName, 'asolProjectVersionNumber' => $asolProjectVersionNumber, 'asolProjectVersionName' => $asolProjectVersionName, 'asolProjectVersionType' => $versionType),		
	);
	asolProjectUtils::log('warn', '$ganttProject=['.var_export($ganttProject, true).']', __FILE__, __METHOD__, __LINE__);

	// Send ganttProject to client
	$response = Array(
		'ok' => true,
		'jsonGanttProject' => $ganttProject,
	);
	echo json_encode($response);
}

function checkIfCanWrite($mode, $asolProjectId, $currentUserId, $versionType) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$canWrite = false;

	if ($versionType == 'working_version') {

		switch ($_REQUEST['action']) {

			case 'load':
				switch ($mode) {
					case 'read_mode':
						$canWrite = false;
						break;
					case 'edit_mode':
						$canWrite = (isAnyOtherUserAlreadyEditingThisGantt($asolProjectId, $currentUserId)) ? false : true;
						break;
				}
				break;

			case 'save':
			case 'createBaseline':
			case 'publish':
				switch ($mode) {
					case 'read_mode':
						$canWrite = false;
						break;
					case 'edit_mode':
						$canWrite = true;
						break;
				}
				break;

			case 'clear':
			case 'import':
				$canWrite = true;
				break;
		}
	}

	return $canWrite;
}

function isAnyOtherUserAlreadyEditingThisGantt($asolProjectId, $currentUserId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$workingVersion = getAsolProjectVersionFromAsolProjectIdAndVersionType($asolProjectId, 'working_version');

	$currentEditor = $workingVersion['user_id_c'];

	if ($currentEditor == $currentUserId) {
		$isAnyOtherUserAlreadyEditingThisGantt = false;
	} else {

		$lastEditorCall = $workingVersion['last_editor_call'];
		asolProjectUtils::log('warn', '$lastEditorCall=['.var_export($lastEditorCall, true).']', __FILE__, __METHOD__, __LINE__);

		$seconds = 90;
		$currentDatetimeSubSeconds  = date("Y-m-d H:i:s", mktime(gmdate("H"), gmdate("i"), gmdate("s") - $seconds, gmdate("m"), gmdate("d"), gmdate("Y")));
		asolProjectUtils::log('warn', '$currentDatetimeSubSeconds=['.var_export($currentDatetimeSubSeconds, true).']', __FILE__, __METHOD__, __LINE__);

		$isAnyOtherUserAlreadyEditingThisGantt = ($lastEditorCall < $currentDatetimeSubSeconds) ? false : true;
		asolProjectUtils::log('warn', '$isAnyUserAlreadyEditingThisGantt=['.var_export($isAnyOtherUserAlreadyEditingThisGantt, true).']', __FILE__, __METHOD__, __LINE__);
	}

	return $isAnyOtherUserAlreadyEditingThisGantt;
}

function checkIfCanViewNotPublishedAsolProjectVersion($asolProjectId, $currentUserId) {
	return checkIfCanEditMode($asolProjectId, $currentUserId);
}

function checkIfCanEditMode($asolProjectId, $currentUserId) {

	global $current_user;

	$canEditMode = false;

	$resources = Array();

	$responsible = getResponsible($asolProjectId);
	$resources[] = $responsible;

	$editors = getEditors($asolProjectId);
	$resources = array_unique(array_values(array_merge($resources, $editors)), SORT_REGULAR);

	$resourcesIds = Array();
	foreach ($resources as $resource) {
		$resourcesIds[] = $resource['id'];
	}

	if (in_array($currentUserId, $resourcesIds) || $current_user->is_admin) {
		$canEditMode = true;
	}

	return $canEditMode;
}

function getResources($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$resources = Array();

	$responsible = getResponsible($asolProjectId);
	$resources[] = $responsible;

	$participants = getParticipants($asolProjectId);
	$resources = array_unique(array_values(array_merge($resources, $participants)), SORT_REGULAR);

	$editors = getEditors($asolProjectId);
	$resources = array_unique(array_values(array_merge($resources, $editors)), SORT_REGULAR);

	asolProjectUtils::log('warn', '$resources=['.var_export($resources, true).']', __FILE__, __METHOD__, __LINE__);

	return $resources;
}

function getResponsible($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$users = Array();

	$sql = "
		SELECT 
			users.id,
			users.user_name AS name
		FROM asol_project
		INNER JOIN users ON asol_project.assigned_user_id  = users.id
		WHERE asol_project.id = '{$asolProjectId}' AND asol_project.deleted = 0 AND users.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$users[] = $row;
	}

	$responsible = $users[0];
	asolProjectUtils::log('warn', '$responsible=['.var_export($responsible, true).']', __FILE__, __METHOD__, __LINE__);

	return $responsible;
}

function getParticipants($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$users = Array();

	$sql = "
		SELECT 
			users.id,
			users.user_name AS name
		FROM asol_project
		INNER JOIN asol_project_users_c ON asol_project.id = asol_project_users_c.asol_project_usersasol_project_ida
		INNER JOIN users ON asol_project_users_c.asol_project_usersusers_idb = users.id
		WHERE asol_project.id = '{$asolProjectId}' AND asol_project.deleted = 0 AND asol_project_users_c.deleted = 0 AND users.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$users[] = $row;
	}

	$participants = $users;
	asolProjectUtils::log('warn', '$participants=['.var_export($participants, true).']', __FILE__, __METHOD__, __LINE__);

	return $participants;
}

function getEditors($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$users = Array();

	$sql = "
		SELECT 
			users.id,
			users.user_name AS name
		FROM asol_project
		INNER JOIN asol_project_users_1_c ON asol_project.id = asol_project_users_1_c.asol_project_users_1asol_project_ida 
		INNER JOIN users ON asol_project_users_1_c.asol_project_users_1users_idb = users.id
		WHERE asol_project.id = '{$asolProjectId}' AND asol_project.deleted = 0 AND asol_project_users_1_c.deleted = 0 AND users.deleted = 0
	";
	asolProjectUtils::log('warn', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$users[] = $row;
	}

	$editors = $users;
	asolProjectUtils::log('warn', '$editors=['.var_export($editors, true).']', __FILE__, __METHOD__, __LINE__);

	return $editors;
}

function getRoles() {

	$roles = Array(
	0 => Array(
		'id' => 'responsible',
		'name' => 'Responsible',
	),
	1 => Array(
		'id' => 'participant',
		'name' => 'Participant',
	),
	);

	return $roles;
}

function saveAsolProjectTasks($asolProjectId, $ganttTasks) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$asolProject = BeanFactory::getBean('asol_Project', $asolProjectId);
	$asolProject->load_relationship('asol_project_asol_projecttask');

	foreach ($ganttTasks as $task_order => $ganttTask) {
		if (isJsonSavedTask($ganttTask['id'])) {// jsonSaved_
			$asolProjectTaskId = createAsolProjectTask($asolProject, $ganttTask);
		} else {
			if (checkRecordAlreadyExists('asol_projecttask', $ganttTask['id']) && checkAsolProjectTaskHasRelationshipWithAsolProject($ganttTask['id'], $asolProjectId)) {// Exists in DB && belongs to this asolProject // Needed to manage import
				// Retrieve asol_ProjectTask
				$asolProjectTask = BeanFactory::getBean('asol_ProjectTask', $ganttTask['id']);

				// Compare: client vs. server
				if (taskIsChanged($ganttTask, $asolProjectTask)) {
					assignTaskValues($asolProjectTask, $ganttTask);
					$asolProjectTaskId = $asolProjectTask->save();
				} else {
					$asolProjectTaskId = $ganttTask['id'];
				}
			} else {
				$asolProjectTaskId = createAsolProjectTask($asolProject, $ganttTask);
			}
		}

		setTaskOrder($asolProjectTaskId, $task_order);
	}

	$asolProject->save();
}

function checkRecordAlreadyExists($module_table, $id) {

	global $db;

	$recordAlreadyExists = false;

	$object_query = $db->query("
								SELECT *
								FROM {$module_table}
								WHERE id = '{$id}' AND deleted = 0
							");
	if ($object_query->num_rows > 0) {
		$recordAlreadyExists = true;
	}

	return $recordAlreadyExists;
}

function checkAsolProjectTaskHasRelationshipWithAsolProject($asolProjectTask, $asolProject) {

	global $db;

	$hasRelationship = false;

	$query = $db->query("
							SELECT *
							FROM asol_project_asol_projecttask_c
							WHERE asol_project_asol_projecttaskasol_project_ida = '{$asolProject}' AND asol_project_asol_projecttaskasol_projecttask_idb = '{$asolProjectTask}' AND deleted = 0
						");
	if ($query->num_rows > 0) {
		$hasRelationship = true;
	}

	return $hasRelationship;
}

function createAsolProjectTask(& $asolProject, $ganttTask) {

	// Create asol_ProjectTask
	$asolProjectTask = BeanFactory::newBean('asol_ProjectTask');
	assignTaskValues($asolProjectTask, $ganttTask);
	$asolProjectTask->asol_domain_id = $asolProject->asol_domain_id;
	$asolProjectTaskId = $asolProjectTask->save();

	// Create relationship asol_Project->asol_ProjectTask
	$asolProject->asol_project_asol_projecttask->add($asolProjectTaskId);

	return $asolProjectTaskId;
}

function getDeletedAsolProjectTasksIds($asolProjectId, $newGanttTasks) {

	$oldGanttTasks = getGanttTasks($asolProjectId, false);

	$deletedAsolProjectTasksIds = Array();
	foreach ($oldGanttTasks as $oldGanttTaskOrder => $oldGanttTask) {
		$yetExists = false;

		foreach ($newGanttTasks as $newGanttTaskOrder => $newGanttTask) {
			if ($newGanttTask['id'] == $oldGanttTask['id']) {
				$yetExists = true;
				break;
			}
		}
		
		if (!$yetExists) {
			$deletedAsolProjectTasksIds[] = $oldGanttTask['id'];
		}
	}

	return $deletedAsolProjectTasksIds;
}

function publishOnCrmTables($asolProjectId, $jsonGanttTasks) {

	$ganttTasks = json_decode($jsonGanttTasks, true);

	$deletedAsolProjectTasksIds = getDeletedAsolProjectTasksIds($asolProjectId, $ganttTasks);
	if (count($deletedAsolProjectTasksIds) > 0) {
		deleteAsolProjectTasksObjectAndRelationship($asolProjectId, $deletedAsolProjectTasksIds);
	}

	saveAsolProjectTasks($asolProjectId, $ganttTasks);

	$ganttTasks = getGanttTasks($asolProjectId, false);
	$jsonGanttTasks = json_encode($ganttTasks);

	return $jsonGanttTasks;
}

function getNextVersionNumber($asolProjectId, $versionType) {

	global $db;

	switch ($versionType) {
		case 'working_version':
			$versionNumber = -2;
			break;
		case 'last_published_version':
			$versionNumber = -1;
			break;
		case 'baseline':
			$sql = "
				SELECT MAX(asol_projectversion.version_number) AS maxVersionNumber
				FROM asol_projectversion
				INNER JOIN asol_project_asol_projectversion_c ON asol_projectversion.id = asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_projectversion_idb
				WHERE asol_project_asol_projectversion_c.asol_project_asol_projectversionasol_project_ida = '{$asolProjectId}' AND asol_projectversion.deleted = 0 AND asol_project_asol_projectversion_c.deleted = 0 AND asol_projectversion.type = '{$versionType}'
			";
			$query = $db->query($sql);
			$row = $db->fetchByAssoc($query);
			asolProjectUtils::log('warn', '$row=['.var_export($row, true).']', __FILE__, __METHOD__, __LINE__);
			if (!empty($row)) {
				$versionNumber = ((int)$row['maxVersionNumber']) + 1;
			} else {
				$versionNumber = 1;
			}
			break;
	}

	return $versionNumber;
}

function createAsolProjectVersion(& $asolProject, $ganttProject, $newAsolProjectVersionName, $newAsolProjectVersionDescription, $versionType) {
	asolProjectUtils::log('warn', '$asolProject->name=['.var_export($asolProject->name, true).']', __FILE__, __METHOD__, __LINE__);

	global $current_user;

	$asolProject->load_relationship('asol_project_asol_projectversion');

	// Create asol_ProjectVersion
	$asolProjectVersion = BeanFactory::newBean('asol_ProjectVersion');
	assignVersionValues($asolProjectVersion, $ganttProject, $asolProject, $newAsolProjectVersionName, $newAsolProjectVersionDescription, $versionType);
	$asolProjectVersionId = $asolProjectVersion->save();

	// Create relationship asol_Project->asol_ProjectVersion
	$asolProject->asol_project_asol_projectversion->add($asolProjectVersionId);

	// Assign relates
	switch ($versionType) {
		case 'working_version':
			$asolProject->asol_projectversion_id_c = $asolProjectVersionId;
			break;
		case 'last_published_version':
			$asolProject->asol_projectversion_id1_c = $asolProjectVersionId;
			break;
		case 'baseline':
			break;
	}

	return $asolProjectVersionId;
}

function saveWorkingVersion($asolProjectVersionId, $ganttProject) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$asolProjectVersionBean = BeanFactory::getBean('asol_ProjectVersion', $asolProjectVersionId);
	$asolProjectVersionBean->json_gantt_tasks = prepareJsonGanttTasksToSave($ganttProject);
	$asolProjectVersionBean->is_published = false;
	$asolProjectVersionBean->published_datetime = '';
	$asolProjectVersionBean->save();
}

function isNewGanttTask($ganttTaskId) {
	return asolProjectUtils::str_starts_with($ganttTaskId, 'tmp_');
}

function isJsonSavedTask($ganttTaskId) {
	return asolProjectUtils::str_starts_with($ganttTaskId, 'jsonSaved_');
}

function setTaskOrder($asolProjectTaskId, $task_order) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$sql = "
		UPDATE asol_projecttask
		SET task_order = {$task_order}
		WHERE id = '{$asolProjectTaskId}'
	";
	$db->query($sql);
}

function assignVersionValues(& $asolProjectVersion, $ganttProject, $asolProject, $newAsolProjectVersionName, $newAsolProjectVersionDescription, $versionType) {

	global $current_user;

	$asolProjectVersion->name = $newAsolProjectVersionName;
	$asolProjectVersion->description = $newAsolProjectVersionDescription;
	$asolProjectVersion->type = $versionType;
	$asolProjectVersion->json_gantt_tasks = prepareJsonGanttTasksToSave($ganttProject);
	$asolProjectVersion->assigned_user_id = $current_user->id;
	$asolProjectVersion->version_number = getNextVersionNumber($asolProject->id, $versionType);

	$asolProjectVersion->asol_domain_id = (isset($asolProject->asol_domain_id)) ? $asolProject->asol_domain_id : $current_user->asol_default_domain;

	// Set published
	switch ($versionType) {
		case 'working_version':
			$asolProjectVersion->is_published = true;
			$asolProjectVersion->published_datetime = gmdate('Y-m-d H:i:s');
			break;
		case 'last_published_version':
			$asolProjectVersion->is_published = true;
			$asolProjectVersion->published_datetime = gmdate('Y-m-d H:i:s');
			break;
		case 'baseline':
			break;
	}
}

function assignTaskValues(& $asolProjectTask, $ganttTask) {

	asolProjectUtils::log('warn', '$ganttTask=['.var_export($ganttTask, true).']', __FILE__, __METHOD__, __LINE__);

	$asolProjectTask->name = $ganttTask['name'];
	$asolProjectTask->description = $ganttTask['description'];
	$asolProjectTask->status = $ganttTask['status'];
	$asolProjectTask->depends = (string) $ganttTask['depends'];
	$asolProjectTask->start = date('Y-m-d', $ganttTask['start']/1000);
	$asolProjectTask->end = date('Y-m-d', $ganttTask['end']/1000 - 1);
	$asolProjectTask->duration = $ganttTask['duration'];
	$asolProjectTask->progress = $ganttTask['progress'];
	$asolProjectTask->level = $ganttTask['level'];
	$asolProjectTask->start_is_milestone = $ganttTask['startIsMilestone'];
	$asolProjectTask->end_is_milestone = $ganttTask['endIsMilestone'];
	$asolProjectTask->assigs = json_encode($ganttTask['assigs']);
	$asolProjectTask->assigned_user_id = getAsolProjectTaskAssignedUserId($ganttTask['assigs']);
}

function getAsolProjectTaskAssignedUserId($assigs) {

	$assigned_user_id = null;

	foreach ($assigs as $assig) {
		if ($assig['roleId'] == 'responsible') {
			$assigned_user_id = $assig['resourceId'];
			break;
		}
	}

	return $assigned_user_id;
}

function taskIsChanged($ganttTask, $asolProjectTask) {

	global $current_user, $timedate;

	asolProjectUtils::log('warn', '$ganttTask=['.var_export($ganttTask, true).']', __FILE__, __METHOD__, __LINE__);

	foreach ($ganttTask as $key => $value) {

		asolProjectUtils::log('warn', "asolProjectTask->$key=[".var_export($asolProjectTask->$key, true).']', __FILE__, __METHOD__, __LINE__);
		asolProjectUtils::log('warn', "ganttTask[$key]=[".var_export($ganttTask[$key], true).']', __FILE__, __METHOD__, __LINE__);

		switch ($key) {

			case 'id':
			case 'name':
			case 'description':
			case 'status':
			case 'depends':
				if (!($ganttTask[$key] == $asolProjectTask->$key)) {
					asolProjectUtils::log('warn', '1', __FILE__, __METHOD__, __LINE__);
					return true;
				}
				break;
					
			case 'end':
			case 'start':
				$server_value = $asolProjectTask->$key;
				$server_value = $timedate->swap_formats($server_value, $current_user->getPreference("datef"), $timedate->get_db_date_format());

				$client_value = date('Y-m-d', $ganttTask[$key]/1000);

				if ($key == 'end') {

					// Substract 1 day
					$b_date = $client_value;
					$b_date__array = explode('-',$b_date);
					$b_years = $b_date__array[0];
					$b_months = $b_date__array[1];
					$b_days = $b_date__array[2];

					$b_date__plus__delta  = date("Y-m-d", mktime(0, 0, 0, $b_months, $b_days - 1, $b_years));

					$client_value = $b_date__plus__delta;
				}

				asolProjectUtils::log('warn', '$server_value=['.var_export($server_value, true).']', __FILE__, __METHOD__, __LINE__);
				asolProjectUtils::log('warn', '$client_value=['.var_export($client_value, true).']', __FILE__, __METHOD__, __LINE__);

				if (!($client_value == $server_value)) {
					asolProjectUtils::log('warn', '1', __FILE__, __METHOD__, __LINE__);
					return true;
				}
				break;
			case 'duration':
			case 'progress':
			case 'level':

				$server_value = $asolProjectTask->$key;
				$client_value = strval($ganttTask[$key]);

				asolProjectUtils::log('warn', '$server_value=['.var_export($server_value, true).']', __FILE__, __METHOD__, __LINE__);
				asolProjectUtils::log('warn', '$client_value=['.var_export($client_value, true).']', __FILE__, __METHOD__, __LINE__);

				if (!($client_value == $server_value)) {
					asolProjectUtils::log('warn', '1', __FILE__, __METHOD__, __LINE__);
					return true;
				}
				break;
			case 'assigs':
				$server_value = $asolProjectTask->$key;
				$server_value = str_replace("&quot;", '"', $server_value);

				$client_value = json_encode($ganttTask[$key]);

				asolProjectUtils::log('warn', '$server_value=['.var_export($server_value, true).']', __FILE__, __METHOD__, __LINE__);
				asolProjectUtils::log('warn', '$client_value=['.var_export($client_value, true).']', __FILE__, __METHOD__, __LINE__);

				if (!($client_value == $server_value)) {
					asolProjectUtils::log('warn', '2', __FILE__, __METHOD__, __LINE__);
					return true;
				}
				break;

			case 'startIsMilestone':
				if (!((bool)$ganttTask[$key] == (bool)$asolProjectTask->start_is_milestone)) {
					asolProjectUtils::log('warn', '3', __FILE__, __METHOD__, __LINE__);
					return true;
				}
				break;
			case 'endIsMilestone':
				if (!((bool)$ganttTask[$key] == (bool)$asolProjectTask->end_is_milestone)) {
					asolProjectUtils::log('warn', '4', __FILE__, __METHOD__, __LINE__);
					return true;
				}
				break;

			case 'code':
			default:
				break;
		}
	}

	return false;
}

function deleteAsolProjectTasksObjectAndRelationship($asolProjectId, $asolProjectTaskIds) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$asolProject = BeanFactory::getBean('asol_Project', $asolProjectId);
	$asolProject->load_relationship('asol_project_asol_projecttask');

	foreach ($asolProjectTaskIds as $asolProjectTaskId) {

		// Delete asol_ProjectTask
		$asolProjectTask = BeanFactory::getBean('asol_ProjectTask', $asolProjectTaskId);
		$asolProjectTask->deleted = 1;
		$asolProjectTask->save();

		// Delete relationship asol_Project->asol_ProjectTask
		$asolProject->asol_project_asol_projecttask->delete($asolProjectId, $asolProjectTaskId);
	}

	$asolProject->save();
}

function deleteAsolProjectTasks($asolProjectTaskIds) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	foreach ($asolProjectTaskIds as $asolProjectTaskId) {

		// Delete asol_ProjectTask
		$asolProjectTask = BeanFactory::getBean('asol_ProjectTask', $asolProjectTaskId);
		$asolProjectTask->deleted = 1;
		$asolProjectTask->save();
	}
}

function deleteAsolProjectVersions($asolProjectVersionIds) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	foreach ($asolProjectVersionIds as $asolProjectVersionId) {

		// Delete asol_ProjectVersion
		$asolProjectVersion = BeanFactory::getBean('asol_ProjectVersion', $asolProjectVersionId);
		$asolProjectVersion->deleted = 1;
		$asolProjectVersion->save();
	}
}

function getGanttTasks($asolProjectId, $only_level_0) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	// Get asolProjectTasks
	$asolProjectTasks = Array();

	$only_level_0_sql = ($only_level_0) ? 'AND asol_projecttask.level = 0' : '';

	$sql = "
		SELECT 
			asol_projecttask.id,
			asol_projecttask.name,
			asol_projecttask.description,
			asol_projecttask.start,
			asol_projecttask.end,
			asol_projecttask.status,
			asol_projecttask.start_is_milestone AS startIsMilestone,
			asol_projecttask.end_is_milestone AS endIsMilestone,
			asol_projecttask.depends,
			asol_projecttask.level,
			asol_projecttask.duration,
			asol_projecttask.progress,
			asol_projecttask.assigs
		FROM asol_project
		INNER JOIN asol_project_asol_projecttask_c ON asol_project.id = asol_project_asol_projecttask_c.asol_project_asol_projecttaskasol_project_ida
		INNER JOIN asol_projecttask ON asol_project_asol_projecttask_c.asol_project_asol_projecttaskasol_projecttask_idb = asol_projecttask.id
		WHERE asol_project.id = '{$asolProjectId}' AND asol_project.deleted = 0 AND asol_project_asol_projecttask_c.deleted = 0 AND asol_projecttask.deleted = 0 {$only_level_0_sql}
			ORDER BY asol_projecttask.task_order ASC
	";
	$GLOBALS['log']->warn('$sql=['.var_export($sql, true).']');
	$query = $db->query($sql);
	while ($row = $db->fetchByAssoc($query)) {
		$asolProjectTasks[] = $row;
	}

	// Translate asolProjectTasks to ganttTasks
	$ganttTasks = $asolProjectTasks;

	foreach ($ganttTasks as $key_ganttTask => $ganttTask) {
		foreach ($ganttTask as $field => $value) {
			switch ($field) {
				case 'id':
				case 'name':
				case 'description':
				case 'status':
				case 'depends':
					break;
				case 'start':
					$ganttTasks[$key_ganttTask][$field] = strtotime($ganttTask[$field]) * 1000;
					break;
				case 'end':

					// Add 1 day
					$b_date = $ganttTask[$field];
					$b_date__array = explode('-',$b_date);
					$b_years = $b_date__array[0];
					$b_months = $b_date__array[1];
					$b_days = $b_date__array[2];

					$b_date__plus__delta  = date("Y-m-d", mktime(0, 0, 0, $b_months, $b_days + 1, $b_years));

					$ganttTasks[$key_ganttTask][$field] = strtotime($b_date__plus__delta) * 1000;
					break;
				case 'duration':
				case 'progress':
				case 'level':
					$ganttTasks[$key_ganttTask][$field] = (double) $ganttTask[$field];
					break;
				case 'startIsMilestone':
				case 'endIsMilestone':
					$ganttTasks[$key_ganttTask][$field] = (bool) $ganttTask[$field];
					break;
				case 'assigs':
					$ganttTask[$field] = str_replace("&quot;", '"', $ganttTask[$field]);
					$ganttTasks[$key_ganttTask][$field] = json_decode($ganttTask[$field]);
					break;
			}
		}
	}

	return $ganttTasks;
}

function updateAsolProjectDates($asolProjectId) {
	asolProjectUtils::log('warn', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$gantTasks = getGanttTasks($asolProjectId, true);
	if (count($gantTasks) > 0) {
		$ganttTaskLevel0 = $gantTasks[0];
		asolProjectUtils::log('warn', '$ganttTaskLevel0=['.var_export($ganttTaskLevel0, true).']', __FILE__, __METHOD__, __LINE__);

		// Set dates
		$start = $ganttTaskLevel0['start']/1000;
		$end = $ganttTaskLevel0['end']/1000 - 1;

		$date_start = date('Y-m-d', $start);
		$date_end = date('Y-m-d', $end);
		
	} else {
		$date_start = '';
		$date_end = '';
	}

	$asolProject = BeanFactory::getBean('asol_Project', $asolProjectId);
	$asolProject->date_start = $date_start;
	$asolProject->date_end = $date_end;
	$asolProject->save();
}
