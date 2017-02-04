<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $db, $current_user, $mod_strings, $app_list_strings;

require_once ('include/utils/logic_utils.php');

echo "<b>{$mod_strings['LBL_ASOL_REBUILD_TITLE']}</b><br/><br/><br/>";

// Get a list of installed modules
$modules = ACLAction::getUserActions($current_user->id);

$populateGetParam = "var check_mod = ''; ";
$updatedLHsArray = Array();

if (isset($_REQUEST['updatedLHs'])) {
	$updatedLHs = explode('${pipe}', $_REQUEST['updatedLHs']);
	foreach ($updatedLHs as $updatedLH) {
		$LHValues = explode('${dp}', $updatedLH);
		$updatedLHsArray[$LHValues[0]] = ($LHValues[1] == 'true') ? true : false;
	}
}

$events_array = array('after_save', 'before_save', 'before_delete');
$events_array_2 = array('after_login', 'before_logout', 'login_failed');
$action_array = array(2, "wfm_hook",  "custom/include/wfm_hook.php", "wfm_hook_process", "execute_process"); // 2 instead 1 because of on_hold

foreach ($modules as $mod => $value) {

	$hasLogicHook = wfm_utils::hasLogicHook($mod);

	if (isset($updatedLHsArray[$mod])) {
		$hasLogicHook = $updatedLHsArray[$mod];
	}

	if (isset($_REQUEST['updatedLHs'])) {
		foreach ($events_array as $event) {
			if ($hasLogicHook) { // Add LogicHook
				check_logic_hook_file($mod, $event, $action_array);
			} else { // Remove LogicHook
				remove_logic_hook($mod, $event, $action_array);
			}
		}
		if ($mod == 'Users') {
			foreach ($events_array_2 as $event) {
				if ($hasLogicHook) { // Add LogicHook
					check_logic_hook_file($mod, $event, $action_array);
				} else { // Remove LogicHook
					remove_logic_hook($mod, $event, $action_array);
				}
			}
		}
	}

	$checked = ($hasLogicHook) ? "checked" : "";

	$value_displayed =  (isset($app_list_strings['moduleList'][$mod])) ? $app_list_strings['moduleList'][$mod] : $mod;
	echo "<input type='checkbox' name='check_{$mod}' id='check_{$mod}' {$checked} />{$value_displayed}<br>";

	$populateGetParam .= "check_mod += '{$mod}'+'\${dp}'+document.getElementById('check_{$mod}').checked+'\${pipe}';"; // Ex: Accounts${dp}true${pipe}Cases${dp}false
}

$populateGetParam = substr($populateGetParam, 0, -11).";";

echo "<BR><input type='button' value='{$mod_strings['LBL_ASOL_REBUILD_SEND']}' onClick='onClick();'>";

if (isset($_REQUEST['updatedLHs'])) {
	echo "<br><br><br><b>{$mod_strings['LBL_ASOL_REBUILD_DONE']}</b>";
	echo '<BR><BR>';
	echo '<code>gmdate=['.gmdate('Y-m-d H:i:s').']</code>';
}

?>

<script>
function onClick() {
	<?php echo $populateGetParam; ?>
	document.location="index.php?module=asol_Process&action=rebuild&updatedLHs="+check_mod;
}
</script>
