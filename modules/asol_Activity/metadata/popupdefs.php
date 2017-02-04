<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$module_name = 'asol_Activity';
$object_name = 'asol_Activity';
$_module_name = 'asol_activity';

$parent_module = (isset($_REQUEST['parent_module'])) ? $_REQUEST['parent_module'] : "";
$parent_id = (isset($_REQUEST['parent_id'])) ? $_REQUEST['parent_id'] : "";

wfm_utils::wfm_log('debug', "\$parent_module=[".$parent_module."]", __FILE__, __METHOD__, __LINE__);
wfm_utils::wfm_log('debug', "\$parent_id=[".$parent_id."]", __FILE__, __METHOD__, __LINE__);

if ($parent_module == 'asol_Events') {
	wfm_utils::wfm_log('debug', "asol_Events ", __FILE__, __METHOD__, __LINE__);
	
	global $db;
	
	$parent_process_id__query = $db->query("
												SELECT asol_proce6f14process_ida
												FROM asol_proces_asol_events_c
												WHERE asol_procea8ca_events_idb = '".$parent_id."'
											");
	$parent_process_id__row=$db->fetchByAssoc($parent_process_id__query);
	$parent_process_id = $parent_process_id__row['asol_proce6f14process_ida'];
	
	$sql = "
				(
					asol_activity.id NOT IN (SELECT DISTINCT asol_activ9e2dctivity_idb FROM asol_activisol_activity_c WHERE deleted = 0)
					AND asol_activity.id NOT IN (
														SELECT asol_eventssol_activity_c.asol_event8042ctivity_idb
														FROM asol_eventssol_activity_c
														INNER JOIN asol_proces_asol_events_c 
														ON (asol_proces_asol_events_c.asol_procea8ca_events_idb = asol_eventssol_activity_c.asol_event87f4_events_ida  AND asol_proces_asol_events_c.asol_proce6f14process_ida !='".$parent_process_id."' AND  asol_proces_asol_events_c.deleted = 0)
														WHERE ( asol_eventssol_activity_c.deleted = 0)
												)
					AND asol_activity.id NOT IN (
													SELECT asol_event8042ctivity_idb 
													FROM asol_eventssol_activity_c 
													WHERE asol_event87f4_events_ida = '".$parent_id."' AND deleted = 0
												)
					AND asol_activity.deleted = 0
				)
			";

} elseif ($parent_module == 'asol_Activity') { // next_activity
	wfm_utils::wfm_log('debug', "sol_Activity ", __FILE__, __METHOD__, __LINE__);
	$sql = "
				( 
					asol_activity.id != '".$parent_id."'
					AND asol_activity.id NOT IN (SELECT DISTINCT asol_activ9e2dctivity_idb FROM asol_activisol_activity_c WHERE deleted = 0)
					AND asol_activity.id NOT IN (SELECT DISTINCT asol_event8042ctivity_idb FROM asol_eventssol_activity_c WHERE deleted = 0)
					AND asol_activity.deleted = 0
				)
		   ";
}

$popupMeta = array(
					'moduleMain' => $module_name,
					'varName' => $object_name,
					'orderBy' => 'name',
					'whereClauses' => 
										array(
												'name' => $_module_name . '.name',
												),
										'searchInputs'=> 
												array(
														$_module_name. '_number', 'name', 'priority','status'
														),

										//'whereStatement' => '('.$_module_name.'.id!="'.$parent_id.'") '.$relate_sql,
					
										'whereStatement' => $sql,				
				);
				
/*********************************************************************************************************************************************************************************/
//$relate_table = ($_REQUEST['parent_module'] == 'activity') ? "asol_activisol_activity_c" : "asol_eventssol_activity_c";
//$relate_field = ($_REQUEST['parent_module'] == 'activity') ? "asol_activ9e2dctivity_idb" : "asol_eventssol_activity_c";


//$relate_table = "asol_activisol_activity_c";
//$relate_field_left = "asol_activ898activity_ida";
//$relate_field_right = "asol_activ9e2dctivity_idb";
//
//$relate_sql = 'AND ('.$_module_name.'.id NOT IN (SELECT DISTINCT '.$relate_field_left.' FROM '.$relate_table.' WHERE deleted=0)) '; //************** que la actividad no tenga seleccionada a otra actividad??????????????
//$relate_sql .= 'AND ('.$_module_name.'.id NOT IN (SELECT DISTINCT '.$relate_field_right.' FROM '.$relate_table.' WHERE deleted=0))';//***************que la actividad no esta seleccionada por otra actividad

//	$processes_not_parent_process__query = $db->query("
	//															SELECT asol_proce6f14process_ida AS process_id
	//															FROM asol_proces_asol_events_c
	//															WHERE asol_procea8ca_events_idb != '".$parent_id."'
	//														");
	//	$processes_not_parent_process__array = Array();
	//	while($processes_not_parent_process__row = $db->fetchByAssoc($processes_not_parent_process__query)){
	//		$processes_not_parent_process__array[]= $processes_not_parent_process__row['process_id'];
	//	}
	//	foreach($processes_not_parent_process__array as $key => $value) {
	//
	//	}

	//
	//	$activities_not_from_parent_process__query = $db->query("
	//																SELECT asol_eventssol_activity_c.asol_activ9e2dctivity_idb AS activity_id
	//																FROM asol_eventssol_activity_c
	//																INNER JOIN asol_proces_asol_events_c ON (asol_proces_asol_events_c.asol_procea8ca_events_idb !='".$parent_id."' AND  asol_proces_asol_events_c.deleted = 0)
	//																WHERE asol_eventssol_activity_c.deleted = 0
	//															");
	//	$activities_not_from_parent_process__row = $db->fetchByAssoc($activities_not_from_parent_process__query);



	//	$events_from_parent_process_id_query = $db->query("
	//															SELECT asol_procea8ca_events_idb
	//															FROM asol_proces_asol_events_c
	//															WHERE asol_proce6f14process_ida = '".$parent_process_id_row['parent_process_id']."'
	//														");
				
?>