<?php

class generateQuery_reports {


	static public function getQuerys($reportId) {
	
		global $current_user, $beanList, $beanFiles;
	
		$focus = new Basic_wfm();
		$focus->retrieve($reportId);
	
	
		$acl_modules = ACLAction::getUserActions($focus->created_by);
	
		//Get an array of table names for admin accesible modules
		$modulesTables = Array();
		foreach($acl_modules as $key=>$mod){
	
			if($mod['module']['access']['aclaccess'] >= 0){
	
				$class_name = $beanList[$key];
				if (!empty($class_name)) {
	
					require_once($beanFiles[$class_name]);
	
					$bean = new $class_name();
					$table_name = $bean->table_name;
	
					$modulesTables[$key] = $table_name;
	
					unset($bean);
						
				}
					
			}
	
		}
	
	
		$rs = Basic_wfm::getSelectionResults("SELECT * FROM Basic_wfms WHERE id = '".$reportId."'", false);
	
		$report_module = $rs[0]['report_module'];
		$useAlternativeDbConnection = false;
		$alternativeDb = ($rs[0]['alternative_database'] >= 0) ? $rs[0]['alternative_database'] : false;
	
		if ($alternativeDb !== false) {
	
			$useAlternativeDbConnection = true;
	
			$alternativeModuleAux = explode(" ", $report_module);
			$alternativeModule = explode(".", $alternativeModuleAux[0]);
			$report_module = $alternativeModule[1];
			$report_table = $report_module;
	
		} else {
	
			$class_name = $beanList[$report_module];
			require_once($beanFiles[$class_name]);
			$bean = new $class_name();
	
			$report_table = $bean->table_name;
	
		}
	
		$audited_report = ($rs[0]['audited_report'] == '1') ? true : false;
	
	
		$fields = explode('${pipe}', substr($rs[0]['report_fields'], 0, -9));
		$field_values = Array();
	
		$i=0;
		foreach ($fields as $field_row) {
	
			$values = explode('${dp}', $field_row);
			$j=0;
	
			foreach ($values as $val){
	
				$field_values[$i][$j] = $val;
				$j++;
			}
			$i++;
		}
	
		$filters = explode('${pipe}', substr($rs[0]['report_filters'], 0, -9));
		$filter_values = Array();
	
		$x=0;
		foreach ($filters as $filter_row){
	
			$j=0;
			$values = explode('${dp}', $filter_row);
			$values[2] = stripslashes($values[2]);
	
			foreach ($values as $val) {
				$filter_values[$x][$j] = $val;
				$j++;
			}
			$x++;
	
		}
	
	
		$chart_info = explode('${pipe}', substr($rs[0]['report_charts_detail'], 0, -9));
		foreach ($chart_info as $info)
		$chartInfo[] = explode('${dp}', $info);
	
	
		//getQuerys
		$sqlJoinQueryArray = self::getSqlJoinQuery($field_values, $filter_values, $report_module, $report_table, $audited_report, $useAlternativeDbConnection, $modulesTables);
	
		$moduleCustomJoined = $sqlJoinQueryArray["moduleCustomJoined"];
		$leftJoineds = $sqlJoinQueryArray["leftJoineds"];
	
		$sqlSelectQueryArray = self::getSqlSelectQuery($field_values, $chartInfo, $report_table, $audited_report, $leftJoineds);
		$custom_fields = $sqlSelectQueryArray["customFields"];
	
		$sqlGroupByQueryArray = self::getSqlGroupByQuery($field_values, $report_table);
	
		$sqlOrderByQueryArray = self::getSqlOrderByQuery($field_values, $report_table, $leftJoineds);
	
		//SELECT
		$sqlTotalsC = $sqlSelectQueryArray["querys"]["Charts"];
		$sqlSelect = $sqlSelectQueryArray["querys"]["Select"];
		$sqlTotals = $sqlSelectQueryArray["querys"]["Totals"];
	
		//FROM
		$sqlFromQuery = self::getSqlFromQuery($report_table, $custom_fields, $moduleCustomJoined, $audited_report);
	
		//LEFT JOIN
		$sqlJoinQuery = $sqlJoinQueryArray["querys"]["Join"];
		$sqlCountJoinQuery = $sqlJoinQueryArray["querys"]["CountJoin"];
	
		//WHERE
		$sqlWhereQuery = self::getSqlWhereQuery($filter_values, $field_values, $report_table, $current_user->getPreference("timezone"), $useAlternativeDbConnection, true);
	
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
	
	static public function relateFieldUsedInFieldFormula($fieldInfo, $field_values, $modulesTables) {
	
		$returnedValue = false;
	
		if ($fieldInfo[10] == "true") { //isRelate
	
			$fieldArray = explode('.', $fieldInfo[0]);
	
			$fieldModuleArray = explode("_", $fieldArray[0]);
			$isCustomfield = ($fieldModuleArray[count($fieldModuleArray) - 1] == 'cstm');
			$fieldTableName = ($isCustomfield) ? substr($fieldArray[0], 0, -5): $fieldArray[0];
	
			$fieldModuleName = array_search($fieldTableName, $modulesTables); //Get array with table to moduleName Reference as in pre_installing dropdowns fixup
			$fieldName = $fieldArray[1];
	
			$fieldVariable = ($isCustomfield) ? '${'.$fieldModuleName.'_Cstm-&gt;'.$fieldInfo[9].'-&gt;'.$fieldName.'}' : '${'.$fieldModuleName.'-&gt;'.$fieldInfo[9].'-&gt;'.$fieldName.'}';
	
			foreach ($field_values as $fieldValue) {
					
				if (strpos($fieldValue[5], $fieldVariable) !== false) {
	
					$returnedValue = true;
					break;
	
				}
	
			}
	
		}
	
		return $returnedValue;
	
	}
	
	static public function doCountLeftJoin($fieldInfo, $filter_values, $isNonCrmDatabase) {
	
		$fieldArray = explode(".", $fieldInfo[0]);
		$doCountLeftJoin = false;
	
		$functionValues = explode('${comma}', $fieldInfo[5]);
	
		$hasFunction = ((strtolower($fieldInfo[2]) == "yes") && (($functionValues[0] != "0") && ($functionValues[0] != "undefined")));
		$hasGroupedOrDetail = ($fieldInfo[6] != "0");
	
		$primaryKeyRel = false;
		$fieldInfo9 = explode(" ", $fieldInfo[9]);
	
		if ($isNonCrmDatabase) {
			if ($fieldInfo9[2] == 'PRI')
			$primaryKeyRel = true;
		} else {
			if ($fieldInfo9[0] == 'id')
			$primaryKeyRel = true;
		}
	
		if ($hasFunction || $hasGroupedOrDetail || $primaryKeyRel) {//Mostrar solo si display es Yes
	
			if (count($fieldArray) >= 2)
			$doCountLeftJoin = true;
	
		}
	
		if (!$doCountLeftJoin) { //Sólo si display es Yes y no ha sido verificado como Related Field Function
	
			foreach ($filter_values as $key=>$filter) {
	
				if ((count($fieldArray) >= 2) && (($filter[0] == $fieldInfo[0]) && ($filter[5] == $fieldInfo[9]))) {
	
					$doCountLeftJoin = true;
					break;
	
				}
	
			}
	
		}
	
		return $doCountLeftJoin;
	
	}
	
	static public function getSqlJoinQuery(& $field_values, & $filter_values, $report_module, $report_table, $audited_report, $isNonCrmDatabase, $modulesTables) {
	
		if ($audited_report) {
	
			//**************************************//
			//****Define Returned Function Array****//
			//**************************************//
			$returnedLeftJoinArray = self::manageAuditSqlJoin($field_values, $filter_values, $report_table);
	
		} else {
	
			global $db, $beanList, $beanFiles;
	
			//*************************************//
			//*****Variable Definition Global******//
			//*************************************//
			$sqlFilterTableIndex = Array();
			$isLeftJoinedCustom = array();
	
			$sqlJoin = "";
			$sqlCountJoin = "";
	
			$moduleCustomJoined = false;
			$moduleCountCustomJoined = false;
			$leftJoineds = array();
			$leftCountJoineds = array();
			$keySearch = "";
	
	
			for ($i=0; $i<count($field_values); $i++) {
	
				//****************************************//
				//*****Variable Definition Iteration******//
				//****************************************//
				$aux = explode(".",$field_values[$i][0]);
				$aux2 = explode("_", $aux[0]);
					
				if ($isNonCrmDatabase) {
	
					$auxFieldKey = explode(" ", $field_values[$i][9]);
	
					$fieldKey = $auxFieldKey[0];
					$tableKey = $fieldKey;
	
					$searchFieldKey = $field_values[$i][9];
						
				} else {
	
					$auxFieldKey = explode(" ", $field_values[$i][9]);
	
					$fieldKey = $auxFieldKey[0];
					$tableKey = $fieldKey;
	
					$searchFieldKey = $field_values[$i][9];
					$field_values[$i][9] = $auxFieldKey[0];
	
					$searchFieldKeyRelationshipName = $auxFieldKey[1];
						
				}
					
				$numTokensAux2 = count($aux2);
				$auxTableName = (($aux2[$numTokensAux2-1]) == 'cstm') ? substr($aux[0], 0, -5) : $aux[0];
				$isCustomTable = (($aux2[$numTokensAux2-1]) == 'cstm') ? true : false;
	
				$new_key_search = array_search($auxTableName."|".$searchFieldKey, $leftJoineds);
				$new_count_key_search = array_search($auxTableName."|".$searchFieldKey, $leftCountJoineds);
	
				$keySearch = ($new_key_search === false) ? $i : $new_key_search;
	
					
					
				//****************************************//
				//*****Calculate Left Join Variables******//
				//****************************************//
				$fieldHasFilter = self::fieldHasFilter($filter_values, $field_values[$i], $aux, $searchFieldKey);
					
				$allowDisplayJoin = ((strtolower($field_values[$i][2]) == "yes") || ((strtolower($field_values[$i][2]) == "no") && ($fieldHasFilter)) || ($field_values[$i][6] != "0"));
				$relateFieldUsedInFormula = self::relateFieldUsedInFieldFormula($field_values[$i], $field_values, $modulesTables);
					
				$doJoin = ((((empty($leftJoineds)) || ($new_key_search === false)) && ($allowDisplayJoin) && (count($aux) >= 2)) || $relateFieldUsedInFormula);
				$doCountJoin = (((self::doCountLeftJoin($field_values[$i], $filter_values, $isNonCrmDatabase)) && ( (empty($leftJoineds)) || ($new_count_key_search === false))) || $relateFieldUsedInFormula);
	
				
				if ($field_values[$i][9] == "id") {
	
					if (count($aux) == 2) {
	
						$sql_relationships = "SELECT DISTINCT relationship_name, lhs_table, lhs_key, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs FROM relationships WHERE rhs_table='".$report_table."' AND lhs_table='".strtolower($auxTableName)."' AND rhs_key='".$fieldKey."'";
						$rs = $db->query($sql_relationships);
							
						if ($rs->num_rows > 0) { //Hay relacion de derecha a izquierda
	
							//*************************************//
							//******Right To Left Relationship*****//
							//*************************************//
							$currentRelationShip = self::getCurrentRelationShip($rs, $searchFieldKeyRelationshipName);
	
							self::generateNativeRelationShipLeftJoin($sqlJoin, $sqlCountJoin, $sqlFilterTableIndex, $doJoin, $doCountJoin, $currentRelationShip, $field_values, $i, 'rhs_key', $keySearch, $auxTableName, $aux[1]);
							self::generateNativeRelationShipLeftJoin2($sqlJoin, $sqlCountJoin, $doJoin, $doCountJoin, $currentRelationShip, $report_table, 'lhs', 'rhs', $keySearch, $aux[0]);
	
						} else {
	
							//*************************************//
							//******Left To Right Relationship*****//
							//*************************************//
							$sql_relationships = "SELECT DISTINCT relationship_name, lhs_table, lhs_key, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs FROM relationships WHERE lhs_table='".$report_table."' AND rhs_table='".strtolower($auxTableName)."' AND lhs_key='".$fieldKey."'";
							$rs = $db->query($sql_relationships);
	
							if ($rs->num_rows > 0) {
									
								$currentRelationShip = self::getCurrentRelationShip($rs, $searchFieldKeyRelationshipName);
								self::generateNativeRelationShipLeftJoin($sqlJoin, $sqlCountJoin, $sqlFilterTableIndex,  $doJoin, $doCountJoin, $currentRelationShip, $field_values, $i, 'lhs_key', $keySearch, $auxTableName, $aux[1]);
								self::generateNativeRelationShipLeftJoin2($sqlJoin, $sqlCountJoin,  $doJoin, $doCountJoin, $currentRelationShip, $report_table, 'rhs', 'lhs', $keySearch, $aux[0]);
									
							} else {
									
								//*************************************//
								//******Fields MetaData Searching******//
								//*************************************//
								$sql_relationships = "SELECT DISTINCT relationship_name, name, type, ext2, ext3 FROM fields_meta_data WHERE custom_module='".$report_module."' AND type IN ('relate')";
								$rs = $db->query($sql_relationships);
	
								$currentRelationShip = self::getCurrentRelationShip($rs, $searchFieldKeyRelationshipName);
								self::generateMetadataLeftJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $currentRelationShip, $report_table);
									
							}
	
						}
	
						if ($isCustomTable) {
	
							//**********************************//
							//******Custom Table Left Join******//
							//**********************************//
							self::generateCustomTableLeftJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $sqlFilterTableIndex, $field_values, $i, $aux[0], $aux2, $searchFieldKey, $isLeftJoinedCustom, $auxTableName, $keySearch);
								
						} else if (!empty($sqlFilterTableIndex[$searchFieldKey.".".$field_values[$i][0]])) {
	
							//***********************************************//
							//******Override fieldName Value with Alias******//
							//***********************************************//
							$field_values[$i][0] = $aux[0].$sqlFilterTableIndex[$searchFieldKey.".".$field_values[$i][0]].".".$aux[1];
	
						}
	
					}
	
				} else { //Related field relationship
					
					if (count($aux) == 2) {
	
						//****************************************//
						//*****Variable Definition Iteration******//
						//****************************************//
						if ($isNonCrmDatabase) {
	
							$tmpField = explode(".", $field_values[$i][0]);
							$tmpKey = explode(" ", $field_values[$i][9]);
	
							$tableKey = $tmpKey[0];
							$relatedModule = $tmpField[0];
							$relatedTable = $relatedModule;
							$relatedKey = $tmpKey[1];
							
						} else {
	
							$class_name = $beanList[$report_module];
							require_once($beanFiles[$class_name]);
							$bean = new $class_name();
	
							$relatedInfo = Basic_wfm::getReportsRelatedFields($bean);
	
							$tmpField = explode(".", $fieldKey);
							$tmpField = (count($tmpField) == 2) ? $tmpField[1] : $fieldKey;
	
							$tableKey = $fieldKey;
							$relatedTable = "";
							$relatedModule = "";
							$relatedKey = "id";
	
							foreach ($relatedInfo as $info){
	
								if ($info['id_name'] == $tmpField){
	
									$relatedModule = $info['module'];
									$relatedTable = strtolower($relatedModule);
									break;
	
								}
	
							}
	
						}
	
							
						if (!empty($tableKey)) {
	
							if ($isCustomTable) { //Custom Table
	
								//****************************************//
								//*****Custom Table Relate Left Join******//
								//****************************************//
								self::generateCustomRelateTableLeftJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $sqlFilterTableIndex, $field_values, $i, $isLeftJoinedCustom, $aux[0], $aux2, $auxTableName, $keySearch, $tableKey, $report_table, $relatedKey, $relatedTable);
									
							} else { //Not Custom Table
	
								//****************************************//
								//*****Normal Table Relate Left Join******//
								//****************************************//
								self::generateRelateTableLeftJoin($sqlJoin, $sqlCountJoin, $doJoin, $doCountJoin, $sqlFilterTableIndex, $field_values, $i, $moduleCustomJoined, $moduleCountCustomJoined, $keySearch, $tableKey, $report_table, $relatedKey, $relatedTable);
	
							}
								
						} else if ($isCustomTable && (!$moduleCustomJoined || !$moduleCountCustomJoined)) { //Custom Table
	
							//***************************************//
							//*****Custom Main Module Left Join******//
							//***************************************//
							self::generateCustomJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $moduleCustomJoined, $moduleCountCustomJoined, $report_table);
	
						}
	
					}
	
				}
	
					
				//***************************************//
				//******Recalculate Control Arrays*******//
				//***************************************//
				$old_table_key = $auxTableName;
				$old_rhs_key = $searchFieldKey;
				$old_key_search = array_search($old_table_key."|".$old_rhs_key, $leftJoineds);
	
