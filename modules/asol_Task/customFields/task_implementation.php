<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

$task_implementation = (isset($_REQUEST['task_implementation_hidden'])) ? $_REQUEST['task_implementation_hidden'] : $focus->task_implementation;

switch ($task_type) {
	case 'create_object':
	case 'modify_object':
		require_once ('task_implementation.create_modify_object.php');
		break;
	case 'add_custom_variables':
		require_once ('task_implementation.add_custom_variables.php');
		break;
	default:
		require_once ('task_implementation.default.php');
		break;
}

require_once("javascript.php"); 
?>