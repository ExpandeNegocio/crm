<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

error_reporting(1); //E_ERROR 

require_once('include/Dashlets/DashletGenericChart.php');

class ReportChartDashlet extends DashletGenericChart {
	
    public $rcd_ids = array();
    var $chartDefs;
    var $chartDefName;
    
    protected $_seedName = 'asol_Reports';
    
    public function __construct($id, array $options = null) 
    {
    
    	require_once('modules/asol_Reports/include_basic/reportsUtils.php');
    
        global $timedate, $sugar_config, $db, $current_user;
            
        parent::__construct($id,$options);

        $sDatabase = (isset($_REQUEST['sDatabase'])) ? $_REQUEST['sDatabase'] : "-1";
		$sModule = (isset($_REQUEST['sModule'])) ? $_REQUEST['sModule'] : "";
		$sScope = (isset($_REQUEST['sScope'])) ? $_REQUEST['sScope'] : "";
		$sName = (isset($_REQUEST['sName'])) ? $_REQUEST['sName'] : "";
        
		// Make a list of charts from the chartdef files
		require "modules/Charts/chartdefs.php";
		if (file_exists("custom/Charts/chartDefs.ext.php"))
			require("custom/Charts/chartDefs.ext.php");	
		$this->chartDefs = $chartDefs;
		
		
		$allowedModule = array();
		$sqlAllowedModules = "";
		$acl_modules = ACLAction::getUserActions($current_user->id);
		
		foreach($acl_modules as $key=>$mod){
			if($mod['module']['access']['aclaccess'] >= 0){
				if ((isset($sugar_config['asolModulesPermissions']['asolAllowedTables'])) || (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']))) {
					//Restrictive
					if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) ) {
						$allowedModule[$key] = false;
					} else if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance'])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance']))) { 
						$allowedModule[$key] = false;	
					} 
					if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) ) {
						if (!isset($allowedModule[$key]))
							$allowedModule[$key] = true;		
					} else if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) ) {
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
				$sqlAllowedModules .= "'".$key."',";
			}
		}
		
		$sqlAllowedModules = substr($sqlAllowedModules, 0, -1).",''";
		
		
		//***********************//
		//***AlineaSol Premium***//
		//***********************//
		$extraParams = array(
			'report_database' => $sDatabase,
		);
		
		$sqlExternalModules = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalDatabasesExtendedWhereQuery", $extraParams);
		
		$sqlExternalModules = (!$sqlExternalModules) ? " )" : $sqlExternalModules;
		//***********************//
		//***AlineaSol Premium***//
		//***********************//
		
				
		if ($sDatabase != '-1') {
			$sModule = '';
			$sqlAllowedModules = '\'\'';
		}		

	
		$sqlReport = "SELECT id, name FROM asol_reports WHERE deleted=0";
		$sqlReport .= (!empty($sName)) ? " AND name LIKE '%".$sName."%'" : "";
		
		$sqlReport .= (!empty($sModule)) ? " AND report_module LIKE '%".$sModule."%'" : "";
		$sqlReport .= " AND ((asol_reports.report_module IN (".$sqlAllowedModules."))";
		
		$sqlReport .= $sqlExternalModules;

		$sqlReport .= (!empty($sScope)) ? " AND report_scope LIKE '%".$sScope."%'" : "";
		
		
	    if (!$current_user->is_admin) {
	
			$idsRoles = array();
			$queryUserRoles = $db->query("SELECT DISTINCT role_id FROM acl_roles_users WHERE user_id='".$current_user->id."' AND deleted=0");
			while($queryRow = $db->fetchByAssoc($queryUserRoles))
				$idsRoles[] = $queryRow['role_id'];
				
			$sqlReport .= " AND (report_scope = 'public' OR asol_reports.assigned_user_id = '".$current_user->id."' OR asol_reports.created_by = '".$current_user->id."'";
		
			$sqlWhereRoles = " OR (";
			foreach ($idsRoles as $idRole)
				$sqlWhereRoles .= " report_scope LIKE '%".$idRole."%' OR";
			$sqlWhereRoles = substr($sqlWhereRoles, 0, -2).")";
			
			if (empty($idsRoles))
				$sqlWhereRoles = "";
				
			$sqlReport .= $sqlWhereRoles." )";
			
		}
		

		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		
		if ($isDomainsInstalled) {
		
			if ((!$current_user->is_admin) || (($current_user->is_admin) && (!empty($current_user->asol_default_domain)))){
				
				$domainsBean = BeanFactory::getBean('asol_Domains', $current_user->asol_default_domain);
				
				if ($domainsBean->asol_domain_enabled) {

					$sqlReport .= " AND ( (asol_reports.asol_domain_id='".$current_user->asol_default_domain."')";
				
					if ($current_user->asol_only_my_domain == 0) {
					
						//asol_domain_child_share_depth
						$sqlReport .= asol_manageDomains::getChildShareDepthQuery('asol_reports.');
						//asol_domain_child_share_depth
						
						//asol_multi_create_domain 
						$sqlReport .= asol_manageDomains::getMultiCreateQuery('asol_reports.');
						//asol_multi_create_domain 
						
						//***asol_publish_to_all***//
						$sqlReport .= asol_manageDomains::getPublishToAllQuery('asol_reports.');
						//***asol_publish_to_all***//
		
						$sqlReport .= ")";
						
					} else {
					
						$sqlReport .= ") ";
						
					}
						
				} else {
					
					$sqlReport .= " AND (1!=1) ";
				
				}

			}
			
		}
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		
		
		$sqlReport .= " ORDER BY date_entered ASC";

		
		$reportsArray = array();
		
		$queryReport = $db->query($sqlReport);
		while($queryRow = $db->fetchByAssoc($queryReport))
			$reportsArray[] = $queryRow;
		
		foreach ($reportsArray as $value){
			$chart_list[$value['id']] = $value['name'];
			$rcd_ids[$value['id']] = $value['id'];
		}
		$this->_searchFields['which_chart']['options'] = $chart_list;
    }
    
    
    public function displayOptions() {

    	require_once('modules/asol_Reports/include_basic/reportsUtils.php');
    	
		global $app_list_strings, $sugar_config, $current_user, $db, $current_language, $dashletStrings;

		$module = array();
		
		$this->chartDefName = $this->which_chart[0];

		if (!empty($this->chartDefs[$this->chartDefName]['searchFields']))
			foreach ($this->chartDefs[$this->chartDefName]['searchFields'] as $key => $value)
				$this->_searchFields[$key] = $value;

		$this->_searchFields['which_chart']['vname'] = $dashletStrings['ReportChartDashlet']['LBL_WHICH_CHART'].":";

		$sDatabase = (isset($_REQUEST['sDatabase'])) ? $_REQUEST['sDatabase'] : "-1";
		$sModule = (isset($_REQUEST['sModule'])) ? $_REQUEST['sModule'] : "";
		$sScope = (isset($_REQUEST['sScope'])) ? $_REQUEST['sScope'] : "";
		$sName = (isset($_REQUEST['sName'])) ? $_REQUEST['sName'] : "";
		
		
	    //***********************//
		//***AlineaSol Premium***//
		//***********************//
		$alternativeDb = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "fillExternalDatabasesArray", null);
		//***********************//
		//***AlineaSol Premium***//
		//***********************//
	    
		$sqlModules = "";
		$allowedModule = array();
		
		$acl_modules = ACLAction::getUserActions($current_user->id);
		
		foreach($acl_modules as $key=>$mod){
			if($mod['module']['access']['aclaccess'] >= 0){
				if ((isset($sugar_config['asolModulesPermissions']['asolAllowedTables'])) || (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']))) {
					//Restrictive
					if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) ) {
						$allowedModule[$key] = false;
					} else if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance'])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance']))) { 
						$allowedModule[$key] = false;	
					} 
					if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) ) {
						if (!isset($allowedModule[$key]))
							$allowedModule[$key] = true;		
					} else if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) && (in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) ) {
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
		
	    $modulesSelect = "<select id='sDatabase' name='sDatabase' style='max-width: 150px;' onChange='if (this.selectedIndex < 1) document.getElementById(\"sModule\").style.visibility = \"inherit\"; else document.getElementById(\"sModule\").style.visibility = \"hidden\";'>";
		$modulesSelect .= "<option value='-1'>".translate('LBL_REPORT_NATIVE_DB', 'asol_Reports')."</option>";
		
		foreach ($alternativeDb as $db_index=>$alternativeDb)
  		$modulesSelect .= ($db_index == $sDatabase) ? "<option value='".$db_index."' selected>".$alternativeDb."</option>" : "<option value='".$db_index."'>".$alternativeDb."</option>";
  			
		$modulesSelect .= "</select>";
		
	    $modulesSelect .= ($sDatabase != "-1") ? "<select id='sModule' style='visibility: hidden'>" : "<select id='sModule' style='visibility: inherit'>";
	    $modulesSelect .= (empty($sModule)) ? "<option value='' selected></option>" : "<option value=''></option>"; 

	    foreach($module as $key=>$mod){
			$modulesSelect .= ($sModule == $key) ? "<option value='".$key."' selected>".$mod."</option>" : "<option value='".$key."'>".$mod."</option>";
		}
		
		$modulesSelect .= "</select>";

		$scopesSelect = "<select id='sScope'>";
		$scopesSelect .= (empty($sScope)) ? "<option value='' selected>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_ALL']."</option>" : "<option value=''>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_ALL']."</option>";
		$scopesSelect .= ($sScope == "public") ? "<option value='public' selected>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_PUBLIC']."</option>" : "<option value='public'>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_PUBLIC']."</option>";
		$scopesSelect .= ($sScope == "private") ? "<option value='private' selected>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_PRIVATE']."</option>" : "<option value='private'>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_PRIVATE']."</option>";
		$scopesSelect .= ($sScope == "role") ? "<option value='role' selected>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_ROLE']."</option>" : "<option value='role'>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE_ROLE']."</option>";
		$scopesSelect .= "</select>";

		
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		//**************************//
		//***Is Domains Installed***//
		//**************************//
	
		$asolAddon = ($isDomainsInstalled) ? "<script type=\"text/javascript\" src=\"modules/asol_Reports/include_basic/js/jquery.js\"></script>" : "";
		
		$asolAddon .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"edit view\"><tbody>
			<tr>
				<td scope='row'>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_NAME'].":</td>
				<td><input type='text' id='sName' value='".$sName."'/></td>
			</tr>
			<tr>
				<td scope='row'>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_MODULE'].":</td>
				<td>".$modulesSelect."</td>
			</tr>
			<tr>
				<td scope='row'>".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SCOPE'].":</td>
				<td>".$scopesSelect."</td>
			</tr>
			<tr>
				<td align='right' colspan='2'><input type='button' onClick='var sDatabase = document.getElementById(\"sDatabase\").value; var sModule = document.getElementById(\"sModule\").value; var sName = document.getElementById(\"sName\").value; var sScope = document.getElementById(\"sScope\").value; $(\"#dlg_mask\").remove(); SUGAR.mySugar.configureDashlet(\"".$this->id."&sDatabase=\"+sDatabase+\"&sModule=\"+sModule+\"&sName=\"+sName+\"&sScope=\"+sScope); return false;' value='".$dashletStrings['ReportChartDashlet']['LBL_REPORT_SEARCH']."'/></td>
			</tr>
		</tbody></table></div>
		";
		
		
        return $asolAddon.parent::displayOptions();
        
    }
    
    public function display() {
    	
    	global $dashletStrings, $current_user, $db;
    	
    	require_once('modules/asol_Reports/include_basic/generateReport.php');
    	require_once('modules/asol_Reports/include_basic/generateReportsFunctions.php');
    	require_once('modules/asol_Reports/include_basic/manageReportsFunctions.php');
		require_once('modules/asol_Reports/include_basic/ReportChart.php');
			
    	$displayReportDashlet = true;
		
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		
		if ($isDomainsInstalled) {
			
			$reportDomainQuery = $db->query("SELECT asol_reports.asol_domain_id as domain_id, asol_domains.name as domain_name FROM asol_reports LEFT JOIN asol_domains ON asol_reports.asol_domain_id=asol_domains.id WHERE asol_reports.id='".$this->which_chart[0]."'");
			$reportDomainRow = $db->fetchByAssoc($reportDomainQuery);
			$displayReportDashlet = ((empty($this->which_chart[0])) || (asol_ReportsGenerationFunctions::manageReportDomain($this->which_chart[0], $current_user->asol_default_domain, $reportDomainRow['domain_id'])));
				
		}
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		
		if ($displayReportDashlet) {
			
			$reportId = (isset($this->which_chart[0])) ? $this->which_chart[0] : null;

			//Instanciamos nuestra clase Report que extiende de SugarBean
			$reportBean = BeanFactory::getBean('asol_Reports', $reportId);
			
			if (!empty($reportId)) {

				$returnedScripts = '';
				$returnedHtml = '';

				if (($_REQUEST['action'] != 'DynamicAction') || (!isset($_SESSION['asolLoadedChartEngineLibrariesDashletId'])) || ($_SESSION['asolLoadedChartEngineLibrariesDashletId'] == $this->id)) {

					if ((!isset($_REQUEST['asolHasLoadedChartEngineLibraries'][$reportBean->report_charts_engine])) || (!$_REQUEST['asolHasLoadedChartEngineLibraries'][$reportBean->report_charts_engine])) {

						$returnedHtml .= asol_ReportsManagementFunctions::getLoadingBlockDiv();
						
						$returnedScripts .= '<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/css/style.css?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'">';
						$returnedScripts .= '<script type="text/javascript" src="modules/asol_Reports/include_basic/js/reports.min.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>';
						$returnedScripts .= '<script type="text/javascript" src="modules/asol_Reports/include_basic/js/jquery.blockUI.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>';
						
						if ($reportBean->report_charts != "Tabl") {
							$chartEngineLibraries = asol_ReportsCharts::getChartEngineLibraries($reportBean->report_charts_engine, true);
							foreach ($chartEngineLibraries as $chartEngineLibrary) {
								$library = explode(";", $chartEngineLibrary);
								if ($library[0] == 'JS')
									$returnedScripts .= '<script type="text/javascript" src="'.$library[1].'"></script>';
								else if ($library[0] == 'CSS')
									$returnedScripts .= '<link rel="stylesheet" type="text/css" href="'.$library[1].'">';
							}
						}
						
						$_REQUEST['asolHasLoadedChartEngineLibraries'][$reportBean->report_charts_engine] = true;
						$_SESSION['asolLoadedChartEngineLibrariesDashletId'] = $this->id;
						
					}
					
				}

				return '<div id="externalHtmlReport'.$this->id.'">
							<img id="loadingGIF'.$this->id.'" src="themes/default/images/img_loading.gif"><span id="loadingTEXT'.$this->id.'">'.$dashletStrings['ReportChartDashlet']['LBL_LOADING_REPORT'].'</span>'
							.displayReport($reportId, '', '', '', true, $this->id, '', false, true).$this->processAutoRefresh().'
						</div>'.$returnedScripts.$returnedHtml;
				
				
			} else {
				
				return '<div align="center"></div>'.$this->processAutoRefresh();
				
			}
			
		} else {
			
			return '<script>
					$(document).ready(function() {
						$("li[id=\'dashlet_'.$this->id.'\']").hide();
					});
				</script>';
			
		}
				
	}
	
}

?>
