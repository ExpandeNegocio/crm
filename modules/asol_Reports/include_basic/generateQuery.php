<?php

class asol_ReportsGenerateQuery {

	static public function getQuerys($reportId) {
	
		global $current_user;
	
		$focus = BeanFactory::getBean('asol_Reports', $reportId);
		
		$acl_modules = ACLAction::getUserActions($focus->created_by);
		
		
		//Set default timezone for php date/datetime functions
		$userTZ = $current_user->getPreference("timezone");
		date_default_timezone_set($current_user->getPreference("timezone"));
	
		$phpDateTime = new DateTime(null, new DateTimeZone($userTZ));
		$hourOffset = $phpDateTime->getOffset()*-1;
		
		
	
		//Get an array of table names for admin accesible modules
		$modulesTables = Array();
		foreach($acl_modules as $key=>$mod){
	
			if ($mod['module']['access']['aclaccess'] >= 0){
				$modulesTables[$key] = BeanFactory::newBean(BeanFactory::getObjectName($key))->table_name;
			}
	
		}
	
	
		$rs = asol_Report::getSelectionResults("SELECT * FROM asol_reports WHERE id = '".$reportId."'", false);
	
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
	
			$report_table = BeanFactory::newBean(BeanFactory::getObjectName($report_module))->table_name;

		}
	
		$audited_report = ($rs[0]['audited_report'] == '1') ? true : false;
	
		$fieldValues = unserialize(base64_decode($rs[0]['report_fields']));
		$filterValues = unserialize(base64_decode($rs[0]['report_filters']));
		$chartJson = unserialize(base64_decode($rs[0]['report_charts_detail']));
		
		$chartInfo = $chartJson['charts'];
		
		
		//getQuerys
		$sqlJoinQueryArray = self::getSqlJoinQuery($fieldValues, $filterValues['data'], $report_module, $report_table, $audited_report, $useAlternativeDbConnection, $modulesTables);
	
		$moduleCustomJoined = $sqlJoinQueryArray["moduleCustomJoined"];
		$moduleCountCustomJoined = $sqlJoinQueryArray["moduleCountCustomJoined"];
		$leftJoineds = $sqlJoinQueryArray["leftJoineds"];
	
		$sqlSelectQueryArray = self::getSqlSelectQuery($fieldValues, $chartInfo, $report_table, $hourOffset, null, null, $audited_report, $leftJoineds);
		$custom_fields = $sqlSelectQueryArray["customFields"];

		
		//SELECT
		$sqlTotalsC = $sqlSelectQueryArray["querys"]["Charts"];
		$sqlSelect = $sqlSelectQueryArray["querys"]["Select"];
		$sqlTotals = $sqlSelectQueryArray["querys"]["Totals"];
	
		
		//LEFT JOIN
		$sqlJoinQuery = $sqlJoinQueryArray["querys"]["Join"];
		$sqlCountJoinQuery = $sqlJoinQueryArray["querys"]["CountJoin"];
	
		//FROM
		$sqlFromArray = self::getSqlFromQuery($report_table, $custom_fields, $audited_report);

		$sqlFromQuery = $sqlFromArray['from'];
		if ($sqlFromArray['joinExt'] !== null) {
			$sqlJoinQuery .= (!$moduleCustomJoined) ? $sqlFromArray['joinExt'] : '';
			$sqlCountJoinQuery .= (!$moduleCountCustomJoined) ? $sqlFromArray['joinExt'] : '';
		}
	
		//WHERE
		$sqlWhereQuery = self::getSqlWhereQuery($filterValues['data'], $fieldValues, $report_table, $hourOffset, null, null, $useAlternativeDbConnection);
		
		//GROUP BY
		$sqlGroupByQueryArray = self::getSqlGroupByQuery($fieldValues, $report_table);
		$sqlGroupByQuery = $sqlGroupByQueryArray["querys"]["Group"];
		$sqlChartGroupByQuery = $sqlGroupByQueryArray["querys"]["ChartGroup"];
	
		//ORDER BY
		$sqlOrderByQueryArray = self::getSqlOrderByQuery($fieldValues, $report_table);
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
	
	static private function hasCustomFieldInReport($fieldInfo, $fieldValues) {

		$fieldInfoNameDotExploded = explode(".", $fieldInfo['field']);
		$tableInfoUnderScoreExploded = explode("_", $fieldInfoNameDotExploded[0]);
		
		$hasCustomField = (end($tableInfoUnderScoreExploded) == 'cstm') ? true : false;

		if (!$hasCustomField) {

			foreach ($fieldValues['tables'][0]['data'] as $fieldValue) {

				if ($fieldInfo['key'] == $fieldValue['key']) {

					$fieldNameDotExploded = explode(".", $fieldValue['field']);
					if ($fieldInfoNameDotExploded[0].'_cstm' == $fieldNameDotExploded[0]) {

						$hasCustomField = true;
						break;
					}
					
				}
				
			}
		
		}

		return $hasCustomField;
		
	}
	
	static private function relateFieldUsedInFieldFormula($fieldInfo, $fieldValues, $modulesTables) {
	
		$returnedValue = false;
	
		if ($fieldInfo['isRelated']) {
	
			$fieldArray = explode('.', $fieldInfo['field']);
	
			$fieldModuleArray = explode("_", $fieldArray[0]);
			$isCustomfield = ($fieldModuleArray[count($fieldModuleArray) - 1] == 'cstm');
			$fieldTableName = ($isCustomfield) ? substr($fieldArray[0], 0, -5): $fieldArray[0];
				
			$fieldModuleName = array_search($fieldTableName, $modulesTables); //Get array with table to moduleName Reference as in pre_installing dropdowns fixup
			$fieldName = $fieldArray[1];
	
			$fieldVariable = ($isCustomfield) ? '${'.$fieldModuleName.'_Cstm->'.$fieldInfo['key'].'->'.$fieldName.'}' : '${'.$fieldModuleName.'->'.$fieldInfo['key'].'->'.$fieldName.'}';

			foreach ($fieldValues['tables'][0]['data'] as $fieldValue) {

				$currentFieldSQL = html_entity_decode($fieldValue['sql']);
				
				if (strpos($currentFieldSQL, $fieldVariable) !== false) {
	
					$returnedValue = true;
					break;
	
				}
	
			}
	
		}

		return $returnedValue;
	
	}
	
	static private function allowedCountLeftJoin($fieldInfo, $filterValues, $isNonCrmDatabase) {
	
		$doCountLeftJoin = false;
		
		$fieldDotExploded = explode(".", $fieldInfo['field']);
	
		
		$fieldIsVisible = (strtolower($fieldInfo['visible']) == "yes") ? true : false; 
		$fieldHasFunction = (!in_array($fieldInfo['function'], array("0", "undefined"))) ? true : false;
		$fieldHasDetailGrouped = ($fieldInfo['grouping'] != "0") ? true : false;
		

		$primaryKeyRel = false;
		$fieldInfoKey = explode(" ", $fieldInfo['key']);
	
		if ($isNonCrmDatabase) {
			if ($fieldInfoKey[2] == 'PRI')
				$primaryKeyRel = true;
		} else {
			if ($fieldInfoKey[0] == 'id')
				$primaryKeyRel = true;
		}
	
		if (($fieldHasFunction && $fieldIsVisible) || $fieldHasDetailGrouped || $primaryKeyRel) {
	
			if (count($fieldDotExploded) >= 2)
				$doCountLeftJoin = true;
	
		}
	
		
		if (!$doCountLeftJoin) { //Sólo si display es Yes y no ha sido verificado como Related Field Function
	
			foreach ($filterValues as $filter) {
	
				if ((count($fieldDotExploded) >= 2) && (($filter['field'] == $fieldInfo['field']) && ($filter['relationKey'] == $fieldInfo['key']))) {
	
					$doCountLeftJoin = true;
					break;
	
				}
	
			}
	
		}
	
		return $doCountLeftJoin;
	
	}

