<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

$_SESSION['uid'] = $_REQUEST['uid'];

?>

<link href="modules/asol_Process/css/asol_process_style.css?version=<?php  echo wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<script src="modules/asol_Process/___common_WFM/js/jquery.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>" type="text/javascript"></script>

<script>
 	$(document).ready(function () {
 		$("#all").change(function() {
 		    $('#send_email_references_existing_email_template').prop('checked',this.checked);
 		    $('#workflow_is_active').prop('checked',this.checked);
 		    $('#logic_hook_is_set').prop('checked',this.checked);
 		});
 	});
</script>

<div>
	<h1><?php echo $mod_strings['LBL_VALIDATE_TITLE']; ?></h1>
	<br>
	<h3><?php echo $mod_strings['LBL_VALIDATE_STEP1']; ?></h3>
</div>
<br>
<form id='validate_form' name='validate_form' action='index.php?module=asol_Process&action=validate_step2' method='post' enctype='multipart/form-data'>
	<table class="wfm_validate">
		<tr class='wfm_validate_border_bottom'>
			<th>
				<input type="checkbox" id="all" name="all" checked="checked" />&nbsp;<?php echo $mod_strings['LBL_VALIDATE_ALL']; ?>
			</th>
		</tr>
		<tr class='wfm_validate_border_bottom'>
			<td>
				<input type="checkbox" id="send_email_references_existing_email_template" name="send_email_references_existing_email_template" checked="checked" />&nbsp;<?php echo $mod_strings['LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE']; ?>
			</td>
		</tr>
		<tr class='wfm_validate_border_bottom'>
			<td>
				<input type="checkbox" id="workflow_is_active" name="workflow_is_active" checked="checked" />&nbsp;<?php echo $mod_strings['LBL_VALIDATE_WORKFLOW_IS_ACTIVE']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="checkbox" id="logic_hook_is_set" name="logic_hook_is_set" checked="checked" />&nbsp;<?php echo $mod_strings['LBL_VALIDATE_LOGIC_HOOK_IS_SET']; ?>
			</td>
		</tr>
	</table>
	<br>
	<input id='validate' type='submit'  value='<?php echo $mod_strings['LBL_VALIDATE_BUTTON']; ?>' />
</form>

<?php 
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>