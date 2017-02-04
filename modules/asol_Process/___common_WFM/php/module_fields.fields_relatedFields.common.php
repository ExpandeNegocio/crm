<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $db, $beanList, $beanFiles, $mod_strings, $timedate, $sugar_config;

// Whether translate or not variable for all this php-file
$translateFieldLabels = ((!isset($sugar_config['WFM_TranslateLabels'])) || ($sugar_config['WFM_TranslateLabels'])) ? true : false;

$rhs_key = (isset($_REQUEST['rhs_key'])) ? $_REQUEST['rhs_key'] : "";

// Get fields

if (($sel_altDb >= 0) && ($sel_altDbTable != '')) {

	wfm_utils::wfm_log('debug', '$sel_altDb=['.var_export($sel_altDb, true).']', __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', '$sel_altDbTable=['.var_export($sel_altDbTable, true).']', __FILE__, __METHOD__, __LINE__);
	$currentTableFields = wfm_reports_utils::getExternalTableFields($focus, $sel_altDb, $sel_altDbTable, $rhs_key);

} else if (($bean_module != '')) {

	$class_name = $beanList[$bean_module];
	require_once($beanFiles[$class_name]);
	$bean = new $class_name();

	$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();
	$fieldsToBeRemoved = wfm_reports_utils::getNonVisibleFields($bean_module ,$isDomainsInstalled, true);

	$currentTableFields = wfm_reports_utils::getCrmTableFields($bean, $bean_module, $fieldsToBeRemoved, $translateFieldLabels, $rhs_key, false);
}
wfm_utils::wfm_log('debug', '$currentTableFields=['.var_export($currentTableFields, true).']', __FILE__, __METHOD__, __LINE__);

$fields = (isset($currentTableFields['fields'])) ? $currentTableFields['fields'] : null;
$fields_labels = (isset($currentTableFields['fields_labels'])) ? $currentTableFields['fields_labels'] : null;
$fields_type = (isset($currentTableFields['fields_type'])) ? $currentTableFields['fields_type'] : null;

$fields_enum_operators = (isset($currentTableFields['fields_enum_operators'])) ? $currentTableFields['fields_enum_operators'] : null;
$fields_enum_references = (isset($currentTableFields['fields_enum_references'])) ? $currentTableFields['fields_enum_references'] : null;

$has_related = (isset($currentTableFields['has_related'])) ? $currentTableFields['has_related'] : null;
$add_id_relationships = ($has_related[0] == 'true') ? true : false ;
$related_fields = (isset($currentTableFields['related_fields'])) ? $currentTableFields['related_fields'] : null;
$related_fields_labels = (isset($currentTableFields['related_fields_labels'])) ? $currentTableFields['related_fields_labels'] : null;
$related_fields_type = (isset($currentTableFields['related_fields_type'])) ? $currentTableFields['related_fields_type'] : null;
$related_fields_relationship = (isset($currentTableFields['related_fields_relationship'])) ? $currentTableFields['related_fields_relationship'] : null;
$related_fields_relationship_labels = (isset($currentTableFields['related_fields_relationship_labels'])) ? $currentTableFields['related_fields_relationship_labels'] : null;

$related_fields_enum_operators = (isset($currentTableFields['related_fields_enum_operators'])) ? $currentTableFields['related_fields_enum_operators'] : null;
$related_fields_enum_references = (isset($currentTableFields['related_fields_enum_references'])) ? $currentTableFields['related_fields_enum_references'] : null;

$related_modules = (isset($currentTableFields['related_modules'])) ? $currentTableFields['related_modules'] : null;
$fields_labels_key = (isset($currentTableFields['fields_labels_key'])) ? $currentTableFields['fields_labels_key'] : null;
$related_fields_labels_key = (isset($currentTableFields['related_fields_labels_key'])) ? $currentTableFields['related_fields_labels_key'] : null;

// Order module List for regular fields
$fields_labels_lowercase = array_map('strtolower', (!empty($fields_labels) ? $fields_labels : array() ));
if (!empty($fields_labels_lowercase)) {
	if ($fields_labels_key != null) {
		array_multisort($fields_labels_lowercase, $fields_labels, $fields_labels_key, $fields, $fields_type, $fields_enum_operators, $fields_enum_references, $has_related);
	} else {
		array_multisort($fields_labels_lowercase, $fields_labels, $fields, $fields_type, $fields_enum_operators, $fields_enum_references, $has_related);
	}
}

$rhs_key_array = explode('${comma}', $rhs_key);

// Order module List for the fields of the related_module
$related_fields_labels_lowercase = array_map('wfm_utils::addRelationShipNameToLowerCase', (!empty($related_fields_labels) ? $related_fields_labels : array()), (!empty($related_fields_relationship_labels) ? $related_fields_relationship_labels : array()) );

if (!empty($related_fields_labels_lowercase)) {
	if ($related_fields_labels_key != null) {// Avoid php-warning "Array sizes are inconsistent"
		if (count($related_fields_labels_lowercase) == count($rhs_key_array)) {// Avoid php-warning "Array sizes are inconsistent"
			array_multisort($related_fields_labels_lowercase, $related_fields_labels, $related_fields_labels_key, $related_fields, $related_fields_relationship_labels, $related_fields_relationship, $related_fields_type, $related_fields_enum_operators, $related_fields_enum_references, $rhs_key_array);
		} else {
			array_multisort($related_fields_labels_lowercase, $related_fields_labels, $related_fields_labels_key, $related_fields, $related_fields_relationship_labels, $related_fields_relationship, $related_fields_type, $related_fields_enum_operators, $related_fields_enum_references);
		}
	} else {
		if (count($related_fields_labels_lowercase) == count($rhs_key_array)) {// Avoid php-warning "Array sizes are inconsistent"
			array_multisort($related_fields_labels_lowercase, $related_fields_labels, $related_fields, $related_fields_relationship_labels, $related_fields_relationship, $related_fields_type, $related_fields_enum_operators, $related_fields_enum_references, $rhs_key_array);
		} else {
			array_multisort($related_fields_labels_lowercase, $related_fields_labels, $related_fields, $related_fields_relationship_labels, $related_fields_relationship, $related_fields_type, $related_fields_enum_operators, $related_fields_enum_references);
		}
	}
}

$rhs_key = implode('${comma}', $rhs_key_array);

// Generate fieldsSelect
$fieldsSelect = wfm_utils::wfm_generate_moduleFields_selectFields($fields, $rhs_key, $has_related, $fields_labels, $fields_labels_key, $multiple, $show_idRelationships);

// Generate relatedFieldsSelect
$relatedFieldsSelect = wfm_utils::wfm_generate_moduleFields_selectRelatedFields($related_fields, $related_fields_labels, $related_fields_labels_key, $related_fields_relationship, $related_fields_relationship_labels, $multiple);

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
if (count($related_fields_type) != 0) {
	$related_fields_type_imploded = implode('${comma}',$related_fields_type);
}
if (count($related_fields_enum_operators) != 0) {
	$related_fields_enum_operators_imploded = implode('${comma}', $related_fields_enum_operators);
}
if (count($related_fields_enum_references) != 0) {
	$related_fields_enum_references_imploded = implode('${comma}', $related_fields_enum_references);
}

// js Language Files
if ($translateFieldLabels) {
	wfm_utils::wfm_add_jsModLanguages($bean_module, true, $add_id_relationships, $related_modules, $focus, $bean, $fieldsToBeRemoved, $translateFieldLabels, $rhs_key);
}
?>

<!-- Module Fields Select -->
<input type='hidden' id='rhs_key'
	name='rhs_key' value='<?php echo $rhs_key; ?>' />

<table border=0 width='100%'>
	<tbody>
		<tr>
			<td>
				<table>
					<tr>
						<td>
							<h4>
							<?php echo $mod_strings['LBL_ASOL_FIELDS']; ?>
							</h4>
						</td>
					</tr>
					<tr>
						<td><?php echo $fieldsSelect; ?>
						</td>
					</tr>
					<tr>
						<td><input type='button'
							title='<?php echo $mod_strings['LBL_ASOL_ADD_FIELDS']; ?>'
							class='button' name='fields_button'
							value='<?php echo $mod_strings['LBL_ASOL_ADD_FIELDS']; ?>'
							onClick='onClick_addFields_button();'> <input type='button'
							title='<?php echo $mod_strings['LBL_ASOL_SHOW_RELATED']; ?>'
							class='button' style='display: none' id='show_related_button'
							name='show_related_button'
							value='<?php echo $mod_strings['LBL_ASOL_SHOW_RELATED']; ?>'
							onClick='onClick_showRelated_button(this);' />
						</td>
					</tr>
					<tr>
						<td>
							<h4>
							<?php echo $mod_strings['LBL_ASOL_RELATED_FIELDS']; ?>
							</h4>
						</td>
					</tr>
					<tr>
						<td><?php echo $relatedFieldsSelect; ?>
						</td>
					</tr>
					<tr>
						<td><input type='button'
							title='<?php echo $mod_strings['LBL_ASOL_ADD_RELATED_FIELDS']; ?>'
							class='button' name='related_fields_button'
							value='<?php echo $mod_strings['LBL_ASOL_ADD_RELATED_FIELDS']; ?>'
							onClick='onClick_addRelatedFields_button();' />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>

							<?php
							wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
							?>
