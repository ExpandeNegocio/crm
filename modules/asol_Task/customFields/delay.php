<?php 
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $app_list_strings;

$delay = $focus->delay; // The delay-field is a mix of time-dropdown and time_amount-dropdown

$delay_array = explode(' - ', $delay);
$time = (!empty($delay_array[0])) ? $delay_array[0] : 'minutes';
$time = (isset($_REQUEST['time'])) ? $_REQUEST['time'] : $time;
$time_amount = (isset($_REQUEST['time_amount'])) ? $_REQUEST['time_amount']: $delay_array[1];

// time dropdown
$select_time = "<select name='time' id='time' onChange='onChange_time(this);'>";

foreach ($app_list_strings['wfm_delay_time'] as $key => $value) {
	$select_time .= ($time == $key) ? "<option value='{$key}' selected> {$value} </option>" : "<option value='{$key}'> {$value} </option>";
}
$select_time .= "</select>";
echo $select_time;

// time_amount dropdown
$select_time_amount = "<select name='time_amount' id='time_amount'>";

$max = $app_list_strings['wfm_delay_time_amount'][$time];

for ($i=0; $i<$max; $i++) {
	$select_time_amount .= ($i == $time_amount) ? "<option value='{$i}' selected> {$i} </option>" : "<option value='{$i}'> {$i} </option>";
}
$select_time_amount .= "</select>";
echo $select_time_amount;

?>