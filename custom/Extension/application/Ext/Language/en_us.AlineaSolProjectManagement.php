<?php

require_once('modules/asol_Project/asolProjectUtils.php');

$app_list_strings['moduleList']['asol_Project'] = 'AsolProjects';
$app_list_strings['moduleList']['asol_ProjectTask'] = 'AsolProjectTasks';
$app_list_strings['moduleList']['asol_ProjectVersion'] = 'ProjVersion';

if (asolProjectUtils::$edition == 'SRM') {
	$app_list_strings['moduleList']['asol_Release'] = 'Releases';
	$app_list_strings['moduleList']['asol_Feature'] = 'Features';
	$app_list_strings['moduleList']['asol_Domains'] = 'Domains';
	$app_list_strings['moduleList']['asol_TicketsN2'] = 'TicketsN2';
	$app_list_strings['moduleList']['asol_TicketsN3'] = 'TicketsN3';
	$app_list_strings['moduleList']['asol_Installation'] = 'Installations';
	$app_list_strings['moduleList']['asol_Intervention'] = 'Interventions';
}

$app_list_strings['asol_release_status_list']['inactive'] = 'Inactive';
$app_list_strings['asol_release_status_list']['active'] = 'Active';
$app_list_strings['asol_release_status_list']['future'] = 'Future';

$app_list_strings['asol_release_product_list']['bss'] = 'BSS';
$app_list_strings['asol_release_product_list']['sdp'] = 'SDP';
$app_list_strings['asol_release_product_list']['crm'] = 'CRM';
$app_list_strings['asol_release_product_list']['billing'] = 'Billing';
$app_list_strings['asol_release_product_list']['campaing_manager'] = 'Campaing Manager';
$app_list_strings['asol_release_product_list']['data_mining'] = 'Data Mining';
$app_list_strings['asol_release_product_list']['core'] = 'Core';

$app_list_strings['asol_release_scope_list']['generic'] = 'Generic';
$app_list_strings['asol_release_scope_list']['domain'] = 'Domain';

$app_list_strings['asol_project_status_list']['draft'] = 'Draft';
$app_list_strings['asol_project_status_list']['analysing'] = 'Analysing';
$app_list_strings['asol_project_status_list']['estimate'] = 'Estimate';
$app_list_strings['asol_project_status_list']['approved'] = 'Approved';
$app_list_strings['asol_project_status_list']['developing'] = 'Developing';
$app_list_strings['asol_project_status_list']['released'] = 'Released';
$app_list_strings['asol_project_status_list']['canceled'] = 'Canceled';
$app_list_strings['asol_project_status_list']['error'] = 'Error';

$app_list_strings['asol_project_priority_list']['1'] = '1';
$app_list_strings['asol_project_priority_list']['2'] = '2';
$app_list_strings['asol_project_priority_list']['3'] = '3';
$app_list_strings['asol_project_priority_list']['4'] = '4';
$app_list_strings['asol_project_priority_list']['5'] = '5';

$app_list_strings['asol_projecttask_status_list']['STATUS_ACTIVE'] = 'STATUS_ACTIVE';
$app_list_strings['asol_projecttask_status_list']['STATUS_DONE'] = 'STATUS_DONE';
$app_list_strings['asol_projecttask_status_list']['STATUS_FAILED'] = 'STATUS_FAILED';
$app_list_strings['asol_projecttask_status_list']['STATUS_SUSPENDED'] = 'STATUS_SUSPENDED';
$app_list_strings['asol_projecttask_status_list']['STATUS_UNDEFINED'] = 'STATUS_UNDEFINED';

$app_list_strings['asol_installation_type_list']['test'] = 'Test';
$app_list_strings['asol_installation_type_list']['production'] = 'Production';

$app_list_strings['asol_installation_status_list']['on_hold'] = 'On Hold';
$app_list_strings['asol_installation_status_list']['active'] = 'Active';
$app_list_strings['asol_installation_status_list']['done'] = 'Done';
$app_list_strings['asol_installation_status_list']['canceled'] = 'Canceled';

$app_list_strings['asol_feature_status_list']['canceled'] = 'Canceled';
$app_list_strings['asol_feature_status_list']['draft'] = 'Draft';
$app_list_strings['asol_feature_status_list']['accepted'] = 'Accepted';
$app_list_strings['asol_feature_status_list']['developing'] = 'Developing';
$app_list_strings['asol_feature_status_list']['active'] = 'Active';
$app_list_strings['asol_feature_status_list']['degraded'] = 'Degraded';
$app_list_strings['asol_feature_status_list']['discontinuous'] = 'Discontinuous';

$app_list_strings['asol_feature_product_list']['bsscore'] = 'BSSCore';
$app_list_strings['asol_feature_product_list']['pdv'] = 'PdV';

$app_list_strings['asol_release_type_list']['new_functionality'] = 'New Functionality';
$app_list_strings['asol_release_type_list']['bug'] = 'Bug';
$app_list_strings['asol_release_type_list']['optimization'] = 'Optimization';

$app_list_strings['asol_feature_scope_list']['generic'] = 'Generic';
$app_list_strings['asol_feature_scope_list']['domain'] = 'Domain';

$app_list_strings['parent_type_display']['asol_Project'] = 'AsolProject';
$app_list_strings['parent_type_display']['asol_ProjectTask'] = 'AsolProjectTask';
$app_list_strings['record_type_display']['asol_Project'] = 'AsolProject';
$app_list_strings['record_type_display']['asol_ProjectTask'] = 'AsolProjectTask';

$app_list_strings['record_type_display_notes']['asol_Project'] = 'AsolProject';
$app_list_strings['record_type_display_notes']['asol_ProjectTask'] = 'AsolProjectTask';

$app_list_strings['asol_projectversion_type_list']['working_version'] = 'Working version';
$app_list_strings['asol_projectversion_type_list']['last_published_version'] = 'Last published version';
asolProjectUtils::addPremiumAppListStrings($app_list_strings, 'en_us', 'addAppListStrings_baseline');

// TRICK: DISABLE AJAX-UI
$sugar_config['addAjaxBannedModules'][] = "asol_Release";
$sugar_config['addAjaxBannedModules'][] = "asol_Project";
$sugar_config['addAjaxBannedModules'][] = "asol_ProjectTask";
$sugar_config['addAjaxBannedModules'][] = "asol_ProjectVersion";
$sugar_config['addAjaxBannedModules'][] = "asol_Installation";
$sugar_config['addAjaxBannedModules'][] = "asol_Intervention";
$sugar_config['addAjaxBannedModules'][] = "asol_Feature";
$sugar_config['addAjaxBannedModules'][] = "asol_Domains";
$sugar_config['addAjaxBannedModules'][] = "asol_TicketsN2";
$sugar_config['addAjaxBannedModules'][] = "asol_TicketsN3";
