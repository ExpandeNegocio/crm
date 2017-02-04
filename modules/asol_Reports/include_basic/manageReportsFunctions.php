<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/reportsUtils.php");

global $db;

//**************************//
//***Is Domains Installed***//
//**************************//
$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
$isDomainsInstalled = ($domainsQuery->num_rows > 0);
//**************************//
//***Is Domains Installed***//
//**************************//


class asol_ReportsManagementFunctions {
	
	static public function getLoadingBlockDiv() {
		
		return '
		<div id="loadingBlockDiv" style="display: none">
			<table cellspacing="0" cellpadding="0" border="0" class="edit view">
				<tbody>
					<tr>
						<td>
							<img style="display:inline" src="themes/default/images/img_loading.gif">
							<span style="display:inline" id="loadingText">&nbsp;'.translate('LBL_REPORT_LOADING_DATA', 'asol_Reports').'</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>';
		
	} 
	
	static public function getBasicFieldFilterForAuditedReport($selectedModule) {

		global $sugar_config, $db;
		
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		
		$translateFieldLabels = ((!isset($sugar_config['asolReportsTranslateLabels'])) || ($sugar_config['asolReportsTranslateLabels'])) ? true : false;
		$fieldsToBeRemoved = self::getNonVisibleFields($selectedModule, $isDomainsInstalled);
		
		$fieldNameFieldArray = array(
			'tables' => array(
				0 => array(
					'config' => array(
						'visible' => 'yes'
					),
					'data' => array(
						0 => array(
							'field' => 'field_name',
							'alias' => ($translateFieldLabels) ? translate("LBL_FIELD_NAME", "Audit") : 'fieldName',
							'visible' => 'no',
							'sortDirection' => '0',
							'sortOrder' => '',
							'function' => '0',
							'sql' => '', 
							'grouping' => '0',
							'groupingOrder' => '',
							'type' => 'enum',
							'key' => '',
							'isRelated' => false,
							'index' => '4',
							'enumOprerator' => 'asolFunction',
							'enumReference' => 'getAuditedFields',
	
							'optionsDb' => asol_Report::getAuditedFields($selectedModule, $fieldsToBeRemoved), //dropdown Values
							'optionsLabel' => ($translateFieldLabels) ? asol_Report::getAuditedLabels($selectedModule, $fieldsToBeRemoved) : asol_Report::getAuditedFields($selectedModule, $fieldsToBeRemoved), //dropdown labels
						)
					)
				)
			),
			'version' => asol_ReportsUtils::$reports_version
		);
	
		$auditFields = json_encode($fieldNameFieldArray);
		
		$fieldNameFilterArray = array(
									'data' => array(
										0 => array(
											'field' => 'field_name',
											'operator' => 'equals',
											'parameters' => array(
												'first' => array(),
												'second' => array(),
												'third' => array(),
											),
											'type' => 'enum',
											'isRelated' => false,
											'relationKey' => '',
											'index' => '1',
											'enumOperator' => 'asolFunction',
											'enumReference' => 'getAuditedFields',
											'enumValues' => asol_Report::getAuditedFields($selectedModule, $fieldsToBeRemoved), //dropdown Values 
											'enumLabels' => asol_Report::getAuditedLabels($selectedModule, $fieldsToBeRemoved, $translateFieldLabels), //dropdown labels
											'filterReference' => 'fieldName',
											'alias' => ($translateFieldLabels) ? translate("LBL_FIELD_NAME", "Audit") : 'fieldName',
											'behavior' => 'auto', 
											'userOptions' => array(),
											'logicalOperators' => array(
												'parenthesis' => '0',
												'operator' => ''
											)
										)
									)
								);
								
		$auditFilters = json_encode($fieldNameFilterArray);
		
		return array(
			'auditFields' => $auditFields,
			'auditFilters' => $auditFilters
		);
		
	}
	
	static public function getNonVisibleFields($reportModule, $isDomainsInstalled) {
			
		global $sugar_config, $current_user;
		
		$fieldsToBeRemoved = array('deleted');
		
		if (isset($sugar_config['asolReportsNonVisibleFields'][$reportModule])) {
	
			foreach ($sugar_config['asolReportsNonVisibleFields'][$reportModule] as $nonVisibleField)
				$fieldsToBeRemoved[] = $nonVisibleField;
		
		}
			
		if ($isDomainsInstalled) {
			
			require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
			
			$childDomains = asol_manageDomains::getChildDomains($current_user->asol_default_domain);
			$isLeafDomain = (empty($childDomains)) ? true : false;
			
			$fieldsToBeRemoved[] = 'asol_domain_published_mode';
			$fieldsToBeRemoved[] = 'asol_domain_child_share_depth';
			$fieldsToBeRemoved[] = 'asol_multi_create_domain';
			$fieldsToBeRemoved[] = 'asol_published_domain';
			
			if ((!$current_user->is_admin) && $isLeafDomain) {
				$fieldsToBeRemoved[] = 'asol_domain_id';
			}
		
		}
	
		return $fieldsToBeRemoved;
		
	}

	
	static public function prepareReportFields($fieldsJson) {
		
		$fieldsArray = unserialize(base64_decode($fieldsJson));
		
		if (!empty($fieldsArray))
			$fieldsJson = addslashes(json_encode($fieldsArray));
		
		return array(
			'json' => $fieldsJson,
			'array' => $fieldsArray,
		);
		
	}
	
	static public function prepareReportFilters($report_module, $filtersJson, $translateFieldLabels, $fieldsToBeRemoved) {
	
		global $timedate;
		
		if (strlen($filtersJson) == 0) {
			return null;
		}		
		
		$filtersArray = unserialize(base64_decode($filtersJson));
		
		foreach ($filtersArray['data'] as &$currentFilter) {
			
			if (in_array($currentFilter['type'], array("date", "datetime", "timestamp")) && !in_array($currentFilter['operator'], array("last", "this", "these", "next", "not last", "not this", "not next"))) {
			
				if (!in_array($currentFilter['operator'], array("equals", "not equals", "before date", "after date", "between", "not between"))) {
					foreach($currentFilter['parameters']['first'] as &$currentParameter) {
						if ((!$timedate->check_matching_format($currentParameter, $timedate->get_date_format())) && ($currentParameter != "")) {
							$currentParameter = $timedate->swap_formats($currentParameter, $GLOBALS['timedate']->dbDayFormat, $timedate->get_date_format() );
						}
					}
				}
				
				if ((count($currentFilter['parameters']['first']) > 0) && (in_array($currentFilter['parameters']['first'][0], array("calendar")))) {
					foreach($currentFilter['parameters']['second'] as &$currentParameter) {
						if ((!$timedate->check_matching_format($currentParameter, $timedate->get_date_format())) && ($currentParameter != "")) {
							$currentParameter = $timedate->swap_formats($currentParameter, $GLOBALS['timedate']->dbDayFormat, $timedate->get_date_format() );
						}
					}
	
					if (in_array($currentFilter['operator'], array("between", "not between"))) {
						foreach($currentFilter['parameters']['third'] as &$currentParameter) {
							if((!$timedate->check_matching_format($currentParameter, $timedate->get_date_format())) && ($currentParameter != "")) {
								$currentParameter = $timedate->swap_formats($currentParameter, $GLOBALS['timedate']->dbDayFormat, $timedate->get_date_format() );
							}
						}
					}
					
				}
				
			}
			
			if (in_array($currentFilter['enumOperator'], array('options', 'function'))) {
			
				$currentFilter['enumValues'] = asol_Report::getEnumValues($currentFilter['enumOperator'], $currentFilter['enumReference']);
				$currentFilter['enumLabels'] = asol_Report::getEnumLabels($currentFilter['enumOperator'], $currentFilter['enumReference']);
				
			} else if ($currentFilter['enumOperator'] == 'asolFunction') {
				
				$currentFilter['enumLabels'] = ($translateFieldLabels) ? asol_Report::getAuditedLabels($report_module, $fieldsToBeRemoved) : asol_Report::getAuditedFields($report_module, $fieldsToBeRemoved);
				$currentFilter['enumValues'] = asol_Report::getAuditedFields($report_module, $fieldsToBeRemoved);
				
			}
			
		}
		
		$filtersJson = addslashes(json_encode($filtersArray));
	
		return array(
			'json' => $filtersJson,
			'array' => $filtersArray,
		);
	
	}
	
	static public function prepareReportTasks($report_tasks, $return_action) {
		
		global $current_user, $timedate;
		
		if (strpos($report_tasks, '${GMT}') !== false) {
			$taskArray = explode('${GMT}', $report_tasks);
			$report_tasks = $taskArray[0];
		}
	
		//reformateamos las fechas de selected task al formato de visualizacion definido por el usuario
		$tasks = explode("|", $report_tasks);
		
		if (($tasks[0] == "") || ($tasks[0] == '${GMT}'))
			$tasks = Array();
		
		$phpDateTime = new DateTime(null, new DateTimeZone($current_user->getPreference("timezone")));
		$hourOffset = $phpDateTime->getOffset();
		
		if ((!isset($_REQUEST['selected_tasks'])) || ($return_action == 'duplicate')) {
		
			foreach ($tasks as $key=>$task){
		
				$taskValues = explode(":", $task);
		
				$time1 = explode(",", $taskValues[3]);
				
				$reportTimeZoneDiff = ((date("Z")/3600)-$taskArray[1])*-3600;
				$taskValues[3] = date("H,i", @mktime($time1[0],$time1[1],0,date("m"),date("d"),date("Y"))+($hourOffset+$reportTimeZoneDiff));
		
				if((!$timedate->check_matching_format($taskValues[4], $timedate->get_date_format())) && ($taskValues[4]!=""))
					$taskValues[4] = $timedate->swap_formats($taskValues[4], $GLOBALS['timedate']->dbDayFormat, $timedate->get_date_format() );
		
				$tasks[$key] = implode(":", $taskValues);
			}
		
		}
		
		$reportTasks = implode("|", $tasks);
		
		
		return $reportTasks;
	
	}
	
	static public function prepareReportCharts($report_charts) {
		
		$selected_charts = unserialize(base64_decode($report_charts));
		
		if (!empty($selected_charts))
			$selected_charts = (isset($_REQUEST['selected_charts'])) ? $_REQUEST['selected_charts'] : addslashes(json_encode($selected_charts));
		
		return $selected_charts;
		
	}
	
