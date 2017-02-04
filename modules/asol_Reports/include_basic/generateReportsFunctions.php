<?php

class asol_ReportsGenerationFunctions {

	
	public static function getModuleTablesAssociation($reportUserId) {

		$acl_modules = ACLAction::getUserActions($reportUserId);
		
		$modulesTables = array();
		foreach($acl_modules as $key=>$mod) {
			$currentModuleTable = BeanFactory::newBean(BeanFactory::getObjectName($key))->table_name;
			$modulesTables[$key] = (empty($currentModuleTable)) ? strtolower($key) : $currentModuleTable;
		}
		
		return $modulesTables;
		
	}
	
	public static function getEmailInfo($emailList) {
	
		global $mod_strings, $db;
		
		$email_list_field = explode('${pipe}', $emailList);
						
		$users_to = explode('${comma}', urldecode($email_list_field[1]));
		$users_cc = explode('${comma}', urldecode($email_list_field[2]));
		$users_bcc = explode('${comma}', urldecode($email_list_field[3]));
		$roles_to = explode('${comma}', urldecode($email_list_field[4]));
		$roles_cc = explode('${comma}', urldecode($email_list_field[5]));
		$roles_bcc = explode('${comma}', urldecode($email_list_field[6]));
		$emails_to = explode(',', urldecode($email_list_field[7]));
		$emails_cc = explode(',', urldecode($email_list_field[8]));
		$emails_bcc = explode(',', urldecode($email_list_field[9]));
		
		return array(
			"emailFrom" => $email_list_field[0],
			"emailArrays" => array(
				"users_to" => $users_to,
				"users_cc" => $users_cc,
				"users_bcc" => $users_bcc,
				"roles_to" => $roles_to,
				"roles_cc" => $roles_cc,
				"roles_bcc" => $roles_bcc,
				"emails_to" => $emails_to,
				"emails_cc" => $emails_cc,
				"emails_bcc" => $emails_bcc
			)
		);
		
	}
		
	public static function setSendEmailAddresses(& $reportMailer, $emailArray, $contextDomainId = null) {
		
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
		foreach ($emailArray['users_to'] as $key=>$value) {
			$userBean = BeanFactory::getBean('Users', $value);
			if (!empty($userBean)) {
				$userEmail = $userBean->getUsersNameAndEmail();
				$validUserMail = ($isDomainsInstalled) ? (($userEmail['email'] != "") && (($userBean->asol_domain_id == $domainId) || $userBean->is_admin)) : ($userEmail['email'] != "");
				if ($validUserMail) {
					$reportMailer->AddAddress($userEmail['email']);
				}
			}
		}
		foreach($emailArray['roles_to'] as $key => $value) {
			$usersFromRole = Array();
			if ($isDomainsInstalled) {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."' AND users.deleted=0 AND users.asol_domain_id='".$domainId."'";
			} else {
				$usersFromRoleSql = "SELECT user_id FROM acl_roles_users WHERE role_id = '".$value."'";
			}
			$usersFromRoleRs = $db->query($usersFromRoleSql);
			while($userFromRole_Row = $db->fetchByAssoc($usersFromRoleRs))
				$usersFromRole[] = $userFromRole_Row['user_id'];
			foreach($usersFromRole as $key=>$value) {
				$userEmail = BeanFactory::getBean('Users', $value)->getUsersNameAndEmail();
				if ($userEmail['email'] != "") {
					$reportMailer->AddAddress($userEmail['email']);
				}
			}
		}
		foreach ($emailArray['emails_to'] as $key=>$value){
			if ($value != "") {
				$reportMailer->AddAddress($value);
			}	
		}
		
		//***********************//
		//****** CC EMAILS ******//
		//***********************//
		//Emails de los destinatarios copias
		foreach ($emailArray['users_cc'] as $key=>$value) {
			$userBean = BeanFactory::getBean('Users', $value);
			if (!empty($userBean)) {
				$userEmail = $userBean->getUsersNameAndEmail();
				$validUserMail = ($isDomainsInstalled) ? (($userEmail['email'] != "") && (($userBean->asol_domain_id == $domainId) || $userBean->is_admin)) : ($userEmail['email'] != "");
				if ($validUserMail) {
					$reportMailer->AddCC($userEmail['email']);
				}
			}
		}
		foreach($emailArray['roles_cc'] as $key => $value) {
			$usersFromRole = Array();
			if ($isDomainsInstalled) {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."' AND users.deleted=0 AND users.asol_domain_id='".$domainId."'";
			} else {
				$usersFromRoleSql = "SELECT user_id FROM acl_roles_users WHERE role_id = '".$value."'";
			}
			$usersFromRoleRs = $db->query($usersFromRoleSql);
			while($userFromRole_Row = $db->fetchByAssoc($usersFromRoleRs))
				$usersFromRole[] = $userFromRole_Row['user_id'];
			foreach($usersFromRole as $key=>$value) {
				$userEmail = BeanFactory::getBean('Users', $value)->getUsersNameAndEmail();
				if ($userEmail['email'] != "") {
					$reportMailer->AddCC($userEmail['email']);
				}
			}
		}
		foreach ($emailArray['emails_cc'] as $key=>$value){
			if ($value != "") {
				$reportMailer->AddCC($value);
			}
		}
		
		//***********************//
		//***** BCC EMAILS ******//
		//***********************//
		foreach ($emailArray['users_bcc'] as $key=>$value) {
			$userBean = BeanFactory::getBean('Users', $value);
			if (!empty($userBean)) {
				$userEmail = $userBean->getUsersNameAndEmail();
				$validUserMail = ($isDomainsInstalled) ? (($userEmail['email'] != "") && (($userBean->asol_domain_id == $domainId) || $userBean->is_admin)) : ($userEmail['email'] != "");
				if ($validUserMail) {
					$reportMailer->AddBCC($userEmail['email']);
				}
			}
		}
		foreach($emailArray['roles_bcc'] as $key => $value) {
			$usersFromRole = Array();
			if ($isDomainsInstalled) {
				$usersFromRoleSql = "SELECT acl_roles_users.user_id FROM acl_roles_users LEFT JOIN users ON acl_roles_users.user_id=users.id WHERE acl_roles_users.role_id = '".$value."' AND users.deleted=0 AND users.asol_domain_id='".$domainId."'";
			} else {
				$usersFromRoleSql = "SELECT user_id FROM acl_roles_users WHERE role_id = '".$value."'";
			}
			$usersFromRoleRs = $db->query($usersFromRoleSql);
			while($userFromRole_Row = $db->fetchByAssoc($usersFromRoleRs))
				$usersFromRole[] = $userFromRole_Row['user_id'];
			foreach($usersFromRole as $key=>$value) {
				$userEmail = BeanFactory::getBean('Users', $value)->getUsersNameAndEmail();
				if ($userEmail['email'] != "") {
					$reportMailer->AddBCC($userEmail['email']);
				}
			}
		}
		foreach ($emailArray['emails_bcc'] as $key=>$value){
			if ($value != "") {
				$reportMailer->AddBCC($value);
			}
		}
		
	}
	
