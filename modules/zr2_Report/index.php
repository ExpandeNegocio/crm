<?php 
	require_once('modules/Administration/Administration.php');
	$admin = new Administration();
	$admin->retrieveSettings();
	$index_include = $admin->settings['zuckerreports2_index_include'];
	
	if ($index_include == "OnDemand")
	{
		SugarApplication::redirect('index.php?action=ReportOnDemand&module=zr2_Report');  
	}
	else if ($index_include == "ReportCategories")
	{
		SugarApplication::redirect('index.php?action=index&module=zr2_ReportContainer');  
	} 
	else 
	{
		SugarApplication::redirect('index.php?action=index&module=zr2_ReportContainer');  
	}
?>