	static public function getAuditTableFields($bean, $fieldsToBeRemoved, $translateFieldLabels, $relate_Field = null) {

		global $app_strings, $app_list_strings;
		
		

		if (empty($relate_Field)) {
	
			$fields = array("id", "parent_id", "date_created", "created_by", "field_name", "data_type", "before_value_string", "after_value_string", "before_value_text", "after_value_text"); //Array con los campos de la tabla seleccionada
		
			if ($translateFieldLabels)
				$fields_labels = array($app_strings["LBL_ID"], translate("LBL_AUDIT_REPORT_PARENT_ID", "asol_Reports"), translate("LBL_DATE_ENTERED", "Audit"), translate("LBL_CREATED_BY", "Audit"), translate("LBL_FIELD_NAME", "Audit"), translate("LBL_AUDIT_REPORT_DATA_TYPE", "asol_Reports"), translate("LBL_OLD_NAME", "Audit")." String", translate("LBL_NEW_VALUE", "Audit")." String", translate("LBL_OLD_NAME", "Audit")." Text", translate("LBL_NEW_VALUE", "Audit")." Text");
			else
				$fields_labels = array("id", "parent_id", "date_created", "created_by", "field_name", "data_type", "before_value_string", "after_value_string", "before_value_text", "after_value_text"); //Array con los labels de los campos de la tabla seleccionada
			
			$fields_type = array("char(36)", "relate", "datetime", "relate", "varchar(100)", "varchar(100)", "varchar(255)", "varchar(255)", "text", "text"); // Array con los tipos de campos de cada elemento del array $fields
			$fields_enum_operators = array("", "", "", "", "", "", "", "", "", "");
			$fields_enum_references = array("", "", "", "", "", "", "", "", "", "");
			
			$has_related = array('false', 'true', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'false'); //Array que indica si los elementos de la tabla fields tienen relacion con alguna otra tabla
			
		} else {
			
			if ($relate_Field == 'parent_id') {
				$relatedTable = $bean->table_name;
				$relatedModule = $bean->module_dir;
			} else if ($relate_Field == 'created_by') {
				$relatedTable = "users";
				$relatedModule = "Users";			
			}
			
			
			$rsrf = self::getModuleResultSetFields($relatedModule, $relatedTable, $fieldsToBeRemoved);

			$k=0;
			
			foreach($rsrf as $val){
				
				$auxField = explode(".", $val['Field']);
				$theField = (count($auxField) == 2) ? $auxField[1] : $val['Field'];
				
				$fieldInfo = asol_Report::getFieldInfoFromVardefs($relatedModule, $theField);
				
				$fields[$k] = (count(explode(".", $val['Field'])) == 1) ? $relatedTable.".".$val['Field'] : $val['Field'];
				
				$vName = (empty($fieldInfo['fieldLabel'])) ? $theField : $fieldInfo['fieldLabel'];
				$tableVname = (!empty($app_list_strings['moduleList'][$relatedModule])) ? $app_list_strings['moduleList'][$relatedModule] : $relatedTable;
				$vName = (count(explode(".", $val['Field'])) >= 1) ? $tableVname.".".$vName : $vName;
				$vName = trim($vName);
				$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;
						
				$fields_labels[$k] = ($translateFieldLabels) ? $vName : $fields[$k];
				
				$fields_enum_operators[$k] = $fieldInfo['enumOperator'];
				$fields_enum_references[$k] = $fieldInfo['enumReference'];
				$fields_type[$k] = self::getFieldType($val['Type'], $fieldInfo['values']);
	
				$k++;
	
			}	
			
		}
		
		return array(
		
			'fields' => $fields,
			'fields_labels' => $fields_labels,
			'fields_type' => $fields_type,
			'fields_enum_operators' => $fields_enum_operators,
			'fields_enum_references' => $fields_enum_references,
			
			'has_related' => $has_related,
		
		);
		
	}
	
	static private function getModuleRelationShips($reportModule, $field) {
		
		$explodedField = explode(".", $field);
		$field = (count($explodedField) == 2) ? $explodedField[1] : $field;

		$rsRightRel = asol_Report::getSelectionResults("SELECT DISTINCT relationship_name, lhs_module as main_module, lhs_module, lhs_table FROM relationships WHERE rhs_module LIKE '".$reportModule."' AND rhs_key LIKE '".$field."'", false);
		$rsLeftRel = asol_Report::getSelectionResults("SELECT DISTINCT relationship_name, lhs_module as main_module, rhs_module, rhs_table FROM relationships WHERE lhs_module LIKE '".$reportModule."' AND lhs_key LIKE '".$field."'", false);

		foreach($rsLeftRel as $leftRel) { //Evitar tablas repetidas

			$duplicatedRelationShip = false;

			foreach($rsRightRel as $rightRel) {

				if ($leftRel['relationship_name'] == $rightRel['relationship_name']) {
					$duplicatedRelationShip = true;
					break;
				}

			}

			if (!$duplicatedRelationShip) {
				$rsRightRel[] = array(
					'relationship_name' => $leftRel['relationship_name'],
					'main_module' => $leftRel['main_module'],
					'lhs_table' => $leftRel['rhs_table'],
					'lhs_module' => $leftRel['rhs_module']
				);
			}

		}
		
		return $rsRightRel;
		
	}
	
	static private function getModuleResultSetFields($reportModule, $reportTable, $fieldsToBeRemoved) {
		
		$rsFields = asol_Report::getSelectionResults("SHOW COLUMNS FROM ".$reportTable, false);
		
		//Eliminamos campo deleted del array rs
		for ($i=0; $i<count($rsFields); $i++) {
			
			if (in_array($rsFields[$i]['Field'], $fieldsToBeRemoved)) {
				array_splice($rsFields, $i, 1);
				$i--;
			}
	
		}
	
		$rsCustomFields = asol_Report::getSelectionResults("SELECT name, type FROM fields_meta_data WHERE custom_module='".$reportModule."' AND type NOT IN ('id', 'relate', 'html', 'iframe', 'encrypt')", false);
		$rsCustomRelatedFields = asol_Report::getSelectionResults("SELECT name, type, ext2, ext3 FROM fields_meta_data WHERE custom_module='".$reportModule."' AND type IN ('relate')", false);
		
		foreach ($rsCustomFields as $customField) {
	
			if (!in_array($reportTable."_cstm.".$customField["name"], $fieldsToBeRemoved)) {
			
				$rsFields[] = array(
					'Field' => $reportTable."_cstm.".$customField["name"],
					'Type' => $customField["type"]
				);
				
			}
	
		}
	
		foreach ($rsCustomRelatedFields as $customRelatedField) {
	
			if (!in_array($reportTable."_cstm.".$customRelatedField["ext3"], $fieldsToBeRemoved)) {
			
				$rsFields[] = array(
					'Field' => $reportTable."_cstm.".$customRelatedField["ext3"],
					'Type' => $customRelatedField["type"],
					'RelateModule' => $customRelatedField["ext2"]
				);
			
			}
	
		}
		
		return $rsFields;
		
	}
	
	static private function getFieldType($fieldType, $fieldValues) {
		
		if ($fieldValues == 'currency') {
			$valueType = 'currency';
		} else if ($fieldValues != '') {
			$valueType = 'enum';
		} else {
			$valueType = $fieldType;
			$valueType = (!strncmp($valueType, 'int', strlen('int'))) ? 'int' : $valueType;
			$valueType = (!strncmp($valueType, 'decimal', strlen('decimal'))) ? 'decimal' : $valueType;
			$valueType = (!strncmp($valueType, 'float', strlen('float'))) ? 'float' : $valueType;
		}
		
		return $valueType;
		
	}
	
	static private function getTranslatedField($reportModule, $fieldName, $fieldLabel) {

		$translation = translate($fieldLabel, $reportModule);
		$translation = trim($translation);
		$translation = (substr($translation, -1) == ':') ? substr($translation, 0, -1) : $translation;

		return (empty($translation) ? $fieldName : $translation);
		
	}
	
	static private function getTranslatedRelatedField($relatedModule, $relatedTable, $relatedField, $fieldLabel) {
		
		global $app_list_strings;
		
		$translation = (empty($fieldLabel)) ? $relatedField : $fieldLabel;
		$tableTranslation = (!empty($app_list_strings['moduleList'][$relatedModule])) ? $app_list_strings['moduleList'][$relatedModule] : $relatedTable;
		
		$translation = (count(explode(".", $relatedField)) >= 1) ? $tableTranslation.".".$translation : $translation;
		$translation = trim($translation);
		$translation = (substr($translation, -1) == ':') ? substr($translation, 0, -1) : $translation;
		
		return $translation;
		
	}
	
	static public function getCrmTableFields($report_module, $bean, $fieldsToBeRemoved, $translateFieldLabels) {
	
		global $app_strings;
		
		$primaryKey = "id";
		$rsFields = self::getModuleResultSetFields($report_module, $bean->table_name, $fieldsToBeRemoved);
	

		$fieldIndex=0;
		
		$fields = array();
		$fields_labels = array();
		$fields_type = array();
		$fields_enum_operators = array();
		$fields_enum_references = array();
		$has_related = array();


		foreach($rsFields as $value) {
	
			if ($value['Type'] != "non-db") {
	
				$explodedField = explode(".", $value['Field']);
				$currentField = (count($explodedField) == 2) ? $explodedField[1]: $value['Field'];
				
				$fieldInfo = asol_Report::getFieldInfoFromVardefs($report_module, $currentField);

				$fields[$fieldIndex] = $value['Field'];
				
				$fields_enum_operators[$fieldIndex] = $fieldInfo['enumOperator'];
				$fields_enum_references[$fieldIndex] = $fieldInfo['enumReference'];
				$fields_type[$fieldIndex] = self::getFieldType($value['Type'], $fieldInfo['values']);
				

				if ($value['Field'] == $primaryKey) { // CRM RelationShips
					
					$rshr = self::getModuleRelationShips($report_module, $value['Field']);
					
					$fields_labels[$fieldIndex] = ($translateFieldLabels) ? $app_strings["LBL_ID"] : $primaryKey;
					$has_related[$fieldIndex] = ((count($rshr) > 0) || ($value['Type'] == "relate")) ? "true" : "false";
	
				} else {
					
					$relatedInfo = asol_Report::getReportsRelatedFields($bean);
					
					if (!empty($relatedInfo)) { // CRM Relate Fields
					
						foreach ($relatedInfo as $info){
		
							$infoIdName = (!empty($info['id_name'])) ? $info['id_name'] : "";
							
							if ($infoIdName == $currentField) {
								
								$fields_labels[$fieldIndex] = ($translateFieldLabels) ? self::getTranslatedField($report_module, $value['Field'], $info['vname']) : $value['Field'];
								$fields_type[$fieldIndex] = "relate";
								$has_related[$fieldIndex] = "true";
								break;
									
							} else {
								
								$normalInfo = $bean->getFieldDefinition($currentField);
								$fields_labels[$fieldIndex] = ($translateFieldLabels) ? self::getTranslatedField($report_module, $value['Field'], $normalInfo['vname']) : $value['Field'];
								$has_related[$fieldIndex] = "false";
		
							}
		
						}
						
					} else { // CRM Standard Fields

						$normalInfo = $bean->getFieldDefinition($currentField);
						$fields_labels[$fieldIndex] = ($translateFieldLabels) ? self::getTranslatedField($report_module, $value['Field'], $normalInfo['vname']) : $value['Field'];
						$has_related[$fieldIndex] = "false";
						
					}
	
				}
	
			}
	
			$fieldIndex++;
			
		}
		

		return array(
		
			'fields' => $fields, //Array con los campos de la tabla seleccionada
			'fields_labels' => $fields_labels, //Array con los labels de los campos de la tabla seleccionada
			'fields_type' => $fields_type, // Array con los tipos de campos de cada elemento del array $fields
			'fields_enum_operators' => $fields_enum_operators,
			'fields_enum_references' => $fields_enum_references,
			
			'has_related' => $has_related, //Array que indica si los elementos de la tabla fields tienen relacion con alguna otra tabla
			
		);
		
	}
	
