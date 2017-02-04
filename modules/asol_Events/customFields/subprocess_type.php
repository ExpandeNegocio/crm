<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$subprocess_type = isset($_REQUEST['subprocess_type']) ? $_REQUEST['subprocess_type'] : $focus->subprocess_type;

echo wfm_utils::wfm_generate_field_select('wfm_subprocess_type_list', 'subprocess_type', $subprocess_type, '', '');

?>
