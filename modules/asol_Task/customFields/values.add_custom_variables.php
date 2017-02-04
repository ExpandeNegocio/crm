<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

?>

<table id='acv_Table' class='edit view'>
	<tr>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ACV_NAME']; ?>
			</div>
		</th>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ACV_TYPE']; ?>
			</div>
		</th>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ACV_MODULEFIELDS']; ?>
			</div>
		</th>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ACV_FUNCTIONS']; ?>
			</div>
		</th>
		<th>
			<div align='left'>
				<?php echo $mod_strings['LBL_ACV_IS_GLOBAL']; ?>
			</div>
		</th>
		<th>
			 <input type='hidden' id='uniqueRowIndexes' value='0' />
		</th>
	</tr>
</table>
