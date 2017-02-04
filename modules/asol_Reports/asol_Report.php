<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/reportsUtils.php");


class asol_Report extends Basic {

	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $created_by;
	var $description;
	var $deleted;
	var $assigned_user_id;
	var $last_run;
	var $report_module;
	var $report_scope;
	var $report_fields;
	var $report_filters;
	var $report_type;
	var $report_scheduled_type;
	var $report_attachment_format;
	var $report_tasks;
	var $report_charts;
	var $report_charts_engine;
	var $report_charts_detail;
	var $scheduled_images;
	var $row_index_display;
	var $results_limit;
	var $email_list;
	var $audited_report;
	var $alternative_database;

	static public $reported_error = null;

	var $table_name = "asol_reports";
	var $object_name = "asol_Report";
	var $module_dir = "asol_Reports";

	var $importable = true;
	var $tablePath;
	var $joinSegments;
	var $rootGuid;
	var $fromString;

	var $evalSQLFunctions = true;
	var $maxDepth;

	function asol_Report() {
		parent::Basic();
	}

	function bean_implements($interface){
		switch($interface){
			case 'ACL':return true;
		}
		return false;
	}

	function get_summary_text()	{
		return $this->name;
	}

	function fill_in_additional_detail_fields()	{
		parent::fill_in_additional_detail_fields();
	}


