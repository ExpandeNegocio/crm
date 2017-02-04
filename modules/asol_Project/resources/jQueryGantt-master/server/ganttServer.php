<?php

require_once('modules/asol_Project/asolProjectUtils.php');
require_once('modules/asol_ProjectTask/asol_ProjectTask.php');
require_once('modules/asol_Project/resources/jQueryGantt-master/server/ganttServerUtils.php');

$GLOBALS['log']->warn('$_REQUEST=['.var_export($_REQUEST, true).']');

$asolProjectId = $_REQUEST['asolProjectId'];
$currentUserId = null;

switch ($_REQUEST['action']) {

	case 'load':

		$mode = $_REQUEST['mode'];

		// Send jsonGanttProject to client
		sendJsonGanttProjectToClient($asolProjectId, $currentUserId, 0, $mode);

		break;
}
