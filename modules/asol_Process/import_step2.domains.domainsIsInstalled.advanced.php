<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

?>

<table class='wfm_import'>
	<tr>
		<td>
			<input type='radio' name='import_domain_type' value='keep_domain' checked /><?php echo $mod_strings['LBL_IMPORT_DOMAIN_TYPE_KEEP_DOMAIN_ADVANCED']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<input type='radio' name='import_domain_type' value='use_current_user_domain' /><?php echo $mod_strings['LBL_IMPORT_DOMAIN_TYPE_USE_CURRENT_USER_DOMAIN_ADVANCED']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<input type='radio' name='import_domain_type' value='use_explicit_domain' /><?php echo $mod_strings['LBL_IMPORT_DOMAIN_TYPE_USE_EXPLICIT_DOMAIN_ADVANCED']; ?>
		</td>
		<td>
			<label for='explicit_domain'><?php echo $mod_strings['LBL_IMPORT_EXPLICIT_DOMAIN_ADVANCED']; ?></label>
			<input type='text' name='explicit_domain' id='explicit_domain' />
		</td>
	</tr>
</table>


<?php 
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>