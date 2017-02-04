<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

//$eventType = (isset($_REQUEST['eventType'])) ? $_REQUEST['eventType'] : "";//////////*******de cuando estaban separados los events por type en las vistas... lo puso dani asi y luego se lo cambio a todo junto

$module_name = 'asol_Events';
$object_name = 'asol_Events';
$_module_name = 'asol_events';

$parent_module = (isset($_REQUEST['parent_module'])) ? $_REQUEST['parent_module'] : "";
$parent_id = (isset($_REQUEST['parent_id'])) ? $_REQUEST['parent_id'] : ""; // If parent_module=asol_Task -> the parent_id is the id of the process selected in the task call_process (not the task_id).

wfm_utils::wfm_log('debug', "from asol_Events \$parent_module=[".$parent_module."]", __FILE__, __METHOD__, __LINE__);
wfm_utils::wfm_log('debug', "from asol_Events \$parent_id=[".$parent_id."]", __FILE__, __METHOD__, __LINE__);

if ($parent_module == 'asol_Process') {
	wfm_utils::wfm_log('debug', "asol_Process ", __FILE__, __METHOD__, __LINE__);
		//global $db;
		$sql = 'asol_events.id NOT IN (
											SELECT DISTINCT asol_procea8ca_events_idb 
											FROM asol_proces_asol_events_c 
											WHERE deleted = 0
										) 
				';
} elseif ($parent_module == 'asol_Task') {
	wfm_utils::wfm_log('debug', "asol_Task ", __FILE__, __METHOD__, __LINE__);
	
	$sql = "asol_events.id  IN (
											SELECT DISTINCT asol_proces_asol_events_c.asol_procea8ca_events_idb 
											FROM asol_proces_asol_events_c
											INNER JOIN asol_events
											ON asol_events.id = asol_proces_asol_events_c.asol_procea8ca_events_idb AND asol_events.trigger_type='subprocess'
											WHERE asol_proces_asol_events_c.deleted = 0 AND asol_proces_asol_events_c.asol_proce6f14process_ida='".$parent_id."'
										) 
				";
}

$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => 'name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
							'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
							/*'whereStatement' => 'asol_events.id NOT IN (
																		SELECT DISTINCT asol_procea8ca_events_idb 
																		FROM asol_proces_asol_events_c 
																		WHERE deleted = 0
																	) 
											',
							*/	
							'whereStatement' => $sql,
						);
?>