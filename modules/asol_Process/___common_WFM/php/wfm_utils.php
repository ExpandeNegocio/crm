<?php

class wfm_utils {

	static $wfm_edition = 'Community'; // Community/Enterprise
	static $wfm_release_version = '4.5.4';
	static $wfm_code_version = 'D20140414T1251'; // php, js, css, ...
	static $wfm_db_structure_version = 2;
	static $wfm_workflows_version = 2;

	static function echoVersionWFM() {

		echo self::$wfm_code_version;
	}

	static function wfm_log($logLevel, $logText, $file, $function=null, $line=null) {

		global $sugar_config;

		switch ($logLevel) {
			case 'asol_debug':
				$logLevel = (isset($sugar_config['WFM_changeLogLevelFromAsolDebugTo'])) ? $sugar_config['WFM_changeLogLevelFromAsolDebugTo'] : 'debug';
				break;
			case 'asol':
				$asolLogLevelEnabled = ((isset($sugar_config['asolLogLevelEnabled'])) && ($sugar_config['asolLogLevelEnabled'] == true)) ? true : false;
				$logLevel = ($asolLogLevelEnabled) ? 'asol' : 'debug';

				$logLevel = (isset($sugar_config['WFM_logLevelForInfoLogs'])) ? $sugar_config['WFM_logLevelForInfoLogs'] : $logLevel;
				break;
		}

		$wfm_log_prefix = "**********[ASOL][WFM][".session_id()."]";

		$GLOBALS['log']->$logLevel($wfm_log_prefix.': '.pathinfo($file, PATHINFO_BASENAME)."[$line]->".$function.': '.$logText);
	}

	static function wfm_echo($type, $text) {

		$gmdate = "<code style='color: green'>[".gmdate('Y-m-d H:i:s')."]</code>";

		$session_id = "<code style='color: blue'>[".session_id()."]</code>";

		switch ($type) {
			case 'crontab':
				if ($_REQUEST['execution_type'] != "crontab") {
					break;
				}
				echo "<br>$gmdate$session_id $text";
				break;

			default:
				echo "<br>$gmdate $text";
		}
	}

