<style>
.wfm_actionButtons a:hover {
	text-decoration: underline;
	font-size: inherit;
	color: inherit;
}
</style>

<span class='wfm_actionButtons'>

	<!-- FlowChart -->
	<span style="white-space:nowrap;">
	     <a onClick='openAllFlowChartsPopups();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_FLOWCHARTS_BUTTON']; ?>" src="modules/asol_Process/___common_WFM/images/flowChart.png">
			<span><?php echo $mod_strings['LBL_FLOWCHARTS_BUTTON']; ?></span>
		 </a>
	</span>
	
	<!-- Validate WorkFlows -->
	<span style="white-space:nowrap;">
	     <a onClick='validateWorkFlows();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_VALIDATE_WORKFLOWS_BUTTON']; ?>" src="modules/asol_Process/___common_WFM/images/validate.png">
			<span><?php echo $mod_strings['LBL_VALIDATE_WORKFLOWS_BUTTON']; ?></span>
		 </a>
	</span>
	
	<!-- Activate WorkFlows -->
	<span style="white-space:nowrap;">
	     <a onClick='activateWorkFlows();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_ACTIVATE_WORKFLOWS_BUTTON']; ?>" src="modules/asol_Process/___common_WFM/images/activate.png">
			<span><?php echo $mod_strings['LBL_ACTIVATE_WORKFLOWS_BUTTON']; ?></span>
		 </a>
	</span>
	
	<!-- Inactivate WorkFlows -->
	<span style="white-space:nowrap;">
	     <a onClick='inactivateWorkFlows();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_INACTIVATE_WORKFLOWS_BUTTON']; ?>" src="modules/asol_Process/___common_WFM/images/inactivate.png">
			<span><?php echo $mod_strings['LBL_INACTIVATE_WORKFLOWS_BUTTON']; ?></span>
		 </a>
	</span>
	
	<!-- Export WorkFlows -->
	<span style="white-space:nowrap;">
	     <a onClick='return exportWorkFlows();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_EXPORT_WORKFLOWS_BUTTON']; ?>" src="modules/asol_Process/___common_WFM/images/export.png">
			<span><?php echo $mod_strings['LBL_EXPORT_WORKFLOWS_BUTTON']; ?></span>
		 </a>
	</span>
	
	<!-- Import WorkFlows Basic -->
	<span style="white-space:nowrap;">
	     <a onClick='importWorkFlowsBasic();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_IMPORT_WORKFLOWS_STANDARD_WITHOUT_CONTEXT']; ?>" src="modules/asol_Process/___common_WFM/images/import.png">
			<span><?php echo $mod_strings['LBL_IMPORT_WORKFLOWS_STANDARD_WITHOUT_CONTEXT']; ?></span>
		 </a>
	</span>
	
	<?php
	// Import WorkFlows Advanced
	if ($current_user->is_admin) {
		echo '
			<span style="white-space:nowrap;">
			     <a onClick="importWorkFlowsAdvanced();" style="cursor: pointer;">
					<img border="0" align="absmiddle" alt="'.$mod_strings['LBL_IMPORT_WORKFLOWS_ADVANCED'].'" src="modules/asol_Process/___common_WFM/images/import_advanced.png">
					<span>'.$mod_strings['LBL_IMPORT_WORKFLOWS_ADVANCED'].'</span>
				 </a>
			</span>
		';
	}
	?>
	
	<!-- Delete WorkFlows -->
	<span style="white-space:nowrap;">
	     <a onClick='deleteWorkFlows();' style="cursor: pointer;">
			<img border="0" align="absmiddle" alt="<?php echo $mod_strings['LBL_DELETE_WORKFLOWS_BUTTON']; ?>" src="modules/asol_Process/___common_WFM/images/delete.png">
			<span><?php echo $mod_strings['LBL_DELETE_WORKFLOWS_BUTTON']; ?></span>
		 </a>
	</span>
	
	<?php 
	// WFM Variable Generator
	echo wfm_reports_utils::managePremiumFeature("openWFMVariableGenerator", "wfm_utils_premium.php", "openWFMVariableGenerator", $extraParams);
	?>

</span>