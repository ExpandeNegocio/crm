<?php

/**
 * UpgradeWizardCommon
 *
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004 - 2009 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 */

//////////////////////////////////////////////////////////////////////////////////////////
//// This is a stand alone file that can be run from the command prompt for upgrading a
//// Sugar Instance. Three parameters are required to be defined in order to execute this file.
//// php.exe -f silentUpgrade.php [Path to Upgrade Package zip] [Path to Log file] [Path to Instance]
//// See below the Usage for more details.
/////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
////    UTILITIES THAT MUST BE LOCAL :(

ini_set('memory_limit', '-1');


function logThis2($message, $path) {
	echo $message."\n";
	LogThis($message, $path);
}

function prepSystemForUpgradeSilent() {
    global $subdirs;
    global $cwd;
    global $sugar_config;

    // make sure dirs exist
    foreach($subdirs as $subdir) {
		if(!is_dir(clean_path("{$cwd}/{$sugar_config['upload_dir']}upgrades/{$subdir}"))) {
			mkdir_recursive(clean_path("{$cwd}/{$sugar_config['upload_dir']}upgrades/{$subdir}"));
		}
    }
}


///////////////////////////////////////////////////////////////////////////////
////    UTILITIES THAT MUST BE LOCAL :(

//local function for clearing cache
function clearCacheSU($thedir, $extension) {

    if ($current = @opendir($thedir)) {
        while (false !== ($children = readdir($current))) {
            if ($children != "." && $children != "..") {
                if (is_dir($thedir . "/" . $children)) {
                    clearCacheSU($thedir . "/" . $children, $extension);
                }
                elseif (is_file($thedir . "/" . $children) && substr_count($children, $extension)) {
                    unlink($thedir . "/" . $children);
                }
            }
        }
    }
 }
 //Bug 24890, 24892. default_permissions not written to config.php. Following function checks and if
 //no found then adds default_permissions to the config file.
 function checkConfigForPermissions(){
     if(file_exists(getcwd().'/config.php')){
         require(getcwd().'/config.php');
     }
     global $sugar_config;
     if(!isset($sugar_config['default_permissions'])){
             $sugar_config['default_permissions'] = array (
                     'dir_mode' => 02777,
                     'file_mode' => 0777,
                     'user' => '',
                     'group' => '',
             );
         ksort($sugar_config);
         if(is_writable('config.php') && write_array_to_file("sugar_config", $sugar_config,'config.php')) {
            //writing to the file
        }
     }
}
function checkLoggerSettings(){
    if(file_exists(getcwd().'/config.php')){
         require(getcwd().'/config.php');
     }
    global $sugar_config;
    if(!isset($sugar_config['logger'])){
        $sugar_config['logger'] =array (
            'level'=>'fatal',
            'file' =>
             array (
              'ext' => '.log',
              'name' => 'sugarcrm',
              'dateFormat' => '%c',
              'maxSize' => '10MB',
              'maxLogs' => 10,
              'suffix' => '%m_%Y',
            ),
          );
         ksort($sugar_config);
         if(is_writable('config.php') && write_array_to_file("sugar_config", $sugar_config,'config.php')) {
            //writing to the file
        }
     }
}

function checkLeadConversionSettings() {
    if (file_exists(getcwd().'/config.php')) {
         require(getcwd().'/config.php');
    }
    global $sugar_config;
    if (!isset($sugar_config['lead_conv_activity_opt'])) {
        $sugar_config['lead_conv_activity_opt'] = 'copy';
        ksort($sugar_config);
        if (is_writable('config.php') && write_array_to_file("sugar_config", $sugar_config,'config.php')) {
            //writing to the file
        }
    }
}

function checkResourceSettings(){
    if(file_exists(getcwd().'/config.php')){
         require(getcwd().'/config.php');
     }
    global $sugar_config;
    if(!isset($sugar_config['resource_management'])){
      $sugar_config['resource_management'] =
          array (
            'special_query_limit' => 50000,
            'special_query_modules' =>
            array (
              0 => 'Reports',
              1 => 'Export',
              2 => 'Import',
              3 => 'Administration',
              4 => 'Sync',
            ),
            'default_limit' => 1000,
          );
         ksort($sugar_config);
         if(is_writable('config.php') && write_array_to_file("sugar_config", $sugar_config,'config.php')) {
            //writing to the file
        }
    }
}


//rebuild all relationships...
function rebuildRelations($pre_path = ''){
    $_REQUEST['silent'] = true;
    include($pre_path.'modules/Administration/RebuildRelationship.php');
    $_REQUEST['upgradeWizard'] = true;
    include($pre_path.'modules/ACL/install_actions.php');
}

