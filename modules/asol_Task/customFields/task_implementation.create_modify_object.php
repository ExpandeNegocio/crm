<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

?>

<div id='task_implementation.default' style='display: none'>  
</div>

<div id='task_implementation.create_modify_object' style='display: block'>
	<table class='edit view'>
		<tr>
	 		<td>
	 			<?php echo $mod_strings['LBL_ASOL_OBJECT_MODULE']; require_once("modules/asol_Task/customFields/object_module.create_modify_object.php"); ?>
	 		</td>
	 		<td></td>
	 	</tr>
	 	<tr>
	 		<td>
	 			<?php require_once("modules/asol_Task/customFields/module_fields.create_modify_object.php"); ?>
	 		</td>
	 		<td>
	 			<?php require_once("modules/asol_Task/customFields/values.create_modify_object.php"); ?>
	 		</td>
	 	<tr>
	 </table>
</div>