	static public function getCrmTableRelatedFields($report_module, $bean, $fieldsToBeRemoved, $translateFieldLabels, & $relateField) {
	
		global $app_list_strings;
		
		$primaryKey = "id";
		$rsFields = self::getModuleResultSetFields($report_module, $bean->table_name, $fieldsToBeRemoved);
		
	
		$keys = array();
		$fields_relationship = array();
		$fields_relationship_labels = array();
		
		$fields = array();
		$fields_labels = array();
		$fields_type = array();
		$fields_enum_operators = array();
		$fields_enum_references = array();
		$has_related = array();
	
	
		foreach($rsFields as $value) {
	
			if ($value['Type'] != "non-db") {
	
				$explodedField = explode(".", $value['Field']);
				$currentField = (count($explodedField) == 2) ? $explodedField[1]: $value['Field'];

				$fieldInfo = asol_Report::getFieldInfoFromVardefs($report_module, $currentField);

				if ($value['Field'] == $primaryKey) { // CRM RelationShips
	
					$rshr = self::getModuleRelationShips($report_module, $value['Field']);
	
					if ($relateField == $value['Field']) {
	
						$k = 0;
						$j = 0;
	
						if (count($rshr) > 0) {
	
							while ($j < count($rshr)) {
								
								$relatedModule = $rshr[$j]['lhs_module'];
								$relatedTable = $rshr[$j]['lhs_table'];
								

								$rsrf = self::getModuleResultSetFields($relatedModule, $relatedTable, $fieldsToBeRemoved);

								foreach($rsrf as $val) {
									
									$explodedRelatedField = explode(".", $val['Field']);
									$currentRelatedField = (count($explodedRelatedField) == 2) ? $explodedRelatedField[1]: $val['Field'];
									
									$fieldInfo = asol_Report::getFieldInfoFromVardefs($rshr[$j]['lhs_module'], $currentRelatedField);
									
									$fields[$k] = (count(explode(".", $val['Field'])) == 1) ? $relatedTable.".".$val['Field'] : $val['Field'];
									$fields_labels[$k] = ($translateFieldLabels) ? self::getTranslatedRelatedField($relatedModule, $relatedTable, $currentRelatedField, $fieldInfo['fieldLabel']) : $fields[$k];
									$fields_relationship[$k] = $rshr[$j]['relationship_name'];
									$fields_relationship_labels[$k] = ($translateFieldLabels) ? asol_Report::getRelationShipLabelFromVardefs($rshr[$j]['main_module'], $fields_relationship[$k]) : $fields_relationship[$k];							
									$fields_enum_operators[$k] = $fieldInfo['enumOperator'];
									$fields_enum_references[$k] = $fieldInfo['enumReference'];
									$fields_type[$k] = self::getFieldType($val['Type'], $fieldInfo['values']);
									
									$keys[$k] = $primaryKey." ".$fields_relationship[$k];
									
									$k++;
									
								}
	
								$j++;
	
							}
							
							$relateField = $keys;
	
						} else {
	
							$relatedTable = BeanFactory::newBean(BeanFactory::getObjectName($value['RelateModule']))->table_name;
							$relatedTable = (empty($relatedTable)) ? strtolower($value['RelateModule']) : $relatedTable;						
						
							$rsrf = self::getModuleResultSetFields($value['RelateModule'], $relatedTable, $fieldsToBeRemoved);

							foreach($rsrf as $val) {
								
								$fields[$k] = $relatedTable.".".$val['Field'];
								$fields_labels[$k] = $relatedTable.".".$val['Field'];
								
								$fieldInfo = asol_Report::getFieldInfoFromVardefs($value['RelateModule'], $val['Field']);
								
								$fields_enum_operators[$k] = $fieldInfo['enumOperator'];
								$fields_enum_references[$k] = $fieldInfo['enumReference'];
								$fields_type[$k] = self::getFieldType($val['Type'], $fieldInfo['values']);
								
								$k++;
								
							}
	
							$j++;
	
						}
	
					}
						
				} else { // CRM Relate Fields
					
					$relatedInfo = asol_Report::getReportsRelatedFields($bean);
					$relatedTable = "";
					$relatedModule = "";
						
					if ($relateField == $value['Field']) {
						
						foreach ($relatedInfo as $info){
	
							if ($info['id_name'] == $currentField){
	
								$relatedModule = $info['module'];
								
								$relatedObject = BeanFactory::newBean(BeanFactory::getObjectName($relatedModule));
								$relatedTable = (is_object($relatedObject)) ? $relatedObject->table_name : strtolower($relatedModule);

								break;
	
							}
	
						}
	
	
						$rsrf = self::getModuleResultSetFields($relatedModule, $relatedTable, $fieldsToBeRemoved);
						
						$k = 0;

						foreach($rsrf as $val) {

							$explodedRelatedField = explode(".", $val['Field']);
							$currentRelatedField = (count($explodedRelatedField) == 2) ? $explodedRelatedField[1]: $val['Field'];
							
							$fieldInfo = asol_Report::getFieldInfoFromVardefs($relatedModule, $currentRelatedField);
							
							$fields[$k] = (count(explode(".", $val['Field'])) == 1) ? $relatedTable.".".$val['Field'] : $val['Field'];
							$fields_labels[$k] = ($translateFieldLabels) ? self::getTranslatedRelatedField($relatedModule, $relatedTable, $currentRelatedField, $fieldInfo['fieldLabel']) : $fields[$k]; 
							$fields_relationship[$k] = $relatedModule;
							$fields_relationship_labels[$k] = (!empty($app_list_strings['moduleList'][$relatedModule])) ? $app_list_strings['moduleList'][$relatedModule] : $relatedTable;
							$fields_enum_operators[$k] = $fieldInfo['enumOperator'];
							$fields_enum_references[$k] = $fieldInfo['enumReference'];
							$fields_type[$k] = self::getFieldType($val['Type'], $fieldInfo['values']);
							
							$k++;
							
						}
	
					}
	
				}
	
			}
			
		}
		
		return array(
		
			'fields' => $fields,
			'fields_labels' => $fields_labels,
			'fields_relationship' => $fields_relationship,
			'fields_relationship_labels' => $fields_relationship_labels,
			'fields_type' => $fields_type,
			'fields_enum_operators' => $fields_enum_operators,
			'fields_enum_references' => $fields_enum_references
		
		);
	
	}
	