function createMissingRels(){
    $relForObjects = array('leads'=>'Leads','campaigns'=>'Campaigns','prospects'=>'Prospects');
    foreach($relForObjects as $relObjName=>$relModName){
        //assigned_user
        $guid = create_guid();
        $query = "SELECT id FROM relationships WHERE relationship_name = '{$relObjName}_assigned_user'";
        $result= $GLOBALS['db']->query($query, true);
        $a = null;
        $a = $GLOBALS['db']->fetchByAssoc($result);
        if($GLOBALS['db']->checkError()){
            //log this
        }
        if(!isset($a['id']) && empty($a['id']) ){
            $qRel = "INSERT INTO relationships (id,relationship_name, lhs_module, lhs_table, lhs_key, rhs_module, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs, relationship_type, relationship_role_column, relationship_role_column_value, reverse, deleted)
                        VALUES ('{$guid}', '{$relObjName}_assigned_user','Users','users','id','{$relModName}','{$relObjName}','assigned_user_id',NULL,NULL,NULL,'one-to-many',NULL,NULL,'0','0')";
            $GLOBALS['db']->query($qRel);
            if($GLOBALS['db']->checkError()){
                //log this
            }
        }
        //modified_user
        $guid = create_guid();
        $query = "SELECT id FROM relationships WHERE relationship_name = '{$relObjName}_modified_user'";
        $result= $GLOBALS['db']->query($query, true);
        if($GLOBALS['db']->checkError()){
            //log this
        }
		$guid = create_guid();
		$query = "SELECT id FROM relationships WHERE relationship_name = '{$relObjName}_team'";
		$result= $GLOBALS['db']->query($query, true);
		$a = null;
		$a = $GLOBALS['db']->fetchByAssoc($result);
		if(!isset($a['id']) && empty($a['id']) ){
			   $qRel = "INSERT INTO relationships (id,relationship_name, lhs_module, lhs_table, lhs_key, rhs_module, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs, relationship_type, relationship_role_column, relationship_role_column_value, reverse, deleted)
							VALUES ('{$guid}', '{$relObjName}_team','Teams','teams','id','{$relModName}','{$relObjName}','team_id',NULL,NULL,NULL,'one-to-many',NULL,NULL,'0','0')";
			   $GLOBALS['db']->query($qRel);
		}

        $a = null;
        $a = $GLOBALS['db']->fetchByAssoc($result);
        if(!isset($a['id']) && empty($a['id']) ){
            $qRel = "INSERT INTO relationships (id,relationship_name, lhs_module, lhs_table, lhs_key, rhs_module, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs, relationship_type, relationship_role_column, relationship_role_column_value, reverse, deleted)
                        VALUES ('{$guid}', '{$relObjName}_modified_user','Users','users','id','{$relModName}','{$relObjName}','modified_user_id',NULL,NULL,NULL,'one-to-many',NULL,NULL,'0','0')";
            $GLOBALS['db']->query($qRel);
            if($GLOBALS['db']->checkError()){
                //log this
            }
        }
        //created_by
        $guid = create_guid();
        $query = "SELECT id FROM relationships WHERE relationship_name = '{$relObjName}_created_by'";
        $result= $GLOBALS['db']->query($query, true);
        $a = null;
        $a = $GLOBALS['db']->fetchByAssoc($result);
        if(!isset($a['id']) && empty($a['id']) ){
            $qRel = "INSERT INTO relationships (id,relationship_name, lhs_module, lhs_table, lhs_key, rhs_module, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs, relationship_type, relationship_role_column, relationship_role_column_value, reverse, deleted)
                        VALUES ('{$guid}', '{$relObjName}_created_by','Users','users','id','{$relModName}','{$relObjName}','created_by',NULL,NULL,NULL,'one-to-many',NULL,NULL,'0','0')";
            $GLOBALS['db']->query($qRel);
            if($GLOBALS['db']->checkError()){
                //log this
            }
        }

    }
    //Also add tracker perf relationship
	$guid = create_guid();
	$query = "SELECT id FROM relationships WHERE relationship_name = 'tracker_monitor_id'";
	$result= $GLOBALS['db']->query($query, true);
	$a = null;
	$a = $GLOBALS['db']->fetchByAssoc($result);
	if(!isset($a['id']) && empty($a['id']) ){
		   $qRel = "INSERT INTO relationships (id,relationship_name, lhs_module, lhs_table, lhs_key, rhs_module, rhs_table, rhs_key, join_table, join_key_lhs, join_key_rhs, relationship_type, relationship_role_column, relationship_role_column_value, reverse, deleted)
						   VALUES ('{$guid}', 'tracker_monitor_id','TrackerPerfs','tracker_perf','monitor_id','Trackers','tracker','monitor_id',NULL,NULL,NULL,'one-to-many',NULL,NULL,'0','0')";
		   $GLOBALS['db']->query($qRel);
	}


}

/**
 * This function will merge password default settings into config file
 * @param   $sugar_config
 * @param   $sugar_version
 * @return  bool true if successful
 */
function merge_passwordsetting($sugar_config, $sugar_version) {
    $passwordsetting_defaults = array(
    'passwordsetting' => array (
		'minpwdlength' => '',
		'maxpwdlength' => '',
		'oneupper' => '',
		'onelower' => '',
		'onenumber' => '',
		'onespecial' => '',
        'SystemGeneratedPasswordON' => '',
        'generatepasswordtmpl' => '',
        'lostpasswordtmpl' => '',
		'customregex' => '',
		'regexcomment' => '',
        'forgotpasswordON' => false,
        'linkexpiration' => '1',
        'linkexpirationtime' => '30',
        'linkexpirationtype' => '1',
		'userexpiration' => '0',
		'userexpirationtime' => '',
		'userexpirationtype' => '1',
		'userexpirationlogin' => '',
        'systexpiration' => '0',
        'systexpirationtime' => '',
        'systexpirationtype' => '0',
        'systexpirationlogin' => '',
		'lockoutexpiration' => '0',
		'lockoutexpirationtime' => '',
		'lockoutexpirationtype' => '1',
		'lockoutexpirationlogin' => '',
        ) ,
    );


    $sugar_config = sugarArrayMerge($passwordsetting_defaults, $sugar_config );

    // need to override version with default no matter what
    $sugar_config['sugar_version'] = $sugar_version;

    ksort( $sugar_config );
    if( write_array_to_file( "sugar_config", $sugar_config, "config.php" ) ){
        return true;
    }
    else {
        return false;
    }
}