	public static function getSendEmailAlert($emailList, $contextDomainId = null) {
	
		global $mod_strings, $db, $current_user;
		
		//*************************************//
		//********Manage Report Domain*********//
		//*************************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
	
		if ($isDomainsInstalled) {
			$domainId = ($contextDomainId != null) ? $contextDomainId : $current_user->asol_default_domain;
		}
		
		$emailInfo = self::getEmailInfo($emailList);
		$emailInfoArray = $emailInfo['emailArrays'];
		
		$sendEmailquestion = $mod_strings['MSG_REPORT_SEND_EMAIL_ALERT'].'\n\n';
		
		if (!empty($emailInfoArray['users_to'][0])) {
			$usersToAux = array();
			if ($isDomainsInstalled)
				$usersToQuery = $db->query("SELECT id, user_name FROM users WHERE id IN('".implode("','", $emailInfoArray['users_to'])."') AND ((asol_domain_id = '".$domainId."') OR (is_admin = 1))");
			else
				$usersToQuery = $db->query("SELECT id, user_name FROM users WHERE id IN('".implode("','", $emailInfoArray['users_to'])."')");
			while ($usersToRow = $db->fetchByAssoc($usersToQuery))
				$usersToAux[] = $usersToRow['user_name'];
			
			if (!empty($usersToAux))
				$sendEmailquestion .= 'Users To: '.implode(', ', $usersToAux).'\n';
		}
		
		if (!empty($emailInfoArray['users_cc'][0])) {
			$usersCcAux = array();
			if ($isDomainsInstalled)
				$usersCcQuery = $db->query("SELECT id, user_name FROM users WHERE id IN('".implode("','", $emailInfoArray['users_cc'])."') AND ((asol_domain_id = '".$domainId."') OR (is_admin = 1))");
			else
				$usersCcQuery = $db->query("SELECT id, user_name FROM users WHERE id IN('".implode("','", $emailInfoArray['users_cc'])."')");
			while ($usersCcRow = $db->fetchByAssoc($usersCcQuery))
				$usersCcAux[] = $usersCcRow['user_name'];
				
			if (!empty($usersCcAux))
				$sendEmailquestion .= 'Users CC: '.implode(', ', $usersCcAux).'\n';
		}
		
		if (!empty($emailInfoArray['users_bcc'][0])) {
			$usersBccAux = array();
			if ($isDomainsInstalled)
				$usersBccQuery = $db->query("SELECT id, user_name FROM users WHERE id IN('".implode("','", $emailInfoArray['users_bcc'])."') AND ((asol_domain_id = '".$domainId."') OR (is_admin = 1))");
			else
				$usersBccQuery = $db->query("SELECT id, user_name FROM users WHERE id IN('".implode("','", $emailInfoArray['users_bcc'])."')");
			while ($usersBccRow = $db->fetchByAssoc($usersBccQuery))
				$usersBccAux[] = $usersBccRow['user_name'];
			
			if (!empty($usersBccAux))
				$sendEmailquestion .= 'Users BCC: '.implode(', ', $usersBccAux).'\n\n';
		}
		
		if (!empty($emailInfoArray['roles_to'][0])) {
			$rolesToAux = array();
			if ($isDomainsInstalled)
				$rolesToQuery = $db->query("SELECT Role.name as name FROM acl_roles Role LEFT JOIN asol_domains_aclroles RoleDomain ON (Role.id=RoleDomain.aclrole_id) WHERE Role.id IN('".implode("','", $emailInfoArray['roles_to'])."') AND RoleDomain.asol_domain_id = '".$domainId."'");
			else
				$rolesToQuery = $db->query("SELECT name FROM acl_roles WHERE id IN('".implode("','", $emailInfoArray['roles_to'])."')");
			while ($rolesToRow = $db->fetchByAssoc($rolesToQuery))
				$rolesToAux[] = $rolesToRow['name'];
				
			if (!empty($rolesToAux))
				$sendEmailquestion .= 'Roles To: '.implode(', ', $rolesToAux).'\n';
		}
		
		if (!empty($emailInfoArray['roles_cc'][0])) {
			$rolesCcAux = array();
			if ($isDomainsInstalled)
				$rolesCcQuery = $db->query("SELECT Role.name as name FROM acl_roles Role LEFT JOIN asol_domains_aclroles RoleDomain ON (Role.id=RoleDomain.aclrole_id) WHERE Role.id IN('".implode("','", $emailInfoArray['roles_cc'])."') AND RoleDomain.asol_domain_id = '".$domainId."'");
			else
				$rolesCcQuery = $db->query("SELECT name FROM acl_roles WHERE id IN('".implode("','", $emailInfoArray['roles_cc'])."')");
			while ($rolesCcRow = $db->fetchByAssoc($rolesCcQuery))
				$rolesCcAux[] = $rolesCcRow['name'];
			
			if (!empty($rolesCcAux))
				$sendEmailquestion .= 'Roles CC: '.implode(', ', $rolesCcAux).'\n';
		}
		
		if (!empty($emailInfoArray['roles_bcc'][0])) {
			$rolesBccAux = array();
			if ($isDomainsInstalled)
				$rolesBccQuery = $db->query("SELECT Role.name as name FROM acl_roles Role LEFT JOIN asol_domains_aclroles RoleDomain ON (Role.id=RoleDomain.aclrole_id) WHERE Role.id IN('".implode("','", $emailInfoArray['roles_bcc'])."') AND RoleDomain.asol_domain_id = '".$domainId."'");
			else
				$rolesBccQuery = $db->query("SELECT name FROM acl_roles WHERE id IN('".implode("','", $emailInfoArray['roles_bcc'])."')");
			while ($rolesBccRow = $db->fetchByAssoc($rolesBccQuery))
				$rolesBccAux[] = $rolesBccRow['name'];
			
			if (!empty($rolesBccAux))
				$sendEmailquestion .= 'Roles BCC: '.implode(', ', $rolesBccAux).'\n\n';
		}
		
		$sendEmailquestion .= (!empty($emailInfoArray['emails_to'][0])) ? 'Emails To: '.implode(', ', $emailInfoArray['emails_to']).'\n' : '';
		$sendEmailquestion .= (!empty($emailInfoArray['emails_cc'][0])) ? 'Emails CC: '.implode(', ', $emailInfoArray['emails_cc']).'\n' : '';
		$sendEmailquestion .= (!empty($emailInfoArray['emails_bcc'][0])) ? 'Emails BCC: '.implode(', ', $emailInfoArray['emails_bcc']) : '';
			
		return $sendEmailquestion;
		
	}
	
	
	public static function cleanDataBaseReportDispatcher() {
			
		global $db, $sugar_config;
		
		$dispatcherTableExists = $db->query("SHOW tables like 'asol_reports_dispatcher'", false);
	
		if ($dispatcherTableExists->num_rows > 0) {
	
			$currentTime = time();
			
			$checkHttpFileTimeout = (isset($sugar_config["asolReportsCheckHttpFileTimeout"])) ? $sugar_config["asolReportsCheckHttpFileTimeout"] : "1000";
			$timedOutStamp = $currentTime - $sugar_config['asolReportsMaxExecutionTime']; //Time to check report execution expiration time
			$closedWindowStamp = $currentTime - ($checkHttpFileTimeout / 500);  //Time to check last recall not updated for manual Reports (browser screen closed). 
			
			$cleanDispatcherTableSql = "DELETE FROM asol_reports_dispatcher WHERE (status IN ('terminated', 'timeout')) OR (request_init_date < ".$timedOutStamp.") OR ((status = 'waiting') AND (request_type = 'manual') AND (last_recall < ".$closedWindowStamp."))";
			$db->query($cleanDispatcherTableSql);
			
		}
		
	}
	
	
	public static function manageReportExternalDispatcher($dispatcherMaxRequests) {
	
		global $db, $sugar_config;
		
		if ($dispatcherMaxRequests > 0) {
			
			$_REQUEST["reportRequestId"] = $requestId;
			
			$waitForReport = false;
			
			$curlRequestedUrl = (isset($sugar_config["asolReportsCurlRequestUrl"]) ? $sugar_config["asolReportsCurlRequestUrl"].'/': '')."index.php?entryPoint=viewReport&module=asol_Reports&sourceCall=external&record=".$reportId."&external_filters=".$external_filters."&language=".$_REQUEST['language'];
				
			$requestId = create_guid();
			$currentGMTDate = time();
			
			$reportRequestId = "&reportRequestId=".$requestId;
			$curlRequestedUrl .= $reportRequestId;			
			$curlRequestedUrl .= "&initRequestDateTimeStamp=".$currentGMTDate;
			
			
			//******************************************************//
			//***This requested parameters must be sent with curl***//
			//******************************************************//
			if (!isset($_REQUEST["reportRequestId"]))
				$_REQUEST["reportRequestId"] = $requestId;
			if (!isset($_REQUEST["initRequestDateTimeStamp"]))
				$_REQUEST["initRequestDateTimeStamp"] = $currentGMTDate;
			//******************************************************//
			//***This requested parameters must be sent with curl***//
			//******************************************************//
				
			asol_ReportsUtils::reports_log('asol', 'Reporting Queue Feature Enabled', __FILE__, __METHOD__, __LINE__);
				
			$reportsDispatcherSql = "SELECT COUNT(id) as 'reportsThreads' FROM asol_reports_dispatcher WHERE status = 'executing'";
			$reportsDispatcherRs = $db->query($reportsDispatcherSql);
			$reportsDispatcherRow = $db->fetchByAssoc($reportsDispatcherRs);
			
			$currentReportsRunningThreads = $reportsDispatcherRow["reportsThreads"];
			
		
			if ($currentReportsRunningThreads >= $dispatcherMaxRequests) { //Put Report in queue
				
				$queueReportSql = "INSERT INTO `asol_reports_dispatcher` VALUES ('".$requestId."', '".$reportId."', '".$curlRequestedUrl."', 'waiting', '".$currentGMTDate."', '".$currentGMTDate."', 'external', '".$currentUserId."')";
				$db->query($queueReportSql);
				$waitForReport = true;
				
			} else {
				
				$executeReportSql = "INSERT INTO `asol_reports_dispatcher` VALUES ('".$requestId."', '".$reportId."', '".$curlRequestedUrl."', 'executing', '".$currentGMTDate."', '".$currentGMTDate."', 'external', '".$currentUserId."')";
				$db->query($executeReportSql);
				$waitForReport = false;
				
			}
			
			$checkHttpFileTimeout = (isset($sugar_config["asolReportsCheckHttpFileTimeout"])) ? $sugar_config["asolReportsCheckHttpFileTimeout"] : "1000";
			$micro_seconds = $checkHttpFileTimeout * 1000;
			
			if ($waitForReport) {
				
				$isInReadyArray = false;
				
				while (($currentReportsRunningThreads >= $dispatcherMaxRequests) && (!$isInReadyArray)) {
					
					usleep($micro_seconds);
					
					$recallGMTDate = time();
					
					$initGMTDateTimeStamp = $_REQUEST["initRequestDateTimeStamp"];
					$recallGMTDateTimeStamp = $recallGMTDate;
					
					
					//Check Max Report Execution time
					$runningTimeSeconds = $recallGMTDateTimeStamp - $initGMTDateTimeStamp;
					asol_ReportsUtils::reports_log('debug', 'Running Time: '.$runningTimeSeconds, __FILE__, __METHOD__, __LINE__);
					
					
					if ($runningTimeSeconds > $sugar_config['asolReportsMaxExecutionTime']) {
				
						asol_ReportsUtils::reports_log('asol', 'Report with Id ['.$reportId.'] has TimedOut!!', __FILE__, __METHOD__, __LINE__);
							
						$sqlExecutingStatus = "UPDATE asol_reports_dispatcher SET last_recall='".$recallGMTDateTimeStamp."', status = 'timeout' WHERE id='".$_REQUEST["reportRequestId"]."' LIMIT 1";
						$db->query($sqlExecutingStatus);
						die($mod_strings['LBL_REPORT_TIMEOUT']);
						
					}
					//Check Max Report Execution time
					
		
					$reportsDispatcherSql = "SELECT COUNT(id) as 'reportsThreads' FROM asol_reports_dispatcher WHERE status = 'executing'";
					$reportsDispatcherRs = $db->query($reportsDispatcherSql);
					$reportsDispatcherRow = $db->fetchByAssoc($reportsDispatcherRs);
					
					$currentReportsRunningThreads = $reportsDispatcherRow["reportsThreads"];
					
					$sqlLastRecall = "UPDATE asol_reports_dispatcher SET last_recall='".$recallGMTDateTimeStamp."' WHERE id='".$_REQUEST["reportRequestId"]."' LIMIT 1";
					$db->query($sqlLastRecall);
					
					//Check if Report is ready to Run (order by time ascending)
					if ($currentReportsRunningThreads < $dispatcherMaxRequests) {
					
						$availableReportThreads = $dispatcherMaxRequests - $currentReportsRunningThreads;
						
						$sqlWaitingReports = "SELECT id FROM asol_reports_dispatcher WHERE status = 'waiting' ORDER BY request_init_date ASC LIMIT ".$availableReportThreads;
						$rsWaitingReports = $db->query($sqlWaitingReports);
						
						$firtReports = array();
						
						while($row = $db->fetchByAssoc($rsWaitingReports))
							$firtReports[] = $row['id'];
						//Check if Report is ready to Run (order by time ascending)
						
						if (in_array($_REQUEST["reportRequestId"], $firtReports))
							$isInReadyArray = true;
					
					}
							
				}
				
				$sqlSetExecuting = "UPDATE asol_reports_dispatcher SET status = 'executing' WHERE id='".$_REQUEST["reportRequestId"]."' LIMIT 1";
				$db->query($sqlSetExecuting);
				
			}
	
		}
			
	}
	
	
	public static function getExternalRequestParams() {
					
		global $current_user, $current_language, $mod_strings;
		
		//Get language from url request parameter
		if (isset($_REQUEST['language']) && !empty($_REQUEST['language'])) {
			
			$current_language = $_REQUEST['language'];
			$mod_strings = return_module_language($current_language, "asol_Reports");
		
		}
		
		//Check if current user is setted on request
		if (isset($_REQUEST['currentUserId']) && !empty($_REQUEST['currentUserId'])) {
			
			$externalUser = new User();
			$current_user = $externalUser->retrieve($_REQUEST['currentUserId']);
			
		}
		
		return array (
			"current_language" => $current_language,
			"mod_strings" => $mod_strings,
			"current_user" => $current_user
		);
	
	} 
	