	static public function getCurrentUserAllowedModules($reportModule) {
		
		global $current_user, $sugar_config, $app_list_strings;
		
		//Obtener los m�dulo a los que tiene acceso el usuario activo
		$module = array();
		$selectedModuleIndex = 0;
		
		$acl_modules = ACLAction::getUserActions($current_user->id);
		$allowedModule = array();
		
		foreach($acl_modules as $key=>$mod){
		
			if($mod['module']['access']['aclaccess'] >= 0){
		
				if ((isset($sugar_config['asolModulesPermissions']['asolAllowedTables'])) || (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']))) {
					//Restrictive
				
					if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) && 
						 (in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) ) {
		
						$allowedModule[$key] = false;
		
					} else if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance'])) &&
								(in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance']))) { 
		
						$allowedModule[$key] = false;
						
					} 
					
					if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) &&
								(in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) ) {
						
						if (!isset($allowedModule[$key]))
							$allowedModule[$key] = true;
									
					} else if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) &&
								(in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) ) {
						
						if (!isset($allowedModule[$key]))
							$allowedModule[$key] = true;
							
					}			
				
				} else {
		
					$allowedModule[$key] = true;
					
				}
		
			}
		
		}
		
		
		foreach ($allowedModule as $key=>$isAllowed) {
		
			if ($isAllowed) {
				$module[$key] = (isset($app_list_strings['moduleList'][$key])) ? $app_list_strings['moduleList'][$key] : $key;
			}
		
		}
	
		asort($module);
		
		return array(
			'allowedModules' => $module,
			'hasAudit' => self::isModuleAudited($reportModule)
		);
			
	}
	
	static public function isModuleAudited($reportModule) {

		$hasAudit = false;

		if (!empty($reportModule)) {
			$bean = BeanFactory::newBean($reportModule);	
			$hasAudit = $bean->is_AuditEnabled();
		}

		return $hasAudit;
		
	}
	
	static public function getSystemUsersAndRoles($isDomainsInstalled) {
	
		global $db, $current_user;
		
		if ($isDomainsInstalled) {
			require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
		}
		
		$users_opts = "";
		$users_sql = "SELECT id, user_name FROM users WHERE deleted=0";
		
		if ($isDomainsInstalled) {
			$users_sql .= asol_manageDomains::getExtendedDomainsWhereQuery('', true);
		}
		
		$users_sql .= " ORDER BY user_name";
		$users_query = $db->query($users_sql);
		while ($users_row = $db->fetchByAssoc($users_query)) {
			$users_opts .= $users_row['id'] . '${comma}' . $users_row['user_name'] . '${pipe}';
		}
		$users_opts = substr($users_opts, 0, -7);
		
		$acl_roles_opts = "";
		$acl_roles_sql = "";
		if ($isDomainsInstalled) {
			$acl_roles_sql .= "SELECT acl_roles.id, acl_roles.name FROM acl_roles LEFT JOIN asol_domains_aclroles ON acl_roles.id=asol_domains_aclroles.aclrole_id WHERE deleted=0 AND asol_domains_aclroles.asol_domain_id='".$current_user->asol_default_domain."'";
		} else {
			$acl_roles_sql .= "SELECT id, name FROM acl_roles WHERE deleted=0";
		}
		$acl_roles_sql .= " ORDER BY name";
		$acl_roles_query = $db->query($acl_roles_sql);
		while ($acl_roles_row = $db->fetchByAssoc($acl_roles_query)) {
			$acl_roles_opts .= $acl_roles_row['id'] . '${comma}' . $acl_roles_row['name'] . '${pipe}';
		}
		$acl_roles_opts = substr($acl_roles_opts,0 , -7);
	
		
		return array(
			'users' => (empty($users_opts)) ? array() : $users_opts,
			'roles' => (empty($acl_roles_opts)) ? array() : $acl_roles_opts
		);
	
	}
	

	static public function getHeaderLinksHtml() {
		
		return '
		<script type="text/javascript" src="modules/asol_Reports/include_basic/js/sendEmail.min.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>
		<script type="text/javascript" src="modules/asol_Reports/include_basic/js/LAB.min.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>
		<script type="text/javascript" src="modules/asol_Reports/include_basic/js/jscolor/jscolor.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>
		<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/css/style.css?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'">
		<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/js/jquery.UI.custom.css">
		';
		
	}
	
	
	static public function getInitJqueryScriptHtml() {
		
		return '
		function initJqueryScripts(loadPlugins, callback) {

			if (loadPlugins) {
			
				if (typeof jQuery === "undefined") {
				
					$LAB.script("modules/asol_Reports/include_basic/js/jquery.min.js").wait().script("modules/asol_Reports/include_basic/js/jquery.blockUI.js").wait().script("modules/asol_Reports/include_basic/js/jquery.UI.min.js").wait(callback);
				 	
				} else if (typeof jQuery.blockUI === "undefined") {
				
					$LAB.script("modules/asol_Reports/include_basic/js/jquery.blockUI.js").wait().script("modules/asol_Reports/include_basic/js/jquery.UI.min.js").wait(callback);
				 	
				} else if (typeof jQuery.ui === "undefined") {
				
					$LAB.script("modules/asol_Reports/include_basic/js/jquery.UI.min.js").wait(callback);
				
				} else {
			
					callback();
			
				}
					
			} else {
			
				if (typeof jQuery === "undefined") {
				
					$LAB.script("modules/asol_Reports/include_basic/js/jquery.min.js").wait(callback);
				 	
				} else {
				
					callback();
				
				}
			
			}
		
		}
		';
		
	}
	
	static public function getDialogFxDisplayHtml() {
		
		return '
		function setDialogFxDisplay() {
	
			$.fx.speeds._default = 500;
			$.extend($.ui.dialog.prototype.options, { width: 500, show: "drop", hide: "drop"});
			
		}
		';
		
	}
	
	static public function getInitEmailFrameHtml($users, $roles) {
		
		return '
		function initEmailFrame() {
	
			selected_option_task("'.$users.'", "'.$roles.'");
		
		}
		';
			
	}
	
	static public function getInitDragDropElementsHtml() {
		
		return '
		function initDragDropElements() {

			<!-- Fields -->
			$("#fields_Table").sortable({ items: ".asolReportsFieldRow"});
			
			<!-- Filters -->
			$("#filters_Table").sortable({ items: ".asolReportsFilterRow"});
			
			<!-- Charts -->
			$("#charts_Table").sortable({ items: ".asolReportsChartsGroup"});
		
			<!-- Tasks -->
			$("#tasks_Table").sortable({ items: ".asolReportsTaskRow"});
				
		}
		';
		
	}
	
	static public function getRememberReportListsHtml($report_fields, $report_filters, $report_charts, $report_charts_engine, $report_tasks, $email_list, $audited_report, $defaultLanguage) {
	
		global $timedate;
		
		return '
		function RememberReportLists() {
			
			RememberFields("fields_Table", \''.$report_fields.'\', "'.$timedate->get_cal_date_format().'", "'.$audited_report.'", "'.$defaultLanguage.'");
			RememberFilters("filters_Table", \''.$report_filters.'\', "'.$timedate->get_cal_date_format().'", "'.$audited_report.'");
			RememberCharts("charts_Table", \''.$report_charts.'\', "'.$report_charts_engine.'");
			RememberTasks("tasks_Table", "'.$report_tasks.'", "'.$timedate->get_cal_date_format().'");
			RememberEmails("'.$email_list.'");
			
		}
		';
	
	}
	
	static public function getInitReportsJavaScriptsHtml($hasPremiumFeatures, $defaultExternalAppParams, $externalApps, $reportType, $reportScheduledType, $sel_scheduledApp, $sel_scheduledCustomUrl, $sel_scheduledCustomFixedParams, $sel_scheduledCustomParams, $sel_scheduledHeaders, $sel_scheduledQuotes, $availablePhpFunctions, $defaultExternalAppParams) {
		
		$externalAppsJson = htmlentities(json_encode($externalApps));
		$reportScheduledType = empty($reportScheduledType) ? 'email' : $reportScheduledType;
		
		$commonJS = '
			initVisibilityToggle(\'fields_Table\', \'index_visible\', \'index_hidden\', \'asolReportsFieldsIndexRow\', \'index_display\', false);	
			initVisibilityToggle(\'fields_Table\', \'field_visible\', \'field_hidden\', \'asolReportsFieldRow\', \'field_display\', true);
			
			initVisibilityToggle(\'charts_Table\', \'chart_visible\', \'chart_hidden\', \'asolReportsChartsGroup\', \'chart_display\', true);
			initVisibilityToggle(\'charts_Table\', \'subchart_visible\', \'subchart_hidden\', \'asolReportsSubChart\', \'chart_display\', true);
			
			initMassiveAction(\'fields_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\');
			initMassiveAction(\'filters_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\');
			initMassiveAction(\'charts_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\');
			initMassiveAction(\'tasks_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\');
			
			if (typeof window.hasPremiumJsFeatures == "function") {
				initAxisSideSwitcher(\'charts_Table\', \'y_axis_left_side\', \'y_axis_right_side\', \'y_axis_side\');
			}
			
			RememberReportLists();
		';
		
		$returnedHtml = '
		function initReportsJavaScripts() {';
			
			if ($hasPremiumFeatures) {
		
				$returnedHtml .= '
				$LAB.script("modules/asol_Reports/include_premium/js/reports.min.js?version='.asol_ReportsUtils::$reports_version.'").wait().script("modules/asol_Reports/include_basic/js/reports.min.js?version='.asol_ReportsUtils::$reports_version.'").wait(function() {

					'.$commonJS.'

					applyChartsRestrictions();

					initExternalApplicationReports("'.$defaultExternalAppParams.'", "'.$externalAppsJson.'", "'.$reportType.'", "'.$reportScheduledType.'", "'.$sel_scheduledApp.'", "'.$sel_scheduledCustomUrl.'", "'.$sel_scheduledCustomFixedParams.'", "'.$sel_scheduledCustomParams.'", "'.$sel_scheduledHeaders.'", "'.$sel_scheduledQuotes.'", "'.$availablePhpFunctions.'", "'.$defaultExternalAppParams.'");

				});';
		
			} else {
			
				$returnedHtml .= '
				$LAB.script("modules/asol_Reports/include_basic/js/reports.min.js?version='.asol_ReportsUtils::$reports_version.'").wait(function() {
		
					'.$commonJS.'
					console.log("Cannot load premium javascript libraries.");
		
				});';
					
			}
		
		$returnedHtml .= '
		}';
		
		return $returnedHtml;
		
	}
	
	static public function getOnloadJavaScript() {
		
		return '
		function loadReportsManagementJavaScript() {
			initJqueryScripts(true, function() {	
				$.blockUI({ theme: true, title: null, message: $("#loadingBlockDiv") });
				setDialogFxDisplay();
				initDragDropElements();
				initEmailFrame();
				initReportsJavaScripts();
				$.unblockUI();
			});
		}
		';
		
	}
		
	
	static public function getFieldsPanelHtml($database, $selectedModule, $audited_report) {
		
		global $mod_strings, $timedate, $sugar_config;
		
		$availablePhpFunctions = (isset($sugar_config['asolReportsExternalApplicationPhpAllowedFunctions'])) ? implode(',', $sugar_config['asolReportsExternalApplicationPhpAllowedFunctions']) : ''; 
		
		$moduleFields = self::getFieldsSelectHtml($database, $selectedModule, $audited_report);
		$moduleRelatedFields = self::getRelatedFieldsSelectHtml($database, $selectedModule, '', $audited_report);
		
		return '
		<table>
			<tr>
				<td>
					<h4>'.$mod_strings['LBL_REPORT_FIELDS'].'</h4>
				</td>
			</tr>
		
			<tr>
				<td id="reportTableFieldsTd">
					'.$moduleFields['html'].'
				</td>
			</tr>
		
			<tr>
				<td>
					<input disabled type="button" title="'.$mod_strings['LBL_REPORT_ADD_FIELDS'].'" class="button" id="addFieldsButton" name="addFieldsButton" value="'.$mod_strings['LBL_REPORT_ADD_FIELDS'].'" onClick="'.$moduleFields['javascript'].'">
					<input type="button" title="'.$mod_strings['LBL_REPORT_SHOW_RELATED'].'" class="button" style="visibility: hidden" id="show_related_button" name="show_related_button" value="'.$mod_strings['LBL_REPORT_SHOW_RELATED'].'" onClick="if ((document.getElementById(\'fields\').options[document.getElementById(\'fields\').selectedIndex].style.color == \'blue\') && (countSelectedOptions(\'fields\') == 1)) { $.blockUI({ theme: true, title: null, message: $(\'#loadingBlockDiv\') }); $.ajax({ url: \'index.php?entryPoint=reportGenerateHtml&htmlTarget=reportRelatedTableFields&selectedDb=\'+$(\'#alternative_database\').val()+\'&selectedModule=\'+$(\'#report_module\').val()+\'&selectedRhsKey=\'+$(\'#fields\').val()+\'&isAudited=\'+(($(\'#audited_report\').is(\':checked\')) ? 1 : 0), success: function(data) { $(\'#reportTableRelatedFieldsTd\').html(data); $.unblockUI(); }}); }">
				</td>
			</tr>
		
			<tr>
				<td>
					<h4>'.$mod_strings['LBL_REPORT_RELATED_FIELDS'].'</h4>
				</td>
			</tr>
		
			<tr>
				<td id="reportTableRelatedFieldsTd">
					'.$moduleRelatedFields['html'].'
				</td>
			</tr>
		
			<tr>
				<td>
					<input type="button" title="'.$mod_strings['LBL_REPORT_ADD_RELATED_FIELDS'].'" class="button" id="addRelatedFieldsButton" name="addRelatedFieldsButton" value="'.$mod_strings['LBL_REPORT_ADD_RELATED_FIELDS'].'" onClick="'.$moduleRelatedFields['javascript'].'">
				</td>
			</tr>
		
		</table>';
				
	}
	
	
	static public function getFieldsSelectHtml($database, $selectedModule, $audited_report = 0) {
		
		global $db, $sugar_config, $timedate, $mod_strings;

		
		$defaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
		$translateFieldLabels = ((!isset($sugar_config['asolReportsTranslateLabels'])) || ($sugar_config['asolReportsTranslateLabels'])) ? true : false;
		$isAudited = false;
		
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		
		$rhs_key = (isset($_REQUEST['rhs_key'])) ? $_REQUEST['rhs_key'] : "";
		$currentTableFields = array();
	
		if (($database >= 0) && ($selectedModule != '')) {
				
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'alternative_database' => $database,
				'sel_altDbTable' => $selectedModule,
				'rhs_key' => $rhs_key
			);
			
			$currentTableFields = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalTableFields", $extraParams);
			
			if ($currentTableFields !== false) {
				$rhs_key = $currentTableFields['rhs_key'];
			}
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			
		} else if (($selectedModule != '')) {
				
			$fieldsToBeRemoved = self::getNonVisibleFields($selectedModule, $isDomainsInstalled);
			$isAudited = self::isModuleAudited($selectedModule);
			$bean = BeanFactory::newBean($selectedModule);
				
			if ($audited_report == 1)
				$currentTableFields = asol_ReportsManagementFunctions::getAuditTableFields($bean, $fieldsToBeRemoved, $translateFieldLabels);
			else 
				$currentTableFields = asol_ReportsManagementFunctions::getCrmTableFields($selectedModule, $bean, $fieldsToBeRemoved, $translateFieldLabels);
				
		}
			
		
		$fields = (isset($currentTableFields['fields'])) ? $currentTableFields['fields'] : null;
		$fields_labels = (isset($currentTableFields['fields_labels'])) ? $currentTableFields['fields_labels'] : null;
		$fields_type = (isset($currentTableFields['fields_type'])) ? $currentTableFields['fields_type'] : null;
		$fields_enum_operators = (isset($currentTableFields['fields_enum_operators'])) ? $currentTableFields['fields_enum_operators'] : null;
		$fields_enum_references = (isset($currentTableFields['fields_enum_references'])) ? $currentTableFields['fields_enum_references'] : null;
		
		$has_related = (isset($currentTableFields['has_related'])) ? $currentTableFields['has_related'] : null;

		
		//Order Fields By Presentation Label
		$fields_labels_lowercase = array_map('strtolower', (!empty($fields_labels) ? $fields_labels : array() ));
		if (!empty($fields_labels_lowercase))
			array_multisort($fields_labels_lowercase, $fields_labels, $fields, $fields_type, $fields_enum_operators, $fields_enum_references, $has_related);


		$fields = (!empty($fields)) ? $fields : array();
		$fields_labels = (!empty($fields_labels)) ? $fields_labels : array();
		$fields_labels_js = (!empty($fields_labels)) ? implode('${pipe}', str_replace('&#039;', '${sq}', str_replace("'", '${sq}', $fields_labels))) : array();
		
		$fields_type = (!empty($fields_type)) ? implode(',',$fields_type) : array();
		
		$fields_enum_operators = (!empty($fields_enum_operators)) ? str_replace('&#039;', '${sq}', str_replace("'", '${sq}', implode('${comma}', $fields_enum_operators))) : "";
		$fields_enum_references = (!empty($fields_enum_references)) ? str_replace('&#039;', '${sq}', str_replace("'", '${sq}', implode('${comma}', $fields_enum_references))) : "";
		
		$has_related = (!empty($has_related)) ? $has_related : array();
		

		$returnedHtml = '<select name="fields" id="fields" multiple size=10 onchange="if (this.selectedIndex != -1) { if (this.options[this.selectedIndex].style.color == \'blue\') { document.getElementById(\'show_related_button\').style.visibility = \'visible\'; } else { document.getElementById(\'show_related_button\').style.visibility = \'hidden\'; } } document.getElementById(\'addFieldsButton\').disabled = (this.selectedIndex == -1);" onDblClick="if (this.selectedIndex != -1) { if (this.options[this.selectedIndex].style.color == \'blue\') { $.blockUI({ theme: true, title: null, message: $(\'#loadingBlockDiv\') }); $.ajax({ url: \'index.php?entryPoint=reportGenerateHtml&htmlTarget=reportRelatedTableFields&selectedDb=\'+$(\'#alternative_database\').val()+\'&selectedModule=\'+$(\'#report_module\').val()+\'&selectedRhsKey=\'+this.value+\'&isAudited=\'+(($(\'#audited_report\').is(\':checked\')) ? 1 : 0), success: function(data) { $(\'#reportTableRelatedFieldsTd\').html(data); $.unblockUI(); }}); } }">';		

		foreach ($fields as $field_index=>$field) {

			if ($has_related[$field_index] != "false") {
				
				$returnedHtml .= '<option style="color:blue;" title="'.$field.'" value="'.$field.'">'.$fields_labels[$field_index].' +</option>';
			
			} else {
				
				$returnedHtml .= '<option title="'.$field.'" value="'.$field.'">'.$fields_labels[$field_index].'</option>';
				
			}
				
		}

		$returnedHtml .= '</select>';
		
		
		$returnedJavascript = 'InsertFields(\'fields_Table\', \'fields\', \''.$fields_labels_js.'\', \''.$fields_type.'\', null, \''.$rhs_key.'\', \'\', \'\', \''.$fields_enum_operators.'\', \''.$fields_enum_references.'\', \'\', \'\', \''.$timedate->get_cal_date_format().'\', \''.$audited_report.'\', \''.$defaultLanguage.'\');';
		
		return array(
			'html' => $returnedHtml,
			'javascript' => $returnedJavascript,
			'isAudited' => $isAudited
		);
				
	}
	
	static public function addRelationShipNameToLowerCase($fieldLabel, $relationShipLabel) {

		$fieldLabelArray = explode('.', $fieldLabel);
		$tableName = array_shift($fieldLabelArray);
		 
		return strtolower($tableName.'.'.$relationShipLabel.'.'.implode('.', $fieldLabelArray));
		  
	}
	
	static public function getRelatedFieldsSelectHtml($database, $selectedModule, $rhsKey, $audited_report = 0) {
		
		global $db, $sugar_config, $timedate, $mod_strings;

		
		$defaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
		$translateFieldLabels = ((!isset($sugar_config['asolReportsTranslateLabels'])) || ($sugar_config['asolReportsTranslateLabels'])) ? true : false;
		

		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		
		$currentTableFields = array();
	
		if (empty($rhsKey)) {

			return array(
				'html' => '<select id="related_fields" name="related_fields" size=10 onDblClick="" multiple></select>',
				'javascript' => ''
			);
			
		}
		
		if (($database >= 0) && ($selectedModule != '')) {
			
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'alternative_database' => $database,
				'sel_altDbTable' => $selectedModule,
				'rhs_key' => $rhsKey
			);
			
			$currentTableFields = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalTableFields", $extraParams);
			
			if ($currentTableFields !== false) {
				$rhsKey = $currentTableFields['rhs_key'];
			}
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			
		} else if (($selectedModule != '')) {
			
			$fieldsToBeRemoved = self::getNonVisibleFields($selectedModule, $isDomainsInstalled);
			$bean = BeanFactory::newBean($selectedModule);
				
			if ($audited_report == 1)
				$currentTableFields = asol_ReportsManagementFunctions::getAuditTableFields($bean, $fieldsToBeRemoved, $translateFieldLabels, $rhsKey);
			else 
				$currentTableFields = asol_ReportsManagementFunctions::getCrmTableRelatedFields($selectedModule, $bean, $fieldsToBeRemoved, $translateFieldLabels, $rhsKey);
				
		}
			
		$fields_relationship = (isset($currentTableFields['fields_relationship'])) ? $currentTableFields['fields_relationship'] : null;
		$fields_relationship_labels = (isset($currentTableFields['fields_relationship_labels'])) ? $currentTableFields['fields_relationship_labels'] : null;
		
		$fields = (isset($currentTableFields['fields'])) ? $currentTableFields['fields'] : null;
		$fields_labels = (isset($currentTableFields['fields_labels'])) ? $currentTableFields['fields_labels'] : null;
		$fields_type = (isset($currentTableFields['fields_type'])) ? $currentTableFields['fields_type'] : null;
		$fields_enum_operators = (isset($currentTableFields['fields_enum_operators'])) ? $currentTableFields['fields_enum_operators'] : null;
		$fields_enum_references = (isset($currentTableFields['fields_enum_references'])) ? $currentTableFields['fields_enum_references'] : null;


		$fields_labels_lowercase = array_map(array("self", "addRelationShipNameToLowerCase"), (!empty($fields_labels) ? $fields_labels : array()), (!empty($fields_relationship_labels) ? $fields_relationship_labels : array()) );
		
		if (!empty($fields_labels_lowercase)) {
			if (is_array($rhsKey))
				array_multisort($fields_labels_lowercase, $fields_labels, $fields, $fields_relationship_labels, $fields_relationship, $fields_type, $fields_enum_operators, $fields_enum_references, $rhsKey);
			else
				array_multisort($fields_labels_lowercase, $fields_labels, $fields, $fields_relationship_labels, $fields_relationship, $fields_type, $fields_enum_operators, $fields_enum_references);
		}
			
		$rhsKey = (is_array($rhsKey) ? implode('${comma}', $rhsKey) : $rhsKey);
		

		$fields = (!empty($fields)) ? $fields : array();
		$fields_labels = (!empty($fields_labels)) ? $fields_labels : array();
		$fields_labels_js = (!empty($fields_labels)) ? implode('${pipe}', str_replace('&#039;', '${sq}', str_replace("'", '${sq}', $fields_labels))) : array();
		
		$fields_relationship = (!empty($fields_relationship)) ? $fields_relationship : array();
		$fields_relationship_labels = (!empty($fields_relationship_labels)) ? $fields_relationship_labels : array();
		
		$fields_type = (!empty($fields_type)) ? implode(',', $fields_type) : array();
		
		$fields_enum_operators = (!empty($fields_enum_operators)) ? str_replace('&#039;', '${sq}', str_replace("'", '${sq}', implode('${comma}', $fields_enum_operators))) : "";
		$fields_enum_references = (!empty($fields_enum_references)) ? str_replace('&#039;', '${sq}', str_replace("'", '${sq}', implode('${comma}', $fields_enum_references))) : "";
				

		
		$returnedHtml = '<select id="related_fields" name="related_fields" size=10 onDblClick="" multiple>';

		$aux_counter = 0;
		$aux_previous_module = "";

		foreach ($fields as $field_index=>$field) {

			$aux_current_module = explode(".", $field);
			$aux_current_module = str_replace("_cstm", "", $aux_current_module[0]);
			$aux_current_module = $fields_relationship[$field_index].$aux_current_module;
			
			
			if ($aux_current_module != $aux_previous_module) {
			
				if ($aux_counter != 0) {
					$returnedHtml .= '</optgroup>';
				}
				
				if ($aux_counter + 1 != count($fields)) {
					
					$fields_label_array = explode(".", $fields_labels[$field_index]);
					$aux_current_module_label = $fields_label_array[0];
					
					if (($aux_current_module_label == $fields_relationship_labels[$field_index]) || ($fields_relationship_labels[$field_index] == ""))
						$returnedHtml .= '<optgroup title="'.$aux_current_module_label.'" label="'.$aux_current_module_label.'">';
					else
						$returnedHtml .= '<optgroup title="'.$aux_current_module_label.' ('.$fields_relationship_labels[$field_index].')" label="'.$aux_current_module_label.' ('.$fields_relationship_labels[$field_index].')">';
					
				}
				
			}

			$field_array = explode(".", $fields_labels[$field_index]);
			$returnedHtml .= '<option title="'.$field.'" value="'.$field.'">'.$field_array[1].'</option>';
		
			$aux_previous_module = $aux_current_module;
			$aux_counter++;
		
		}
		
		$returnedHtml .= '</optgroup>';
		$returnedHtml .= '</select>';
		
		
		$returnedJavascript = 'InsertFields(\'fields_Table\', null, \'\', \'\', \'related_fields\', \''.$rhsKey.'\', \''.$fields_labels_js.'\', \''.$fields_type.'\', \'\', \'\', \''.$fields_enum_operators.'\', \''.$fields_enum_references.'\', \''.$timedate->get_cal_date_format().'\', \''.$audited_report.'\', \''.$defaultLanguage.'\');';
		
		return array(
			'html' => $returnedHtml,
			'javascript' => $returnedJavascript
		);
				
	}
	
	static public function getFieldsHeadersHtml($row_index_display) {
		
		global $mod_strings;
		
		$returnedHtml = '
		<h4>
			'.$mod_strings['LBL_REPORT_COLUMNS'].'
			<img title="'.$mod_strings['LBL_REPORT_TABLE_CONFIGURATION'].'" style="vertical-align: text-bottom; display: inline;" src="modules/asol_Reports/include_basic/images/asol_reports_configure_table.png" class="asol_icon configure_table_btn clickable" onclick="showTableConfig(\'tableConfiguration_0\');">
		</h4>
		<input type="hidden" id="tableConfiguration_0" />
		<table id="fields_Table" class="list view">
			<thead>
				<tr>
					<th nowrap="nowrap" scope="col" class="center">
						<input type="checkbox" class="massiveCheck_all" />
						<input type="hidden" id="fieldsGlobalIndex" value="0">
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_ALIAS'].'
						<img title="'.$mod_strings['LBL_REPORT_FIELD_ORDERING'].'" style="vertical-align: text-bottom; display: inline;" src="modules/asol_Reports/include_basic/images/asol_reports_reorder.png" class="asol_icon reorder_fields_btn clickable" onclick="showFieldOrdering();">
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_DISPLAY'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_FUCTION'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_GROUP_BY_LAYOUT'].'
						<img title="'.$mod_strings['LBL_REPORT_GROUP_ORDERING'].'" style="vertical-align: text-bottom; display: inline;" src="modules/asol_Reports/include_basic/images/asol_reports_reorder.png" class="asol_icon reorder_grouping_btn clickable" onclick="showGroupOrdering();">
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
					</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<td colspan="7">
						<input disabled type="button" class="massiveBtn_all" value="'.$mod_strings['LBL_REPORT_MULTIDELETE_ROW'].'" onClick="deleteRowsByCustomCode(\'fields_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\', \'LBL_REPORT_MULTIDELETE_ROW_ALERT\', \'deleteFieldCode\');"/>
					</td>
				</tr>
			</tfoot>
			
			<tbody>';
		
		if ($row_index_display == '1') {
			$returnedHtml.= 
				'<tr class="asolReportsFieldsIndexRow">';
		} else {
			$returnedHtml.= 
				'<tr class="asolReportsFieldsIndexRow hiddenRow">';
		}
			
		$returnedHtml.=
					'<td></td>	
					<td><b>'.$mod_strings['LBL_REPORT_ROW_INDEX'].'</b></td>
					<td>';

							$returnedHtml .= '<input type="hidden" name="rowIndexDisplay" id="rowIndexDisplay" value="'.$row_index_display.'" class="index_display">';
							if ($row_index_display == '1') {
								$returnedHtml .= '<img title="'.$mod_strings['LBL_REPORT_VISIBLE'].'" src="modules/asol_Reports/include_basic/images/asol_reports_visible.png" class="index_visible clickable">';
								$returnedHtml .= '<img title="'.$mod_strings['LBL_REPORT_HIDDEN'].'" src="modules/asol_Reports/include_basic/images/asol_reports_hidden.png" class="index_hidden clickable" style="display: none;">';
							} else {
								$returnedHtml .= '<img title="'.$mod_strings['LBL_REPORT_VISIBLE'].'" src="modules/asol_Reports/include_basic/images/asol_reports_visible.png" class="index_visible clickable" style="display: none;">';
								$returnedHtml .= '<img title="'.$mod_strings['LBL_REPORT_HIDDEN'].'" src="modules/asol_Reports/include_basic/images/asol_reports_hidden.png" class="index_hidden clickable">';
							}
							
					$returnedHtml .= '	
					</td>
					<td colspan="4"></td>
				</tr>
			</tbody>
		</table>
		
		<div id="tableConfigurationDialog" class="tableConfigurationDialog" style="display: none">
			<table class="edit view edit508">
				<tbody>
					<tr>
						<th colspan="2">
							<h4>'.$mod_strings['LBL_REPORT_VISIBILITY'].'</h4>
						</th>
					</tr>
					<tr>
						<td scope="col">
							<label for="subtotals_visibility">'.$mod_strings['LBL_REPORT_SUBTOTALS'].':</label>
						</td>
						<td>
							<select id="subtotals_visibility">
								<option value="true">'.$mod_strings['LBL_REPORT_VISIBLE'].'</option>
								<option value="false">'.$mod_strings['LBL_REPORT_HIDDEN'].'</option>
							</select>
						</td>
					</tr>
					<tr>
						<td scope="col">
							<label for="totals_visibility">'.$mod_strings['LBL_REPORT_TOTALS'].':</label>
						</td>
						<td>
							<select id="totals_visibility">
								<option value="true">'.$mod_strings['LBL_REPORT_VISIBLE'].'</option>
								<option value="false">'.$mod_strings['LBL_REPORT_HIDDEN'].'</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" id="tableConfigStore" />
			<input type="button" onclick="saveTableConfig();" value="'.$mod_strings['LBL_REPORT_SAVE'].'" />
			<input type="button" onclick="discardTableConfig();" value="'.$mod_strings['LBL_REPORT_CANCEL'].'" />
		</div>
		<div id="tableFieldOrderingDialog" class="tableFieldOrderingDialog" style="display: none">
			<table class="edit view edit508">
				<thead>
					<tr>
						<th colspan="2">
							<h4>'.$mod_strings['LBL_REPORT_FIELD_ORDERING'].'</h4>
						</th>
					</tr>
				</thead>
				<tbody class="fieldOrderListContainer">
				</tbody>
			</table>
			<input type="button" onclick="saveFieldOrdering();" value="'.$mod_strings['LBL_REPORT_SAVE'].'" />
			<input type="button" onclick="discardFieldOrdering();" value="'.$mod_strings['LBL_REPORT_CANCEL'].'" />
		</div>
		<div id="tableGroupOrderingDialog" class="tableGroupOrderingDialog" style="display: none">
			<table class="edit view edit508">
				<thead>
					<tr>
						<th colspan="2">
							<h4>'.$mod_strings['LBL_REPORT_GROUP_ORDERING'].'</h4>
						</th>
					</tr>
				</thead>
				<tbody class="groupOrderListContainer">
				</tbody>
			</table>
			<input type="button" onclick="saveGroupOrdering();" value="'.$mod_strings['LBL_REPORT_SAVE'].'" />
			<input type="button" onclick="discardGroupOrdering();" value="'.$mod_strings['LBL_REPORT_CANCEL'].'" />
		</div>
		';

		return $returnedHtml;
				
	}
	
	public static function getFiltersHeadersHtml($results_limit) {
		
		global $mod_strings;
		
		$returnedHtml = '
		<h4>
			'.$mod_strings['LBL_REPORT_FILTERS'].'
			<img title="'.$mod_strings['LBL_REPORT_FILTERS_CONFIGURATION'].'" style="vertical-align: text-bottom; display: inline;" src="modules/asol_Reports/include_basic/images/asol_reports_configure_filters.png" class="asol_icon configure_filters_btn clickable" onclick="showFiltersConfig();">
		</h4>
		<input type="hidden" id="filtersConfiguration" />
		<table id="filters_Table" class="list view">
			<thead>
				<tr>
					<th nowrap="nowrap" scope="col" class="center">
						<input type="checkbox" class="massiveCheck_all" />
						<input type="hidden" id="filtersGlobalIndex" value="0">
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_LOGICAL_OPERATORS'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_ALIAS'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_ROW_REF'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_BEHAVIOR'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_USER_INPUT_OPTS'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_OPERATOR'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_FIRST_PARAMETER'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_SECOND_PARAMETER'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
					</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<td colspan="10">
						<input disabled type="button" class="massiveBtn_all" value="'.$mod_strings['LBL_REPORT_MULTIDELETE_FILTER'].'" onClick="deleteRows(\'filters_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\', \'LBL_REPORT_MULTIDELETE_FILTER_ALERT\');"/>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td><b>'.$mod_strings['LBL_REPORT_RESULTS'].'</b></td>
					<td colspan="3"></td>
					<td>
						<select id="results_limit_op" name="results_limit_op" onChange="if (this.value == \'all\') { document.getElementById(\'results_limit_param\').style.visibility=\'hidden\'; document.getElementById(\'results_limit_amount\').style.visibility=\'hidden\'; } else { document.getElementById(\'results_limit_param\').style.visibility=\'visible\'; document.getElementById(\'results_limit_amount\').style.visibility=\'visible\'; }">';
	
							if ($results_limit['operator'] == "all")
								$returnedHtml .= '<option value="all" selected>'.$mod_strings['LBL_REPORT_ALL'].'</option>';
							else
								$returnedHtml .= '<option value="all">'.$mod_strings['LBL_REPORT_ALL'].'</option>';
								
							if ($results_limit['operator'] == "limit")
								$returnedHtml .= '<option value="limit" selected>'.$mod_strings['LBL_REPORT_LIMIT'].'</option>';
							else
								$returnedHtml .= '<option value="limit">'.$mod_strings['LBL_REPORT_LIMIT'].'</option>';
	
					$returnedHtml .= '
						</select>
					</td>
					<td>';
					
						if ($results_limit['operator'] == 'all')
							$returnedHtml .= '<select id="results_limit_param" name="results_limit_param" style="visibility: hidden;">';
						else
							$returnedHtml .= '<select id="results_limit_param" name="results_limit_param" style="visibility: visible;">';
							
							if ($results_limit['first_param'] == "first")
								$returnedHtml .= '<option value="first" selected>'.$mod_strings['LBL_REPORT_FIRST_RESULTS'].'</option>';
							else
								$returnedHtml .= '<option value="first">'.$mod_strings['LBL_REPORT_FIRST_RESULTS'].'</option>';
								
							if ($results_limit['first_param'] == "last")
								$returnedHtml .= '<option value="last" selected>'.$mod_strings['LBL_REPORT_LAST_RESULTS'].'</option>';
							else
								$returnedHtml .= '<option value="last">'.$mod_strings['LBL_REPORT_LAST_RESULTS'].'</option>';
						
					$returnedHtml .= '
						</select>
					</td>
					<td>';
	
						if ($results_limit['operator'] == 'all')
							$returnedHtml .= '<input type="text" id="results_limit_amount" name="results_limit_amount" value="'.$results_limit['second_param'].'" style="visibility: hidden;">';
						else
							$returnedHtml .= '<input type="text" id="results_limit_amount" name="results_limit_amount" value="'.$results_limit['second_param'].'" style="visibility: visible;">';
					
					$returnedHtml .= '
					</td>
					<td>
					</td>
				</tr>
			</tbody>
		</table>
		<div id="filtersConfigurationDialog" class="filtersConfigurationDialog" style="display: none">
			<table class="edit view edit508">
				<tbody>
					<tr>
						<th colspan="2">
							<h4>'.$mod_strings['LBL_REPORT_USER_INPUT'].'</h4>
						</th>
					</tr>
					<tr>
						<td>
							'.asol_ReportsManagementFunctions::getReportInitialExecutionHtml($initialExecutionFlag).'
						</td>
					</tr>
				</tbody>
			</table>
			<input type="button" onclick="saveFiltersConfig();" value="'.$mod_strings['LBL_REPORT_SAVE'].'" />
			<input type="button" onclick="discardFiltersConfig();" value="'.$mod_strings['LBL_REPORT_CANCEL'].'" />
		</div>';
					
		return $returnedHtml;
		
	}
	
	public static function getChartsHeadersHtml($selectedEngine) {
		
		global $mod_strings;
		
		$returnedHtml = '';
		
		$returnedHtml .= '
		<table id="charts_Table_Wrapper" class="edit view">
			<tr>
				<td>
					<h4 class="reportPanelHeader">'.asol_ReportsManagementFunctions::getCollapsableHeader('LBL_REPORT_CHARTS_TITLE', 'charts').'</h4>
		';
		
		//***********************//
		//***AlineaSol Premium***//
		//***********************//
		$extraParams = array(
			'selectedEngine' => $selectedEngine,
		);
		
		$returnedPremiumHtml = asol_ReportsUtils::managePremiumFeature("chartsEngineInput", "reportFunctions.php", "getChartsEngineTable", $extraParams);
		$returnedHtml .= ($returnedPremiumHtml !== false) ? $returnedPremiumHtml : '';
		//***********************//
		//***AlineaSol Premium***//
		//***********************//
		
		$returnedHtml .= '
					<table class="list view" id="charts_Table">
						<thead>
							<tr>
								<th nowrap="nowrap" scope="col" class="center">
									<input type="checkbox" class="massiveCheck_all" />
								</th>
								<th nowrap="nowrap" scope="col">
									<div align="left" width="100%" style="white-space: nowrap;">
									'.$mod_strings['LBL_REPORT_CHARTS_NAME'].'
									</div>
								</th>
								<th nowrap="nowrap" scope="col">
									<div align="left" width="100%" style="white-space: nowrap;">
									'.$mod_strings['LBL_REPORT_DISPLAY'].'
									</div>
								</th>
								<th nowrap="no wrap" scope="col">
									<div align="left" width="100%" style="white-space: nowrap;">
									'.$mod_strings['LBL_REPORT_CHARTS_TYPE'].'
									</div>
								</th>
								<th nowrap="nowrap" scope="col">
									<div align="left" width="100%" style="white-space: nowrap;">
									'.$mod_strings['LBL_REPORT_CHARTS_Y_AXIS'].'
									</div>
								</th>';
								
								
								//***********************//
								//***AlineaSol Premium***//
								//***********************//
								$returnedPremiumHtml = asol_ReportsUtils::managePremiumFeature("bubbleReportCharts", "reportFunctions.php", "getChartsZIndexHeader", null);
								$returnedHtml .= ($returnedPremiumHtml !== false) ? $returnedPremiumHtml : '';
								//***********************//
								//***AlineaSol Premium***//
								//***********************//
								
								
		$returnedHtml .= '								
								<th nowrap="nowrap" scope="col">
									<div align="right" style="white-space: nowrap;" width="100%">
										<input type="button" class="button" value="'.$mod_strings['LBL_REPORT_ADD_CHART'].'" onClick="insertChart(\'charts_Table\'); if (typeof window.hasPremiumJsFeatures == \'function\') { applyChartsRestrictions(); };">
										<input type="hidden" value="0" id="chartsGlobalIndex">
									</div>
								</th>
							</tr>
						</thead>
						
						<tfoot>
							<tr>
								<td colspan="7">
									<input disabled type="button" class="massiveBtn_all" value="'.$mod_strings['LBL_REPORT_MULTIDELETE_CHART'].'" onClick="deleteRowsByCustomCode(\'charts_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\', \'LBL_REPORT_MULTIDELETE_CHART_ALERT\', \'deleteChartCode\');"/>
								</td>
							</tr>
						</tfoot>
			
					</table>
				</td>
			</tr>
		</table>';
		
		return $returnedHtml;
		
	}
	
	public static function getTasksHeadersHtml() {
		
		global $timedate, $mod_strings;
		
		$returnedHtml = '
		<h4 class="reportPanelHeader">'.asol_ReportsManagementFunctions::getCollapsableHeader('LBL_REPORT_SCHEDULED_TASKS', 'scheduledDiv').'</h4>
		<table class="list view" id="tasks_Table">
			<thead>
				<tr>
					<th nowrap="nowrap" scope="col" class="center">
						<input type="checkbox" class="massiveCheck_all" />
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_TASK_NAME'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_EXECUTION_RANGE'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_DAY_VALUE'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_TIME_VALUE'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_EXECUTION_END_DATE'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="left" width="100%" style="white-space: nowrap;">
						'.$mod_strings['LBL_REPORT_TASK_STATE'].'
						</div>
					</th>
					<th nowrap="nowrap" scope="col">
						<div align="right" width="100%" style="white-space: nowrap;">
						<input type="button" class="button" value="'.$mod_strings['LBL_REPORT_ADD_TASK'].'" onClick="insertTask(\'tasks_Table\', \''.$timedate->get_cal_date_format().'\')">
						<input type="hidden" id="tasksGlobalIndex" value="0">
						</div>
					</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<td colspan="8">
						<input disabled type="button" class="massiveBtn_all" value="'.$mod_strings['LBL_REPORT_MULTIDELETE_TASK'].'" onClick="deleteRows(\'tasks_Table\', \'massiveCheck\', \'massiveCheck_all\', \'massiveBtn_all\', \'LBL_REPORT_MULTIDELETE_TASK_ALERT\');"/>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
			</tbody>
		</table>
		';
		
		return $returnedHtml;
		
	}
	
	public static function getHiddenInputs($report_id, $rhs_key, $mySQLcheckInsecurity, $PHPcheckInsecurity, $predefinedColorPaletteSchemasJson) {
		
		$returnedHtml = '
		<input type="hidden" value="asol_Reports" name="module">
		<input type="hidden" value="'.$report_id.'" name="record">
		<input type="hidden" value="false" name="isDuplicate">
		<input type="hidden" value="EditView" name="action">
		<input type="hidden" value="asol_Reports" name="return_module">
		<input type="hidden" value="refresh" name="return_action">
		<input type="hidden" value="" name="relate_id">
		<input type="hidden" value="'.$rhs_key.'" name="rhs_key">
		<input type="hidden" name="module_tab">
		<input type="hidden" name="contact_role">
		<input type="hidden" value="asol_Reports" name="relate_to">
		<input type="hidden" value="1" name="offset">
		<input type="hidden" value="-1" name="rowIndex">

		<input type="hidden" value="" name="selected_fields">
		<input type="hidden" value="" name="selected_filters">
		<input type="hidden" value="" name="selected_tasks">
		<input type="hidden" value="" name="selected_charts">
		<input type="hidden" value="" name="email_list">

		<input type="hidden" value="" name="row_index_display">
		<input type="hidden" value="" name="results_limit">
		
		<input type="hidden" value="'.$mySQLcheckInsecurity.'" id="mySQLcheckInsecurity">
		<input type="hidden" value="'.$PHPcheckInsecurity.'" id="PHPcheckInsecurity">
		<input type="hidden" value="'.$predefinedColorPaletteSchemasJson.'" id="predefinedColorPaletteSchemas">
		';
		
		return $returnedHtml;
		
	}
	
	public static function getSubmitButtons($availablePhpFunctions) {
		
		global $app_strings;
		
		$returnedHtml = '
		<input type="submit" value="'.$app_strings['LBL_SAVE_BUTTON_LABEL'].'" name="button" onclick="this.form.return_action.value=\'index\'; this.form.action.value=\'save\'; this.form.selected_fields.value=formatFields(\''.asol_ReportsUtils::$reports_version.'\'); this.form.selected_filters.value=formatFilters(\''.asol_ReportsUtils::$reports_version.'\'); this.form.selected_tasks.value=formatTasks(); this.form.selected_charts.value=formatCharts(\''.asol_ReportsUtils::$reports_version.'\'); this.form.email_list.value=format_email_list(); this.form.row_index_display.value=document.getElementById(\'rowIndexDisplay\').value; this.form.results_limit.value=formatResultsLimit(); return checkCreationForm(\''.$availablePhpFunctions.'\');" class="button" title="'.$app_strings['LBL_SAVE_BUTTON_LABEL'].'">
		<input type="submit" value="'.$app_strings['LBL_CANCEL_BUTTON_LABEL'].'" name="button" onclick="this.form.action.value=\'index\'; this.form.module.value=\'asol_Reports\'; this.form.assigned_user_id.value=\'\'; this.form.assigned_user_name.value=\'\'" class="button" title="'.$app_strings['LBL_CANCEL_BUTTON_LABEL'].'">
		';
		
		return $returnedHtml;				
		
	}
	
	public static function getReportNameHtml($report_name) {
		
		global $mod_strings;
		
		return '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_NAME'].':<span class="required">*</span>
		</td>

		<td nowrap="nowrap" width="35%">
			<input type="text" class="report_name" title="" value="'.$report_name.'" maxlength="" size="30" id="report_name" name="report_name">
		</td>
		';
		
	}
	
	public static function getReportAssignedUserHtml($assigned_user_id, $assigned_user_name) {
		
		global $app_strings, $mod_strings;
		
		return '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_ASSIGNED_TO'].':<span class="required">*</span>
		</td>

		<td nowrap="nowrap" width="35%">
			<input type="hidden" name="assigned_user_id" value="'.$assigned_user_id.'">
			<input type="text" autocomplete="off" title="" value="'.$assigned_user_name.'" size="30" id="assigned_user_name" class="sqsEnabled yui-ac-input" name="assigned_user_name">
			<button type="button" onclick="open_popup(\'Users\', 600, 400, \'\', true, false, {\'call_back_function\':\'set_return\',\'form_name\':\'create_form\',\'field_to_name_array\':{\'id\':\'assigned_user_id\',\'user_name\':\'assigned_user_name\'}}, \'single\', true);" class="button" title="'.$app_strings['LBL_SELECT_BUTTON_LABEL'].'" id="btn_assigned_user_name" name="btn_assigned_user_name"><img src=\'themes/default/images/id-ff-select.png\'></button>
			<button type="button" onclick="document.create_form.assigned_user_name.value = \'\'" class="button" title="'.$app_strings['LBL_CLEAR_BUTTON_LABEL'].'" id="btn_clr_assigned_user_name" name="btn_clr_assigned_user_name"><img src=\'themes/default/images/id-ff-clear.png\'></button>
		</td>
		';
		
	}
	
	public static function getReportDatabaseHtml($alternativeDb, $selectedDb) {
		
		global $mod_strings;
		
		$returnedHtml = '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_USE_ALTERNATIVE_DB'].':
		</td>

		<td nowrap="nowrap" width="35%">
			
			<select id="alternative_database" name="alternative_database" class="alternative_database" onChange="$.blockUI({ theme: true, title: null, message: $(\'#loadingBlockDiv\') }); $.ajax({ url: \'index.php?entryPoint=reportGenerateHtml&htmlTarget=reportModuleTables&selectedDb=\'+this.value, success: function(data) { cleanUpReport(); $(\'#reportModulesTablesTd\').html(data); $.unblockUI(); }});">						
						
				<option value="-1">'.$mod_strings['LBL_REPORT_NATIVE_DB'].'</option>';

				foreach ($alternativeDb as $db_index=>$altDb) {
  					$returnedHtml .= ($selectedDb == $db_index) ? '<option value="'.$db_index.'" selected>'.$altDb.'</option>' : '<option value="'.$db_index.'">'.$altDb.'</option>';
				}

			$returnedHtml .= '
			</select>
													
		</td>
		';
		
		return $returnedHtml;
			
	}
	
	public static function getReportDisplayOptionsHtml($report_charts) {

		global $mod_strings;
		
		$values = array('Tabl', 'Both', 'Htob', 'Char');
		$labels = array('LBL_REPORT_DISPLAY_TABLE', 'LBL_REPORT_DISPLAY_TABLECHART', 'LBL_REPORT_DISPLAY_CHARTTABLE', 'LBL_REPORT_DISPLAY_CHART');

		$returnedHtml = '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_DISPLAY_OPTS'].':<span class="required">*</span>
		</td>

		<td nowrap="nowrap" width="35%">

			<select name="report_charts" onChange="if (typeof window.hasPremiumJsFeatures == \'function\') { manageReportChartsPremiumSelect(this.selectedIndex); }">';

				foreach ($values as $key=>$value) {
					$returnedHtml .= ($report_charts == $value) ? '<option value="'.$value.'" selected>'.$mod_strings[$labels[$key]].'</option>' : '<option value="'.$value.'">'.$mod_strings[$labels[$key]].'</option>';
				}
					
		$returnedHtml .= '
			</select>

		</td>';
		
		return $returnedHtml;
		
	}
	

	public static function getReportModuleTablesHtml($database, $selectedModule = null, $auditedReport = 0, $selAutoRefresh = 0) {
		
		global $mod_strings;
		
		
		if ($database >= "0") {

			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'alternative_database' => $database,
			);
			
			$externalAvailableTables = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalAvailableTables", $extraParams);
			$availableAltTables = ($externalAvailableTables !== false) ? $externalAvailableTables['available_alternative_db_tables'] : null;
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			
			$returnedHtml = '
			<select id="report_module" name="alternative_database_table" onChange="$.blockUI({ theme: true, title: null, message: $(\'#loadingBlockDiv\') }); $.ajax({ url: \'index.php?entryPoint=reportGenerateHtml&htmlTarget=reportTableFields&isAudited=0&selectedDb=\'+$(\'#alternative_database\').val()+\'&selectedModule=\'+this.value, success: function(data) { if (document.getElementById(\'autorefresh_report\').checked == true) { cleanUpReport(); } else { $(\'#related_fields\').empty(); } $(\'#reportTableFieldsTd\').html(data); $(\'#addFieldsButton\').prop(\'disabled\', true); $.unblockUI(); }});">';
																
			$returnedHtml .= ($selectedModule == '') ? '<option value="" label="" selected></option>' : '<option value="" label=""></option>';
									
			foreach ($availableAltTables as $availableAltTable) {
				$returnedHtml .= ($selectedModule == $availableAltTable) ? '<option value="'.$availableAltTable.'" selected>'.$availableAltTable.'</option>' : '<option value="'.$availableAltTable.'">'.$availableAltTable.'</option>';
			}
							
			$returnedHtml .= '</select>';
								
			$returnedHtml .= ($selAutoRefresh == 1) ? '<input type="checkbox" id="autorefresh_report" name="autorefresh_report" value="1" checked> '.$mod_strings['LBL_REPORT_AUTOREFRESH'] : ' <input type="checkbox" id="autorefresh_report" name="autorefresh_report" value="1"> '.$mod_strings['LBL_REPORT_AUTOREFRESH'];
								
		} else {
			
			$currentUserAllowedModules = self::getCurrentUserAllowedModules($selectedModule);
			
			$availableModules = $currentUserAllowedModules['allowedModules'];
			$hasAudit = $currentUserAllowedModules['hasAudit'];


			$returnedHtml = '
			<select id="report_module" name="report_module" onChange="$.blockUI({ theme: true, title: null, message: $(\'#loadingBlockDiv\') }); $.ajax({ url: \'index.php?entryPoint=reportGenerateHtml&htmlTarget=reportTableFields&isAudited=\'+(($(\'#audited_report\').is(\':checked\')) ? 1 : 0)+\'&selectedDb=\'+$(\'#alternative_database\').val()+\'&selectedModule=\'+this.value, success: function(data) { cleanUpReport(); $(\'#reportTableFieldsTd\').html(data); $(\'#addFieldsButton\').prop(\'disabled\', true); $.unblockUI(); }});">';

			$returnedHtml .= ($selectedModule == '') ? '<option value="" label="" selected></option>' : '<option value="" label=""></option>';
									
			foreach ($availableModules as $keyModule=>$itemModule) {
				$returnedHtml .= ($selectedModule == $keyModule) ? '<option value="'.$keyModule.'" selected>'.$itemModule.'</option>' : '<option value="'.$keyModule.'">'.$itemModule.'</option>';
			}
									
			$returnedHtml .= '</select>';
								
			$returnedHtml .= self::getAuditModuleCheckHtml($auditedReport, $hasAudit);

		}
							
		return $returnedHtml;
	
	}
	
	static public function getAuditModuleCheckHtml($auditedReport, $isVisible = true) {
		
		global $mod_strings;
		
		$visibleStyle = ($isVisible) ? 'visibility: inherit;' : 'visibility: hidden;';
		$inputChecked = ($auditedReport == 1) ? ' checked' : '';
		
		return ' <span id="auditedReportSpan" style="'.$visibleStyle.'"><input type="checkbox" id="audited_report" name="audited_report" value="1"'.$inputChecked.' onClick="$.blockUI({ theme: true, title: null, message: $(\'#loadingBlockDiv\') }); $.ajax({ url: \'index.php?entryPoint=reportGenerateHtml&htmlTarget=reportTableFields&selectedDb=\'+$(\'#alternative_database\').val()+\'&selectedModule=\'+$(\'#report_module\').val()+\'&isAudited=\'+(($(this).is(\':checked\')) ? 1 : 0), success: function(data) { cleanUpReport(); $(\'#reportTableFieldsTd\').html(data); $(\'#addFieldsButton\').prop(\'disabled\', true); $.unblockUI(); }});"> '.$mod_strings['LBL_REPORT_AUDIT_TABLE'].'</span>';
			
	}
	
	static public function getReportAttachmentFormatHtml($report_attachment_format) {
		
		global $mod_strings;
		
		$values = array('HTML', 'PDF', 'CSV');
		$labels = array('HTML', 'PDF', 'CSV');
		
		$returnedHtml .= '<select name="report_attachment_format">';

			foreach ($values as $key=>$value) {
				$returnedHtml .= ($report_attachment_format == $value) ? '<option value="'.$value.'" selected>'.$labels[$key].'</option>' : '<option value="'.$value.'">'.$labels[$key].'</option>';
			}

		$returnedHtml .= '</select>';
		
		return $returnedHtml;
		
	}
	
	static public function getReportTypeHtml($reportType, $reportTypeUri, $reportScheduledType) {
		
		global $mod_strings;
		
		$values = array('manual', 'external', 'scheduled', 'stored');
		$labels = array('LBL_REPORT_MANUAL', 'LBL_REPORT_EXTERNAL', 'LBL_REPORT_SCHEDULED', 'LBL_REPORT_STORED');
		
		$returnedHtml = '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_TYPE'].':<span class="required">*</span>
		</td>

		<td nowrap="nowrap" width="35%">

			<select id="report_type" name="report_type" onChange="if (typeof window.hasPremiumJsFeatures == \'function\') { manageReportTypePremiumSelect(this.selectedIndex); } else { manageReportTypeSelect(this.selectedIndex); }">';

				foreach ($values as $key=>$value) {
					$returnedHtml .= ($reportType[0] == $value) ? '<option value="'.$value.'" selected>'.$mod_strings[$labels[$key]].'</option>' : '<option value="'.$value.'">'.$mod_strings[$labels[$key]].'</option>';
				}
				
			$returnedHtml .= '
			</select>
		
			<input type="hidden" name="report_type_uri" id="report_type_uri" value="'.$reportTypeUri.'">
			
			<select id="report_scheduled_type" name="report_scheduled_type" style="visibility: hidden;">';
			
				$selScheduledType = empty($reportScheduledType[0]) ? 'email' : $reportScheduledType[0];
				$returnedHtml .= ($selScheduledType == 'email') ? '<option value="email" label="" selected>'.$mod_strings['LBL_REPORT_SCHEDULED_EMAIL'].'</option>' : '<option value="email" label="">'.$mod_strings['LBL_REPORT_SCHEDULED_EMAIL'].'</option>';
			
			$returnedHtml .= '
			</select>
		
		
			<span id="externalApplicationReportsDiv" name="externalApplicationReportsDiv"></span>
			

		</td>';
		
		return $returnedHtml;
			
	}
	
	static public function getReportChartEngineHtml($chartsEngine) {
		
		global $mod_strings;
		
		$returnedHtml .= '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_CHARTS_ENGINE'].':<span class="required">*</span>
		</td>

		<td nowrap="nowrap" width="35%">';

		$returnedHtml .= self::getReportChartEngineSelectHtml($chartsEngine);
			
		$returnedHtml .= '
		</td>';
		
		return $returnedHtml;
		
	}
	
	static public function getReportChartEngineSelectHtml($chartsEngine) {
		
		global $mod_strings;
		
		$values = array('nvd3', 'html5', 'flash');
		$labels = array('LBL_REPORT_CHART_ENGINE_NVD3', 'LBL_REPORT_CHART_ENGINE_HTML5', 'LBL_REPORT_CHART_ENGINE_FLASH');
		
		$returnedHtml = '<select id="report_charts_engine" name="report_charts_engine" onChange="resetChartTypes(this.value);">';

		foreach ($values as $key=>$value) {
			$returnedHtml .= ($chartsEngine == $value) ? '<option value="'.$value.'" selected>'.$mod_strings[$labels[$key]].'</option>' : '<option value="'.$value.'">'.$mod_strings[$labels[$key]].'</option>';
		}
			
		$returnedHtml .= '
		</select>';
		
		return $returnedHtml;
		
	}
	
	static public function getReportEmailLinkHtml($scheduled_images) {
		
		global $mod_strings;
		
		$returnedHtml = '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_EMAIL_LINK'].':
		</td>


		<td nowrap="nowrap" width="35%">';
			
			$returnedHtml .= ($scheduled_images == 1) ? '<input type="checkbox" value="1" name="scheduled_images" id="scheduled_images" checked> <i>('.$mod_strings['LBL_REPORT_EMAIL_LINK_EXPLAIN'].')</i>' : '<input type="checkbox" value="1" name="scheduled_images" id="scheduled_images"> <i>('.$mod_strings['LBL_REPORT_EMAIL_LINK_EXPLAIN'].')</i>';
		
		$returnedHtml .= '
		</td>';
		
		return $returnedHtml;
		
	}
	
	static public function getReportScopeHtml($sel_scope) {
		
		global $mod_strings, $db, $current_user;
		
		$values = array('private', 'public', 'role');
		$labels = array('LBL_REPORT_PRIVATE', 'LBL_REPORT_PUBLIC', 'LBL_REPORT_ROLE');
		
		$returnedHtml = '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_SCOPE'].':<span class="required">*</span>
		</td>

		<td nowrap="nowrap" width="35%">


		<select style="vertical-align: top;" name="report_scope" onChange="if (this.value != \'public\') {document.getElementById(\'report_scope_role\').style.visibility = \'inherit\';} else {document.getElementById(\'report_scope_role\').style.visibility = \'hidden\';}">';

			foreach ($values as $key=>$value) {
				$returnedHtml .= ($sel_scope == $value) ? '<option value="'.$value.'" selected>'.$mod_strings[$labels[$key]].'</option>' : '<option value="'.$value.'">'.$mod_strings[$labels[$key]].'</option>';
			}
					
		$returnedHtml .= '
		</select>
		';
		
		
		$roles = array();
		$return_action = $_REQUEST['return_action'];

		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		
		
		if ($isDomainsInstalled && (!empty($current_user->asol_default_domain)))
			$queryRoles = $db->query("SELECT acl_roles.id, acl_roles.name FROM acl_roles LEFT JOIN asol_domains_aclroles ON acl_roles.id=asol_domains_aclroles.aclrole_id WHERE asol_domains_aclroles.asol_domain_id = '".$current_user->asol_default_domain."' ORDER BY name ASC");		
		else
			$queryRoles = $db->query("SELECT id, name FROM acl_roles ORDER BY name ASC");
		
		while ($queryRow = $db->fetchByAssoc($queryRoles)){
			$roles[] = array(
				'id' => $queryRow['id'],
				'name' => $queryRow['name']
			);
		}


		if (isset($_REQUEST['init_report_scope']))
			$tmp_scope = explode('${dp}', $_REQUEST['init_report_scope']);
		else if ((isset($_REQUEST['report_scope'])) && ($_REQUEST['report_scope'] == 'role'))
			$tmp_scope = explode('${dp}', $_REQUEST['report_scope'].'${dp}'.implode('$comma', $_REQUEST['report_scope_role']));											


		if ($tmp_scope[0] == 'public')
			$opts = "<select style='visibility: hidden; vertical-align: top;' id='report_scope_role' name='report_scope_role[]' multiple size='3'>";
		else
			$opts = "<select style='visibility: inherit; vertical-align: top;' id='report_scope_role' name='report_scope_role[]' multiple size='3'>";
		
		foreach ($roles as $role) {
		
			if ($return_action == "duplicate"){
			
				if ($current_user->is_admin)
					$opts .= (strstr($tmp_scope[1], $role["id"])) ? '<option value="'.$role["id"].'" selected>'.$role["name"].'</option>' : '<option value="'.$role["id"].'">'.$role["name"].'</option>';
				else
					$opts .= '<option value="'.$role["id"].'">'.$role["name"].'</option>';
			
			} else {
			
				$opts .= (strstr($tmp_scope[1], $role["id"])) ? '<option value="'.$role["id"].'" selected>'.$role["name"].'</option>' : '<option value="'.$role["id"].'">'.$role["name"].'</option>';
			
			}
		}
		
		$opts .= "</select>";

		$returnedHtml .= $opts.'</td>';
		
		return $returnedHtml;
		
	}
	
	static public function getReportInternalDescriptionHtml($description) {
		
		global $mod_strings;
		
		return '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_INTERNAL_DESCRIPTION'].':
		</td>

		<td nowrap="nowrap" width="35%">
			<textarea tabindex="" title="" cols="40" rows="4" name="internal_description" id="internal_description">'.$description.'</textarea>
		</td>';
		
	}
	
	static public function getReportPublicDescriptionHtml($description) {
		
		global $mod_strings;
		
		return '
		<td nowrap="nowrap" width="15%" scope="col">
			'.$mod_strings['LBL_REPORT_PUBLIC_DESCRIPTION'].':
		</td>

		<td nowrap="nowrap" width="35%">
			<textarea tabindex="" title="" cols="40" rows="4" name="public_description" id="public_description">'.$description.'</textarea>
		</td>';
		
	}
	
	static public function getReportEmptyFieldHtml() {
		
		return '
		<td nowrap="nowrap" width="15%" scope="col"></td>
		<td nowrap="nowrap" width="35%"></td>';
		
	}
	
	static public function getReportInitialExecutionHtml($executeFlag) {
		global $mod_strings;
		
		if ((!isset($executeFlag)) || ($executeFlag != true)) {
			$executeFlag = false;
		}
		
		return '<input '.($executeFlag ? "checked " : " ").'type="checkbox" id="initial_execution" name="initial_execution" value="1">&nbsp;'.$mod_strings['LBL_REPORT_INITIAL_EXECUTION'].'</input>';
	}
	
	static public function getCollapsableHeader($headerTitleLabel, $headerId, $startAsHidden = false) {
		
		global $mod_strings;
		$startImage = 'themes/default/images/' . ($startAsHidden ? 'advanced_search.gif' : 'basic_search.gif');
		
		$returnedHtml .= '<img id="'.$headerId.'_img" src="'.$startImage.'" OnMouseOver="this.style.cursor=\'pointer\'" OnMouseOut="this.style.cursor=\'default\'" onClick="if ($(\'#'.$headerId.' table\').is(\':visible\')) { $(\'#'.$headerId.' table\').hide(); this.src=\'themes/default/images/advanced_search.gif\'} else { $(\'#'.$headerId.' table\').show(); this.src=\'themes/default/images/basic_search.gif\'}">&nbsp;';
			
		$returnedHtml .= $mod_strings[$headerTitleLabel];
		
		return $returnedHtml;
		
	}
	
	static public function userCanModifyReport($createdBy, $assignedUser) {
		
		global $current_user;
		
		return (($current_user->id == $createdBy) || ($current_user->id == $assignedUser) || ($current_user->is_admin)) ? true : false;
		
	}
	
	static public function roleCanModifyReport($idsRoles = null) {
		
		global $current_user, $db, $sugar_config;
		
		if ($idsRoles === null) {
			
			$idsRoles = array();

			if (!$current_user->is_admin) {
				
				$queryUserRoles = $db->query("SELECT DISTINCT role_id FROM acl_roles_users WHERE user_id='".$current_user->id."' AND deleted=0");
				while($queryRow = $db->fetchByAssoc($queryUserRoles))
					$idsRoles[] = $queryRow['role_id'];
					
			}
			
		}
		
		$roleReportModifiable = false;
		$asolAllowRoleModifiableReports = ((isset($sugar_config['asolAllowRoleModifiableReports'])) && $sugar_config['asolAllowRoleModifiableReports']);	
		
		if ($asolAllowRoleModifiableReports && (strpos($value['report_scope'], "role") !== false)) {

			$reportPublishedRolesAux = explode('${dp}', $value['report_scope']);
			$reportPublishedRoles = explode('${comma}', $reportPublishedRolesAux[1]);
			
			foreach ($idsRoles as $idRole) {
				if (in_array($idRole, $reportPublishedRoles, true)) {
					$roleReportModifiable = true;
					break;
				}
			}

		}
		
		return $roleReportModifiable;
		
	}
	
	static public function domainCanModifyReport($domainId) {
		
		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
		
		global $current_user;
		
		$parentDomains = asol_manageDomains::getParentDomainsWithHeight($current_user->asol_domain_id);
		
		$parentDomainsIds = array();
		foreach ($parentDomains as $parentDomain) {
			$parentDomainsIds[] = $parentDomain['id'];
		}
		
		return (!in_array($domainId, $parentDomainsIds));
		
	}
	
	static public function cleanUpStoredReportFiles($storedReportInfo, $domainIdsToDelete = null) {
		
		$tmpReportFilesPath = 'modules/asol_Reports/tmpReportFiles/';
		$storedInfo = unserialize(base64_decode($storedReportInfo));
		
		foreach ($storedInfo as $accessKey=>$reportInfo) {
			
			if (($domainIdsToDelete !== null) && (!in_array($accessKey, $domainIdsToDelete)))
				continue;
			
			if (is_file($tmpReportFilesPath.$reportInfo['infoTxt'])) {
				@unlink($tmpReportFilesPath.$reportInfo['infoTxt']);
			}
			
			foreach ($reportInfo['chartFiles'] as $chartFile) {
				
				if (is_file($chartFile['file'])) {
					@unlink($chartFile['file']);
				}
				
			}
			
			unset ($storedInfo[$accessKey]);
			
		}
		
		return base64_encode(serialize($storedInfo));
		
	}
	
}
	
?>