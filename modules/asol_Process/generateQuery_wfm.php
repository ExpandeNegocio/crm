<?php

require_once ("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

//test();

require_once ("modules/asol_Process/generateQuery.php");

class generateQuery_wfm extends generateQuery_reports {

	static function test() {

		global $db;

		// Get events
		$events_query = $db->query("SELECT id FROM asol_events");
		while ($events_row = $db->fetchByAssoc($events_query)) {

			$event_id = $events_row['id'];
			wfm_utils::wfm_log('debug', "\$event_id=[$event_id]", __FILE__, __METHOD__, __LINE__);

			self::getObjectsIds_fromEventId($event_id);
		}
	}

	static function getObjectsIds_fromEventId($eventId, $alternative_database, $trigger_module, $userTZ, $domain = null) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$sql_array = self::getQueryArray('asol_Events', $eventId, $trigger_module, $userTZ, $alternative_database, $domain);
		wfm_utils::wfm_log('debug', '$sql_array=['.var_export($sql_array, true).']', __FILE__, __METHOD__, __LINE__);

		$sql = self::getSql($sql_array);
		wfm_utils::wfm_log('asol_debug', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);

		$object_ids = Array();

		//********************************************//
		//*****Managing External Database Queries*****//
		//********************************************//
		$alternativeDb = ($alternative_database >= 0) ? $alternative_database : false;

		$externalObject_ids = Basic_wfm::getSelectionResults($sql, false, $alternativeDb);
		foreach ($externalObject_ids as $value) {
			$object_ids[] = $value['ID'];
		}
		//wfm_utils::wfm_log('debug', '$object_ids=['.print_r($object_ids, true).']', __FILE__, __METHOD__, __LINE__);

		return $object_ids;
	}

	static function getObjectsIds_fromEventId_2($eventId, $alternative_database, $trigger_module, $userTZ) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$sql_array = self::getQueryArray('asol_Events', $eventId, $trigger_module, $userTZ, $alternative_database);
		wfm_utils::wfm_log('debug', '$sql_array=['.print_r($sql_array, true).']', __FILE__, __METHOD__, __LINE__);

		$sql = self::getSql($sql_array);

		$object_ids = Array();

		if ($alternative_database >= 0) {

			//			global $beanList;

			//			$class_name = $beanList['asol_Events'];
			//			$focus = new $class_name();
			//			$focus->retrieve($eventId);
			$externalObject_ids = Basic_wfm::getSelectionResults($sql, false, $alternative_database);
			foreach ($externalObject_ids as $value) {
				$object_ids[] = $value['ID'];
			}
		} else {
			$object_ids = self::getObjectIds($sql);
		}
		//wfm_utils::wfm_log('debug', '$object_ids=['.print_r($object_ids, true).']', __FILE__, __METHOD__, __LINE__);

		return $object_ids;
	}

	static function getSql($queryArray) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		return $queryArray['sqlSelect'].$queryArray['sqlFromQuery'].$queryArray['sqlJoinQuery'].$queryArray['sqlWhereQuery'];
	}

	static function getObjectIds($sql) {

		global $db;

		// Get the objects that applies conditions
		$object_ids = Array();
		$objects_query = $db->query($sql);
		while ($object_row = $db->fetchByAssoc($objects_query)) {
			$object_ids[] = $object_row['ID'];
		}

		return $object_ids;
	}

	static function getQueryArray($wfm_module, $wfm_module_Id, $trigger_module, $userTZ, $alternative_database, $domain = null) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $beanList;

		$class_name = $beanList[$wfm_module];
		$focus = new $class_name();
		//wfm_utils::wfm_log('asol', 'ANTES 5', __FILE__, __METHOD__, __LINE__);
		$focus->retrieve($wfm_module_Id);
		//wfm_utils::wfm_log('asol', 'DESPUES 5', __FILE__, __METHOD__, __LINE__);
		$wfm_table = $focus->table_name;

		$user_id = $focus->created_by;
		$modulesTables = wfm_utils::wfm_get_moduleName_moduleTableName_conversion_array($user_id);
		//$wfm_table = $modulesTables[$wfm_module];

		$rs = Basic_wfm::getSelectionResults("SELECT * FROM {$wfm_table} WHERE id = '{$wfm_module_Id}'", false);

		// [WFM_MODULE] CONDITIONS
		$conditions = $rs[0]['conditions'];
		//wfm_utils::wfm_log('asol', "\$conditions[$conditions]", __FILE__, __METHOD__, __LINE__);

		if ($alternative_database >= 0) {

			//********************************************//
			//*****Managing External Database Queries*****//
			//********************************************//
			$alternativeDb = ($alternative_database >= 0) ? $alternative_database : false;
			$externalDataBaseQueryParams = wfm_reports_utils::wfm_manageExternalDatabaseQueries($alternativeDb, $trigger_module);

			$trigger_module_table = $externalDataBaseQueryParams["report_table"];
			///////////

			$rs = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$trigger_module_table, true, $alternative_database);

			foreach($rs as $value){

				$fieldConstraint = $value['Key'];//PRI  MUL

				if ($fieldConstraint == 'PRI') {
					$field_ID_name = $value['Field'];
				}
			}
		}

		// TRANSLATE
		$aux = self::translate_conditions_to_filterValues_and_fieldValues($conditions, false, $field_ID_name);
		$field_values = $aux['field_values'];
		$filter_values = $aux['filter_values'];
		if ($filter_values == null) {
			$filter_values = Array();
		}

		$querys = self::getQueryArray_fromConditions_or_fromCustomVariables($field_values, $filter_values, $trigger_module, $userTZ, $modulesTables, $user_id, $alternative_database, $domain);

		return $querys;
	}

	static function getQueryArray_fromConditions_or_fromCustomVariables($field_values, $filter_values, $trigger_module, $userTZ, $modulesTables, $user_id, $alternative_database, $published_domain = null) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $current_user, $beanList, $beanFiles;

		// GET TRIGGER_MODULE


		//********************************************//
		//*****Managing External Database Queries*****//
		//********************************************//
		$alternativeDb = ($alternative_database >= 0) ? $alternative_database : false;
		$externalDataBaseQueryParams = wfm_reports_utils::wfm_manageExternalDatabaseQueries($alternativeDb, $trigger_module);

		$useExternalDbConnection = true;

		$useAlternativeDbConnection = $externalDataBaseQueryParams["useAlternativeDbConnection"];
		$domainField = $externalDataBaseQueryParams["domainField"];
		$trigger_module = $externalDataBaseQueryParams["report_module"];
		$trigger_module_table = $externalDataBaseQueryParams["report_table"];

		//////////////////////////////
		/*
		 $class_name = $beanList[$trigger_module];
		 require_once($beanFiles[$class_name]);
		 $bean = new $class_name();

		 $trigger_module_table = $bean->table_name;
		 */

		$audited_report = ($rs[0]['audited_report'] == '1') ? true : false;

		// Chart
		$rs[0]['report_charts_detail'] = '${v3.5.0}';

		$chart_info = explode("\${pipe}", substr($rs[0]['report_charts_detail'], 0, -9));
		foreach ($chart_info as $info)
		$chartInfo[] = explode("\${dp}", $info);

		//wfm_utils::wfm_log('debug', '$field_values=['.print_r($field_values,true).'], $filter_values=['.print_r($filter_values,true).'], $trigger_module=['.print_r($trigger_module,true).'], $trigger_module_table=['.print_r($trigger_module_table,true).'], $audited_report=['.print_r($audited_report,true).'], $useAlternativeDbConnection=['.print_r($useAlternativeDbConnection,true).'], $modulesTables=['.print_r($modulesTables,true).']', __FILE__, __METHOD__, __LINE__);

		//getQuerys
		//require_once("generateQuery_functions.php");

		$sqlJoinQueryArray = generateQuery_reports::getSqlJoinQuery($field_values, $filter_values, $trigger_module, $trigger_module_table, $audited_report, $useAlternativeDbConnection, $modulesTables);

		$moduleCustomJoined = $sqlJoinQueryArray["moduleCustomJoined"];
		$leftJoineds = $sqlJoinQueryArray["leftJoineds"];

		$sqlSelectQueryArray = generateQuery_reports::getSqlSelectQuery($field_values, $chartInfo, $trigger_module_table, $audited_report, $leftJoineds);
		$custom_fields = $sqlSelectQueryArray["customFields"];

		$sqlGroupByQueryArray = generateQuery_reports::getSqlGroupByQuery($field_values, $trigger_module_table);

		$sqlOrderByQueryArray = generateQuery_reports::getSqlOrderByQuery($field_values, $trigger_module_table, $leftJoineds);

		//SELECT
		$sqlTotalsC = $sqlSelectQueryArray["querys"]["Charts"];
		$sqlSelect = $sqlSelectQueryArray["querys"]["Select"];
		$sqlTotals = $sqlSelectQueryArray["querys"]["Totals"];

		//FROM
		$sqlFromQuery = generateQuery_reports::getSqlFromQuery($trigger_module_table, $custom_fields, $moduleCustomJoined, $audited_report);

		//LEFT JOIN
		$sqlJoinQuery = $sqlJoinQueryArray["querys"]["Join"];
		$sqlCountJoinQuery = $sqlJoinQueryArray["querys"]["CountJoin"];

		// get theUser
		$user_id =  ($user_id !== null) ? $user_id : '1';
		require_once('modules/Users/User.php');
		$theUser = new User();
		//wfm_utils::wfm_log('asol', 'ANTES 3', __FILE__, __METHOD__, __LINE__);
		$theUser->retrieve($user_id);
		//wfm_utils::wfm_log('asol', 'DESPUES 3', __FILE__, __METHOD__, __LINE__);

		$currentUserAsolConfig = wfm_reports_utils::getCurrentUserAsolConfig($user_id);
		$quarter_month = $currentUserAsolConfig["quarter_month"];
		$week_start = $currentUserAsolConfig["week_start"];

		//WHERE
		$sqlWhereQuery = generateQuery_reports::getSqlWhereQuery($filter_values, $field_values, $trigger_module_table, $userTZ, $quarter_month, $week_start, $useAlternativeDbConnection, true);

		$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();
		if (($isDomainsInstalled) && ($published_domain !== null)) {
			$published_domain = ($published_domain == null) ? $theUser->asol_domain_id : $published_domain;
			generateQuery_reports::modifySqlWhereForAsolDomainsQuery($sqlWhereQuery, $trigger_module_table, $theUser, true, $published_domain, $domainField);
		}

		//GROUP BY
		$sqlGroupByQuery = $sqlGroupByQueryArray["querys"]["Group"];
		$sqlChartGroupByQuery = $sqlGroupByQueryArray["querys"]["ChartGroup"];

		//ORDER BY
		$sqlOrderByQuery = $sqlOrderByQueryArray["query"];

		$querys = Array(
		"sqlTotalsC" => $sqlTotalsC,
		"sqlSelect" => $sqlSelect,
		"sqlTotals" => $sqlTotals,
		"sqlFromQuery" => $sqlFromQuery,
		"sqlJoinQuery" => $sqlJoinQuery,
		"sqlCountJoinQuery" => $sqlCountJoinQuery,
		"sqlWhereQuery" => $sqlWhereQuery,
		"sqlGroupByQuery" => $sqlGroupByQuery,
		"sqlChartGroupByQuery" => $sqlChartGroupByQuery,
		"sqlOrderByQuery" => $sqlOrderByQuery,
		);

		return $querys;
	}

	static function translate_conditions_to_filterValues_and_fieldValues($conditions, $one_query_one_condition, $field_ID_name = null) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		if ($field_ID_name == null) {
			$field_ID_name = 'id';
		}

		$condition_array = Array();
		if (!empty($conditions)) {
			$conditions_array = explode('${pipe}', $conditions);

			$condition_values = Array();

			$x=0;
			foreach ($conditions_array as $condition) {

				$j=0;
				$condition_array = explode('${dp}', $condition);
				$condition_array[4] = stripslashes($condition_array[4]);

				foreach ($condition_array as $val) {
					$condition_values[$x][$j] = $val;
					$j++;
				}

				//wfm_utils::wfm_log('asol', "\$condition_values[$x]=[".print_r($condition_values[$x],true)."]", __FILE__, __METHOD__, __LINE__);

				// name
				$aux = explode('${comma}', $condition_values[$x][0]);
				$condition_values[$x][0] = $aux[0];

				// one_query_one_condition
				if ($one_query_one_condition) {
					$condition_values[$x][12] = '0:';
				}

				$condition_values[$x][13] = html_entity_decode($condition_values[$x][13]);
				// aux
				$condition_values[$x][14] = "";

				/////////////
				// REORDER //
				/////////////
				$a = $condition_values[$x];

				// FIEDLS
				// rule indicating new key order: (Reports => WFM)
				$equivalence_fields = array(
				0 => 0,
				1 => 0,
				2 => 14,
				3 => 14,
				4 => 14,
				5 => 13,
				6 => 14,
				7 => 14,
				8 => 6,
				9 => 7,
				10 => 8,
				11 => 9,
				12 => 14,
				13 => 14
				);
				$d = array();
				foreach($equivalence_fields as $index_reports => $index_wfm) {
					$d[$index_reports] = $a[$index_wfm];
				}

				// Only add field if relate
				//if ($condition_values[$x][8] == "true") {
				$field_values[$x] =  $d;
				//}

				//aux
				$field_values[$x][3] = '0';
				//$field_values[$x][5] = '0${comma}';
				$field_values[$x][6] = '0';
				// display yes
				$field_values[$x][2] = 'yes';

				//wfm_utils::wfm_log('asol', "\$field_values[$x]=[".print_r($field_values[$x],true)."]", __FILE__, __METHOD__, __LINE__);

				// FILTERS
				// rule indicating new key order: (Reports => WFM)
				$equivalence_filters = array(
				0 => 0,
				1 => 3,
				2 => 4,
				3 => 5,
				4 => 6,
				5 => 7,
				6 => 9,
				7 => 14,
				8 => 14,
				9 => 14,
				10 => 14,
				11 => 14,
				12 => 14,
				13 => 12
				);
				$c = array();
				foreach($equivalence_filters as $index_reports => $index_wfm) {
					$c[$index_reports] = $a[$index_wfm];
				}

				//
				$filter_values[$x] = $c;
				// isRelated, key
				$filter_values[$x][5] = ($condition_values[$x][8] == "true") ? $condition_values[$x][7] : "false";

				//wfm_utils::wfm_log('asol', "\$filter_values[$x]=[".print_r($filter_values[$x],true)."]", __FILE__, __METHOD__, __LINE__);

				$x++;
			}
		}

		// add field id
		$field_id_aux = array(
		0 => $field_ID_name,
		1 => 'ID',
		2 => 'yes',
		3 => '0',
		4 => '',
		5 => '0${comma}',
		6 => '0',
		7 => '',
		8 => 'char(36)',
		9 => '',
		10 => 'false',
		11 => '1_1',
		12 => 'undefined',
		13 => 'undefined'
		);
		//if (count($field_values) == 0) {
		$field_values[] = $field_id_aux;
		//}

		// Re index field_values
		$field_values = array_values($field_values);

		return Array (
		'field_values' => $field_values,
		'filter_values' => $filter_values
		);
	}

	static function translate_customVariables_to_filterValues_and_fieldValues($customVariables) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$customVariables_array = explode('${pipe}', $customVariables);

		$customVariable_values = Array();

		$x=0;
		foreach ($customVariables_array as $customVariable) {

			$j=0;
			$customVariable_array = explode('${dp}', $customVariable);

			foreach ($customVariable_array as $val) {
				$customVariable_values[$x][$j] = $val;
				$j++;
			}

			wfm_utils::wfm_log('debug', "\$customVariable_values[$x]=[".print_r($customVariable_values[$x],true)."]", __FILE__, __METHOD__, __LINE__);

			// module_field
			$aux = explode('${comma}', $customVariable_values[$x][2]);
			$customVariable_values[$x][2] = $aux[0];

			// aux
			$customVariable_values[$x][13] = "";

			/////////////
			// REORDER //
			/////////////
			$a = $customVariable_values[$x];

			// FIEDLS
			// rule indicating new key order: (Reports => WFM)
			$equivalence_fields = array(
			0 => 2,
			1 => 2,
			2 => 13,
			3 => 13,
			4 => 13,
			5 => 3,
			6 => 13,
			7 => 13,
			8 => 4,
			9 => 5,
			10 => 6,
			11 => 8,
			12 => 13,
			13 => 13
			);
			$d = array();
			foreach($equivalence_fields as $index_reports => $index_wfm) {
				$d[$index_reports] = $a[$index_wfm];
			}

			// Only add field if relate
			//if ($customVariable_values[$x][7] == "true") {
			$field_values[$x] =  $d;
			//}

			// display yes
			$field_values[$x][2] = 'yes';

			//$field_values[$x][5] = replace_wfm_vars(null, $field_values[$x][5], $trigger_module, $bean_id, $old_bean, $new_bean, $custom_variables, $current_user_id);

			wfm_utils::wfm_log('debug', "\$field_values[$x]=[".print_r($field_values[$x],true)."]", __FILE__, __METHOD__, __LINE__);

			/*
			 // FILTERS
			 // rule indicating new key order: (Reports => WFM)
			 $equivalence_filters = array(
			 0 => 0,
			 1 => 3,
			 2 => 4,
			 3 => 5,
			 4 => 6,
			 5 => 7,
			 6 => 8,
			 7 => 13,
			 8 => 13,
			 9 => 13,
			 10 => 13,
			 11 => 13,
			 12 => 13,
			 13 => 12
			 );
			 $c = array();
			 foreach($equivalence_filters as $index_reports => $index_wfm) {
			 $c[$index_reports] = $a[$index_wfm];
			 }

			 //
			 $filter_values[$x] = $c;
			 // isRelated, key
			 $filter_values[$x][7] = ($customVariable_values[$x][8] == "true") ? $customVariable_values[$x][7] : "false";
			 $filter_values[$x][8] = "";
			 */
			//wfm_utils::wfm_log('asol', "\$filter_values[$x][".print_r($filter_values[$x],true)."]", __FILE__, __METHOD__, __LINE__);

			$x++;
		}

		// Re index field_values
		$field_values = array_values($field_values);

		return Array (
		'field_values' => $field_values,
		'filter_values' => $filter_values
		);
	}

	static function getCustomVariableValue($sql, $new_custom_variable_field_name, $alternativeDb) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $db;

		// Get the objects that applies conditions
		$objects = Array();

		//	if ($alternative_database == '-1') {
		//		$objects_query = $db->query($sql);
		//		while ($object_row = $db->fetchByAssoc($objects_query)) {
		//			$objects[] = $object_row[$new_custom_variable_field_name];
		//			wfm_utils::wfm_log('debug', '$object_row=['.var_export($object_row, true).']', __FILE__, __METHOD__, __LINE__);
		//		}
		//	} else {
		$object_row = Basic_wfm::getSelectionResults($sql, false, $alternativeDb);
		$objects[] = $object_row[0][$new_custom_variable_field_name];

		//	}

		return $objects[0];
	}

	static function getCustomSqlResults($sql, $notCrmExternalDb) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('asol', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $db;

		$objects = Basic_wfm::getSelectionResults($sql, false, $notCrmExternalDb);

		return $objects;
	}
}

?>