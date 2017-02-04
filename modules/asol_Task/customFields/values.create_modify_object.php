<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

?>

<table id='module_values_Table' class='edit view'>
	<tr>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ASOL_DATABASE_FIELD']; ?>
			</div>
		</th>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ASOL_VALUE']; ?>
			</div>
		</th>
		<th>
			 <input type='hidden' id='uniqueRowIndexes' value='0' />
		</th>
	</tr>
</table>