	public static function manageReportDomain($reportId, $userDomainId, $reportDomainId) {
	
		global $db;
		
		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
				
		$domainReportQuery = $db->query("SELECT * FROM asol_reports WHERE id='".$reportId."' LIMIT 1");
		$domainReportRow = $db->fetchByAssoc($domainReportQuery);

		$reportDomainIsPublished = ($domainReportRow['asol_published_domain'] == '1') ? true : false;		
		$reportDomainPublishedMode = $domainReportRow['asol_domain_published_mode'];
		$reportDomainPublishedLevels = ($domainReportRow['asol_domain_child_share_depth'] === ';;') ? array() : explode(';;', substr($domainReportRow['asol_domain_child_share_depth'], 1, -1));
		$reportDomainPublishedDomains = ($domainReportRow['asol_multi_create_domain'] === ';;') ? array() : explode(';;', substr($domainReportRow['asol_multi_create_domain'], 1, -1)); 
		$isPublished = $domainPublishingInfo;
		
		$domainPublishingInfo = array(
			'domains' => $reportDomainPublishedDomains,
			'levels' => $reportDomainPublishedLevels,
			'mode' => $reportDomainPublishedMode,
			'mainDomain' => $reportDomainId,
			'isPublished' => $reportDomainIsPublished
		);

		$reportPublishedDomains = asol_manageDomains::getDomainsPublished($domainPublishingInfo);
		$reportParentDomains = asol_manageDomains::getParentDomainsIds($reportDomainId, true);
			
		return (in_array($userDomainId, array_merge($reportPublishedDomains, $reportParentDomains)));
			
	}
	
	public static function getCurrentUserAsolConfig($userId) {
					
		$sqlCfg = "SELECT config FROM asol_config WHERE created_by = '".$userId."'";
		$rsCfg = asol_Report::getSelectionResults($sqlCfg, false);
		$cfg = explode("|",$rsCfg[0]['config']);
		$quarter_month = $cfg[0];
		$entries_per_page = (!empty($cfg[1])) ? $cfg[1] : 15;
		
		$pdf_orientation = $cfg[2];
		$week_start = $cfg[3];
		$pdf_img_scaling_factor = $cfg[4];
		$scheduled_files_ttl = (empty($cfg[5])) ? "7" : $cfg[5];
		$host_name = $cfg[6];
		
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
				
	public static function doFinalExecuteReportActions($reportId, $dispatcherMaxRequests) {
			
		global $db;
		
		if (($dispatcherMaxRequests > 0) && (isset($_REQUEST["reportRequestId"]))) //Only if dispatcher is activated
			$db->query("UPDATE asol_reports_dispatcher SET status = 'terminated', last_recall = '".time()."' WHERE id = '".$_REQUEST["reportRequestId"]."' LIMIT 1");	
	
		$db->query("UPDATE asol_reports SET last_run = '".gmdate("Y-m-d H:i:s")."' WHERE id = '".$reportId."' LIMIT 1");
		
		asol_ReportsUtils::reports_log('asol', 'Updated last_run for Report with Id ['.$reportId.']', __FILE__, __METHOD__, __LINE__);
		
	}
					
	
	public static function getStandByReportHtml($dashletId, $waitForReport) {
		
		global $mod_strings;
		
		$returnHtml .= '
		<body>
			<div id="reportDiv" class="alineasol_reports">
				<div id="externalHtmlReport'.$dashletId.'" name="externalHtmlReport'.$dashletId.'">
					<img id="loadingExternalReport" style="display:inline" src="themes/default/images/img_loading.gif"/>
				    <span style="display:inline" id="loadingText">&nbsp;';
			
					if ($waitForReport)
						$returnHtml.= $mod_strings['LBL_REPORT_WAITING'];
					else
						$returnHtml.= $mod_strings['LBL_REPORT_LOADING'];
			    
			    $returnHtml .= '</span>
				</div>
			</div>
		</body>';
		
		return $returnHtml;
			    
	}
	
	
	public static function getSetUpInputCalendarsScriptFunction($reportId, $filtersArrayData) {
		
		global $timedate;
		
		$returnedHTML = "function setUpUserInputCalendars_".str_replace("-", "", $reportId)."() {";
			
		foreach ($filtersArrayData as $oneFilterValues) {

			if ((in_array($oneFilterValues['type'], array("datetime", "date", "timestamp"))) && ($oneFilterValues['behavior'] == "user_input") && (!empty($oneFilterValues['filterReference']))) {	
						 		
				if (in_array($oneFilterValues['operator'], array("equals", "not equals", "before date", "after date", "between", "not between")))
					$returnedHTML .= "Calendar.setup ({ inputField : '".$oneFilterValues['filterReference']."_1' , daFormat : '".$timedate->get_cal_date_format()."', button : '".$oneFilterValues['filterReference']."_trigger1' , singleClick : true, dateStr : '', step : 1, weekNumbers:false });";
 	
				if (in_array($oneFilterValues['operator'], array("between", "not between")))
					$returnedHTML .= "Calendar.setup ({ inputField : '".$oneFilterValues['filterReference']."_2' , daFormat : '".$timedate->get_cal_date_format()."', button : '".$oneFilterValues['filterReference']."_trigger2' , singleClick : true, dateStr : '', step : 1, weekNumbers:false });";
 			
			}
						 		
		}

					
		$returnedHTML .= "}";
		
		return $returnedHTML;
		
	}
	
	
	public static function getReloadCurrentDashletScriptFunction($reportId, $dashletId) {
		
		global $sugar_config;
		
		return '
		function reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'(pageNumber, fieldSort, sortDirection, externalParams) {

			$("#externalHtmlReport'.$dashletId.'").block({ message: $("#loadingBlockDiv").html() });
			
			if ((externalParams != null) && (externalParams != ""))
				externalParams = "&external_filters="+externalParams
		
			$(function () { 
			    $.ajax({
			        type: "POST",
			        url: \''.(isset($sugar_config["asolReportsExtHttpUrl"]) ? $sugar_config["asolReportsExtHttpUrl"].'/' : '').'index.php?entryPoint=reloadReport&module=asol_Reports&record='.$reportId.'&dashlet=true&dashletId='.$dashletId.'&getLibraries=false&page_number=\'+pageNumber+\'&field_sort=\'+fieldSort+\'&sort_direction=\'+sortDirection+externalParams,
			        async: true,
			        cache: false,
			        success: function (data) {
						$("#externalHtmlReport'.$dashletId.'").html(data);
						$("#externalHtmlReport'.$dashletId.'").unblock();
					}		
			    });
			});
			
		}
		';
	
	}
	
	
	public static function getHttpChartsGenerationScriptFunction($reportId, $returnScript, $returnData, $reportCharts, $chartsEngine, $chartsUrls, $chartsInfo, $current_language, $isStoredReport, $isDashlet) {
		
		global $theme;
		
		$returnedHTML = "function setHttpXmlCharts_".str_replace("-", "", $reportId)."() {";

		if ($reportCharts != "Tabl") {
		
			switch ($chartsEngine) {

				case "flash":
					$flashArray = asol_ReportsCharts::getCrmChartHtml($reportId, $chartsEngine, $returnData, $returnScript, $chartsUrls, $chartsInfo, $current_language, $theme, $isStoredReport, $isDashlet);
					$returnedHTML .= $flashArray["chartHtml"];
					break;
					
				case "html5":
					$html5Array = asol_ReportsCharts::getCrmChartHtml($reportId, $chartsEngine, $returnData, $returnScript, $chartsUrls, $chartsInfo, $current_language, $theme, $isStoredReport, $isDashlet);
					$returnedHTML .= $html5Array["chartHtml"];			
					break;
				
				case "nvd3":
					$nvd3Array = asol_ReportsCharts::getCrmChartHtml($reportId, $chartsEngine, $returnData, $returnScript, $chartsUrls, $chartsInfo, $current_language, $theme, $isStoredReport, $isDashlet);
					$returnedHTML .= $nvd3Array["chartHtml"];
					break;

				default:
					break;
					
			}
			
		}
		
		$returnedHTML .= '}';
		
		return $returnedHTML;
		
	}
	
