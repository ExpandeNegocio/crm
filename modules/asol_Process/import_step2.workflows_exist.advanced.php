<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

?>

<link href="modules/asol_Process/css/asol_process_style.css?version=<?php  echo wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />

<div>
	<h1><?php echo $mod_strings['LBL_IMPORT_TITLE_ADVANCED']; ?></h1>
	<br>
	<h3><?php echo $mod_strings['LBL_IMPORT_STEP2_WORKFLOWS_EXIST_ADVANCED']; ?></h3>
</div>
<br>
<form id='import_form' name='import_form' action='index.php?module=asol_Process&action=import_step3.advanced' method='post' enctype='multipart/form-data'>
	
	<table class='wfm_import'>
		<tr class='wfm_import_border_bottom'>
			<td>
				<input type='radio' name='import_type' value='replace' checked /><?php echo $mod_strings['LBL_IMPORT_TYPE_REPLACE_ADVANCED']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<input type='radio' name='import_type' value='clone' /><?php echo $mod_strings['LBL_IMPORT_TYPE_CLONE_ADVANCED']; ?>
			</td>
			<td>
				<table class='wfm_import'>
					<tr>
						<td>
							<label for='prefix'><?php echo $mod_strings['LBL_IMPORT_TYPE_CLONE_PREFIX_ADVANCED']; ?></label>
						</td>
						<td>
							<input type='text' name='prefix' id='prefix' />
						</td>
					</tr>
					<tr>
						<td>
							<label for='suffix'><?php echo $mod_strings['LBL_IMPORT_TYPE_CLONE_SUFFIX_ADVANCED']; ?></label>
						</td>
						<td>
							<input type='text' name='suffix' id='suffix' />
						</td>
					</tr>
				</table>
				<table class='wfm_import'>
					<tr>
						<td>
							<input type='radio' name='rename_type' value='keep_names' checked /><?php echo $mod_strings['LBL_IMPORT_RENAME_KEEP_NAMES_ADVANCED']; ?>
						<td>
					</tr>
					<tr>
						<td>
							<input type='radio' name='rename_type' value='wfm_process_only' /><?php echo $mod_strings['LBL_IMPORT_RENAME_WFM_PROCESS_ONLY_ADVANCED']; ?>
						<td>
					</tr>
					<tr>
						<td>
							<input type='radio' name='rename_type' value='all_wfm_entities' /><?php echo $mod_strings['LBL_IMPORT_RENAME_ALL_WFM_ENTITIES_ADVANCED']; ?>
						<td>
					</tr>
				</table>
				<table class='wfm_import'>
					<tr>
						<td>
							<input type='radio' name='set_status_type' value='keep_status' checked /><?php echo $mod_strings['LBL_IMPORT_SET_STATUS_TYPE_KEEP_STATUS_ADVANCED']; ?>
						<td>
					</tr>
					<tr>
						<td>
							<input type='radio' name='set_status_type' value='set_status_inactive' /><?php echo $mod_strings['LBL_IMPORT_SET_STATUS_TYPE_INACTIVATE_ADVANCED']; ?>
						<td>
					</tr>
					<tr>
						<td>
							<input type='radio' name='set_status_type' value='set_status_active' /><?php echo $mod_strings['LBL_IMPORT_SET_STATUS_TYPE_ACTIVATE_ADVANCED']; ?>
						<td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<br>
	
	<?php require_once('modules/asol_Process/import_step2.email_templates.advanced.php'); ?>
	
	<br>
	
	<?php require_once('modules/asol_Process/import_step2.domains.advanced.php'); ?>
	
	<br>
	
	<input id='import' type='submit' value='<?php echo $mod_strings['LBL_IMPORT_ADVANCED']; ?>' />
</form>

<?php 
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>