function addDefaultModuleRoles($defaultRoles = array()) {
    foreach($defaultRoles as $roleName=>$role){
        foreach($role as $category=>$actions){
            foreach($actions as $name=>$access_override){
                    $query = "SELECT * FROM acl_actions WHERE name='$name' AND category = '$category' AND acltype='$roleName' AND deleted=0 ";
                    $result = $GLOBALS['db']->query($query);
                    //only add if an action with that name and category don't exist
                    $row=$GLOBALS['db']->fetchByAssoc($result);
                    if ($row == null) {
                        $guid = create_guid();
						$currdate = gmdate('Y-m-d H:i:s');
                        $query= "INSERT INTO acl_actions (id,date_entered,date_modified,modified_user_id,name,category,acltype,aclaccess,deleted ) VALUES ('$guid','$currdate','$currdate','1','$name','$category','$roleName','$access_override','0')";
                        $GLOBALS['db']->query($query);
                        if($GLOBALS['db']->checkError()){
                            //log this
                        }
                    }
            }
        }
    }
}

function verifyArguments($argv,$usage_dce,$usage_regular){
}


// only run from command line
if(isset($_SERVER['HTTP_USER_AGENT'])) {
    echo 'This utility may only be run from the command line or command prompt.';
	exit(1);
}
//Clean_string cleans out any file  passed in as a parameter
$_SERVER['PHP_SELF'] = 'silentUpgrade.php';

///////////////////////////////////////////////////////////////////////////////
////    STANDARD REQUIRED SUGAR INCLUDES AND PRESETS
if(!defined('sugarEntry')) define('sugarEntry', true);

$_SESSION = array();
$_SESSION['schema_change'] = 'sugar'; // we force-run all SQL
$_SESSION['silent_upgrade'] = true;
$_SESSION['step'] = 'silent'; // flag to NOT try redirect to 4.5.x upgrade wizard

$_REQUEST = array();
$_REQUEST['addTaskReminder'] = 'remind';

define('SUGARCRM_INSTALL', 'SugarCRM_Install');
define('DCE_INSTANCE', 'DCE_Instance');

global $cwd;
$cwd = getcwd(); // default to current, assumed to be in a valid SugarCRM root dir.

global $path;
$path = $aps_upgrade_log; // custom log file, if blank will use ./upgradeWizard.log

$_SESSION['zip_from_dir'] = $zip_from_dir;

//$_REQUEST['zip_from_dir'] = $zip_from_dir;
$subdirs        = array('full', 'langpack', 'module', 'patch', 'theme', 'temp');

define('SUGARCRM_PRE_INSTALL_FILE', 'scripts/pre_install.php');
define('SUGARCRM_POST_INSTALL_FILE', 'scripts/post_install.php');
define('SUGARCRM_PRE_UNINSTALL_FILE', 'scripts/pre_uninstall.php');
define('SUGARCRM_POST_UNINSTALL_FILE', 'scripts/post_uninstall.php');

$sugar_scripts = 'SugarCE-upgrade';
$unzip_dir = $sugar_scripts;
$_SESSION['unzip_dir'] = $sugar_scripts;
$instanceUpgradePath = $cwd;

echo "\n";
echo "********************************************************************\n";
echo "***************This Upgrade process may take sometime***************\n";
echo "********************************************************************\n";
echo "\n";

