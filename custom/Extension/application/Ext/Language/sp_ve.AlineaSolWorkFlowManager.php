<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");

// moduleList
$app_list_strings['moduleList']['asol_Activity'] = 'WFM Actividad';
$app_list_strings['moduleList']['asol_Events'] = 'WFM Eventos';
$app_list_strings['moduleList']['asol_Process'] = 'WFM Proceso';
$app_list_strings['moduleList']['asol_Task'] = 'WFM Tarea';
$app_list_strings['moduleList']['asol_ProcessInstances'] = 'WFM Instancias de Proceso';
$app_list_strings['moduleList']['asol_WorkingNodes'] = 'WFM Nodos Trabajando';
$app_list_strings['moduleList']['asol_OnHold'] = 'WFM En Espera';
wfm_utils::addPremiumAppListStrings($app_list_strings, 'sp_ve', 'addAppListStrings_loginAudit');

// wfm_process_status_list
$app_list_strings['wfm_process_status_list']['active'] = 'Activo';
$app_list_strings['wfm_process_status_list']['inactive'] = 'Inactivo';

// wfm_trigger_type_list
$app_list_strings['wfm_trigger_type_list']['logic_hook'] = 'Enganche Lógico';
$app_list_strings['wfm_trigger_type_list']['scheduled'] = 'Programado';
$app_list_strings['wfm_trigger_type_list']['subprocess'] = 'Subproceso';

// wfm_trigger_event_list
$app_list_strings['wfm_trigger_event_list']['on_create'] = 'En Creación';
$app_list_strings['wfm_trigger_event_list']['on_modify'] = 'En Modificación';
$app_list_strings['wfm_trigger_event_list']['on_modify__before_save'] = 'En Modificación Antes de Guardar';
$app_list_strings['wfm_trigger_event_list']['on_delete'] = 'En Eliminación';
wfm_utils::addPremiumAppListStrings($app_list_strings, 'sp_ve', 'addAppListStrings_loginAuditEvents');

$app_list_strings['wfm_trigger_event_list_not_users']['on_create'] = 'On Create';
$app_list_strings['wfm_trigger_event_list_not_users']['on_modify'] = 'On Modify';
$app_list_strings['wfm_trigger_event_list_not_users']['on_modify__before_save'] = 'On Modify Before Save';
$app_list_strings['wfm_trigger_event_list_not_users']['on_delete'] = 'On Delete';

// wfm_events_type_list
wfm_utils::addPremiumAppListStrings($app_list_strings, 'sp_ve', 'addAppListStrings_initialize');
$app_list_strings['wfm_events_type_list']['start'] = 'Inicio';
$app_list_strings['wfm_events_type_list']['intermediate'] = 'Intermedio';
$app_list_strings['wfm_events_type_list']['cancel'] = 'Cancelación';

// wfm_scheduled_type_list
$app_list_strings['wfm_scheduled_type_list']['sequential'] = 'Secuencial';
$app_list_strings['wfm_scheduled_type_list']['parallel'] = 'Paralelo';

// wfm_subprocess_type_list
$app_list_strings['wfm_subprocess_type_list']['sequential'] = 'Secuencial';
$app_list_strings['wfm_subprocess_type_list']['parallel'] = 'Paralelo';

// wfm_working_node_priority
$app_list_strings['wfm_working_node_priority']['logic_hook']['initialize'] = 0;
$app_list_strings['wfm_working_node_priority']['logic_hook']['start'] = -1;
$app_list_strings['wfm_working_node_priority']['subprocess']['sequential'] = -2;
$app_list_strings['wfm_working_node_priority']['subprocess']['parallel'] = -3;
$app_list_strings['wfm_working_node_priority']['logic_hook']['intermediate'] = -4;
$app_list_strings['wfm_working_node_priority']['logic_hook']['cancel'] = -5;
$app_list_strings['wfm_working_node_priority']['scheduled']['sequential'] = -6;
$app_list_strings['wfm_working_node_priority']['scheduled']['parallel'] = -7;

// wfm_activity_type_list
//$app_list_strings['wfm_activity_type_list']['no_foreach'] = 'No Foreach';
$app_list_strings['wfm_activity_type_list']['foreach_ingroup'] = 'Foreach En Grupo';
//$app_list_strings['wfm_activity_type_list']['foreach_inrelationship'] = 'Foreach En Relación';

