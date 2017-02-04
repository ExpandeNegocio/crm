<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $db;

//***********************************************************//
//********** Restauramos los ficheros originales ************//
//***********************************************************//

echo "<b>Restored Files:</b><br/><br/>";

//***********************************************************//
//********** Restauramos los ficheros originales ************//
//***********************************************************//

echo "<br/><br/><br/><b>Modified Files:</b><br/><br/>";
	
echo "<br/><b>AlineaSol Repair Done.</b>";

//Repair and Rebuild
$module = array('All Modules');
$selected_actions = array('clearAll');

require_once ('modules/Administration/QuickRepairAndRebuild.php');
$randc = new RepairAndClear();
$randc->repairAndClearAll ( $selected_actions, $module, false, false );
//Repair and Rebuild

echo "<br/><b>SugarCRM Repair & Rebuild Done.</b>";

?>