	public static function getSendAjaxRequestScriptFunction($reportId, $dashletId, $checkHttpFileTimeout, $httpHtmlFile, $reportRequestId, $initRequestTimeStamp) {
		
		global $sugar_config, $mod_strings;
		
		return '
		function sendAjaxRequest_'.str_replace("-", "", $reportId).'(firstLoad) {
		
			firstLoad = typeof(firstLoad) != "undefined" ? firstLoad : false;
			var checkHttpFileTimeout = (firstLoad) ? '.($checkHttpFileTimeout / 2).' : '.$checkHttpFileTimeout.';
			
			$(function () { 
	
			    $.ajax({
			        type: "POST",
					url: \''.(isset($sugar_config["asolReportsExtHttpUrl"]) ? $sugar_config["asolReportsExtHttpUrl"].'/' : '').'index.php?entryPoint=asol_CheckHttpFileExists&httpHtmlFile='.$httpHtmlFile.$reportRequestId.$initRequestTimeStamp.'\',
			        async: true,
			        cache: false,
			        success: function (data) {
			        
			        	data = data.replace(/^\s+/g,\'\').replace(/\s+$/g,\'\'); //Trim equivalent PHP function
			        
			        	if (data.substring(0, 5) == "false") {
			        		
			        		setTimeout("sendAjaxRequest_'.str_replace("-", "", $reportId).'()", checkHttpFileTimeout);
			        	
						} else if (data.substring(0, 4) == "exec") {
						
							$("#loadingText").html("'.$mod_strings['LBL_REPORT_LOADING'].'");
							setTimeout("sendAjaxRequest_'.str_replace("-", "", $reportId).'()", checkHttpFileTimeout);
						
						} else if (data.substring(0, 7) == "timeout") {
						
							$("#externalHtmlReport'.$dashletId.'").html("'.$mod_strings['LBL_REPORT_TIMEOUT'].'");
						
						} else {
							if(typeof window.blockUI == "function")
								$.unblockUI();
						
				            $("#externalHtmlReport'.$dashletId.'").html(data);
			        		setHttpXmlCharts_'.str_replace("-", "", $reportId).'();
			        		setUpUserInputCalendars_'.str_replace("-", "", $reportId).'();
			        		
			            }
			            	
					}
			    });
	
			}); 
		
		}';
		
	}
	
	public static function getInitialAjaxRequest2GenerateReportScript($reportId) {
		
		return '
		if(typeof window.SUGAR.util.doWhen == \'function\') {

			SUGAR.util.doWhen(function(){ return (typeof $ != \'undefined\')}, function(){
				sendAjaxRequest_'.str_replace("-", "", $reportId).'(true);
			});
			
		} else {
		
			$(document).ready(function() {
				sendAjaxRequest_'.str_replace("-", "", $reportId).'(true);
			});
			
		}';
		
	} 
				
	public static function getStoredReportData($storedData, $reportId, $isDashlet, $dashletId, $dashletWidth, $reportType) {
				
		global $sugar_config;
		
		$storedData = (empty($storedData)) ? 'false' : $storedData;		
		$storedUrl = 'index.php?entryPoint=scheduledStoredReport&module=asol_Reports&storedReportInfo='.$storedData;
		
		if ($isDashlet) {
			$storedUrl .= '&dashlet=true&dashletId='.$dashletId;
		}
			
		$returnedHtml = '<head>
		
			<script>
		
			if(typeof window.blockUI == "function")
				blockUI();
			
			function sendAjaxRequest_'.str_replace("-", "", $reportId).'() {
			
				$(function () { 
				    $.ajax({
				        type: "POST",
				        url: "'.(isset($sugar_config["asolReportsExtHttpUrl"]) ? $sugar_config["asolReportsExtHttpUrl"].'/' : '').$storedUrl.'",
				        async: true,
				        cache: false,
				        success: function (data) {
							$("#externalHtmlReport'.$dashletId.'").html(data);
						}		
				    });
				});
				
			}
	
			</script>
			
			<script>
		
				if(typeof window.SUGAR.util.doWhen == \'function\') {
		
					SUGAR.util.doWhen(function(){ return (typeof $ != \'undefined\')}, function(){
						sendAjaxRequest_'.str_replace("-", "", $reportId).'();
					});
					
				} else {
					$(document).ready(function() {
						sendAjaxRequest_'.str_replace("-", "", $reportId).'();
					});
					
				}
			</script>';
	
		$returnedHtml .= '
		</head>';
		
		
		
		if (!$isDashlet) {
		
			$returnedHtml .= self::getStandByReportHtml($dashletId, false);
			$returnedHtml .= '</html>';
		
		}
	
		return $returnedHtml;
		
	}
			
	
	public static function overrideExternalReportVariables($created_by) {
	
		global $sugar_config;
		
		$theUser = new User();
	
		if ((isset($_REQUEST['schedulerCall'])) && ($_REQUEST['schedulerCall'] == "true")) {
			
			$theUser->retrieve($created_by);
			
			$current_user = $theUser;
			$allowExportGeneratedFile = true;
			$schedulerCall = true;
			
		} else {
	
			$theUser->retrieve($sugar_config["BSS_Admin_WebService_User_Id"]); 
			
			$current_user = $theUser;
			$allowExportGeneratedFile = false;
			$schedulerCall = false;
			
		}
		
		$theUser->getUserDateTimePreferences();
		$userPrefs = $theUser->getUserDateTimePreferences();
		
		$externalUserDateFormat = $userPrefs["date"];
		$externalUserDateTimeFormat = $userPrefs["date"]." ".$userPrefs["time"];
			
		return array(
			"theUser" => $theUser,
			"current_user" => $current_user,
			
			"allowExportGeneratedFile" => $allowExportGeneratedFile,
			"schedulerCall" => $schedulerCall,
			
			"externalUserDateFormat" => $externalUserDateFormat,
			"externalUserDateTimeFormat" => $externalUserDateTimeFormat
		);
		
	}
					
	
	public static function manageExternalDatabaseQueries($alternativeDb, $reportModule, $report_table) {
		
		if ($alternativeDb !== false) {

			$domainField = null;
			$useAlternativeDbConnection = true;
			
			$alternativeModuleAux = explode(" ", $reportModule);
			$alternativeModule = explode(".", $alternativeModuleAux[0]);
			$report_module = $alternativeModule[1];
			$report_table = $report_module;
			$report_table_primary_key = asol_ReportsGenerateQuery::getExternalTablePrimaryKey($alternativeDb, $report_table);
			
			
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'alternativeDb' => $alternativeDb,
				'report_table' => $report_table,
			);
			
			$domainField = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalDatabaseDomainField", $extraParams);
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
				
		} else {

			$useAlternativeDbConnection = false;

			$report_module = $reportModule;
			$report_table = BeanFactory::newBean(BeanFactory::getObjectName($reportModule))->table_name;
			$report_table = $report_table == '' ? strtolower($report_module) : $report_table; 
			$report_table_primary_key = "id";
			
		}
		
		return array(
			"useAlternativeDbConnection" => $useAlternativeDbConnection,
			"domainField" => $domainField,
			"report_module" => $report_module,
			"report_table" => $report_table,
			"report_table_primary_key" => $report_table_primary_key
		);
		
	}
	
	
	public static function getChartInfoParams($selectedFields, $selectedCharts, $audited_report, $report_table) {
				
		$stackedAvailableCharts = array('stack', 'horizontal', 'line', 'scatter', 'area', 'bubble');
		
		$chart_info = unserialize(base64_decode($selectedCharts));
		$field_info = unserialize(base64_decode($selectedFields));
		
		$hasStackChart = false;
		$chartInfo = array();
		$chartConf = array();
		
		foreach ($chart_info['charts'] as $info) {

			$chartData = $info['data'];
			$chartConfig = $info['config'];
			
			if ($audited_report)
				$chartData['field'] = (count(explode(".", $chartData['field'])) == 1) ? $report_table."_audit.".$chartData['field'] : $chartData['field'];
			
			$hasStackChart = (($hasStackChart) || (($chartData['display'] == 'yes') && (in_array($chartData['type'], $stackedAvailableCharts)))) ? true : false;
			
			$chartInfo[] = $chartData;
			$chartConf[] = $chartConfig;
			
		}
		
		$fieldInfo = $field_info;
		
		return array(
			"hasStackChart" => $hasStackChart,
			"chartInfo" => $chartInfo,
			"chartConfig" => $chartConf,
			"fieldValues" => $fieldInfo
		);
	
	}
	
	
	public static function buildExternalFilters($external_filters, $userDateFormat) {
					
		global $timedate;
		
		//Get the external filter variables from request
		$extFilters = array();
		$auxFilters = explode('${pipe}', $external_filters);
		
		
		foreach ($auxFilters as $auxFilter) {
			
			$filterValues = explode('${dp}', $auxFilter);

			$secondFilterArray = explode('${comma}', $filterValues[3]);
			$hasThirdFilter = (count($secondFilterArray) == 1) ? false : true;
			
			//*****************//
			//***First Input***//
			//****************//
			if ( (!$timedate->check_matching_format($filterValues[2], $GLOBALS['timedate']->dbDayFormat)) && ($timedate->check_matching_format($filterValues[2], $userDateFormat)) && ($filterValues[2]!="") )
				$filterValues[2] = $timedate->swap_formats($filterValues[2], $userDateFormat, $GLOBALS['timedate']->dbDayFormat );
					
			//******************//
			//***Second Input***//
			//******************//
			if((!$timedate->check_matching_format($secondFilterArray[0], $GLOBALS['timedate']->dbDayFormat)) && ($timedate->check_matching_format($secondFilterArray[0], $userDateFormat)) && ($secondFilterArray[0]!=""))
				$secondFilterArray[0] = $timedate->swap_formats($secondFilterArray[0], $userDateFormat, $GLOBALS['timedate']->dbDayFormat );
				
			//*****************//
			//***Third Input***//
			//*****************//
			if ($hasThirdFilter) {
				if((!$timedate->check_matching_format($secondFilterArray[1], $GLOBALS['timedate']->dbDayFormat)) && ($timedate->check_matching_format($secondFilterArray[1], $userDateFormat)) && ($secondFilterArray[1]!=""))
					$secondFilterArray[1] = $timedate->swap_formats($secondFilterArray[1], $userDateFormat, $GLOBALS['timedate']->dbDayFormat );
			}

			$filterValues[3] = implode('${comma}', $secondFilterArray);
			
			
			$extFilters[$filterValues[0]] = array(
				"opp" => str_replace("+", " ", $filterValues[1]),
				"param1" => $filterValues[2],
				"param2" => $filterValues[3],
			);
			
		}
		
		return $extFilters;
		
	}

	public static function getFilteringParams($filters, $extFilters, $report_module, $dashletId, $userDateFormat, $audited_report) {

		global $current_user, $mod_strings, $app_strings, $timedate, $beanList, $beanFiles;
		

		$filtersPanel = array();
		$filtersHiddenInputs = "";
		
		$dashletId = str_replace("-", "", $dashletId);
		
		foreach ($filters['data'] as &$currentFilter) {
				
			$filterField = $currentFilter['field'];
			$filterReference = $currentFilter['filterReference'];
			$filterType = $currentFilter['type'];
			$filterBehavior = $currentFilter['behavior'];
			
			$filterUserOptions = $currentFilter['userOptions'];
			$filterEnumOperator = $currentFilter['enumOperator'];
			$filterEnumReference = $currentFilter['enumReference'];
			
			
			//Update filter values with external filters if exists
			if ((!empty($filterReference)) && (!empty($extFilters[$filterReference]))) {
				
				$currentFilter['operator'] = (($extFilters[$filterReference]["opp"] !== '') && ($extFilters[$filterReference]["opp"] !== NULL)) ? $extFilters[$filterReference]["opp"] : $currentFilter['operator'];
				$currentFilter['parameters']['first'] = (($extFilters[$filterReference]["param1"] !== '') && ($extFilters[$filterReference]["param1"] !== NULL)) ? explode('${dollar}', $extFilters[$filterReference]["param1"]) : $currentFilter['parameters']['first'];
				$nextParams = explode('${comma}', $extFilters[$filterReference]["param2"]);
				$currentFilter['parameters']['second'] = (($nextParams[0] !== '') && ($nextParams[0] !== NULL)) ? array($nextParams[0]) : $filterSecondParameter;
				$currentFilter['parameters']['third'] = (($nextParams[1] !== '') && ($nextParams[1] !== NULL)) ? array($nextParams[1]) : $filterThirdParameter;
				
			}

			$filterOperator = $currentFilter['operator'];
			$filterFirstParameter = $currentFilter['parameters']['first'];
			$filterSecondParameter = $currentFilter['parameters']['second'];
			$filterThirdParameter = $currentFilter['parameters']['third'];
				

			if (in_array($filterBehavior, array("user_input", "visible"))) {
				
				if ((substr($currentFilter['field'], -2) != 'id') && ($filterType == 'char(36)'))
					$currentFilter['type'] = 'relate';
				
				switch ($filterType) {
					
					case "enum" :

						$selectedOpts = $currentFilter['parameters']['first'];
	
						if ($filterBehavior == "user_input") {
							
							if (in_array($currentFilter['operator'], array("like", "not like"))) {
								$theInput1 = (empty($filterUserOptions)) ? "<input type='text' id='".$filterReference.$dashletId."_1' value='".$selectedOpts[0]."'>" : "<select id='".$filterReference."_1'>";
							} else {
								$selectMultiple = (in_array($currentFilter['operator'], array("one of", "not one of"))) ? "multiple size=3" : "";
								$theInput1 = "<select id='".$filterReference.$dashletId."_1' ".$selectMultiple.">";
							}
							
							//Get dropdown list field
							if (in_array($filterEnumOperator, array('options', 'function'))) {
							
								if (empty($filterUserOptions)) {
									$opts = asol_Report::getEnumValues($filterEnumOperator, $filterEnumReference);
									$optsLabels = asol_Report::getEnumLabels($filterEnumOperator, $filterEnumReference);
								} else { 
									$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
									$opts = $customGeneratedDropdownValues['opts'];
									$optsLabels = $customGeneratedDropdownValues['optsLabels'];
								}
								
							}

							if ((!in_array($currentFilter['operator'], array("like", "not like"))) || (!empty($filterUserOptions))) {
								
								foreach ($opts as $opt) {
									$theInput1 .= (in_array($opt, $selectedOpts)) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
								}
								
								$theInput1 .= "</select>";
								
							}

						} else if ($filterBehavior == "visible") {
							
							if (in_array($filterEnumOperator, array('options', 'function'))) {
							
								if (empty($filterUserOptions)) {
									$opts = asol_Report::getEnumValues($filterEnumOperator, $filterEnumReference);
									$optsLabels = asol_Report::getEnumLabels($filterEnumOperator, $filterEnumReference);
								} else {
									$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
									$opts = $customGeneratedDropdownValues['opts'];
									$optsLabels = $customGeneratedDropdownValues['optsLabels'];								
								}
								
							}
							
							$theInput1 = '<span>';
							
							foreach ($opts as $opt) {
								if (in_array($opt, $selectedOpts))
									$theInput1 .= $optsLabels[$opt]."<br>";
							}
							
							$theInput1 = substr($theInput1, 0, -4);
							
							$theInput1 .= '</span>';
							
						}
						
						$theInput2 = null;
						$theInput3 = null;
						break;
						
					case "datetime":
					case "date":
					case "timestamp":
						
						switch ($currentFilter['operator']) {
							
							case "equals":
							case "not equals":
							case "before date":
							case "after date":
								
								switch ($currentFilter['parameters']['first'][0]) {
									
									case "calendar":
										
										$date2 = $filterSecondParameter[0];
										
										if ($date2 != "")
											$date2 = $timedate->swap_formats($date2, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);
									
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$filterFirstParameter[0]."' /><span>".$mod_strings['LBL_REPORT_CALENDAR']."</span>";
											
											$theInput2 = "<input type='text' id='".$filterReference.$dashletId."_2' class='calendarValue' value='".$date2."' disabled='true' /><img border='0' class='calendarIcon' src='themes/default/images/jscalendar.gif' alt='Enter Date' id='".$filterReference.$dashletId."_trigger2'>";
											$theInput2 .= "<script>Calendar.setup ({ inputField : '".$filterReference.$dashletId."_2' , daFormat : '".$timedate->get_cal_date_format()."', button : '".$filterReference.$dashletId."_trigger2' , singleClick : true, dateStr : '', step : 1, weekNumbers:false });</script>";
										
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings['LBL_REPORT_CALENDAR']."</span>";
											$theInput2 = "<span>".$date2."</span>";
											
										}
									
										break;
										
									case "dayofweek":
										
										$selectedOpts = $filterSecondParameter;
										
										if (empty($filterUserOptions)) {
											$dowEnumArray = self::getDOWEnumArrays();
											$opts = $dowEnumArray["opts"];
											$optsLabels = $dowEnumArray["optsLabels"];
										} else {
											$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
											$opts = $customGeneratedDropdownValues['opts'];
											$optsLabels = $customGeneratedDropdownValues['optsLabels'];
										}
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings['LBL_REPORT_DAYOFWEEK']."</span>";
											
											$theInput2 = "<select id='".$filterReference.$dashletId."_2' multiple size=3>";
											foreach ($opts as $opt)
												$theInput2 .= (in_array($opt, $selectedOpts)) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
											$theInput2 .= "</select>";
											
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings['LBL_REPORT_DAYOFWEEK']."</span>";
											
											$theInput2 = '<span>';
											
											foreach ($opts as $opt) {
												if (in_array($opt, $selectedOpts))
													$theInput2 .= $optsLabels[$opt]."<br>";
											}
											
											$theInput2 = substr($theInput2, 0, -4);
											
											$theInput2 .= '</span>';
											
										}
										
										break;
										
									case "weekofyear":
										
										if (empty($filterUserOptions)) {
											$woyEnumArray = self::getWOYEnumArrays();
											$opts = $woyEnumArray["opts"];
											$optsLabels = $woyEnumArray["optsLabels"];
										} else {
											$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
											$opts = $customGeneratedDropdownValues['opts'];
											$optsLabels = $customGeneratedDropdownValues['optsLabels'];
										}
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings['LBL_REPORT_WEEKOFYEAR']."</span>";
											
											$theInput2 = "<select id='".$filterReference.$dashletId."_2'>";
											foreach ($opts as $opt)
												$theInput2 .= ($opt == $filterSecondParameter[0]) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
											$theInput2 .= "</select>";
											
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings['LBL_REPORT_WEEKOFYEAR']."</span>";
											$theInput2 = "<span>".$filterSecondParameter[0]."</span>";
											
										}
										
										break;
										
									case "monthofyear":
										
										$selectedOpts = $filterSecondParameter;
										
										if (empty($filterUserOptions)) {
											$moyEnumArray = self::getMOYEnumArrays();
											$opts = $moyEnumArray["opts"];
											$optsLabels = $moyEnumArray["optsLabels"];
										} else {
											$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
											$opts = $customGeneratedDropdownValues['opts'];
											$optsLabels = $customGeneratedDropdownValues['optsLabels'];
										}
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings['LBL_REPORT_MONTHOFYEAR']."</span>";
											
											$theInput2 = "<select id='".$filterReference.$dashletId."_2' multiple size=3>";
											foreach ($opts as $opt)
												$theInput2 .= (in_array($opt, $selectedOpts)) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
											$theInput2 .= "</select>";
											
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings['LBL_REPORT_MONTHOFYEAR']."</span>";
											
											$theInput2 = '<span>';
											
											foreach ($opts as $opt) {
												if (in_array($opt, $selectedOpts))
													$theInput2 .= $optsLabels[$opt]."<br>";
											}
											
											$theInput2 = substr($theInput2, 0, -4);
											
											$theInput2 .= '</span>';
											
										}
										
										break;
											
									case "naturalquarterofyear":
									case "fiscalquarterofyear":
										
										$selectedOpts = $filterSecondParameter;
										
										if (empty($filterUserOptions)) {
											$qoyEnumArray = self::getQOYEnumArrays();
											$opts = $qoyEnumArray["opts"];
											$optsLabels = $qoyEnumArray["optsLabels"];
										} else {
											$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
											$opts = $customGeneratedDropdownValues['opts'];
											$optsLabels = $customGeneratedDropdownValues['optsLabels'];
										}
										
										$userInputLabel = ($currentFilter['parameters']['first'][0] == "naturalquarterofyear") ? "LBL_REPORT_NATURALQUARTEROFYEAR" : "LBL_REPORT_FISCALQUARTEROFYEAR";
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings[$userInputLabel]."</span>";
											
											$theInput2 = "<select id='".$filterReference.$dashletId."_2' multiple size=3>";
											foreach ($opts as $opt)
												$theInput2 .= (in_array($opt, $selectedOpts)) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
											$theInput2 .= "</select>";
											
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings[$userInputLabel]."</span>";
											
											$theInput2 = '<span>';
											
											foreach ($opts as $opt) {
												if (in_array($opt, $selectedOpts))
													$theInput2 .= $optsLabels[$opt]."<br>";
											}
											
											$theInput2 = substr($theInput2, 0, -4);
											
											$theInput2 .= '</span>';
											
										}
										
										break;
										
									case "naturalyear":
									case "fiscalyear":
										
										$userInputLabel = ($currentFilter['parameters']['first'][0] == "naturalyear") ? "LBL_REPORT_NATURALYEAR" : "LBL_REPORT_FISCALYEAR";
										
										if (empty($filterSecondParameter))
											$filterSecondParameter = array(date("Y"));
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings[$userInputLabel]."</span>";
											$theInput2 = "<input type='text' id='".$filterReference.$dashletId."_2' style='width:80px' value='".$filterSecondParameter[0]."'>";
										
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings[$userInputLabel]."</span>";
											$theInput2 = "<span>".$filterSecondParameter[0]."</span>";
											
										}
										
										break;
										
								}
								
								$theInput3 = null;
								
								break;
								
							case "before date":
							case "after date":
								
								$date1 = $currentFilter['parameters']['first'][0];
									
								if ($date1 != "")
									$date1 = $timedate->swap_formats($date1, $GLOBALS['timedate']->dbDayFormat, $userDateFormat);

								if ($filterBehavior == "user_input") {
									
									$theInput1 = "<input type='text' id='".$filterReference.$dashletId."_1' class='calendarValue' value='".$date1."' disabled='true' /><img border='0' class='calendarIcon' src='themes/default/images/jscalendar.gif' alt='Enter Date' id='".$filterReference.$dashletId."_trigger1'>";
									$theInput1 .= "<script>Calendar.setup ({ inputField : '".$filterReference.$dashletId."_1' , daFormat : '".$timedate->get_cal_date_format()."', button : '".$filterReference.$dashletId."_trigger1' , singleClick : true, dateStr : '', step : 1, weekNumbers:false });</script>";
								
								} else if ($filterBehavior == "visible") {
									
									$theInput1 = "<span>".$date1."</span>";											
									
								}
								
								$theInput2 = null;
								$theInput3 = null;
								
								break;
								
							case "between":
							case "not between":

								$input1 = $filterSecondParameter[0];
								$input2 = $filterThirdParameter[0];
								
								switch ($currentFilter['parameters']['first'][0]) {
									
									case "calendar":

										if((!$timedate->check_matching_format($input1, $userDateFormat)) && ($input1 != ""))
											$input1 = $timedate->swap_formats($input1, $GLOBALS['timedate']->dbDayFormat, $userDateFormat );

										if((!$timedate->check_matching_format($input2, $userDateFormat)) && ($input1 != ""))
											$input2 = $timedate->swap_formats($input2, $GLOBALS['timedate']->dbDayFormat, $userDateFormat );

											
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."' /><span>".$mod_strings['LBL_REPORT_CALENDAR']."</span>";
											
											$theInput2 = "<input type='text' id='".$filterReference.$dashletId."_2' class='calendarValue' value='".$input1."' disabled='true' /><img border='0' class='calendarIcon' src='themes/default/images/jscalendar.gif' alt='Enter Date' id='".$filterReference.$dashletId."_trigger2'>";
											$theInput2 .= "<script>Calendar.setup ({ inputField : '".$filterReference.$dashletId."_2' , daFormat : '".$timedate->get_cal_date_format()."', button : '".$filterReference.$dashletId."_trigger2' , singleClick : true, dateStr : '', step : 1, weekNumbers:false });</script>";
//											$theInput3 = $mod_strings['LBL_REPORT_AND'].' ';
											$theInput3 .= "<input type='text' id='".$filterReference.$dashletId."_3' class='calendarValue' value='".$input2."' disabled='true' /><img border='0' class='calendarIcon' src='themes/default/images/jscalendar.gif' alt='Enter Date' id='".$filterReference.$dashletId."_trigger3'>";						
											$theInput3 .= "<script>Calendar.setup ({ inputField : '".$filterReference.$dashletId."_3' , daFormat : '".$timedate->get_cal_date_format()."', button : '".$filterReference.$dashletId."_trigger3' , singleClick : true, dateStr : '', step : 1, weekNumbers:false });</script>";
										
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings['LBL_REPORT_CALENDAR']."</span>";
											
											$theInput2 = "<span>".$input1."</span>";
//											$theInput3 = $mod_strings['LBL_REPORT_AND'].' ';
											$theInput3 .= "<span>".$input2."</span>";
											
										}

										break;
										
									case "weekofyear":
										
										if (empty($filterUserOptions)) {
											$woyEnumArray = self::getWOYEnumArrays();
											$opts = $woyEnumArray["opts"];
											$optsLabels = $woyEnumArray["optsLabels"];
										} else {
											$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
											$opts = $customGeneratedDropdownValues['opts'];
											$optsLabels = $customGeneratedDropdownValues['optsLabels'];
										}
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings['LBL_REPORT_WEEKOFYEAR']."</span>";
											
											$theInput2 = "<select id='".$filterReference.$dashletId."_2'>";
											foreach ($opts as $opt)
												$theInput2 .= ($opt == $input1) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
											$theInput2 .= "</select>";
											$theInput3 = "<span style='display: block'>".$mod_strings['LBL_REPORT_AND']."</span>";
											$theInput3 .= "<select id='".$filterReference.$dashletId."_3'>";
											foreach ($opts as $opt)
												$theInput3 .= ($opt == $input2) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
											$theInput3 .= "</select>";
											
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings['LBL_REPORT_WEEKOFYEAR']."</span>";
											$theInput2 = "<span>".$input1."</span>";
											$theInput3 = "<span style='display: block'>".$mod_strings['LBL_REPORT_AND']."</span>";
											$theInput3 .= "<span>".$input2."</span>";
											
										}
										
