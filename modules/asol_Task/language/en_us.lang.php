<?php

$mod_strings = array (

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
'LBL_LIST_FORM_TITLE' => 'Task List',
'LBL_MODULE_NAME' => 'Task',
'LBL_MODULE_TITLE' => 'Task',
'LBL_HOMEPAGE_TITLE' => 'My WFM Tasks',
'LNK_NEW_RECORD' => 'Create Task',
'LNK_LIST' => 'View Task',
'LNK_IMPORT_ASOL_TASK' => 'Import Task',
'LBL_SEARCH_FORM_TITLE' => 'Search Task',
'LBL_HISTORY_SUBPANEL_TITLE' => 'View History',
'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
'LBL_ASOL_TASK_SUBPANEL_TITLE' => 'Task',
'LBL_NEW_FORM_TITLE' => 'New Task',
'LBL_DELAY_TYPE' => 'Delay Type',
'LBL_DELAY' => 'Delay',
'LBL_TASK_ORDER' => 'Order',
'LBL_TASK_TYPE' => 'Task Type',
'LBL_TASK_IMPLEMENTATION' => 'Task Implementation',

// Menu.php
'LBL_ASOL_VIEW_ASOL_PROCESSES' => 'View Processes',
'LBL_ASOL_CREATE_ASOL_PROCESS' => 'Create Process',
'LBL_ASOL_VIEW_ASOL_EVENTS' => 'View Events',
'LBL_ASOL_CREATE_ASOL_EVENT' => 'Create Event',
'LBL_ASOL_VIEW_ASOL_ACTIVITIES' => 'View Activities',
'LBL_ASOL_CREATE_ASOL_ACTIVITY' => 'Create Activity',
'LBL_ASOL_VIEW_ASOL_TASKS' => 'View Tasks',
'LBL_ASOL_CREATE_ASOL_TASK' => 'Create Task',
'LBL_ASOL_ALINEASOL_WFM_MONITOR' => 'AlineaSol WFM Monitor',
'LBL_ASOL_VIEW_ASOL_LOGINAUDIT' => 'View Login Audit',

// asol_task.js
'LBL_ASOL_TASK_JS_SEND_EMAIL_EMAIL_TPL' => 'Email Tpl',
'LBL_ASOL_TASK_JS_SEND_EMAIL_FROM' => 'From',
'LBL_ASOL_TASK_JS_SEND_EMAIL_ALL' => 'Summary',
'LBL_ASOL_TASK_JS_SEND_EMAIL_ALL_TIP' => '(fill TO-CC-BCC-data in other tabs)',
'LBL_ASOL_TASK_JS_SEND_EMAIL_TO' => 'TO',
'LBL_ASOL_TASK_JS_SEND_EMAIL_CC' => 'CC',
'LBL_ASOL_TASK_JS_SEND_EMAIL_BCC' => 'BCC',
'LBL_ASOL_TASK_JS_SEND_EMAIL_USERS' => 'Users',
'LBL_ASOL_TASK_JS_SEND_EMAIL_ROLES' => 'Roles',
'LBL_ASOL_TASK_JS_SEND_EMAIL_NOTIFICATIONEMAILS' => 'Notification Emails',
'LBL_ASOL_TASK_JS_SEND_EMAIL_DISTRIBUTION_LIST' => 'Distribution List',

'LBL_ASOL_TASK_JS_PHP_CUSTOM_PHP_CODE' => 'PHP Code',

'LBL_ASOL_TASK_JS_END_TERMINATE_PROCESS' => 'Terminate Process',

'LBL_ASOL_TASK_JS_CONTINUE_WAIT_FOR_SUGAR_TASK_TO_CONTINUE_PROCESS' => 'Wait for Sugar Task to Continue Process',

'LBL_ASOL_TASK_JS_CALL_PROCESS_PROCESS' => 'Process',
'LBL_ASOL_TASK_JS_CALL_PROCESS_EVENT_FROM_PROCESS' => 'Process\'s Event',
'LBL_ASOL_TASK_JS_CALL_PROCESS_EXECUTE_SUBPROCESS_IMMEDIATELY' => 'Execute subprocess immediately and wait until is done',

//
'LBL_TASK_IMPLEMENTATION_PANEL' => 'Task Implementation Panel',

// delay.php
'LBL_ASOL_MINUTES' => 'Minutes',
'LBL_ASOL_HOURS' => 'Hours',
'LBL_ASOL_DAYS' => 'Days',
'LBL_ASOL_WEEKS' => 'Weeks',
'LBL_ASOL_MONTHS' => 'Months',

// module_object_values.php
'LBL_ASOL_DATABASE_FIELD' => 'Database Field',
'LBL_ASOL_VALUE' => 'Value',

//
'LBL_ADD_NOT_A_FIELD_TITLE' => 'Not a Field',
'LBL_ADD_NOT_A_FIELD_BUTTON' => 'Add Not a Field',
// module_fields.php
'LBL_ASOL_FIELDS' => 'Fields',
'LBL_ASOL_ADD_FIELDS' => 'Add Fields',
'LBL_ASOL_SHOW_RELATED' => 'Show Related',
'LBL_ASOL_RELATED_FIELDS' => 'Related Fields',
'LBL_ASOL_ADD_RELATED_FIELDS' => 'Add Related Fields',

// task_implementation.php
'LBL_ASOL_OBJECT_MODULE' => 'Object Module',

'LBL_ASOL_DELETE_BUTTON' => 'Delete Button',
'LBL_ASOL_DELETE_ROW_ALERT' => 'Delete Field?',
'LBL_ASOL_INSERT_NOT_ALLOWED_ALERT' => 'Insert Not Allowed',

// qtip_info for task_type
'LBL_ASOL_INFO_ICON_SEND_EMAIL' => '<b>Send Email</b> <br> Variable examples: <br> ${Users->created_by->email1} <br> ${old_bean->email1} <br> ${bean->email1} <br> ${old_bean->asol_email_list} <br> ${bean->asol_email_list}',
'LBL_ASOL_INFO_ICON_PHP_CUSTOM' => '<b>PHP Custom</b> <br> You have access to this php-variables: <br> $task_id <br> $trigger_module <br> $bean_id <br> $old_bean <br> $new_bean <br> $current_user_id',
'LBL_ASOL_INFO_ICON_CONTINUE' => '<b>Continue</b>',
'LBL_ASOL_INFO_ICON_END' => '<b>End</b>',
'LBL_ASOL_INFO_ICON_CALL_PROCESS' => '<b>Call Process</b>',

// popupHelp
'LBL_POPUPHELP_FOR_FIELD_DELAY_TYPE' => "<table class='popupHelp'><tr><th>Delay Type</th><th>Description</th></tr><tr><td>No Delay</td><td>WFM does not wait, it executes the task immediately.</td></tr><tr><td>On Creation</td><td>WFM waits. Timebase = date_entered of the object that instanciated the process.</td></tr><tr><td>On Modification</td><td>WFM waits. Timebase = date_modified of the object that instanciated the process.</td></tr><tr><td>On Finish Previous Task</td><td>WFM waits. Timebase = when the previous task is finished. If the previous task is a create_object and the object is a sugar-task or a sugar-call, WFM will wait until the task is completed or the call is held (task/call is closed).</td></tr></table>",
'LBL_POPUPHELP_FOR_FIELD_TASK_TYPE' => "<table class='popupHelp'><tr><th>Task Type</th><th>Description</th></tr><tr><td>Send Email</td><td>There are 4 tabs(Summary,TO,CC,BCC). In the Summary-tab you can choose an EmailTemplate, and a From-EmailAddress; also you can see the TO,CC,BCC info. In the other three tabs you can set the destination-EmailAddresses. There are three ways: 1) Users (select the users you want to send an email to), 2) Roles (select the roles you want to send an email to, i.e, to the users with these roles), 3) Distribution List (standard email address separated by “,”).</td></tr><tr><td>PHP Custom</td><td>WFM will execute the php-code you wrote. Be careful with this WFM-task, it will be executed whatever the php-code, you can even delete all your files in your hard-disk-drive.</td></tr><tr><td>Continue</td><td>Supportive construct to be used as final task within an activity when the previous task must end before starting the next activity. This will only have a differentiating behavior if the previous created object was a call or a CRM task.</td></tr><tr><td>End</td><td>Used to indicate the end of a process. This can result in different behavior depending on related parameter. Terminate Process: 1) Checked -> terminates process-instance, i.e. all active branches of the process-instance 2) Not Checked ->  ends branch-execution, but allows process-instance to continue running.</td></tr><tr><td>Create Object</td><td>Creates a new object. All Mandatory fields will automatically appear. Additional field values can be added and deleted by the user.</td></tr><tr><td>Modify Object</td><td>Allows to change the trigger object.</td></tr><tr><td>Call Process</td><td>Includes the name of the process and event. You can only call wfm-events of trigger_type=subprocess.</td></tr><tr><td>Add Custom Variables</td><td>You can define variables and then use them in another wfm-task or wfm-activity(next_activity); the custom_variables are inherited from wfm-activity to their next_activities. </td></tr></table>",
'LBL_POPUPHELP_FOR_FIELD_TASK_IMPLEMENTATION' => "<table class='popupHelp'><tr><th>Task Type</th><th>Tips</th></tr><tr><td>Send Email</td><td>Variable examples: <br> \${Users->created_by->email1} <br> \${old_bean->email1} <br> \${bean->email1} <br> \${old_bean->asol_email_list} <br> \${bean->asol_email_list} <br> \${c_var->server->client_ip} <br> \${c_var->server->REMOTE_ADDR} <br> \${c_var->request->user_name} <br> \${c_var->current_user->is_admin}</td></tr><tr><td>PHP Custom</td><td>You must write the php-tags, within them goes your php-code.<br><br>You have access to this php-variables: <br> \$task_id <br> \$alternative_database<br> \$trigger_module <br> \$bean_id <br> \$old_bean <br> \$new_bean <br> \$custom_variables <br> \$current_user_id</td></tr><tr><td>Continue</td><td>&nbsp;</td></tr><tr><td>End</td><td>&nbsp;</td></tr><tr><td>Create Object</td><td>You can use variables (\${bean->name}...).<br><br>Be careful if you use a wfm-task=create_object and a trigger_event=on_create and a trigger_module=created_object_module => it will cause an infinite loop if you do not use conditions to avoid it.</td></tr><tr><td>Modify Object</td><td>You can use variables (\${bean->name}...).<br><br>Be careful if you use a wfm-task=modify_object and a trigger_event=on_modify => it will cause an infinite loop if you do not use conditions to avoid it.</td></tr><tr><td>Call Process</td><td>&nbsp;</td></tr><tr><td>Add Custom Variables</td><td>Example 1: module=Accounts, field=annual_revenue, trigger_type=scheduled, scheduled_type=sequential -> you want to sum all the revenues of the Accounts -> go to functions(click on the wheel) and write [\${this}+ \${c_var->annual_revenue_sum}] , annual_revenue_sum is the name of the custom_variable (you can call it whatever you like). In order to access a custom_variable -> \${c_var->[custom_variable_name]}<br>Example 2: Getting the third link in a custom_variable. Add this code in the field MySQL ID of a related module being 'OPP1' the related module and 'USER1' the third linked module. <br>&nbsp;&nbsp;&nbsp;&nbsp;-SELECT USER1.user_name FROM opportunities OPP1 LEFT JOIN users USER1 ON (OPP1.assigned_user_id=USER1.id) WHERE OPP1.id=\${this} </td></tr></table>",

// calculated
'LBL_REPORT_SAVE' => 'Save',
'LBL_REPORT_CLEAR' => 'Clear',
'LBL_REPORT_CLOSE' => 'Close',
'LBL_REPORT_CANCEL' => 'Cancel',
'LBL_REPORT_CALCULATED_FUNCTION_FOR' => 'Calculated Function for',

// acv
'LBL_ACV_NAME' => 'Name',
'LBL_ACV_TYPE' => 'Type',
'LBL_ACV_MODULEFIELDS' => 'Module Field',
'LBL_ACV_FUNCTIONS' => 'Functions',
'LBL_ACV_IS_GLOBAL' => 'Is Global?',

);
?>
