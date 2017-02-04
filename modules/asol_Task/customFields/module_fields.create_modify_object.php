<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $db, $beanList, $beanFiles, $mod_strings, $timedate, $sugar_config;

// Whether translate or not variable for all this php-file
$translateFieldLabels = ((!isset($sugar_config['WFM_TranslateLabels'])) || ($sugar_config['WFM_TranslateLabels'])) ? true : false;

$rhs_key = (isset($_REQUEST['rhs_key'])) ? $_REQUEST['rhs_key'] : "";

// Get fields
if (($sel_altDb >= 0) && ($sel_altDbTable != '')) {

	wfm_utils::wfm_log('debug', '$sel_altDb=['.var_export($sel_altDb, true).']', __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', '$sel_altDbTable=['.var_export($sel_altDbTable, true).']', __FILE__, __METHOD__, __LINE__);
	//$currentTableFields = wfm_reports_utils::getExternalTableFields($focus, $sel_altDb, $sel_altDbTable, $rhs_key);
	$currentTableFields = null;

} else if (($objectModule != '')) {

	$class_name = $beanList[$objectModule];
	require_once($beanFiles[$class_name]);
	$bean = new $class_name();

	$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();
	$fieldsToBeRemoved = wfm_reports_utils::getNonVisibleFields($objectModule, $isDomainsInstalled, false);

	$currentTableFields = wfm_reports_utils::getCrmTableFields($bean, $objectModule, $fieldsToBeRemoved, $translateFieldLabels, $rhs_key, false);
}
wfm_utils::wfm_log('debug', '$currentTableFields=['.var_export($currentTableFields, true).']', __FILE__, __METHOD__, __LINE__);

$fields = (isset($currentTableFields['fields'])) ? $currentTableFields['fields'] : null;
$fields_labels = (isset($currentTableFields['fields_labels'])) ? $currentTableFields['fields_labels'] : null;
$fields_type = (isset($currentTableFields['fields_type'])) ? $currentTableFields['fields_type'] : null;

$fields_enum_operators = (isset($currentTableFields['fields_enum_operators'])) ? $currentTableFields['fields_enum_operators'] : null;
$fields_enum_references = (isset($currentTableFields['fields_enum_references'])) ? $currentTableFields['fields_enum_references'] : null;

$fields_labels_key = (isset($currentTableFields['fields_labels_key'])) ? $currentTableFields['fields_labels_key'] : null;
$is_required = (isset($currentTableFields['is_required'])) ? $currentTableFields['is_required'] : null;

$relate_modules = (isset($currentTableFields['related_modules'])) ? $currentTableFields['related_modules'] : null;

// Order module List for regular fields
$fields_labels_lowercase = array_map('strtolower', (!empty($fields_labels) ? $fields_labels : array() ));
if (!empty($fields_labels_lowercase)) {
	array_multisort($fields_labels_lowercase, $fields_labels, $fields_labels_key, $fields, $fields_type, $fields_enum_operators, $fields_enum_references, $relate_modules, $is_required);
}

// Generate fieldsSelect
$fieldsSelect = wfm_utils::wfm_generate_moduleFields_selectFields_isrequired($fields, $rhs_key, $is_required, $fields_labels, $fields_labels_key, 'multiple');

// Build strings in order to pass the info to javascript
if (count($fields_labels) != 0) {
	$fields_labels_imploded = implode('${pipe}', $fields_labels);
}
if (count($fields_type) != 0) {
	$fields_type_imploded = implode('${comma}', $fields_type);
}
if (count($fields_enum_operators) != 0) {
	$fields_enum_operators_imploded = implode('${comma}', $fields_enum_operators);
}
if (count($fields_enum_references) != 0) {
	$fields_enum_references_imploded = implode('${comma}', $fields_enum_references);
}
if (count($relate_modules) != 0) {
	$relate_modules_imploded = implode('${comma}', $relate_modules);
}
if (count($is_required) != 0) {
	$is_required_imploded = implode('${comma}', $is_required);
}

// js Language Files
if ($translateFieldLabels) {
	wfm_utils::wfm_add_jsModLanguages($objectModule, false, false, Array(), $focus, $bean, $fieldsToBeRemoved, $translateFieldLabels, $rhs_key);
}

?>

<!-- Module Fields Select --> 
<table border=0 width='100%'>
	<tbody>
		<tr>
			<td>
				<table>
					<tr>
						<td>
							<h4><?php echo $mod_strings['LBL_ASOL_FIELDS']; ?></h4>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $fieldsSelect; ?>
						</td>
					</tr>
					<tr>
						<td>
							<input type='button' title='<?php echo $mod_strings['LBL_ASOL_ADD_FIELDS']; ?>' class='button' name='fields_button' value='<?php echo $mod_strings['LBL_ASOL_ADD_FIELDS']; ?>' onClick='createModifyObject_onClick_addFields();'>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
