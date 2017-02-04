<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$focus = new asol_Activity();
$focus->retrieve($_REQUEST['record']);

require_once("modules/asol_Task/customFields/delay.php");

?>