global $sugar_config;
$isDCEInstance = false;
$errors = array();
{
    //ini_set('error_reporting',1);
    require_once('include/entryPoint.php');
    require_once('include/SugarLogger/SugarLogger.php');
    require_once('include/dir_inc.php');
    require_once('include/utils/zip_utils.php');
    require_once('modules/Administration/UpgradeHistory.php');
    require_once('include/utils.php');
    require_once('modules/Users/User.php');
    require('config.php');

if(!function_exists('sugar_cached'))
{
    /**
     * sugar_cached
     *
     * @param $file The path to retrieve cache lookup information for
     * @return string The cached path according to $GLOBALS['sugar_config']['cache_dir'] or just appended with cache if not defined
     */
    function sugar_cached($file)
    {
        static $cdir = null;
        if(empty($cdir) && !empty($GLOBALS['sugar_config']['cache_dir'])) {
            $cdir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        }
        if(empty($cdir)) {
            $cdir = "cache";
        }
        return "$cdir/$file";
    }
}
    // APS: config was recreated already. Hack version info for possible future use.
    aps_set_source_version();

	$zipBasePath = clean_path("{$cwd}/{$sugar_config['upload_dir']}upgrades/temp/$old_files");
	mkdir_recursive($zipBasePath);
	if (! file_exists("$sugar_scripts/${old_files}.zip")) {
		echo "File $sugar_scripts/${old_files}.zip is not found!";
		exit(1);
	}
	unzip("$sugar_scripts/${old_files}.zip", $zipBasePath);

	$_SESSION['sugar_version_file'] = clean_path($unzip_dir . '/sugar_version.php');
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $path           = $aps_upgrade_log; // custom log file, if blank will use ./upgradeWizard.log

	$db = & DBManagerFactory :: getInstance();
    $UWstrings      = return_module_language('en_us', 'UpgradeWizard');
    $adminStrings   = return_module_language('en_us', 'Administration');
    $mod_strings    = array_merge($adminStrings, $UWstrings);

	$license_accepted = true;

    //////////////////////////////////////////////////////////////////////////////
    //Adding admin user to the silent upgrade
	if (isset ($aps_upgrade_admin)) {
	   $user_name = $aps_upgrade_admin;
       $q = "select id from users where user_name = '" . $user_name . "' and is_admin=1";
       $result = $GLOBALS['db']->query($q, false);
       $logged_user = $GLOBALS['db']->fetchByAssoc($result);
       if(isset($logged_user['id']) && $logged_user['id'] != null){
        //do nothing
        $current_user->retrieve($logged_user['id']);
       }
       else{
        echo "Not an admin user in users table. Please provide an admin user\n";
		exit(1);
       }
    }
    else {
        echo "*******************************************************************************\n";
        echo "*** ERROR: 4th parameter must be a valid admin user.\n";
        echo $usage;
        echo "FAILURE\n";
		exit(1);
    }
	/////retrieve admin user
    global $sugar_config;
    $configOptions = $sugar_config['dbconfig'];

///////////////////////////////////////////////////////////////////////////////
////    UPGRADE PREP
prepSystemForUpgradeSilent();
//repair tabledictionary.ext.php file if needed
repairTableDictionaryExtFile();
///////////////////////////////////////////////////////////////////////////////
////    UPGRADE UPGRADEWIZARD

require_once('modules/UpgradeWizard/uw_utils.php'); // must upgrade UW first
removeSilentUpgradeVarsCache(); // Clear the silent upgrade vars - Note: Any calls to these functions within this file are removed here
logThis2("*** SILENT UPGRADE INITIATED.", $path);
logThis2("*** UpgradeWizard Upgraded  ", $path);

if(function_exists('set_upgrade_vars')){
    set_upgrade_vars();
}
$sugar_scripts = 'SugarCE-upgrade';
$manifest_file = "{$cwd}/${sugar_scripts}/manifest-${sugar_version}.php";

if($configOptions['db_type'] == 'mysql'){
    //Change the db wait_timeout for this session
    $que ="select @@wait_timeout";
    $result = $db->query($que);
    $tb = $db->fetchByAssoc($result);
    logThis2('Wait Timeout before change ***** '.$tb['@@wait_timeout'] , $path);
    $query ="set wait_timeout=28800";
    $db->query($query);
    $result = $db->query($que);
    $ta = $db->fetchByAssoc($result);
    logThis2('Wait Timeout after change ***** '.$ta['@@wait_timeout'] , $path);
}

////    END UPGRADE UPGRADEWIZARD
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
////    MAKE SURE PATCH IS COMPATIBLE
if(is_file($manifest_file)) {
    // provides $manifest array
    include("$manifest_file");
    if(!isset($manifest)) {
        echo "\nThe patch did not contain a proper manifest.php file.  Cannot continue.\n\n";
		exit(1);
    } else {
		mkdir_recursive("{$cwd}/{$sugar_config['upload_dir']}upgrades/patch");
        copy("$manifest_file", "{$cwd}/{$sugar_config['upload_dir']}upgrades/patch/{$zip_from_dir}-manifest.php");
		$error = '';
    }
} else {
    echo "\nThe patch did not contain a proper manifest.php file.  Cannot continue.\n\n";
	exit(1);
}

$ce_to_pro_ent = isset($manifest['name']) && ($manifest['name'] == 'SugarCE to SugarPro' || $manifest['name'] == 'SugarCE to SugarEnt');

global $sugar_config;
global $sugar_version;
global $sugar_flavor;

////    END MAKE SURE PATCH IS COMPATIBLE
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
////    RUN SILENT UPGRADE
ob_start();
set_time_limit(0);
if(file_exists('ModuleInstall/PackageManager/PackageManagerDisplay.php')) {
    require_once('ModuleInstall/PackageManager/PackageManagerDisplay.php');
}

    $parserFiles = array();

//If version less than 500 then look for modules to be upgraded
if(function_exists('set_upgrade_vars')){
    set_upgrade_vars();
}
//Initialize the session variables. If upgrade_progress.php is already created
//look for session vars there and restore them
if(function_exists('initialize_session_vars')){
    initialize_session_vars();
}

//if(!didThisStepRunBefore('preflight')){
    set_upgrade_progress('preflight','in_progress');
    //Quickcreatedefs on the basis of editviewdefs
    if(substr($sugar_version,0,1) >= 5){
        updateQuickCreateDefs();
    }
    set_upgrade_progress('preflight','done');
//}
////////////////COMMIT PROCESS BEGINS///////////////////////////////////////////////////////////////
////    MAKE BACKUPS OF TARGET FILES

//if(!didThisStepRunBefore('commit')){
    set_upgrade_progress('commit','in_progress','commit','in_progress');

    //Need to make sure we have the matching copy of SetValueAction for static/instance method matching
    if(file_exists("include/Expressions/Actions/SetValueAction.php")){
        require_once("include/Expressions/Actions/SetValueAction.php");
    }

    ///////////////////////////////////////////////////////////////////////////////
    ////    HANDLE PREINSTALL SCRIPTS
    if(empty($errors)) {
        $file = "{$sugar_scripts}/".constant('SUGARCRM_PRE_INSTALL_FILE');

        if(is_file($file)) {
            include($file);
            if(!didThisStepRunBefore('commit','pre_install')){
                set_upgrade_progress('commit','in_progress','pre_install','in_progress');
                pre_install();
                set_upgrade_progress('commit','in_progress','pre_install','done');
            }
        }
    }

    //Clean smarty from cache
    $cachedir = sugar_cached('smarty');
    if(is_dir($cachedir)){
        $allModFiles = array();
        $allModFiles = findAllFiles($cachedir,$allModFiles);
       foreach($allModFiles as $file){
            //$file_md5_ref = str_replace(clean_path(getcwd()),'',$file);
            if(file_exists($file)){
                unlink($file);
            }
       }
    }

  //Also add the three-way merge here. The idea is after the 451 html files have
  //been converted run the 3-way merge. If 500 then just run the 3-way merge
  if(file_exists('modules/UpgradeWizard/SugarMerge/SugarMerge.php')){
     set_upgrade_progress('end','in_progress','threewaymerge','in_progress');
     require_once('modules/UpgradeWizard/SugarMerge/SugarMerge.php');
     $merger = new SugarMerge(".", $zipBasePath);
     $merger->mergeAll();
     set_upgrade_progress('end','in_progress','threewaymerge','done');
  }
  require_once(clean_path($unzip_dir.'/scripts/upgrade_utils.php'));
  $new_sugar_version = getUpgradeVersion();
  $origVersion = substr(preg_replace("/[^0-9]/", "", $sugar_version),0,3);
  $destVersion = substr(preg_replace("/[^0-9]/", "", $new_sugar_version),0,3);
  $siv_varset_1 = setSilentUpgradeVar('origVersion', $origVersion);
  $siv_varset_2 = setSilentUpgradeVar('destVersion', $destVersion);
  $siv_write    = writeSilentUpgradeVars();
  if(!$siv_varset_1 || !$siv_varset_2 || !$siv_write){
	LogThis("Error with silent upgrade variables: origVersion write success is ({$siv_varset_1}) ".
				   "-- destVersion write success is ({$siv_varset_2}) -- ".
				   "writeSilentUpgradeVars success is ({$siv_write}) -- ".
				   "path to cache dir is ({$GLOBALS['sugar_config']['cache_dir']})", $path);
  }
  require_once('modules/DynamicFields/templates/Fields/TemplateText.php');

    ///////////////////////////////////////////////////////////////////////////////
    ///    RELOAD NEW DEFINITIONS
    global $ACLActions, $beanList, $beanFiles;
    include('modules/ACLActions/actiondefs.php');
    include('include/modules.php'); 
    /////////////////////////////////////////////


    if (!function_exists("inDeveloperMode")) {
        //this function was introduced from tokyo in the file include/utils.php, so when upgrading from 5.1x and 5.2x we should declare the this function
        function inDeveloperMode()
        {
            return isset($GLOBALS['sugar_config']['developerMode']) && $GLOBALS['sugar_config']['developerMode'];
        }
    }

    ///////////////////////////////////////////////////////////////////////////////
    ////    HANDLE POSTINSTALL SCRIPTS
    if(empty($errors)) {
        // APS:
        aps_set_source_version();

        logThis2('Starting post_install()...', $path);
        
		$trackerManager = TrackerManager::getInstance();   
		$trackerManager->pause();
		$trackerManager->unsetMonitors();
        
        if(!didThisStepRunBefore('commit','post_install')){
            $file = "$sugar_scripts/" . constant('SUGARCRM_POST_INSTALL_FILE');
            if(is_file($file)) {
                //set_upgrade_progress('commit','in_progress','post_install','in_progress');
                $progArray['post_install']='in_progress';
                post_install_progress($progArray,'set');
                global $moduleList;
                if($origVersion < '551' && !in_array('Feeds', $moduleList))
                {
                     $moduleList[] = 'Feeds';
                }
                    include($file);
                    post_install();
                // cn: only run conversion if admin selects "Sugar runs SQL"
                if(!empty($_SESSION['allTables']) && $_SESSION['schema_change'] == 'sugar')
                    executeConvertTablesSql($_SESSION['allTables']);
                //set process to done
                $progArray['post_install']='done';
                //set_upgrade_progress('commit','in_progress','post_install','done');
                post_install_progress($progArray,'set');
            }
        }
        //clean vardefs
        logThis2('Performing UWrebuild()...', $path);
        ob_start();
            @UWrebuild();
        ob_end_clean();
        logThis2('UWrebuild() done.', $path);

        logThis2('begin check default permissions .', $path);
            checkConfigForPermissions();
        logThis2('end check default permissions .', $path);

        logThis2('begin check logger settings .', $path);
            checkLoggerSettings();
        logThis2('begin check logger settings .', $path);

        LogThis('begin check lead conversion settings .', $path);
            checkLeadConversionSettings();
        LogThis('end check lead conversion settings .', $path);

        logThis2('begin check resource settings .', $path);
            checkResourceSettings();
        logThis2('begin check resource settings .', $path);

        require("sugar_version.php");
        require('config.php');
        global $sugar_config;

        if($origVersion < '550' && $sugar_config['dbconfig']['db_type'] == 'mssql' && !is_freetds()){
               convertImageToText('import_maps', 'content');
               convertImageToText('import_maps', 'default_values');
        }

        /*
        if($origVersion < '550'){
            LogThis("Upgrading multienum data", $path);
            require_once("$unzip_dir/scripts/upgrade_multienum_data.php");
            upgrade_multienum_data();
        }
        if($origVersion < '550' && $sugar_config['dbconfig']['db_type'] == 'mssql') {
            dropColumnConstraintForMSSQL("outbound_email", "mail_smtpssl");
            $GLOBALS['db']->query("ALTER TABLE outbound_email alter column mail_smtpssl int NULL");
        } // if
        */

        if($ce_to_pro_ent || $origVersion < '550'){
             if(!merge_passwordsetting($sugar_config, $sugar_version)) {
                      LogThis('*** ERROR: could not write config.php! - upgrade will fail!', $path);
                      $errors[] = 'Could not write config.php!';
             }
        }


        LogThis('Set default_max_tabs to 7', $path);
        $sugar_config['default_max_tabs'] = '7';

	   if( !write_array_to_file( "sugar_config", $sugar_config, "config.php" ) ) {
			LogThis('*** ERROR: could not write config.php! - upgrade will fail!', $path);
			$errors[] = 'Could not write config.php!';
		}

	   LogThis('Upgrade the sugar_version', $path);
		$sugar_config['sugar_version'] = $sugar_version;
        if($destVersion == $origVersion)
        {
            require('config.php');
		}
		if( !write_array_to_file( "sugar_config", $sugar_config, "config.php" ) ) {
			LogThis('*** ERROR: could not write config.php! - upgrade will fail!', $path);
			$errors[] = 'Could not write config.php!';
		}
		checkConfigForPermissions();
    }

    ///////////////////////////////////////////////////////////////////////////////
    ////    REGISTER UPGRADE
    if(empty($errors)) {
        logThis2('Registering upgrade with UpgradeHistory', $path);
        if(!didThisStepRunBefore('commit','upgradeHistory')){
            set_upgrade_progress('commit','in_progress','upgradeHistory','in_progress');
            $file_action = "copied";
            // if error was encountered, script should have died before now
            $new_upgrade = new UpgradeHistory();
            $new_upgrade->name = $zip_from_dir;
            $new_upgrade->description = $manifest['description'];
            $new_upgrade->type = 'patch';
            $new_upgrade->version = $sugar_version;
            $new_upgrade->status = "installed";
            $new_upgrade->manifest = (!empty($_SESSION['install_manifest']) ? $_SESSION['install_manifest'] : '');

            if($new_upgrade->description == null){
                $new_upgrade->description = "Silent Upgrade was used to upgrade the instance";
            }
            else{
                $new_upgrade->description = $new_upgrade->description." Silent Upgrade was used to upgrade the instance.";
            }
           $new_upgrade->save();
           set_upgrade_progress('commit','in_progress','upgradeHistory','done');
           set_upgrade_progress('commit','done','commit','done');
        }
      }

    //Clean modules from cache
       $cachedir = sugar_cached('smarty');
       if(is_dir($cachedir)){
            $allModFiles = array();
			$allModFiles = findAllFiles($cachedir,$allModFiles);
			  foreach($allModFiles as $file){
				   //$file_md5_ref = str_replace(clean_path(getcwd()),'',$file);
				   if(file_exists($file)){
								   unlink($file);
				   }
			  }
	   }

	   //delete cache/themes
	   $cachedir = sugar_cached('themes');
	   if(is_dir($cachedir)){
		   $allModFiles = array();
		   $allModFiles = findAllFiles($cachedir,$allModFiles);

           foreach($allModFiles as $file){
                //$file_md5_ref = str_replace(clean_path(getcwd()),'',$file);
                if(file_exists($file)){
                    unlink($file);
                }
           }
        }
   //delete cache/modules before rebuilding the relations
    //Clean modules from cache
        $cachedir = sugar_cached('modules');
        if(is_dir($cachedir)){
            $allModFiles = array();
            $allModFiles = findAllFiles($cachedir,$allModFiles);
           foreach($allModFiles as $file){
                //$file_md5_ref = str_replace(clean_path(getcwd()),'',$file);
                if(file_exists($file)){
                    unlink($file);
                }
           }
        }
    ob_start();
    if(!isset($_REQUEST['silent'])){
        $_REQUEST['silent'] = true;
    }
    else if(isset($_REQUEST['silent']) && $_REQUEST['silent'] != true){
        $_REQUEST['silent'] = true;
    }
    if($origVersion < '550')
    {
       include("install/seed_data/Advanced_Password_SeedData.php");
    }
    logThis2('Start rebuild relationships.', $path);
        @rebuildRelations();
    logThis2('End rebuild relationships.', $path);
     //logThis2('Checking for leads_assigned_user relationship and if not found then create.', $path);
        @createMissingRels();
     //logThis2('Checked for leads_assigned_user relationship.', $path);
    ob_end_clean();
    //// run fix on dropdown lists that may have been incorrectly named
    fix_dropdown_list();
//}

set_upgrade_progress('end','in_progress','end','in_progress');
/////////////////////////Old Logger settings///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

if(function_exists('deleteCache')){
    set_upgrade_progress('end','in_progress','deleteCache','in_progress');
    @deleteCache();
    set_upgrade_progress('end','in_progress','deleteCache','done');
}

///////////////////////////////////////////////////////////////////////////////
////    HANDLE REMINDERS
if(file_exists(clean_path(getcwd()).'/original451files')){
    rmdir_recursive(clean_path(getcwd()).'/original451files');
}

require_once('modules/Administration/Administration.php');
$admin = new Administration();
$admin->saveSetting('system','adminwizard',1);


}


