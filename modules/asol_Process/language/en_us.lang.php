<?php

$mod_strings = array (
 
// General
'LBL_ASSIGNED_TO_ID' => 'Assigned User Id',
'LBL_ASSIGNED_TO_NAME' => 'User',
'LBL_ID' => 'ID',
'LBL_DATE_ENTERED' => 'Date Created',
'LBL_DATE_MODIFIED' => 'Date Modified',
'LBL_MODIFIED' => 'Modified By',
'LBL_MODIFIED_ID' => 'Modified By Id',
'LBL_MODIFIED_NAME' => 'Modified By',
'LBL_CREATED' => 'Created By',
'LBL_CREATED_ID' => 'Created By Id',
'LBL_DESCRIPTION' => 'Description',
'LBL_DELETED' => 'Deleted',
'LBL_NAME' => 'Name',
'LBL_CREATED_USER' => 'Created by User',
'LBL_MODIFIED_USER' => 'Modified by User',
'LBL_LIST_NAME' => 'Name',
'LBL_LIST_FORM_TITLE' => 'Process List',
'LBL_MODULE_NAME' => 'Process',
'LBL_MODULE_TITLE' => 'Process',
'LBL_HOMEPAGE_TITLE' => 'My WFM Processes',
'LNK_NEW_RECORD' => 'Create Process',
'LNK_LIST' => 'View Process',
'LNK_IMPORT_ASOL_PROCESS' => 'Import Process',
'LBL_SEARCH_FORM_TITLE' => 'Search Process',
'LBL_HISTORY_SUBPANEL_TITLE' => 'View History',
'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
'LBL_ASOL_PROCESS_SUBPANEL_TITLE' => 'Process',
'LBL_NEW_FORM_TITLE' => 'New Process',

// Menu
'LBL_ASOL_VIEW_ASOL_PROCESSES' => 'View Processes',
'LBL_ASOL_CREATE_ASOL_PROCESS' => 'Create Process',
'LBL_ASOL_VIEW_ASOL_EVENTS' => 'View Events',
'LBL_ASOL_CREATE_ASOL_EVENT' => 'Create Event',
'LBL_ASOL_VIEW_ASOL_ACTIVITIES' => 'View Activities',
'LBL_ASOL_CREATE_ASOL_ACTIVITY' => 'Create Activity',
'LBL_ASOL_VIEW_ASOL_TASKS' => 'View Tasks',
'LBL_ASOL_CREATE_ASOL_TASK' => 'Create Task',
'LBL_ASOL_VIEW_ASOL_LOGINAUDIT' => 'View Login Audit',
'LBL_ASOL_ALINEASOL_WFM_MONITOR' => 'AlineaSol WFM Monitor',

// Miscellaneous
'LBL_DB_CONFIGURATION_PANEL' => 'Module Panel',
'LBL_REPORT_NATIVE_DB' => 'CRM Native Database',

// Fields
'LBL_STATUS' => 'Status',
'LBL_TRIGGER_MODULE' => 'Module',
'LBL_ASOL_TRIGGER_MODULE' => 'Module',
'LBL_REPORT_USE_ALTERNATIVE_DB' => 'Use Database',

// Rebuild logic_hooks
'LBL_ASOL_REBUILD_TITLE' => 'Check the modules you want AlineaSol WFM to supervise and click on "Update" at the bottom.',
'LBL_ASOL_REBUILD_SEND' => 'Update',
'LBL_ASOL_REBUILD_DONE' => 'DONE',

// Import Advanced
'LBL_IMPORT_ADVANCED' => 'Import',
'LBL_IMPORT_STEP1_ADVANCED' => 'Step 1: Check if WorkFlows already exist.',
'LBL_IMPORT_STEP2_WORKFLOWS_EXIST_ADVANCED' => 'Step 2: WorkFlows already exist. Choose your options and Import.',
'LBL_IMPORT_STEP2_WORKFLOWS_NOT_EXIST_ADVANCED' => 'Step 2: WorkFlows do not exist. Import.',
'LBL_IMPORT_CHECK_ADVANCED' => 'Check',
'LBL_IMPORT_TYPE_REPLACE_ADVANCED' => 'Replace WFs',
'LBL_IMPORT_TYPE_CLONE_ADVANCED' => 'Clone WFs',
'LBL_IMPORT_TYPE_CLONE_PREFIX_ADVANCED' => 'Prefix',
'LBL_IMPORT_TYPE_CLONE_SUFFIX_ADVANCED' => 'Suffix',
'LBL_IMPORT_DOMAIN_TYPE_KEEP_DOMAIN_ADVANCED' => 'Keep domain',
'LBL_IMPORT_DOMAIN_TYPE_USE_CURRENT_USER_DOMAIN_ADVANCED' => 'Use current domain',
'LBL_IMPORT_DOMAIN_TYPE_USE_EXPLICIT_DOMAIN_ADVANCED' => 'Use explicit domain',
'LBL_IMPORT_EXPLICIT_DOMAIN_ADVANCED' => 'Explicit domain',
'LBL_IMPORT_RENAME_KEEP_NAMES_ADVANCED' => 'Keep names',
'LBL_IMPORT_RENAME_WFM_PROCESS_ONLY_ADVANCED' => 'Rename wfm-process only',
'LBL_IMPORT_RENAME_ALL_WFM_ENTITIES_ADVANCED' => 'Rename all wfm-entities',
'LBL_IMPORT_TITLE_ADVANCED' => 'Import WorkFlows Advanced (admin-users only)',
'LBL_IMPORT_WORKFLOWS_ADVANCED' => 'Import WFs Advanced',
'LBL_IMPORT_SET_STATUS_TYPE_KEEP_STATUS_ADVANCED' => 'Keep WFs status',
'LBL_IMPORT_SET_STATUS_TYPE_INACTIVATE_ADVANCED' => 'Inactivate WFs',
'LBL_IMPORT_SET_STATUS_TYPE_ACTIVATE_ADVANCED' => 'Activate WFs',
'LBL_IMPORT_EMAIL_TEMPLATE_TYPE_IMPORT_ADVANCED' => 'Import EmailTemplates',
'LBL_IMPORT_EMAIL_TEMPLATE_TYPE_DO_NOT_IMPORT_ADVANCED' => 'Do Not Import EmailTemplates',
'LBL_IMPORT_IF_EMAIL_TEMPLATE_ALREADY_EXISTS_REPLACE_ADVANCED' => 'If EmailTemplate already exists then Replace',
'LBL_IMPORT_IF_EMAIL_TEMPLATE_ALREADY_EXISTS_CLONE_ADVANCED' => 'If EmailTemplate already exists then Clone',

// Import Standard Without Context
'LBL_IMPORT_WORKFLOWS_STANDARD_WITHOUT_CONTEXT' => 'Import WFs',
'LBL_IMPORT_TITLE_STANDARD_WITHOUT_CONTEXT' => 'Import WorkFlows Without Context',
'LBL_IMPORT_STEP1_STANDARD_WITHOUT_CONTEXT' => 'Import: Clone WorkFlows (wfm-process->status = inactive, wfm-process->asol_domain_id = $current_user->asol_default_domain)',
'LBL_IMPORT_STANDARD_WITHOUT_CONTEXT' => 'Import WFs',

// Import Standard In Context
'LBL_IMPORT_WORKFLOWS_STANDARD_IN_CONTEXT' => 'Import WF',
'LBL_IMPORT_TITLE_STANDARD_IN_CONTEXT' => 'Import WorkFlow In Context',
'LBL_IMPORT_STEP1_STANDARD_IN_CONTEXT' => 'Import: Replace WorkFlow (replace, keep_names, keep_status)',
'LBL_IMPORT_STANDARD_IN_CONTEXT' => 'Import WF',

// Export
'LBL_EXPORTED_WORKFLOWS_FILENAME' => 'Exported_WorkFlows',

// flowChart
'LBL_ASOL_REFRESH' => 'Refresh',
'LBL_ASOL_TEXT_OVERFLOW_ELLIPSIS' => 'Complete names',
'LBL_ASOL_INFO_TITLE' => 'Info',
'LBL_ASOL_INFO_TEXT' => '- In the flowChart there is a lot of hidden-information about the workflow-definition. If you hover the cursor over the items(icons and element-names) you will get some info. You have to click over the condition_icon in order to show the condition_info, and click again over the condition_icon in order to hide the condition_info.<br>- A click over the name of a element will redirect the popup´s parent_page to the definition of the element in the sugarcrm. This is useful to change values and see the flowChart at the same time. When pressing "Ctrl" key and clicking on a link => redirect to EditView (instead of DetailView when only clicking without pressing).<br>- Complete names -> this will show the whole-name of an element (for events and activities, not tasks).<br>- Events are ordered first by type and second by name. Activities are ordered by name (not for next_activities). Tasks are ordered first by task_order and second by name.<br>- Ctrl+Space => Complete names<br>- Click on connection => Change border-color of source-element and target-element',

// popupHelp
'LBL_POPUPHELP_FOR_FIELD_STATUS' => "<table class='popupHelp'><tr><th>Status</th><th>Description</th></tr><tr><td>Active</td><td>WFM instanciates processes.</td></tr><tr><td>Inactive</td><td>WFM does not instanciate processes. But it will execute processes already instanciated and stored in database.</td></tr></table>",
'LBL_POPUPHELP_FOR_FIELD_TRIGGER_MODULE' => "<table class='popupHelp'><tr><td>When modifying a wfm-process you can not change the module because of security measures.<br><br>Example 1: If you create a wfm-process with a specific module and then you create a wfm-task of type=modify_object. Note that a field that you want the wfm to modify for the first module could not exist for the second module.<br>Example 2: If you define a condition(wfm-event/wfm-activity) for a module, this could not work if you change the module(because the field does not exist in this new module).</td></tr></table>",
'LBL_POPUPHELP_FOR_FIELD_ALTERNATIVE_DATABASE' => "<table class='popupHelp'><tr><td>- External non CRM databases (the databases access must be configured in an array within config_override.php file): \$sugar_config['WFM_AlternativeDbConnections'] </td></tr></table>",

// Variables
'LBL_WFM_VARIABLES' => 'WFM Variables',

// WORKFLOWS_ERROR
'LBL_DELETE_WORKFLOWS_ERROR' => '<b>Error when deleting WorkFlows.</b>',
'LBL_IMPORT_WORKFLOWS_ERROR' => '<b>Error when importing WorkFlows.</b>',

// WORKFLOWS_OK
'LBL_ACTIVATE_WORKFLOWS_OK' => '<b>WorkFlows have been successfully activated.</b>',
'LBL_INACTIVATE_WORKFLOWS_OK' => '<b>WorkFlows have been successfully inactivated.</b>',
'LBL_DELETE_WORKFLOWS_OK' => '<b>WorkFlows have been successfully deleted.</b>',
'LBL_IMPORT_WORKFLOWS_OK' => '<b>WorkFlows have been successfully imported.</b>',

// WORKFLOWS_BUTTON
'LBL_FLOWCHARTS_BUTTON' => 'View WFs',
'LBL_VALIDATE_WORKFLOWS_BUTTON' => 'Validate WFs',
'LBL_ACTIVATE_WORKFLOWS_BUTTON' => 'Activate WFs',
'LBL_INACTIVATE_WORKFLOWS_BUTTON' => 'Inactivate WFs',
'LBL_DELETE_WORKFLOWS_BUTTON' => 'Delete WFs',
'LBL_EXPORT_WORKFLOWS_BUTTON' => 'Export WFs',

// WORKFLOW_BUTTON
'LBL_FLOWCHART_BUTTON' => 'View WF',
'LBL_VALIDATE_WORKFLOW_BUTTON' => 'Validate WF',
'LBL_ACTIVATE_WORKFLOW_BUTTON' => 'Activate WF',
'LBL_INACTIVATE_WORKFLOW_BUTTON' => 'Inactivate WF',
'LBL_DELETE_WORKFLOW_BUTTON' => 'Delete WF',
'LBL_EXPORT_WORKFLOW_BUTTON' => 'Export WF',
'LBL_IMPORT_WORKFLOW_BUTTON' => 'Import WF',
'LBL_ACTIVATE_INACTIVATE_WORKFLOW_BUTTON' => 'Act/Desact WF',

// WORKFLOW_WARNING
'LBL_ACTIVATE_WORKFLOW_WARNING' => 'WorkFlow is going to be activated. Are you sure?',
'LBL_INACTIVATE_WORKFLOW_WARNING' => 'WorkFlow is going to be inactivated. Are you sure?',
'LBL_DELETE_WORKFLOW_WARNING' => 'WorkFlow is going to be deleted. Are you sure?',
'LBL_IMPORT_WORKFLOW_WARNING' => 'WorkFlow is going to be imported. Are you sure?',

// WORKFLOWS_WARNING
'LBL_ACTIVATE_WORKFLOWS_WARNING' => 'WorkFlows are going to be activated. Are you sure?',
'LBL_INACTIVATE_WORKFLOWS_WARNING' => 'WorkFlows are going to be inactivated. Are you sure?',
'LBL_DELETE_WORKFLOWS_WARNING' => 'WorkFlows are going to be deleted. Are you sure?',

// WORKFLOWS_PLEASE
'LBL_FLOWCHART_PLEASE' => 'Please select at least 1 record to proceed.',
'LBL_VALIDATE_WORKFLOWS_PLEASE' => 'Please select at least 1 record to proceed.',
'LBL_ACTIVATE_WORKFLOWS_PLEASE' => 'Please select at least 1 record to proceed.',
'LBL_INACTIVATE_WORKFLOWS_PLEASE' => 'Please select at least 1 record to proceed.',
'LBL_EXPORT_WORKFLOWS_PLEASE' => 'Please select at least 1 record to proceed.',
'LBL_DELETE_WORKFLOWS_PLEASE' => 'Please select at least 1 record to proceed.',

// WFM Variable Generator
'LBL_WFM_VARIABLE_GENERATOR_BUTTON' => 'WFM Variable Generator',
'LBL_CUSTOM_VARIABLE_PREDEFINED_BUTTON' => 'Add Custom Variables Predefined',
'LBL_CUSTOM_VARIABLE_USER_DEFINED_BUTTON' => 'Add Custom Variables User Defined',
'LBL_DATETIME_BUTTON' => 'Add Current Datetime/Date',

// VALIDATE
'LBL_VALIDATE_TITLE' => 'Validate WorkFlows',
'LBL_VALIDATE_STEP1' => 'Step 1: Choose validations.',
'LBL_VALIDATE_BUTTON' => 'Validate',
'LBL_VALIDATE_ALL' => 'All',
'LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE' => 'Task SendEmail references existing EmailTemplate',
'LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE_ERROR' => 'Task SendEmail does NOT reference existing EmailTemplate',
'LBL_VALIDATE_WORKFLOW_IS_ACTIVE' => 'WorkFlow is active',
'LBL_VALIDATE_LOGIC_HOOK_IS_SET' => 'Logic Hook is set',
'LBL_VALIDATE_VALIDATION' => 'Validation',
'LBL_VALIDATE_RESULT' => 'Result',
);
?>
