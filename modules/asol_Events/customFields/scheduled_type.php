<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$scheduled_type = isset($_REQUEST['scheduled_type']) ? $_REQUEST['scheduled_type'] : $focus->scheduled_type;

echo wfm_utils::wfm_generate_field_select('wfm_scheduled_type_list', 'scheduled_type', $scheduled_type, '', '');

?>
