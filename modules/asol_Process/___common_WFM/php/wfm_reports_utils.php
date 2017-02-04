<?php

/**
 *
 * This class is a modified-copy of reports-functions => You can not copy from reports the functions in order to update the functions without modifying them.
 *
 */
class wfm_reports_utils {

	/**
	 * D20130607T1818
	 * Get fields, related_fields, has_related, is_required, etc arrays.
	 * @param $focus
	 * @param $bean
	 * @param $bean_module
	 * @param $fieldsToBeRemoved
	 * @param $translateFieldLabels
	 * @param $rhs_key
	 * @param $emulate_id
	 */
	static function getCrmTableFields($bean, $bean_module, $fieldsToBeRemoved, $translateFieldLabels, &$rhs_key, $emulate_id) {
		//wfm_utils::wfm_log('debug', 'get_defined_vars=['.print_r(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $app_strings, $app_list_strings, $beanList, $beanFiles;

		$primaryKey = "id";
		$table = $bean->table_name;
		$relate_Field = $rhs_key; //devuelve el campo del modulo seleccionado para obtener sus related fields

		if ($emulate_id) {
			$relate_Field = 'id';
		}

		//Check if custom table exists
		$cstmTableExists = Basic_wfm::getSelectionResults("SHOW tables like '".$table."_cstm'", false);

		$rs = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$table, false);

		//Eliminamos campo deleted del array rs
		for ($i=0; $i<count($rs); $i++) {

			if (in_array($rs[$i]['Field'], $fieldsToBeRemoved)) {
				array_splice($rs, $i, 1);
				$i--;
			}

		}

		$rs_c = Basic_wfm::getSelectionResults("SELECT name, type FROM fields_meta_data WHERE custom_module='".$bean_module."' AND type NOT IN ('id', 'relate', 'html', 'iframe', 'encrypt')", false);
		$rs_cr = Basic_wfm::getSelectionResults("SELECT name, type, ext2, ext3 FROM fields_meta_data WHERE custom_module='".$bean_module."' AND type IN ('relate')", false);

		$rs_c = (count($rs_c) == 0) ? array() : $rs_c;
		$rs_cr = (count($rs_cr) == 0) ? array() : $rs_cr;

		foreach ($rs_c as $custom_field){

			if (!in_array($table."_cstm.".$custom_field["name"], $fieldsToBeRemoved)) {

				$rs[] = array(
				'Field' => $table."_cstm.".$custom_field["name"],
				'Type' => $custom_field["type"]
				);

			}

		}

		foreach ($rs_cr as $custom_field){

			if (!in_array($table."_cstm.".$custom_field["ext3"], $fieldsToBeRemoved)) {

				$rs[] = array(
				'Field' => $table."_cstm.".$custom_field["ext3"],
				'Type' => $custom_field["type"],
				'RelateModule' => $custom_field["ext2"]
				);

			}

		}

		$i=0;

		$fields = array(); //Array con los campos de la tabla seleccionada
		$fields_labels = array(); //Array con los labels de los campos de la tabla seleccionada
		$fields_type = array(); // Array con los tipos de campos de cada elemento del array $fields
		$fields_options = array(); // Array con las opciones (campos tipo "enum") de cada elemento del array $fields
		$fields_options_db = array();
		$fields_enum_operators = array();
		$fields_enum_references = array();

		$keys = array();

		$has_related = array(); //Array que indica si los elementos de la tabla fields tienen relacion con alguna otra tabla
		$related_fields = array(); //Array con los campos related del campo pasado como parametro en el form
		$related_fields_labels = array(); //Array con los labels de los campos de la tabla seleccionada
		$related_fields_relationship = array(); //Array con el nombre de la relación asociada al campo relacionado
		$related_fields_relationship_labels = array(); //Array con el nombre de la relación asociada al campo relacionado
		$related_fields_type = array(); // Array con los tipos de campos de cada elemento del array $related_fields
		$related_fields_options = array(); // Array con las opciones (campos tipo "enum") de cada elemento del array $related_fields
		$related_fields_options_db = array();
		$related_fields_enum_operators = array();
		$related_fields_enum_references = array();

		$related_modules = Array();// Array with the related_modules needed to get the javascript-language-file-references
		$fields_labels_key = Array();
		$related_fields_labels_key = Array();
		$is_required = Array();

