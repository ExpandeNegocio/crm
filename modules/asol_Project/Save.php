<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Project/asolProjectUtils.php");
require_once('modules/asol_Project/resources/jQueryGantt-master/server/ganttServerUtils.php');

asolProjectUtils::log('debug', "ENTRY", __FILE__);

$focus = new asol_Project();

$isUpdate = (!empty($_REQUEST['record']));

// If update AsolProject
if ($isUpdate) {
	// TODO check if it is needed retrieve the bean for the WFM
	$focus->id = $_REQUEST['record'];
}

// Assign AsolProject values
$focus->name = $_REQUEST['name'];
$focus->assigned_user_id = $_REQUEST['assigned_user_id'];
$focus->description = $_REQUEST['description'];
$focus->date_start = $_REQUEST['date_start'];
$focus->date_end = $_REQUEST['date_end'];
$focus->status = $_REQUEST['status'];
$focus->priority = $_REQUEST['priority'];
$focus->log = $_REQUEST['log'];
$focus->wiki_link = $_REQUEST['wiki_link'];
$focus->wiki_link_alias = $_REQUEST['wiki_link_alias'];
$focus->asol_projectversion_id_c = $_REQUEST['asol_projectversion_id_c']; // working_version
$focus->asol_projectversion_id1_c = $_REQUEST['asol_projectversion_id1_c']; // last_published_version

// Save
$recordId = $focus->save();

// If create AsolProject then create both working_version and last_published_version
if (!$isUpdate) {
	$ganttProject = Array(
		'tasks' => Array(),
	);
	createAsolProjectVersion($focus, $ganttProject, 'Working version', 'Working version', 'working_version');
	createAsolProjectVersion($focus, $ganttProject, 'Last published version', 'Last published version', 'last_published_version');

	// Second Save in order to save relates
	$focus->save();
}

// Redirect
asolProjectUtils::redirect($recordId);

?>