set_upgrade_progress('end','done','end','done');
///////////////////////////////////////////////////////////////////////////////
////    RECORD ERRORS
$phpErrors = ob_get_contents();
ob_end_clean();
logThis2("**** Potential PHP generated error messages: {$phpErrors}", $path);

if(count($errors) > 0) {
    foreach($errors as $error) {
        logThis2("****** SilentUpgrade ERROR: {$error}", $path);
    }
    echo "FAILED\n";
} else {
    logThis2("***** SilentUpgrade step1 completed successfully.", $path);
}

#################################################################################
# Silent Upgrade STEP 2

global $ACLActions, $beanList, $beanFiles;

require_once('modules/Trackers/TrackerManager.php');
$trackerManager = TrackerManager::getInstance();
$trackerManager->pause();
$trackerManager->unsetMonitors();

require_once('modules/Administration/upgrade_custom_relationships.php');
upgrade_custom_relationships();

LogThis('Upgrading user preferences start .', $path);
if(function_exists('upgradeUserPreferences')){
   upgradeUserPreferences();
}
LogThis('Upgrading user preferences finish .', $path);

// clear out the theme cache
if(is_dir($GLOBALS['sugar_config']['cache_dir'].'themes')){
    $allModFiles = array();
    $allModFiles = findAllFiles($GLOBALS['sugar_config']['cache_dir'].'themes',$allModFiles);
    foreach($allModFiles as $file){
        //$file_md5_ref = str_replace(clean_path(getcwd()),'',$file);
        if(file_exists($file)){
            unlink($file);
        }
    }
}