		//wfm_utils::wfm_log('debug', '$rs=['.var_export($rs, true).']', __FILE__, __METHOD__, __LINE__);

		foreach($rs as $value){

			if ($value['Type'] != "non-db") {

				$fields[$i] = $value['Field'];
				$auxField = explode(".", $fields[$i]);
				$auxField = (count($auxField) == 2) ? $auxField[1 ]: $fields[$i];

				$fieldInfo = Basic_wfm::getFieldInfoFromVardefs($bean_module, $auxField);
				$fields_options[$i] = $fieldInfo['values'];
				$fields_options_db[$i] = $fieldInfo['labels'];

				$fields_enum_operators[$i] = $fieldInfo['enumOperator'];
				$fields_enum_references[$i] = $fieldInfo['enumReference'];

				if ($fields_options[$i] == 'currency') {
					$fields_type[$i] = 'currency';
				} else if ($fields_options[$i] != '') {
					$fields_type[$i] = 'enum';
				} else {
					$fields_type[$i] = $value['Type'];
				}
				// $fields_labels_key
				$fields_labels_key[$i] = $fieldInfo['fieldLabelKey'];

				// Is required?
				$is_required[$i] = (Basic_wfm::isRequiredField($bean_module, $rs[$i]['Field'])) ? "true" : "false";

				if ($value['Field'] == $primaryKey) { // CRM RelationShips

					$fields_labels[$i] = ($translateFieldLabels) ? $app_strings["LBL_ID"] : 'id';
					//Si el campo a relacionar es el ID, buscar en la tabla relationships
					$tmpField = explode(".", $value['Field']);
					$tmpField = (count($tmpField) == 2) ? $tmpField[1] : $value['Field'];

					$rshr = Basic_wfm::getSelectionResults("SELECT DISTINCT relationship_name, lhs_module as main_module, lhs_module, lhs_table FROM relationships WHERE rhs_module LIKE '".$bean_module."' AND rhs_key LIKE '".$tmpField."'", false);
					$rshl = Basic_wfm::getSelectionResults("SELECT DISTINCT relationship_name, lhs_module as main_module, rhs_module, rhs_table FROM relationships WHERE lhs_module LIKE '".$bean_module."' AND lhs_key LIKE '".$tmpField."'", false);

					$rshr = (count($rshr) == 0) ? array() : $rshr;
					$rshl = (count($rshl) == 0) ? array() : $rshl;
					foreach($rshl as $v) { //Evitar tablas repetidas

						$duplicatedRelationShip = false;

						foreach($rshr as $v2) {

							//if ($v['rhs_table'] == $v2['lhs_table']){
							if ($v['relationship_name'] == $v2['relationship_name']) {
								$duplicatedRelationShip = true;
								break;
							}

						}

						if (!$duplicatedRelationShip) {
							$rshr[] = array(
							'relationship_name' => $v['relationship_name'],
							'main_module' => $v['main_module'],
							'lhs_table' => $v['rhs_table'],
							'lhs_module' => $v['rhs_module']
							);
						}

					}

					$has_related[$i] = ((count($rshr) > 0) || ($value['Type'] == "relate")) ? "true" : "false";

					if ($relate_Field == $value['Field']) {
						$j = $k = 0;

						if(count($rshr) > 0) {

							while ($j < count($rshr)){

								$relatedTable = $rshr[$j]['lhs_table'];

								$rsrf = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$relatedTable, false);

								//Eliminamos campo deleted del array rsrf
								for ($l=0; $l<count($rsrf); $l++){

									if (in_array($rsrf[$l]['Field'], $fieldsToBeRemoved)) {
										array_splice($rsrf, $l, 1);
										$l--;
									}

								}

								//Check if custom table exists
								$cstmTableExists = Basic_wfm::getSelectionResults("SHOW tables like '".$relatedTable."_cstm'", false);

								$rsrfc = (count($cstmTableExists) == 0) ? array() : Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$relatedTable."_cstm", false);

								foreach ($rsrfc as $customField){
									if ($customField['Field'] != "id_c"){
										$customField['Field'] = $relatedTable."_cstm.".$customField['Field'];
										$rsrf[] = $customField;
									}
								}


								foreach($rsrf as $val){
									//wfm_utils::wfm_log('debug', '$rsrf=['.var_export($rsrf, true).']', __FILE__, __METHOD__, __LINE__);

									$auxField = explode(".", $val['Field']);
									$theField = (count($auxField) == 2) ? $auxField[1] : $val['Field'];

									$fieldInfo = Basic_wfm::getFieldInfoFromVardefs($rshr[$j]['lhs_module'], $theField);

									$related_fields[$k] = (count(explode(".", $val['Field'])) == 1) ? $relatedTable.".".$val['Field'] : $val['Field'];
									$related_fields_relationship[$k] = $rshr[$j]['relationship_name'];

									$keys[$k] = $primaryKey." ".$related_fields_relationship[$k];

									$vName = (empty($fieldInfo['fieldLabel'])) ? $theField : $fieldInfo['fieldLabel'];
									$tableVname = (!empty($app_list_strings['moduleList'][$rshr[$j]['lhs_module']])) ? $app_list_strings['moduleList'][$rshr[$j]['lhs_module']] : $relatedTable;
									$vName = (count(explode(".", $val['Field'])) >= 1) ? $tableVname.".".$vName : $vName;
									$vName = trim($vName);
									$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;

									$related_fields_labels[$k] = ($translateFieldLabels) ? $vName : $related_fields[$k];
									$related_fields_relationship_labels[$k] = ($translateFieldLabels) ? Basic_wfm::getRelationShipLabelFromVardefs($rshr[$j]['main_module'], $related_fields_relationship[$k]) : $related_fields_relationship[$k];

									$related_fields_options[$k] = $fieldInfo['values'];
									$related_fields_options_db[$k] = $fieldInfo['labels'];

									$related_fields_enum_operators[$k] = $fieldInfo['enumOperator'];
									$related_fields_enum_references[$k] = $fieldInfo['enumReference'];

									$relatedModule = $rshr[$j]['lhs_module'];
									// $related_fields_labels_key
									$related_fields_labels_key[$k] = "{$relatedModule}.{$fieldInfo['fieldLabelKey']}";
									// $related_modules_array
									$related_modules[$k] = $relatedModule;

									if ($related_fields_options[$k] == 'currency') {
										$related_fields_type[$k] = 'currency';
									} else if ($related_fields_options[$k] != '') {
										$related_fields_type[$k] = 'enum';
									} else {
										$related_fields_type[$k] = $val['Type'];
									}
									$k++;
								}

								$j++;

							}

							$rhs_key = implode('${comma}', $keys);

						} else {

							$related_class_name = $beanList[$value['RelateModule']];
							require_once($beanFiles[$related_class_name]);
							$related_bean = new $related_class_name();

							$relatedTable = $related_bean->table_name;

							$rsrf = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$relatedTable, false);

							//Eliminamos campo deleted del array rsrf
							for ($l=0; $l<count($rsrf); $l++){

								if (in_array($rsrf[$l]['Field'], $fieldsToBeRemoved)) {
									array_splice($rsrf, $l, 1);
									$l--;
								}

							}

							//Check if custom table exists
							$cstmTableExists = Basic_wfm::getSelectionResults("SHOW tables like '".$relatedTable."_cstm'", false);

							if(count($cstmTableExists) == 0)
							$rsrfc = array();
							else
							$rsrfc =  Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$relatedTable."_cstm", false);

							foreach ($rsrfc as $customField){
								$rsrf[count($rsrf)] = $customField;
							}

							foreach($rsrf as $val){

								$related_fields[$k] = $relatedTable.".".$val['Field'];
								$related_fields_labels[$k] = $relatedTable.".".$val['Field'];

								$fieldInfo = Basic_wfm::getFieldInfoFromVardefs($value['RelateModule'], $val['Field']);
								$related_fields_options[$k] = $fieldInfo['values'];
								$related_fields_options_db[$k] = $fieldInfo['labels'];

								$related_fields_enum_operators[$k] = $fieldInfo['enumOperator'];
								$related_fields_enum_references[$k] = $fieldInfo['enumReference'];

								$relatedModule = $value['RelateModule'];
								// $related_fields_labels_key
								$related_fields_labels_key[$k] = "{$relatedModule}.{$fieldInfo['fieldLabelKey']}";
								// $related_modules_array
								$related_modules[$k] = $relatedModule;

								if ($related_fields_options[$k] == 'currency') {
									$related_fields_type[$k] = 'currency';
								} else if ($related_fields_options[$k] != '') {
									$related_fields_type[$k] = 'enum';
								} else {
									$related_fields_type[$k] = $val['Type'];
								}
								$k++;
							}

							$j++;

						}

					}

				} else { // CRM Relate Fields

					$relatedInfo = self::get_related_fields($bean);

					$tmpField = explode(".", $value['Field']);
					$tmpField = (count($tmpField) == 2) ? $tmpField[1] : $value['Field'];

					//get related fields if required too (see get_related_fields method)

					foreach ($relatedInfo as $info){

						$info_id_name = (!empty($info['id_name'])) ? $info['id_name'] : "";

						if ($info_id_name == $tmpField){

							$vName = translate($info['vname'], $bean_module);
							$vName = trim($vName);
							$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;

							if (empty($vName))
							$vName = $value['Field'];

							$fields_labels[$i] = ($translateFieldLabels) ? $vName : $info['name'];
							$fields_type[$i] = "relate";
							$has_related[$i] = "true";

							// $related_modules_array
							$relatedModule = $info['module'];
							$related_modules[$i] = $relatedModule;

							// char(36) -> relate
							$fields_type[$i] = "relate";

							break;

						} else {

							$normalInfo = $bean->getFieldDefinition($tmpField);
							$vName = translate($normalInfo['vname'], $bean_module);
							$vName = trim($vName);
							$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;

							if (empty($vName))
							$vName = $value['Field'];

							$fields_labels[$i] = ($translateFieldLabels) ? $vName : $value['Field'];
							$has_related[$i] = "false";
							$related_modules[$i] = "";

						}

					}

					$relatedTable = "";
					$relatedModule = "";

					if($relate_Field == $value['Field']) {

						foreach ($relatedInfo as $info){

							if ($info['id_name'] == $tmpField){

								$relatedModule = $info['module'];

								$related_class_name = $beanList[$relatedModule];
								require_once($beanFiles[$related_class_name]);
								$related_bean = new $related_class_name();

								$relatedTable = $related_bean->table_name;

								break;

							}

						}

						$k = 0;


						$rsrf = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$relatedTable, false);

						//Eliminamos campo deleted del array rsrf
						for ($j=0; $j<count($rsrf); $j++){

							if (in_array($rsrf[$j]['Field'], $fieldsToBeRemoved)) {
								array_splice($rsrf, $j, 1);
								$j--;
							}

						}

						//Check if custom table exists
						$cstmTableExists = Basic_wfm::getSelectionResults("SHOW tables like '".$relatedTable."_cstm'", false);

						if(count($cstmTableExists) == 0)
						$rsrfc = array();
						else
						$rsrfc =  Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$relatedTable."_cstm", false);

						foreach ($rsrfc as $customField){
							if ($customField['Field'] != "id_c"){
								$customField['Field'] = $relatedTable."_cstm.".$customField['Field'];
								$rsrf[count($rsrf)] = $customField;
							}
						}

						foreach($rsrf as $val){

							$valExp = explode(".", $val['Field']);
							$auxVal = (count(explode(".", $val['Field'])) == 1) ? $val['Field'] : $valExp[1];
							$fieldInfo = Basic_wfm::getFieldInfoFromVardefs($relatedModule, $auxVal);

							$related_fields[$k] = (count(explode(".", $val['Field'])) == 1) ? $relatedTable.".".$val['Field'] : $val['Field'];

							$vName = (empty($fieldInfo['fieldLabel'])) ? $auxVal : $fieldInfo['fieldLabel'];
							$tableVname = (!empty($app_list_strings['moduleList'][$relatedModule])) ? $app_list_strings['moduleList'][$relatedModule] : $relatedTable;
							$vName = (count(explode(".", $val['Field'])) >= 1) ? $tableVname.".".$vName : $vName;
							$vName = trim($vName);
							$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;

							$related_fields_labels[$k] = ($translateFieldLabels) ? $vName : $related_fields[$k];

							$related_fields_relationship[$k] = $relatedModule;
							$related_fields_relationship_labels[$k] = $tableVname;

							$related_fields_options[$k] = $fieldInfo['values'];
							$related_fields_options_db[$k] = $fieldInfo['labels'];

							$related_fields_enum_operators[$k] = $fieldInfo['enumOperator'];
							$related_fields_enum_references[$k] = $fieldInfo['enumReference'];

							// $related_fields_labels_key
							$related_fields_labels_key[$k] = "{$relatedModule}.{$fieldInfo['fieldLabelKey']}";


							if ($related_fields_options[$k] == 'currency') {
								$related_fields_type[$k] = 'currency';
							} else if ($related_fields_options[$k] != '') {
								$related_fields_type[$k] = 'enum';
							} else {
								$related_fields_type[$k] = $val['Type'];
							}
							$k++;
						}

					}

				}

			}

			$i++;

		}

		return array(

		'fields' => $fields, //Array con los campos de la tabla seleccionada
		'fields_labels' => $fields_labels, //Array con los labels de los campos de la tabla seleccionada
		'fields_type' => $fields_type, // Array con los tipos de campos de cada elemento del array $fields
		'fields_options' => $fields_options, // Array con las opciones (campos tipo "enum") de cada elemento del array $fields
		'fields_options_db' => $fields_options_db,
		'fields_enum_operators' => $fields_enum_operators,
		'fields_enum_references' => $fields_enum_references,

		'has_related' => $has_related, //Array que indica si los elementos de la tabla fields tienen relacion con alguna otra tabla
		'related_fields' => $related_fields, //Array con los campos related del campo pasado como parametro en el form
		'related_fields_labels' => $related_fields_labels, //Array con los labels de los campos de la tabla seleccionada
		'related_fields_relationship' => $related_fields_relationship, //Array con el nombre de la relación asociada al campo relacionado
		'related_fields_relationship_labels' => $related_fields_relationship_labels, //Array con el nombre de la relación asociada al campo relacionado
		'related_fields_type' => $related_fields_type, // Array con los tipos de campos de cada elemento del array $related_fields
		'related_fields_options' => $related_fields_options, // Array con las opciones (campos tipo "enum") de cada elemento del array $related_fields
		'related_fields_options_db' => $related_fields_options_db,
		'related_fields_enum_operators' => $related_fields_enum_operators,
		'related_fields_enum_references' => $related_fields_enum_references,

		'related_modules' => $related_modules,
		'fields_labels_key' => $fields_labels_key,
		'related_fields_labels_key' => $related_fields_labels_key,
		'is_required' => $is_required

		);

	}

	/**
	 * D20130617T1446
	 * Get external table fields
	 * @param $focus
	 * @param $sel_altDbTable
	 * @param $rhs_key
	 */
	static function getExternalTableFields($focus, $alternative_database, $sel_altDbTable, & $rhs_key) {

		$relate_Field = $rhs_key; //devuelve el campo del modulo seleccionado para obtener sus related fields
		$table = $sel_altDbTable;

		$rs = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$table, true, $alternative_database);

		$i=0;

		$fields = array(); //Array con los campos de la tabla seleccionada
		$fields_labels = array(); //Array con los labels de los campos de la tabla seleccionada
		$fields_type = array(); // Array con los tipos de campos de cada elemento del array $fields
		$fields_options = array(); // Array con las opciones (campos tipo "enum") de cada elemento del array $fields
		$fields_options_db = array();
		$fields_enum_operators = array();
		$fields_enum_references = array();

		$keys = array();

		$has_related = array(); //Array que indica si los elementos de la tabla fields tienen relacion con alguna otra tabla
		$related_fields = array(); //Array con los campos related del campo pasado como parametro en el form
		$related_fields_labels = array(); //Array con los labels de los campos de la tabla seleccionada
		$related_fields_type = array();; // Array con los tipos de campos de cada elemento del array $related_fields
		$related_fields_options = array(); // Array con las opciones (campos tipo "enum") de cada elemento del array $related_fields
		$related_fields_options_db = array();
		$related_fields_enum_operators = array();
		$related_fields_enum_references = array();


		foreach($rs as $value){

			$fieldConstraint = $value['Key'];//PRI  MUL

			$fields[$i] = $value['Field'];
			$fields_labels[$i] = $value['Field'];
			$fields_type[$i] = (strpos($value['Type'], "(") !== false) ? substr($value['Type'], 0, strpos($value['Type'], "(")) : $value['Type']; //timestamp take into account as date?¿
			$fields_options[$i] = "";
			$fields_options_db[$i] = "";
			$fields_enum_operators[$i] = "";
			$fields_enum_references[$i] = "";

			$has_related[$i] = (!empty($fieldConstraint)) ? 'true' : 'false';

			if ($fieldConstraint == 'PRI') {

				$primary_keys = Basic_wfm::getSelectionResults("select table_name, column_name from information_schema.key_column_usage where table_name is not null and referenced_table_name = '".$table."' and referenced_column_name = '".$value['Field']."'", true, $alternative_database);

				if (empty($primary_keys)) {

					$has_related[$i] = 'false';

				} else if ($relate_Field == $value['Field']) {

					$referencedTables = Array();

					$k = 0;

					foreach ($primary_keys as $primaryKey) {

						$referencedTable = $primaryKey['table_name'];

						if (in_array($referencedTable, $referencedTables))
						continue;

						$referencedTables[] = $referencedTable;

						$rsrf = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$referencedTable, true, $alternative_database);

						foreach($rsrf as $value_rf) {

							$related_fields[$k] = $referencedTable.".".$value_rf['Field'];

							$related_fields_labels[$k] = $referencedTable.".".$value_rf['Field'];
							$related_fields_type[$k] = (strpos($value_rf['Type'], "(") !== false) ? substr($value_rf['Type'], 0, strpos($value_rf['Type'], "(")) : $value_rf['Type']; //timestamp take into account as date?¿
							$related_fields_options[$k] = "";
							$related_fields_options_db[$k] = "";
							$related_fields_enum_operators[$k] = "";
							$related_fields_enum_references[$k] = "";

							$keys[$k] = $rhs_key." ".$primaryKey['column_name']." ".$fieldConstraint;

							$k++;
						}

					}

					$rhs_key = implode('${comma}', $keys);

				}

			} else if ($fieldConstraint == 'MUL') {

				$foreign_key = Basic_wfm::getSelectionResults("select referenced_table_name, referenced_column_name from information_schema.key_column_usage where referenced_table_name is not null and table_name = '".$table."' and column_name = '".$value['Field']."'", true, $alternative_database);

				if (empty($foreign_key)) {

					$has_related[$i] = 'false';

				} else if ($relate_Field == $value['Field']) {

					$referencedTable = $foreign_key[0]['referenced_table_name'];

					$rhs_key .= " ".$foreign_key[0]['referenced_column_name']." ".$fieldConstraint;


					$rsrf = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$referencedTable, true, $alternative_database);

					$k = 0;
					foreach($rsrf as $value_rf){

						$related_fields[$k] = $referencedTable.".".$value_rf['Field'];

						$related_fields_labels[$k] = $referencedTable.".".$value_rf['Field'];
						$related_fields_type[$k] = (strpos($value_rf['Type'], "(") !== false) ? substr($value_rf['Type'], 0, strpos($value_rf['Type'], "(")) : $value_rf['Type']; //timestamp take into account as date?¿
						$related_fields_options[$k] = "";
						$related_fields_options_db[$k] = "";
						$related_fields_enum_operators[$k] = "";
						$related_fields_enum_references[$k] = "";

						$k++;
					}

				}

			}

			$i++;

		}

		return array(

		'fields' => $fields, //Array con los campos de la tabla seleccionada
		'fields_labels' => $fields_labels, //Array con los labels de los campos de la tabla seleccionada
		'fields_type' => $fields_type, // Array con los tipos de campos de cada elemento del array $fields
		'fields_options' => $fields_options, // Array con las opciones (campos tipo "enum") de cada elemento del array $fields
		'fields_options_db' => $fields_options_db,
		'fields_enum_operators' => $fields_enum_operators,
		'fields_enum_references' => $fields_enum_references,

		'has_related' => $has_related, //Array que indica si los elementos de la tabla fields tienen relacion con alguna otra tabla
		'related_fields' => $related_fields, //Array con los campos related del campo pasado como parametro en el form
		'related_fields_labels' => $related_fields_labels, //Array con los labels de los campos de la tabla seleccionada
		'related_fields_type' => $related_fields_type, // Array con los tipos de campos de cada elemento del array $related_fields
		'related_fields_options' => $related_fields_options, // Array con las opciones (campos tipo "enum") de cada elemento del array $related_fields
		'related_fields_options_db' => $related_fields_options_db,
		'related_fields_enum_operators' => $related_fields_enum_operators,
		'related_fields_enum_references' => $related_fields_enum_references

		);

	}

	static function wfm_manageExternalDatabaseQueries($alternativeDb, $reportModule) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $sugar_config, $beanList, $beanFiles;

		if ($alternativeDb !== false) {

			$useAlternativeDbConnection = true;

			$alternativeModuleAux = explode(" ", $reportModule);
			$alternativeModule = explode(".", $alternativeModuleAux[0]);
			$report_module = $alternativeModule[1];
			$report_table = $report_module;

			//Chck if is defined some fields at external database as DomainId // Else check is there is a default one
			if (isset($sugar_config['WFM_AlternativeDbConnections'][$alternativeDb]['asolSpecificTableDomainIdField'][$report_table])) {
				$domainField = $sugar_config['WFM_AlternativeDbConnections'][$alternativeDb]['asolSpecificTableDomainIdField'][$report_table];
			} else if (isset($sugar_config['WFM_AlternativeDbConnections'][$alternativeDb]['asolDefaultDbDomainIdField'])) {
				$domainField = $sugar_config['WFM_AlternativeDbConnections'][$alternativeDb]['asolDefaultDbDomainIdField'];
			} else {
				$domainField = "";
			}

		} else {

			$useAlternativeDbConnection = false;

			$class_name = $beanList[$reportModule];
			require_once($beanFiles[$class_name]);
			$bean = new $class_name();

			$report_module = $reportModule;
			$report_table = $bean->table_name;

		}

		return array(
		"useAlternativeDbConnection" => $useAlternativeDbConnection,
		"domainField" => $domainField,
		"report_module" => $report_module,
		"report_table" => $report_table
		);

	}

	/**
	 * D20130607T1818
	 * Get non visible fields (asol_domain_child_share_depth etc)
	 * @param $reportModule
	 * @param $isDomainsInstalled
	 * @param $id_isVisible
	 */
	static function getNonVisibleFields($reportModule, $isDomainsInstalled, $id_isVisible) {

		global $sugar_config, $current_user;

		$userRoles = $_SESSION['asolUserRoles'] = ((isset($_SESSION['asolUserRoles'])) && (!empty($_SESSION['asolUserRoles'])) && (!$current_user->is_admin)) ? $_SESSION['asolUserRoles'] : ACLRole::getUserRoles($current_user->id);

		$fieldsToBeRemoved = array('deleted');

		if (isset($sugar_config['WFM_NonVisibleFields'][$reportModule])) {

			foreach ($sugar_config['WFM_NonVisibleFields'][$reportModule] as $nonVisibleField)
			$fieldsToBeRemoved[] = $nonVisibleField;
		}

		if ($isDomainsInstalled) {

			$fieldsToBeRemoved[] = 'asol_domain_child_share_depth';
			$fieldsToBeRemoved[] = 'asol_multi_create_domain';
			$fieldsToBeRemoved[] = 'asol_published_domain';
			if (!($current_user->is_admin || in_array($userRoles[0], $sugar_config['WFM_CanSeeAsolDomainIdField_Roles'])))  {
				$fieldsToBeRemoved[] = 'asol_domain_id';
			}
		}

		if (!$id_isVisible) {
			$fieldsToBeRemoved[] = 'id';
		}

		return $fieldsToBeRemoved;
	}

	/**
	 * D20130607T1818
	 * Get related_fields
	 * @param $bean
	 */
	static function get_related_fields($bean) {

		$related_fields=array();

		$fieldDefs = $bean->getFieldDefinitions();

		//find all definitions of type link.
		if (!empty($fieldDefs)) {
			foreach ($fieldDefs as $name=>$properties) {
				if (array_search('relate', $properties, true) === 'type') {
					$related_fields[$name]=$properties;
				}
			}
		}
		return $related_fields;
	}

	function getCurrentUserAsolConfig($current_user_id) {

		if (wfm_utils::wfm_isCommonBaseInstalled()) {

			$sqlCfg = "SELECT config FROM asol_config WHERE created_by = '".$current_user_id."'";
			$rsCfg = Basic_wfm::getSelectionResults($sqlCfg, false);
			$cfg = explode("|",$rsCfg[0]['config']);
			$quarter_month = $cfg[0];
			$entries_per_page = (!empty($cfg[1])) ? $cfg[1] : 15;

			$pdf_orientation = $cfg[2];
			$week_start = $cfg[3];
			$pdf_img_scaling_factor = $cfg[4];
			$scheduled_files_ttl = (empty($cfg[5])) ? "7" : $cfg[5];
			$host_name = $cfg[6];

		} else  {
			$quarter_month = null;
			$entries_per_page = null;
			$pdf_orientation = null;
			$week_start = null;
			$pdf_img_scaling_factor = null;
			$scheduled_files_ttl = null;
			$host_name = null;
		}

		return array(
		"quarter_month" => $quarter_month,
		"entries_per_page" => $entries_per_page,
		"pdf_orientation" => $pdf_orientation,
		"week_start" => $week_start,
		"pdf_img_scaling_factor" => $pdf_img_scaling_factor,
		"scheduled_files_ttl" => $scheduled_files_ttl,
		"host_name" => $host_name
		);

	}

	static public function managePremiumFeature($premiumFeature, $requiredFile, $callFunction, $extraParams, $isJsFile = false) {

		//wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		//wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);
			
		$basePremiumPath = "modules/asol_Process/___common_WFM_premium/";

		$basePremiumPath .= (!$isJsFile) ? 'php/' : 'js/';

		if (!file_exists($basePremiumPath.$requiredFile)) {

			if (!$isJsFile)
			wfm_utils::wfm_log('info', "Cannot get ".$premiumFeature." Premium Feature. ".$callFunction."() Function Called.", __FILE__, __METHOD__, __LINE__);
			else
			wfm_utils::wfm_log('info', "Cannot get ".$premiumFeature." Premium Feature. Tried to Load '".$requiredFile."' File", __FILE__, __METHOD__, __LINE__);
			return false;

		} else {

			if (!$isJsFile) {
				require_once($basePremiumPath.$requiredFile);
				return $callFunction($extraParams);
			} else {
				return true;
			}

		}

	}

	function getQuarterMonthsArray($fiscalQuarter, $quarter_month) {
		wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

		if ($fiscalQuarter) {

			$auxMonths;

			$j=0;
			for ($k=$quarter_month-1; $k<count($months);$k++){
				$auxMonths[$j] = $months[$k];
				$j++;
			}

			for ($k=0; $k<$quarter_month-1;$k++){
				$auxMonths[$j] = $months[$k];
				$j++;
			}

			$months = $auxMonths;

		}

		return $months;

	}

	static public function hasPremiumFeatures() {
			
		$basePremiumPath = "modules/asol_Process/___common_WFM_premium";
		return is_dir($basePremiumPath);

	}

	static public function getSystemUsersAndRolesAndNotificationEmails($isDomainsInstalled) {

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

		// notificationEmails_opts
		$notificationEmails_opts = "";
		$notificationEmails_sql = "SELECT id, name FROM asol_notificationemails WHERE deleted=0 AND status='active'";

		if ($isDomainsInstalled) {
			$notificationEmails_sql .= asol_manageDomains::getExtendedDomainsWhereQuery('', true);
		}

		$notificationEmails_sql .= " ORDER BY name";
		$notificationEmails_query = $db->query($notificationEmails_sql);
		while ($notificationEmails_row = $db->fetchByAssoc($notificationEmails_query)) {
			$notificationEmails_opts .= $notificationEmails_row['id'] . '${comma}' . $notificationEmails_row['name'] . '${pipe}';
		}
		$notificationEmails_opts = substr($notificationEmails_opts, 0, -7);

		return array(
			'users' => (empty($users_opts)) ? '' : $users_opts,
			'roles' => (empty($acl_roles_opts)) ? '' : $acl_roles_opts,
			'notificationEmails' => (empty($notificationEmails_opts)) ? '' : $notificationEmails_opts
		);

	}


}

?>