// wfm_task_delay_type_list
$app_list_strings['wfm_task_delay_type_list']['no_delay'] = 'Sin Demora';
$app_list_strings['wfm_task_delay_type_list']['on_creation'] = 'En Creación';
$app_list_strings['wfm_task_delay_type_list']['on_modification'] = 'En Modificación';
$app_list_strings['wfm_task_delay_type_list']['on_finish_previous_task'] = 'En Terminación de la Tarea Previa';

// wfm_task_type_list
$app_list_strings['wfm_task_type_list']['send_email'] = 'Enviar Email';
$app_list_strings['wfm_task_type_list']['php_custom'] = 'PHP a Medida';
$app_list_strings['wfm_task_type_list']['continue'] = 'Continuar';
$app_list_strings['wfm_task_type_list']['end'] = 'Terminar';
$app_list_strings['wfm_task_type_list']['create_object'] = 'Crear Objeto';
$app_list_strings['wfm_task_type_list']['modify_object'] = 'Modificar Objeto';
$app_list_strings['wfm_task_type_list']['call_process'] = 'Llamar Proceso';
$app_list_strings['wfm_task_type_list']['add_custom_variables'] = 'Añadir Variables Custom';

// login_audit
$app_list_strings['wfm_login_audit_action_list']['login_failed'] = 'Fallo en Login';
$app_list_strings['wfm_login_audit_action_list']['after_login'] = 'Login';
$app_list_strings['wfm_login_audit_action_list']['before_logout'] = 'Logout';

// add_custom_variables_type
$app_list_strings['wfm_add_custom_variables_type']['sql'] = 'SQL';
//$app_list_strings['wfm_add_custom_variables_type']['php_eval'] = 'PHP eval';
//$app_list_strings['wfm_add_custom_variables_type']['literal'] = 'Literal';

// delay
$app_list_strings['wfm_delay_time']['minutes'] = 'Minutos';
$app_list_strings['wfm_delay_time']['hours'] = 'Horas';
$app_list_strings['wfm_delay_time']['days'] = 'Días';
$app_list_strings['wfm_delay_time']['weeks'] = 'Semanas';
$app_list_strings['wfm_delay_time']['months'] = 'Meses';

// delay
$app_list_strings['wfm_delay_time_amount']['minutes'] = 60;
$app_list_strings['wfm_delay_time_amount']['hours'] = 24;
$app_list_strings['wfm_delay_time_amount']['days'] = 31;
$app_list_strings['wfm_delay_time_amount']['weeks'] = 4;
$app_list_strings['wfm_delay_time_amount']['months'] = 12;

// working_node status
$app_list_strings['wfm_working_node_status']['not_started'] = 'Not Started';
$app_list_strings['wfm_working_node_status']['executing'] = 'Executing';
$app_list_strings['wfm_working_node_status']['delayed_by_activity'] = 'Delayed By Activity';
$app_list_strings['wfm_working_node_status']['delayed_by_task'] = 'Delayed By Task';
$app_list_strings['wfm_working_node_status']['in_progress'] = 'In Progress';
$app_list_strings['wfm_working_node_status']['terminated'] = 'Terminated';
$app_list_strings['wfm_working_node_status']['held'] = 'Held';

// wfm_working_node_type_list
$app_list_strings['wfm_working_node_type_list']['initialize'] = 'Inicializar';
$app_list_strings['wfm_working_node_type_list']['start'] = 'Inicio';
$app_list_strings['wfm_working_node_type_list']['intermediate'] = 'Intermedio';
$app_list_strings['wfm_working_node_type_list']['cancel'] = 'Cancelación';
$app_list_strings['wfm_working_node_type_list']['subprocess'] = 'Subproceso';

// DISABLE AJAX-UI
$sugar_config['addAjaxBannedModules'][] = "asol_Process";
$sugar_config['addAjaxBannedModules'][] = "asol_Events";
$sugar_config['addAjaxBannedModules'][] = "asol_Activity";
$sugar_config['addAjaxBannedModules'][] = "asol_Task";
$sugar_config['addAjaxBannedModules'][] = "asol_ProcessInstances";
$sugar_config['addAjaxBannedModules'][] = "asol_WorkingNodes";
$sugar_config['addAjaxBannedModules'][] = "asol_OnHold";

?>