	static public function getSqlJoinQuery(& $fieldValues, & $filter_values, $report_module, $report_table, $audited_report, $isNonCrmDatabase, $modulesTables, & $domainField = null) {
	
		if ($audited_report) {
	
			//**************************************//
			//****Define Returned Function Array****//
			//**************************************//
			$returnedLeftJoinArray = self::manageAuditSqlJoin($fieldValues, $filter_values, $report_table);
	
		} else {
	
			global $db;
	
			//*************************************//
			//*****Variable Definition Global******//
			//*************************************//
			$sqlFilterTableIndex = array();
			
			$isLeftJoinedCustom = array();
			$isLeftJoinedCountCustom = array();
	
			$sqlJoin = "";
			$sqlCountJoin = "";
	
			$moduleCustomJoined = false;
			$moduleCountCustomJoined = false;
			$leftJoineds = array();
			$leftCountJoineds = array();
			$keySearch = "";
			
			$relationshipFiltersInfo = array();
	
	
			foreach ($fieldValues['tables'][0]['data'] as $index=>$currentValues) {
				
				//*************************************//
				//*****Save Unmodified Field Name******//
				//*************************************//
				$fieldValues['tables'][0]['data'][$index]['notModifiedFieldName'] = $currentValues['field'];
	
				
				//****************************************//
				//*****Variable Definition Iteration******//
				//****************************************//
				$fieldKeyBlankspaceExploded = explode(" ", $currentValues['key']);
				$tableKey = $fieldKey = $fieldKeyBlankspaceExploded[0];
				$relatedFieldKey = $currentValues['key'];
						
				
				//********************************************//
				//*****Override Fields for CRM Databases******//
				//********************************************//
				if (!$isNonCrmDatabase) {
					$fieldValues['tables'][0]['data'][$index]['key'] = $fieldKeyBlankspaceExploded[0];	
					$searchFieldKeyRelationshipName = $fieldKeyBlankspaceExploded[1];
				}
				
				
				$fieldNameDotExploded = explode(".", $currentValues['field']);
				$tableUnderScoreExploded = explode("_", $fieldNameDotExploded[0]);
				
				$mainTableName = (end($tableUnderScoreExploded) == 'cstm') ? substr($fieldNameDotExploded[0], 0, -5) : $fieldNameDotExploded[0];
				$isCustomTable = (end($tableUnderScoreExploded) == 'cstm') ? true : false;
				$hasCustomFieldInReport = self::hasCustomFieldInReport($currentValues, $fieldValues);
				$setCustomJoin = $isCustomTable || $hasCustomFieldInReport;
	
				$newKeySearch = array_search($relatedFieldKey.".".$mainTableName, $leftJoineds);
				$newCountKeySearch = array_search($relatedFieldKey.".".$mainTableName, $leftCountJoineds);
	
				
				$keySearch = ($newKeySearch === false) ? $index : $newKeySearch;
	
				
				//****************************************//
				//*****Calculate Left Join Variables******//
				//****************************************//
				$currentRelationShip = null;
				
				$fieldIsMainTable = (count($fieldNameDotExploded) === 1) ? true : false;
				$fieldUsedInFormula = self::relateFieldUsedInFieldFormula($currentValues, $fieldValues, $modulesTables);
				
				$fieldIsVisible = (strtolower($currentValues['visible']) == "yes") ? true : false; 
				$fieldHasFilter = self::fieldHasFilter($filter_values, $currentValues, $fieldIsMainTable, $relatedFieldKey);
				$fieldIsDetailGrouped = ($currentValues['grouping'] != "0") ? true : false;
				
				$fieldHasIndirectUsage = ($fieldHasFilter || $fieldIsDetailGrouped);
				$allowedCountLeftJoin = self::allowedCountLeftJoin($currentValues, $filter_values, $isNonCrmDatabase);

				$doJoin = ( ( (empty($leftJoineds) || ($newKeySearch === false)) && ($fieldIsVisible || $fieldHasIndirectUsage) && !$fieldIsMainTable) || $fieldUsedInFormula );
				$doCountJoin = ( ( (empty($leftCountJoineds) || ($newCountKeySearch === false)) && $allowedCountLeftJoin && !$fieldIsMainTable) || $fieldUsedInFormula );
				

				if ($fieldValues['tables'][0]['data'][$index]['key'] === "id") {
	
					if (count($fieldNameDotExploded) === 2) {
	
						$availableRelationShips = self::getAvailableRelationShips($report_table, $mainTableName, $fieldKey);
						
						if (!empty($availableRelationShips)) {

							//**********************************//
							//******Both Sides Relationship*****//
							//**********************************//
							$currentRelationShip = self::getCurrentRelationShip($availableRelationShips, $searchFieldKeyRelationshipName);
							self::generateNativeRelationShipLeftJoin($sqlJoin, $sqlCountJoin, $sqlFilterTableIndex, $doJoin, $doCountJoin, $currentRelationShip, $fieldValues, $index, ($currentRelationShip['asolRelationShipDirection'] === 'R2L') ? 'rhs_key' : 'lhs_key', $keySearch, $mainTableName, $fieldNameDotExploded);
							self::generateNativeRelationShipLeftJoin2($sqlJoin, $sqlCountJoin, $doJoin, $doCountJoin, $currentRelationShip, $report_table, ($currentRelationShip['asolRelationShipDirection'] === 'R2L') ? 'lhs' : 'rhs' , ($currentRelationShip['asolRelationShipDirection'] === 'R2L') ? 'rhs' : 'lhs',  $keySearch, $fieldNameDotExploded[0]);

						} else {

							//*************************************//
							//******Fields MetaData Searching******//
							//*************************************//
							$availableFieldsMetadata = self::getAvailableFieldsMetadata($report_module);
							$currentRelationShip = self::getCurrentRelationShip($availableFieldsMetadata, $searchFieldKeyRelationshipName);
							self::generateMetadataLeftJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $currentRelationShip, $report_table);
						
						}
						

						if ($setCustomJoin) {
	
							//**********************************//
							//******Custom Table Left Join******//
							//**********************************//
							self::generateCustomTableLeftJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $sqlFilterTableIndex, $fieldValues, $index, $fieldNameDotExploded[0], $tableUnderScoreExploded, $relatedFieldKey, $isLeftJoinedCustom, $isLeftJoinedCountCustom, $mainTableName, $keySearch);

						} else if (!empty($sqlFilterTableIndex[$relatedFieldKey.".".$currentValues['field']])) {
	
							//***********************************************//
							//******Override fieldName Value with Alias******//
							//***********************************************//
							$fieldValues['tables'][0]['data'][$index]['field'] = $fieldNameDotExploded[0].$sqlFilterTableIndex[$relatedFieldKey.".".$currentValues['field']].".".$fieldNameDotExploded[1];

						}
	
					}
	
				} else { //Related field relationship
					
					if (count($fieldNameDotExploded) === 2) {
	
						//****************************************//
						//*****Variable Definition Iteration******//
						//****************************************//
						$relatedFieldsVariables = self::getRelatedFieldsVariables($isNonCrmDatabase, $report_module, $fieldKey, $currentValues);
						
						$tableKey = $relatedFieldsVariables["tableKey"];
						$relatedKey = $relatedFieldsVariables["relatedKey"];
						$relatedTable = $relatedFieldsVariables["relatedTable"];

						
						//***************************//
						//*****Is Related Field******//
						//***************************//
						if (!empty($tableKey)) {
	
							if ($setCustomJoin) { //Custom Table
	
								//****************************************//
								//*****Custom Table Relate Left Join******//
								//****************************************//
								self::generateCustomRelateTableLeftJoin($sqlJoin, $sqlCountJoin, $doCountJoin, $sqlFilterTableIndex, $fieldValues, $index, $isLeftJoinedCustom, $isLeftJoinedCountCustom, $fieldNameDotExploded[0], $tableUnderScoreExploded, $mainTableName, $keySearch, $tableKey, $report_table, $relatedKey, $relatedTable);

							} else { //Not Custom Table
	
								//****************************************//
								//*****Normal Table Relate Left Join******//
								//****************************************//
								self::generateRelateTableLeftJoin($sqlJoin, $sqlCountJoin, $doJoin, $doCountJoin, $sqlFilterTableIndex, $fieldValues, $index, $moduleCustomJoined, $moduleCountCustomJoined, $keySearch, $tableKey, $report_table, $relatedKey, $relatedTable);
	
							}
								
						//*************************************//
						//*****Is Main Table Custom Field******//
						//*************************************//
						} else if ($setCustomJoin && (!$moduleCustomJoined || !$moduleCountCustomJoined)) { //Custom Table
	
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
				$hasLeftJoin = array_search($relatedFieldKey.".".$mainTableName, $leftJoineds);
				if ($hasLeftJoin === false) {
					$leftJoineds[$index] = $relatedFieldKey.".".$mainTableName;
				}
	
				if ($doCountJoin)
					$leftCountJoineds[$index] = $relatedFieldKey.".".$mainTableName;
	
				if ($setCustomJoin) {
					$isLeftJoinedCustom[$relatedFieldKey.".".$mainTableName] = true;
					$isLeftJoinedCountCustom[$relatedFieldKey.".".$mainTableName] = true;
				}
					
				if (isset($currentRelationShip) && isset($relatedFieldKey))
					$relationshipFiltersInfo[$relatedFieldKey.".".$mainTableName] = $currentRelationShip;
				
			}
	

			
			//************************************************************//
			//****Reset Filter Values With Alias Defined on Left Joins****//
			//************************************************************//
			self::resetFilterValuesWithLeftJoinAlias($filter_values, $sqlFilterTableIndex, $relationshipFiltersInfo, $isNonCrmDatabase);
			
			
			//*******************************//
			//***Relation Domain Left Join***//
			//*******************************//
			$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
			$isDomainsInstalled = ($domainsQuery->num_rows > 0);
	
			if ($isDomainsInstalled) {
				
				if ($domainField !== null) {
		
					if ($domainField != "") {
						
						if (isset($domainField["domainRelation"])) {
						
							$domainRelation = $domainField["domainRelation"];
							$domainRelationTableAlias = $domainRelation["relatedTable"].(count($fieldValues['tables'][0]['data']));
							
							$extendedLeftJoin = " LEFT JOIN ".$domainRelation["relatedTable"]." ".$domainRelationTableAlias." ON ".$report_table.".".$domainRelation["linkField"]."=".$domainRelationTableAlias.".".$domainRelation["relatedKey"]." "; 
							$sqlJoin .= $extendedLeftJoin;
							$sqlCountJoin .= $extendedLeftJoin;
							
							$domainField["domainRelation"]["relatedTable"] = $domainRelationTableAlias;
					 
						}
						
					}
				
				}
				
			}
			
	
			//**************************************//
			//****Define Returned Function Array****//
			//**************************************//
			$returnedLeftJoinArray = array (
				"moduleCustomJoined" => $moduleCustomJoined,
				"moduleCountCustomJoined" => $moduleCountCustomJoined,
				"leftJoineds" => $leftJoineds,
				"querys" => array (
					"Join" => $sqlJoin,
					"CountJoin" => $sqlCountJoin,
				),
			);
	
		}
	
		return $returnedLeftJoinArray;
	
	}
	
	
	static private function getRelatedFieldsVariables($isNonCrmDatabase, $reportModule, $fieldKey, $fieldValue) {
		
		global $beanList, $beanFiles;
		
		if ($isNonCrmDatabase) {
	
			$tmpField = explode(".", $fieldValue['field']);
			$tmpKey = explode(" ", $fieldValue['key']);

			$tableKey = $tmpKey[0];
			$relatedModule = $tmpField[0];
			$relatedTable = $relatedModule;
			$relatedKey = $tmpKey[1];
			
		} else {

			$tmpKey = explode(" ", $fieldValue['key']);
			
			$className = $beanList[$reportModule];
			require_once($beanFiles[$className]);
			$bean = new $className();

			$relatedInfo = asol_Report::getReportsRelatedFields($bean);

			$tmpField = explode(".", $fieldKey);
			$tmpField = (count($tmpField) == 2) ? $tmpField[1] : $fieldKey;

			$tableKey = $fieldKey;
			$relatedModule = "";
			$relatedTable = "";
			$relatedKey = "id";

			foreach ($relatedInfo as $info){

				if ($info['id_name'] == $tmpField){

					$relatedModule = $info['module'];
					$relatedTable = strtolower($relatedModule);
					break;

				}

			}

		}
		
		return array(
			"tableKey" => $tableKey,
			"relatedKey" => $relatedKey,
			"relatedTable" => $relatedTable
		);
		
	}
	
	static private function getAvailableRelationShips($report_table, $auxTableName, $fieldKey) {
		
		global $db;
		
		$availableRelationShips = array();
		
		$relationships_R2L = "SELECT DISTINCT relationship_name, lhs_table, lhs_key, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs FROM relationships WHERE rhs_table='".$report_table."' AND lhs_table='".strtolower($auxTableName)."' AND rhs_key='".$fieldKey."'";
		$relationships_R2L_Query = $db->query($relationships_R2L);
		
		if ($relationships_R2L_Query->num_rows > 0) {
			while ($relationship_R2L = $db->fetchByAssoc($relationships_R2L_Query)) {
				$relationship_R2L['asolRelationShipDirection'] = 'R2L';
				$availableRelationShips[] = $relationship_R2L;
			}
		}
		
		$relationships_L2R = "SELECT DISTINCT relationship_name, lhs_table, lhs_key, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs FROM relationships WHERE lhs_table='".$report_table."' AND rhs_table='".strtolower($auxTableName)."' AND lhs_key='".$fieldKey."'";
		$relationships_L2R_Query = $db->query($relationships_L2R);
		
		if ($relationships_L2R_Query->num_rows > 0) {
			while ($relationship_L2R = $db->fetchByAssoc($relationships_L2R_Query)) {
				$relationship_L2R['asolRelationShipDirection'] = 'L2R';
				$availableRelationShips[] = $relationship_L2R;
			}
		}
		
		return $availableRelationShips;
		
	}
	
	static private function getAvailableFieldsMetadata($report_module) {
		
		global $db;
		
		$availableFieldsMetadata = array();
		
		$relationships_FMD = "SELECT DISTINCT name, type, ext2, ext3 FROM fields_meta_data WHERE custom_module='".$report_module."' AND type IN ('relate')";
		$relationships_FMD_Query = $db->query($relationships_FMD);
	
		if ($relationships_FMD_Query->num_rows > 0) {
			while ($relationship_FMD = $db->fetchByAssoc($relationships_FMD_Query)) {
				$availableFieldsMetadata[] = $relationship_FMD;
			}
		}
		
		return $availableFieldsMetadata;
		
	}
	
	static private function getCurrentRelationShip($availableRelationShips, $searchFieldKeyRelationshipName) {
	
		$currentRelationShip = null;
		
		foreach ($availableRelationShips as $availableRelationShip) {
			$currentRelationShip = $availableRelationShip;
			if ($currentRelationShip['relationship_name'] == $searchFieldKeyRelationshipName)
				break;
		}
	
		return $currentRelationShip;
	
	}
	
	static private function manageAuditSqlJoin(& $fieldValues, & $filter_values, $report_table) {
			
		$sqlJoin = " LEFT JOIN ".$report_table." ON ".$report_table."_audit.parent_id=".$report_table.".id ";
		$sqlCountJoin = "";
		$moduleCustomJoined = false;
		$created_by_leftjoin = false;
	
		foreach ($fieldValues['tables'][0]['data'] as $key=>$currentValues) {
				
			if (!empty($currentValues['key'])) {
	
				if (($currentValues['key'] == 'created_by') && (!$created_by_leftjoin)) {
					$sqlJoin .= " LEFT JOIN users ON ".$report_table."_audit.created_by=users.id ";
					$created_by_leftjoin = true;
				}
	
			}
				
			$fieldValues['tables'][0]['data'][$key]['field'] = (count(explode(".", $currentValues['field'])) > 1) ? $currentValues['field'] : $report_table."_audit.".$currentValues['field'];
				
		}
	
		foreach($filter_values as &$one_filter) {
	
			$fieldFilter = explode(".", $one_filter['field']);
			$one_filter['field'] = (count($fieldFilter) > 1) ? $one_filter['field'] : $report_table."_audit.".$one_filter['field'];
	
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
	
	static private function generateNativeRelationShipLeftJoin(& $sqlJoin, & $sqlCountJoin, & $sqlFilterTableIndex, $doJoin, $doCountJoin, $currentRelationShip, & $fieldValues, $i, $keySide, $keyAliasSearch, $moduleName, $fieldName) {

		if (!empty($currentRelationShip['join_table'])) {
	
			if ($doJoin)
				$sqlJoin .= " LEFT JOIN ".$currentRelationShip['join_table']." ".$currentRelationShip['join_table'].$keyAliasSearch." ON ";
	
			if ($doCountJoin)
				$sqlCountJoin .= " LEFT JOIN ".$currentRelationShip['join_table']." ".$currentRelationShip['join_table'].$keyAliasSearch." ON ";
	
		} else {
	
			if ($doJoin)
				$sqlJoin .= " LEFT JOIN ".strtolower($moduleName)." ".strtolower($moduleName).$keyAliasSearch." ON ";
	
			if ($doCountJoin)
				$sqlCountJoin .= " LEFT JOIN ".strtolower($moduleName)." ".strtolower($moduleName).$keyAliasSearch." ON ";
	
		}
		
		//Modificamos el nombre del campo para los siguientes usos
		$linkedTableArray = explode('.', $fieldValues['tables'][0]['data'][$i]['field']);
		$sqlFilterTableIndex[$currentRelationShip[$keySide]." ".$currentRelationShip['relationship_name'].".".$linkedTableArray[0]] = $keyAliasSearch;
		$fieldValues['tables'][0]['data'][$i]['field'] = $fieldName[0].$keyAliasSearch.".".$fieldName[1];
	
	}
	
	static private function generateNativeRelationShipLeftJoin2(& $sqlJoin, & $sqlCountJoin, $doJoin, $doCountJoin, $currentRelationShip, $report_table, $leftSide, $rightSide, $keyAliasSearch, $moduleName) {
			
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
					$sqlJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".deleted=0) ";
				else
					$sqlJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$leftSide.'_table'].".deleted=0) ";
	
			}
				
			if ($doCountJoin) {
	
				if ($report_table != strtolower($moduleName))
					$sqlCountJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$leftSide.'_table'].$keyAliasSearch.".deleted=0) ";
				else
					$sqlCountJoin .= "(".$currentRelationShip[$rightSide.'_table'].".".$currentRelationShip[$rightSide.'_key']."=".$currentRelationShip[$leftSide.'_table'].".".$currentRelationShip[$leftSide.'_key']." AND ".$currentRelationShip[$leftSide.'_table'].".deleted=0) ";
	
			}
				
		}
	
	}
		
	static private function resetFilterValuesWithLeftJoinAlias(&$filter_values, $sqlFilterTableIndex, $relationshipInfo, $isNonCrmDatabase) {
		
		foreach($filter_values as &$one_filter) {
	
			if ($one_filter['isRelated']) {
				
				$filterName = $one_filter['field'];
				$filterKey = $one_filter['relationKey'];

				$fieldFilter = explode(".", $filterName);
				$keyFilter = explode(" ", $filterKey);
	
				if ($isNonCrmDatabase)
					$relationshipName = $keyFilter[0];
				else
					$relationshipName = (isset($relationshipInfo[$filterKey.".".$fieldFilter[0]]['relationship_name'])) ? $keyFilter[0]." ".$relationshipInfo[$filterKey.".".$fieldFilter[0]]['relationship_name'] : $filterKey;

				$one_filter['field'] = (count($fieldFilter) > 1) ? $fieldFilter[0].$sqlFilterTableIndex[$relationshipName.".".$fieldFilter[0]].".".$fieldFilter[1] : $filterName;
				
			}
			
		}
	
	}
	
	static private function fieldHasFilter($filter_values, $fieldInfo, $fieldIsMainTable, $relatedFieldKey) {
	
		foreach ($filter_values as $filter) {
			
			//If related AND input name and key are the same
			if (!$fieldIsMainTable && ($filter['field'] === $fieldInfo['field']) && ($filter['relationKey'] === $relatedFieldKey)) {
				return true;
			}
	
		}
	
		return false;
	
	}
	
	static private function generateMetadataLeftJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, $currentRelationShip, $report_table) {
	
		$sqlJoin .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".id=".$report_table."_cstm.id_c LEFT JOIN ".strtolower($currentRelationShip['ext2'])." ON ".$report_table."_cstm.".$currentRelationShip['ext3']."=".strtolower($currentRelationShip['ext2']).".id";
	
		if ($doCountJoin)
		$sqlCountJoin .= " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".id=".$report_table."_cstm.id_c LEFT JOIN ".strtolower($currentRelationShip['ext2'])." ON ".$report_table."_cstm.".$currentRelationShip['ext3']."=".strtolower($currentRelationShip['ext2']).".id";
	
	}
	
	static private function generateCustomTableLeftJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, & $sqlFilterTableIndex, & $fieldValues, $i, $auxCustomTableName, $tableUnderScoreExploded, $searchFieldKey, $isLeftJoinedCustom, $isLeftJoinedCountCustom, $auxTableName, $keySearch) {

		$myIndex = "";
		$emptyIndex = true;
		
		$isCustomTable = (end(explode('_', $auxCustomTableName)) == 'cstm');
		$auxCustomTableName = ($isCustomTable) ? $auxCustomTableName : $auxCustomTableName.'_cstm';
		$slicedTable = count($tableUnderScoreExploded == 1) ? $tableUnderScoreExploded[0] : implode('_', array_slice($tableUnderScoreExploded, 0, count($tableUnderScoreExploded)-1));

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
			$sqlFilterTableIndex[$fieldValues['tables'][0]['data'][$i]['key'].".".$slicedTable] = $myIndex;
		}

		if ($doJoin && (!$isLeftJoinedCustom[$searchFieldKey.".".$auxTableName]))
			$sqlJoin .= " LEFT JOIN ".$auxCustomTableName." ".$auxCustomTableName.$myIndex." ON ".$auxCustomTableName.$myIndex.".id_c=".$slicedTable.$myIndex.".id ";
	
		if ($doCountJoin && (!$isLeftJoinedCountCustom[$searchFieldKey.".".$auxTableName]))
			$sqlCountJoin .= " LEFT JOIN ".$auxCustomTableName." ".$auxCustomTableName.$myIndex." ON ".$auxCustomTableName.$myIndex.".id_c=".$slicedTable.$myIndex.".id ";
	
	
		$sqlFilterTableIndex[$searchFieldKey.".".$auxTableName.'_cstm'] = $keySearch;
		
		if ($isCustomTable) {
			$auxField = explode(".", $fieldValues['tables'][0]['data'][$i]['field']);
			$fieldValues['tables'][0]['data'][$i]['field'] = $auxCustomTableName.$myIndex.".".$auxField[1];
		}
		
	}
	
	static private function generateCustomRelateTableLeftJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, & $sqlFilterTableIndex, & $fieldValues, $i, $isLeftJoinedCustom, $isLeftJoinedCountCustom, $aux0, $aux2, $auxTableName, $myIndex, $tableKey, $report_table, $relatedKey, $relatedTable) {
	
		if (empty($sqlJoin))
			$sqlJoin .= " LEFT JOIN ".$relatedTable." ".$relatedTable.$myIndex." ON ".$report_table.".".$tableKey."=".$relatedTable.$myIndex.".".$relatedKey." ";
	
		if (($doCountJoin) && (empty($sqlCountJoin)))
			$sqlCountJoin .= " LEFT JOIN ".$relatedTable." ".$relatedTable.$myIndex." ON ".$report_table.".".$tableKey."=".$relatedTable.$myIndex.".".$relatedKey." ";
	
		if (!$isLeftJoinedCustom[$tableKey.".".$auxTableName])
			$sqlJoin .= " LEFT JOIN ".$aux0." ".$aux0.$myIndex." ON ".$aux0.$myIndex.".id_c=".implode('_', array_slice($aux2, 0, count($aux2)-1)).$myIndex.".".$relatedKey." ";
		
		if (!$isLeftJoinedCountCustom[$tableKey.".".$auxTableName])
			$sqlCountJoin .= " LEFT JOIN ".$aux0." ".$aux0.$myIndex." ON ".$aux0.$myIndex.".id_c=".implode('_', array_slice($aux2, 0, count($aux2)-1)).$myIndex.".".$relatedKey." ";
	

		$auxField = explode(".", $fieldValues['tables'][0]['data'][$i]['field']);
		$sqlFilterTableIndex[$tableKey.".".$auxField[0]] = $myIndex;
		$fieldValues['tables'][0]['data'][$i]['field'] = $aux0.$myIndex.".".$auxField[1];
	
	}

	static private function generateRelateTableLeftJoin(& $sqlJoin, & $sqlCountJoin, $doJoin, $doCountJoin, & $sqlFilterTableIndex, & $fieldValues, $i, & $moduleCustomJoined, & $moduleCountCustomJoined, $myIndex, $tableKey, $report_table, $relatedKey, $relatedTable) {
	
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
			
	
		$auxField = explode(".", $fieldValues['tables'][0]['data'][$i]['field']);
		$sqlFilterTableIndex[$tableKey.".".$auxField[0]] = $myIndex;
		$fieldValues['tables'][0]['data'][$i]['field'] = $relatedTable.$myIndex.".".$auxField[1];
	
	}
	
	static private function generateCustomJoin(& $sqlJoin, & $sqlCountJoin, $doCountJoin, & $moduleCustomJoined, & $moduleCountCustomJoined, $report_table) {
			
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
	
	static private function updateMySqlFunctionField($myFunction, $aggregatedFunction, & $selectedField) {
		
		$fieldFunctionSelfReference = explode('${this}', $myFunction);
		
		if ($aggregatedFunction == null) {
		
			if (count($fieldFunctionSelfReference) <= 1) {
								
				$selectedField = "(".$selectedField.")".$myFunction;
				
			} else {
					
				$selectedField = "(".implode($selectedField, $fieldFunctionSelfReference).")";
					
			}
			
		} else {
	
			if (count($fieldFunctionSelfReference) <= 1) {
		
				$selectedField = $selectedField;
			
			} else {
				
				$selectedField = implode($aggregatedFunction."(".$selectedField.")", $fieldFunctionSelfReference);
		
			}
		
		}
		
		return (count($fieldFunctionSelfReference) <= 1);
		
	}
	
	
	static public function getSqlSelectQuery(& $fieldValues, & $chartInfo, $report_table, $hourOffset, $quarter_month, $week_start, $audited_report, $leftJoineds = array()) {
	
		//OBTENEMOS LA CAUSULA "SELECT" con sus ALIAS
		$sqlSelect = "SELECT ";
		$columns = array();
	
		$hasGrouped = false;
		$hasFunctionWithSQL = false;
		$customFields = false;
		
		$groupSubTotalField = null;
		$groupSubTotalFieldAscSort = null;
	
		
		$sqlTotals = "SELECT ";
		$sqlTotalsC = "SELECT ";
		$totals = array();
	
		//CREAR Y USAR SUBLISTA CON LOS CAMPOS QUE IR?N EN EL RESULSET UNICAMENTE
		$resulsetFields = array();
		$processedChartFields = array();
	
		
		foreach ($fieldValues['tables'][0]['data'] as $i=>$currentValues) {

			if (($currentValues['function'] != "0") && (!empty($sqlFunction)))
				$hasFunctionWithSQL = true;
			
			$tmpField = explode(".", $currentValues['field']);	
			if ($tmpField[0] == $report_table."_cstm")
				$customFields = true;
				
			$hasGrouped = (($hasGrouped) || (in_array($currentValues['grouping'], array('Grouped', 'Day Grouped', 'DoW Grouped', 'WoY Grouped', 'Month Grouped', 'Natural Quarter Grouped', 'Fiscal Quarter Grouped', 'Natural Year Grouped', 'Fiscal Year Grouped'))));
			
		}
		
		foreach ($fieldValues['tables'][0]['data'] as $i=>$currentValues) {
	
			$sqlFunction = self::replace_reports_vars($currentValues['sql'], $report_table, $leftJoineds, $audited_report);

			if (!$audited_report)
				$table = ((count(explode(".", $currentValues['field']))) == 1 ) ? $report_table."." : "";
			else
				$table = ((count(explode(".", $currentValues['field']))) == 1 ) ? $report_table."_audit." : "";
			
			$fieldValues['tables'][0]['data'][$i]['chartOriginalFieldName'] = $currentValues['field'];
			$fieldValues['tables'][0]['data'][$i]['field'] = $table.$currentValues['field'];
			
			if ($currentValues['grouping'] !== '0') {
				
				switch ($currentValues['grouping']) {

					case "Detail":
					case "Grouped":
						$whereFunction = null;
						break;
					
					case "Day Detail":
					case "Day Grouped":
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						else
							$whereFunction = 'DATE(${this})';
						break;
						
					case "DoW Detail":
					case "DoW Grouped":
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'WEEKDAY(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						else
							$whereFunction = 'WEEKDAY(${this})';
						break;
						
					case "WoY Detail":
					case "WoY Grouped":
						$weekStartsOn = ($week_start == '0') ? 2 : 7;

						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'CONCAT(YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)), WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.'))';
						else
							$whereFunction = 'CONCAT(YEAR(${this}), WEEK(${this}, '.$weekStartsOn.'))';
						break;
						
					case "Month Detail":
					case "Month Grouped":
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'EXTRACT(YEAR_MONTH FROM DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						else
							$whereFunction = 'EXTRACT(YEAR_MONTH FROM ${this})';
						break;
						
					case "Natural Quarter Detail":
					case "Natural Quarter Grouped":
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'CONCAT(YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)), QUARTER(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND)))';
						else
							$whereFunction = 'CONCAT(YEAR(${this}), QUARTER(${this}))';
						break;
						
					case "Fiscal Quarter Detail":
					case "Fiscal Quarter Grouped":
						$quarterMonth = (empty($quarter_month)) ? 0 : 12 - (intval($quarter_month) - 1);
						
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'CONCAT(YEAR(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH)), QUARTER(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH)))';
						else
							$whereFunction = 'CONCAT(YEAR(DATE_ADD(${this}, INTERVAL '.$quarterMonth.' MONTH)), QUARTER(DATE_ADD(${this}, INTERVAL '.$quarterMonth.' MONTH)))';
						break;
				
					case "Natural Year Detail":
					case "Natural Year Grouped":
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						else
							$whereFunction = 'YEAR(${this})';
						break;
						
					case "Fiscal Year Detail":
					case "Fiscal Year Grouped":
						$quarterMonth = (empty($quarter_month)) ? 0 : 12 - (intval($quarter_month) - 1);
						
						if (($currentValues['type'] == 'datetime') && ($hourOffset != 0))
							$whereFunction = '(YEAR(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH)) - 1)';
						else
							$whereFunction = '(YEAR(DATE_ADD(${this}, INTERVAL '.$quarterMonth.' MONTH)) - 1)';
						break;
						
				}

				if ($whereFunction !== null)
					self::updateMySqlFunctionField($whereFunction, null, $fieldValues['tables'][0]['data'][$i]['field']);
				
			}

	
			//****************************************//
			//***Fields Without Aggreagted Function***//
			//****************************************//
			if (in_array($currentValues['function'], array("0", "undefined"))) {
	
				if (!empty($sqlFunction)) { //ASOL CALCULATED
	
					self::updateMySqlFunctionField($sqlFunction, null, $fieldValues['tables'][0]['data'][$i]['field']);
					if (strtolower($currentValues['visible']) == "yes")
						$sqlSelect .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$currentValues['alias']."',";
						
				} else {
	
					if (strtolower($currentValues['visible']) == "yes")
						$sqlSelect .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$currentValues['alias']."',";
						
				}
					
				if (strtolower($currentValues['visible']) == "yes") {
						
					$columns[] = $currentValues['alias'];
					$columnsO[] = $fieldValues['tables'][0]['data'][$i]['chartOriginalFieldName'];
					$resulsetFields[] = $fieldValues['tables'][0]['data'][$i];
						
				}
	
			//*************************************//
			//***Fields With Aggregated Function***//
			//*************************************//
			} else {
	
				if ($groupSubTotalField == null) {
					$groupSubTotalField = $currentValues['alias'];
					$groupSubTotalFieldAscSort = $currentValues['sortDirection'];
				}

				$fieldValues['tables'][0]['data'][$i]['field'] = $currentValues['function']."(".$fieldValues['tables'][0]['data'][$i]['field'].")";
				
				if (!empty($sqlFunction)) { //ASOL CALCULATED
	
					self::updateMySqlFunctionField($sqlFunction, null, $fieldValues['tables'][0]['data'][$i]['field']);
					if (strtolower($currentValues['visible']) == "yes") {
						if ($hasGrouped) {
							$sqlSelect .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$currentValues['alias']."',";
						}
						$sqlTotals .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$currentValues['alias']."',";
					}
						
				} else {

					if (strtolower($currentValues['visible']) == "yes") {
						if ($hasGrouped) {
							$sqlSelect .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$currentValues['alias']."',";
						}
						$sqlTotals .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$currentValues['alias']."',";
					}
						
				}
					
				if (strtolower($currentValues['visible']) == "yes") {
						
					if ($hasGrouped) {
						$columns[] = $currentValues['alias'];
						$columnsO[] = $fieldValues['tables'][0]['data'][$i]['chartOriginalFieldName'];
					}
					$totals[] = $fieldValues['tables'][0]['data'][$i];
					$resulsetFields[] = $fieldValues['tables'][0]['data'][$i];
						
				}
	
			}
	
			//Check if chart is displayable on Charts Div
			$availableCharts = array();
			
			foreach ($chartInfo as $cKey=>$cInfoData) {
	
				$fInfoData = $fieldValues['tables'][0]['data'][$i];
				
				if ($audited_report) {
					$cInfoData['field'] = (count(explode(".", $cInfoData['field'])) > 1) ? $cInfoData['field'] : $report_table."_audit.".$cInfoData['field'];
				}
					
				$isCurrentChart = (($fInfoData['notModifiedFieldName'] == $cInfoData['field']) && ($fInfoData['index'] == $cInfoData['index']));
				$isCurrentZChart = (($fInfoData['notModifiedFieldName'] == $cInfoData['zAxis']) && ($fInfoData['index'] == $cInfoData['zIndex']));

				if (($cInfoData['display'] == 'yes') && ($isCurrentChart || $isCurrentZChart)) {
					
					$availableCharts[] = array(
						'displayable' => true,
						'alias' => $cInfoData['label'].($isCurrentZChart ? '_z' : '')
					);

				}
				
				foreach ($cInfoData['subcharts'] as $subChartKey=>$subChartValues) {
					
					$subChartData = $subChartValues['data'];
					
					if ($audited_report) {
						$subChartData['field'] = (count(explode(".", $subChartData['field'])) > 1) ? $subChartData['field'] : $report_table."_audit.".$subChartData['field'];
					}
						
					$isCurrentChart = (($fInfoData['notModifiedFieldName'] == $subChartData['field']) && ($fInfoData['index'] == $subChartData['index']));
					$isCurrentZChart = (($fInfoData['notModifiedFieldName'] == $subChartData['zAxis']) && ($fInfoData['index'] == $subChartData['zIndex']));
					if (($subChartData['display'] == 'yes') && ($isCurrentChart || $isCurrentZChart)) {
						
						$availableCharts[] = array(
							'displayable' => true,
							'alias' => $cInfoData['label'].'_'.$subChartKey.($isCurrentZChart ? '_z' : '')
						);
	
					}

				}
	
			}
			
			
			foreach ($availableCharts as $availableChart) {
			
				if ($availableChart['displayable']) {
				
					if (in_array($availableChart['alias'], $processedChartFields))
						continue;
					
					if (!empty($sqlFunction)) { //ASOL CALCULATED
		
						if (self::updateMySqlFunctionField($sqlFunction, ($currentValues['function'] === '0' ? null : $currentValues['function']), $fieldValues['tables'][0]['data'][$i]['chartOriginalFieldName']))
							$sqlTotalsC .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$availableChart['alias']."',";
						else
							$sqlTotalsC .= $fieldValues['tables'][0]['data'][$i]['chartOriginalFieldName']." AS '".$availableChart['alias']."',";
		
					} else {
		
						$sqlTotalsC .= $fieldValues['tables'][0]['data'][$i]['field']." AS '".$availableChart['alias']."',";
							
					}
					
					$processedChartFields[] = $availableChart['alias'];
	
				}
				
			}
			//Check if chart is displayable on Charts Div
				
	
		}

		if (($hasGrouped) && (count($totals) === 0)) {

			$sqlSelect = $sqlSelect." COUNT(*) AS 'TOTAL',";
			$columns[] = 'TOTAL';
			$columnsO[] = null;

		}
	
		
		$sqlSelect = substr($sqlSelect, 0, -1);
		$sqlTotals = substr($sqlTotals, 0, -1);
		$sqlTotalsC = substr($sqlTotalsC, 0, -1);

		
		$returnedArray = Array (
			"customFields" => $customFields,
			"columns" => $columns,
			"columnsO" => $columnsO,
			"totals" => $totals,
			"groupSubTotalField" => $groupSubTotalField,
			"groupSubTotalFieldAscSort" => $groupSubTotalFieldAscSort,
			"hasGrouped" => $hasGrouped,
			"hasFunctionWithSQL" => $hasFunctionWithSQL,
			"resultsetFields" => $resulsetFields,
			"querys" => Array (
				"Select" => $sqlSelect,
				"Totals" => $sqlTotals,
				"Charts" => $sqlTotalsC,
			),
		);

		return $returnedArray;
	
	}
	
	
	static public function getSqlFromQuery($report_table, $custom_fields, $audited_report) {
	
		$sqlFrom = (!$audited_report) ? " FROM ".$report_table : " FROM ".$report_table."_audit";
		$sqlJoinExt = null;
		
		//añadimos un left join para los custom fields no related
		if ($custom_fields == "true") {
			$sqlJoinExt = " LEFT JOIN ".$report_table."_cstm ON ".$report_table.".id=".$report_table."_cstm.id_c ";
		}
	
		return array(
			'from' => $sqlFrom,
			'joinExt' => $sqlJoinExt
		);
	
	}
	
	static public function getSqlWhereQuery($filterValues, $fieldValues, $report_table, $hourOffset, $quarter_month, $week_start, $isNonCrmDatabase) {
	
		if (!$isNonCrmDatabase)
			$sqlWhere = " WHERE ".$report_table.".deleted = 0 AND ";
		else
			$sqlWhere = (count($filterValues) != 0) ? " WHERE " : "";
	
	
		if (!empty($filterValues)) {

			$sqlWhere .= "( ";
			
			foreach($filterValues as &$filter) {
	
				self::modifyFilteringValues($filter, $quarter_month, $week_start, $report_table, $hourOffset, $operator1, $operator2);			
				self::generateSqlWhere($filter, $fieldValues, $operator1, $operator2, $sqlWhere);
	
			}
	
			$sqlWhere = substr($sqlWhere, 0, -4)." )";
			
		} else {
			
			$sqlWhere = substr($sqlWhere, 0, -4);
			
		}
	
		return $sqlWhere;
	
	}

	static private function modifyFilteringValues(& $filter, $quarter_month, $week_start, $report_table, $hourOffset, & $operator1, & $operator2) {
	
		global $current_user, $timedate;
		
		//Añadir tabla y . si campos son de la tabla principal
		$filter['field'] = ((count(explode(".", $filter['field']))) == 1 ) ? $report_table.".".$filter['field'] : $filter['field'];
		//Añadir tabla y . si campos son de la tabla principal
		
		$operator1 = ($filter['operator'] == "equals") ? "=" : "!=";
		$operator2 = "";
	
		//If timestamp do not apply TimeZone OffSet
		if (in_array($filter['type'], array("date", "timestamp")))
			$hourOffset = 0;
			
		switch ($filter['operator']) {
	
			case "equals":
			case "not equals":
				
				if (in_array($filter['type'], array("date", "datetime", "timestamp"))) {
	
					switch ($filter['parameters']['first'][0]) {
						
						case "calendar":
	
							$operator1 = ($filter['operator'] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$filter['parameters']['first'] = $filter['parameters']['second'];
							
							$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
	
						case "dayofweek":
	
							$operator1 = ($filter['operator'] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter['parameters']['first'] = $filter['parameters']['second'];
							
							$whereFunction = 'WEEKDAY(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "weekofyear":
	
							$operator1 = ($filter['operator'] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$filter['parameters']['first'] = $filter['parameters']['second'];
							$weekStartsOn = ($week_start == '0') ? 2 : 7;
							$whereFunction = 'WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.')';
							break;
							
						case "monthofyear":
	
							$operator1 = ($filter['operator'] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter['parameters']['first'] = $filter['parameters']['second'];
							
							$whereFunction = 'MONTH(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "naturalquarterofyear":
	
							$operator1 = ($filter['operator'] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$filter['parameters']['first'] = $filter['parameters']['second'];
							
							$whereFunction = 'QUARTER(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "fiscalquarterofyear":
							
							$operator1 = ($filter['operator'] == "equals") ? "IN" : "NOT IN";
							$operator2 = "";
							
							$quarterMonth = (empty($quarter_month)) ? 0 : 12 - (intval($quarter_month) - 1);
							
							$filter['parameters']['first'] = $filter['parameters']['second'];

							$whereFunction = 'QUARTER(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH))';
							break;
							
						case "naturalyear":
							
							$operator1 = ($filter['operator'] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$filter['parameters']['first'] = (!empty($filter['parameters']['second'][0])) ? $filter['parameters']['second'] : array(date("Y"));
							$filter['parameters']['second'] = array();
							
							$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
							break;
							
						case "fiscalyear":
							
							$operator1 = ($filter['operator'] == "equals") ? "=" : "!=";
							$operator2 = "";
							
							$quarterMonth = (empty($quarter_month)) ? 0 : 12 - (intval($quarter_month) - 1);
							
							$filter['parameters']['first'] = (!empty($filter['parameters']['second'][0])) ? $filter['parameters']['second'] : array(date("Y"));
							$filter['parameters']['second'] = array();
							
							$whereFunction = '(YEAR(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH)) - 1)';
							break;
							
					}
					
					self::updateMySqlFunctionField($whereFunction, null, $filter['field']);
	
				} else if (in_array($filter['type'], array("bool"))) {
					
					$filter['parameters']['first'][0] = ($filter['parameters']['first'][0] == "true") ? "1" : "0"; 
	
				}
					
				break;
	
			case "like":
			case "not like":
				$operator1 = ($filter['operator'] == "like") ? "LIKE" : "NOT LIKE";
				$operator2 = "";
				$filter['parameters']['first'][0] = "%".$filter['parameters']['first'][0]."%";
				break;
				
			case "my items":
				$operator1 = "=";
				$operator2 = "";
				$filter['parameters']['first'][0] = (!empty($filter['parameters']['first'][0])) ? $filter['parameters']['first'][0] : $current_user->id;
				break;
	
			case "after date":
			case "before date":
				
				switch ($filter['parameters']['first'][0]) {
					
					case "calendar":
						$operator1 = ($filter['operator'] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$filter['parameters']['first'] = $filter['parameters']['second'];
							
						$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
					
					case "weekofyear":
	
						$operator1 = ($filter['operator'] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$filter['parameters']['first'] = $filter['parameters']['second'];
						$weekStartsOn = ($week_start == '0') ? 2 : 7;
						$whereFunction = 'WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.')';
						break;
						
					case "naturalyear":
							
						$operator1 = ($filter['operator'] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$filter['parameters']['first'] = (!empty($filter['parameters']['second'][0])) ? $filter['parameters']['second'] : array(date("Y"));
						$filter['parameters']['second'] = array();
						
						$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
							
					case "fiscalyear":
							
						$operator1 = ($filter['operator'] == "after date") ? ">" : "<";
						$operator2 = "";
						
						$quarterMonth = (empty($quarter_month)) ? 0 : 12 - (intval($quarter_month) - 1);
							
						$filter['parameters']['first'] = (!empty($filter['parameters']['second'][0])) ? $filter['parameters']['second'] : array(date("Y"));
						$filter['parameters']['second'] = array();
							
						$whereFunction = '(YEAR(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH)) - 1)';
						break;
						
				}
				
				self::updateMySqlFunctionField($whereFunction, null, $filter['field']);
	
				break;
		
			case "more than":
				$operator1 = ">";
				$operator2 = "";
	
				if (in_array($filter['type'], array("datetime", "timestamp"))) {
					$date1 = explode("-", $filter['parameters']['first'][0]);
					$filter['parameters']['first'][0] = date("Y-m-d H:59:59", @mktime(0,59,59,$date1[1],$date1[2],$date1[0])+(24*3600)-(3600)+$hourOffset);
				}
	
				break;
	
			case "less than":
				$operator1 = "<";
				$operator2 = "";
	
				if (in_array($filter['type'], array("datetime", "timestamp"))) {
					$date1 = explode("-", $filter['parameters']['first'][0]);
					$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$date1[1],$date1[2],$date1[0])+$hourOffset);
				}
	
				break;
	
			case "between":
			case "not between":
				$operator1 = ($filter['operator'] == "between") ? "BETWEEN" : "NOT BETWEEN";
				$operator2 = "AND";
				
				switch ($filter['parameters']['first'][0]) {
					
					case "calendar":
						
						$filter['parameters']['first'] = $filter['parameters']['second'];
						$filter['parameters']['second'] = $filter['parameters']['third'];
						
						if((!$timedate->check_matching_format($filter['parameters']['first'][0], $GLOBALS['timedate']->dbDayFormat)) && ($filter['parameters']['first'][0] != ""))
							$filter['parameters']['first'][0] = $timedate->swap_formats($filter['parameters']['first'][0], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
						
						if((!$timedate->check_matching_format($filter['parameters']['second'][0], $GLOBALS['timedate']->dbDayFormat)) && ($filter['parameters']['second'][0] != ""))
							$filter['parameters']['second'][0] = $timedate->swap_formats($filter['parameters']['second'][0], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
						
						$whereFunction = 'DATE(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
						
						
					case "weekofyear":
						
						$filter['parameters']['first'] = $filter['parameters']['second'];
						$filter['parameters']['second'] = $filter['parameters']['third'];
						
						$weekStartsOn = ($week_start == '0') ? 2 : 7;
						$whereFunction = 'WEEK(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), '.$weekStartsOn.')';
						break;
						
					case "naturalyear":

						$filter['parameters']['first'] = (!empty($filter['parameters']['second'][0]) ? $filter['parameters']['second'] : array(date("Y")));
						$filter['parameters']['second'] = (!empty($filter['parameters']['third'][0]) ? $filter['parameters']['third'] : array(date("Y")));
						
						$whereFunction = 'YEAR(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND))';
						break;
						
					case "fiscalyear":

						$quarterMonth = (empty($quarter_month)) ? 0 : 12 - (intval($quarter_month) - 1);
							
						$filter['parameters']['first'] = (!empty($filter['parameters']['second'][0]) ? $filter['parameters']['second'] : array(date("Y")));
						$filter['parameters']['second'] = (!empty($filter['parameters']['third'][0]) ? $filter['parameters']['third'] : array(date("Y")));
							
						$whereFunction = '(YEAR(DATE_ADD(DATE_ADD(${this}, INTERVAL '.($hourOffset*-1).' SECOND), INTERVAL '.$quarterMonth.' MONTH)) - 1)';
						break;
					
				}
				
				self::updateMySqlFunctionField($whereFunction, null, $filter['field']);
	
				break;
	
			case "one of":
			case "not one of":
				$operator1 = ($filter['operator'] == "one of") ? "IN" : "NOT IN";
				$operator2 = "";
				break;
	
			case "last":
				switch ($filter['parameters']['first'][0]) {
	
					case "day":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(($filter['parameters']['second'][0])*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()-(24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", time()-($filter['parameters']['second'][0])*24*3600);
							$filter['parameters']['second'][0] = date("Y-m-d", time()-(24*3600));
						}
						break;
	
					case "week":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter['parameters']['second'][0]-1)*7*24*3600))-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))-7)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter['parameters']['second'][0]-1)*7*24*3600)));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))-7)*24*3600);
						}
						break;
	
					case "month":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$monthsDate = @mktime(0,0,0,date("m")-($filter['parameters']['second'][0]),1,date("Y"));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $monthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()-($diaMes+1)*24*3600+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $monthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", time()-($diaMes+1)*24*3600);
						}
						break;
	
					case "Fquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")-$filter['parameters']['second'][0])+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")-$filter['parameters']['second'][0]));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")-($filter['parameters']['second'][0]))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")-1)+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")-($filter['parameters']['second'][0])));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")-1));
						}
						break;
	
	
					case "monday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last monday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last monday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last monday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last monday'));
						}
						break;
	
					case "tuesday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last tuesday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last tuesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last tuesday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last tuesday'));
						}
						break;
	
					case "wednesday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last wednesday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last wednesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last wednesday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last wednesday'));
						}
						break;
	
					case "thursday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last thursday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last thursday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last thursday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last thursday'));
						}
						break;
	
					case "friday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last friday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last friday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last friday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last friday'));
						}
						break;
	
					case "saturday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last saturday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last saturday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last saturday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last saturday'));
						}
						break;
	
					case "sunday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last sunday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last sunday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last sunday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last sunday'));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "not last":
				switch ($filter['parameters']['first'][0]){
	
					case "day":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(($filter['parameters']['second'][0])*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()-(24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", time()-($filter['parameters']['second'][0])*24*3600);
							$filter['parameters']['second'][0] = date("Y-m-d", time()-(24*3600));
						}
						break;
	
					case "week":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter['parameters']['second'][0]-1)*7*24*3600))-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))-7)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter['parameters']['second'][0]-1)*7*24*3600)));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))-7)*24*3600);
						}
						break;
	
					case "month":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$monthsDate = @mktime(0,0,0,date("m")-($filter['parameters']['second'][0]),1,date("Y"));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $monthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()-($diaMes+1)*24*3600+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $monthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", time()-($diaMes+1)*24*3600);
						}
						break;
	
					case "Fquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")-$filter['parameters']['second'][0])+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")-$filter['parameters']['second'][0]));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")-($filter['parameters']['second'][0]))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")-1)+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")-($filter['parameters']['second'][0])));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")-1));
						}
						break;
	
	
					case "monday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last monday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last monday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last monday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last monday'));
						}
						break;
	
					case "tuesday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last tuesday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last tuesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last tuesday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last tuesday'));
						}
						break;
	
					case "wednesday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last wednesday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last wednesday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last wednesday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last wednesday'));
						}
						break;
	
					case "thursday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last thursday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last thursday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last thursday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last thursday'));
						}
						break;
	
					case "friday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last friday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last friday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last friday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last friday'));
						}
						break;
	
					case "saturday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last saturday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last saturday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last saturday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last saturday'));
						}
						break;
	
					case "sunday":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date('Y-m-d H:00:00', strtotime('last sunday')+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", strtotime('last sunday')+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date('Y-m-d', strtotime('last sunday'));
							$filter['parameters']['second'][0] = date("Y-m-d", strtotime('last sunday'));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
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
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $fistMonthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", $lastMonthsDate+$hourOffset-3600);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $fistMonthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", $lastMonthsDate-(24*3600));
						}
						break;
	
	
				}
	
				$operator1 = "NOT BETWEEN";
				$operator2 = "AND";
				break;
	
			case "this":
				switch ($filter['parameters']['first'][0]){
	
					case "day":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d");
							$filter['parameters']['second'][0] = date("Y-m-d");
						}
	
						break;
	
					case "week":
						$diaSemana = date("N", time()+$hourOffset)-1;
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(($diaSemana-($week_start-1))*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+((6-($diaSemana-($week_start-1)))*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()-(($diaSemana-($week_start-1))*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))*24*3600));
						}
						break;
	
					case "month":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numDiasMes = date("t", time()+$hourOffset);
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-($diaMes*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(($numDiasMes-$diaMes-1)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()-($diaMes*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(($numDiasMes-$diaMes-1)*24*3600));
						}
						break;
	
					case "Fquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						$numMes = date("n", time()+$hourOffset);
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1)+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1));
						}
						break;
	
					case "Nyear":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y"))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")));
						}
						break;
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "not this":
				switch ($filter['parameters']['first'][0]){
	
					case "day":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d");
							$filter['parameters']['second'][0] = date("Y-m-d");
						}
	
						break;
	
					case "week":
						$diaSemana = date("N", time()+$hourOffset)-1;
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(($diaSemana-($week_start-1))*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+((6-($diaSemana-($week_start-1)))*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()-(($diaSemana-($week_start-1))*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))*24*3600));
						}
						break;
	
					case "month":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numDiasMes = date("t", time()+$hourOffset);
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-($diaMes*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(($numDiasMes-$diaMes-1)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()-($diaMes*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(($numDiasMes-$diaMes-1)*24*3600));
						}
						break;
	
					case "Fquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						$numMes = date("n", time()+$hourOffset);
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1)+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1));
						}
						break;
	
					case "Nyear":
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y"))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")));
						}
						break;
	
				}
	
				$operator1 = "NOT BETWEEN";
				$operator2 = "AND";
				break;
	
	
			case "these":
					
				switch ($filter['parameters']['first'][0]){
	
					case "day":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(($filter['parameters']['second'][0])*24*3600)-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", time()-($filter['parameters']['second'][0])*24*3600);
							$filter['parameters']['second'][0] = date("Y-m-d");
						}
						break;
	
					case "week":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter['parameters']['second'][0]-1)*7*24*3600))-(date("G")*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+((6-($diaSemana-($week_start-1)))*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", time()-(((($diaSemana-($week_start-1))+7)*24*3600) + (($filter['parameters']['second'][0]-1)*7*24*3600)));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+((6-($diaSemana-($week_start-1)))*24*3600));
						}
						break;
	
					case "month":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						$diaMes = date("j", time()+$hourOffset)-1;
						$monthsDate = @mktime(0,0,0,date("m")-($filter['parameters']['second'][0]),1,date("Y"));
						$numDiasMes = date("t", time()+$hourOffset);
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", $monthsDate+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(($numDiasMes-$diaMes-1)*24*3600)+((24*3600)-((date("G")+1)*3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", $monthsDate);
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(($numDiasMes-$diaMes-1)*24*3600));
						}
						break;
	
					case "Fquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
	
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Nquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)-(3+(3*($filter['parameters']['second'][0]-1))),date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")-$filter['parameters']['second'][0])+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1)+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")-$filter['parameters']['second'][0]));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+1));
						}
						break;
	
					case "Nyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						$filter['parameters']['second'][0] = $filter['parameters']['second'][0] -1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")-($filter['parameters']['second'][0]))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y"))+((24*3600)-(3600))+$hourOffset);
						} else if ($filter['type'] == "date"){
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")-($filter['parameters']['second'][0])));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")));
						}
						break;
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "next":
				switch ($filter['parameters']['first'][0]){
	
					case "day":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
							
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()+(1*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(($filter['parameters']['second'][0]+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()+(1*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(($filter['parameters']['second'][0])*24*3600));
						}
						break;
	
					case "week":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()+((7-($diaSemana-($week_start-1)))*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))+($filter['parameters']['second'][0]*7)+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()+((7-($diaSemana-($week_start-1)))*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(((6-($diaSemana-($week_start-1)))+($filter['parameters']['second'][0]*7))*24*3600));
						}
						break;
	
					case "month":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$mes = @mktime( 0, 0, 0, date("m")+$filter['parameters']['second'][0], 1, date("Y"));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")+1,1,date("Y"))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+$filter['parameters']['second'][0],date("t", $mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+1,1,date("Y")));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+$filter['parameters']['second'][0],date("t", $mes),date("Y")));
						}
						break;
	
					case "Fquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y")));
						}
	
						break;
	
					case "Nquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$numMes = date("n", time()+$hourOffset);
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")+1)+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter['parameters']['second'][0]+1)+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")+1));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter['parameters']['second'][0]+1));
						}
						break;
	
					case "Nyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")+1)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")+$filter['parameters']['second'][0])+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")+1));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")+$filter['parameters']['second'][0]));
						}
						break;
	
				}
	
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
				break;
	
			case "not next":
				switch ($filter['parameters']['first'][0]){
	
					case "day":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
							
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()+(1*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(($filter['parameters']['second'][0]+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()+(1*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(($filter['parameters']['second'][0])*24*3600));
						}
						break;
	
					case "week":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaSemana = date("N", time()+$hourOffset)-1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", time()+((7-($diaSemana-($week_start-1)))*24*3600)-((date("G"))*3600)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", time()+(((6-($diaSemana-($week_start-1)))+($filter['parameters']['second'][0]*7)+1)*24*3600)-((date("G")+1)*3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", time()+((7-($diaSemana-($week_start-1)))*24*3600));
							$filter['parameters']['second'][0] = date("Y-m-d", time()+(((6-($diaSemana-($week_start-1)))+($filter['parameters']['second'][0]*7))*24*3600));
						}
						break;
	
					case "month":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$mes = @mktime( 0, 0, 0, date("m")+$filter['parameters']['second'][0], 1, date("Y"));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")+1,1,date("Y"))+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+$filter['parameters']['second'][0],date("t", $mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+1,1,date("Y")));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+$filter['parameters']['second'][0],date("t", $mes),date("Y")));
						}
						break;
	
					case "Fquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y")));
						}
	
						break;
	
					case "Nquarter":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$diaMes = date("j", time()+$hourOffset)-1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y"))+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y"))+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,date("m")-($monthInQuarter-1)+3,date("d")-$diaMes,date("Y")));
							$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(3-$monthInQuarter)+(3*$filter['parameters']['second'][0]),date("t",$mes),date("Y")));
						}
						break;
	
					case "Fyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
						$numMes = date("n", time()+$hourOffset);
	
	
						$year_month = $quarter_month;
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,$year_month,1,date("Y")+1)+$hourOffset);
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter['parameters']['second'][0]+1)+(24*3600)-(3600)+$hourOffset);
						}else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,$year_month,1,date("Y")+1));
							$mes = @mktime( 0, 0, 0, date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)), 1, date("Y"));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,date("m")+(((3-$monthInQuarter)-3) - (($thisQuarter-1)*3)),date("t",$mes),date("Y")+$filter['parameters']['second'][0]+1));
						}
						break;
	
					case "Nyear":
						if ($filter['parameters']['second'][0] == "")
							$filter['parameters']['second'][0] = 1;
	
						if (in_array($filter['type'], array("datetime", "timestamp"))) {
							$filter['parameters']['first'][0] = date("Y-m-d H:00:00", @mktime(0,0,0,1,1,date("Y")+1)+$hourOffset);
							$filter['parameters']['second'][0] = date("Y-m-d H:59:59", @mktime(0,0,0,12,31,date("Y")+$filter['parameters']['second'][0])+(24*3600)-(3600)+$hourOffset);
						} else if ($filter['type'] == "date") {
							$filter['parameters']['first'][0] = date("Y-m-d", @mktime(0,0,0,1,1,date("Y")+1));
							$filter['parameters']['second'][0] = date("Y-m-d", @mktime(0,0,0,12,31,date("Y")+$filter['parameters']['second'][0]));
						}
						break;
	
				}
	
	
				$operator1 = "NOT BETWEEN";
				$operator2 = "AND";
				break;
	
			//EN CASO DE QUE HAYA ALGUN REPORT VIEJO, MANTENEMOS LAS OPCIONES DE FIXED_DATE
			case "fixed date":
	
				switch ($filter['parameters']['first'][0]){
	
					case "today":
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00");
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59");
						break;
	
					case "yesterday":
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", time()-1*24*3600);
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", time()-1*24*3600);
						break;
	
					case "last n days":
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", time()-(($filter['parameters']['second'][0])*24*3600));
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", time());
						break;
	
					case "this week":
						$diaSemana = date("N")-1;
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", time()-($diaSemana-($week_start-1))*24*3600);
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", time()+(6-($diaSemana-($week_start-1)))*24*3600);
						break;
	
					case "last week":
						$diaSemana = date("N")-1;
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", time()-(($diaSemana-($week_start-1))+7)*24*3600);
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", time()+((6-($diaSemana-($week_start-1)))-7)*24*3600);
						break;
	
					case "this month":
						$diaMes = date("j")-1;
						$numDiasMes = date("t");
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", time()-$diaMes*24*3600);
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", time()+($numDiasMes-$diaMes-1)*24*3600);
						break;
	
					case "last month":
						$diaMes = date("j")-1;
						$numDiasMes = date("d", time()-($diaMes+1)*24*3600);
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", time()-($diaMes+$numDiasMes)*24*3600);
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", time()-($diaMes+1)*24*3600);
						break;
	
					case "this fiscal quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
	
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						break;
	
					case "last fiscal quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
						$quarter_month = (($numMes-($quarter_month-1)) <= 0) ? $numMes+(12-($quarter_month-1)) : $numMes-($quarter_month-1);
						$thisQuarter = ceil($quarter_month/3);
						$monthInQuarter = $quarter_month-(3*($thisQuarter-1));
	
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-3,date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						break;
	
					case "this natural quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1),date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter), 1, date("Y"));
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter),date("t",$mes),date("Y")));
						break;
	
					case "last natural quarter":
						$diaMes = date("j")-1;
						$numMes = date("n");
						$thisQuarter = ceil($numMes/3);
						$monthInQuarter = $numMes-(3*($thisQuarter-1));
	
						$filter['parameters']['first'][0] = date("Y-m-d 00:00:00", @mktime(0,0,0,date("m")-($monthInQuarter-1)-3,date("d")-$diaMes,date("Y")));
						$mes = @mktime( 0, 0, 0, date("m")+(3-$monthInQuarter)-3, 1, date("Y"));
						$filter['parameters']['second'][0] = date("Y-m-d 23:59:59", @mktime(0,0,0,date("m")+(3-$monthInQuarter)-3,date("t",$mes),date("Y")));
						break;
	
				}
	
				$operator1 = "BETWEEN";
				$operator2 = "AND";
	
				break;
				//EN CASO DE QUE HAYA ALGUN REPORT VIEJO, MANTENEMOS LAS OPCIONES DE FIXED_DATE
	
		}
		
	}
	
	static private function generateSqlWhere($filter, $fieldValues, $operator1, $operator2, & $sqlWhere) {
			
		$numericTypes = array("tinyint(1)", "tinyint", "int", "bigint", "decimal", "double", "currency");
		
		//Apply CalculatedField to Where Clause
		$filterName = $filter['field']; //FilterName
		$filterUserOptions = $filter['userOptions']; //FilterUserOptions
			
		foreach ($fieldValues['tables'][0]['data'] as $currentValues) {
	
			if (($filter['index'] == $currentValues['index']) && (empty($filterUserOptions))) {
	
				if (($currentValues['function'] != '0') || (!empty($currentValues['sql']))) {
					$filterName = $currentValues['field'];
				}
				break;

			}
	
		}
			
		$filterLogicalOperators = $filter['logicalOperators'];
		$openingParenthesis = ((empty($filterLogicalOperators['parenthesis'])) || ($filterLogicalOperators['parenthesis'] < 0)) ? 0 : $filterLogicalOperators['parenthesis'];
		$closingParenthesis = ((empty($filterLogicalOperators['parenthesis'])) || ($filterLogicalOperators['parenthesis'] > 0)) ? 0 : $filterLogicalOperators['parenthesis']*-1;
		$logicalOperator = (empty($filterLogicalOperators['operator'])) ? '' : $filterLogicalOperators['operator'];
			
	
		for ($oParenthesis = 0; $oParenthesis < $openingParenthesis; $oParenthesis++)
			$sqlWhere .= '(';
			
		//Para los campos enum y que tenga como primer operador one of o not one of
		if (((in_array($filter['type'], array("enum"))) && (in_array($filter['operator'], array("one of", "not one of")))) || (in_array($operator1, array("IN", "NOT IN")))) {
	
			$enum_fields = $filter['parameters']['first'];
			$sqlWhere .= "(";
	
			$sqlWhere .= $filterName." ".$operator1." ('".implode("', '", $enum_fields)."') ";
	
			if ($enum_fields[0] == ""){
	
				if ($filter['operator'] == "one of")
					$sqlWhere .= "OR ".$filterName." IS NULL";
	
			} else {
	
				if ($filter['operator'] == "not one of")
					$sqlWhere .= "OR ".$filterName." IS NULL";
	
			}
	
			$sqlWhere .= ") ";
	
		} else {
	
			if (((in_array($filter['parameters']['first'][0], array("", "%%"))) && (in_array($operator1, array("=", "!=", "LIKE", "NOT LIKE")))) || ((!in_array($filter['parameters']['first'][0], array("", "%%"))) && (in_array($operator1, array("!=", "NOT LIKE")))))
				$sqlWhere .= "(";
	
			if (in_array($filter['type'], $numericTypes)) {
				if ($filter['parameters']['first'][0] != "")
					$sqlWhere .= $filterName." ".$operator1." ".$filter['parameters']['first'][0]." ";
			} else {
				$sqlWhere .= $filterName." ".$operator1." '".$filter['parameters']['first'][0]."' ";
			}
				
			if (in_array($filter['parameters']['first'][0], array("", "%%"))) {
	
				if (in_array($operator1, array("=", "LIKE"))) {
	
					if (!in_array($filter['type'], $numericTypes))
						$sqlWhere .= "OR ";
					$sqlWhere .= $filterName." IS NULL) ";
	
				} else if (in_array($operator1, array("!=", "NOT LIKE"))) {
	
					if (!in_array($filter['type'], $numericTypes))
						$sqlWhere .= "AND ";
					$sqlWhere .= $filterName." IS NOT NULL) ";
	
				}
	
			} else {
	
				if (in_array($operator1, array("!=", "NOT LIKE"))) {
	
					$sqlWhere .= "OR ".$filterName." IS NULL) ";
	
				}
	
			}
	
		}
	
	
		if ($operator2 != ""){
	
			$sqlWhere .= $operator2." '".$filter['parameters']['second'][0]."'";
	
		}
	
			
		for ($cParenthesis = 0; $cParenthesis < $closingParenthesis; $cParenthesis++)
			$sqlWhere .= ')';
			
		$sqlWhere .= ($logicalOperator == 'OR') ? " OR  " : " AND ";
	
	}
	
	
	static public function modifySqlWhereForAsolDomainsQuery(&$sqlWhere, $domainReportTable, $current_user, $schedulerCall, $reportDomain, $domainField = null) {
	
		global $db;
	
	
		if (((!$current_user->is_admin) || (($current_user->is_admin) && (!empty($current_user->asol_default_domain)))) || ($schedulerCall)) {
	
			$asolReportDomainId = ($schedulerCall) ? $reportDomain : $current_user->asol_default_domain;
	
			require_once("modules/asol_Domains/asol_Domains.php");
			require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
			$domainsBean = new asol_domains();
			$domainsBean->retrieve($asolReportDomainId);
	
			if ($domainsBean->asol_domain_enabled) {
	
				if ($domainField !== null) {
	
					if ($domainField != "") {
							
						$domainFieldName = $domainField["fieldName"];
						$domainIsNumeric = $domainField["isNumeric"];
						
						if (isset($domainField["domainRelation"])) {
							$domainReportTable = $domainField["domainRelation"]["relatedTable"];
						}

						$domainFieldChar = ($domainIsNumeric) ? "" : "'";
							
						if (empty($sqlWhere))
							$sqlWhere .= " WHERE ( (".$domainReportTable.".".$domainFieldName."=".$domainFieldChar.$asolReportDomainId.$domainFieldChar.") ";
						else
							$sqlWhere .= " AND ( (".$domainReportTable.".".$domainFieldName."=".$domainFieldChar.$asolReportDomainId.$domainFieldChar.") ";
	
						//***asol_child_domains***//
						$childDomainsIds = asol_manageDomains::getChildDomainsArray($asolReportDomainId);
						$childDomainsStr = array();
						foreach ($childDomainsIds as $key=>$domainId) {
							if (!$domainId['enabled'])
							array_splice($childDomainsIds, $key, 1);
							else
							$childDomainsStr[] = $domainId['id'];
						}
						$sqlWhere .= (count($childDomainsIds) > 0) ? "OR (".$domainReportTable.".".$domainFieldName." IN (".$domainFieldChar.implode($domainFieldChar.",".$domainFieldChar , $childDomainsStr).$domainFieldChar.")) )" : ") " ;
						//***asol_child_domains***//
	
					}
						
				} else {
						
					$sqlWhere .= " AND ( (".$domainReportTable.".asol_domain_id='".$asolReportDomainId."')";
	
					if (($current_user->asol_only_my_domain == 0) || ($schedulerCall)) {
	
						//***asol_domain_child_share_depth***//
						$sqlWhere .= asol_manageDomains::getChildShareDepthQuery($domainReportTable.'.', $asolReportDomainId);
						//***asol_domain_child_share_depth***//
	
						//***asol_multi_create_domain***//
						if ($domainReportTable != 'users')
							$sqlWhere .= asol_manageDomains::getMultiCreateQuery($domainReportTable.'.', $asolReportDomainId);
						//***asol_multi_create_domain***//
	
						//***asol_publish_to_all***//
						$sqlWhere .= asol_manageDomains::getPublishToAllQuery($domainReportTable.'.', $asolReportDomainId);
						//***asol_publish_to_all***//
							
						//***asol_child_domains***//
						$sqlWhere .= asol_manageDomains::getChildHierarchyQuery($domainReportTable.'.', $asolReportDomainId);
						//***asol_child_domains***//
	
					} else {
	
						$sqlWhere .= ") ";
	
					}
						
				}
	
			} else {
	
				$sqlWhere .= " AND (1!=1) ";
	
			}
	
		}
	
	}
	
	
	static public function getSqlGroupByQuery($fieldValues, $report_table) {

		$sqlGroup = "";
		$sqlChartGroup = "";
		$details = Array();
		$group_by_seq = Array();
		$hasDetail = false;
		$hasGrouped = false;
		$hasFunctionField = false;
	
		$l=0;
		
		foreach ($fieldValues['tables'][0]['data'] as $i=>$currentValues) {
	
			//*******************************//
			//***Search for Grouped Fields***//
			//*******************************//
			if (in_array($currentValues['grouping'], array("Grouped", "Day Grouped", "DoW Grouped", "WoY Grouped", "Month Grouped", "Natural Quarter Grouped", "Fiscal Quarter Grouped", "Natural Year Grouped", "Fiscal Year Grouped"))) {
	
				$hasGrouped = true;
				
				$group_by_seq[] = array(
					'grouping' => $currentValues['grouping'],
					'order' => $currentValues['groupingOrder'],
					'field' => $currentValues['field'],
					'alias' => $currentValues['alias'],
					'display' => $currentValues['visible'],
					'type' => $currentValues['type'],
						
					'enumFields' => (in_array($currentValues['enumOperator'], array('options', 'function'))) ? asol_Report::getEnumValues($currentValues['enumOperator'], $currentValues['enumReference']) : '',
					'enumLabels' => (in_array($currentValues['enumOperator'], array('options', 'function'))) ? asol_Report::getEnumLabels($currentValues['enumOperator'], $currentValues['enumReference']) : ''	
						
				);
	
			}
	
			//********************************//
			//***Search for Detailed Fields***//
			//********************************//
			if (in_array($currentValues['grouping'], array("Detail", "Day Detail", "DoW Detail", "WoY Detail", "Month Detail", "Natural Quarter Detail", "Fiscal Quarter Detail", "Natural Year Detail", "Fiscal Year Detail"))) {
	
				$hasDetail = true;
				
				$details[] = array(
					'order' => $currentValues['sortDirection'],
					'field' => $currentValues['field'],
					'grouping' => $currentValues['grouping'],
					'type' => $currentValues['type'],
					
					'function' => $currentValues['function'],
					'sql' => $currentValues['sql'],
					
					'enumFields' => (in_array($currentValues['enumOperator'], array('options', 'function'))) ? asol_Report::getEnumValues($currentValues['enumOperator'], $currentValues['enumReference']) : '',
					'enumLabels' => (in_array($currentValues['enumOperator'], array('options', 'function'))) ? asol_Report::getEnumLabels($currentValues['enumOperator'], $currentValues['enumReference']) : ''
					
				);

			}
			
			//********************************//
			//***Search for Function Fields***//
			//********************************//
			if ($currentValues['function'] != '0') {
			
				$hasFunctionField = true;
			
			}
	
		}
	
		$massiveData = ($hasDetail && !$hasGrouped && !$hasFunctionField);
		
		if (!$massiveData) {
	
			sort($details);
	
			if ($details[0]['grouping'] == 'Detail') {
				$sqlChartGroup .= " GROUP BY ".$details[0]['field']." ";
			}
	
		}
	
		
		//*******************************//
		//******Build GroupBy Query******//
		//*******************************//
		if ($hasGrouped) {
	
			sort($group_by_seq);
			$sqlGroup .= " GROUP BY ";
	
			for ($k=0; $k<count($group_by_seq); $k++){

				$sqlGroup .= $group_by_seq[$k]['field']." ,";
	
			}
	
		}
	
		$sqlGroup = substr($sqlGroup, 0, -1);
	
	
		$returnedArray = array (
			"groupBySeq" => $group_by_seq,
			"details" => $details,
			"hasDetail" => $hasDetail,
			"hasGrouped" => $hasGrouped,
			"hasFunctionField" => $hasFunctionField,
			"massiveData" => $massiveData,
			"querys" => array (
				"Group" => $sqlGroup,
				"ChartGroup" => $sqlChartGroup,
			),
		);
	
		return $returnedArray;
	
	
	}
	
	
	static public function getSqlOrderByQuery($fieldValues, $report_table, $field_sort = "", $sort_direction = "") {
	
		$sqlOrder = "";
		$order_by_seq = Array();
		$hasGroupField = false;
	
		//Check if has Group
		foreach ($fieldValues['tables'][0]['data'] as $currentValues)
			$hasGroupField = (in_array($currentValues['grouping'], array("Grouped", "Day Grouped", "DoW Grouped", "WoY Grouped", "Month Grouped", "Natural Quarter Grouped", "Fiscal Quarter Grouped", "Natural Year Grouped", "Fiscal Year Grouped")) || ($hasGroupField)) ? true: false;
	
		
		foreach ($fieldValues['tables'][0]['data'] as $currentValues) {
	
			if ($currentValues['sortDirection'] != "0") {
	
				$order_by_seq[] = array(
					'order' => $currentValues['sortOrder'],
					'field' => $currentValues['field'],
					'dir' => $currentValues['sortDirection']
				);
	
			}
	
		}
	
	
		if (count($order_by_seq) != 0){
	
			sort($order_by_seq);
			$sqlOrder .= " ORDER BY ";
	
			for ($k=0; $k<count($order_by_seq); $k++){
	
				$sqlOrder .= $order_by_seq[$k]['field']." ".$order_by_seq[$k]['dir']." ,";
	
			}
	
		}
	
		$sqlOrder = substr($sqlOrder, 0, -1);
	
	
		//Reordenamos el resultset en funcion de la cabecera pinchada en la pagina display
		if ($field_sort != ""){
	
			if ($sort_direction == "")
			$sort_direction = "ASC";
	
			//Reformatear nombre de la tabla si es un related field
			$sqlOrder = " ORDER BY ".$field_sort." ".$sort_direction." ";
	
			$sort_direction = ($sort_direction == "ASC") ? "DESC" : "ASC";
		
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
				$limitedTotalsRs = asol_Report::getSelectionResults($sqlLimitedTotals, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
				
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
		
		$externalColumnsRs = asol_Report::getSelectionResults("SHOW COLUMNS FROM ".$report_table, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
		
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
			$limitedTotalsRs = asol_Report::getSelectionResults($sqlLimitedTotals);
	
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
	
	
	static public function getDetailWhereGrouping($sqlWhere, $currentGroup, $detailFieldInfo) {
		
		switch ($detailFieldInfo['grouping']) {
		
			case "Detail":
				
				//************************************************//
				//*****Calculate Detail Extended Where Clause*****//
				//************************************************//
				$detailGroupWhereExtensionQuery = asol_ReportsGenerationFunctions::getDetailGroupWhereExtensionQuery($sqlWhere, $detailFieldInfo['field'], $currentGroup);
				
				$subGroup = $detailGroupWhereExtensionQuery["subGroup"];
				$sqlDetailWhere = $detailGroupWhereExtensionQuery["sqlDetailWhere"];								
				
				break;
				
				
			case "Day Detail":
			case "DoW Detail":
			case "WoY Detail":
			case "Month Detail":
			case "Natural Quarter Detail":
			case "Fiscal Quarter Detail":
			case "Natural Year Detail":
			case "Fiscal Year Detail":
								
				//**************************************************************//
				//***Calculate Month/DoW/WoY/Day Detail Extended Where Clause***//
				//**************************************************************//
				$monthDayDetailGroupWhereExtensionQuery = asol_ReportsGenerationFunctions::getDateDetailGroupWhereExtensionQuery($sqlWhere, $detailFieldInfo['field'], $detailFieldInfo['grouping'], $currentGroup);
				
				$subGroup = $monthDayDetailGroupWhereExtensionQuery["subGroup"];
				$sqlDetailWhere = $monthDayDetailGroupWhereExtensionQuery["sqlDetailWhere"];
				
				break;
					
		}
			
		return array(
			'subGroup' => $subGroup,
			'sqlDetailWhere' => $sqlDetailWhere
		);
		
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
	
	
		foreach ($rsSubTotals[0] as $key=>$value) {
			
			$totalType = (!empty($totals[$k]['type'])) ? $totals[$k]['type'] : "";
	
			if (($auditedReport) && (in_array($totals[$k]['field'], $auditedAppliedFields)))
				$totalType = $auditedFieldType;
	
			
			if ($totalType == "date") {
	
				if (($value != "") && (date('Y-m-d', strtotime($value)) == $value))
					$rsSubTotals[0][$key] = $timedate->swap_formats($value, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
	
			} else if ($totalType == "datetime") {
	
				if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
					$value = $timedate->handle_offset($value, $timedate->get_db_date_time_format(), true, null, $userTZ);
					$rsSubTotals[0][$key] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
				}
	
			} else if ($totalType == "timestamp") {
	
				if (($value != "") && (date('Y-m-d H:i:s', strtotime($value)) == $value)) {
					$rsSubTotals[0][$key] = $timedate->swap_formats($value, $timedate->get_db_date_time_format(), $userDateTimeFormat);
				}
	
			} else if ($totalType == "currency") {
	
				$value = (!empty($value)) ? $value : 0;
				$params = array('currency_id' => $currency_id, 'convert' => false);
				$rsSubTotals[0][$key] = currency_format_number($value, $params);
	
			} else if (in_array($totalType, array("decimal", "double"))) {
				
				$rsSubTotals[0][$key] = (!empty($value)) ? format_number($value) : format_number(0);
				
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
	
	
	static public function formatSubGroup($subGroup, $subGroupInfo, $userTZ, $currency_id) {
	
		global $timedate, $app_list_strings;
	
		//Set default timezone for php date/datetime functions
		date_default_timezone_set($userTZ);
	
		if ($subGroupInfo["type"] == "enum") {
	
			$subGroup = ($subGroup == "Nameless") ? "Nameless" : $subGroupInfo['enumLabels'][$subGroup];
	
		} else if ($subGroupInfo["type"] == "datetime"){
	
			$subGroup = $timedate->handle_offset($subGroup, $timedate->get_db_date_time_format(), true, null, $userTZ);
	
		} else if ($subGroupInfo["type"] == "currency") {
	
			$params = array('currency_id' => $currency_id, 'convert' => false);
			$subGroup = currency_format_number($subGroup, $params);
	
		} else if (in_array($subGroupInfo["type"], array("decimal", "double"))) {
				
			$subGroup = (!empty($subGroup)) ? format_number($subGroup) : format_number(0);
				
		} 
	
		$subGroup = str_replace("\'", "'", $subGroup);
	
		//***HTML Entities Decoding
		$subGroup = html_entity_decode($subGroup);
		//***HTML Entities Decoding
	
		return $subGroup;
	
	}
	
	
	static public function formatDateSpecialsGroup($subGroup, $fieldInfo, $userTZ, $currency_id) {
		
		global $mod_strings, $timedate;
		
		switch ($fieldInfo['grouping']) {
								
			case "Detail":

				$subGroup = self::formatSubGroup($subGroup, $fieldInfo, $userTZ, $currency_id);
				
				break;
				
			case "Day Detail":
				
				if((!$timedate->check_matching_format($fieldValue, $userDateFormat)) && ($fieldValue != ""))						
					$fieldValue = $timedate->swap_formats($fieldValue, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
					
				break;
				
			case "DoW Detail":
			
				$dowLabels = array('LBL_REPORT_MONDAY', 'LBL_REPORT_TUESDAY', 'LBL_REPORT_WEDNESDAY', 'LBL_REPORT_THURSDAY', 'LBL_REPORT_FRIDAY', 'LBL_REPORT_SATURDAY' ,'LBL_REPORT_SUNDAY'); 
				$subGroup = $mod_strings[$dowLabels[$subGroup]];
				
				break;

			case "WoY Detail":
			
				$woyVal = substr($subGroup, 4); //YYYYW
				$yearVal = substr($subGroup, 0 , 4); //YYYYW

				if ($woyVal < 10) {
					$woyVal = '0'.$woyVal;
				}
				
				$subGroup = $woyVal.' ('.$yearVal.')';
				
				break;
				
			case "Month Detail":

				$monthVal = substr($subGroup, 4); //YYYYMM
				$yearVal = substr($subGroup, 0 , -2); //YYYYMM
		
				$monthName = date("F", @mktime(0, 0, 0, $monthVal, 10));
				$subGroup = (!empty($mod_strings["LBL_REPORT_".strtoupper($monthName)])) ? $mod_strings["LBL_REPORT_".strtoupper($monthName)]."-".$yearVal : $monthName."-".$yearVal;
				
				break;
				
			case "Natural Quarter Detail":
				
				$quarterVal = substr($subGroup, 4); //YYYYQ
				$yearVal = substr($subGroup, 0 , -1); //YYYYQ
				
				$numberTranslation = array("FIRST", "SECOND", "THIRD", "FORTH");
				$subGroup = $mod_strings['LBL_REPORT_'.$numberTranslation[intval($quarterVal)-1].'_NATURAL_QUARTER'].' ('.$yearVal.')';

				break;
				
			case "Fiscal Quarter Detail":
				
				$quarterVal = substr($subGroup, 4); //YYYYQ
				$yearVal = substr($subGroup, 0 , -1); //YYYYQ
			
				$numberTranslation = array("FIRST", "SECOND", "THIRD", "FORTH");
				$subGroup = $mod_strings['LBL_REPORT_'.$numberTranslation[intval($quarterVal)-1].'_FISCAL_QUARTER'].' ('.$yearVal.')';
				
				break;
				
			case "Natural Year Detail":
			case "Fiscal Year Detail":	
					
				break;
				
		}
		
		return $subGroup;
		
	}
	
	
	static public function formatDetailResultSet($subGroups, & $resulsetFields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $auditedReport, $auditedAppliedFields, $auditedFieldType) {

		date_default_timezone_set($userTZ);
		
		foreach ($subGroups as & $subGroup) {
	
			foreach ($subGroup as & $values) {

				self::formatResultSetRows($resulsetFields, $values, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $auditedReport, $auditedAppliedFields, $auditedFieldType);

			}

		}
		
		return $subGroups;
	
	}
	
	static public function formatResultSet($rs, & $resulsetFields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $auditedReport, $auditedAppliedFields, $auditedFieldType) {

		date_default_timezone_set($userTZ);

		foreach ($rs as & $values) {

			self::formatResultSetRows($resulsetFields, $values, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $auditedReport, $auditedAppliedFields, $auditedFieldType);
	
		}
	
		return $rs;
	
	}
	
	static private function formatResultSetRows($resulsetFields, & $rowValues, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $auditedReport, $auditedAppliedFields, $auditedFieldType) {
		
		global $timedate;
		
		foreach ($resulsetFields as & $fieldDef) {

			$isTotal = (!$isGroupedReport && $fieldDef['function'] != '0');
			$hasSql = (!empty($fieldDef['sql']));
			
			if (!$isTotal && !$hasSql) {

				$currentUnformattedValue = $rowValues[$fieldDef['alias']];
				
				if (($auditedReport) && (in_array($fieldDef['field'], $auditedAppliedFields)))
					$fieldDef['type'] = $auditedFieldType;
					
				if ($fieldDef['type'] == "enum") {
	
					if (in_array($fieldDef['enumOperator'], array('options', 'function'))) {
						
						$enumOptions = asol_Report::getEnumLabels($fieldDef['enumOperator'], $fieldDef['enumReference']);
						$rowValues[$fieldDef['alias']] = (!isset($enumOptions[$currentUnformattedValue])) ? $currentUnformattedValue : $enumOptions[$currentUnformattedValue];

					}

				} else if ($fieldDef['type'] == "date") {
						
					if (($currentUnformattedValue != "") && (date('Y-m-d', strtotime($currentUnformattedValue)) == $currentUnformattedValue))
						$rowValues[$fieldDef['alias']] = $timedate->swap_formats($currentUnformattedValue, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
						
				} else if ($fieldDef['type'] == "datetime") {
						
					if (($currentUnformattedValue != "") && (date('Y-m-d H:i:s', strtotime($currentUnformattedValue)) == $currentUnformattedValue)) {
						$rowValues[$fieldDef['alias']] = $timedate->handle_offset($currentUnformattedValue, $timedate->get_db_date_time_format(), true, null, $userTZ);
						$rowValues[$fieldDef['alias']] = $timedate->swap_formats($currentUnformattedValue, $timedate->get_db_date_time_format(), $userDateTimeFormat);
					}
	
				} else if ($fieldDef['type'] == "timestamp") {
					
					if (($currentUnformattedValue != "") && (date('Y-m-d H:i:s', strtotime($currentUnformattedValue)) == $currentUnformattedValue)) {
						$rowValues[$fieldDef['alias']] = $timedate->swap_formats($currentUnformattedValue, $timedate->get_db_date_time_format(), $userDateTimeFormat);
					}

				} else if ($fieldDef['type'] == "currency") {
	
					$params = array('currency_id' => $currency_id, 'convert' => false);
					$rowValues[$fieldDef['alias']] = currency_format_number($currentUnformattedValue, $params);
	
				} else if (in_array($fieldDef['type'], array("decimal", "double"))) {
				
					$rowValues[$fieldDef['alias']] = (!empty($currentUnformattedValue)) ? format_number($currentUnformattedValue) : format_number(0);
				
				} else {

					$rowValues[$fieldDef['alias']] = $currentUnformattedValue;
	
				}

				if (in_array($fieldDef['grouping'], array("Day Detail", "DoW Detail", "WoY Detail", "Month Detail", "Natural Quarter Detail", "Fiscal Quarter Detail", "Natural Year Detail", "Fiscal Year Detail"))) {
					
					$rowValues[$fieldDef['alias']] = self::formatDateSpecialsGroup($rowValues[$fieldDef['alias']], $fieldDef, $userTZ, $currency_id);
					
				}

			}
		
			//***HTML Entities Decoding
			if (!$isTotal) {
				$rowValues[$fieldDef['alias']] = html_entity_decode($rowValues[$fieldDef['alias']]);
			}
			//***HTML Entities Decoding
	
		}
		
	}
	
	static public function formatDetailGroupedFields($subGroups, $resulset_fields, $userDateFormat) {
		
		global $timedate, $mod_strings;
		
		foreach ($subGroups as $key=>$subGroup) {
			
			foreach ($subGroup as $keyG=>$values) {
	
				$j=0;
	
				foreach ($values as $keyV=>$value) {
	
					if (in_array($resulset_fields[$j]['grouping'], array("Grouped", "Day Grouped", "DoW Grouped", "WoY Grouped", "Month Grouped", "Natural Quarter Grouped", "Fiscal Quarter Grouped", "Natural Year Grouped", "Fiscal Year Grouped"))) {
				
						if ($resulset_fields[$j]['function'] == '0') {

							$subGroups[$key][$keyG][$keyV] = self::applyGroupFormat($subGroups[$key][$keyG][$keyV], $resulset_fields[$j]['grouping'], $userDateFormat); 
							
						}
		
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
	
	static public function formatGroupedFields($rs, $resulset_fields, $userDateFormat) {
		
		global $timedate, $mod_strings;
		
		for ($j=0; $j<count($rs); $j++) {
	
			$k = 0;
	
			foreach ($rs[$j] as $key=>$value) {
					
				if (in_array($resulset_fields[$k]['grouping'], array("Grouped", "Day Grouped", "DoW Grouped", "WoY Grouped", "Month Grouped", "Natural Quarter Grouped", "Fiscal Quarter Grouped", "Natural Year Grouped", "Fiscal Year Grouped"))) {
				
					if ($resulset_fields[$k]['function'] == '0') {
								
						$rs[$j][$key] = self::applyGroupFormat($rs[$j][$key], $resulset_fields[$k]['grouping'], $userDateFormat);

					}
		
					//***HTML Entities Decoding
					$rs[$j][$key] = html_entity_decode($rs[$j][$key]);
					//***HTML Entities Decoding
						
				}
				
				$k++;
				
			}
	
		}
	
		return $rs;
		
	}
	
	static public function generateManuallySubTotals($rs, $totals, $subTotalsLimit = array()) {
		
		if ($rs !== null) {
			for ($l=0; $l<count($rs); $l++){
				foreach ($totals as $oneTotal)
					$subTotalsLimit[$l][$oneTotal['alias']] = $rs[$l][$oneTotal['alias']];
			}
		}
		
		
		//Calculamos los totales a mano para las agrupaciones limitadas
		$limitedTotals = array();

		if (empty($subTotalsLimit))
			$subTotalsLimit = array();


		foreach ($totals as $key=>$total) {

			$limitedValue = "";
			
			if (empty($total['function']))
				$total['function'] = "COUNT";

			switch ($total['function']) {
				
				case "COUNT":
				case "SUM":
					foreach ($subTotalsLimit as $subVal)
						$limitedValue += $subVal[$total['alias']];
					break;

				case "MIN":
					foreach ($subTotalsLimit as $subVal) {
						if (empty($limitedValue))
							$limitedValue = $subVal[$total['alias']];
						else if ($subVal[$total['alias']] <= $limitedValue)
							$limitedValue = $subVal[$total['alias']];
					}
					break;

				case "MAX":
					foreach ($subTotalsLimit as $subVal) {
						if (empty($limitedValue))
							$limitedValue = $subVal[$total['alias']];
						else if ($subVal[$total['alias']] >= $limitedValue)
							$limitedValue = $subVal[$total['alias']];
					}
					break;

				case "AVG":
					$c=0;
					foreach ($subTotalsLimit as $subVal) {
						$limitedValue += $subVal[$total['alias']];
						$c++;
					}
					$limitedValue /= $c;
					break;
						
			}

			$limitedTotals[0][$total['alias']] = $limitedValue;
				
		}

		return $limitedTotals;
		
	}
	
	static public function getGroupingChartValue($groupBySequence, $rsValues, $userDateFormat) {
		
		global $timedate, $mod_strings;
		
		$groupVal = "";
		
		foreach ($groupBySequence as $group=>$oneGroupBySeq) {
		
			if ($oneGroupBySeq['display'] == 'yes') {
			
				$groupingField = html_entity_decode($oneGroupBySeq['alias']);
				
				if (in_array($oneGroupBySeq['type'], array('enum'))) {
					
					$groupVal .= $oneGroupBySeq['enumLabels'][$rsValues[$groupingField]];
				
				} else if (in_array($oneGroupBySeq['type'], array("currency"))) {
					
					$groupVal .= format_number($rsValues[$groupingField]);
				
				} else if (in_array($oneGroupBySeq['type'], array("decimal", "double"))) {
					
					$groupVal .= format_number($rsValues[$groupingField]);
				
				} else if (in_array($oneGroupBySeq['type'], array("date", "datetime", "timestamp"))) {
					
					$groupVal .= self::applyGroupFormat($rsValues[$groupingField], $oneGroupBySeq['grouping'], $userDateFormat);
					
				} else {
					
					$groupVal .= $rsValues[$groupingField];
				
				}
	
				$groupVal .= "/";
				
			}
			
		}
		
		return substr($groupVal, 0, -1);
		
	}
	
	static public function applyGroupFormat($fieldValue, $fieldGroupingType, $userDateFormat) {
		
		global $timedate, $mod_strings;
		
		switch ($fieldGroupingType) {
				
			case "Grouped":

				break;
				
			case "Day Grouped":
				
				if((!$timedate->check_matching_format($fieldValue, $userDateFormat)) && ($fieldValue != ""))						
					$fieldValue = $timedate->swap_formats($fieldValue, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
				
				break;
				
			case "DoW Grouped":
				   
				$dowLabels = array('LBL_REPORT_MONDAY', 'LBL_REPORT_TUESDAY', 'LBL_REPORT_WEDNESDAY', 'LBL_REPORT_THURSDAY', 'LBL_REPORT_FRIDAY', 'LBL_REPORT_SATURDAY' ,'LBL_REPORT_SUNDAY'); 
				$fieldValue = $mod_strings[$dowLabels[$fieldValue]];
				
				break;
				
			case "WoY Grouped":
				   
				$woyVal = substr($fieldValue, 4); //YYYYW
				$yearVal = substr($fieldValue, 0 , 4); //YYYYW

				if ($woyVal < 10) {
					$woyVal = '0'.$woyVal;
				}
				
				$fieldValue = $woyVal.' ('.$yearVal.')';
				
				break;
				
			case "Month Grouped":

				$monthVal = substr($fieldValue, 4); //YYYYMM
				$yearVal = substr($fieldValue, 0 , -2); //YYYYMM
				
				$monthName = date("F", @mktime(0, 0, 0, $monthVal, 10));
				$fieldValue = (!empty($mod_strings["LBL_REPORT_".strtoupper($monthName)])) ? $mod_strings["LBL_REPORT_".strtoupper($monthName)]."-".$yearVal : $monthName."-".$yearVal;
				
				break;
				
			case "Natural Quarter Grouped":
				
				$quarterVal = substr($fieldValue, 4); //YYYYQ
				$yearVal = substr($fieldValue, 0 , -1); //YYYYQ
				
				$numberTranslation = array("FIRST", "SECOND", "THIRD", "FORTH");
				$fieldValue = $mod_strings['LBL_REPORT_'.$numberTranslation[intval($quarterVal)-1].'_NATURAL_QUARTER'].' ('.$yearVal.')';

				break;
				
			case "Fiscal Quarter Grouped":
				
				$quarterVal = substr($fieldValue, 4); //YYYYQ
				$yearVal = substr($fieldValue, 0 , -1); //YYYYQ
				
				$numberTranslation = array("FIRST", "SECOND", "THIRD", "FORTH");
				$fieldValue = $mod_strings['LBL_REPORT_'.$numberTranslation[intval($quarterVal)-1].'_FISCAL_QUARTER'].' ('.$yearVal.')';

				break;
				
			case "Natural Year Grouped":
				
				break;
				
			case "Fiscal Year Grouped":
				
				break;
			
		}

		return $fieldValue;
							
	}

	
	static private function replace_reports_vars($text_with_vars, $table_alias_name, $leftJoineds, $audited_report) {

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
	
					$beanField = $table_alias_name.($audited_report ? "_audit" : "").".".$beanValues[1];
	
				} else if ($beanValues[0] == "bean_cstm") {
	
					$beanField = $table_alias_name."_cstm.".$beanValues[1];
	
				}
	
			} else if (count($beanValues) == 3) {
	
				$moduleArray = explode("_", $beanValues[0]);
				$isCustomField = ($moduleArray[count($moduleArray) - 1] == 'Cstm');
				$module = ($isCustomField) ? substr($beanValues[0], 0, -5): $beanValues[0];
					
				$related_table = BeanFactory::newBean(BeanFactory::getObjectName($module))->table_name;
				$related_table = (empty($related_table)) ? strtolower($module) : $related_table;
				
				$relatedIndex = array_search($beanValues[1].".".$related_table, $leftJoineds);
				if ($relatedIndex === false)
					$relatedIndex = array_search($beanValues[1].".".$table_alias_name."_cstm.".$related_table, $leftJoineds);
	
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