										break;
										
									case "naturalyear":
									case "fiscalyear":
										
										$userInputLabel = ($currentFilter['parameters']['first'][0] == "naturalyear") ? "LBL_REPORT_NATURALYEAR" : "LBL_REPORT_FISCALYEAR";
										
										if (empty($input1))
											$input1 = date("Y");
										if (empty($input2))
											$input2 = date("Y");
										
										if ($filterBehavior == "user_input") {
											
											$theInput1 = "<input type='hidden' id='".$filterReference.$dashletId."_1' value='".$currentFilter['parameters']['first'][0]."'><span>".$mod_strings[$userInputLabel]."</span>";
											$theInput2 = "<input type='text' id='".$filterReference.$dashletId."_2' style='width:80px' value='".$input1."'>";
											$theInput3 = "<span style='display: block'>".$mod_strings['LBL_REPORT_AND']."</span>";
											$theInput3 .= "<input type='text' id='".$filterReference.$dashletId."_3' style='width:80px' value='".$input2."'>";
											
										} else if ($filterBehavior == "visible") {
											
											$theInput1 = "<span>".$mod_strings[$userInputLabel]."</span>";
											$theInput2 = "<span>".$input1."</span>";
											$theInput3 = "<span style='display: block'>".$mod_strings['LBL_REPORT_AND']."</span>";
											$theInput3 .= "<span>".$input2."</span>";
											
										}
										
