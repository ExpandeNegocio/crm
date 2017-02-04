<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

?>

<link href="modules/asol_Process/css/asol_process_style.css?version=<?php  echo wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<link href="modules/asol_Process/___common_WFM/css/asol_popupHelp.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<script src="modules/asol_Process/___common_WFM/js/jquery.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>" type="text/javascript"></script>
<link href="modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/css/jquery.ui.min.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<script src="modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/js/jquery.ui.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>" type="text/javascript"></script>

<script>

	main();
	
	function main() {
		//alert("JQuery is now loaded");
		
		// jQuery-ui
		$.fx.speeds._default = 500;
		$.extend($.ui.dialog.prototype.options, {width: 500, show: "side", hide: "size"});
		
		$(document).ready(function() {
			
		});
	}

</script>	

<?php
wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

global $mod_strings, $db;

$process_ids_array = explode(',', $_SESSION['uid']);

$all_validations_result_all_workflows_html = '';

foreach ($process_ids_array as $process_id) {
	$all_validations_result_all_workflows_html .= generateAllValidationsResult($process_id);
}

echo $all_validations_result_all_workflows_html;

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);

// Functions

function generateAllValidationsResult($process_id) {

	global $mod_strings;
	
	$process = wfm_utils::getProcess_fromProcessId($process_id);

	$all_validations_result_html =
	"
	<h1>WorkFlow: {$process['name']}</h1>
	<br>
	<table class='wfm_validate'>
		<tr>
			<th>{$mod_strings['LBL_VALIDATE_VALIDATION']}</th>
			<th>{$mod_strings['LBL_VALIDATE_RESULT']}</th>
		</tr>"
	.generateValidationResult($process, 'send_email_references_existing_email_template')
	.generateValidationResult($process, 'workflow_is_active')
	.generateValidationResult($process, 'logic_hook_is_set')
	.'
	</table>
	<br>
	<br>
	';

	return $all_validations_result_html;
}

function generateValidationResult($process, $validation) {

	global $mod_strings;

	$validation_result_html = '';

	$validate_send_email_references_existing_email_template = $_REQUEST['send_email_references_existing_email_template'];
	$validate_workflow_is_active = $_REQUEST['workflow_is_active'];
	$validate_logic_hook_is_set = $_REQUEST['logic_hook_is_set'];

	$result_ok = "<b><font color='green'>OK</font></b>";
	$result_nok = "<b><font color='red'>NOK</font></b>";

	switch ($validation) {
		case 'send_email_references_existing_email_template':
			if ($validate_send_email_references_existing_email_template) {
				$result_aux = wfm_utils::validate_send_email_references_existing_email_template($process['id']);
				$result = ($result_aux === false) ? $result_ok : $result_nok.$result_aux;
				$validation_result_html = "<tr><td>{$mod_strings['LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE']}</td><td>{$result}</td></tr>";
			}
			break;
		case 'workflow_is_active':
			if ($validate_workflow_is_active) {
				$result = ($process['status'] == 'active') ? $result_ok : $result_nok;
				$validation_result_html = "<tr><td>{$mod_strings['LBL_VALIDATE_WORKFLOW_IS_ACTIVE']}</td><td>{$result}</td></tr>";
			}
			break;
		case 'logic_hook_is_set':
			if ($validate_logic_hook_is_set) {
				$result = (wfm_utils::hasLogicHook($process['trigger_module'])) ? $result_ok : $result_nok;
				$validation_result_html = "<tr><td>{$mod_strings['LBL_VALIDATE_LOGIC_HOOK_IS_SET']}</td><td>{$result}</td></tr>";
			}
			break;
	}

	return $validation_result_html;
}

?>