				if ($old_key_search === false) {
					$leftJoineds[$i] = $old_table_key."|".$old_rhs_key;
					$old_key_search = $i;
				}
	
				if ($doCountJoin)
				$leftCountJoineds[$i] = $old_table_key."|".$old_rhs_key;
	
				if ($isCustomTable)
				$isLeftJoinedCustom[$old_table_key."|".$old_rhs_key] = true;
	
	
			}
	
	
			//************************************************************//
			//****Reset Filter Values With Alias Defined on Left Joins****//
			//************************************************************//
			$filter_values = self::resetFilterValuesWithLeftJoinAlias($filter_values, $sqlFilterTableIndex);
	
	
	
			//**************************************//
			//****Define Returned Function Array****//
			//**************************************//
			$returnedLeftJoinArray = array (
				"moduleCustomJoined" => $moduleCustomJoined,
				"leftJoineds" => $leftJoineds,
				"querys" => array (
					"CountJoin" => $sqlCountJoin,
					"Join" => $sqlJoin,
				),
			);
	
		}
	
		return $returnedLeftJoinArray;
	
	}
	
	static public function getCurrentRelationShip($rs, $searchFieldKeyRelationshipName) {
	
		global $db;
	
		while ($rel = $db->fetchByAssoc($rs)) {
			$currentRelationShip = $rel;
			if ($currentRelationShip['relationship_name'] == $searchFieldKeyRelationshipName)
			break;
		}
	
		return $currentRelationShip;
	
	}
	
	static public function manageAuditSqlJoin(& $field_values, & $filter_values, $report_table) {
			
		$sqlJoin = " LEFT JOIN ".$report_table." ON ".$report_table."_audit.parent_id=".$report_table.".id ";
		$sqlCountJoin = "";
		$moduleCustomJoined = false;
		$created_by_leftjoin = false;
	
		for ($i=0; $i<count($field_values); $i++) {
				
			if (!empty($field_values[$i][9])) {
	
				if (($field_values[$i][9] == 'created_by') && (!$created_by_leftjoin)) {
					$sqlJoin .= " LEFT JOIN users ON ".$report_table."_audit.created_by=users.id ";
					$created_by_leftjoin = true;
				}
	
			}
				
			$field_values[$i][0] = (count(explode(".", $field_values[$i][0])) > 1) ? $field_values[$i][0] : $report_table."_audit.".$field_values[$i][0];
				
		}
	
		$x = 0;
		foreach($filter_values as $one_filter) {
	
			$fieldFilter = explode(".", $filter_values[$x][0]);
			$filter_values[$x][0] = (count($fieldFilter) > 1) ? $filter_values[$x][0] : $report_table."_audit.".$filter_values[$x][0];
	
			$x++;
	
		}
	
		$sqlCountJoin = $sqlJoin;
	
		return array (
			"moduleCustomJoined" => $moduleCustomJoined,
			"leftJoineds" => array(),
			"querys" => array (
				"CountJoin" => $sqlCountJoin,
				"Join" => $sqlJoin,
		),
		);
	
	}
	
	static public function generateNativeRelationShipLeftJoin(& $sqlJoin, & $sqlCountJoin, & $sqlFilterTableIndex, $doJoin, $doCountJoin, $currentRelationShip, & $field_values, $i, $keySide, $keyAliasSearch, $moduleName, $fieldName) {
			
		if (!empty($currentRelationShip['join_table'])) {
	
			if ($doJoin)
			$sqlJoin .= " LEFT JOIN ".$currentRelationShip['join_table']." ".$currentRelationShip['join_table'].$keyAliasSearch." ON ";
	
			if ($doCountJoin)
			$sqlCountJoin .= " LEFT JOIN ".$currentRelationShip['join_table']." ".$currentRelationShip['join_table'].$keyAliasSearch." ON ";
	
			//Modificamos el nombre del campo para los siguientes usos
			$sqlFilterTableIndex[$currentRelationShip[$keySide].".".$field_values[$i][0]] = $keyAliasSearch;
			$field_values[$i][0] = $moduleName.$keyAliasSearch.".".$fieldName;
	
		} else {
	
			if ($doJoin)
			$sqlJoin .= " LEFT JOIN ".strtolower($moduleName)." ".strtolower($moduleName).$keyAliasSearch." ON ";
	
			if ($doCountJoin)
			$sqlCountJoin .= " LEFT JOIN ".strtolower($moduleName)." ".strtolower($moduleName).$keyAliasSearch." ON ";
	
			//Modificamos el nombre del campo para los siguientes usos
			$sqlFilterTableIndex[$currentRelationShip[$keySide].".".$field_values[$i][0]] = $keyAliasSearch;
			$field_values[$i][0] = $moduleName.$keyAliasSearch.".".$fieldName;
	
		}
	
	}
	
	static public function generateNativeRelationShipLeftJoin2(& $sqlJoin, & $sqlCountJoin, $doJoin, $doCountJoin, $currentRelationShip, $report_table, $leftSide, $rightSide, $keyAliasSearch, $moduleName) {
			
		if ($currentRelationShip['join_table'] != "") {
	
			//Mirar la relacion con la tabla intermedia
			if ($doJoin) {
	
				$sqlJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip['join_table'].$keyAliasSearch.".".$currentRelationShip['join_key_'.$rightSide]." AND ".$currentRelationShip['join_table'].$keyAliasSearch.".deleted=0) ";
				$sqlJoin .= " LEFT JOIN ".$currentRelationShip[$leftSide.'_table']." ".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch." ON (".$currentRelationShip['join_table'].$keyAliasSearch.".".$currentRelationShip['join_key_'.$leftSide]."=";
				$sqlJoin .= $currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".deleted=0) ";
	
			}
	
			if ($doCountJoin) {
	
				$sqlCountJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip['join_table'].$keyAliasSearch.".".$currentRelationShip['join_key_'.$rightSide]." AND ".$currentRelationShip['join_table'].$keyAliasSearch.".deleted=0) ";
				$sqlCountJoin .= " LEFT JOIN ".$currentRelationShip[$leftSide.'_table']." ".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch." ON (".$currentRelationShip['join_table'].$keyAliasSearch.".".$currentRelationShip['join_key_'.$leftSide]."=";
				$sqlCountJoin .= $currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".deleted=0) ";
	
			}
	
		} else {
	
			//Hacer vinculacion directamente
			if ($doJoin) {
	
				if ($report_table != strtolower($moduleName))
				$sqlJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$rightSide.'_table'].".deleted=0) ";
				else
				$sqlJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$rightSide.'_table'].".deleted=0) ";
	
			}
				
			if ($doCountJoin) {
	
				if ($report_table != strtolower($moduleName))
				$sqlCountJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$rightSide.'_table'].".deleted=0) ";
				else
				$sqlCountJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$rightSide.'_table'].".deleted=0) ";
	
			}
				
		}
	
	}
		
	static public function resetFilterValuesWithLeftJoinAlias($filter_values, $sqlFilterTableIndex) {
			
		$x = 0;
	
		foreach($filter_values as $one_filter) {
	
			$fieldFilter = explode(".", $one_filter[0]);
			$keyFilter = explode(" ", $one_filter[5]);
	
			$filter_values[$x][0] = (count($fieldFilter) > 1) ? $fieldFilter[0].$sqlFilterTableIndex[$keyFilter[0].".".$one_filter[0]].".".$fieldFilter[1] : $one_filter[0];
	
			$x++;
	
		}
	
		return $filter_values;
	
	}
	
	static public function fieldHasFilter($filter_values, $field, $fieldArray, $searchFieldKey) {
	
		$fieldHasFilter = false;
		foreach ($filter_values as $key=>$filter) {
	
			//If related AND input name and key are the same
			if ((count($fieldArray) >= 2) && (($filter[0] == $field[0]) && ($filter[5] == $searchFieldKey))) {
	
				$fieldHasFilter = true;
				break;
	
			}
	
		}
	
		return $fieldHasFilter;
	
	}
	
	static public function generateMetadataLeftJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, $currentRelationShip, $report_table) {
	
		$sqlJoin .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".id=".$report_table."_cstm.id_c LEFT JOIN ".strtolower($currentRelationShip['ext2'])." ON ".$report_table."_cstm.".$currentRelationShip['ext3']."=".strtolower($currentRelationShip['ext2']).".id";
	
		if ($doCountJoin)
		$sqlCountJoin .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".id=".$report_table."_cstm.id_c LEFT JOIN ".strtolower($currentRelationShip['ext2'])." ON ".$report_table."_cstm.".$currentRelationShip['ext3']."=".strtolower($currentRelationShip['ext2']).".id";
	
	}
	
	static public function generateCustomTableLeftJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, & $sqlFilterTableIndex, & $field_values, $i, $auxCustomTableName, $aux2, $searchFieldKey, $isLeftJoinedCustom, $auxTableName, $keySearch) {
	
		$myIndex = "";
		$emptyIndex = true;
	
		foreach ($sqlFilterTableIndex as $key=>$tableIndex) {
				
			$auxKey = explode(".", $key);
			$myIndex = $tableIndex;
	
			if ($auxKey[1] == $auxCustomTableName) {
				$emptyIndex = false;
				break;
			}
				
		}
	
	
		$doJoin = true;
		$n = 0;
		foreach ($sqlFilterTableIndex as $key=>$tableIndex) {
				
			$auxKey = explode(".", $key);
				
			if (($auxKey[0] == $searchFieldKey) && ($auxKey[1] == $auxCustomTableName)) {
	
				$n++;
	
				if ($n >= 2) {
					$doJoin = false;
					break;
				}
	
			}
				
		}
	
	
		if ($emptyIndex) {
			$sqlFilterTableIndex[$field_values[$i][9].".".implode('_', array_slice($aux2, 0, count($aux2)-1))] = $myIndex;
		}
	
		if ($doJoin)
		$sqlJoin .= " LEFT JOIN ".$auxCustomTableName." ".$auxCustomTableName.$myIndex." ON ".$auxCustomTableName.$myIndex.".id_c=".implode('_', array_slice($aux2, 0, count($aux2)-1)).$myIndex.".id ";
	
		if ($doCountJoin || (!$isLeftJoinedCustom[$auxTableName."|".$searchFieldKey]))
		$sqlCountJoin .= " LEFT JOIN ".$auxCustomTableName." ".$auxCustomTableName.$myIndex." ON ".$auxCustomTableName.$myIndex.".id_c=".implode('_', array_slice($aux2, 0, count($aux2)-1)).$myIndex.".id ";
	
	
		$sqlFilterTableIndex[$searchFieldKey.".".$auxTableName] = $keySearch;
		$auxField = explode(".", $field_values[$i][0]);
		$field_values[$i][0] = $auxCustomTableName.$myIndex.".".$auxField[1];
	
	}
	
	static public function generateCustomRelateTableLeftJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, & $sqlFilterTableIndex, & $field_values, $i, $isLeftJoinedCustom, $aux0, $aux2, $auxTableName, $myIndex, $tableKey, $report_table, $relatedKey, $relatedTable) {
	
		if (empty($sqlJoin))
			$sqlJoin .= " LEFT JOIN ".$relatedTable." ".$relatedTable.$myIndex." ON ".$report_table.".".$tableKey."=".$relatedTable.$myIndex.".".$relatedKey." ";
	
		if (($doCountJoin) && (empty($sqlCountJoin)))
			$sqlCountJoin .= " LEFT JOIN ".$relatedTable." ".$relatedTable.$myIndex." ON ".$report_table.".".$tableKey."=".$relatedTable.$myIndex.".".$relatedKey." ";
	
		if (!$isLeftJoinedCustom[$auxTableName."|".$tableKey])
			$sqlJoin .= " LEFT JOIN ".$aux0." ".$aux0.$myIndex." ON ".$aux0.$myIndex.".id_c=".implode('_', array_slice($aux2, 0, count($aux2)-1)).$myIndex.".".$relatedKey." ";
	
		if ($doCountJoin)
			$sqlCountJoin .= " LEFT JOIN ".$aux0." ".$aux0.$myIndex." ON ".$aux0.$myIndex.".id_c=".implode('_', array_slice($aux2, 0, count($aux2)-1)).$myIndex.".".$relatedKey." ";
	
		$sqlFilterTableIndex[$tableKey.".".$field_values[$i][0]] = $myIndex;
		$auxField = explode(".", $field_values[$i][0]);
		$field_values[$i][0] = $aux0.$myIndex.".".$auxField[1];
	
	}

	static public function generateRelateTableLeftJoin(& $sqlJoin, & $sqlCountJoin, $doJoin, $doCountJoin, & $sqlFilterTableIndex, & $field_values, $i, & $moduleCustomJoined, & $moduleCountCustomJoined, $myIndex, $tableKey, $report_table, $relatedKey, $relatedTable) {
	
		$tmpField = explode(".", $tableKey);
		$realField = (count($tmpField) == 2) ? $tableKey : $report_table.".".$tableKey;
	
		if ($doJoin) {
	
			//Check if relates to custom table of report module table
			if (count($tmpField) == 2) {
				$explodedTmpTable = explode("_", $tmpField[0]);
	
				if ((($explodedTmpTable[1] == 'cstm') && ($explodedTmpTable[0] == $report_table)) && !$moduleCustomJoined) {
					$sqlJoin .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".".$relatedKey."=".$report_table."_cstm.id_c ";
	
					if ($doCountJoin) {
						$sqlCountJoin .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".".$relatedKey."=".$report_table."_cstm.id_c ";
						$moduleCountCustomJoined = true;
					}
						
					$moduleCustomJoined = true;
				}
			}
	
		}
			
		if ($doJoin)
		$sqlJoin .= " LEFT JOIN ".$relatedTable." ".$relatedTable.$myIndex." ON ".$realField."=".$relatedTable.$myIndex.".".$relatedKey." ";
	
		if ($doCountJoin)
		$sqlCountJoin .= " LEFT JOIN ".$relatedTable." ".$relatedTable.$myIndex." ON ".$realField."=".$relatedTable.$myIndex.".".$relatedKey." ";
			
	
		$sqlFilterTableIndex[$tableKey.".".$field_values[$i][0]] = $myIndex;
		$auxField = explode(".", $field_values[$i][0]);
		$field_values[$i][0] = $relatedTable.$myIndex.".".$auxField[1];
	
	}
	
	static public function generateCustomJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, & $moduleCustomJoined, & $moduleCountCustomJoined, $report_table) {
			
		$tableKey = "id_c";
		$relatedTable = $report_table."_cstm";
	
		if (empty($sqlJoin) && !$moduleCustomJoined) {
			$sqlJoin .= " LEFT JOIN ".$relatedTable." ON ".$report_table.".id=".$relatedTable.".id_c ";
			$moduleCustomJoined = true;
		}
			
		if ($doCountJoin && empty($sqlCountJoin) && !$moduleCountCustomJoined) {
			$sqlCountJoin .= " LEFT JOIN ".$relatedTable." ON ".$report_table.".id=".$relatedTable.".id_c ";
			$moduleCountCustomJoined = true;
		}
	
		
	
	}
	
	static public function updateMySqlFunctionField($myFunction, $reportTable, $aggregatedFunction, & $selectedField) {
		
		$fieldFunctionSelfReference = explode('${this}', $myFunction);
		
		if ($aggregatedFunction == null) {
		
			if (count($fieldFunctionSelfReference) <= 1) {
								
				$selectedField = "(".$reportTable.$selectedField.")".$myFunction;
				
			} else {
					
				$selectedField = "(".implode($reportTable.$selectedField, $fieldFunctionSelfReference).")";
					
			}
			
		} else {
	
			if (count($fieldFunctionSelfReference) <= 1) {
		
				$selectedField = $selectedField;
			
			} else {
				
				$selectedField = implode($aggregatedFunction."(".$reportTable.$selectedField.")", $fieldFunctionSelfReference);
		
			}
		
		}
		
		return (count($fieldFunctionSelfReference) <= 1);
		
	}
	
	
	static public function getSqlSelectQuery(& $field_values, & $chartInfo, $report_table, $audited_report, $leftJoineds = array()) {

		//OBTENEMOS LA CAUSULA "SELECT" con sus ALIAS
		$sqlSelect = "SELECT ";
		$columns = Array();
		$count_fields = 0;
	
		$hasGrouped = false;
		$hasFunctionWithSQL = false;
		$groupSubTotalField = null;
		$groupSubTotalFieldAscSort = null;
	
		$custom_fields = false;
	
		$sqlTotals = "SELECT ";
		$sqlTotalsC = "SELECT ";
		$totals = Array();
		$count_totals = 0;
	
		//CREAR Y USAR SUBLISTA CON LOS CAMPOS QUE IR?N EN EL RESULSET UNICAMENTE
		$resulset_fields;
		$processed_chart_fields = array();
	
		$j=0;
	
		for ($i=0; $i<count($field_values); $i++){
	
			$functionValues = explode('${comma}', $field_values[$i][5]);
			$functionValues[1] = self::replace_reports_vars($functionValues[1], $report_table, $leftJoineds);
	
			if ($field_values[$i][6] == "Grouped")
			$hasGrouped = true;
				
			if (($functionValues[0] != "0") && (!empty($functionValues[1])))
			$hasFunctionWithSQL = true;
	
			if (!$audited_report)
				$table = ((count(explode(".", $field_values[$i][0]))) == 1 ) ? $report_table."." : "";
			else
				$table = ((count(explode(".", $field_values[$i][0]))) == 1 ) ? $report_table."_audit." : "";
				
	
			$tmpField = explode(".", $field_values[$i][0]);
	
			if ($tmpField[0] == $report_table."_cstm")
			$custom_fields = true;
	
	
			//Metemos lo campos que no tienen funcion asociada
			if (($functionValues[0] == "0") || ($functionValues[0] == "undefined")) { //Mostrar solo si display es Yes
	
				if (!empty($functionValues[1])) { //ASOL CALCULATED
	
					self::updateMySqlFunctionField($functionValues[1], $table, null, $field_values[$i][0]);
					if (strtolower($field_values[$i][2]) == "yes")
						$sqlSelect .= $field_values[$i][0]." AS '".$field_values[$i][1]."',";
						
				} else {
	
					if (strtolower($field_values[$i][2]) == "yes")
						$sqlSelect .= $table.$field_values[$i][0]." AS '".$field_values[$i][1]."',";
						
				}
					
				if (strtolower($field_values[$i][2]) == "yes") {
						
					$columns[$count_fields] = $field_values[$i][1];
					$columnsO[$count_fields] = $field_values[$i][0];
	
					$count_fields++;
	
					$resulset_fields[$j] = $field_values[$i];
					$j++;
						
				}
	
			}
	
			$field_values[$i]['chartOriginalFieldName'] = $field_values[$i][0];
	
			//Metemos los campos que tienen una funcion asociada en un array que generar? una subtabla con los totales
			if (($functionValues[0] != "undefined") && ($functionValues[0] != "0")) { //Mostrar solo si display es Yes
	
	
				if ($groupSubTotalField == null) {
					$groupSubTotalField = $field_values[$i][1];
					$groupSubTotalFieldAscSort = $field_values[$i][3];
				}
	
					
				if (!empty($functionValues[1])) { //ASOL CALCULATED
	
					self::updateMySqlFunctionField($functionValues[1], $table, null, $field_values[$i][0]);
					if (strtolower($field_values[$i][2]) == "yes")
						$sqlTotals .= $field_values[$i][0]." AS '".$field_values[$i][1]."',";
	
				} else {
	
					$field_values[$i][0] = $functionValues[0]."(".$table.$field_values[$i][0].")";
					if (strtolower($field_values[$i][2]) == "yes")
						$sqlTotals .= $field_values[$i][0]." AS '".$field_values[$i][1]."',";
						
				}
					
				if (strtolower($field_values[$i][2]) == "yes") {
						
					$totals[$count_totals] = $field_values[$i];
					$count_totals++;
						
				}
	
			}
	
			//Check if chart is displayable on Charts Div
			$chartDisplayable = false;
			$chartAlias = $field_values[$i][1];
	
	
			//Check if duplicated field has already proccesed
			foreach ($chartInfo as $cKey=>$cInfo) {
	
				if ($audited_report)
					$cInfo[0] = (count(explode(".", $cInfo[0])) > 1) ? $cInfo[0] : $report_table."_audit.".$cInfo[0];
	
				if (in_array($cKey, $processed_chart_fields))
					continue;
	
				if (($functionValues[0] != '0') && ($field_values[$i]['chartOriginalFieldName'] == $cInfo[0]) && ($cInfo[3] == 'yes')) {
					$chartDisplayable = true;
					$chartAlias = $cInfo[1];
					$processed_chart_fields[] = $cKey;
					break;
				}
	
			}
	
			if ($chartDisplayable) {
	
				if (!empty($functionValues[1])) { //ASOL CALCULATED
	
					if (self::updateMySqlFunctionField($functionValues[1], $table, $functionValues[0], $field_values[$i]['chartOriginalFieldName']))
						$sqlTotalsC .= $field_values[$i][0]." AS '".$chartAlias."',";
					else
						$sqlTotalsC .= $field_values[$i]['chartOriginalFieldName']." AS '".$chartAlias."',";
	
				} else {
	
					$sqlTotalsC .= $field_values[$i][0]." AS '".$chartAlias."',";
						
				}
	
			}
			//Check if chart is displayable on Charts Div
				
	
		}
	
		if ($hasGrouped) {
	
			if ($count_totals > 0) {
				$sqlSelect = $sqlSelect." ".substr($sqlTotals, 6);
			} else {
				//$sqlSelect = $sqlSelect." COUNT(".$report_table.".*) AS 'TOTAL',";
				$sqlSelect = $sqlSelect." COUNT(*) AS 'TOTAL',";
			}
		}
	
		$tmpChartInfo = Array();
	
		foreach ($chartInfo as $cInfo) {
	
			if ($cInfo[3] == 'yes')
			$tmpChartInfo[] = $cInfo;
	
		}
	
		$chartInfo = $tmpChartInfo;
	
		$sqlTotalsC = substr($sqlTotalsC, 0, -1);
		//CREAR Y USAR SUBLISTA CON LOS CAMPOS QUE IR?N EN EL RESULSET UNICAMENTE
	
		//Comprobar antes de hacer las querys que estos strings tienen mas de las 6 letras de "SELECT "
	
		$sqlSelect = substr($sqlSelect, 0, -1);
		$sqlTotals = substr($sqlTotals, 0, -1);
	
	
		$returnedArray = Array (
			"customFields" => $custom_fields,
			"columns" => $columns,
			"columnsO" => $columnsO,
			"groupSubTotalField" => $groupSubTotalField,
			"groupSubTotalFieldAscSort" => $groupSubTotalFieldAscSort,
			"hasGrouped" => $hasGrouped,
			"hasFunctionWithSQL" => $hasFunctionWithSQL,
			"totals" => $totals,
			"resultsetFields" => $resulset_fields,
			"querys" => Array (
				"Select" => $sqlSelect,
				"Totals" => $sqlTotals,
				"Charts" => $sqlTotalsC,
			),
		);
	
		return $returnedArray;
	
	}
	
	
	static public function getSqlFromQuery($report_table, $custom_fields, $moduleCustomJoined, $audited_report) {
	
		$sqlFrom = (!$audited_report) ? " FROM ".$report_table : " FROM ".$report_table."_audit";
	
		//añadimos un left join para los custom fields no related
		if (($custom_fields == "true") && (!$moduleCustomJoined))
		$sqlFrom .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".id=".$report_table."_cstm.id_c ";
	
		return $sqlFrom;
	
	}
	
	
	static public function getSqlWhereQuery($filter_values, $field_values, $report_table, $userTZ, $quarter_month, $week_start, $isNonCrmDatabase, $escapeTokensFilters) {
		
		
		//Set default timezone for php date/datetime functions
		date_default_timezone_set($userTZ);
	
		if ($filter_values[0][0] == "")
			$filter_values = array();
	
		if (!$isNonCrmDatabase)
			$sqlWhere = " WHERE ".$report_table.".deleted = 0 AND ";
		else
			$sqlWhere = (count($filter_values) != 0) ? " WHERE " : "";
	
	
		if ($filter_values[0][0] != "") {
	
			$phpDateTime = new DateTime(null, new DateTimeZone($userTZ));
			$hourOffset = $phpDateTime->getOffset()*-1;
	
			$sqlWhere .= "( ";
			
			for ($i=0; $i<count($filter_values); $i++) {
	
				
				self::modifyFilteringValues($filter_values, $i, $quarter_month, $week_start, $report_table, $hourOffset, $operator1, $operator2);

				self::generateSqlWhere($filter_values, $i, $field_values, $operator1, $operator2, $sqlWhere, $escapeTokensFilters);
				
				
			}
	
			$sqlWhere = substr($sqlWhere, 0, -4)." )";
			
		} else {
			
			$sqlWhere = substr($sqlWhere, 0, -4);
			
		}
		
			
		return $sqlWhere;
	
	}
	
	static public function modifyFilteringValues(& $filter_values, $i, $quarter_month, $week_start, $report_table, $hourOffset, & $operator1, & $operator2) {
	
		global $timedate;
		
		//Añadir tabla y . si campos son de la tabla principal
		$filter_values[$i][0] = ((count(explode(".", $filter_values[$i][0]))) == 1 ) ? $report_table.".".$filter_values[$i][0] : $filter_values[$i][0];
		//Añadir tabla y . si campos son de la tabla principal
		
		$operator1 = ($filter_values[$i][1] == "equals") ? "=" : "!=";
		$operator2 = "";
	
		//Escapamos la comilla simple para evitar conflictos
		$filter_values[$i][2] = preg_replace("/\\\\/", "\\", $filter_values[$i][2]);
		$filter_values[$i][2] = preg_replace("/&#039;/", "'", $filter_values[$i][2]);
	
	
		if ($filter_values[$i][1] == 'theese')
			$filter_values[$i][1] = 'these';
			
		//If timestamp do not apply TimeZone OffSet
		if (in_array($filter_values[$i][4], array("date", "timestamp")))
			$hourOffset = 0;
			
		switch ($filter_values[$i][1]) {
	
			case "equals":
			case "not equals":
				
				if (in_array($filter_values[$i][4], array("date", "datetime", "timestamp"))) {
	
					switch ($filter_values[$i][2]) {
						
						case "calendar":
	
							$operator1 = ($filter_values[$i][1] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$filter_values[$i][2] = $filter_values[$i][3];
							
							$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
	
						case "dayofweek":
	
							$operator1 = ($filter_values[$i][1] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter_values[$i][2] = $filter_values[$i][3];
							
							$whereFunction = 'WEEKDAY(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "weekofyear":
	
							$operator1 = ($filter_values[$i][1] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$filter_values[$i][2] = $filter_values[$i][3];
							$weekStartsOn = ($week_start == '0') ? 2 : 7;
							$whereFunction = 'WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.')';
							break;
							
						case "monthofyear":
	
							$operator1 = ($filter_values[$i][1] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter_values[$i][2] = $filter_values[$i][3];
							
							$whereFunction = 'MONTH(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "naturalquarterofyear":
	
							$operator1 = ($filter_values[$i][1] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter_values[$i][2] = $filter_values[$i][3];
							
							$whereFunction = 'QUARTER(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "fiscalquarterofyear":
							
							$operator1 = ($filter_values[$i][1] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter_values[$i][2] = $filter_values[$i][3];
							
							$fiscalQuarterMonths = wfm_reports_utils::getQuarterMonthsArray(true, $quarter_month);
							$whereFunction = 'CASE WHEN MONTH(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)) IN ('.$fiscalQuarterMonths[0].', '.$fiscalQuarterMonths[1].', '.$fiscalQuarterMonths[2].') THEN 1 WHEN MONTH(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)) IN ('.$fiscalQuarterMonths[3].', '.$fiscalQuarterMonths[4].', '.$fiscalQuarterMonths[5].') THEN 2 WHEN MONTH(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)) IN ('.$fiscalQuarterMonths[6].', '.$fiscalQuarterMonths[7].', '.$fiscalQuarterMonths[8].') THEN 3 WHEN MONTH(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)) IN ('.$fiscalQuarterMonths[9].', '.$fiscalQuarterMonths[10].', '.$fiscalQuarterMonths[11].') THEN 4 END';
							break;
							
						case "naturalyear":
							
							$operator1 = ($filter_values[$i][1] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$filter_values[$i][2] = (!empty($filter_values[$i][3])) ? $filter_values[$i][3] : date("Y");
							$filter_values[$i][3] = "";
							
							$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "fiscalyear":
							
							$operator1 = ($filter_values[$i][1] == "equals") ? "BETWEEN" : "NOT BETWEEN";
							$operator2 = "AND";
							
							$fiscalQuarterMonths = wfm_reports_utils::getQuarterMonthsArray(true, $quarter_month);
							$fiscalQuarterYears = array();
							
							$filter_values[$i][3] = (!empty($filter_values[$i][3])) ? $filter_values[$i][3] : date("Y");
							
							$lastMonth = null;
							$addYear = false;
							foreach ($fiscalQuarterMonths as $fiscalQuarterMonth) {
								if (($fiscalQuarterMonth < $lastMonth) && ($lastMonth != null) && !$addYear)
									$addYear = true;
								$fiscalQuarterYears[] = ($addYear) ?  intval($filter_values[$i][3])+1 : $filter_values[$i][3];
								$lastMonth = $fiscalQuarterMonth;
							}
							
							$filter_values[$i][2] = (strlen($fiscalQuarterMonths[0]) == 1) ? $fiscalQuarterYears[0].'0'.$fiscalQuarterMonths[0] : $fiscalQuarterYears[0].$fiscalQuarterMonths[0];
							$filter_values[$i][3] = (strlen($fiscalQuarterMonths[11]) == 1) ? $fiscalQuarterYears[11].'0'.$fiscalQuarterMonths[11] : $fiscalQuarterYears[11].$fiscalQuarterMonths[11];
					
							$whereFunction = 'EXTRACT(YEAR_MONTH FROM DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)))';
							break;
							
					}
					
					self::updateMySqlFunctionField($whereFunction, '', null, $filter_values[$i][0]);
	
				} else if (in_array($filter_values[$i][4], array("bool"))) {
					
					$filter_values[$i][2] = ($filter_values[$i][2] == "true") ? "1" : "0";
	
				}
					
				break;
	
			case "like":
			case "not like":
				$operator1 = ($filter_values[$i][1] == "like") ? "LIKE" : "NOT LIKE";
				$operator2 = "";
				$filter_values[$i][2] = "%".$filter_values[$i][2]."%";
				break;
	
			case "after date":
			case "before date":
				
				switch ($filter_values[$i][2]) {
					
					case "calendar":
						$operator1 = ($filter_values[$i][1] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$filter_values[$i][2] = $filter_values[$i][3];
							
						$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
					
					case "weekofyear":
	
						$operator1 = ($filter_values[$i][1] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$filter_values[$i][2] = $filter_values[$i][3];
						$weekStartsOn = ($week_start == '0') ? 2 : 7;
						$whereFunction = 'WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.')';
						break;
						
					case "naturalyear":
							
						$operator1 = ($filter_values[$i][1] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$filter_values[$i][2] = (!empty($filter_values[$i][3])) ? $filter_values[$i][3] : date("Y");
						$filter_values[$i][3] = "";
						
						$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
							
					case "fiscalyear":
							
						$operator1 = ($filter_values[$i][1] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$fiscalQuarterMonths = wfm_reports_utils::getQuarterMonthsArray(true, $quarter_month);
						$fiscalQuarterYears = array();
						
						$filter_values[$i][3] = (!empty($filter_values[$i][3])) ? $filter_values[$i][3] : date("Y");
						
						$lastMonth = null;
						$addYear = false;
						foreach ($fiscalQuarterMonths as $fiscalQuarterMonth) {
							if (($fiscalQuarterMonth < $lastMonth) && ($lastMonth != null) && !$addYear)
								$addYear = true;
							$fiscalQuarterYears[] = ($addYear) ?  intval($filter_values[$i][3])+1 : $filter_values[$i][3];
							$lastMonth = $fiscalQuarterMonth;
						}
						
						if ($filter_values[$i][1] == "after date")
							$filter_values[$i][2] = (strlen($fiscalQuarterMonths[11]) == 1) ? $fiscalQuarterYears[11].'0'.$fiscalQuarterMonths[11] : $fiscalQuarterYears[11].$fiscalQuarterMonths[11];
						else 
							$filter_values[$i][2] = (strlen($fiscalQuarterMonths[0]) == 1) ? $fiscalQuarterYears[0].'0'.$fiscalQuarterMonths[0] : $fiscalQuarterYears[0].$fiscalQuarterMonths[0];
						$filter_values[$i][3] = "";
				
						$whereFunction = 'EXTRACT(YEAR_MONTH FROM DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)))';
						break;
						
				}
				
				self::updateMySqlFunctionField($whereFunction, '', null, $filter_values[$i][0]);
	
				break;
		
			case "more than":
				$operator1 = ">";
				$operator2 = "";
	
				if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
					$date1 = explode("-", $filter_values[$i][2]);
					$filter_values[$i][2] = date("Y-m-d H:59:59", @mktime(0,59,59,$date1[1],$date1[2],$date1[0])+(24*3600)-(3600)+$hourOffset);
				}
	
				break;
	
			case "less than":
				$operator1 = "<";
				$operator2 = "";
	
				if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
					$date1 = explode("-", $filter_values[$i][2]);
					$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$date1[1],$date1[2],$date1[0])+$hourOffset);
				}
	
				break;
	
			case "between":
			case "not between":
				$operator1 = ($filter_values[$i][1] == "between") ? "BETWEEN" : "NOT BETWEEN";
				$operator2 = "AND";
				
				switch ($filter_values[$i][2]) {
					
					case "calendar":
						
						$splittedValues = explode('${comma}', $filter_values[$i][3]);
						
						$filter_values[$i][2] = $splittedValues[0];
						$filter_values[$i][3] = $splittedValues[1];
						
						if((!$timedate->check_matching_format($filter_values[$i][2], $GLOBALS['timedate']->dbDayFormat)) && ($filter_values[$i][2] != ""))
							$filter_values[$i][2] = $timedate->swap_formats($filter_values[$i][2], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
						
						if((!$timedate->check_matching_format($filter_values[$i][3], $GLOBALS['timedate']->dbDayFormat)) && ($filter_values[$i][3] != ""))
							$filter_values[$i][3] = $timedate->swap_formats($filter_values[$i][3], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
						
						$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
						
						
					case "weekofyear":
						
						$splittedValues = explode('${comma}', $filter_values[$i][3]);
						
						$filter_values[$i][2] = $splittedValues[0];
						$filter_values[$i][3] = $splittedValues[1];
						
						$weekStartsOn = ($week_start == '0') ? 2 : 7;
						$whereFunction = 'WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.')';
						break;
						
					case "naturalyear":
							
						$splittedValues = explode('${comma}', $filter_values[$i][3]);
						
						$filter_values[$i][2] = (!empty($splittedValues[0])) ? $splittedValues[0] : date("Y");
						$filter_values[$i][3] = (!empty($splittedValues[1])) ? $splittedValues[1] : date("Y");
						
						$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
						
					case "fiscalyear":
						
						$splittedValues = explode('${comma}', $filter_values[$i][3]);
						
						$fiscalQuarterMonths = wfm_reports_utils::getQuarterMonthsArray(true, $quarter_month);
						$fiscalQuarterYears = array();
						
						$filter_values[$i][2] = (!empty($splittedValues[0])) ? $splittedValues[0] : date("Y");
						$filter_values[$i][3] = (!empty($splittedValues[1])) ? $splittedValues[1] : date("Y");
						
						$lastMonth = null;
						$addYear = false;
						foreach ($fiscalQuarterMonths as $fiscalQuarterMonth) {
							if (($fiscalQuarterMonth < $lastMonth) && ($lastMonth != null) && !$addYear)
								$addYear = true;
							$fiscalQuarterYears1[] = ($addYear) ?  intval($filter_values[$i][2])+1 : $filter_values[$i][2];
							$fiscalQuarterYears2[] = ($addYear) ?  intval($filter_values[$i][3])+1 : $filter_values[$i][3];
							$lastMonth = $fiscalQuarterMonth;
						}
						
						$filter_values[$i][2] = (strlen($fiscalQuarterMonths[0]) == 1) ? $fiscalQuarterYears1[0].'0'.$fiscalQuarterMonths[0] : $fiscalQuarterYears1[0].$fiscalQuarterMonths[0];
						$filter_values[$i][3] = (strlen($fiscalQuarterMonths[11]) == 1) ? $fiscalQuarterYears2[11].'0'.$fiscalQuarterMonths[11] : $fiscalQuarterYears2[11].$fiscalQuarterMonths[11];
				
						$whereFunction = 'EXTRACT(YEAR_MONTH FROM DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)))';
						break;
					
				}
				
				self::updateMySqlFunctionField($whereFunction, '', null, $filter_values[$i][0]);
	
				break;
	
			case "one of":
			case "not one of":
				$operator1 = ($filter_values[$i][1] == "one of") ? "IN" : "NOT IN";
				$operator2 = "";
				break;
	
			case "last":
				switch ($filter_values[$i][2]) {
	
					case "day":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(($filter_values[$i][3])*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()-(24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", time()-($filter_values[$i][3])*24*3600);
							$filter_values[$i][3] = date("Y-m-d", time()-(24*3600));
						}
						break;
	
					case "week":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter_values[$i][3]-1)*7*24*3600))-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))-7)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter_values[$i][3]-1)*7*24*3600)));
							$filter_values[$i][3] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))-7)*24*3600);
						}
						break;
	
					case "month":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$monthsDate = @mktime(0,0,0,date("m")-($filter_values[$i][3]),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $monthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()-($diaMes+1)*24*3600+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $monthsDate);
							$filter_values[$i][3] = date("Y-m-d", time()-($diaMes+1)*24*3600);
						}
						break;
	
					case "Fquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")-$filter_values[$i][3])+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")-$filter_values[$i][3]));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")-($filter_values[$i][3]))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")-1)+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")-($filter_values[$i][3])));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")-1));
						}
						break;
	
	
					case "monday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last monday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last monday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last monday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last monday'));
						}
						break;
	
					case "tuesday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last tuesday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last tuesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last tuesday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last tuesday'));
						}
						break;
	
					case "wednesday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last wednesday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last wednesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last wednesday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last wednesday'));
						}
						break;
	
					case "thursday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last thursday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last thursday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last thursday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last thursday'));
						}
						break;
	
					case "friday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last friday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last friday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last friday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last friday'));
						}
						break;
	
					case "saturday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last saturday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last saturday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last saturday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last saturday'));
						}
						break;
	
					case "sunday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last sunday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last sunday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last sunday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last sunday'));
						}
						break;
	
					case "january":
						if (date("n") > 1)
							$monthNumber = date("n")-1;
						else if (date("n") == 1)
							$monthNumber = 12;
						else
							$monthNumber = 12-(1-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "february":
						if (date("n") > 2)
							$monthNumber = date("n")-2;
						else if (date("n") == 2)
							$monthNumber = 12;
						else
							$monthNumber = 12-(2-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "march":
						if (date("n") > 3)
							$monthNumber = date("n")-3;
						else if (date("n") == 3)
							$monthNumber = 12;
						else
							$monthNumber = 12-(3-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "april":
						if (date("n") > 4)
							$monthNumber = date("n")-4;
						else if (date("n") == 4)
							$monthNumber = 12;
						else
							$monthNumber = 12-(4-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "may":
						if (date("n") > 5)
							$monthNumber = date("n")-5;
						else if (date("n") == 5)
							$monthNumber = 12;
						else
							$monthNumber = 12-(5-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "june":
						if (date("n") > 6)
							$monthNumber = date("n")-6;
						else if (date("n") == 6)
							$monthNumber = 12;
						else
							$monthNumber = 12-(6-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "july":
						if (date("n") > 7)
							$monthNumber = date("n")-7;
						else if (date("n") == 7)
							$monthNumber = 12;
						else
							$monthNumber = 12-(7-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "august":
						if (date("n") > 8)
							$monthNumber = date("n")-8;
						else if (date("n") == 8)
							$monthNumber = 12;
						else
							$monthNumber = 12-(8-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "september":
						if (date("n") > 9)
							$monthNumber = date("n")-9;
						else if (date("n") == 9)
							$monthNumber = 12;
						else
							$monthNumber = 12-(9-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "october":
						if (date("n") > 10)
							$monthNumber = date("n")-10;
						else if (date("n") == 10)
							$monthNumber = 12;
						else
							$monthNumber = 12-(10-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "november":
						if (date("n") > 11)
							$monthNumber = date("n")-11;
						else if (date("n") == 11)
							$monthNumber = 12;
						else
							$monthNumber = 12-(11-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "december":
						if (date("n") > 12)
							$monthNumber = date("n")-12;
						else if (date("n") == 12)
							$monthNumber = 12;
						else
							$monthNumber = 12-(12-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "not last":
				switch ($filter_values[$i][2]){
	
					case "day":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(($filter_values[$i][3])*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()-(24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", time()-($filter_values[$i][3])*24*3600);
							$filter_values[$i][3] = date("Y-m-d", time()-(24*3600));
						}
						break;
	
					case "week":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter_values[$i][3]-1)*7*24*3600))-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))-7)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter_values[$i][3]-1)*7*24*3600)));
							$filter_values[$i][3] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))-7)*24*3600);
						}
						break;
	
					case "month":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$monthsDate = @mktime(0,0,0,date("m")-($filter_values[$i][3]),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $monthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()-($diaMes+1)*24*3600+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $monthsDate);
							$filter_values[$i][3] = date("Y-m-d", time()-($diaMes+1)*24*3600);
						}
						break;
	
					case "Fquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")-$filter_values[$i][3])+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")-$filter_values[$i][3]));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")-($filter_values[$i][3]))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")-1)+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")-($filter_values[$i][3])));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")-1));
						}
						break;
	
	
					case "monday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last monday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last monday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last monday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last monday'));
						}
						break;
	
					case "tuesday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last tuesday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last tuesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last tuesday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last tuesday'));
						}
						break;
	
					case "wednesday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last wednesday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last wednesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last wednesday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last wednesday'));
						}
						break;
	
					case "thursday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last thursday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last thursday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last thursday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last thursday'));
						}
						break;
	
					case "friday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last friday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last friday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last friday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last friday'));
						}
						break;
	
					case "saturday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last saturday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last saturday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last saturday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last saturday'));
						}
						break;
	
					case "sunday":
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date('Y-m-d H:00:00', strtotime('last sunday')+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", strtotime('last sunday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date('Y-m-d', strtotime('last sunday'));
							$filter_values[$i][3] = date("Y-m-d", strtotime('last sunday'));
						}
						break;
	
					case "january":
						if (date("n") > 1)
							$monthNumber = date("n")-1;
						else if (date("n") == 1)
							$monthNumber = 12;
						else
							$monthNumber = 12-(1-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "february":
						if (date("n") > 2)
							$monthNumber = date("n")-2;
						else if (date("n") == 2)
							$monthNumber = 12;
						else
							$monthNumber = 12-(2-(date("n")));
		
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "march":
						if (date("n") > 3)
							$monthNumber = date("n")-3;
						else if (date("n") == 3)
							$monthNumber = 12;
						else
							$monthNumber = 12-(3-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "april":
						if (date("n") > 4)
							$monthNumber = date("n")-4;
						else if (date("n") == 4)
							$monthNumber = 12;
						else
							$monthNumber = 12-(4-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "may":
						if (date("n") > 5)
							$monthNumber = date("n")-5;
						else if (date("n") == 5)
							$monthNumber = 12;
						else
							$monthNumber = 12-(5-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "june":
						if (date("n") > 6)
							$monthNumber = date("n")-6;
						else if (date("n") == 6)
							$monthNumber = 12;
						else
							$monthNumber = 12-(6-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "july":
						if (date("n") > 7)
							$monthNumber = date("n")-7;
						else if (date("n") == 7)
							$monthNumber = 12;
						else
							$monthNumber = 12-(7-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "august":
						if (date("n") > 8)
							$monthNumber = date("n")-8;
						else if (date("n") == 8)
							$monthNumber = 12;
						else
							$monthNumber = 12-(8-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "september":
						if (date("n") > 9)
							$monthNumber = date("n")-9;
						else if (date("n") == 9)
							$monthNumber = 12;
						else
							$monthNumber = 12-(9-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "october":
						if (date("n") > 10)
							$monthNumber = date("n")-10;
						else if (date("n") == 10)
							$monthNumber = 12;
						else
							$monthNumber = 12-(10-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "november":
						if (date("n") > 11)
							$monthNumber = date("n")-11;
						else if (date("n") == 11)
							$monthNumber = 12;
						else
							$monthNumber = 12-(11-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
					case "december":
						if (date("n") > 12)
							$monthNumber = date("n")-12;
						else if (date("n") == 12)
							$monthNumber = 12;
						else
							$monthNumber = 12-(12-(date("n")));
	
						$fistMonthsDate = @mktime(0,0,0,date("m")-($monthNumber),1,date("Y"));
						$lastMonthsDate = @mktime(0,0,0,date("m")-($monthNumber-1),1,date("Y"));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $fistMonthsDate);
							$filter_values[$i][3] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
	
				}
	
				$operator1 = "NOT BETWEEN";
				$operator2 = "AND";
				break;
	
			case "this":
				switch ($filter_values[$i][2]){
	
					case "day":
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d");
							$filter_values[$i][3] = date("Y-m-d");
						}
	
						break;
	
					case "week":
						$diaSemana = date("N", time()+$hourOffset)-1;
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(($diaSemana-($week_start-1))*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+((6-($diaSemana-($week_start-1)))*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()-(($diaSemana-($week_start-1))*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))*24*3600));
						}
						break;
	
					case "month":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numDiasMes = date("t", time()+$hourOffset);
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-($diaMes*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(($numDiasMes-$diaMes-1)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()-($diaMes*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+(($numDiasMes-$diaMes-1)*24*3600));
						}
						break;
	
					case "Fquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						$numMes = date("n", time()+$hourOffset);
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1)+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1));
						}
						break;
	
					case "Nyear":
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y"))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")));
						}
						break;
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "not this":
				switch ($filter_values[$i][2]){
	
					case "day":
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d");
							$filter_values[$i][3] = date("Y-m-d");
						}
	
						break;
	
					case "week":
						$diaSemana = date("N", time()+$hourOffset)-1;
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(($diaSemana-($week_start-1))*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+((6-($diaSemana-($week_start-1)))*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()-(($diaSemana-($week_start-1))*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))*24*3600));
						}
						break;
	
					case "month":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numDiasMes = date("t", time()+$hourOffset);
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-($diaMes*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(($numDiasMes-$diaMes-1)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()-($diaMes*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+(($numDiasMes-$diaMes-1)*24*3600));
						}
						break;
	
					case "Fquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						$numMes = date("n", time()+$hourOffset);
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1)+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1));
						}
						break;
	
					case "Nyear":
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y"))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")));
						}
						break;
	
				}
	
				$operator1 = "NOT BETWEEN";
				$operator2 = "AND";
				break;
	
	
			case "these":
					
				switch ($filter_values[$i][2]){
	
					case "day":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(($filter_values[$i][3])*24*3600)-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", time()-($filter_values[$i][3])*24*3600);
							$filter_values[$i][3] = date("Y-m-d");
						}
						break;
	
					case "week":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter_values[$i][3]-1)*7*24*3600))-(date("G")*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+((6-($diaSemana-($week_start-1)))*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter_values[$i][3]-1)*7*24*3600)));
							$filter_values[$i][3] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))*24*3600));
						}
						break;
	
					case "month":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						$diaMes = date("j", time()+$hourOffset)-1;
						$monthsDate = @mktime(0,0,0,date("m")-($filter_values[$i][3]),1,date("Y"));
						$numDiasMes = date("t", time()+$hourOffset);
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", $monthsDate+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(($numDiasMes-$diaMes-1)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", $monthsDate);
							$filter_values[$i][3] = date("Y-m-d", time()+(($numDiasMes-$diaMes-1)*24*3600));
						}
						break;
	
					case "Fquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
	
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter_values[$i][3]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")-$filter_values[$i][3])+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1)+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")-$filter_values[$i][3]));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1));
						}
						break;
	
					case "Nyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						$filter_values[$i][3] = $filter_values[$i][3] -1;
	
						if (in_array($filter_values[$i][4], array("datetime", "timestamp"))) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")-($filter_values[$i][3]))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter_values[$i][4] == "date"){
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")-($filter_values[$i][3])));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")));
						}
						break;
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "next":
				switch ($filter_values[$i][2]){
	
					case "day":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
							
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()+(1*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(($filter_values[$i][3]+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()+(1*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+(($filter_values[$i][3])*24*3600));
						}
						break;
	
					case "week":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()+((7-($diaSemana-($week_start-1)))*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))+($filter_values[$i][3]*7)+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()+((7-($diaSemana-($week_start-1)))*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+(((6-($diaSemana-($week_start-1)))+($filter_values[$i][3]*7))*24*3600));
						}
						break;
	
					case "month":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$mes = @mktime( 0, 0, 0, date("m")+$filter_values[$i][3], 1, date("Y"));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")+1,1,date("Y"))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+$filter_values[$i][3],date("t", $mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")+1,1,date("Y")));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+$filter_values[$i][3],date("t", $mes),date("Y")));
						}
						break;
	
					case "Fquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y")));
						}
	
						break;
	
					case "Nquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$numMes = date("n", time()+$hourOffset);
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")+1)+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter_values[$i][3]+1)+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")+1));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter_values[$i][3]+1));
						}
						break;
	
					case "Nyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")+1)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")+$filter_values[$i][3])+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")+1));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")+$filter_values[$i][3]));
						}
						break;
	
				}
	
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "not next":
				switch ($filter_values[$i][2]){
	
					case "day":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
							
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()+(1*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(($filter_values[$i][3]+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()+(1*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+(($filter_values[$i][3])*24*3600));
						}
						break;
	
					case "week":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", time()+((7-($diaSemana-($week_start-1)))*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))+($filter_values[$i][3]*7)+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", time()+((7-($diaSemana-($week_start-1)))*24*3600));
							$filter_values[$i][3] = date("Y-m-d", time()+(((6-($diaSemana-($week_start-1)))+($filter_values[$i][3]*7))*24*3600));
						}
						break;
	
					case "month":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$mes = @mktime( 0, 0, 0, date("m")+$filter_values[$i][3], 1, date("Y"));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")+1,1,date("Y"))+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+$filter_values[$i][3],date("t", $mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")+1,1,date("Y")));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+$filter_values[$i][3],date("t", $mes),date("Y")));
						}
						break;
	
					case "Fquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y")));
						}
	
						break;
	
					case "Nquarter":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter_values[$i][3]),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")+1)+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter_values[$i][3]+1)+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")+1));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter_values[$i][3]+1));
						}
						break;
	
					case "Nyear":
						if ($filter_values[$i][3] == "")
							$filter_values[$i][3] = 1;
	
						if (($filter_values[$i][4] == "datetime") || ($filter_values[$i][4] == "timestamp")) {
							$filter_values[$i][2] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")+1)+$hourOffset);
							$filter_values[$i][3] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")+$filter_values[$i][3])+(24*3600)-(3600)+$hourOffset);
						}else if ($filter_values[$i][4] == "date") {
							$filter_values[$i][2] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")+1));
							$filter_values[$i][3] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")+$filter_values[$i][3]));
						}
						break;
	
				}
	
	
				$operator1 = "NOT BETWEEN";
				$operator2 = "AND";
				break;
	
			//EN CASO DE QUE HAYA ALGUN REPORT VIEJO, MANTENEMOS LAS OPCIONES DE FIXED_DATE
			case "fixed date":
	
				switch ($filter_values[$i][2]){
	
					case "today":
						$filter_values[$i][2] = date("Y-m-d 00:00:00");
						$filter_values[$i][3] = date("Y-m-d 23:59:59");
						break;
	
					case "yesterday":
						$filter_values[$i][2] = date("Y-m-d 00:00:00", time()-1*24*3600);
						$filter_values[$i][3] = date("Y-m-d 23:59:59", time()-1*24*3600);
						break;
	
					case "last n days":
						$filter_values[$i][2] = date("Y-m-d 00:00:00", time()-(($filter_values[$i][3])*24*3600));
						$filter_values[$i][3] = date("Y-m-d 23:59:59", time());
						break;
	
					case "this week":
						$diaSemana = date("N")-1;
						$filter_values[$i][2] = date("Y-m-d 00:00:00", time()-($diaSemana-($week_start-1))*24*3600);
						$filter_values[$i][3] = date("Y-m-d 23:59:59", time()+(6-($diaSemana-($week_start-1)))*24*3600);
						break;
	
					case "last week":
						$diaSemana = date("N")-1;
						$filter_values[$i][2] = date("Y-m-d 00:00:00", time()-(($diaSemana-($week_start-1))+7)*24*3600);
						$filter_values[$i][3] = date("Y-m-d 23:59:59", time()+((6-($diaSemana-($week_start-1)))-7)*24*3600);
						break;
	
					case "this month":
						$diaMes = date("j")-1;
						$numDiasMes = date("t");
						$filter_values[$i][2] = date("Y-m-d 00:00:00", time()-$diaMes*24*3600);
						$filter_values[$i][3] = date("Y-m-d 23:59:59", time()+($numDiasMes-$diaMes-1)*24*3600);
						break;
	
					case "last month":
						$diaMes = date("j")-1;
						$numDiasMes = date("d", time()-($diaMes+1)*24*3600);
						$filter_values[$i][2] = date("Y-m-d 00:00:00", time()-($diaMes+$numDiasMes)*24*3600);
						$filter_values[$i][3] = date("Y-m-d 23:59:59", time()-($diaMes+1)*24*3600);
						break;
	
					case "this fiscal quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						$filter_values[$i][2] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
						$filter_values[$i][3] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						break;
	
					case "last fiscal quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						$filter_values[$i][2] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-3,date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
						$filter_values[$i][3] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						break;
	
					case "this natural quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						$filter_values[$i][2] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
						$filter_values[$i][3] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						break;
	
					case "last natural quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						$filter_values[$i][2] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-3,date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
						$filter_values[$i][3] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						break;
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
	
				break;
				//EN CASO DE QUE HAYA ALGUN REPORT VIEJO, MANTENEMOS LAS OPCIONES DE FIXED_DATE
	
		}
	
			
	}
	
	static public function generateSqlWhere($filter_values, $i, $field_values, $operator1, $operator2, & $sqlWhere, $escapeTokensFilters) {
		
			
		//Apply CalculatedField to Where Clause
		$filter0 = $filter_values[$i][0];
		
		foreach ($field_values as $field_value) {
			
	
			if ($filter_values[$i][6] == $field_value[11]) {
	
				$calculatedfields = explode('${comma}', $field_value[5]);
				
				
				if (($calculatedfields[0] != '0') || (!empty($calculatedfields[1]))) {
					$filter0 = $field_value[0];
				}
				break;
					
			}
	
		}
		
		$filterLogicalOperators = explode(":", $filter_values[$i][13]);
		$openingParenthesis = ((empty($filterLogicalOperators[0])) || ($filterLogicalOperators[0] < 0)) ? 0 : $filterLogicalOperators[0];
		$closingParenthesis = ((empty($filterLogicalOperators[0])) || ($filterLogicalOperators[0] > 0)) ? 0 : $filterLogicalOperators[0]*-1;
		$logicalOperator = (empty($filterLogicalOperators[1])) ? '' : $filterLogicalOperators[1];
			
	
		for ($oParenthesis = 0; $oParenthesis < $openingParenthesis; $oParenthesis++)
			$sqlWhere .= '(';
			
		//Para los campos enum y que tenga como primer operador one of o not one of
		if (((in_array($filter_values[$i][4], array("enum"))) && (in_array($filter_values[$i][1], array("one of", "not one of")))) || (in_array($operator1, array("IN", "NOT IN")))) {
	
			$enum_fields = ($escapeTokensFilters == "true") ? explode('${dollar}', $filter_values[$i][2]) : explode("$", $filter_values[$i][2]);
			$sqlWhere .= "(";
	
			if ($escapeTokensFilters == "true")
				$sqlWhere .= $filter0." ".$operator1." ('".str_replace('${dollar}', "', '",$filter_values[$i][2])."') ";
			else
				$sqlWhere .= $filter0." ".$operator1." ('".str_replace("$", "', '",$filter_values[$i][2])."') ";
	
			if ($enum_fields[0] == ""){
	
				if ($filter_values[$i][1] == "one of")
					$sqlWhere .= "OR ".$filter0." IS NULL";
	
			} else {
	
				if ($filter_values[$i][1] == "not one of")
					$sqlWhere .= "OR ".$filter0." IS NULL";
	
			}
	
			$sqlWhere .= ") ";
	
		} else {
	
			if ((($filter_values[$i][2] == "") && (in_array($operator1, array("=", "!=")))) || (($filter_values[$i][2] != "") && ($operator1 == "!=")))
				$sqlWhere .= "(";
	
			if (in_array($filter_values[$i][4], array("tinyint(1)", "int", "currency"))) {
				if ($filter_values[$i][2] != "")
					$sqlWhere .= $filter0." ".$operator1." ".$filter_values[$i][2]." ";
			} else {
				$sqlWhere .= $filter0." ".$operator1." '".$filter_values[$i][2]."' ";
			}
				
			if ($filter_values[$i][2] == "") {
	
				if ($operator1 == "=") {
	
					if (!in_array($filter_values[$i][4], array("tinyint(1)", "int", "currency")))
						$sqlWhere .= "OR ";
					$sqlWhere .= $filter0." IS NULL) ";
	
				} else if ($operator1 == "!=") {
	
					if (!in_array($filter_values[$i][4], array("tinyint(1)", "int", "currency")))
						$sqlWhere .= "AND ";
					$sqlWhere .= $filter0." IS NOT NULL) ";
	
				}
	
			} else {
	
				if ($operator1 == "!=") {
	
					$sqlWhere .= "OR ".$filter0." IS NULL) ";
	
				}
	
			}
	
		}
	
	
		if ($operator2 != ""){
	
			$sqlWhere .= $operator2." '".$filter_values[$i][3]."'";
	
		}
	
			
		for ($cParenthesis = 0; $cParenthesis < $closingParenthesis; $cParenthesis++)
			$sqlWhere .= ')';
			
		$sqlWhere .= ($logicalOperator == 'OR') ? " OR  " : " AND ";
	
	}
	
	static public function modifySqlWhereForAsolDomainsQuery(&$sqlWhere, $report_table, $current_user, $schedulerCall, $reportDomain, $domainField = null) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.print_r(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);
		
		global $db;
	
	
		if (((!$current_user->is_admin) || (($current_user->is_admin) && (!empty($current_user->asol_default_domain)))) || ($schedulerCall)) {
	
			$asolReportDomainId = ($schedulerCall) ? $reportDomain : $current_user->asol_default_domain;
	
			require_once("modules/asol_Domains/asol_Domains.php");
			require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
			$domainsBean = new asol_domains();
	//wfm_utils::wfm_log('asol', 'ANTES 2', __FILE__, __METHOD__, __LINE__);
			$domainsBean->retrieve($asolReportDomainId);
	//wfm_utils::wfm_log('asol', 'DESPUES 2', __FILE__, __METHOD__, __LINE__);
	
			if ($domainsBean->asol_domain_enabled) {
	
				if ($domainField !== null) {
	
					if ($domainField != "") {
							
						$domainFieldName = $domainField["fieldName"];
						$domainIsNumeric = $domainField["isNumeric"];
							
						$domainFieldChar = ($domainIsNumeric) ? "" : "'";
							
						if (empty($sqlWhere))
							$sqlWhere .= " WHERE ( (".$report_table.".".$domainFieldName."=".$domainFieldChar.$asolReportDomainId.$domainFieldChar.") ";
						else
							$sqlWhere .= " AND ( (".$report_table.".".$domainFieldName."=".$domainFieldChar.$asolReportDomainId.$domainFieldChar.") ";
	
//						//View hierarchy (any item above its hierarchy could be seen)
//						$childDomainsIds = (!empty($current_user->asol_child_domains_array)) ? $current_user->asol_child_domains_array : asol_manageDomains::getChildDomainsWithDepth($asolReportDomainId);
//						$childDomainsStr = array();
//						foreach ($childDomainsIds as $key=>$domainId) {
//							if (!$domainId['enabled'])
//							array_splice($childDomainsIds, $key, 1);
//							else
//							$childDomainsStr[] = $domainId['id'];
//						}
//						$sqlWhere .= (count($childDomainsIds) > 0) ? "OR (".$report_table.".".$domainFieldName." IN (".$domainFieldChar.implode($domainFieldChar.",".$domainFieldChar , $childDomainsStr).$domainFieldChar.")) )" : ") " ;
						
						$sqlWhere .= ") ";
	
					}
						
				} else {
						
					$sqlWhere .= " AND ( (".$report_table.".asol_domain_id='".$asolReportDomainId."')";
	
					if (($current_user->asol_only_my_domain == 0) || ($schedulerCall)) {
	
//						
//						//***asol_domain_child_share_depth***//
//						$sqlWhere .= asol_manageDomains::getChildShareDepthQuery($report_table.'.', $asolReportDomainId);
//						//***asol_domain_child_share_depth***//
//	
//						//***asol_multi_create_domain***//
//						if ($report_table != 'users')
//							$sqlWhere .= asol_manageDomains::getMultiCreateQuery($report_table.'.', $asolReportDomainId);
//						//***asol_multi_create_domain***//
//	
//						//***asol_publish_to_all***//
//						$sqlWhere .= asol_manageDomains::getPublishToAllQuery($report_table.'.', $asolReportDomainId);
//						//***asol_publish_to_all***//
//							
//						//***asol_child_domains***//
//						$sqlWhere .= asol_manageDomains::getChildHierarchyQuery($report_table.'.', $asolReportDomainId);
//						//***asol_child_domains***//
//						
						$sqlWhere .= ") ";
	
					} else {
	
						$sqlWhere .= ") ";
	
					}
						
				}
	
			} else {
	
				$sqlWhere .= " AND (1!=1) ";
	
			}
	
		}
	
	}
	
	
	static public function getSqlGroupByQuery($field_values, $report_table) {
		
		
		$sqlGroup = "";
		$sqlChartGroup = "";
		$details = Array();
		$group_by_seq = Array();
	
		$j=0;
		$l=0;
		for ($i=0; $i<count($field_values); $i++){
	
			if ($field_values[$i][6] == "Grouped") {
	
				$table = ((count(explode(".", $field_values[$i][0]))) == 1 ) ? $report_table."." : "";
	
				$group_by_seq[$j]['order'] = $field_values[$i][7];
				$group_by_seq[$j]['field'] = $table.$field_values[$i][0];
				$group_by_seq[$j]['alias'] = $field_values[$i][1];
				$group_by_seq[$j]['display'] = $field_values[$i][2];
				$group_by_seq[$j]['type'] = $field_values[$i][8];
					
					
				$group_by_seq[$j]['enumFields'] = $field_values[$i][13];
				$group_by_seq[$j]['enumLabels'] = $field_values[$i][12];
					
					
				if (($field_values[$i][12] == 'options') || ($field_values[$i][12] == 'function')) {
	
					$group_by_seq[$j]['enumFields'] = Basic_wfm::getEnumLabels($field_values[$i][12], $field_values[$i][13]);
					$group_by_seq[$j]['enumLabels'] = Basic_wfm::getEnumValues($field_values[$i][12], $field_values[$i][13]);
	
				} else {
	
					if (empty($values[12])) {
						$group_by_seq[$j]['enumFields'] = $field_values[$i][13];
						$group_by_seq[$j]['enumLabels'] = $field_values[$i][12];
					} else {
						$group_by_seq[$j]['enumFields'] = $field_values[$i][12];
						$group_by_seq[$j]['enumLabels'] = $field_values[$i][12];
					}
	
				}
					
	
				$j++;
	
			}
	
			//Comprobamos si alguno de los campos agrupados son detallados, si es as? lo amacenamos en un array $details
			if (($field_values[$i][6] == "Detail") || ($field_values[$i][6] == "Day Detail") || ($field_values[$i][6] == "Month Detail") || ($field_values[$i][6] == "Fiscal Quarter Detail") || ($field_values[$i][6] == "Natural Quarter Detail")) {
	
				$details[$l]['order'] = $field_values[$i][3];
	
				$table = ((count(explode(".", $field_values[$i][0]))) == 1 ) ? $report_table."." : "";
					
				$details[$l]['field'] = $table.$field_values[$i][0];
				$details[$l]['type'] = $field_values[$i][6];
				$details[$l]['format'] = $field_values[$i][8];
					
				$details[$l]['opts'] = $field_values[$i][12];
				$details[$l]['optsDb'] = $field_values[$i][13];
					
				$details[$l]['function'] = $field_values[$i][5];
					
					
				if (($field_values[$i][12] == 'options') || ($field_values[$i][12] == 'function')) {
	
					$details[$l]['enumFields'] = Basic_wfm::getEnumLabels($field_values[$i][12], $field_values[$i][13]);
					$details[$l]['enumLabels'] = Basic_wfm::getEnumValues($field_values[$i][12], $field_values[$i][13]);
	
				} else {
	
					if (empty($values[12])) {
						$details[$l]['enumFields'] = $field_values[$i][13];
						$details[$l]['enumLabels'] = $field_values[$i][12];
					} else {
						$details[$l]['enumFields'] = $field_values[$i][12];
						$details[$l]['enumLabels'] = $field_values[$i][12];
					}
	
				}
					
				$l++;
	
			}
	
		}
	
		if (count($details) != 0) {
	
			sort($details);
	
			if ($details[0]['type'] == 'Detail') {
				$sqlChartGroup .= " GROUP BY ".$details[0]['field']." ";
			}
	
		}
	
		if (count($group_by_seq) != 0){
	
			sort($group_by_seq);
			$sqlGroup .= " GROUP BY ";
	
			for ($k=0; $k<count($group_by_seq); $k++){
	
				$table = ((count(explode(".", $group_by_seq[$k]['field']))) == 1 ) ? $report_table."." : "";
				$sqlGroup .= $table.$group_by_seq[$k]['field']." ,";
	
			}
	
		}
	
		$sqlGroup = substr($sqlGroup, 0, -1);
	
	
		$returnedArray = Array (
			"groupBySeq" => $group_by_seq,
			"details" => $details,
			"querys" => Array (
				"Group" => $sqlGroup,
				"ChartGroup" => $sqlChartGroup,
		),
		);
	
		return $returnedArray;
	
	
	}
	
	
	static public function getSqlOrderByQuery($field_values, $report_table, $field_sort = "", $sort_direction = "", $leftJoineds = array()) {
		
		
		$sqlOrder = "";
		$order_by_seq = Array();
		$hasGroupField = false;
	
		//Check if has Group
		for ($i=0; $i<count($field_values); $i++)
		$hasGroupField = (($field_values[$i][6] == 'Grouped') || ($hasGroupField)) ? true: false;
	
		$j=0;
		for ($i=0; $i<count($field_values); $i++){
	
			$functionValues = explode('${comma}', $field_values[$i][5]);
	
			if ($field_values[$i][3] != "0") {
	
				$order_by_seq[$j]['order'] = $field_values[$i][4];
				$order_by_seq[$j]['field'] = $field_values[$i][0];
				$order_by_seq[$j]['dir'] = $field_values[$i][3];
	
				$j++;
			}
	
		}
	
	
		if (count($order_by_seq) != 0){
	
			sort($order_by_seq);
			$sqlOrder .= " ORDER BY ";
	
			for ($k=0; $k<count($order_by_seq); $k++){
	
				$table = ((count(explode(".", $order_by_seq[$k]['field']))) == 1 ) ? $report_table."." : "";
				$sqlOrder .= $table.$order_by_seq[$k]['field']." ".$order_by_seq[$k]['dir']." ,";
	
			}
	
		}
	
		$sqlOrder = substr($sqlOrder, 0, -1);
	
	
		//Reordenamos el resultset en funcion de la cabecera pinchada en la pagina display
		if ($field_sort != ""){
	
			if ($sort_direction == "")
			$sort_direction = "ASC";
	
			$table = ((count(explode(".", $field_sort))) == 1 ) ? $report_table."." : "";
	
			//Reformatear nombre de la tabla si es un related field
			$sqlOrder = " ORDER BY ".$table.$field_sort." ".$sort_direction." ";
	
			if ($sort_direction == "ASC")
			$sort_direction = "DESC";
			else
			$sort_direction = "ASC";
	
		}
	
	
		$returnedArray = Array (
			"sortDirection" => $sort_direction,
			"query" => $sqlOrder,
		);
	
		return $returnedArray;
	
	
	}
	
	
	static public function getSqlLimitQuery($results_limit, $entries_per_page, $page_number, $total_entries, $externalCall) {
	
		if ($results_limit == "all"){
	
			$sqlLimit = " LIMIT ".$entries_per_page*$page_number.",".$entries_per_page;
			$sqlLimitExport = "";
	
			$total_entries_basic = $total_entries;
	
		} else {
	
			$res_limit = explode('${dp}', $results_limit);
	
	
			if ($res_limit[2] > $total_entries)
			$res_limit[2] = $total_entries;
	
	
			if ($res_limit[1] == 'first'){
	
				if ($entries_per_page >= $res_limit[2]) {
	
					$sqlLimit = " LIMIT 0,".$res_limit[2];
	
				} else {
	
					$limit_current_entries = ((($entries_per_page*$page_number)+$entries_per_page) > $res_limit[2]) ? ($res_limit[2]%$entries_per_page) : $entries_per_page;
					$sqlLimit = " LIMIT ".($entries_per_page*$page_number).",".$limit_current_entries;
	
				}
	
				$sqlLimitExport = " LIMIT 0,".$res_limit[2];
	
			} else { //last
	
				$limit_init_entry = ($total_entries < $res_limit[2]) ? ($entries_per_page*$page_number) : ($entries_per_page*$page_number)+($total_entries-$res_limit[2]);
	
				if ($entries_per_page >= $res_limit[2]) {
	
					$sqlLimit = " LIMIT ".($total_entries-$res_limit[2]).",".$res_limit[2];
	
				} else {
	
					$limit_current_entries = ((($entries_per_page*$page_number)+$entries_per_page) > $res_limit[2]) ? ($res_limit[2]%$entries_per_page) : $entries_per_page;
					$sqlLimit = " LIMIT ".$limit_init_entry.",".$limit_current_entries;
	
				}
	
				$sqlLimitExport = " LIMIT ".($total_entries-$res_limit[2]).",".$res_limit[2];
	
			}
	
			$total_entries_basic = ($total_entries <= $res_limit[2]) ? $total_entries : $res_limit[2];
	
		}
	
	
		if ($externalCall) {
			$sqlLimit = "";
		}
	
	
	
		$returnedArray = Array (
			"totalEntriesBasic" => $total_entries_basic,
			"querys" => Array(
				"Limit" => $sqlLimit,
				"LimitExport" => $sqlLimitExport,
		),
		);
	
		return $returnedArray;
	
	}
	
	//Pasar parametros de paginado para calcular corrctamente el LIMIT, o mejor aun... hacer esta funcionalidad en el propia funcion de generar LIMIT
	static public function getSqlSubSetLimitQuery($alternative_database, $results_limit, $totalEntries, $entriesPerPage, $pageNumber, $report_table, $table_primary_key, $sqlFrom, $sqlJoin, $sqlWhere, $sqlGroup) {
	
		global $sugar_config;
		
		$useExternalDbConnection = true;
		$alternativeDb = ($alternative_database >= 0) ? $alternative_database : false;
		$checkMaxAllowedResults = (isset($sugar_config['maxAllowedResults'])) ? true : false;
		
		
		if ($results_limit == "all"){
	
			$sqlLimitSubSet = "";
	
		} else {
	
			$res_limit = explode('${dp}', $results_limit);
	
			$pageNumber = (empty($pageNumber)) ? 0 : $pageNumber;
	
			if ($res_limit[1] == 'first') {
					
				$offset = $pageNumber*$entriesPerPage;
				$numEntriesLimit = ($entriesPerPage < $res_limit[2]) ? $entriesPerPage : $res_limit[2];
				$numEntriesLimit = (($offset+$numEntriesLimit) > $res_limit[2]) ? ($res_limit[2]-$offset) : $numEntriesLimit;
					
				$sqlLimitSubSet = " LIMIT ".$offset.",".$numEntriesLimit." ";
	
			} else if ($res_limit[1] == 'last') {
	
				$sqlLimitedTotals = "SELECT ".$report_table.".".$table_primary_key." as numrows FROM ".substr($sqlFrom, 5)." ".$sqlJoin.$sqlWhere.$sqlGroup;
				$limitedTotalsRs = Basic_wfm::getSelectionResults($sqlLimitedTotals, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
				
				$offset = (count($limitedTotalsRs)) - (($res_limit[2]) - ($pageNumber*$entriesPerPage));
				$numEntriesLimit = ($entriesPerPage < $res_limit[2]) ? $entriesPerPage : $res_limit[2];
					
				$sqlLimitSubSet = " LIMIT ".$offset.",".$numEntriesLimit." ";
	
			}
	
		}
	
			
		return $sqlLimitSubSet;
	
	}
	
	static public function getExternalTablePrimaryKey($alternative_database, $report_table) {
		
		global $sugar_config;
		
		$useExternalDbConnection = true;
		$alternativeDb = ($alternative_database >= 0) ? $alternative_database : false;
		$checkMaxAllowedResults = (isset($sugar_config['maxAllowedResults'])) ? true : false;
		
		$externalColumnsRs = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$report_table, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
		
		$primaryKey = null;
		foreach ($externalColumnsRs as $externalColumnsRow) {
			if ($externalColumnsRow['Key'] === "PRI") {
				$primaryKey = $externalColumnsRow['Field'];
				break;
			}
		}
		
		return $primaryKey;
		
	}
	
	//Misma pelicula que funcion de arriba
	static public function getSqlLimitDetailWhereQuery($results_limit, $detailGroupFullSize, $report_table, $sqlFrom, $sqlJoin, $sqlDetailWhere, $sqlGroup, $sqlOrder) {
	
		if ($results_limit == "all") {
	
			$sqlLimitWhere = "";
	
		} else {
	
			$res_limit = explode('${dp}', $results_limit);
	
			$sqlLimitedTotals = "SELECT @rownum:=@rownum+1 AS rownum, ".$report_table.".id FROM (SELECT @rownum:=0) r, ".substr($sqlFrom, 5)." ".$sqlJoin.$sqlDetailWhere.$sqlGroup.$sqlOrder;
			$limitedTotalsRs = Basic_wfm::getSelectionResults($sqlLimitedTotals);
	
			//reordenamos el array por si esta ordenado descendentemente
			foreach ($limitedTotalsRs as $key=>$limitedTotal)
			$limitedTotalsRs[$key]['rownum'] = $key+1;
	
			$listIds = "";
			foreach ($limitedTotalsRs as $limitedRow){
				if (($res_limit[1] == 'first') && ($limitedRow['rownum'] <= $res_limit[2]))
				$listIds .= "'".$limitedRow['id']."',";
				else if (($res_limit[1] == 'last') && ($limitedRow['rownum'] > ($detailGroupFullSize-$res_limit[2])))
				$listIds .= "'".$limitedRow['id']."',";
			}
	
			$listIds = substr($listIds, 0, -1);
			$sqlLimitWhere = " AND ".$report_table.".id IN (".$listIds.") ";
	
	
		}
	
		return $sqlLimitWhere;
	
	}
	
	
	static public function getSqlDetailLimitQuery($results_limit, $detailGroupFullSize) {
	
		if ($results_limit == "all") {
	
			$sqlLimit = "";
	
		} else {
	
			$res_limit = explode('${dp}', $results_limit);
	
			if ($res_limit[1] == "first"){
	
				$sqlLimit = " LIMIT 0,".$res_limit[2];
	
			} else { //last
	
				$limit_init_entry = ($detailGroupFullSize < $res_limit[2]) ? 0 : ($detailGroupFullSize-$res_limit[2]);
				$sqlLimit = " LIMIT ".$limit_init_entry.",".$res_limit[2];
	
			}
	
	
		}
	
		return $sqlLimit;
	
	}
	
	
	static public function formatGroupTotals($rsSubTotals, $totals, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $auditedReport, $auditedAppliedFields, $auditedFieldType) {
	
		global $timedate;
	
		//Set default timezone for php date/datetime functions
		date_default_timezone_set($userTZ);
	
		if (count($rsSubTotals[0]) == 0)
		$rsSubTotals[0] = Array();
		$k = 0;
	
		//Comprobar que el elemento actual no es un total, si lo es pasar al siguiente elemento
	
	
		foreach ($rsSubTotals[0] as $key=>$value){
	
			$total8 = (!empty($totals[$k][8])) ? $totals[$k][8] : "";
	
			if (($auditedReport) && (in_array($totals[$k][0], $auditedAppliedFields)))
			$total8 = $auditedFieldType;
	
			if ($total8 == "date") {
	
				if (($value != "") && (date('Y-m-d', strtotime($value)) == $value))
				$rsSubTotals[0][$key] = $timedate->swap_formats($value, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
	
			} else if ($total8 == "datetime") {
	
				if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
					$value = $timedate->handle_offset($value, $timedate->get_db_date_time_format(), true, null, $userTZ);
					$rsSubTotals[0][$key] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
				}
	
			} else if ($total8 == "timestamp") {
	
				if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
					$rsSubTotals[0][$key] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
				}
	
			} else if ($total8 == "currency") {
	
				$params = array('currency_id' => $currency_id, 'convert' => false);
				$rsSubTotals[0][$key] = currency_format_number($value, $params);
	
			} else {
					
				$rsSubTotals[0][$key] = $value;
	
			}
				
			//***HTML Entities Decoding
			$rsSubTotals[0][$key] = html_entity_decode($rsSubTotals[0][$key]);
			//***HTML Entities Decoding
	
			$k++;
	
		}
	
		if (empty($rsSubTotals[0]))
		$rsSubTotals = null;
	
		return $rsSubTotals;
	
	}
	
	
	static public function formatSubGroup($subGroup, $subGroupInfo, $userTZ, $currency_id, $escapeTokensFiltersComma) {
	
		global $timedate;
	
	
		//Set default timezone for php date/datetime functions
		date_default_timezone_set($userTZ);
	
		if ($subGroupInfo["format"] == "enum") {
	
			$indexFound = array_search($subGroup, explode('${comma}', $subGroupInfo['enumFields']));
			$groupEnumLabels = explode('${comma}', $subGroupInfo['enumLabels']);
			$subGroupVal = ($indexFound !== false) ? $groupEnumLabels[$indexFound] : $subGroup;
			$subGroup = ($subGroup == "Nameless") ? "Nameless" : $subGroupVal;
	
		} else if ($subGroupInfo["format"] == "datetime"){
	
			$subGroup = $timedate->handle_offset($subGroup, $timedate->get_db_date_time_format(), true, null, $userTZ);
	
		} else if ($subGroupInfo["format"] == "currency") {
	
			$params = array('currency_id' => $currency_id, 'convert' => false);
			$subGroup = currency_format_number($subGroup, $params);
	
		}
	
		$subGroup = str_replace("\'", "'", $subGroup);
	
		//***HTML Entities Decoding
		$subGroup = html_entity_decode($subGroup);
		//***HTML Entities Decoding
	
		return $subGroup;
	
	}
	
	
	static public function formatDetailResultSet($subGroups, &$resulset_fields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $escapeTokensFiltersComma, $auditedReport, $auditedAppliedFields, $auditedFieldType, $isExport = false) {
	
		global $timedate;
	
		//Set default timezone for php date/datetime functions
		date_default_timezone_set($userTZ);
	
		foreach ($subGroups as $key=>$subGroup){
	
			foreach ($subGroup as $keyG=>$values){
	
				$j=0;
	
				foreach ($values as $keyV=>$value){
	
					if (($auditedReport) && (in_array($resulset_fields[$j][0], $auditedAppliedFields)))
					$resulset_fields[$j][8] = $auditedFieldType;
	
					if ($resulset_fields[$j][8] == "enum") {
	
						if (!$isExport)
						$resulset_fields[$j][12] = str_replace('${sq}', "'", $resulset_fields[$j][12]);
	
							
						if (($resulset_fields[$j][12] == 'options') || ($resulset_fields[$j][12] == 'function')) {
	
							$enumOptions = explode('${comma}', Basic_wfm::getEnumValues($resulset_fields[$j][12], $resulset_fields[$j][13]));//Values
							$enumOptionsDb = explode('${comma}', Basic_wfm::getEnumLabels($resulset_fields[$j][12], $resulset_fields[$j][13]));//Labels
	
						} else {
	
							$enumOptionsDb = ($escapeTokensFiltersComma = "true") ? explode('${comma}', $resulset_fields[$j][13]) : explode(",", $resulset_fields[$j][13]);
							$enumOptions = ($escapeTokensFiltersComma = "true") ? explode('${comma}', $resulset_fields[$j][12]) : explode(",", $resulset_fields[$j][12]);
	
						}
							
							
						foreach ($enumOptionsDb as $keyO=>$opt){
	
							if ($opt == $subGroups[$key][$keyG][$keyV]){
	
								$subGroups[$key][$keyG][$keyV] = $enumOptions[$keyO];
								break;
	
							}
	
						}
	
					} else if ($resulset_fields[$j][8] == "date") {
	
						if (($value != "") && (date('Y-m-d', strtotime($value)) == $value))
						$subGroups[$key][$keyG][$keyV] = $timedate->swap_formats($value, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
	
					} else if ($resulset_fields[$j][8] == "datetime") {
	
						if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
							$value = $timedate->handle_offset($value, $timedate->get_db_date_time_format(), true, null, $userTZ);
							$subGroups[$key][$keyG][$keyV] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
						}
	
					} else if ($resulset_fields[$j][8] == "timestamp") {
	
						if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
							$subGroups[$key][$keyG][$keyV] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
						}
	
					} else if ($resulset_fields[$j][8] == "currency") {
	
						$params = array('currency_id' => $currency_id, 'convert' => false);
						$subGroups[$key][$keyG][$keyV] = currency_format_number($value, $params);
	
					} else {
	
						$subGroups[$key][$keyG][$keyV] = $value;
	
					}
	
					//***HTML Entities Decoding
					$subGroups[$key][$keyG][$keyV] = html_entity_decode($subGroups[$key][$keyG][$keyV]);
					//***HTML Entities Decoding
	
					$j++;
	
				}
	
			}
	
	
		}
	
		return $subGroups;
	
	}
	
	
	static public function formatResultSet($rs, &$resulset_fields, $totals, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $escapeTokensFiltersComma, $isExport = false) {
	
		global $timedate;
	
		//Set default timezone for php date/datetime functions
		date_default_timezone_set($userTZ);
	
		for ($j=0; $j<count($rs); $j++){
	
			if (!$isExport) {
	
				//Add totals info to main fields array
				foreach ($totals as $key=>$myTotal)
				$resulset_fields[] = $myTotal;
				//Add totals info to main fields array
	
			}
				
	
			$k = 0;
	
			foreach ($rs[$j] as $key=>$value) {
	
				if ($resulset_fields[$k][8] == "enum") {
						
					$resulset_fields[$k][12] = str_replace('${sq}', "'", $resulset_fields[$k][12]);
						
					$enumOptionsDb = ($escapeTokensFiltersComma = "true") ? explode('${comma}', $resulset_fields[$k][13]) : explode(",", $resulset_fields[$k][13]);
					$enumOptions = ($escapeTokensFiltersComma = "true") ? explode('${comma}', $resulset_fields[$k][12]) : explode(",", $resulset_fields[$k][12]);
						
					foreach ($enumOptionsDb as $keyO=>$opt) {
	
						if ($opt == $rs[$j][$key]){
								
							$rs[$j][$key] = $enumOptions[$keyO];
							break;
								
						}
	
					}
						
				} else if ($resulset_fields[$k][8] == "date") {
						
					if (($value != "") && (date('Y-m-d', strtotime($value)) == $value))
					$rs[$j][$key] = $timedate->swap_formats($value, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
						
				} else if ($resulset_fields[$k][8] == "datetime") {
						
					if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
						$value = $timedate->handle_offset($value, $timedate->get_db_date_time_format(), true, null, $userTZ);
						$rs[$j][$key] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
					}
	
				} else if ($resulset_fields[$k][8] == "timestamp") {
						
					if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
						$rs[$j][$key] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
					}
	
				} else if ($resulset_fields[$k][8] == "currency") {
	
					$params = array('currency_id' => $currency_id, 'convert' => false);
					$rs[$j][$key] = currency_format_number($value, $params);
	
				} else {
						
					$rs[$j][$key] = $value;
	
				}
	
				//***HTML Entities Decoding
				$rs[$j][$key] = html_entity_decode($rs[$j][$key]);
				//***HTML Entities Decoding
					
				$k++;
	
			}
	
		}
	
		return $rs;
	
	}
	
	
	static public function getDelimiterTokens($stringType, $string) {
	
		$posString = strpos($string, '${v');
	
		if ($stringType == 'fields') {
	
			if ($posString === false){
	
				$versionString = '${v1.0.0}';
				$escapeTokensString = "false";
	
			}else{ //Si field tiene version
	
				$versionString = substr($string, -9, 9);
	
				if ($versionString < '${v1.3.1}')
				$escapeTokensString = "false";
				else
				$escapeTokensString = "true";
	
				$string = substr($string, 0, -9);
	
			}
	
			return Array(
				'string' => $string,
				'escapeTokens' => $escapeTokensString,
			);
	
		} else if ($stringType == 'filters') {
	
			if ($posString === false){
	
				$versionFilters = '${v1.0.0}';
	
				$escapeTokensStringComma = "false";
				$escapeTokensString = "false";
	
			} else { //Si filters tiene version
	
				$versionString = substr($string, -9, 9);
	
				if ($versionString < '${v1.3.0}') {
					$escapeTokensStringComma = "false";
					$escapeTokensString = "false";
				} else if ($versionString == '${v1.3.0}') {
					$escapeTokensStringComma = "false";
					$escapeTokensString = "true";
				} else {
					$escapeTokensStringComma = "true";
					$escapeTokensString = "true";
				}
	
				$string = substr($string, 0, -9);
	
			}
	
			return Array(
				'string' => $string,
				'escapeTokens' => $escapeTokensString,
				'escapeTokensComma' => $escapeTokensStringComma,
			);
	
		}
	
	}
	
	
	static public function replace_reports_vars($text_with_vars, $table_alias_name, $leftJoineds) {
	
		global $beanList, $beanFiles;
	
		
		$tmpText = $text_with_vars;
		$pos = strpos($tmpText, '${');
	
	
		$beanItems = Array();
	
		while ($pos !== false) {
	
			$tmp_last = substr($tmpText, $pos);
			$posEnd = strpos($tmp_last, '}');
	
			$first = ($pos === 0) ? "" : substr($tmpText, 0, $pos-1);
			$item = substr($tmp_last, 0, $posEnd+1);
			$last = substr($tmp_last, $posEnd+2);
	
			$tmpText = $first." ASOL ".$last;
	
			$beanItems[] = $item;
	
			$pos = strpos($tmpText, '${');
	
		}
	
	
		foreach($beanItems as $beanItem) {
	
			if ($beanItem == '${this}')
			continue;
	
			$beanField = "";
			$tmpBeanItem = substr($beanItem, 2);
			$tmpBeanItem = substr($tmpBeanItem, 0, -1);
	
	
			$beanValues = explode("->", $tmpBeanItem);
			$beanValues = (count($beanValues) == 1) ? explode("-&gt;", $tmpBeanItem) : $beanValues;
	
	
			if (count($beanValues) == 2) {
					
				if ($beanValues[0] == "bean")  {
	
					$beanField = $table_alias_name.".".$beanValues[1];
	
				} else if ($beanValues[0] == "bean_cstm") {
	
					$beanField = $table_alias_name."_cstm.".$beanValues[1];
	
				}
	
			} else if (count($beanValues) == 3) {
	
				$moduleArray = explode("_", $beanValues[0]);
				$isCustomField = ($moduleArray[count($moduleArray) - 1] == 'Cstm');
				$module = ($isCustomField) ? substr($beanValues[0], 0, -5): $beanValues[0];
					
				$class_name = $beanList[$module];
				require_once($beanFiles[$class_name]);
				$related_bean = new $class_name();
				$related_table = $related_bean->table_name;
	
					
				$relatedIndex = array_search($related_table."|".$beanValues[1], $leftJoineds);
					
				if ($relatedIndex === false)
				$relatedIndex = array_search($related_table."|".$table_alias_name."_cstm.".$beanValues[1], $leftJoineds);
	
				if (!$isCustomField)
				$related_table_alias_name = ($relatedIndex !== false) ? $related_table.$relatedIndex : $related_table;
				else
				$related_table_alias_name = ($relatedIndex !== false) ? $related_table."_cstm".$relatedIndex : $related_table;
				$beanField = $related_table_alias_name.".".$beanValues[2];
					
	
			}
	
			$text_with_vars = str_replace($beanItem, $beanField, $text_with_vars);
	
		}
	
		return str_replace("&#039;", "'", str_replace("&quot;", '"', $text_with_vars));
	
	}

}

?>