										break;
									
								}
								
								break;
								
							case "last":
							case "not last":
								
								if (empty($filterUserOptions)) {
									$doaEnumArray = self::getDateOperatorArrays();
									$opts = $doaEnumArray["opts"];
									$optsLabels = $doaEnumArray["optsLabels"];
								} else {
									$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
									$opts = $customGeneratedDropdownValues['opts'];
									$optsLabels = $customGeneratedDropdownValues['optsLabels'];
								}
																
								
								if ($filterBehavior == "user_input") {
								
									$theInput1 = "<select id='".$filterReference.$dashletId."_1' onChange='if (this.selectedIndex >= 7) { document.getElementById(\"".$filterReference."_2\").style.display=\"none\"; } else { document.getElementById(\"".$filterReference."_2\").style.display=\"inline\"; } '>";
									foreach ($opts as $opt)
										$theInput1 .= ($opt == $currentFilter['parameters']['first'][0]) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
									$theInput1 .= "</select>";
									
								} else if ($filterBehavior == "visible") {

									$theInput1 = (!empty($extFilters[$filterReference]["param1"])) ? '<span>'.$optsLabels[$extFilters[$filterReference]["param1"]].'</span>' : '<span>'.$optsLabels[$currentFilter['parameters']['first'][0]].'</span>';
									
								}
								
								switch ($currentFilter['parameters']['first'][0]) {
									
									case "day":
									case "week":
									case "month":
									case "Nquarter":
									case "Fquarter":
									case "Nyear":
									case "Fyear":
										
										if ($filterBehavior == "user_input")
											$theInput2 = '<input id="'.$filterReference.$dashletId.'_2" type="text" value="'.$filterSecondParameter[0].'">';
										else if ($filterBehavior == "visible")
											$theInput2 = '<span>'.$filterSecondParameter[0].'</span>';
										
										break;
										
									default:
										
										if ($filterBehavior == "user_input")
											$theInput2 = '<input id="'.$filterReference.'_2" style="display: none;" type="text" value="'.$filterSecondParameter[0].'">';
										else if ($filterBehavior == "visible")
											$theInput2 = '<span>'.$filterSecondParameter[0].'</span>';
										
										break;
									
								}
								
								$theInput3 = null;
								
								break;
								
							case "this":
							case "not this":
								
								if (empty($filterUserOptions)) {
									$rdoaEnumArray = self::getReducedDateOperatorArrays();
									$opts = $rdoaEnumArray["opts"];
									$optsLabels = $rdoaEnumArray["optsLabels"];
								} else {
									$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
									$opts = $customGeneratedDropdownValues['opts'];
									$optsLabels = $customGeneratedDropdownValues['optsLabels'];
								}
								
								if ($filterBehavior == "user_input") {
									
									$theInput1 = "<select id='".$filterReference.$dashletId."_1'>";
									foreach ($opts as $opt)
										$theInput1 .= ($opt == $currentFilter['parameters']['first'][0]) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
									$theInput1 .= "</select>";
								
								} else if ($filterBehavior == "visible") {
									
									$theInput1 = '<span>'.$optsLabels[$currentFilter['parameters']['first'][0]].'</span>';
									
								}
								
								$theInput2 = null;
								$theInput3 = null;
								
								break;
								
							case "next":
							case "not next":
							case "these":	
														
								if (empty($filterUserOptions)) {
									$rdoaEnumArray = self::getReducedDateOperatorArrays();
									$opts = $rdoaEnumArray["opts"];
									$optsLabels = $rdoaEnumArray["optsLabels"];
								} else {
									$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
									$opts = $customGeneratedDropdownValues['opts'];
									$optsLabels = $customGeneratedDropdownValues['optsLabels'];
								}
								
								if ($filterBehavior == "user_input") {
									
									$theInput1 = "<select id='".$filterReference.$dashletId."_1'>";
									foreach ($opts as $opt)
										$theInput1 .= ($opt == $currentFilter['parameters']['first'][0]) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";	
									$theInput1 .= "</select>";
									
								} else if ($filterBehavior == "visible") {
									
									$theInput1 = '<span>'.$optsLabels[$currentFilter['parameters']['first'][0]].'</span>';
									
								}
								
								if ($filterBehavior == "user_input") {

									$theInput2 = '<input id="'.$filterReference.'_2" type="text" value="'.$filterSecondParameter[0].'">';
								
								} else if ($filterBehavior == "visible") {

									$theInput2 = '<span>'.$filterSecondParameter[0].'</span>';
								
								}
								
								$theInput3 = null;
									
								break;
							
						}
						
						break;
						
					case "bool":
					case "tinyint(1)":
						if (!empty($extFilters[$filterReference]["param1"]))
							$currentFilter['parameters']['first'][0] = $extFilters[$filterReference]["param1"];

						if ($filterBehavior == "user_input")
							$theInput1 = ($currentFilter['parameters']['first'][0] == "true") ? "<select id='".$filterReference.$dashletId."_1' name='".$filterReference."_1'><option value='true' selected>".$mod_strings["LBL_REPORT_TRUE"]."</option><option value='false'>".$mod_strings["LBL_REPORT_FALSE"]."</option></select>" : "<select id='".$filterReference.$dashletId."_1'><option value='true'>".$mod_strings["LBL_REPORT_TRUE"]."</option><option value='false' selected>".$mod_strings["LBL_REPORT_FALSE"]."</option></select>";
						else if ($filterBehavior == "visible")
							$theInput1 = "<span>".$currentFilter['parameters']['first'][0]."</span>";
						
						$theInput2 = null;
						$theInput3 = null;
						
						break;

					case "relate" :
						if (!empty($extFilters[$filterReference]["param1"]))
							$currentFilter['parameters']['first'][0] = $extFilters[$filterReference]["param1"];

						$tmpField = explode(".", $filterField);
						
						$relateField = (count($tmpField) == 2) ? $tmpField[1] : $filterField;

						if ($audited_report) {
							if ($filterField == 'parent_id')
								$relateModule = $report_module;
							else if ($filterField == 'created_by')
								$relateModule = "Users";
						} else {
							$relateModule = asol_Report::getRelateFieldModule($report_module, $relateField);
						}
						
						if (($filterOperator === 'my items') && (empty($currentFilter['parameters']['first'][0])))
							$moduleFieldValue = $current_user->id;
						else 
							$moduleFieldValue = $currentFilter['parameters']['first'][0];
						
						$relateId = "id";
						$relateName = ($relateModule == 'Users') ? "user_name" : "name";
						$fieldInputId = $filterReference.$dashletId."_1";
						$fieldInputName = $filterReference.$dashletId."_1_name";

						//Create new ModuleObject and get Name field Value
						$moduleFieldName = BeanFactory::getBean($relateModule, $moduleFieldValue)->$relateName;
						//Create new ModuleObject and get Name field Value
						
						
						$popup_selector = 
						"<input type='hidden' id='".$filterReference.$dashletId."_1"."' value='".$moduleFieldValue."'><input readonly type='text' autocomplete='off' title='' value='".$moduleFieldName."' id='".$filterReference.$dashletId."_1_name"."'>
						<button type='button' onclick=\"open_popup('".$relateModule."', 600, 400, '', true, false, {'call_back_function':'set_return','form_name':'criteria_form','field_to_name_array':{'".$relateId."':'".$fieldInputId."','".$relateName."':'".$fieldInputName."'}}, 'single', true);\" class='button' title='".$app_strings['LBL_SELECT_BUTTON_LABEL']."'><img src='themes/default/images/id-ff-select.png'></button>
						<button type='button' onclick=\"document.getElementById('".$filterReference.$dashletId."_1_name').value =''; document.getElementById('".$filterReference.$dashletId."_1').value = ''\" value='Clear'><img src='themes/default/images/id-ff-clear.png'></button>";
							
						if ($filterBehavior == "user_input")
							$theInput1 = $popup_selector;
						else if ($filterBehavior == "visible")
							$theInput1 = "<span>".$moduleFieldName."</span>";
						
						$theInput2 = null;
						$theInput3 = null;
						
						break;
						
						
					default:
						
						if ($filterBehavior == "user_input") {

							$selectMultiple = (in_array($currentFilter['operator'], array("one of", "not one of"))) ? "multiple size=3" : "";
							
							if (empty($filterUserOptions)) {
		
								$theInput1 = '<input id="'.$filterReference.$dashletId.'_1" type="text" value="'.$currentFilter['parameters']['first'][0].'">';

							} else {
								
								$selectedOpts = $currentFilter['parameters']['first'];
								$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
								$opts = $customGeneratedDropdownValues['opts'];
								$optsLabels = $customGeneratedDropdownValues['optsLabels'];							


								$theInput1 = '<select id="'.$filterReference.$dashletId.'_1" '.$selectMultiple.'>';
								foreach ($opts as $opt) {
									$theInput1 .= (in_array($opt, $selectedOpts)) ? "<option value='".$opt."' selected>".$optsLabels[$opt]."</option>" : "<option value='".$opt."'>".$optsLabels[$opt]."</option>";
								}
								
								$theInput1 .= "</select>";		
	
							}

						} else if ($filterBehavior == "visible") {
							
							if (empty($filterUserOptions)) {
							
								$theInput1 = '<span>'.$currentFilter['parameters']['first'][0].'</span>';
							
							} else {
								
								$selectedOpts = $currentFilter['parameters']['first'];
								
								$customGeneratedDropdownValues = self::getCustomGeneratedDropdownValues($filterUserOptions);
								$opts = $customGeneratedDropdownValues['opts'];
								$optsLabels = $customGeneratedDropdownValues['optsLabels'];
								
								$theInput1 = '<span>';
							
								foreach ($opts as $opt) {
									if (in_array($opt, $selectedOpts))
										$theInput1 .= $optsLabels[$opt]."<br>";
								}
								
								$theInput1 = substr($theInput1, 0, -4);
								
								$theInput1 .= '</span>';
								
							}
							
						}
						
						$theInput2 = null;
						$theInput3 = null;
						break;
					
				}
				
				
				if ($filterBehavior == "user_input") {
					
					if ($theInput3 != null)
						$filtersHiddenInputs .= $filterReference.'${dp}'.$currentFilter['operator'].'${dp}3${pipe}';
					else if ($theInput2 != null)
						$filtersHiddenInputs .= $filterReference.'${dp}'.$currentFilter['operator'].'${dp}2${pipe}';
					else
						$filtersHiddenInputs .= $filterReference.'${dp}'.$currentFilter['operator'].'${dp}1${pipe}';
					
				}
					
					
				
				
				
				$filterLabelValue = "";
				
				if ($filterBehavior == "visible") {
				
					$filterLabel = "LBL_REPORT_".strtoupper(str_replace(" ", "_", $currentFilter['operator']))."_".strtoupper(str_replace(" ", "_", $currentFilter['parameters']['first'][0]));
					$filterLabel .= (!empty($filterSecondParameter[0])) ? "_".$filterSecondParameter[0] : "";
					$filterLabelValue = $mod_strings[$filterLabel];
					
					if (empty($filterLabelValue)) {
						
						$filterLabel = "LBL_REPORT_".strtoupper(str_replace(" ", "_", $currentFilter['operator']));
						$filterLabelValue = $mod_strings[$filterLabel];
						
					}
					
				} else {

					$filterLabel = "LBL_REPORT_".strtoupper(str_replace(" ", "_", $currentFilter['operator']));
					$filterLabelValue = $mod_strings[$filterLabel];
					
				}
				
				
				
				$filtersPanel[] = Array  ( 
										"type" => $val,
										"label" => $currentFilter['alias'],
										"reference" => $filterReference,
										"opp" => $currentFilter['operator'],
										"input1" => $theInput1, 
										"input2" => $theInput2,
										"input3" => $theInput3,
										"genLabel" => (!empty($filterLabelValue)) ? $filterLabelValue: $currentFilter['operator'],
								  );
								  
		  
			}
			
		}
	
		$filtersHiddenInputs = urlencode(substr($filtersHiddenInputs, 0, -7));
		$filtersHiddenInputs = (!empty($filtersHiddenInputs)) ? $filtersHiddenInputs : false;
	
		return array(
			"filterValues" => $filters,
			"filtersPanel" => $filtersPanel,
			"filtersHiddenInputs" => $filtersHiddenInputs
		);
		
	}
	
	private static function getUserOptionsReadableFormat($userOptions) {
		if ($userOptions == null) {
			$userOptions = array();
		}
		
		$ret = "";
		foreach($userOptions as $entry) {
			$key = $entry['key'];
			$value = $entry['value'];
			
			$ret .= $key;
			if (isset($value)) {
				$ret .= '='.$value;
			}
			$ret .= ",";
			
		}
		
		return substr($ret, 0, -1);
	}
	
	private static function getCustomGeneratedDropdownValues($generatedDropdown) {
		
		$opts = array();
		$optsLabels = array();
		
		foreach($generatedDropdown as $dropdownValues) {
			$opts[] = $dropdownValues['key']; //If 'a,b,c' format then internal & display values are the same
			$optsLabels[$dropdownValues['key']] = (isset($dropdownValues['value']) ? $dropdownValues['value'] : $dropdownValues['key']); //Else if 'a=A,b=B,c=C' format then internal & display values are different
		}

		return array(
			"opts" => $opts,
			"optsLabels" => $optsLabels
		);
		
	}
	
	
	public static function getReportTotalEntries($sqlFrom, $sqlCountJoin, $sqlWhere, $sqlGroup, $group_by_seq, $useExternalDbConnection, $alternativeDb) {
	
		$rs = asol_Report::getSelectionResults("SELECT COUNT(*) AS total ".$sqlFrom.$sqlCountJoin.$sqlWhere.$sqlGroup, $useExternalDbConnection, $alternativeDb);
		
		if (isset($group_by_seq[0]['field'])) {
			
			$rsG = asol_Report::getSelectionResults("SELECT COUNT(DISTINCT ".$group_by_seq[0]['field'].") AS total ".$sqlFrom.$sqlCountJoin.$sqlWhere, $useExternalDbConnection, $alternativeDb);
		
			$total_entries = (($rsG[0]['total'] == 0) && ($rs[0]['total'] != 0)) ? 1 : $rsG[0]['total'];
		
			if ($rs[0]['total'] == 0)
				$total_entries = 0;
		
			if (count($group_by_seq) != 0)
				$total_entries = count($rs);
		
		} else {
			
			$total_entries = $rs[0]['total'];
		
		}
		
		return $total_entries;
	
	}
						
	
	public static function correctEmptyReport($sqlSelect, $sqlTotals) {
						
		$selectReturn = (strlen($sqlSelect) <= 6) ? " id" : null;
		
		$totalReturn["sql"] = (strlen($sqlTotals) <= 6) ? " COUNT(*) AS 'TOTAL'" : null;
		$totalReturn["column"] = (strlen($sqlTotals) <= 6) ? "TOTAL" : null;
		
		return array(
			"select" => $selectReturn,
			"totals" => $totalReturn
		);
		
	}
	
	
	public static function getOrderPaginationSingleDetailVars($detailFieldInfo, $results_limit, $sqlFrom, $sqlJoin, $sqlWhere, $sqlGroup, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults) {
	
		$sizes;
		$fullSizes;
		$sqlOrderGroups = "";
		
		if ($detailFieldInfo['order'] != '0') {
			$sqlOrderGroups = " ORDER BY ".$detailFieldInfo['field']." ".$detailFieldInfo['order'];		
		} 
		
		$sqlGroupsQuery = "SELECT DISTINCT ".$detailFieldInfo['field']." AS 'group' ".$sqlFrom.$sqlJoin.$sqlWhere.$sqlOrderGroups;
		$rsGroups = asol_Report::getSelectionResults($sqlGroupsQuery, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
	
		for ($j=0; $j<count($rsGroups); $j++){
	
			$rsGroups[$j]['group'] = ($rsGroups[$j]['group'] == "") ? "Nameless" : $rsGroups[$j]['group'] = str_replace("&quot;", "\"", str_replace("&#039;", "\'", $rsGroups[$j]['group']));
	
			$groupField = $detailFieldInfo['field'];
			$subGroup = $rsGroups[$j]['group'];
	
			$sqlDetailGroupWhere = ($subGroup != "Nameless") ? $sqlWhere." AND ".$groupField."='".$subGroup."' " : $sqlWhere." AND ".$groupField." IS NULL ";
			$sqlDetailGroupQuery = "SELECT COUNT(*) AS total ".$sqlFrom.$sqlJoin.$sqlDetailGroupWhere.$sqlGroup;
			

			$rsCount = asol_Report::getSelectionResults($sqlDetailGroupQuery, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
	
			if ($results_limit == "all") {
				$sizes[$j] = $rsCount[0]['total'];
			} else {
				$res_limit = explode('${dp}', $results_limit);
				$sizes[$j] = ($rsCount[0]['total'] < $res_limit[2]) ? $rsCount[0]['total'] : $res_limit[2];
			}
	
			$fullSizes[$j] = $rsCount[0]['total'];
	
		}
			
		return array(
			"rsGroups" => $rsGroups,
			"sizes" => $sizes,
			"fullSizes" => $fullSizes
		);
		
	}
					
	
	public static function getOrderPaginationDateDetailVars($detailFieldInfo, $results_limit, $sqlFrom, $sqlJoin, $sqlWhere, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults, $week_start) {
		
		if (in_array($detailFieldInfo['grouping'], array('Day Detail', 'DoW Detail', 'WoY Detail', 'Month Detail', 'Natural Quarter Detail', 'Fiscal Quarter Detail', 'Natural Year Detail', 'Fiscal Year Detail')))
			$sqlGroupsQuery = "SELECT DISTINCT ".$detailFieldInfo['field']." AS 'group' ".$sqlFrom.$sqlJoin.$sqlWhere;		
		
		$sqlOrderGroups = "";
		
		if ($detailFieldInfo['order'] != '0') {
			
			if (in_array($detailFieldInfo['grouping'], array('Day Detail', 'DoW Detail', 'WoY Detail', 'Month Detail', 'Natural Quarter Detail', 'Fiscal Quarter Detail', 'Natural Year Detail', 'Fiscal Year Detail'))) 
				$sqlOrderGroups = " ORDER BY ".$detailFieldInfo['field']." ".$detailFieldInfo['order'];
				
		} 
			
		$rsGroups = asol_Report::getSelectionResults($sqlGroupsQuery.$sqlOrderGroups, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
	
		
		//*********************************************//
		//***Reorder Groups if Week Starts on Sunday***//
		//*********************************************//
		if (($detailFieldInfo['grouping'] === 'DoW Detail') && ($week_start !== '1')) {
			array_unshift($rsGroups, array_pop($rsGroups));
		}
		//*********************************************//
		//***Reorder Groups if Week Starts on Sunday***//
		//*********************************************//
		
		
		$sizes;
		$fullSizes;
		
		for ($j=0; $j<count($rsGroups); $j++) {
			
			$groupField = $detailFieldInfo['field'];
			$subGroup = $rsGroups[$j]['group'];
			
			if (in_array($detailFieldInfo['grouping'], array('Day Detail', 'DoW Detail', 'WoY Detail', 'Month Detail', 'Natural Quarter Detail', 'Fiscal Quarter Detail', 'Natural Year Detail', 'Fiscal Year Detail')))
				$sqlDetailGroupWhere = $sqlWhere." AND ".$groupField."='".$subGroup."' ";
		
		
			$sqlDetailGroupQuery = "SELECT COUNT(*) AS total ".$sqlFrom.$sqlJoin.$sqlDetailGroupWhere.$sqlGroup;
			
			
			$rsCount = asol_Report::getSelectionResults($sqlDetailGroupQuery, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
				
			if ($results_limit == "all") {
				$sizes[$j] = $rsCount[0]['total'];
			} else {
				$res_limit = explode('${dp}', $results_limit);
				$sizes[$j] = ($rsCount[0]['total'] < $res_limit[2]) ? $rsCount[0]['total'] : $res_limit[2];
			}
	
			$fullSizes[$j] = $rsCount[0]['total'];
			
		}
		
		return array(
			"rsGroups" => $rsGroups,
			"sizes" => $sizes,
			"fullSizes" => $fullSizes
		);
		
	}
	
	
	public static function getPaginationMainVariables($page_number, $entries_per_page, $sizes) {
							
		$current_entries = 0;
		$first_entry = 0;
	
		$init_group = 0;
		$end_group = 0;
		$index = 0;
		
		for ($k=0; $k<=$page_number; $k++) {
				
			$current_entries = 0;
			$current_entries += $sizes[$index];
		
			while (($current_entries < $entries_per_page) && ($index+1 < count($sizes))){
				$index++;
				$current_entries += $sizes[$index];
			}
				
			if ($k == ($page_number-1)){
				$init_group = $index+1;
			}
				
			if ($k == $page_number){
				$end_group = $index;
			}
				
			$index++;
			$first_entry += $current_entries;
		}
		
		$first_entry -= $current_entries;
		
		return array(
			"init_group" => $init_group,
			"end_group" => $end_group,
			"current_entries" => $current_entries,
			"first_entry" => $first_entry
		);
		
	}
						
	
	public static function getDetailGroupWhereExtensionQuery($sqlWhere, $groupField, $subGroup) {
	
		global $mod_strings;
		
		if ($subGroup != "Nameless")
			$sqlDetailWhere = $sqlWhere." AND ".$groupField."='".$subGroup."' ";
		else {
			$sqlDetailWhere = $sqlWhere." AND ".$groupField." IS NULL ";
			$subGroup = $mod_strings['LBL_REPORT_NAMELESS'];
		}
		
		return array(
			"subGroup" => $subGroup,
			"sqlDetailWhere" => $sqlDetailWhere
		);
	
	}

							
	public static function getDateDetailGroupWhereExtensionQuery($sqlWhere, $groupField, $detailGrouping, $subGroup) {
		
		if (in_array($detailGrouping, array('Day Detail', 'DoW Detail', 'WoY Detail', 'Month Detail', 'Natural Quarter Detail', 'Fiscal Quarter Detail', 'Natural Year Detail', 'Fiscal Year Detail')))
			$sqlDetailWhere = $sqlWhere." AND ".$groupField."='".$subGroup."' ";

		return array(
			"subGroup" => $subGroup,
			"sqlDetailWhere" => $sqlDetailWhere
		);
		
	}
		
	public static function sortAssocArray(&$assocArray, $key, $ascending = true, $isInteger = true) {
				
		if ($isInteger) {
	
			if ($ascending)
				usort($assocArray, create_function('$a, $b', "return (int)\$a['".$key."'] - (int)\$b['".$key."'];"));
			else
				usort($assocArray, create_function('$a, $b', "return (int)\$b['".$key."'] - (int)\$a['".$key."'];"));
		
		} else {
		
			if ($ascending)
				usort($assocArray, create_function('$a, $b', "return strcmp(\$a['".$key."'], \$b['".$key."']);"));
			else
				usort($assocArray, create_function('$a, $b', "return strcmp(\$a['".$key."'], \$b['".$key."'])*-1;"));
		
		}
	
	}
	
	/*
	self::sortAssocArray($rs, $groupSubTotalField, true, true);
	*/
	
	public static function getTableConfiguration($tables, $index) {
		$tablesArray = unserialize(base64_decode($tables));
		return $tablesArray['tables'][$index]['config'];
	}

	private static function getDOWEnumArrays() {
		
		global $mod_strings;
		
		$dowLabels = array(
			"0" => $mod_strings["LBL_REPORT_MONDAY"],
			"1" => $mod_strings["LBL_REPORT_TUESDAY"],
			"2" => $mod_strings["LBL_REPORT_WEDNESDAY"],
			"3" => $mod_strings["LBL_REPORT_THURSDAY"],
			"4" => $mod_strings["LBL_REPORT_FRIDAY"],
			"5" => $mod_strings["LBL_REPORT_SATURDAY"],
			"6" => $mod_strings["LBL_REPORT_SUNDAY"]
		);
		$dowValues = array_keys($dowLabels);
		
		return array(
			"opts" => $dowValues,
			"optsLabels" => $dowLabels,
		);
	}
	
	private static function getWOYEnumArrays() {
		$weeksInYear = 53;
		$woyLabels = array();
		
		for ($week = 1; $week <= $weeksInYear; $week++) {
			$woyLabels[$week] = $week;
		}
		
		$woyValues = array_keys($woyLabels);
		
		return array(
			"opts" => $woyValues,
			"optsLabels" => $woyLabels,
		);
		
	}
	
	private static function getMOYEnumArrays() {
		
		global $mod_strings;
		
		$moyLabels = array(
			"1" => $mod_strings["LBL_REPORT_JANUARY"],
			"2" => $mod_strings["LBL_REPORT_FEBRUARY"],
			"3" => $mod_strings["LBL_REPORT_MARCH"],
			"4" => $mod_strings["LBL_REPORT_APRIL"],
			"5" => $mod_strings["LBL_REPORT_MAY"],
			"6" => $mod_strings["LBL_REPORT_JUNE"],
			"7" => $mod_strings["LBL_REPORT_JULY"],
			"8" => $mod_strings["LBL_REPORT_AUGUST"],
			"9" => $mod_strings["LBL_REPORT_SEPTEMBER"],
			"10" => $mod_strings["LBL_REPORT_OCTOBER"],
			"11" => $mod_strings["LBL_REPORT_NOVEMBER"],
			"12" => $mod_strings["LBL_REPORT_DECEMBER"]
		);
		$moyValues = array_keys($moyLabels);
		
		return array(
			"opts" => $moyValues,
			"optsLabels" => $moyLabels,
		);
	}
	
	private static function getQOYEnumArrays() {
		$qoyLabels = array(
			"1" => "1º",
			"2" => "2º",
			"3" => "3º",
			"4" => "4º"
		);
		$qoyValues = array_keys($qoyLabels);
		
		return array(
			"opts" => $qoyValues,
			"optsLabels" => $qoyLabels,
		);
	}
	
	private static function getDateOperatorArrays() {
		
		global $mod_strings;
		
		$doaLabels = array(
			"day" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_DAY"),
			"week" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_WEEK"),
			"month" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_MONTH"),
			"Nquarter" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_NQUARTER"),
			"Fquarter" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_FQUARTER"),
			"Nyear" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_NYEAR"),
			"Fyear" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_FYEAR"),
			"monday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_MONDAY"),
			"tuesday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_TUESDAY"),
			"wednesday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_WEDNESDAY"),
			"thursday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_THURSDAY"),
			"friday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_FRIDAY"),
			"saturday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_SATURDAY"),
			"sunday" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_SUNDAY"),
			"january" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_JANUARY"),
			"february" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_FEBRUARY"),
			"march" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_MARCH"),
			"april" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_APRIL"),
			"may" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_MAY"),
			"june" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_JUNE"),
			"july" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_JULY"),
			"august" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_AUGUST"),
			"september" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_SEPTEMBER"),
			"october" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_OCTOBER"),
			"november" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_NOVEMBER"),
			"december" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_DECEMBER")
		);
		$doaValues = array_keys($doaLabels);
		
		return array(
			"opts" => $doaValues,
			"optsLabels" => $doaLabels,
		);
	}
	
	private static function getReducedDateOperatorArrays() {
		
		global $mod_strings;
		
		$rdoaLabels = array(
			"day" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_DAY"),
			"week" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_WEEK"),
			"month" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_MONTH"),
			"Nquarter" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_NQUARTER"),
			"Fquarter" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_FQUARTER"),
			"Nyear" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_NYEAR"),
			"Fyear" => asol_ReportsUtils::translateReportsLabel("LBL_REPORT_FYEAR")
		);
		$rdoaValues = array_keys($rdoaLabels);
		
		return array(
			"opts" => $rdoaValues,
			"optsLabels" => $rdoaLabels,
		);
	}
	
}
	
?>