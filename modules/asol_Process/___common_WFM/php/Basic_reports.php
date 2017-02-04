<?PHP

/**
 * 
 * This class is a modified-copy of asol_Report => You can not copy from reports the functions in order to update the functions without modifying them.
 *
 */
class Basic_reports extends Basic {
	
	static public $reported_error = null;

	function Basic_reports(){
		parent::Basic();
	}

	function bean_implements($interface){
		switch($interface){
			case 'ACL': return true;
		}
		return false;
	}

	static public function getSelectionResults($query, $useAlternativeDb = true, $notCrmExternalDb = false, $checkMaxAllowedResults = false, $offset = 0, $entries = 0) {
		
		wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

		global $sugar_config, $db, $current_user, $mod_strings;

		self::$reported_error = null;
		$query = html_entity_decode($query);
		$retArray = array();

		if (((!isset($sugar_config["asolReportsDbAddress"])) || (!$useAlternativeDb)) && ($notCrmExternalDb === false)) {

			if ($checkMaxAllowedResults) {
					
				$productResults = 1;

				if (substr($query, 0, 6) == 'SELECT') {
					$maxAllowedResults = $db->query("EXPLAIN ".$query);
					while($maxAllowedResultsRow = $db->fetchByAssoc($maxAllowedResults))
					$productResults *= $maxAllowedResultsRow['rows'];
						
					if ($sugar_config['maxAllowedResults'] < $productResults) {

						//Enviar email a creador del informe!!!!
						$mail = new SugarPHPMailer();
							
						$mail->setMailerForSystem();
						$user = new User();
							
						//created by
						$mail_config = $user->getEmailInfo($this->created_by);
							
						$mail->From = (isset($sugar_config["asolReportsEmailsFrom"])) ? $sugar_config["asolReportsEmailsFrom"] : $mail_config['email'];
						$mail->FromName = (isset($sugar_config["asolReportsEmailsFromName"])) ? $sugar_config["asolReportsEmailsFromName"] : $mail_config['name'];
							
						//Timeout del envio de correo
						$mail->Timeout=30;
						$mail->CharSet = "UTF-8";
							
						//Emails de los destinatarios
						$mail->AddAddress($sugar_config['maxAllowedResultsEmailAddressNotification']);
						$mail->AddAddress($mail_config['email']);

							
						//Datos del email en si
						$mail->Subject = $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_SUBJECT']." '".$this->name."'";
							
						$mail->Body = $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY1']." [".$sugar_config['maxAllowedResults']."]. ".$productResults." ".$mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY2']."<br><br>";
						$mail->Body .= $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY3'].": <b>".$query."</b>";
							
						//Mensaje en caso de que el destinatario no admita emails en formato html
						$mail->AltBody = $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY1']." [".$sugar_config['maxAllowedResults']."]. ".$productResults." ".$mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY2']."\n\n";
						$mail->AltBody .= $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY3'].": <b>".$query."</b>";
							
						$success = $mail->Send();
							
						$tries=1;
						while ((!$success) && ($tries < 5)) {
								
							sleep(5);
							$success = $mail->Send();
							$tries++;
								
						}

						echo $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY1']." [".$sugar_config['maxAllowedResults']."]. ".$productResults." ".$mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY2'];
						wfm_utils::wfm_log('fatal', 'ASOL_Reports Reached Max Allowed Results [ '.$productResults.' rows tried to be managed by SQL ]', __FILE__, __METHOD__, __LINE__);
						exit();

					}

				}

			}

			$queryResults = $db->query($query);

			while($queryRow = $db->fetchByAssoc($queryResults))
				$retArray[] = $queryRow;
				
		} else {

			if ($notCrmExternalDb !== false) {
				
				//***********************//
				//***AlineaSol Premium***//
				//***********************//
				$extraParams = array(
					'notCrmExternalDb' => $notCrmExternalDb,
				);
				
				$mysqli = wfm_reports_utils::managePremiumFeature("externalDatabasesReports", "wfm_reports_utils_premium.php", "wfm_getConnectionToExternalDb", $extraParams);
				
				if (!$mysqli) {
					self::$reported_error = 'ASOL_Reports ErrorConnection ----> [ externalDatabasesReports Premium Feature not Enabled ]';
					wfm_utils::wfm_log('fatal', 'ASOL_Reports ErrorConnection ----> [ externalDatabasesReports Premium Feature not Enabled ]', __FILE__, __METHOD__, __LINE__);
					return;
				}
				//***********************//
				//***AlineaSol Premium***//
				//***********************//
							
			} else {
				
				$mysqli = new mysqli($sugar_config["asolReportsDbAddress"], $sugar_config["asolReportsDbUser"], $sugar_config["asolReportsDbPassword"], $sugar_config["asolReportsDbName"], $sugar_config["asolReportsDbPort"]);
			
			}

			if (mysqli_connect_errno()) {
				self::$reported_error = 'Connect failed: '.mysqli_connect_error();
				wfm_utils::wfm_log('fatal', 'Connect failed: '.mysqli_connect_error(), __FILE__, __METHOD__, __LINE__);
				return;
			}

			$mysqli->set_charset("utf8");
				
			wfm_utils::wfm_log('debug', 'ASOL_Reports query ----> [ '.$query.' ]', __FILE__, __METHOD__, __LINE__);

			if ($checkMaxAllowedResults) {
					
				$productResults = 1;

				if (substr($query, 0, 6) == 'SELECT') {
					$maxAllowedResults = $mysqli->query("EXPLAIN ".$query);
					while($maxAllowedResultsRow = $db->fetchByAssoc($maxAllowedResults))
					$productResults *= $maxAllowedResultsRow['rows'];
						
					if ($sugar_config['maxAllowedResults'] < $productResults) {

						//Enviar email a creador del informe!!!!
						$mail = new SugarPHPMailer();
							
						$mail->setMailerForSystem();
						$user = new User();
							
						//created by
						$mail_config = $user->getEmailInfo($this->created_by);
							
						$mail->From = $mail_config['email'];
						$mail->FromName = $mail_config['name'];
							
						//Timeout del envio de correo
						$mail->Timeout=30;
						$mail->CharSet = "UTF-8";
							
						//Emails de los destinatarios
						$mail->AddAddress($sugar_config['maxAllowedResultsEmailAddressNotification']);
						$mail->AddAddress($mail_config['email']);

							
						//Datos del email en si
						$mail->Subject = $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_SUBJECT']." '".$this->name."'";
							
						$mail->Body = $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY1']." [".$sugar_config['maxAllowedResults']."]. ".$productResults." ".$mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY2']."<br><br>";
						$mail->Body .= $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY3'].": <b>".$query."</b>";
							
						//Mensaje en caso de que el destinatario no admita emails en formato html
						$mail->AltBody = $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY1']." [".$sugar_config['maxAllowedResults']."]. ".$productResults." ".$mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY2']."\n\n";
						$mail->AltBody .= $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY3'].": <b>".$query."</b>";
							
						$success = $mail->Send();
							
						$tries=1;
						while ((!$success) && ($tries < 5)) {
								
							sleep(5);
							$success = $mail->Send();
							$tries++;
								
						}

						echo $mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY1']." [".$sugar_config['maxAllowedResults']."]. ".$productResults." ".$mod_strings['LBL_REPORT_MAX_ALLOWED_RESULTS_BODY2'];
						wfm_utils::wfm_log('fatal', 'ASOL_Reports Reached Max Allowed Results [ '.$productResults.' rows tried to be managed by SQL ]', __FILE__, __METHOD__, __LINE__);
						exit();

					}
						
				}

			}

			$queryResults = $mysqli->query($query);
				
			if (!$queryResults) {

				self::$reported_error = mysqli_error($mysqli);
				wfm_utils::wfm_log('fatal', 'ASOL_Reports ErrorQuery ----> [ '.mysqli_error($mysqli).' ]', __FILE__, __METHOD__, __LINE__);
					
			} else {

				while($queryRow = $queryResults->fetch_assoc())
				$retArray[] = $queryRow;
					
			}
				
			if ($queryResults)
			$queryResults->close();
				
			mysqli_close($mysqli);
				
		}


		//checkReportsMaxExecutionTime();
		if ((isset($sugar_config['asolReportsMaxExecutionTime'])) && ($sugar_config['asolReportsMaxExecutionTime'] > 0) && (isset($_REQUEST["reportRequestId"])) && (isset($_REQUEST["initRequestDateTimeStamp"]))) {

			$initGmtDateTimeStamp = $_REQUEST["initRequestDateTimeStamp"];
			$currentGmtTimeStamp = time();

			$runningTimeSeconds = $currentGmtTimeStamp - $initGmtDateTimeStamp;
				
			wfm_utils::wfm_log('debug', 'ASOL_Reports checkReportsMaxExecutionTime ----> [ '.$runningTimeSeconds.' Seconds ]', __FILE__, __METHOD__, __LINE__);

				
			if ($runningTimeSeconds > $sugar_config['asolReportsMaxExecutionTime']) {

				wfm_utils::wfm_log('fatal', 'Report with Request_Id ['.$_REQUEST["reportRequestId"].'] has TimedOut!!', __FILE__, __METHOD__, __LINE__);

				$sqlExecutingStatus = "UPDATE asol_reports_dispatcher SET status = 'timeout' WHERE id='".$_REQUEST["reportRequestId"]."' LIMIT 1";
				$db->query($sqlExecutingStatus);

				echo translate('LBL_REPORT_TIMEOUT','asol_Reports');

				wfm_utils::wfm_log('fatal', 'ASOL_Reports Execution TimedOut ----> [ '.$sugar_config['asolReportsMaxExecutionTime'].' Seconds for asolReportsMaxExecutionTime]', __FILE__, __METHOD__, __LINE__);

				exit();

			}
				
		}

		return $retArray;

	}

	static public function getEnumValues($operator, $reference) {

		global $app_list_strings;

		$resultVal = '';

		if ($operator == 'function') {
				
			$resultVal = implode('${comma}', $reference());
				
		} else if ($operator == 'options') {
				
			$resultVal = implode('${comma}', $app_list_strings[$reference]);
				
		}

		return $resultVal;

	}

	static public function getEnumLabels($operator, $reference) {

		global $app_list_strings, $current_language;

		$asolDefaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
		$current_language = (empty($current_language)) ? $asolDefaultLanguage : $current_language;
		$app_list_strings =	return_app_list_strings_language($current_language);

		$resultLabel = '';

		if ($operator == 'function') {
				
			foreach ($reference() as $key=>$value)
			$resultLabel .= $key.'${comma}';
				
			$resultLabel = substr($resultLabel, 0, -8);
				
		} else if ($operator == 'options') {
				
			foreach ($app_list_strings[$reference] as $key=>$value)
			$resultLabel .= $key.'${comma}';
				
			$resultLabel = substr($resultLabel, 0, -8);
				
		}

		return $resultLabel;

	}

	static public function getRelationShipLabelFromVardefs($module, $relationship_name) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $beanList, $beanFiles, $app_list_strings, $mod_strings;

		$class_name = $beanList[$module];
		require_once($beanFiles[$class_name]);
		$bean = new $class_name();
		$field_defs = $bean->field_defs;

		$relationship_label = isset($field_defs[$relationship_name]['vname']) ? translate($field_defs[$relationship_name]['vname'], $module) : $relationship_name;

		return $relationship_label;

	}

	static public function getFieldInfoFromVardefs($module, $field) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		if ($module == 'prospectlists') {
			$module = 'ProspectLists';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $beanList, $beanFiles, $app_list_strings, $mod_strings;

		$class_name = $beanList[$module];
		require_once($beanFiles[$class_name]);
		$bean = new $class_name();
		$field_defs = $bean->field_defs;

		$resultVal = '';
		$resultLabel = '';
		$enumOperator = '';
		$enumReference = '';
		$isAudited = false;

		$vName = $field;

		foreach ($field_defs as $name=>$values) {
			if ($name == $field) {
					
				$vNameKey = $values['vname'];
				$vName = translate($values['vname'], $module);
				$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;

				if (isset($values['audited']))
				$isAudited = $values['audited'];

				if ($values['type'] == 'currency') {
					$resultVal = 'currency';
				} else if (($values['type'] == 'enum') || ($values['type'] == 'multienum') || ($values['type'] == 'radioenum')) {
						
					$valOptions = (!empty($values['options'])) ? $values['options'] : "";

					if ($valOptions != '') {

						if (count($app_list_strings[$values['options']]) == 0)
						$app_list_strings[$values['options']] = Array();
							
						$resultVal = implode('|', $app_list_strings[$values['options']]);

						foreach ($app_list_strings[$values['options']] as $key=>$value)
						$resultLabel .= $key."|";

						$resultLabel = substr($resultLabel, 0, -1);

						$enumOperator = 'options';
						$enumReference = $values['options'];

					} else if ($values['function'] != '') {

						$resultVal = implode('|', $values['function']());

						foreach ($values['function']() as $key=>$value)
						$resultLabel .= $key."|";

						$resultLabel = substr($resultLabel, 0, -1);

						$enumOperator = 'function';
						$enumReference = $values['function'];

					}

				}
				break;
			}
		}

		return array(
					'values' => $resultVal,
					'labels' => $resultLabel,	
					'enumOperator' => $enumOperator,
					'enumReference' => $enumReference,
					'isAudited' => $isAudited,
					'field'				=> $field,
					'fieldLabel' 		=> $vName,				// field Label
					'fieldLabelKey'		=> $vNameKey,			// field Label Key (Ex. LBL_EVENT_ONE_OF) 
		);

	}

	static public function getAuditedFields($module, $fieldsToBeRemoved) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $beanList, $beanFiles, $app_list_strings;
		$class_name = $beanList[$module];
		require_once($beanFiles[$class_name]);
		$bean = new $class_name();
		$field_defs = $bean->field_defs;


		$auditedFields = array('');
		foreach ($field_defs as $name=>$values) {
				
			if (!in_array($name, $fieldsToBeRemoved)) {
					
				if ((isset($values['audited'])) && ($values['audited']))
				$auditedFields[] = $name;

			}
				
		}

		return $auditedFields;

	}

	static public function getAuditedLabels($module, $fieldsToBeRemoved) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $beanList, $beanFiles, $app_list_strings;
		$class_name = $beanList[$module];
		require_once($beanFiles[$class_name]);
		$bean = new $class_name();
		$field_defs = $bean->field_defs;


		$auditedFields = array('');
		foreach ($field_defs as $name=>$values) {
				
			if (!in_array($name, $fieldsToBeRemoved)) {
					
				if ((isset($values['audited'])) && ($values['audited'])) {
					$tranlatedAuditedField = translate($values['vname'], $module);
					$auditedFields[] =(substr($tranlatedAuditedField, -1) == ':') ? substr($tranlatedAuditedField, 0, -1) : $tranlatedAuditedField;
				}
					
			}
				
		}

		return $auditedFields;

	}

	static public function getRelateFieldModule($mainModule, $relateField) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($mainModule == 'campaigns') {
			$mainModule = 'Campaigns';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $beanList, $beanFiles, $app_list_strings;
		$class_name = $beanList[$mainModule];
		require_once($beanFiles[$class_name]);
		$bean = new $class_name();
		$field_defs = $bean->field_defs;



		$result = '';
		foreach ($field_defs as $name=>$values) {

			if ($values['id_name'] == $relateField) {
					
				$result = $values['module'];
				break;

			}
		}

		return $result;

	}

	static public function getReportsRelatedFields($bean) {
	
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

}
?>
	