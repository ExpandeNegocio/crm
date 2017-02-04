<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");

?>

<link href="modules/asol_Process/___common_WFM/css/common.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<div>
	<h1><?php echo translate('LBL_ABOUT_WFM', 'Administration'); ?></h1>
</div>

<br>

<table class="commonTable">
	<tbody>
				
		<tr>
			<td>
				<b>$wfm_edition</b>
			</td>
			<td>
				<?php echo wfm_utils::$wfm_edition; ?>
			</td>
		</tr>
		
		<tr class="alt">
			<td>
				<b>$wfm_release_version</b>
			</td>
			<td>
				<?php echo wfm_utils::$wfm_release_version; ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<b>$wfm_code_version</b>
			</td>
			<td>
				<?php echo wfm_utils::$wfm_code_version; ?>
			</td>
		</tr>
		
		<tr class="alt">
			<td>
				<b>$wfm_db_structure_version</b>
			</td>
			<td>
				<?php echo wfm_utils::$wfm_db_structure_version; ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<b>$wfm_workflows_version</b>
			</td>
			<td>
				<?php echo wfm_utils::$wfm_workflows_version; ?>
			</td>
		</tr>
		
	</tbody>
</table>
