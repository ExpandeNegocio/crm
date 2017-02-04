<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : $focus->type;

echo wfm_utils::wfm_generate_field_select('wfm_activity_type_list', 'type', $type, '', '');

?>
