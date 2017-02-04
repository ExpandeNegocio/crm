<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

?>

<div id='task_implementation.default' style='display: none'>  
</div>

<div id='task_implementation.add_custom_variables' style='display: block'>
	<table class='edit view'>
		<tr>
	 		<td>
	 			<?php echo $mod_strings['LBL_ASOL_OBJECT_MODULE']; require_once('modules/asol_Task/customFields/object_module.add_custom_variables.php'); ?>
	 		</td>
	 		<td>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td>
	 			<?php require_once('modules/asol_Task/customFields/module_fields.add_custom_variables.php'); ?>
	 		</td>
	 		<td>
	 			<?php require_once('modules/asol_Task/customFields/values.add_custom_variables.php'); ?>
	 		</td>
	 	</tr>
	 	<tr style='display: none;'>
			<td>
				<h4><?php echo $mod_strings['LBL_ADD_NOT_A_FIELD_TITLE']; ?></h4>
			</td>
		</tr>
	 	<tr>
	 		<td>
	 			<input type='button' id='acv_add_button' onClick='onClick_addNotAField_button();' value='<?php echo $mod_strings['LBL_ADD_NOT_A_FIELD_BUTTON']; ?>' title='<?php echo $mod_strings['LBL_ADD_NOT_A_FIELD_BUTTON']; ?>'>
	 		</td>
	 	</tr>
	 </table>
</div>