<?php 

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

if (wfm_domains_utils::wfm_isDomainsInstalled()) {
	require_once('modules/asol_Process/import_step2.domains.domainsIsInstalled.advanced.php');
}

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);

?>

 