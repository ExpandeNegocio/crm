<?php

$mod_strings = array (
 
// General
'LBL_ASSIGNED_TO_ID' => 'Identificador de Usuario Asignado',
'LBL_ASSIGNED_TO_NAME' => 'Usuario',
'LBL_ID' => 'ID',
'LBL_DATE_ENTERED' => 'Fecha de Creación',
'LBL_DATE_MODIFIED' => 'Fecha de Modificación',
'LBL_MODIFIED' => 'Modificado Por',
'LBL_MODIFIED_ID' => 'Modificado Por Id',
'LBL_MODIFIED_NAME' => 'Modificado Por',
'LBL_CREATED' => 'Creado Por',
'LBL_CREATED_ID' => 'Creado Por Id',
'LBL_DESCRIPTION' => 'Descripción',
'LBL_DELETED' => 'Eliminado',
'LBL_NAME' => 'Nombre',
'LBL_CREATED_USER' => 'Creado por Usuario',
'LBL_MODIFIED_USER' => 'Modificado por Usuario',
'LBL_LIST_NAME' => 'Nombre',
'LBL_LIST_FORM_TITLE' => 'Lista de Procesos',
'LBL_MODULE_NAME' => 'Proceso',
'LBL_MODULE_TITLE' => 'Proceso',
'LBL_HOMEPAGE_TITLE' => 'Mis WFM Procesos',
'LNK_NEW_RECORD' => 'Crear Proceso',
'LNK_LIST' => 'Ver Proceso',
'LNK_IMPORT_ASOL_PROCESS' => 'Importar Proceso',
'LBL_SEARCH_FORM_TITLE' => 'Buscar Proceso',
'LBL_HISTORY_SUBPANEL_TITLE' => 'Ver Historial',
'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Actividades',
'LBL_ASOL_PROCESS_SUBPANEL_TITLE' => 'Proceso',
'LBL_NEW_FORM_TITLE' => 'Nuevo Proceso',

// Menu
'LBL_ASOL_VIEW_ASOL_PROCESSES' => 'Ver Procesos',
'LBL_ASOL_CREATE_ASOL_PROCESS' => 'Crear Proceso',
'LBL_ASOL_VIEW_ASOL_EVENTS' => 'Ver Eventos',
'LBL_ASOL_CREATE_ASOL_EVENT' => 'Crear Evento ',
'LBL_ASOL_VIEW_ASOL_ACTIVITIES' => 'Ver Actividades',
'LBL_ASOL_CREATE_ASOL_ACTIVITY' => 'Crear Actividad',
'LBL_ASOL_VIEW_ASOL_TASKS' => 'Ver Tareas',
'LBL_ASOL_CREATE_ASOL_TASK' => 'Crear Tarea',
'LBL_ASOL_VIEW_ASOL_LOGINAUDIT' => 'Ver Login Audit',
'LBL_ASOL_ALINEASOL_WFM_MONITOR' => 'AlineaSol WFM Monitor',

// Miscellaneous
'LBL_DB_CONFIGURATION_PANEL' => 'Panel del Módulo',
'LBL_REPORT_NATIVE_DB' => 'BDD Nativa del CRM',

// Fields
'LBL_STATUS' => 'Estado',
'LBL_TRIGGER_MODULE' => 'Módulo del Bean',
'LBL_ASOL_TRIGGER_MODULE' => 'Módulo',
'LBL_REPORT_USE_ALTERNATIVE_DB' => 'Usar Base de Datos',

// Rebuild logic_hooks
'LBL_ASOL_REBUILD_TITLE' => 'Verifica los módulos que quieres que AlineaSol WFM supervise y haz click en "Actualizar" abajo',
'LBL_ASOL_REBUILD_SEND' => 'Actualizar',
'LBL_ASOL_REBUILD_DONE' => 'HECHO',

// Import
'LBL_IMPORT_ADVANCED' => 'Importar',
'LBL_IMPORT_STEP1_ADVANCED' => 'Paso 1: Verificar si los WorkFlows ya existen',
'LBL_IMPORT_STEP2_WORKFLOWS_EXIST_ADVANCED' => 'Paso 2: Los WorkFlows ya existen. Escoge tus opciones e importa.',
'LBL_IMPORT_STEP2_WORKFLOWS_NOT_EXIST_ADVANCED' => 'Paso 2: Los WorkFlows no existen. Importa.',
'LBL_IMPORT_CHECK_ADVANCED' => 'Verificar',
'LBL_IMPORT_TYPE_REPLACE_ADVANCED' => 'Reemplazar',
'LBL_IMPORT_TYPE_CLONE_ADVANCED' => 'Clonar',
'LBL_IMPORT_TYPE_CLONE_PREFIX_ADVANCED' => 'Prefijo',
'LBL_IMPORT_TYPE_CLONE_SUFFIX_ADVANCED' => 'Sufijo',
'LBL_IMPORT_DOMAIN_TYPE_KEEP_DOMAIN_ADVANCED' => 'Mantener dominio',
'LBL_IMPORT_DOMAIN_TYPE_USE_CURRENT_USER_DOMAIN_ADVANCED' => 'Usar dominio actual',
'LBL_IMPORT_DOMAIN_TYPE_USE_EXPLICIT_DOMAIN_ADVANCED' => 'Usar dominio explícito',
'LBL_IMPORT_EXPLICIT_DOMAIN_ADVANCED' => 'Dominio explícito',
'LBL_IMPORT_RENAME_KEEP_NAMES_ADVANCED' => 'Mantener nombres',
'LBL_IMPORT_RENAME_WFM_PROCESS_ONLY_ADVANCED' => 'Renombrar wfm-process sólo',
'LBL_IMPORT_RENAME_ALL_WFM_ENTITIES_ADVANCED' => 'Renombrar todas las wfm-entities',
'LBL_IMPORT_TITLE_ADVANCED' => 'Importar WorkFlows Avanzado (sólo usuarios-admin)',
'LBL_IMPORT_WORKFLOWS_ADVANCED' => 'Importar WFs Avanzado',
'LBL_IMPORT_SET_STATUS_TYPE_KEEP_STATUS_ADVANCED' => 'Mantener estado WFs',
'LBL_IMPORT_SET_STATUS_TYPE_INACTIVATE_ADVANCED' => 'Inactivar WFs',
'LBL_IMPORT_SET_STATUS_TYPE_ACTIVATE_ADVANCED' => 'Activar WFs',
'LBL_IMPORT_EMAIL_TEMPLATE_TYPE_IMPORT_ADVANCED' => 'Importar EmailTemplates',
'LBL_IMPORT_EMAIL_TEMPLATE_TYPE_DO_NOT_IMPORT_ADVANCED' => 'No Importar EmailTemplates',
'LBL_IMPORT_IF_EMAIL_TEMPLATE_ALREADY_EXISTS_REPLACE_ADVANCED' => 'Si EmailTemplate ya existe entonces Reemplazar',
'LBL_IMPORT_IF_EMAIL_TEMPLATE_ALREADY_EXISTS_CLONE_ADVANCED' => 'Si EmailTemplate ya existe entonces Clonar',

// Import Standard Without Context
'LBL_IMPORT_WORKFLOWS_STANDARD_WITHOUT_CONTEXT' => 'Importar WFs',
'LBL_IMPORT_TITLE_STANDARD_WITHOUT_CONTEXT' => 'Importar WorkFlows Sin Contexto',
'LBL_IMPORT_STEP1_STANDARD_WITHOUT_CONTEXT' => 'Importar: Clonar WorkFlows (wfm-process->status = inactive, wfm-process->asol_domain_id = $current_user->asol_default_domain)',
'LBL_IMPORT_STANDARD_WITHOUT_CONTEXT' => 'Importar WFs',

// Import Standard In Context
'LBL_IMPORT_WORKFLOWS_STANDARD_IN_CONTEXT' => 'Importar WF',
'LBL_IMPORT_TITLE_STANDARD_IN_CONTEXT' => 'Importar WorkFlow En Contexto',
'LBL_IMPORT_STEP1_STANDARD_IN_CONTEXT' => 'Importar: Reemplazar WorkFlow (replace, keep_names, keep_status)',
'LBL_IMPORT_STANDARD_IN_CONTEXT' => 'Importar WF',

// Export
'LBL_EXPORTED_WORKFLOWS_FILENAME' => 'WorkFlows_Exportados',

// flowChart
'LBL_ASOL_REFRESH' => 'Recargar',
'LBL_ASOL_TEXT_OVERFLOW_ELLIPSIS' => 'Completar nombres',
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
'LBL_ACTIVATE_WORKFLOWS_OK' => '<b>Los WorkFlows han sido satisfactoriamente activados.</b>',
'LBL_INACTIVATE_WORKFLOWS_OK' => '<b>Los WorkFlows han sido satisfactoriamente inactivados.</b>',
'LBL_DELETE_WORKFLOWS_OK' => '<b>Los WorkFlows han sido satisfactoriamente borrados.</b>',
'LBL_IMPORT_WORKFLOWS_OK' => '<b>Los WorkFlows han sido satisfactoriamente importados.</b>',

// WORKFLOWS_BUTTON
'LBL_FLOWCHARTS_BUTTON' => 'Ver WFs',
'LBL_VALIDATE_WORKFLOWS_BUTTON' => 'Validar WFs',
'LBL_ACTIVATE_WORKFLOWS_BUTTON' => 'Activar WFs',
'LBL_INACTIVATE_WORKFLOWS_BUTTON' => 'Inactivar WFs',
'LBL_DELETE_WORKFLOWS_BUTTON' => 'Borrar WFs',
'LBL_EXPORT_WORKFLOWS_BUTTON' => 'Exportar WFs',

// WORKFLOW_BUTTON
'LBL_FLOWCHART_BUTTON' => 'Ver WF',
'LBL_VALIDATE_WORKFLOW_BUTTON' => 'Validar WF',
'LBL_ACTIVATE_WORKFLOW_BUTTON' => 'Activar WF',
'LBL_INACTIVATE_WORKFLOW_BUTTON' => 'Inactivar WF',
'LBL_DELETE_WORKFLOW_BUTTON' => 'Borrar WF',
'LBL_EXPORT_WORKFLOW_BUTTON' => 'Exportar WF',
'LBL_IMPORT_WORKFLOW_BUTTON' => 'Importar WF',
'LBL_ACTIVATE_INACTIVATE_WORKFLOW_BUTTON' => 'Act/Desact WF',

// WORKFLOW_WARNING
'LBL_ACTIVATE_WORKFLOW_WARNING' => 'WorkFlow is going to be activated. Are you sure?',
'LBL_INACTIVATE_WORKFLOW_WARNING' => 'WorkFlow is going to be inactivated. Are you sure?',
'LBL_DELETE_WORKFLOW_WARNING' => 'El WorkFlow va a ser borrado. ¿Está seguro?',
'LBL_IMPORT_WORKFLOW_WARNING' => 'El WorkFlow va a ser importado. ¿Está seguro?',

// WORKFLOWS_WARNING
'LBL_ACTIVATE_WORKFLOWS_WARNING' => 'WorkFlows are going to be activated. Are you sure?',
'LBL_INACTIVATE_WORKFLOWS_WARNING' => 'WorkFlows are going to be inactivated. Are you sure?',
'LBL_DELETE_WORKFLOWS_WARNING' => 'Los WorkFlows van a ser borrados. ¿Está seguro?',

// WORKFLOWS_PLEASE
'LBL_FLOWCHART_PLEASE' => 'Por favor, selecciona un registro para proceder.',
'LBL_VALIDATE_WORKFLOWS_PLEASE' => 'Please select at least 1 record to proceed.',
'LBL_ACTIVATE_WORKFLOWS_PLEASE' => 'Por favor, selecciona un registro para proceder.',
'LBL_INACTIVATE_WORKFLOWS_PLEASE' => 'Por favor, selecciona un registro para proceder.',
'LBL_EXPORT_WORKFLOWS_PLEASE' => 'Por favor, selecciona un registro para proceder.',
'LBL_DELETE_WORKFLOWS_PLEASE' => 'Por favor, selecciona un registro para proceder.',

// WFM Variable Generator
'LBL_WFM_VARIABLE_GENERATOR_BUTTON' => 'WFM Generador de Variables',
'LBL_CUSTOM_VARIABLE_PREDEFINED_BUTTON' => 'Añadir Custom Variables Predefinidas',
'LBL_CUSTOM_VARIABLE_USER_DEFINED_BUTTON' => 'Añadir Custom Variables Definidas por el Usuario',
'LBL_DATETIME_BUTTON' => 'Añadir Actual Datetime/Date',

// VALIDATE
'LBL_VALIDATE_TITLE' => 'Validar WorkFlows',
'LBL_VALIDATE_STEP1' => 'Paso 1: Elige validaciones.',
'LBL_VALIDATE_BUTTON' => 'Validar',
'LBL_VALIDATE_ALL' => 'Todo',
'LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE' => 'Task SendEmail referencia un existente EmailTemplate',
'LBL_VALIDATE_SEND_EMAIL_REFERENCES_EXISTING_EMAIL_TEMPLATE_ERROR' => 'Task SendEmail NO referencia un existente EmailTemplate',
'LBL_VALIDATE_WORKFLOW_IS_ACTIVE' => 'WorkFlow está activo',
'LBL_VALIDATE_LOGIC_HOOK_IS_SET' => 'Logic Hook está seteado',
'LBL_VALIDATE_VALIDATION' => 'Validación',
'LBL_VALIDATE_RESULT' => 'Resultado',
);
?>