	static public function getSelectionResults($query, $useAlternativeDb = true, $notCrmExternalDb = false, $checkMaxAllowedResults = false, $offset = 0, $entries = 0) {

		global $sugar_config, $db, $current_user, $mod_strings;

		self::$reported_error = (self::$reported_error === null) ? null : self::$reported_error;
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
						asol_ReportsUtils::reports_log('fatal', 'ASOL_Reports Reached Max Allowed Results [ '.$productResults.' rows tried to be managed by SQL ]', __FILE__, __METHOD__, __LINE__);
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
				
				$mysqli = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getConnectionToExternalDb", $extraParams);
				
				if (!$mysqli) {
					self::$reported_error = 'ASOL_Reports ErrorConnection ----> [ externalDatabasesReports Premium Feature not Enabled ]';
					asol_ReportsUtils::reports_log('fatal', 'ASOL_Reports ErrorConnection ----> [ externalDatabasesReports Premium Feature not Enabled ]', __FILE__, __METHOD__, __LINE__);
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
				asol_ReportsUtils::reports_log('fatal', 'Connect failed: '.mysqli_connect_error(), __FILE__, __METHOD__, __LINE__);
				return;
			}

			$mysqli->set_charset("utf8");
				
			asol_ReportsUtils::reports_log('debug', 'ASOL_Reports query ----> [ '.$query.' ]', __FILE__, __METHOD__, __LINE__);

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
						asol_ReportsUtils::reports_log('fatal', 'ASOL_Reports Reached Max Allowed Results [ '.$productResults.' rows tried to be managed by SQL ]', __FILE__, __METHOD__, __LINE__);
						exit();

					}
						
				}

			}

			$queryResults = $mysqli->query($query);
				
			if (!$queryResults) {

				self::$reported_error = mysqli_error($mysqli);
				asol_ReportsUtils::reports_log('fatal', 'ASOL_Reports ErrorQuery ----> [ '.mysqli_error($mysqli).' ]', __FILE__, __METHOD__, __LINE__);
					
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
				
			asol_ReportsUtils::reports_log('debug', 'ASOL_Reports checkReportsMaxExecutionTime ----> [ '.$runningTimeSeconds.' Seconds ]', __FILE__, __METHOD__, __LINE__);

				
			if ($runningTimeSeconds > $sugar_config['asolReportsMaxExecutionTime']) {

				asol_ReportsUtils::reports_log('fatal', 'Report with Request_Id ['.$_REQUEST["reportRequestId"].'] has TimedOut!!', __FILE__, __METHOD__, __LINE__);

				$sqlExecutingStatus = "UPDATE asol_reports_dispatcher SET status = 'timeout' WHERE id='".$_REQUEST["reportRequestId"]."' LIMIT 1";
				$db->query($sqlExecutingStatus);

				echo translate('LBL_REPORT_TIMEOUT','asol_Reports');

				asol_ReportsUtils::reports_log('fatal', 'ASOL_Reports Execution TimedOut ----> [ '.$sugar_config['asolReportsMaxExecutionTime'].' Seconds for asolReportsMaxExecutionTime]', __FILE__, __METHOD__, __LINE__);

				exit();

			}
				
		}

		return $retArray;

	}


	static public function getEnumLabels($operator, $reference) {

		global $app_list_strings;

		if ($operator == 'function') {
				
			return $reference();
				
		} else if ($operator == 'options') {
				
			return $app_list_strings[$reference];
				
		}

		return array();

	}

	static public function getEnumValues($operator, $reference) {

		global $app_list_strings, $current_language;

		$asolDefaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
		$current_language = (empty($current_language)) ? $asolDefaultLanguage : $current_language;
		$app_list_strings =	return_app_list_strings_language($current_language);

		if ($operator == 'function') {
				
			return array_keys($reference());
				
		} else if ($operator == 'options') {

			return array_keys($app_list_strings[$reference]);
				
		}

		return array();

	}

	static public function getRelationShipLabelFromVardefs($module, $relationship_name) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		if ($module == 'prospectlists') {
			$module = 'ProspectLists';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		$field_defs = BeanFactory::newBean($module)->field_defs;
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

		global $app_list_strings, $mod_strings;

		$field_defs = BeanFactory::newBean($module)->field_defs;
		$values = $field_defs[$field];
		
		
		$resultVal = '';
		$resultLabel = '';
		$enumOperator = '';
		$enumReference = '';
		$isAudited = false;
		$relateModule = null;
		
		
		$vName = (isset($values['vname'])) ? translate($values['vname'], $module) : $field;
		$vName = (substr($vName, -1) == ':') ? substr($vName, 0, -1) : $vName;

		if (isset($values['audited']))
		$isAudited = $values['audited'];
		
		if (isset($values['module']))
		$relateModule = $values['module'];

		if ($values['type'] == 'currency') {
			$resultVal = 'currency';
		} else if (in_array($values['type'], array('enum', 'multienum', 'radioenum'))) {
				
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
		

		return array(
					'values' => $resultVal,
					'labels' => $resultLabel,	
					'enumOperator' => $enumOperator,
					'enumReference' => $enumReference,
					'isAudited' => $isAudited,
					'relateModule' => $relateModule,
					'fieldLabel' => $vName,
		);

	}

	static public function getAuditedFields($module, $fieldsToBeRemoved) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $app_list_strings;
		
		$field_defs = BeanFactory::newBean($module)->field_defs;

		$auditedFields = array('');
		foreach ($field_defs as $name=>$values) {
				
			if (!in_array($name, $fieldsToBeRemoved)) {
					
				if ((isset($values['audited'])) && ($values['audited']))
				$auditedFields[] = $name;

			}
				
		}

		return $auditedFields;

	}

	static public function getAuditedLabels($module, $fieldsToBeRemoved, $translateLabel = true) {
		////////////////////////////////////////////////////////////////////////////////////////
		// patch to solve a bug in table "relationships": the module "campaigns" is in lowercase
		if ($module == 'campaigns') {
			$module = 'Campaigns';
		}
		////////////////////////////////////////////////////////////////////////////////////////

		global $app_list_strings;
		
		$field_defs = BeanFactory::newBean($module)->field_defs;


		$auditedFields = array('' => '');
		foreach ($field_defs as $name=>$values) {
				
			if (!in_array($name, $fieldsToBeRemoved)) {
					
				if ((isset($values['audited'])) && ($values['audited'])) {
					$tranlatedAuditedField = translate($values['vname'], $module);
					$displayedTranslatedLabel = (substr($tranlatedAuditedField, -1) == ':') ? substr($tranlatedAuditedField, 0, -1) : $tranlatedAuditedField;
					$auditedFields[$name] = ($translateLabel) ? $displayedTranslatedLabel : $name;
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

		$field_defs = BeanFactory::newBean($mainModule)->field_defs;


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
