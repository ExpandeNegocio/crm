<?php 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

$focus = new asol_Process();
$focusId = (isset($_REQUEST['record'])) ? $_REQUEST['record'] : '';

require('alternative_database.generate_select.php');

echo $alternative_database_select;

?>