// re-minify the JS source files
$_REQUEST['root_directory'] = getcwd();
$_REQUEST['js_rebuild_concat'] = 'rebuild';
require_once('jssource/minify.php');

//Add the cache cleaning here.
if(function_exists('deleteCache'))
{
        LogThis('Call deleteCache', $path);
        @deleteCache();
}
//Use Repair and rebuild to update the database.
global $dictionary;
require_once("modules/Administration/QuickRepairAndRebuild.php");
$rac = new RepairAndClear();
$rac->clearVardefs();
$rac->rebuildExtensions();
//bug: 44431 - defensive check to ensure the method exists since upgrades to 6.2.0 may not have this method define yet.
if(method_exists($rac, 'clearExternalAPICache'))
{
    $rac->clearExternalAPICache();
}

$repairedTables = array();
foreach ($beanFiles as $bean => $file) {
        if(file_exists($file)){
                unset($GLOBALS['dictionary'][$bean]);
                require_once($file);
                $focus = new $bean ();
                if(empty($focus->table_name) || isset($repairedTables[$focus->table_name])) {
                   continue;
                }

                if (($focus instanceOf SugarBean)) {
                        if(!isset($repairedTables[$focus->table_name]))
                        {
                                $sql = $GLOBALS['db']->repairTable($focus, true);
                if(trim($sql) != '')
                {
                                    LogThis('Running sql:' . $sql, $path);
                }
                                $repairedTables[$focus->table_name] = true;
                        }

                        //Check to see if we need to create the audit table
                    if($focus->is_AuditEnabled() && !$focus->db->tableExists($focus->get_audit_table_name())){
               LogThis('Creating audit table:' . $focus->get_audit_table_name(), $path);
                       $focus->create_audit_table();
            }
                }
        }
}

