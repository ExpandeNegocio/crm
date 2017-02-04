<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

?>

<table class='wfm_import'>
	<tr class='wfm_import_border_bottom'>
		<td>
			<input type='radio' name='import_email_template_type' value='do_not_import' /><?php echo $mod_strings['LBL_IMPORT_EMAIL_TEMPLATE_TYPE_DO_NOT_IMPORT_ADVANCED']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<input type='radio' name='import_email_template_type' value='import' checked /><?php echo $mod_strings['LBL_IMPORT_EMAIL_TEMPLATE_TYPE_IMPORT_ADVANCED']; ?>
		</td>
		<td>
			<table class='wfm_import'>
				<tr>
					<td>
						<input type='radio' name='if_email_template_already_exists' value='replace' checked /><?php echo $mod_strings['LBL_IMPORT_IF_EMAIL_TEMPLATE_ALREADY_EXISTS_REPLACE_ADVANCED']; ?>
					<td>
				</tr>
				<tr>
					<td>
						<input type='radio' name='if_email_template_already_exists' value='clone' /><?php echo $mod_strings['LBL_IMPORT_IF_EMAIL_TEMPLATE_ALREADY_EXISTS_CLONE_ADVANCED']; ?>
					<td>
				</tr>
			</table>
		</td>
	</tr>
	
</table>

<?php 
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>