	static function wfm_curl($type, $submit_url, $query_string, $exit, $timeout) {

		global $sugar_config;

		if ($submit_url == null) {
			// set URL
			// Url sintax : scheme://username:password@domain:port/path?query_string#fragment_id
			$site_url = (isset($sugar_config['WFM_site_url'])) ? $sugar_config['WFM_site_url'] : $sugar_config['site_url'];
			$site_url .= '/';
			$submit_url = $site_url."index.php";
		}

		switch ($type) {
			case 'post':

				// cURL by means of POST
				$curl = curl_init();

				curl_setopt($curl, CURLOPT_URL, $submit_url); // The URL to fetch. This can also be set when initializing a session with curl_init().
				curl_setopt($curl, CURLOPT_POST, true); // TRUE to do a regular HTTP POST.
				curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string); // The full data to post in a HTTP "POST" operation.
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // FALSE to stop cURL from verifying the peer's certificate.

				if ($timeout != null) {
					curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); // The maximum number of seconds to allow cURL functions to execute.
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout); // The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
				}

				if (isset($sugar_config['WFM_site_login_username_password'])) { // Basic Authentication (Site Login)
					curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ; // The HTTP authentication method(s) to use.
					//curl_setopt($curl, CURLOPT_SSLVERSION, 3);
					//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
					//curl_setopt($curl, CURLOPT_HEADER, true);
					//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					curl_setopt($curl, CURLOPT_USERPWD, $sugar_config['WFM_site_login_username_password']); // A username and password formatted as "[username]:[password]" to use for the connection.
					self::wfm_log('debug', "cURL -> Basic Authentication (Site Login) =[".$sugar_config['WFM_site_login_username_password']."]", __FILE__, __METHOD__, __LINE__);
				}

				self::wfm_log('debug', "cURL=[".$site_url."index.php?".$query_string."]", __FILE__, __METHOD__, __LINE__);
				curl_exec($curl);
				self::wfm_log('debug', "curl_getinfo=[".print_r(curl_getinfo($curl),true)."]", __FILE__, __METHOD__, __LINE__);

				if(curl_errno($curl)) {
					self::wfm_log('debug', " curl_errno=[".print_r(curl_errno($curl),true)."]", __FILE__, __METHOD__, __LINE__);
				}

				curl_close($curl);
				self::wfm_log('debug', "EXIT cURL REQUEST*******************************************", __FILE__, __METHOD__, __LINE__);

				break;

			case 'get':

				// cURL by means of GET
				/*$ch = curl_init();
				 curl_setopt($ch, CURLOPT_URL, $site_url."index.php?entryPoint=wfm_engine&trigger_module=".$trigger_module."&trigger_event=".$trigger_event."&bean_id=".$bean_id."&current_user_id=".$current_user->id."&bean_ungreedy_count=".$bean_ungreedy_count."&old_bean=".$urlencode_serialized_old_bean."&new_bean=".$urlencode_serialized_new_bean."&execution_type=logic_hook");
				 self::wfm_log('debug', "*****site_url*******cURL=".$site_url."index.php?entryPoint=wfm_engine&trigger_module=".$trigger_module."&trigger_event=".$trigger_event."&bean_id=".$bean_id."&current_user_id=".$current_user->id."&bean_ungreedy_count=".$bean_ungreedy_count."&old_bean=".$urlencode_serialized_old_bean."&new_bean=".$urlencode_serialized_new_bean."&execution_type=logic_hook****************", __FILE__, __METHOD__, __LINE__);

				 curl_setopt($ch, CURLOPT_HEADER, 0);
				 curl_setopt($ch, CURLOPT_TIMEOUT, 1);

				 curl_exec($ch);

				 // close cURL resource, and free up system resources
				 curl_close($ch);*/

				break;
		}

		if ($exit) {
			exit();
		}
	}

	static function wfm_generate_field_select($dropdownlist_key, $field_name, $field_value, $onChange, $disabled) {

		global $app_list_strings;

		$select = "<select id='{$field_name}' name='{$field_name}' onChange='{$onChange}' {$disabled}>";
		foreach ($app_list_strings[$dropdownlist_key] as $key => $value) {
			$value =  (isset($app_list_strings[$dropdownlist_key][$key])) ? $app_list_strings[$dropdownlist_key][$key] : $key; // If language not defined
			$selected = ($field_value == $key) ? 'selected' : '';
			$select .= "<option value='{$key}' {$selected}>{$value}</option>";
		}
		$select .= "</select>";

		return $select;
	}

	static function wfm_generate_alternativeDB_select($array, $field_name, $field_value, $onChange, $disabled) {

		$select = "<select id='{$field_name}' name='{$field_name}' onChange='{$onChange}' {$disabled}>";
		$select .= "<option value='-1'>".translate('LBL_REPORT_NATIVE_DB', 'asol_Process')."</option>";
		if ($array != null) {
			foreach ($array as $key => $value) {
				$value =  (isset($array[$key])) ? $array[$key] : $key; // If language not defined
				$selected = ($field_value == $key) ? 'selected' : '';
				$select .= "<option value='{$key}' {$selected}>{$value}</option>";
			}
		}
		$select .= "</select>";

		return $select;
	}

	static function wfm_generate_alternativeDBtable_select($array, $field_name, $field_value, $onChange, $disabled) {

		$select = "<select id='{$field_name}' name='{$field_name}' onChange='{$onChange}' {$disabled}>";
		foreach ($array as $value) {
			$selected = ($field_value == $value) ? 'selected' : '';
			$select .= "<option value='{$value}' {$selected}>{$value}</option>";
		}
		$select .= "</select>";

		return $select;
	}

	static function wfm_generate_select($array, $field_name, $field_value, $onChange, $disabled) {

		$select = "<select id='{$field_name}' name='{$field_name}' onChange='{$onChange}' {$disabled}>";
		foreach ($array as $key => $value) {
			$value =  (isset($array[$key])) ? $array[$key] : $key; // If language not defined
			$selected = ($field_value == $key) ? 'selected' : '';
			$select .= "<option value='{$key}' {$selected}>{$value}</option>";
		}
		$select .= "</select>";

		return $select;
	}

	static function wfm_generate_trigger_event_select($dropdownlist_key, $dropdownlist_key_2, $trigger_module, $field_name, $field_value, $onChange, $disabled) {

		global $app_list_strings;

		$select = "<select id='{$field_name}' name='{$field_name}' onChange='{$onChange}' {$disabled}>";

		if ($trigger_module == 'Users') {
			foreach ($app_list_strings[$dropdownlist_key] as $key => $value) {
				$value =  (isset($app_list_strings[$dropdownlist_key][$key])) ? $app_list_strings[$dropdownlist_key][$key] : $key; // If language not defined
				$selected = ($field_value == $key) ? 'selected' : '';
				$select .= "<option value='{$key}' {$selected}>{$value}</option>";
			}
		} else {
			foreach ($app_list_strings[$dropdownlist_key_2] as $key => $value) {
				$value =  (isset($app_list_strings[$dropdownlist_key_2][$key])) ? $app_list_strings[$dropdownlist_key_2][$key] : $key; // If language not defined
				$selected = ($field_value == $key) ? 'selected' : '';
				$select .= "<option value='{$key}' {$selected}>{$value}</option>";
			}
		}
		$select .= "</select>";

		return $select;
	}

	static function wfm_generate_field_module_select($field_name, $field_value, $onChange, $disabled) {

		global $current_user, $app_list_strings;

		// Get modules that the current_user can access
		$acl_modules = ACLAction::getUserActions($current_user->id);

		$modules = Array();
		foreach($acl_modules as $key => $mod){
			if ($mod['module']['access']['aclaccess'] >= 0) {
				$modules[$key] = (isset($app_list_strings['moduleList'][$key])) ? $app_list_strings['moduleList'][$key] : $key;  // If language not defined
			}
		}
		asort($modules);

		// Generate select
		$select = "<select id='{$field_name}' name='{$field_name}' onChange='{$onChange}' {$disabled}>";
		$select .= "<option value=''></option>";
		foreach ($modules as $key => $value) {
			$selected = ($field_value == $key) ? 'selected' : '';
			$select .= "<option value='{$key}' {$selected}>{$value}</option>";
		}
		$select .= "</select>";

		return $select;
	}

	static function generateSelectOptions($array) {

		$options = "";
		foreach ($array as $key => $value) {
			$options .= "<option value='{$value}'>{$value}</option>";
		}

		return $options;
	}

	static function wfm_generate_moduleFields_selectFields($fields, $rhs_key, $has_related, $fields_labels, $fields_labels_key, $multiple, $show_idRelationships) {

		$fieldsSelect = "<select id='fields' name='fields' onclick='fields_onClick(this);' onDblClick='fields_onDblClick(this);' {$multiple} size=10 style='width:178px'>";
		if (empty($fields)) {
			$fields = Array();
		}
		foreach ($fields as $fieldK => $field) {
			if ( ($has_related[$fieldK] == "true") && (($field != 'id') || (($field == 'id')&&($show_idRelationships))) ) {
				$style = "style='color:blue;'";
				$plus = ' +';
				$selected = ($rhs_key == $field) ? 'selected' : '';
			} else  {
				$style = '';
				$plus = '';
				$selected = '';
			}

			$fieldsSelect .= "<option {$style} value='{$field}' title='{$field}' label_key='{$fields_labels_key[$fieldK]}' {$selected}>{$fields_labels[$fieldK]}{$plus}</option>";
		}
		$fieldsSelect .= '</select>';

		return $fieldsSelect;
	}

	static function wfm_generate_moduleFields_selectFields_isrequired($fields, $rhs_key, $is_required, $fields_labels, $fields_labels_key, $multiple) {

		$fieldsSelect = "<select id='fields' name='fields' onclick='' onDblClick='' {$multiple} size=10 style='width:178px'>";
		if (empty($fields)) {
			$fields = Array();
		}
		foreach ($fields as $fieldK => $field) {
			if ($is_required[$fieldK] == "true") {
				$asterisk = ' *';
				$selected = ($rhs_key == $field) ? 'selected' : '';
			} else  {
				$asterisk = '';
				$selected = '';
			}

			$fieldsSelect .= "<option value='{$field}' title='{$field}' label_key='{$fields_labels_key[$fieldK]}' {$selected}>{$fields_labels[$fieldK]}{$asterisk}</option>";
		}
		$fieldsSelect .= '</select>';

		return $fieldsSelect;
	}

	static function wfm_generate_moduleFields_selectRelatedFields($related_fields, $related_fields_labels, $related_fields_labels_key, $related_fields_relationship, $related_fields_relationship_labels) {
		self::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$relatedFieldsSelect = "<select id='related_fields' name='related_fields' multiple size=10 style='width:178px'>";
		if (empty($related_fields)) {
			$related_fields = Array();
		}
		$aux_counter = 0;
		$aux_previous_module = "";
		foreach ($related_fields as $rFieldK => $relatedField) {
			$relatedField_array = explode('.', $relatedField);
			$aux_current_module = $relatedField_array[0];
			$aux_current_module = str_replace('_cstm', '', $aux_current_module);
			$aux_current_module .= $related_fields_relationship[$rFieldK];
			if ($aux_current_module != $aux_previous_module) {
				if ($aux_counter != 0) {
					$relatedFieldsSelect .= "</optgroup>";
				}
				if ($aux_counter + 1 != count($related_fields)) {
					$related_fields_label_array = explode('.', $related_fields_labels[$rFieldK]);
					$aux_current_module_label = $related_fields_label_array[0];
					if ($aux_current_module_label == $related_fields_relationship_labels) {
						$relatedFieldsSelect .= "<optgroup label='{$aux_current_module_label}' title='{$aux_current_module_label}'>";
					} else {
						$relatedFieldsSelect .= "<optgroup label='{$aux_current_module_label} ({$related_fields_relationship_labels[$rFieldK]})' title='{$aux_current_module_label} ({$related_fields_relationship_labels[$rFieldK]})'>";
					}
				}
			}
			$relatedFieldsSelect .= "<option value='{$relatedField}' title='{$relatedField}' label_key='{$related_fields_labels_key[$rFieldK]}'>{$related_fields_labels[$rFieldK]}</option>";

			$aux_previous_module = $aux_current_module;
			$aux_counter++;
		}
		$relatedFieldsSelect .= "</optgroup>";
		$relatedFieldsSelect .= '</select>';

		return $relatedFieldsSelect;
	}

	static function addRelationShipNameToLowerCase($fieldLabel, $relationShipLabel) {

		$fieldLabelArray = explode('.', $fieldLabel);
		$tableName = array_shift($fieldLabelArray);

		return strtolower($tableName.'.'.$relationShipLabel.'.'.implode('.', $fieldLabelArray));
	}

	static function _getModLanguageJS($module){
		if (!is_file(sugar_cached('jsLanguage/')."{$module}/{$GLOBALS['current_language']}.js")) {
			require_once ('include/language/jsLanguage.php');
			jsLanguage::createModuleStringsCache($module, $GLOBALS['current_language']);
		}
		return getVersionedScript("cache/jsLanguage/{$module}/{$GLOBALS['current_language']}.js", $GLOBALS['sugar_config']['js_lang_version']);
	}

	static function wfm_add_jsModLanguages($trigger_module, $add_related_modules, $add_id_relationships, $related_modules, $focus, $bean, $fieldsToBeRemoved, $translateFieldLabels, $rhs_key) {

		// Get Language file references

		// trigger_module
		$module_language_file_reference = self::_getModLanguageJS($trigger_module);
		$related_module_language_file_reference = '';

		if ($add_id_relationships) {
			// for id relationships
			$currentTableFields = wfm_reports_utils::getCrmTableFields($bean, $trigger_module, $fieldsToBeRemoved, $translateFieldLabels, $rhs_key, true);
			//self::wfm_log('debug', '$currentTableFields=['.print_r($currentTableFields, true).']', __FILE__, __METHOD__, __LINE__);
			$related_modules_idRelationships = (isset($currentTableFields['related_modules'])) ? $currentTableFields['related_modules'] : null;
		}

		if ($add_related_modules) {

			// total
			$related_modules_total = array_filter(array_unique(array_merge($related_modules, $related_modules_idRelationships)));
			foreach($related_modules_total as $key => $value) {
				$related_module_language_file_reference .= self::_getModLanguageJS($value) . "\n";
			}
		}

		echo '<!-- BEGIN - Language file references -->'."\n".$module_language_file_reference."\n".$related_module_language_file_reference."\n".'<!-- END - Language file references -->';
	}

	static function wfm_get_moduleTableName_moduleName_conversion_array($focus){

		global $beanList, $beanFiles;

		$acl_modules = ACLAction::getUserActions($focus->created_by);

		// Get an array of table names for admin accesible modules
		$modulesTables = Array();
		foreach($acl_modules as $key=>$mod){

			if($mod['module']['access']['aclaccess'] >= 0){

				$class_name = $beanList[$key];
				if (!empty($class_name)) {

					require_once($beanFiles[$class_name]);

					$bean = new $class_name();
					$table_name = $bean->table_name;

					$modulesTables[$table_name] = $key;

					unset($bean);
				}
			}
		}

		return $modulesTables;
	}

	static function wfm_get_moduleName_moduleTableName_conversion_array($user_id){

		global $beanList, $beanFiles;

		$acl_modules = ACLAction::getUserActions($user_id);

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

		return $modulesTables;
	}

	static function wfm_getHourOffset_and_TimeZone($current_user_id) {
		self::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		self::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		require_once('modules/Users/User.php');
		$theUser = new User();
		//self::wfm_log('asol', 'ANTES 1', __FILE__, __METHOD__, __LINE__);
		$theUser->retrieve($current_user_id);
		//self::wfm_log('asol', 'DESPUES 1', __FILE__, __METHOD__, __LINE__);

		//self::wfm_log('debug', "\$theUser->user_name=[$theUser->user_name]  ", __FILE__, __METHOD__, __LINE__);

		$userTZ = $theUser->getPreference("timezone");
		//self::wfm_log('debug', "\$userTZ=[$userTZ]  ", __FILE__, __METHOD__, __LINE__);

		date_default_timezone_set($userTZ);

		$phpDateTime = new DateTime(null, new DateTimeZone($userTZ));
		$hourOffset = $phpDateTime->getOffset()*-1;

		return Array(
		'userTZ' => $userTZ,
		'hourOffset' => $hourOffset
		);
	}

	/**
	 * Convert array to curl-parameter
	 * 1) replace special characters, 2) serialize, 3)urlencode
	 * @param $array
	 */
	static function wfm_convert_array_to_curl_parameter($array) {

		$array = str_replace("&quot;", "&#34;", $array); // To avoid problems with sugarcrm-decoding
		$array = str_replace(">", "&gt;", $array); // To avoid problems with Save.php
		$array = str_replace("<", "&lt;", $array); // To avoid problems with Save.php
		$serialized_array = serialize($array);
		//self::wfm_log('debug', "\$serialized_array=[".$serialized_array."]", __FILE__, __METHOD__, __LINE__);
		$urlencode_serialized_array = urlencode($serialized_array);
		//self::wfm_log('debug', "\$urlencode_serialized_array=[".$urlencode_serialized_array."]", __FILE__, __METHOD__, __LINE__);

		return $urlencode_serialized_array;
	}

	/**
	 * Build array with field_defs non-db from the bean (retrieved from DB, need fixUpFormatting)
	 */
	static function wfm_get_bean_variable_array($alternative_database, $trigger_module, $object_id) {

		global $beanList, $beanFiles, $current_user;

		$bean_variable_array = Array();

		if ($alternative_database == '-1') {
			// Retrieve bean
			$class_name = $beanList[$trigger_module];
			require_once($beanFiles[$class_name]);
			$bean = new $class_name();
			//self::wfm_log('asol', 'ANTES 4', __FILE__, __METHOD__, __LINE__);
			$bean->retrieve($object_id);
			//self::wfm_log('asol', 'DESPUES 4', __FILE__, __METHOD__, __LINE__);
			$bean->fixUpFormatting(); // datetimes from user format to DB format
			//$bean = BeanFactory::getBean($trigger_module, $object_id);
			//self::wfm_log('debug', '$bean=['.print_r($bean, true).']', __FILE__, __METHOD__, __LINE__);

			// Build array
			foreach ($bean->field_defs as $key => $value) {
				if ($bean->field_defs[$key]['source'] != 'non-db') {
					$bean_variable_array[$key] = $bean->$key;
				}
			}
		} else {
			//********************************************//
			//*****Managing External Database Queries*****//
			//********************************************//
			$alternativeDb = ($alternative_database >= 0) ? $alternative_database : false;
			$externalDataBaseQueryParams = wfm_reports_utils::wfm_manageExternalDatabaseQueries($alternativeDb, $trigger_module);

			$useAlternativeDbConnection = $externalDataBaseQueryParams["useAlternativeDbConnection"];
			$trigger_module_table = $externalDataBaseQueryParams["report_table"];

			$rs = Basic_wfm::getSelectionResults("SHOW COLUMNS FROM ".$trigger_module_table, false, $alternativeDb);

			foreach($rs as $value){

				$fieldConstraint = $value['Key'];//PRI  MUL

				if ($fieldConstraint == 'PRI') {
					$field_ID_name = $value['Field'];
				}
			}

			$sql = "SELECT * FROM {$trigger_module_table} WHERE {$field_ID_name} = '{$object_id}'";
			$object_row = Basic_wfm::getSelectionResults($sql, false, $alternativeDb);
			$bean_variable_array = $object_row[0];
		}

		return $bean_variable_array;
	}

	/**
	 * Get bean field_defs non-db array
	 */
	static function wfm_get_bean_fieldDefs_array($trigger_module) {

		global $beanList, $beanFiles;

		// Retrieve bean
		$class_name = $beanList[$trigger_module];
		require_once($beanFiles[$class_name]);
		$bean = new $class_name();

		// Build array
		$field_defs = Array();
		foreach ($bean->field_defs as $key => $value) {
			if ($bean->field_defs[$key]['source'] != 'non-db') {
				$field_defs[] = $key;
			}
		}

		return $field_defs;
	}

	/**
	 * Build array with field_defs non-db from the bean (passed by reference in the logic_hook)
	 */
	static function wfm_get_bean_variable_array_from_bean_field_defs_non_db($bean) {

		global $current_user;

		self::wfm_log('debug', '$current_user->id=['.var_export($current_user->id, true).']', __FILE__, __METHOD__, __LINE__);

		// Build array
		$bean_variable_array = Array();
		foreach ($bean->field_defs as $key => $value) {
			if ($bean->field_defs[$key]['source'] != 'non-db') {
				$bean_variable_array[$key] = $bean->$key;
			}
		}

		return $bean_variable_array;
	}

	/**
	 * Convert curl-parameter to array
	 * 1) replace &quot; ,(not urldecode) 2) unserialize
	 */
	static function wfm_convert_curl_parameter_to_array($curl_parameter) {

		//self::wfm_log('debug', "\$curl_parameter=[".$curl_parameter."]", __FILE__, __METHOD__, __LINE__);
		$html_entity_decoded__array = str_replace("&quot;", '"', $curl_parameter);
		//self::wfm_log('debug', "\$html_entity_decoded__array=[".$html_entity_decoded__array."]", __FILE__, __METHOD__, __LINE__);
		$unserialized__html_entity_decoded__array = unserialize($html_entity_decoded__array);
		//self::wfm_log('debug', "\$unserialized__html_entity_decoded__array=[".print_r($unserialized__html_entity_decoded__array,true)."]", __FILE__, __METHOD__, __LINE__);
		$array = $unserialized__html_entity_decoded__array;
		//+++++++++++self::wfm_log('debug', "\$array=[".print_r($array,true)."]", __FILE__, __METHOD__, __LINE__);

		// BEGIN - Debug array
		/*
		 $urldecoded_array =  urldecode($html_entity_decoded); // urldecode not necessary
		 $urldecoded_array =  urldecode($curl_parameter);
		 self::wfm_log('debug', "\$urldecoded_array=[".$urldecoded_array."]", __FILE__, __METHOD__, __LINE__);
		 $urldecoded__html_entity_decoded__array = urldecode($html_entity_decoded__array);
		 self::wfm_log('debug', "\$urldecoded__html_entity_decoded__array=[".$urldecoded__html_entity_decoded__array."]", __FILE__, __METHOD__, __LINE__);
		 $unserialized__urldecoded_array = unserialize($urldecoded_array);
		 self::wfm_log('debug', "\$unserialized__urldecoded_array=[".print_r($unserialized__urldecoded_array,true)."]", __FILE__, __METHOD__, __LINE__);
		 $unserialized__urldecoded__html_entity_decoded__array = unserialize($urldecoded__html_entity_decoded__array);
		 self::wfm_log('debug', "\$unserialized__urldecoded__html_entity_decoded__array=[".print_r($unserialized__urldecoded__html_entity_decoded__array,true)."]", __FILE__, __METHOD__, __LINE__);
		 */
		// END - Debug old_bean

		// BEGIN - Debug to disk-file
		/*$file_content = "workFlowManagerEngine.php*************** \n\n";
		 $file_content.= "\$curl_parameter=[".$curl_parameter]."] \n\n";
		 $file_content.= "\$html_entity_decoded__old_bean=[".$html_entity_decoded__array."] \n\n";
		 $file_content.= "\$unserialized__html_entity_decoded__array=[".print_r($unserialized__html_entity_decoded__array,true)."] \n\n";

		 $file = fopen("test_after_curl.txt", "a+");
		 fwrite($file, $file_content);
		 fclose($file);*/
		// END - Debug to disk-file

		return $array;
	}

	static function getTriggerModule_fromEventId($event_id) {

		global $db;

		$process_query = $db->query("
									SELECT asol_process.trigger_module as trigger_module
									FROM asol_proces_asol_events_c
									INNER JOIN asol_process ON (asol_process.id = asol_proces_asol_events_c.asol_proce6f14process_ida AND asol_process.deleted = 0)
									WHERE asol_proces_asol_events_c.asol_procea8ca_events_idb = '{$event_id}' AND asol_proces_asol_events_c.deleted = 0							  
							  	");
		$process_row = $db->fetchByAssoc($process_query);

		return $process_row['trigger_module'];
	}

	static function getProcess_fromEventId($event_id) {

		global $db;

		$process_query = $db->query("
									SELECT asol_process.*
									FROM asol_proces_asol_events_c
									INNER JOIN asol_process ON (asol_process.id = asol_proces_asol_events_c.asol_proce6f14process_ida AND asol_process.deleted = 0)
									WHERE asol_proces_asol_events_c.asol_procea8ca_events_idb = '{$event_id}' AND asol_proces_asol_events_c.deleted = 0							  
							  	");
		$process_row = $db->fetchByAssoc($process_query);

		return $process_row;
	}

	static function getTriggerModule_fromProcessId($process_id) {

		global $db;

		$sql = "
			SELECT trigger_module
			FROM asol_process
			WHERE id = '{$process_id}' AND asol_process.deleted = 0							  
	  	";
		self::wfm_log('debug', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
		$process_query = $db->query($sql);
		$process_row = $db->fetchByAssoc($process_query);

		return $process_row['trigger_module'];
	}

	static function getProcess_fromProcessId($process_id) {

		global $db;

		$process_query = $db->query("
									SELECT *
									FROM asol_process
									WHERE id = '{$process_id}' AND asol_process.deleted = 0							  
							  	");
		$process_row = $db->fetchByAssoc($process_query);

		return $process_row;
	}

	static function getAlternativeDatabase_fromProcessId($process_id) {

		global $db;

		$process_query = $db->query("
									SELECT alternative_database
									FROM asol_process
									WHERE id = '{$process_id}' AND asol_process.deleted = 0							  
							  	");
		$process_row = $db->fetchByAssoc($process_query);

		return $process_row['alternative_database'];
	}

	static function getScheduledType_fromEventId($event_id) {

		global $db;

		$event_query = $db->query("
									SELECT scheduled_type
									FROM asol_events
									WHERE id = '{$event_id}' AND asol_events.deleted = 0							  
							  	");
		$event_row = $db->fetchByAssoc($event_query);

		return $event_row['scheduled_type'];
	}

	static function wfm_SavePhpCustomToFile($id, $task_implementation) {

		$phpCode = str_replace(array("\n", "\r"), array('\n', '\r'), $task_implementation); // needed for line-feeds and carriage-return
		$task_implementation = $phpCode;

		$script = $task_implementation;
		$script_to_disk_file = rawurldecode($script);//rawurldecode() does not decode plus symbols ('+') into spaces. urldecode() does.

		$myFile = "{$id}.php";
		$fh = fopen("modules/asol_Task/_temp_php_custom_Files/{$myFile}", 'w') or die("can't open file");
		$stringData = $script_to_disk_file;
		fwrite($fh, $stringData);
		fclose($fh);
	}

	/**
	 * Swap scheduled_tasks from DB-format to user-format
	 */
	static function wfm_prepareTasks_fromDB_toSugar($scheduled_tasks) {

		global $timedate;

		if (strpos($scheduled_tasks, '${GMT}') !== false) {
			$scheduled_tasks = substr($scheduled_tasks, 0, -6);
		}

		$tasks = explode("|", $scheduled_tasks);

		if (($tasks[0] == "") || ($tasks[0] == '${GMT}')) {
			$tasks = Array();
		}

		if (!isset($_REQUEST['scheduled_tasks_hidden'])) {// This avoid adding offset each time the show-related-button is clicked(submit)
			foreach ($tasks as $key => $task){
				$taskValues = explode(":", $task);

				$time1 = explode(",", $taskValues[3]);
				$auxDateTime = $timedate->handle_offset(date("Y")."-".date("m")."-".date("d")." ".$time1[0].":".$time1[1], $timedate->get_db_date_time_format());

				$auxDateTimeArray = explode(" ", $auxDateTime);
				$taskValues[3] = implode(",", explode(":", $auxDateTimeArray[1]));

				if((!$timedate->check_matching_format($taskValues[4], $timedate->get_date_format())) && ($taskValues[4]!="")) {
					$taskValues[4] = $timedate->swap_formats($taskValues[4], $GLOBALS['timedate']->dbDayFormat, $timedate->get_date_format() );
				}

				$tasks[$key] = implode(":", $taskValues);
			}
		}

		$tasks_string = implode("|", $tasks);

		return $tasks_string;
	}

	/**
	 * Swap scheduled_tasks from user-format to DB-format
	 */
	static function wfm_prepareTasks_fromSugar_toDB($scheduled_tasks) {

		global $timedate, $current_user;

		$tasks = ($scheduled_tasks == '${GMT}') ? array() : explode("|", $scheduled_tasks);

		foreach($tasks as $key => $task) {
			$values = explode(":", $task);
			if ((!$timedate->check_matching_format($values[4], $GLOBALS['timedate']->dbDayFormat)) && ($values[4]!="")) {
				$values[4] = $timedate->swap_formats($values[4], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
			}

			$userTZ = $current_user->getPreference("timezone");

			$phpDateTime = new DateTime(null, new DateTimeZone($userTZ));
			$hourOffset = $phpDateTime->getOffset()*-1;

			$time1 = explode(",", $values[3]);
			$values[3] = date("H,i", @mktime($time1[0],$time1[1],0,date("m"),date("d"),date("Y"))+$hourOffset);

			$tasks[$key] = implode(":", $values);
		}
		$scheduled_tasks = (empty($tasks)) ? '${GMT}' : implode("|", $tasks);

		return $scheduled_tasks;
	}

	/**
	 * Swap conditions from DB-format to user-format
	 */
	static function wfm_prepareConditions_fromDB_toSugar($conditions) {

		global $timedate;

		// Swap datetime-format (from database-format to sugar-format)

		$filterValues = explode('${pipe}', $conditions);

		foreach ($filterValues as $key => $value) {
			$values = explode('${dp}', $value);
			if ((($values[6] == "date") || ($values[6] == "datetime") || ($values[6] == "timestamp")) && (($values[3] != "last") && ($values[3] != "this") && ($values[3] != "next") && ($values[3] != "not last") && ($values[3] != "not this") && ($values[3] != "not next"))) {
				if ((!$timedate->check_matching_format($values[4], $timedate->get_date_format())) && ($values[4]!="")) {
					$values[4] = $timedate->swap_formats($values[4],$GLOBALS['timedate']->dbDayFormat , $timedate->get_date_format() );
				}
				if ((!$timedate->check_matching_format($values[5], $timedate->get_date_format())) && ($values[5]!="")) {
					$values[5] = $timedate->swap_formats($values[5], $GLOBALS['timedate']->dbDayFormat , $timedate->get_date_format() );
				}
			}
			$filterValues[$key] = implode('${dp}', $values);
		}

		$conditions = implode('${pipe}', $filterValues);

		return $conditions;
	}

	/**
	 * Swap conditions from user-format to DB-format
	 */
	static function wfm_prepareConditions_fromSugar_toDB($conditions) {

		global $timedate;

		// Swap datetime-format (from sugar-format to database-format)

		$filterValues = explode('${pipe}', $conditions);

		foreach ($filterValues as $key1 => $value){
			$values = explode('${dp}', $value);
			if ((($values[6] == "date") || ($values[6] == "datetime") || ($values[6] == "timestamp")) && (($values[3] != "last") && ($values[3] != "this") && ($values[3] != "next") && ($values[3] != "not last") && ($values[3] != "not this") && ($values[3] != "not next"))){
				if((!$timedate->check_matching_format($values[4], $GLOBALS['timedate']->dbDayFormat)) && ($values[4]!="")) {
					$values[4] = $timedate->swap_formats($values[4], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
				}
				if((!$timedate->check_matching_format($values[5], $GLOBALS['timedate']->dbDayFormat)) && ($values[5]!="")) {
					$values[5] = $timedate->swap_formats($values[5], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
				}
			}
			$filterValues[$key1] = implode('${dp}', $values);
		}
		$conditions = implode('${pipe}', $filterValues);

		return $conditions;
	}

	static function getRealIP()
	{

		if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
		{
			$client_ip =
			( !empty($_SERVER['REMOTE_ADDR']) ) ?
			$_SERVER['REMOTE_ADDR']
			:
			( ( !empty($_ENV['REMOTE_ADDR']) ) ?
			$_ENV['REMOTE_ADDR']
			:
               "unknown" );

			// los proxys van añadiendo al final de esta cabecera
			// las direcciones ip que van "ocultando". Para localizar la ip real
			// del usuario se comienza a mirar por el principio hasta encontrar
			// una dirección ip que no sea del rango privado. En caso de no
			// encontrarse ninguna se toma como valor el REMOTE_ADDR

			$entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);

			reset($entries);
			while (list(, $entry) = each($entries))
			{
				$entry = trim($entry);
				if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
				{
					// http://www.faqs.org/rfcs/rfc1918.html
					$private_ip = array(
                  '/^0\./', 
                  '/^127\.0\.0\.1/', 
                  '/^192\.168\..*/', 
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
                  '/^10\..*/');

					$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

					if ($client_ip != $found_ip)
					{
						$client_ip = $found_ip;
						break;
					}
				}
			}
		}
		else
		{
			$client_ip =
			( !empty($_SERVER['REMOTE_ADDR']) ) ?
			$_SERVER['REMOTE_ADDR']
			:
			( ( !empty($_ENV['REMOTE_ADDR']) ) ?
			$_ENV['REMOTE_ADDR']
			:
               "unknown" );
		}

		return $client_ip;

	}

	static function wfm_isCommonBaseInstalled() {

		global $db;

		// Is CommonBase Installed
		$CommonBaseQuery = $db->query("SELECT DISTINCT count(id_name) as count FROM upgrade_history WHERE id_name='AlineaSolCommonBase' AND status='installed'");
		$CommonBaseRow = $db->fetchByAssoc($CommonBaseQuery);
		$isCommonBaseInstalled = ($CommonBaseRow['count'] > 0);

		return $isCommonBaseInstalled;
	}

	/**
	 * $start = 'http';
	 * $end = 'com';
	 * $str = 'http://google.com';
	 * str_starts_with($str, $start); // TRUE
	 * @param $haystack
	 * @param $needle
	 */
	static function str_starts_with($haystack, $needle)	{
		return strpos($haystack, $needle) === 0;
	}

	/**
	 * $start = 'http';
	 * $end = 'com';
	 * $str = 'http://google.com';
	 * str_ends_with($str, $end); // TRUE
	 * @param $haystack
	 * @param $needle
	 */
	static function str_ends_with($haystack, $needle) {
		return strpos($haystack, $needle) + strlen($needle) ===	strlen($haystack);
	}

	static function getNextActivities($activity_id, & $next_activities=array()){ // recursive

		self::wfm_log('debug', "Executing getNextActivities function", __FILE__, __METHOD__, __LINE__);

		global $db;
		$next_activities_query = $db->query("
											SELECT asol_activ9e2dctivity_idb  AS next_activity_id
											FROM asol_activisol_activity_c
											WHERE asol_activ898activity_ida  = '{$activity_id}' AND deleted = 0
										");

		while($next_activities_row = $db->fetchByAssoc($next_activities_query)) {
			$next_activities[] = $next_activities_row['next_activity_id'];

			self::getNextActivities($next_activities_row['next_activity_id'], $next_activities);
		}

		return $next_activities;
	}

	static function checkWorkFlowExists($process_id) {
		return Basic_wfm::checkRecordAlreadyExists('asol_process', $process_id);
	}

	static function getWorkFlowsExist($imported_workflows) {

		$workflows_exist_process_ids = Array();

		if (array_key_exists('processes', $imported_workflows)) {
			foreach ($imported_workflows['processes'] as $process) {
				if (self::checkWorkFlowExists($process['id'])) {
					$workflows_exist_process_ids[] = $process['id'];
				}
			}
		}

		return $workflows_exist_process_ids;
	}

	static function checkAffectedRows($type, $sql=null, $file=null, $function=null, $line=null) {

		global $db, $mod_strings;

		switch ($type) {
			case 'delete_workflows':
				$error_message = $mod_strings['LBL_DELETE_WORKFLOWS_ERROR'];
				break;
			case 'import_workflows':
				$error_message = $mod_strings['LBL_IMPORT_WORKFLOWS_ERROR'];
				break;
			case 'concurrence_error':
				$error_message = 'Concurrence Error';
				break;
		}

		if ($sql != null) {
			self::wfm_log('debug', '$sql=['.var_export($sql, true).'], *called_from=['.pathinfo($file, PATHINFO_BASENAME)."[$line]->".$function.']', __FILE__, __METHOD__, __LINE__);
		}

		$affected_rows = $db->getAffectedRowCount('result_never_mind'); // {-1: query failed, 0: DB not affected, >0: number of rows affected}
		if ($affected_rows < 1) {
			self::wfm_echo($type, $error_message);
			self::wfm_log('asol', 'EXIT 1: '.$error_message, __FILE__, __METHOD__, __LINE__);
			exit();
		}
	}

	static function importWorkFlows($imported_workflows, $workflows_exist_process_ids, $workflows_exist, $in_context_process_id, $import_type, $prefix, $suffix, $rename_type, $set_status_type, $import_domain_type, $explicit_domain, $import_email_template_type, $if_email_template_already_exists) {

		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();

		$query_domains_columns = ($isDomainsInstalled) ? ", asol_domain_id, asol_domain_child_share_depth, asol_multi_create_domain, asol_published_domain" : '';

		if ($import_type == 'replace') {
			if ($in_context_process_id == null) {
				self::deleteWorkFlows($workflows_exist_process_ids);
			} else { // Delete in-context WorkFlow
				self::deleteWorkFlows($in_context_process_id);
			}
		}

		$current_datetime = gmdate('Y-m-d H:i:s');

		$use_old_data = ((!$workflows_exist) || ($import_type == 'replace'));

		global $db, $mod_strings;

		// Create wfm-processes

		$old_ids__and__new_ids__process__array = Array();

		if (array_key_exists('processes', $imported_workflows)) {
			foreach ($imported_workflows['processes'] as $process) {

				$process_id = ($use_old_data) ? $process['id'] : create_guid();
				$process_name =  "{$prefix}{$process['name']}{$suffix}";
				$process_status = self::getProcessStatusWhenImportingWorkFlow($import_type, $set_status_type, $process);
				$process_date_entered = ($use_old_data) ? $process['date_entered'] : $current_datetime;
				$process_date_modified = ($use_old_data) ? $process['date_modified'] : $current_datetime;
				$query_domains_values = ($isDomainsInstalled) ? self::modifySqlImportWorkFlowsWithDomains($process, $import_domain_type, $explicit_domain) : '';

				$db->query("
					DELETE FROM asol_process
					WHERE id = '{$process_id}'  
				");

				$db->query("
						INSERT INTO asol_process (id                 , name                 , date_entered                , date_modified                , modified_user_id                , created_by                , description                , deleted                , assigned_user_id                , status                , trigger_module                , alternative_database                {$query_domains_columns})
						VALUES					 ('{$process_id}', '{$process_name}', '{$process_date_entered}', '{$process_date_modified}', '{$process['modified_user_id']}', '{$process['created_by']}', '{$process['description']}', '{$process['deleted']}', '{$process['assigned_user_id']}', '{$process_status}', '{$process['trigger_module']}', '{$process['alternative_database']}'               {$query_domains_values}) 
					");
				self::checkAffectedRows('import_workflows');

				$old_ids__and__new_ids__process__array[$process['id']] = $process_id;
			}
		}

		// Create wfm-events

		$old_ids__and__new_ids__event__array = Array();

		if (array_key_exists('events', $imported_workflows)) {
			foreach ($imported_workflows['events'] as $parent_process_id => $events_from_parent_process_id) {
				foreach ($events_from_parent_process_id as $event) {

					$event_id = ($use_old_data) ? $event['id'] : create_guid();
					$event_name = ($rename_type == 'all_wfm_entities') ? "{$prefix}{$event['name']}{$suffix}" : $event['name'];
					$event_date_entered = ($use_old_data) ? $event['date_entered'] : $current_datetime;
					$event_date_modified = ($use_old_data) ? $event['date_modified'] : $current_datetime;
					$query_domains_values = ($isDomainsInstalled) ? self::modifySqlImportWorkFlowsWithDomains($event, $import_domain_type, $explicit_domain) : '';

					$db->query("
						DELETE FROM asol_events
						WHERE id = '{$event_id}'  
					");

					$db->query("
							INSERT INTO asol_events (id           , name           , date_entered           , date_modified           , modified_user_id              , created_by              , description              , deleted              , assigned_user_id              , type              , trigger_type              , trigger_event              , conditions              , scheduled_tasks              , scheduled_type               , subprocess_type                           {$query_domains_columns})
							VALUES                  ('{$event_id}', '{$event_name}', '{$event_date_entered}', '{$event_date_modified}', '{$event['modified_user_id']}', '{$event['created_by']}', '{$event['description']}', '{$event['deleted']}', '{$event['assigned_user_id']}', '{$event['type']}', '{$event['trigger_type']}', '{$event['trigger_event']}', '{$event['conditions']}', '{$event['scheduled_tasks']}', '{$event['scheduled_type']}' , '{$event['subprocess_type']}'             {$query_domains_values})
						");
					self::checkAffectedRows('import_workflows');

					$old_ids__and__new_ids__event__array[$event['id']] = $event_id;

					$event_relationship_id = ($use_old_data) ? $event['relationship']['id'] : create_guid();
					$event_relationship_date_modified = ($use_old_data) ? $event['relationship']['date_modified'] : $current_datetime;
					$event_relationship_ida = ($use_old_data) ? $event['relationship']['asol_proce6f14process_ida'] : $old_ids__and__new_ids__process__array[$parent_process_id];
					$event_relationship_idb = ($use_old_data) ? $event['relationship']['asol_procea8ca_events_idb'] : $event_id;

					$db->query("
						DELETE FROM asol_proces_asol_events_c
						WHERE id = '{$event_relationship_id}'  
					");

					$db->query("
						INSERT INTO asol_proces_asol_events_c (id                              , date_modified                              , deleted                              , asol_proce6f14process_ida                              , asol_procea8ca_events_idb                              )
						VALUES                                ('{$event_relationship_id}', '{$event_relationship_date_modified}', '{$event['relationship']['deleted']}', '{$event_relationship_ida}', '{$event_relationship_idb}')
					");
					self::checkAffectedRows('import_workflows');
				}
			}
		}

		// Create wfm-activities

		$old_ids__and__new_ids__activity__array = Array();

		if (array_key_exists('activities', $imported_workflows)) {
			foreach ($imported_workflows['activities'] as $parent_event_id => $activities_from_parent_event_id) {
				foreach ($activities_from_parent_event_id as $activity) {

					self::wfm_log('debug', '$old_ids__and__new_ids__activity__array=['.var_export($old_ids__and__new_ids__activity__array, true).']', __FILE__, __METHOD__, __LINE__);
					if (!array_key_exists($activity['id'], $old_ids__and__new_ids__activity__array)) {	// Event duplicity.

						$activity_id = ($use_old_data) ? $activity['id'] : create_guid();
						$activity_name = ($rename_type == 'all_wfm_entities') ? "{$prefix}{$activity['name']}{$suffix}" : $activity['name'];
						$activity_date_entered = ($use_old_data) ? $activity['date_entered'] : $current_datetime;
						$activity_date_modified = ($use_old_data) ? $activity['date_modified'] : $current_datetime;
						$query_domains_values = ($isDomainsInstalled) ? self::modifySqlImportWorkFlowsWithDomains($activity, $import_domain_type, $explicit_domain) : '';

						$db->query("
							DELETE FROM asol_activity
							WHERE id = '{$activity_id}'  
						");

						$db->query("
								INSERT INTO asol_activity (id                 , name                 , date_entered                 , date_modified                 , modified_user_id                 , created_by                 , description                 , deleted                 , assigned_user_id                 , conditions                 , delay                 , type                 {$query_domains_columns})
								VALUES					  ('{$activity_id}', '{$activity_name}', '{$activity_date_entered}', '{$activity_date_modified}', '{$activity['modified_user_id']}', '{$activity['created_by']}', '{$activity['description']}', '{$activity['deleted']}', '{$activity['assigned_user_id']}', '{$activity['conditions']}', '{$activity['delay']}', '{$activity['type']}'               {$query_domains_values})
						");
						self::checkAffectedRows('import_workflows');

						$old_ids__and__new_ids__activity__array[$activity['id']] = $activity_id;
					} else {
						self::wfm_log('debug', "Event duplicity", __FILE__, __METHOD__, __LINE__);
					}

					$activity_relationship_id = ($use_old_data) ? $activity['relationship']['id'] : create_guid();
					$activity_relationship_date_modified = ($use_old_data) ? $activity['relationship']['date_modified'] : $current_datetime;
					$activity_relationship_ida = ($use_old_data) ? $activity['relationship']['asol_event87f4_events_ida'] : $old_ids__and__new_ids__event__array[$parent_event_id];
					$activity_relationship_idb = ($use_old_data) ? $activity['relationship']['asol_event8042ctivity_idb'] : $activity_id;

					$db->query("
						DELETE FROM asol_eventssol_activity_c
						WHERE id = '{$activity_relationship_id}'  
					");

					$db->query("
						INSERT INTO asol_eventssol_activity_c (id                                 , date_modified                                 , deleted                                 , asol_event87f4_events_ida                                 , asol_event8042ctivity_idb                                 )
						VALUES                                ('{$activity_relationship_id}', '{$activity_relationship_date_modified}', '{$activity['relationship']['deleted']}', '{$activity_relationship_ida}', '{$activity_relationship_idb}')
					");
					self::checkAffectedRows('import_workflows');
				}
			}
		}

		// Create wfm-activities(next_activities)

		//$old_ids__and__new_ids__next_activity__array = Array(); -> activities and next_activities in the same array

		if (array_key_exists('next_activities', $imported_workflows)) {
			foreach ($imported_workflows['next_activities'] as $parent_activity_id => $activities_from_parent_activity_id) {
				foreach ($activities_from_parent_activity_id as $next_activity) {

					$next_activity_id = ($use_old_data) ? $next_activity['id'] : create_guid();
					$next_activity_name = ($rename_type == 'all_wfm_entities') ? "{$prefix}{$next_activity['name']}{$suffix}" : $next_activity['name'];
					$next_activity_date_entered = ($use_old_data) ? $next_activity['date_entered'] : $current_datetime;
					$next_activity_date_modified = ($use_old_data) ? $next_activity['date_modified'] : $current_datetime;
					$query_domains_values = ($isDomainsInstalled) ? self::modifySqlImportWorkFlowsWithDomains($next_activity, $import_domain_type, $explicit_domain) : '';

					$db->query("
						DELETE FROM asol_activity
						WHERE id = '{$next_activity_id}'  
					");

					$db->query("
							INSERT INTO asol_activity (id                      , name                      , date_entered                      , date_modified                      , modified_user_id                      , created_by                      , description                      , deleted                      , assigned_user_id                      , conditions                      , delay                      , type                      {$query_domains_columns})
							VALUES					  ('{$next_activity_id}', '{$next_activity_name}', '{$next_activity_date_entered}', '{$next_activity_date_modified}', '{$next_activity['modified_user_id']}', '{$next_activity['created_by']}', '{$next_activity['description']}', '{$next_activity['deleted']}', '{$next_activity['assigned_user_id']}', '{$next_activity['conditions']}', '{$next_activity['delay']}', '{$next_activity['type']}'               {$query_domains_values})
					");
					self::checkAffectedRows('import_workflows');

					$old_ids__and__new_ids__activity__array[$next_activity['id']] = $next_activity_id;

					$next_activity_relationship_id = ($use_old_data) ? $next_activity['relationship']['id'] : create_guid();
					$next_activity_relationship_date_modified = ($use_old_data) ? $next_activity['relationship']['date_modified'] : $current_datetime;
					$next_activity_relationship_ida = ($use_old_data) ? $next_activity['relationship']['asol_activ898activity_ida'] : $old_ids__and__new_ids__activity__array[$parent_activity_id];
					$next_activity_relationship_idb = ($use_old_data) ? $next_activity['relationship']['asol_activ9e2dctivity_idb'] : $next_activity_id;

					$db->query("
						DELETE FROM asol_activisol_activity_c
						WHERE id = '{$next_activity_relationship_id}'  
					");

					$db->query("
						INSERT INTO asol_activisol_activity_c (id                                      , date_modified                                      , deleted                                      , asol_activ898activity_ida                                      , asol_activ9e2dctivity_idb                                      )
						VALUES                                ('{$next_activity_relationship_id}', '{$next_activity_relationship_date_modified}', '{$next_activity['relationship']['deleted']}', '{$next_activity_relationship_ida}', '{$next_activity_relationship_idb}')
					");
					self::checkAffectedRows('import_workflows');
				}
			}
		}

		// Create wfm-tasks

		if (array_key_exists('tasks', $imported_workflows)) {
			foreach ($imported_workflows['tasks'] as $parent_activity_id => $tasks_from_parent_activity_id) {
				foreach ($tasks_from_parent_activity_id as $task) {

					$task_id = ($use_old_data) ? $task['id'] : create_guid();
					$task_name = ($rename_type == 'all_wfm_entities') ? "{$prefix}{$task['name']}{$suffix}" : $task['name'];
					$task_implementation = $task['task_implementation'];
					$task_date_entered = ($use_old_data) ? $task['date_entered'] : $current_datetime;
					$task_date_modified = ($use_old_data) ? $task['date_modified'] : $current_datetime;
					$query_domains_values = ($isDomainsInstalled) ? self::modifySqlImportWorkFlowsWithDomains($task, $import_domain_type, $explicit_domain) : '';

					switch ($task['task_type']) {
						case 'send_email':
							self::manageImportEmailTemplates($task_implementation, $task['email_template'], $import_email_template_type, $if_email_template_already_exists, $query_domains_columns, $query_domains_values);
							break;
						case 'php_custom':
							self::wfm_SavePhpCustomToFile($task_id, $task['task_implementation']);
							break;
					}

					$db->query("
						DELETE FROM asol_task
						WHERE id = '{$task_id}'  
					");

					$db->query("
							INSERT INTO asol_task (id             , name             , date_entered             , date_modified             , modified_user_id             , created_by             , description             , deleted             , assigned_user_id             , delay_type             , delay             , task_type             , task_order             , task_implementation                     {$query_domains_columns} )
							VALUES                ('{$task_id}', '{$task_name}', '{$task_date_entered}', '{$task_date_modified}', '{$task['modified_user_id']}', '{$task['created_by']}', '{$task['description']}', '{$task['deleted']}', '{$task['assigned_user_id']}', '{$task['delay_type']}', '{$task['delay']}', '{$task['task_type']}', '{$task['task_order']}', '{$task_implementation}'                  {$query_domains_values})
					");
					self::checkAffectedRows('import_workflows');

					$task_relationship_id = ($use_old_data) ? $task['relationship']['id'] : create_guid();
					$task_relationship_date_modified = ($use_old_data) ? $task['relationship']['date_modified'] : $current_datetime;
					$task_relationship_ida = ($use_old_data) ? $task['relationship']['asol_activ5b86ctivity_ida'] : $old_ids__and__new_ids__activity__array[$parent_activity_id];
					$task_relationship_idb = ($use_old_data) ? $task['relationship']['asol_activf613ol_task_idb'] : $task_id;

					$db->query("
						DELETE FROM asol_activity_asol_task_c
						WHERE id = '{$task_relationship_id}'  
					");

					$db->query("
						INSERT INTO asol_activity_asol_task_c (id                             , date_modified                             , deleted                             , asol_activ5b86ctivity_ida                             , asol_activf613ol_task_idb                             )
						VALUES                                ('{$task_relationship_id}', '{$task_relationship_date_modified}', '{$task['relationship']['deleted']}', '{$task_relationship_ida}', '{$task_relationship_idb}')
					");
					self::checkAffectedRows('import_workflows');
				}
			}
		}

		self::wfm_echo('import', $mod_strings['LBL_IMPORT_WORKFLOWS_OK']);
	}

	static function deleteWorkFlows($process_ids_array) {

		$workflows = self::getWorkFlows($process_ids_array);

		global $db, $mod_strings;

		// Create wfm-processes

		$old_ids__and__new_ids__process__array = Array();

		if (array_key_exists('processes', $workflows)) {
			foreach ($workflows['processes'] as $process) {

				$db->query("DELETE FROM asol_process WHERE id = '{$process['id']}'");
				self::checkAffectedRows('delete_workflows');
			}
		}

		// Create wfm-events

		$old_ids__and__new_ids__event__array = Array();

		if (array_key_exists('events', $workflows)) {
			foreach ($workflows['events'] as $parent_process_id => $events_from_parent_process_id) {
				foreach ($events_from_parent_process_id as $event) {


					$db->query("DELETE FROM asol_events WHERE id = '{$event['id']}'");
					self::checkAffectedRows('delete_workflows');

					$db->query("DELETE FROM asol_proces_asol_events_c WHERE id = '{$event['relationship']['id']}'");
					self::checkAffectedRows('delete_workflows');
				}
			}
		}

		// Create wfm-activities

		$old_ids__and__new_ids__activity__array = Array();

		if (array_key_exists('activities', $workflows)) {
			foreach ($workflows['activities'] as $parent_event_id => $activities_from_parent_event_id) {
				foreach ($activities_from_parent_event_id as $activity) {

					self::wfm_log('debug', '$old_ids__and__new_ids__activity__array=['.var_export($old_ids__and__new_ids__activity__array, true).']', __FILE__, __METHOD__, __LINE__);

					if (!array_key_exists($activity['id'], $old_ids__and__new_ids__activity__array)) {	// Event duplicity.

						$db->query("DELETE FROM asol_activity WHERE id = '{$activity['id']}'");
						self::checkAffectedRows('delete_workflows');

						$old_ids__and__new_ids__activity__array[$activity['id']] = $activity['id'];
					} else {
						self::wfm_log('debug', "Event duplicity", __FILE__, __METHOD__, __LINE__);
					}

					$db->query("DELETE FROM asol_eventssol_activity_c WHERE id = '{$activity['relationship']['id']}'");
					self::checkAffectedRows('delete_workflows');
				}
			}
		}

		// Create wfm-activities(next_activities)

		//$old_ids__and__new_ids__next_activity__array = Array(); -> activities and next_activities in the same array

		if (array_key_exists('next_activities', $workflows)) {
			foreach ($workflows['next_activities'] as $parent_activity_id => $activities_from_parent_activity_id) {
				foreach ($activities_from_parent_activity_id as $next_activity) {

					$db->query("DELETE FROM asol_activity WHERE id = '{$next_activity['id']}'");
					self::checkAffectedRows('delete_workflows');

					$old_ids__and__new_ids__activity__array[$next_activity['id']] = $new_next_activity_id;

					$db->query("DELETE FROM asol_activisol_activity_c WHERE id = '{$next_activity['relationship']['id']}'");
					self::checkAffectedRows('delete_workflows');
				}
			}
		}

		// Create wfm-tasks

		if (array_key_exists('tasks', $workflows)) {
			foreach ($workflows['tasks'] as $parent_activity_id => $tasks_from_parent_activity_id) {
				foreach ($tasks_from_parent_activity_id as $task) {

					$db->query("DELETE FROM asol_task WHERE id = '{$task['id']}'");
					self::checkAffectedRows('delete_workflows');

					$db->query("DELETE FROM asol_activity_asol_task_c WHERE id = '{$task['relationship']['id']}'");
					self::checkAffectedRows('delete_workflows');

					if ($task['task_type'] == "php_custom") {
						//self::wfm_SavePhpCustomToFile($task['id'], $task['task_implementation']);
					}
				}
			}
		}

	}

	static function publishWorkFlows($process_ids_array, $modeToSave, $levelToSave, $domainsToSave, $selectedIsPublishReqParam) {

		$workflows = self::getWorkFlows($process_ids_array);

		global $db, $mod_strings;

		// Create wfm-processes

		$old_ids__and__new_ids__process__array = Array();

		if (array_key_exists('processes', $workflows)) {
			foreach ($workflows['processes'] as $process) {

			}
		}

		// Create wfm-events

		$old_ids__and__new_ids__event__array = Array();

		if (array_key_exists('events', $workflows)) {
			foreach ($workflows['events'] as $parent_process_id => $events_from_parent_process_id) {
				foreach ($events_from_parent_process_id as $event) {
					self::publishRecord('asol_events', $event['id'], $modeToSave, $levelToSave, $domainsToSave, $selectedIsPublishReqParam);
				}
			}
		}

		// Create wfm-activities

		$old_ids__and__new_ids__activity__array = Array();

		if (array_key_exists('activities', $workflows)) {
			foreach ($workflows['activities'] as $parent_event_id => $activities_from_parent_event_id) {
				foreach ($activities_from_parent_event_id as $activity) {

					self::wfm_log('debug', '$old_ids__and__new_ids__activity__array=['.var_export($old_ids__and__new_ids__activity__array, true).']', __FILE__, __METHOD__, __LINE__);

					if (!array_key_exists($activity['id'], $old_ids__and__new_ids__activity__array)) {	// Event duplicity.

						self::publishRecord('asol_activity', $activity['id'], $modeToSave, $levelToSave, $domainsToSave, $selectedIsPublishReqParam);

						$old_ids__and__new_ids__activity__array[$activity['id']] = $activity['id'];
					} else {
						self::wfm_log('debug', "Event duplicity", __FILE__, __METHOD__, __LINE__);
					}

				}
			}
		}

		// Create wfm-activities(next_activities)

		//$old_ids__and__new_ids__next_activity__array = Array(); -> activities and next_activities in the same array

		if (array_key_exists('next_activities', $workflows)) {
			foreach ($workflows['next_activities'] as $parent_activity_id => $activities_from_parent_activity_id) {
				foreach ($activities_from_parent_activity_id as $next_activity) {

					self::publishRecord('asol_activity', $next_activity['id'], $modeToSave, $levelToSave, $domainsToSave, $selectedIsPublishReqParam);

					$old_ids__and__new_ids__activity__array[$next_activity['id']] = $new_next_activity_id;
				}
			}
		}

		// Create wfm-tasks

		if (array_key_exists('tasks', $workflows)) {
			foreach ($workflows['tasks'] as $parent_activity_id => $tasks_from_parent_activity_id) {
				foreach ($tasks_from_parent_activity_id as $task) {

					self::publishRecord('asol_task', $task['id'], $modeToSave, $levelToSave, $domainsToSave, $selectedIsPublishReqParam);
				}
			}
		}

	}

	static function publishRecord($moduleTable, $record_id, $modeToSave, $levelToSave, $domainsToSave, $selectedIsPublishReqParam) {

		global $db;

		$db->query("UPDATE ".$moduleTable." SET asol_domain_published_mode = ".$modeToSave." WHERE id = '".$record_id."'");
		$db->query("UPDATE ".$moduleTable." SET asol_domain_child_share_depth = '".$levelToSave."' WHERE id = '".$record_id."'");
		$db->query("UPDATE ".$moduleTable." SET asol_multi_create_domain = '".$domainsToSave."' WHERE id = '".$record_id."'");

		if ($selectedIsPublishReqParam == null) {
			if ($modeToSave == 0) {
				$db->query("UPDATE ".$moduleTable." SET asol_published_domain = 0 WHERE id='".$record_id."'");
			} else {
				$db->query("UPDATE ".$moduleTable." SET asol_published_domain = 1 WHERE id='".$record_id."'");
			}
		} else {
			if ($_REQUEST[$selectedIsPublishReqParam] == 0) {
				$db->query("UPDATE ".$moduleTable." SET asol_published_domain = 0 WHERE id='".$record_id."'");
			} else {
				$db->query("UPDATE ".$moduleTable." SET asol_published_domain = 1 WHERE id='".$record_id."'");
			}
		}
	}

	static function getWorkFlows($process_ids_array) {
		self::wfm_log('asol', "ENTRY", __FILE__, __METHOD__, __LINE__);
		self::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $db;

		$workflows = Array();

		foreach($process_ids_array as $process_id) {
			$process_query = $db->query ("
									SELECT *
									FROM asol_process
									WHERE id = '{$process_id}'
								");
			$process_row = $db->fetchByAssoc($process_query);

			$workflows['processes'][] = $process_row;
		}

		self::wfm_log('debug', '1 $workflows=['.var_export($workflows, true).']', __FILE__, __METHOD__, __LINE__);

		// Search for events
		foreach ($workflows['processes'] as $process) {

			$event_relationships_from_process = Array();
			$event_relationships_from_process_query = $db->query("
															SELECT *
															FROM asol_proces_asol_events_c
															WHERE asol_proce6f14process_ida = '{$process['id']}' AND deleted = 0
														");
			while ($event_relationships_from_process_row = $db->fetchByAssoc($event_relationships_from_process_query)) {
				$event_relationships_from_process[] = $event_relationships_from_process_row;
			}

			foreach ($event_relationships_from_process as $event_relationship) {
				$event_query = $db->query ("
										SELECT *
										FROM asol_events
										WHERE id = '{$event_relationship['asol_procea8ca_events_idb']}'
									");
				$event_row = $db->fetchByAssoc($event_query);

				$event_and_relationship = $event_row;
				$event_and_relationship['relationship'] = $event_relationship;

				$workflows['events'][$process['id']][] = $event_and_relationship;
			}
		}
		self::wfm_log('debug', '2 $workflows=['.var_export($workflows, true).']', __FILE__, __METHOD__, __LINE__);

		// Search for activities
		if (is_array($workflows['events'])) {
			foreach ($workflows['events'] as $events_from_parent_process_id) {
				foreach ($events_from_parent_process_id as $event) {
					$activity_relationships_from_event = Array();
					$activity_relationships_from_event_query = $db->query("
																SELECT *
																FROM asol_eventssol_activity_c
																WHERE asol_event87f4_events_ida = '{$event['id']}' AND deleted = 0
												   			");

					while ($activity_relationships_from_event_row = $db->fetchByAssoc($activity_relationships_from_event_query)) {
						$activity_relationships_from_event[] = $activity_relationships_from_event_row;
					}

					foreach ($activity_relationships_from_event as $activity_relationship) {
						$activity_query = $db->query ("
											SELECT *
											FROM asol_activity
											WHERE id = '{$activity_relationship['asol_event8042ctivity_idb']}'
										");
						$activity_row = $db->fetchByAssoc($activity_query);

						$activity_and_relationship = $activity_row;
						$activity_and_relationship['relationship'] = $activity_relationship;

						$workflows['activities'][$event['id']][] = $activity_and_relationship;
						//self::wfm_log('debug', "3 part \$workflows=[".var_export($workflows,true)."]", __FILE__, __METHOD__, __LINE__);
					}
				}
			}
		}
		self::wfm_log('debug', '3 $workflows=['.var_export($workflows, true).']', __FILE__, __METHOD__, __LINE__);

		// Search for next_activities from activities(from events)
		$activity_ids = Array();

		if (is_array($workflows['activities'])) {
			foreach ($workflows['activities'] as $activities_from_parent_event_id) {
				foreach ($activities_from_parent_event_id as $activity) {

					self::wfm_log('debug', '$activity_ids=['.var_export($activity_ids, true).']', __FILE__, __METHOD__, __LINE__);
					if (!in_array($activity['id'], $activity_ids)) { // Event duplicity.

						$next_activity_ids_all_tree = self::getNextActivities($activity['id']);

						self::wfm_log('debug', '$next_activity_ids_all_tree=['.var_export($next_activity_ids_all_tree, true).']', __FILE__, __METHOD__, __LINE__);

						foreach($next_activity_ids_all_tree as $next_activity_id) {
							$next_activity_query = $db->query("
														SELECT *
														FROM asol_activity
														WHERE id = '{$next_activity_id}'
													");
							$next_activity_row = $db->fetchByAssoc($next_activity_query);

							$activity_relationship_query = $db->query("
															SELECT *
															FROM asol_activisol_activity_c
															WHERE asol_activ9e2dctivity_idb  = '{$next_activity_row['id']}' AND deleted = 0
														");
							$activity_relationship_row = $db->fetchByAssoc($activity_relationship_query);

							$next_activity_and_relationship = $next_activity_row;
							$next_activity_and_relationship['relationship'] = $activity_relationship_row;

							$workflows['next_activities'][$activity_relationship_row['asol_activ898activity_ida']][] = $next_activity_and_relationship;
						}

						$activity_ids[] = $activity['id'];
					} else {
						self::wfm_log('debug', "Event duplicity", __FILE__, __METHOD__, __LINE__);
					}
				}
			}
		}
		self::wfm_log('debug', '4 $workflows=['.var_export($workflows, true).']', __FILE__, __METHOD__, __LINE__);

		// Search for tasks from activities
		$event_duplicity = Array();

		if (is_array($workflows['activities'])) {
			foreach ($workflows['activities'] as $activities_from_parent_event_id) {

				foreach($activities_from_parent_event_id as $activity) {

					if (in_array($activity['id'], $event_duplicity)) {
						continue;
					}
					$event_duplicity[] = $activity['id'];

					$task_relationships_from_activity = Array();
					$task_relationships_from_activity_query = $db->query("
																SELECT *
																FROM asol_activity_asol_task_c
																WHERE asol_activ5b86ctivity_ida = '{$activity['id']}' AND deleted = 0
															");
					while ($task_relationships_from_activity_row = $db->fetchByAssoc($task_relationships_from_activity_query)) {
						$task_relationships_from_activity[] = $task_relationships_from_activity_row;
					}

					foreach ($task_relationships_from_activity as $task_relationship) {
						$task_query = $db->query("
												SELECT *
												FROM asol_task
												WHERE id = '{$task_relationship['asol_activf613ol_task_idb']}'
											");
						$task_row = $db->fetchByAssoc($task_query);

						$task_and_relationship_and_emailtemplate = $task_row;
						$task_and_relationship_and_emailtemplate['relationship'] = $task_relationship;

						if ($task_row['task_type'] == 'send_email') {
							$fields = explode('${pipe}', $task_row['task_implementation']);
							$emailTemplateId = $fields[0];
							$task_emailtemplate = Basic_wfm::getRecord('email_templates', $emailTemplateId);
							$task_and_relationship_and_emailtemplate['email_template'] = $task_emailtemplate;
						}

						$workflows['tasks'][$activity['id']][] = $task_and_relationship_and_emailtemplate;
					}
				}
			}
		}
		self::wfm_log('debug', '5 $workflows=['.var_export($workflows, true).']', __FILE__, __METHOD__, __LINE__);

		// Search for tasks from next_activities
		if (is_array($workflows['next_activities'])) {
			foreach ($workflows['next_activities'] as $next_activities_from_parent_activity_id) {

				foreach($next_activities_from_parent_activity_id as $activity) {

					$task_relationships_from_activity = Array();
					$task_relationships_from_activity_query = $db->query("
																		SELECT *
																		FROM asol_activity_asol_task_c
																		WHERE asol_activ5b86ctivity_ida = '{$activity['id']}' AND deleted = 0
																	");
					while ($task_relationships_from_activity_row = $db->fetchByAssoc($task_relationships_from_activity_query)) {
						$task_relationships_from_activity[] = $task_relationships_from_activity_row;
					}

					foreach ($task_relationships_from_activity as $task_relationship) {
						$task_query = $db->query("
										SELECT *
										FROM asol_task
										WHERE id = '{$task_relationship['asol_activf613ol_task_idb']}'
									");
						$task_row = $db->fetchByAssoc($task_query);

						$task_and_relationship_and_emailtemplate = $task_row;
						$task_and_relationship_and_emailtemplate['relationship'] = $task_relationship;

						if ($task_row['task_type'] == 'send_email') {
							$fields = explode('${pipe}', $task_row['task_implementation']);
							$emailTemplateId = $fields[0];
							$task_emailtemplate = Basic_wfm::getRecord('email_templates', $emailTemplateId);
							$task_and_relationship_and_emailtemplate['email_template'] = $task_emailtemplate;
						}

						$workflows['tasks'][$activity['id']][] = $task_and_relationship_and_emailtemplate;

					}
				}
			}
		}
		self::wfm_log('asol', '6 $workflows=['.var_export($workflows, true).']', __FILE__, __METHOD__, __LINE__);

		return $workflows;
	}

	static function modifySqlImportWorkFlowsWithDomains($wfm_module, $import_domain_type, $explicit_domain) {

		global $current_user;

		switch ($import_domain_type) {
			case 'keep_domain':
				$asol_domain_id = $wfm_module['asol_domain_id'];
				break;
			case 'use_current_user_domain':
				$asol_domain_id = $current_user->asol_default_domain;
				break;
			case 'use_explicit_domain':
				$asol_domain_id = $explicit_domain;
				break;
			default:
				break;
		}

		$query_domains_values = ", '{$asol_domain_id}', '{$wfm_module['asol_domain_child_share_depth']}', '{$wfm_module['asol_multi_create_domain']}', '{$wfm_module['asol_published_domain']}'";

		return $query_domains_values;
	}

	static function convert_recordIds_fromUrl_toDB_format($record_ids) {
		self::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		$record_ids_array = explode(',', $record_ids);

		$record_ids_string = '';
		foreach ($record_ids_array as $record_id) {
			$record_ids_string .= "'{$record_id}',";
		}

		if (!empty($record_ids_string)) {
			$record_ids_string = substr($record_ids_string, 0, -1);
		} else {
			$record_ids_string = "''";
		}

		return $record_ids_string;
	}

	static function getProcessStatusWhenImportingWorkFlow($import_type, $set_status_type, $process) {

		if ($import_type == 'clone') {
			switch ($set_status_type) {
				case 'keep_status':
					$process_status = $process['status'];
					break;
				case 'set_status_inactive':
					$process_status = 'inactive';
					break;
				case 'set_status_active':
					$process_status = 'active';
					break;
			}
		} else {
			$process_status = $process['status'];
		}

		return $process_status;
	}

	static function getProcessStatusHtml($process_status) {

		global $app_list_strings;

		$font_color = ($process_status == 'active') ? 'green' : 'red';
		$process_status_html = "<b><font color='{$font_color}'>{$app_list_strings['wfm_process_status_list'][$process_status]}</font></b>";

		return $process_status_html;
	}

	public static function setSendEmailAddresses(& $reportMailer, $emailArray, $contextDomainId = null) {

		//self::wfm_log('asol', 'get_defined_vars=['.print_r(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $current_user, $db;


		//*************************************//
		//********Manage Report Domain*********//
		//*************************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);

		if ($isDomainsInstalled) {
			$domainId = ($contextDomainId != null) ? $contextDomainId : $current_user->asol_default_domain;
		}

		//***********************//
		//****** TO EMAILS ******//
		//***********************//
		foreach ($emailArray['users_to'] as $key => $value) {
			$userBean = BeanFactory::getBean('Users', $value);
			if (!empty($userBean)) {
				$userEmail = $userBean->getUsersNameAndEmail();
				$validUserMail = ($isDomainsInstalled) ? (($userEmail['email'] != "") && ($userBean->asol_domain_id == $domainId)) : ($userEmail['email'] != "");
				if ($validUserMail) {
					//$reportMailer->AddAddress($userEmail['email']);
					self::wfm_AddAddress('to', $userEmail['email'], $reportMailer);
				}
			}
		}
		foreach ($emailArray['notificationEmails_to'] as $key => $value) {
			$userBean = BeanFactory::getBean('asol_NotificationEmails', $value);
			if (!empty($userBean)) {
				$validUserMail = ($isDomainsInstalled) ? (($userBean->name != "") && ($userBean->asol_domain_id == $domainId)) : ($userBean->name != "");
				if ($validUserMail) {
					//$reportMailer->AddAddress($userEmail['email']);
					self::wfm_AddAddress('to', $userBean->name, $reportMailer);
				}
			}
		}
		foreach($emailArray['roles_to'] as $key => $value) {
			$usersFromRole = Array();
			if ($isDomainsInstalled) {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."' AND users.asol_domain_id='".$domainId."' AND users.deleted=0";
			} else {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."'  AND users.deleted=0";
			}
			self::wfm_log('asol', '$usersFromRoleSql=['.var_export($usersFromRoleSql, true).']', __FILE__, __METHOD__, __LINE__);
			$usersFromRoleRs = $db->query($usersFromRoleSql);
			while($userFromRole_Row = $db->fetchByAssoc($usersFromRoleRs))
			$usersFromRole[] = $userFromRole_Row['user_id'];
			self::wfm_log('asol', '$usersFromRole=['.var_export($usersFromRole, true).']', __FILE__, __METHOD__, __LINE__);
			foreach($usersFromRole as $key => $value) {
				$userEmail = BeanFactory::getBean('Users', $value)->getUsersNameAndEmail();
				if ($userEmail['email'] != "") {
					//$reportMailer->AddAddress($userEmail['email']);
					self::wfm_AddAddress('to', $userEmail['email'], $reportMailer);
				}
			}
		}
		foreach ($emailArray['emails_to'] as $key => $value){
			if ($value != "") {
				//$reportMailer->AddAddress($value);
				self::wfm_AddAddress('to', $value, $reportMailer);
			}
		}

		//***********************//
		//****** CC EMAILS ******//
		//***********************//
		//Emails de los destinatarios copias
		foreach ($emailArray['users_cc'] as $key => $value) {
			$userBean = BeanFactory::getBean('Users', $value);
			if (!empty($userBean)) {
				$userEmail = $userBean->getUsersNameAndEmail();
				$validUserMail = ($isDomainsInstalled) ? (($userEmail['email'] != "") && ($userBean->asol_domain_id == $domainId)) : ($userEmail['email'] != "");
				if ($validUserMail) {
					//$reportMailer->AddCC($userEmail['email']);
					self::wfm_AddAddress('cc', $userEmail['email'], $reportMailer);
				}
			}
		}
		foreach ($emailArray['notificationEmails_cc'] as $key => $value) {
			$userBean = BeanFactory::getBean('asol_NotificationEmails', $value);
			if (!empty($userBean)) {
				$validUserMail = ($isDomainsInstalled) ? (($userBean->name != "") && ($userBean->asol_domain_id == $domainId)) : ($userBean->name != "");
				if ($validUserMail) {
					//$reportMailer->AddCC($userEmail['email']);
					self::wfm_AddAddress('cc', $userBean->name, $reportMailer);
				}
			}
		}
		foreach($emailArray['roles_cc'] as $key => $value) {
			$usersFromRole = Array();
			if ($isDomainsInstalled) {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."' AND users.asol_domain_id='".$domainId."' AND users.deleted=0";
			} else {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."'  AND users.deleted=0";
			}
			self::wfm_log('asol', '$usersFromRoleSql=['.var_export($usersFromRoleSql, true).']', __FILE__, __METHOD__, __LINE__);
			$usersFromRoleRs = $db->query($usersFromRoleSql);
			while($userFromRole_Row = $db->fetchByAssoc($usersFromRoleRs))
			$usersFromRole[] = $userFromRole_Row['user_id'];
			self::wfm_log('asol', '$usersFromRole=['.var_export($usersFromRole, true).']', __FILE__, __METHOD__, __LINE__);
			foreach($usersFromRole as $key => $value) {
				$userBean = BeanFactory::getBean('Users', $value);
				//self::wfm_log('asol', '$userBean=['.print_r($userBean, true).']', __FILE__, __METHOD__, __LINE__);
				$userEmail = $userBean->getUsersNameAndEmail();
				//$userEmail = BeanFactory::getBean('Users', $value)->getUsersNameAndEmail();
				if ($userEmail['email'] != "") {
					//$reportMailer->AddCC($userEmail['email']);
					self::wfm_AddAddress('cc', $userEmail['email'], $reportMailer);
				}
			}
		}
		foreach ($emailArray['emails_cc'] as $key => $value){
			if ($value != "") {
				//$reportMailer->AddCC($value);
				self::wfm_AddAddress('cc', $value, $reportMailer);
			}
		}

		//***********************//
		//***** BCC EMAILS ******//
		//***********************//
		foreach ($emailArray['users_bcc'] as $key => $value) {
			$userBean = BeanFactory::getBean('Users', $value);
			if (!empty($userBean)) {
				$userEmail = $userBean->getUsersNameAndEmail();
				$validUserMail = ($isDomainsInstalled) ? (($userEmail['email'] != "") && ($userBean->asol_domain_id == $domainId)) : ($userEmail['email'] != "");
				if ($validUserMail) {
					//$reportMailer->AddBCC($userEmail['email']);
					self::wfm_AddAddress('bcc', $userEmail['email'], $reportMailer);
				}
			}
		}
		foreach ($emailArray['notificationEmails_bcc'] as $key => $value) {
			$userBean = BeanFactory::getBean('asol_NotificationEmails', $value);
			if (!empty($userBean)) {
				$validUserMail = ($isDomainsInstalled) ? (($userBean->name != "") && ($userBean->asol_domain_id == $domainId)) : ($userBean->name != "");
				if ($validUserMail) {
					//$reportMailer->AddBCC($userEmail['email']);
					self::wfm_AddAddress('bcc', $userBean->name, $reportMailer);
				}
			}
		}
		foreach($emailArray['roles_bcc'] as $key => $value) {
			$usersFromRole = Array();
			if ($isDomainsInstalled) {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."' AND users.asol_domain_id='".$domainId."' AND users.deleted=0";
			} else {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."'  AND users.deleted=0";
			}
			$usersFromRoleRs = $db->query($usersFromRoleSql);
			while($userFromRole_Row = $db->fetchByAssoc($usersFromRoleRs))
			$usersFromRole[] = $userFromRole_Row['user_id'];
			self::wfm_log('asol', '$usersFromRole=['.var_export($usersFromRole, true).']', __FILE__, __METHOD__, __LINE__);
			foreach($usersFromRole as $key => $value) {
				$userEmail = BeanFactory::getBean('Users', $value)->getUsersNameAndEmail();
				if ($userEmail['email'] != "") {
					//$reportMailer->AddBCC($userEmail['email']);
					self::wfm_AddAddress('bcc', $userEmail['email'], $reportMailer);
				}
			}
		}
		foreach ($emailArray['emails_bcc'] as $key => $value){
			if ($value != "") {
				//$reportMailer->AddBCC($value);
				self::wfm_AddAddress('bcc', $value, $reportMailer);
			}
		}

	}

	static function wfm_AddAddress($value_to_cc_bcc, $email, & $sugarPHPMailer) {

		global $sugar_config;

		if (!empty($email)) {

			// Modify emails in development-sugarcrm-instance
			$WFM_development_mode = ((isset($sugar_config['WFM_development_mode'])) && ($sugar_config['WFM_development_mode'])) ? true : false;
			if ($WFM_development_mode) {
				$WFM_development_mode_allowed_emails = (isset($sugar_config['WFM_development_mode_allowed_emails']) && is_array($sugar_config['WFM_development_mode_allowed_emails'])) ? $sugar_config['WFM_development_mode_allowed_emails'] : Array();
				if (!in_array($email, $WFM_development_mode_allowed_emails)) {
					$WFM_development_mode_notAllowedEmails_textAddedToEmailAddress = (isset($sugar_config['WFM_development_mode_notAllowedEmails_textAddedToEmailAddress']) && is_string($sugar_config['WFM_development_mode_notAllowedEmails_textAddedToEmailAddress'])) ? $sugar_config['WFM_development_mode_notAllowedEmails_textAddedToEmailAddress'] : 'XWFMnotAllowedEmailX';
					$email = str_replace('@', "@{$WFM_development_mode_notAllowedEmails_textAddedToEmailAddress}", $email);
				}
			}

			switch ($value_to_cc_bcc) {
				case 'to':
					$sugarPHPMailer->AddAddress($email);
					break;
				case 'cc':
					$sugarPHPMailer->AddCC($email);
					break;
				case 'bcc':
					$sugarPHPMailer->AddBCC($email);
			}
		}
	}

	static function getPublishedDomains($event_id) {

		$process = self::getProcess_fromEventId($event_id);

		$processDomainId = $process['asol_domain_id'];
		$processDomainIsPublished = ($process['asol_published_domain'] == '1') ? true : false;

		$processDomainPublishedMode = $process['asol_domain_published_mode'];
		$processDomainPublishedLevels = ($process['asol_domain_child_share_depth'] === ';;') ? array() : explode(';;', substr($process['asol_domain_child_share_depth'], 1, -1));
		$processDomainPublishedDomains = ($process['asol_multi_create_domain'] === ';;') ? array() : explode(';;', substr($process['asol_multi_create_domain'], 1, -1));

		$domainPublishingInfo = array(
								'domains' => $processDomainPublishedDomains,
								'levels' => $processDomainPublishedLevels,
								'mode' => $processDomainPublishedMode,
								'mainDomain' => $processDomainId,
								'isPublished' => $processDomainIsPublished
		);

		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");

		$processPublishedDomains = asol_manageDomains::getDomainsPublished($domainPublishingInfo);
		//$processPublishedDomains[] = $processDomainId;

		return $processPublishedDomains;
	}

	static function initializeEmailArray(& $emailArray) {

		$emailArray = Array();
		$emailArray['emails_to'] = Array();
		$emailArray['users_to'] = Array();
		$emailArray['roles_to'] = Array();
		$emailArray['notificationEmails_to'] = Array();
		$emailArray['emails_cc'] = Array();
		$emailArray['users_cc'] = Array();
		$emailArray['roles_cc'] = Array();
		$emailArray['notificationEmails_cc'] = Array();
		$emailArray['emails_bcc'] = Array();
		$emailArray['users_bcc'] = Array();
		$emailArray['roles_bcc'] = Array();
		$emailArray['notificationEmails_bcc'] = Array();

	}

	static function hasLogicHook($mod) {

		require_once ('include/utils/logic_utils.php');

		$action_array = array(2, "wfm_hook",  "custom/include/wfm_hook.php", "wfm_hook_process", "execute_process"); // 2 instead 1 because of on_hold

		$hasLogicHook = false; // For after_save and before_save, both at the same time

		if(file_exists("custom/modules/{$mod}/logic_hooks.php")){
			$hook_array = get_hook_array($mod);

			if (check_existing_element($hook_array, 'after_save', $action_array) == true) {
				$hasLogicHook = true;
			}
		}

		return $hasLogicHook;
	}

	static function getSendEmailsWithNoEmailTemplate($process_id) {

		$send_emails_with_no_email_template = Array();

		$workflow = self::getWorkFlows(Array($process_id));

		// Validate wfm-tasks

		if (array_key_exists('tasks', $workflow)) {
			foreach ($workflow['tasks'] as $parent_activity_id => $tasks_from_parent_activity_id) {
				foreach ($tasks_from_parent_activity_id as $task) {
					if ($task['task_type'] == 'send_email') {
						$fields = explode('${pipe}', $task['task_implementation']);
						$emailTemplateId = $fields[0];

						if (!Basic_wfm::checkRecordAlreadyExists('email_templates', $emailTemplateId)) {
							$send_emails_with_no_email_template[] = Array('id' => $task['id'], 'name' => $task['name']);
						}
					}
				}
			}
		}

		return $send_emails_with_no_email_template;
	}

	static function validate_send_email_references_existing_email_template($process_id) {

		$send_emails = self::getSendEmailsWithNoEmailTemplate($process_id);
		if (count($send_emails) == 0) {
			return false;
		} else {
			$tasks_rows = '';
			foreach ($send_emails as $send_email) {
				$tasks_rows .= "<tr><td>{$send_email['name']}</td><td>{$send_email['id']}</td></tr>";
			}

			$error = translate('LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE_ERROR', 'asol_Process');
			$tasks_table = "<table class=\\\"popupHelp\\\">{$tasks_rows}</table>";
			$info_icon =  "<img border='0' class='inlineHelpTip' alt='Info' src='themes/Sugar5/images/helpInline.gif' onClick='return SUGAR.util.showHelpTips(this, &quot;<div class=\\\"detail view  detail508\\\"><table class=\\\"list view\\\"><tr><td width=\\\"20%\\\"><b>Error:</b></td><td width=\\\"80%\\\">".$error."</td></tr><tr><td width=\\\"20%\\\"><b>Tasks:</b></td><td width=\\\"80%\\\">".$tasks_table."</td></tr></table></div>&quot;, &quot;&quot;, &quot;&quot;);'>";

			return $info_icon;
		}
	}

	static function manageImportEmailTemplates(& $task_implementation, $task_email_template, $import_email_template_type, $if_email_template_already_exists, $query_domains_columns, $query_domains_values) {

		global $db;

		switch ($import_email_template_type) {

			case 'do_not_import':
				break;

			case 'import':

				$fields = explode('${pipe}', $task_implementation);
				$emailTemplateId = $fields[0];

				if (!empty($emailTemplateId)) { // So import does not create an empty email_template

					$current_datetime = gmdate('Y-m-d H:i:s');

					if (Basic_wfm::checkRecordAlreadyExists('email_templates', $emailTemplateId)) {
						switch ($if_email_template_already_exists) {
							case 'replace':
								$db->query("DELETE FROM email_templates WHERE id = '{$task_email_template['id']}' ");

								$task_email_template_id = $task_email_template['id'];
								$task_email_template_date_entered = $task_email_template['date_entered'];
								$task_email_template_date_modified = $task_email_template['date_modified'];
								break;
							case 'clone':
								$task_email_template_id = create_guid();
								$task_email_template_date_entered = $current_datetime;
								$task_email_template_date_modified = $current_datetime;
								break;
						}
					} else {
						$task_email_template_id = $task_email_template['id'];
						$task_email_template_date_entered = $task_email_template['date_entered'];
						$task_email_template_date_modified = $task_email_template['date_modified'];
					}
						
					$fields[0] = $task_email_template_id;
					$task_implementation = implode('${pipe}', $fields);

					$db->query("
							INSERT INTO email_templates (id                            , date_entered                            , date_modified                            , modified_user_id                            , created_by                            , published                            , name                            , description                            , subject                            , body                            , body_html                            , deleted                            , assigned_user_id                            , text_only	                                       {$query_domains_columns} )
							VALUES                      ('{$task_email_template_id}', '{$task_email_template_date_entered}', '{$task_email_template_date_modified}', '{$task_email_template['modified_user_id']}', '{$task_email_template['created_by']}', '{$task_email_template['published']}', '{$task_email_template['name']}', '{$task_email_template['description']}', '{$task_email_template['subject']}', '{$task_email_template['body']}', '{$task_email_template['body_html']}', '{$task_email_template['deleted']}', '{$task_email_template['assigned_user_id']}', '{$task_email_template['text_only']}'                 {$query_domains_values})
					");
				}

				break;
		}
	}

	static function getEventInitialize($process_id) {

		global $db;

		$objects = Array();

		$sql = "
				SELECT asol_events.*
				FROM asol_events
				INNER JOIN asol_proces_asol_events_c ON (asol_proces_asol_events_c.asol_procea8ca_events_idb = asol_events.id AND asol_proces_asol_events_c.deleted = 0)
				INNER JOIN asol_process ON (asol_process.id = asol_proces_asol_events_c.asol_proce6f14process_ida AND asol_process.deleted = 0)
				WHERE asol_events.type = 'initialize' AND asol_process.id = '{$process_id}'
		   ";
		$object_query = $db->query($sql);

		while ($object_row = $db->fetchByAssoc($object_query)) {
			$objects[] = $object_row;
		}

		return $objects;
	}

	static function convertArrayToStringDB($array) {

		$string = '';

		foreach ($array as $item) {
			$string .= "'{$item}',";
		}

		if (!empty($string)) {
			$string = substr($string, 0, -1);
		} else {
			$string = "''";
		}

		return $string;
	}


	static function getInitializeWorkingNode($process_id) {

		global $db;

		// Get the wfm-event-initialize that belongs to the WorkFlow with this wfm-process
		$sql_event = "
			SELECT asol_events.*
			FROM asol_events
			INNER JOIN asol_proces_asol_events_c ON (asol_proces_asol_events_c.asol_procea8ca_events_idb = asol_events.id AND asol_proces_asol_events_c.deleted = 0)
			INNER JOIN asol_process ON (asol_process.id = asol_proces_asol_events_c.asol_proce6f14process_ida AND asol_process.deleted = 0)
			WHERE asol_process.id = '{$process_id}' AND asol_events.type = 'initialize'
			LIMIT 1				  
	    ";
		$query_event = $db->query($sql_event);
		$row_event = $db->fetchByAssoc($query_event);

		// Get working_node type=initialize
		$sql_working_node = "
			SELECT *
			FROM asol_workingnodes
			WHERE asol_events_id_c = '{$row_event['id']}'
		";
		$query_working_node = $db->query($sql_working_node);
		$row_working_node = $db->fetchByAssoc($query_working_node);

		return $row_working_node;
	}

	static function getGlobalCustomVariables($process_id) {

		$working_node = self::getInitializeWorkingNode($process_id);

		$custom_variables = unserialize(base64_decode($working_node['custom_variables']));

		return $custom_variables['GLOBAL_CVARS'];
	}

	static function setGlobalCustomVariables($process_id, $global_custom_variables) {

		global $db;

		$working_node = self::getInitializeWorkingNode($process_id);

		wfm_utils::wfm_log('debug', '$working_node=['.var_export($working_node, true).']', __FILE__, __METHOD__, __LINE__);

		if (!empty($working_node)) {

			// Update working_node type=initialize
			$custom_variables = unserialize(base64_decode($working_node['custom_variables']));
			$custom_variables['GLOBAL_CVARS'] = $global_custom_variables;

			$date_modified = gmdate('Y-m-d H:i:s');
			$custom_variables_to_db = base64_encode(serialize($custom_variables));

			$sql_update = "
				UPDATE asol_workingnodes 
				SET custom_variables = '{$custom_variables_to_db}', date_modified = '{$date_modified}'
				WHERE id = '{$working_node['id']}'
			";
			$db->query($sql_update);
		}
	}

	static function putWorkingNodeToSleep($working_node) {

		global $db;

		$date_modified = gmdate('Y-m-d H:i:s');

		$sql_update = "
			UPDATE asol_workingnodes 
			SET status = 'sleeping' , date_modified = '{$date_modified}'
			WHERE id = '{$working_node['id']}' AND status != 'sleeping'
		";
		$db->query($sql_update);
		self::checkAffectedRows('concurrence_error', $sql, __FILE__, __METHOD__, __LINE__);

		usleep(rand(1000000, 2000000));

		$sql_update = "
			UPDATE asol_workingnodes
			SET status = '{$working_node['status']}' , date_modified = '{$date_modified}' 
			WHERE id = '{$working_node['id']}' and status = 'sleeping'
		";
		$db->query($sql_update);
		self::checkAffectedRows('concurrence_error', $sql, __FILE__, __METHOD__, __LINE__);

	}

	static function addPremiumAppListStrings(& $app_list_strings, $language, $premiumFeature) {

		$extraParams = Array(
			'app_list_strings' => $app_list_strings,
			'language' => $language
		);

		$newAppListStrings = wfm_reports_utils::managePremiumFeature($premiumFeature, "wfm_utils_premium.php", $premiumFeature, $extraParams);

		if ($newAppListStrings !== false) {
			$app_list_strings = $newAppListStrings;
		}
	}

	static function get_bean_table($session,$module_name) {
		global $beanList, $beanFiles;
		$class_name = $beanList[$module_name];
		require_once($beanFiles[$class_name]);
		$class_name = new $class_name();
		$table=$class_name->table_name;
		return $table;
	}

	static public function getInitJqueryScriptHtml() {

		return '
		function initJqueryScripts() {
	
			if (typeof jQuery === "undefined") {
		
				$LAB.script("modules/asol_Reports/include_basic/js/jquery.min.js").wait().script("modules/asol_Reports/include_basic/js/jquery.UI.min.js").wait(function(){ setDialogFxDisplay(); initDragDropElements(); initEmailFrame(); });
			 	
			} else if (typeof jQuery.ui === "undefined") {
		
				$LAB.script("modules/asol_Reports/include_basic/js/jquery.UI.min.js").wait(function(){ setDialogFxDisplay(); initDragDropElements(); initEmailFrame(); });
			 	
			} else {
		
				setDialogFxDisplay(); initDragDropElements(); initEmailFrame();
		
			}
			
		}
		';

	}
}

?>