unset ($dictionary);
include ("modules/TableDictionary.php");
foreach ($dictionary as $meta) {
        $tablename = $meta['table'];

        if(isset($repairedTables[$tablename])) {
           continue;
        }

        $fielddefs = $meta['fields'];
        $indices = $meta['indices'];
        $sql = $GLOBALS['db']->repairTableParams($tablename, $fielddefs, $indices, true);
        if(!empty($sql)) {
            LogThis($sql, $path);
            $repairedTables[$tablename] = true;
        }
}

LogThis('database repaired', $path);

LogThis('Start rebuild relationships.', $path);
@rebuildRelations();
LogThis('End rebuild relationships.', $path);

include("$unzip_dir/manifest.php");
$ce_to_pro_ent = isset($manifest['name']) && ($manifest['name'] == 'SugarCE to SugarPro' || $manifest['name'] == 'SugarCE to SugarEnt' || $manifest['name'] == 'SugarCE to SugarCorp' || $manifest['name'] == 'SugarCE to SugarUlt');
$origVersion = getSilentUpgradeVar('origVersion');
if(!$origVersion){
    global $silent_upgrade_vars_loaded;
    LogThis("Error retrieving silent upgrade var for origVersion: cache dir is {$GLOBALS['sugar_config']['cache_dir']} -- full cache for \$silent_upgrade_v
ars_loaded is ".var_export($silent_upgrade_vars_loaded, true), $path);
}

//bug: 37214 - merge config_si.php settings if available
LogThis('Begin merge_config_si_settings', $path);
merge_config_si_settings(true, '', '', $path);
LogThis('End merge_config_si_settings', $path);

//Upgrade connectors
LogThis('Begin upgrade_connectors', $path);
upgrade_connectors();
LogThis('End upgrade_connectors', $path);

// Enable the InsideView connector by default
if($origVersion < '621' && function_exists('upgradeEnableInsideViewConnector')) {
    LogThis("Looks like we need to enable the InsideView connector\n",$path);
    upgradeEnableInsideViewConnector($path);
}


//bug: 36845 - ability to provide global search support for custom modules
/*
*/

//Upgrade system displayed tabs and subpanels
if(function_exists('upgradeDisplayedTabsAndSubpanels'))
{
        upgradeDisplayedTabsAndSubpanels($origVersion);
}

if(function_exists('rebuildSprites') && function_exists('imagecreatetruecolor'))
{
    rebuildSprites(true);
}

//Run RepairSearchFields.php file
if($origVersion < '620' && function_exists('repairSearchFields'))
{
    repairSearchFields($path);
}

///////////////////////////////////////////////////////////////////////////////
////    TAKE OUT TRASH
if(empty($errors)) {
        set_upgrade_progress('end','in_progress','unlinkingfiles','in_progress');
        LogThis('Taking out the trash, unlinking temp files.', $path);
        unlinkUWTempFiles();
        removeSilentUpgradeVarsCache();
        LogThis('Taking out the trash, done.', $path);
}

///////////////////////////////////////////////////////////////////////////////
////    RECORD ERRORS

$phpErrors = ob_get_contents();
ob_end_clean();
LogThis("**** Potential PHP generated error messages: {$phpErrors}", $path);

if(count($errors) > 0) {
        foreach($errors as $error) {
                LogThis("****** SilentUpgrade ERROR: {$error}", $path);
        }
        echo "FAILED\n";
} else {
        LogThis("***** SilentUpgrade completed successfully.", $path);
        echo "********************************************************************\n";
        echo "*************************** SUCCESS*********************************\n";
        echo "********************************************************************\n";
        echo "******** If your pre-upgrade Leads data is not showing  ************\n";
        echo "******** Or you see errors in detailview subpanels  ****************\n";
        echo "************* In order to resolve them  ****************************\n";
        echo "******** Log into application as Administrator  ********************\n";
        echo "******** Go to Admin panel  ****************************************\n";
        echo "******** Run Repair -> Rebuild Relationships  **********************\n";
        echo "********************************************************************\n";
}


/**
 * repairTableDictionaryExtFile
 *
 * There were some scenarios in 6.0.x whereby the files loaded in the extension tabledictionary.ext.php file
 * did not exist.  This would cause warnings to appear during the upgrade.  As a result, this
 * function scans the contents of tabledictionary.ext.php and then remove entries where the file does exist.
 */
function repairTableDictionaryExtFile()
{
        $tableDictionaryExtDirs = array('custom/Extension/application/Ext/TableDictionary', 'custom/application/Ext/TableDictionary');

        foreach($tableDictionaryExtDirs as $tableDictionaryExt)
        {

                if(is_dir($tableDictionaryExt) && is_writable($tableDictionaryExt)){
                        $dir = dir($tableDictionaryExt);
                        while(($entry = $dir->read()) !== false)
                        {
                                $entry = $tableDictionaryExt . '/' . $entry;
                                if(is_file($entry) && preg_match('/\.php$/i', $entry) && is_writeable($entry))
                                {

                                                if(function_exists('sugar_fopen'))
                                                {
                                                        $fp = @sugar_fopen($entry, 'r');
                                                } else {
                                                        $fp = fopen($entry, 'r');
                                                }


                                            if($fp)
                                        {
                                             $altered = false;
                                             $contents = '';

                                             while($line = fgets($fp))
                                                     {
                                                        if(preg_match('/\s*include\s*\(\s*[\'|\"](.*?)[\"|\']\s*\)\s*;/', $line, $match))
                                                        {
                                                           if(!file_exists($match[1]))
                                                           {
                                                              $altered = true;
                                                           } else {
                                                                  $contents .= $line;
                                                           }
                                                        } else {
                                                           $contents .= $line;
                                                        }
                                                     }

                                                     fclose($fp);
                                        }


                                            if($altered)
                                            {
                                                        if(function_exists('sugar_fopen'))
                                                        {
                                                                $fp = @sugar_fopen($entry, 'w');
                                                        } else {
                                                                $fp = fopen($entry, 'w');
                                                        }

                                                        if($fp && fwrite($fp, $contents))
                                                        {
                                                                fclose($fp);
                                                        }
                                            }
                                } //if
                        } //while
                } //if
        }
}


?>
