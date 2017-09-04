<?php 
 //WARNING: The contents of this file are auto-generated



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



$app_list_strings['moduleList']['asol_Reports'] = 'Reports';
$sugar_config['addAjaxBannedModules'][] = "asol_Reports";




require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");

// moduleList
$app_list_strings['moduleList']['asol_Activity'] = 'WFM Activity';
$app_list_strings['moduleList']['asol_Events'] = 'WFM Event';
$app_list_strings['moduleList']['asol_Process'] = 'WFM Process';
$app_list_strings['moduleList']['asol_Task'] = 'WFM Task';
$app_list_strings['moduleList']['asol_ProcessInstances'] = 'WFM Process Instances';
$app_list_strings['moduleList']['asol_WorkingNodes'] = 'WFM Working Nodes';
$app_list_strings['moduleList']['asol_OnHold'] = 'WFM On Hold';
wfm_utils::addPremiumAppListStrings($app_list_strings, 'en_us', 'addAppListStrings_loginAudit');

// wfm_process_status_list
$app_list_strings['wfm_process_status_list']['active'] = 'Active';
$app_list_strings['wfm_process_status_list']['inactive'] = 'Inactive';

// wfm_trigger_type_list
$app_list_strings['wfm_trigger_type_list']['logic_hook'] = 'Logic Hook';
$app_list_strings['wfm_trigger_type_list']['scheduled'] = 'Scheduled';
$app_list_strings['wfm_trigger_type_list']['subprocess'] = 'Subprocess';

// wfm_trigger_event_list
$app_list_strings['wfm_trigger_event_list']['on_create'] = 'On Create';
$app_list_strings['wfm_trigger_event_list']['on_modify'] = 'On Modify';
$app_list_strings['wfm_trigger_event_list']['on_modify__before_save'] = 'On Modify Before Save';
$app_list_strings['wfm_trigger_event_list']['on_delete'] = 'On Delete';
wfm_utils::addPremiumAppListStrings($app_list_strings, 'en_us', 'addAppListStrings_loginAuditEvents');

$app_list_strings['wfm_trigger_event_list_not_users']['on_create'] = 'On Create';
$app_list_strings['wfm_trigger_event_list_not_users']['on_modify'] = 'On Modify';
$app_list_strings['wfm_trigger_event_list_not_users']['on_modify__before_save'] = 'On Modify Before Save';
$app_list_strings['wfm_trigger_event_list_not_users']['on_delete'] = 'On Delete';

// wfm_events_type_list
wfm_utils::addPremiumAppListStrings($app_list_strings, 'en_us', 'addAppListStrings_initialize');
$app_list_strings['wfm_events_type_list']['start'] = 'Start';
$app_list_strings['wfm_events_type_list']['intermediate'] = 'Intermediate';
$app_list_strings['wfm_events_type_list']['cancel'] = 'Cancel';

// wfm_scheduled_type_list
$app_list_strings['wfm_scheduled_type_list']['sequential'] = 'Sequential';
$app_list_strings['wfm_scheduled_type_list']['parallel'] = 'Parallel';

// wfm_subprocess_type_list
$app_list_strings['wfm_subprocess_type_list']['sequential'] = 'Sequential';
$app_list_strings['wfm_subprocess_type_list']['parallel'] = 'Parallel';

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
$app_list_strings['wfm_activity_type_list']['foreach_ingroup'] = 'Foreach In Group';
//$app_list_strings['wfm_activity_type_list']['foreach_inrelationship'] = 'Foreach In Relationship';

// wfm_task_delay_type_list
$app_list_strings['wfm_task_delay_type_list']['no_delay'] = 'No Delay';
$app_list_strings['wfm_task_delay_type_list']['on_creation'] = 'On Creation';
$app_list_strings['wfm_task_delay_type_list']['on_modification'] = 'On Modification';
$app_list_strings['wfm_task_delay_type_list']['on_finish_previous_task'] = 'On Finish Previous Task';

// wfm_task_type_list
$app_list_strings['wfm_task_type_list']['send_email'] = 'Send Email';
$app_list_strings['wfm_task_type_list']['php_custom'] = 'PHP Custom';
$app_list_strings['wfm_task_type_list']['continue'] = 'Continue';
$app_list_strings['wfm_task_type_list']['end'] = 'End';
$app_list_strings['wfm_task_type_list']['create_object'] = 'Create Object';
$app_list_strings['wfm_task_type_list']['modify_object'] = 'Modify Object';
$app_list_strings['wfm_task_type_list']['call_process'] = 'Call Process';
$app_list_strings['wfm_task_type_list']['add_custom_variables'] = 'Add Custom Variables';

// login_audit
$app_list_strings['wfm_login_audit_action_list']['login_failed'] = 'Login Failed';
$app_list_strings['wfm_login_audit_action_list']['after_login'] = 'Login';
$app_list_strings['wfm_login_audit_action_list']['before_logout'] = 'Logout';

// add_custom_variables_type
$app_list_strings['wfm_add_custom_variables_type']['sql'] = 'SQL';
$app_list_strings['wfm_add_custom_variables_type']['php_eval'] = 'PHP eval';
$app_list_strings['wfm_add_custom_variables_type']['literal'] = 'Literal';

// delay
$app_list_strings['wfm_delay_time']['minutes'] = 'Minutes';
$app_list_strings['wfm_delay_time']['hours'] = 'Hours';
$app_list_strings['wfm_delay_time']['days'] = 'Days';
$app_list_strings['wfm_delay_time']['weeks'] = 'Weeks';
$app_list_strings['wfm_delay_time']['months'] = 'Months';

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
$app_list_strings['wfm_working_node_type_list']['initialize'] = 'Initilialize';
$app_list_strings['wfm_working_node_type_list']['start'] = 'Start';
$app_list_strings['wfm_working_node_type_list']['intermediate'] = 'Intermediate';
$app_list_strings['wfm_working_node_type_list']['cancel'] = 'Cancel';
$app_list_strings['wfm_working_node_type_list']['subprocess'] = 'Subprocess';

// TRICK: DISABLE AJAX-UI
$sugar_config['addAjaxBannedModules'][] = "asol_Process";
$sugar_config['addAjaxBannedModules'][] = "asol_Events";
$sugar_config['addAjaxBannedModules'][] = "asol_Activity";
$sugar_config['addAjaxBannedModules'][] = "asol_Task";
$sugar_config['addAjaxBannedModules'][] = "asol_ProcessInstances";
$sugar_config['addAjaxBannedModules'][] = "asol_WorkingNodes";
$sugar_config['addAjaxBannedModules'][] = "asol_OnHold";



//THIS FILE IS AUTO GENERATED, DO NOT MODIFY
$app_list_strings['record_type_display']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';
$app_list_strings['parent_type_display']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';
$app_list_strings['record_type_display_notes']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';


//THIS FILE IS AUTO GENERATED, DO NOT MODIFY
$app_list_strings['record_type_display']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';
$app_list_strings['parent_type_display']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';
$app_list_strings['record_type_display_notes']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';

 

// letrium yura
$app_strings["LBL_EDV_SAVE"] = "save";
$app_strings["LBL_EDV_CLOSE"] = "close";
$app_strings["LBL_EDV_ACCESS_ERROR"] = "You have not an access to save.";
$app_strings["LBL_EDV_SAVING_ERROR"] = "The field has not been saved.";




/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expan_Apertura'] = 'Apertura';



/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expan_Solicitud'] = 'Solicitud';
$app_list_strings['moduleList']['Expan_Solicitud1'] = 'Solicitud';
$app_list_strings['moduleList']['Expan_Franquicia'] = 'Franquicia';
$app_list_strings['moduleList']['Expan_intermediacion_franquicia'] = 'Intermediación Franquicia';
$app_list_strings['moduleList']['Expan_chanchullo'] = 'chanchullo';
$app_list_strings['moduleList']['Expan_Consultora'] = 'Consultora';
$app_list_strings['moduleList']['Expan_Evento'] = 'Evento';
$app_list_strings['moduleList']['Expan_Documentos'] = 'Documentacion';
$app_list_strings['moduleList']['Expan_Documentacion'] = 'Documentacion';
$app_list_strings['moduleList']['Expan_Medios'] = 'Medios';
$app_list_strings['moduleList']['Expan_GestionSolicitudes'] = 'GestionSolicitudes';
$app_list_strings['perfil_fran_list']['auto'] = 'autoempleo';
$app_list_strings['perfil_fran_list']['gestor'] = 'gestor';
$app_list_strings['perfil_fran_list']['inversor'] = 'inversor';
$app_list_strings['perfil_fran_list']['Corner'] = 'Corner';
$app_list_strings['situacion_profesional_list']['Cuentaajena'] = 'Cuenta ajena';
$app_list_strings['situacion_profesional_list']['Cuentapropia'] = 'Cuenta propia';
$app_list_strings['situacion_profesional_list']['Enbusqueda'] = 'En busqueda';
$app_list_strings['cuando_empezar_list']['inmediatamente'] = 'inmediatamente';
$app_list_strings['cuando_empezar_list']['en6meses'] = 'en 6 meses';
$app_list_strings['cuando_empezar_list']['en1anoomas'] = 'en 1 año o más';
$app_list_strings['cuando_empezar_list']['alargoplazo'] = 'a largo plazo';
$app_list_strings['capital_list']['20000'] = 'menos de 20.000€';
$app_list_strings['capital_list']['50000'] = '20.000 - 50 000 €';
$app_list_strings['capital_list']['90000'] = '50.000 - 90.000 €';
$app_list_strings['capital_list']['150000'] = '90.000 - 150.000';
$app_list_strings['capital_list']['mas150000'] = 'más de 150.000 €';
$app_list_strings['capital_list']['otros'] = 'otros';
$app_list_strings['capital_list'][''] = '';
$app_list_strings['capital_list']['1'] = 'menos de 20.000€';
$app_list_strings['capital_list']['2'] = '20.000 - 50 000 €';
$app_list_strings['capital_list']['3'] = '50.000 - 90.000 €';
$app_list_strings['capital_list']['4'] = '90.000 - 150.000';
$app_list_strings['capital_list']['5'] = 'más de 150.000 €';
$app_list_strings['capital_list']['6'] = 'otros';
$app_list_strings['lst_sectores']['1'] = 'Panaderías y Pastelería';
$app_list_strings['lst_sectores']['2'] = 'Supermercados';
$app_list_strings['lst_sectores']['3'] = 'Tienda de Congelados';
$app_list_strings['lst_sectores']['4'] = 'Tienda de Vinos y licores';
$app_list_strings['lst_sectores']['5'] = 'Charcutería y carnicería';
$app_list_strings['lst_sectores']['6'] = 'Tienda Delicatesen Proyecto';
$app_list_strings['lst_sectores']['7'] = 'Tienda Frutos secos y dulces';
$app_list_strings['lst_sectores']['8'] = 'Fruterias';
$app_list_strings['lst_sectores']['9'] = 'Bares de copas y cócteles';
$app_list_strings['lst_sectores']['10'] = 'Bares de tapas y Cervecerías';
$app_list_strings['lst_sectores']['11'] = 'Cafeterías';
$app_list_strings['lst_sectores']['12'] = 'Coffee shops, Panaderías -Pastelería';
$app_list_strings['lst_sectores']['13'] = 'Heladerías y pequeños locales';
$app_list_strings['lst_sectores']['14'] = 'Restaurantes Temáticos';
$app_list_strings['lst_sectores']['15'] = 'Restaurantes';
$app_list_strings['lst_sectores']['16'] = 'Establecimientos Fast-Food';
$app_list_strings['lst_sectores']['17'] = 'Cocinas y baño';
$app_list_strings['lst_sectores']['18'] = 'Decoración hogar';
$app_list_strings['lst_sectores']['19'] = 'Muebles hogar';
$app_list_strings['lst_sectores']['20'] = 'Textil hogar';
$app_list_strings['lst_sectores']['21'] = 'tiendas de descanso';
$app_list_strings['lst_sectores']['22'] = 'Calzado y complementos';
$app_list_strings['lst_sectores']['23'] = 'Moda Deportiva y Sport';
$app_list_strings['lst_sectores']['24'] = 'Moda hombre';
$app_list_strings['lst_sectores']['25'] = 'Moda Infantil y Juvenil';
$app_list_strings['lst_sectores']['26'] = 'Moda Íntima';
$app_list_strings['lst_sectores']['27'] = 'Moda mujer';
$app_list_strings['lst_sectores']['28'] = 'Moda Nupcial';
$app_list_strings['lst_sectores']['29'] = 'Moda Unisex';
$app_list_strings['lst_sectores']['30'] = 'Alquiler y venta de vehículos';
$app_list_strings['lst_sectores']['31'] = 'Lavado del automóvil';
$app_list_strings['lst_sectores']['32'] = 'Reparación y mantenimiento automóvil';
$app_list_strings['lst_sectores']['33'] = 'Venta y mantenimiento de motocicletas';
$app_list_strings['lst_sectores']['34'] = 'Joyería-Bisutería';
$app_list_strings['lst_sectores']['35'] = 'Jugueterías, Regalos y fiesta';
$app_list_strings['lst_sectores']['36'] = 'Librerías - papelería - material oficina';
$app_list_strings['lst_sectores']['37'] = 'Tienda Artículos usados';
$app_list_strings['lst_sectores']['38'] = 'Tienda de Cigarrillos Electrónicos';
$app_list_strings['lst_sectores']['39'] = 'Tienda de Flores';
$app_list_strings['lst_sectores']['40'] = 'Tienda de Iluminación, Bricolaje, ferretería';
$app_list_strings['lst_sectores']['41'] = 'Tienda de material deportivo y de ocio';
$app_list_strings['lst_sectores']['42'] = 'Tiendas de Fotografía';
$app_list_strings['lst_sectores']['43'] = 'Tiendas de Informática - consumibles y reciclaje';
$app_list_strings['lst_sectores']['44'] = 'Tiendas de Mascotas - Animales';
$app_list_strings['lst_sectores']['45'] = 'Tiendas de perfumería y cosmética';
$app_list_strings['lst_sectores']['46'] = 'Tiendas de Precio único';
$app_list_strings['lst_sectores']['47'] = 'Tiendas de telefonía accesorios y comunicaciones';
$app_list_strings['lst_sectores']['48'] = 'Tiendas Eróticas';
$app_list_strings['lst_sectores']['49'] = 'Vending 24h';
$app_list_strings['lst_sectores']['50'] = 'Administracion de fincas';
$app_list_strings['lst_sectores']['51'] = 'Agencias Inmobiliarias';
$app_list_strings['lst_sectores']['52'] = 'Servicios de mantenimiento, reformas y construccion';
$app_list_strings['lst_sectores']['53'] = 'Academias de idiomas';
$app_list_strings['lst_sectores']['54'] = 'Actividades extraescolares y apoyo escolar';
$app_list_strings['lst_sectores']['55'] = 'Autoescuelas';
$app_list_strings['lst_sectores']['56'] = 'Guarderías y escuelas infantiles';
$app_list_strings['lst_sectores']['57'] = 'Servicios de Formación especializada';
$app_list_strings['lst_sectores']['58'] = 'Servicios de Formación profesional';
$app_list_strings['lst_sectores']['59'] = 'Actividades de ocio y tiempo libre';
$app_list_strings['lst_sectores']['60'] = 'Centros de Ocio';
$app_list_strings['lst_sectores']['61'] = 'parques infantiles';
$app_list_strings['lst_sectores']['62'] = 'Videoclubs y video cajeros';
$app_list_strings['lst_sectores']['63'] = 'gimnasios-spa-masajes';
$app_list_strings['lst_sectores']['64'] = 'Herboristerías ‐ nutrición ­ dietética';
$app_list_strings['lst_sectores']['65'] = 'Ópticas';
$app_list_strings['lst_sectores']['66'] = 'Parafarmacia';
$app_list_strings['lst_sectores']['67'] = 'Peluquerías y centros de estética';
$app_list_strings['lst_sectores']['68'] = 'Servicios médicos y dentales';
$app_list_strings['lst_sectores']['69'] = 'Agencias de empleo';
$app_list_strings['lst_sectores']['70'] = 'Agencias de Viajes';
$app_list_strings['lst_sectores']['71'] = 'Agencias Matrimoniales y sociales';
$app_list_strings['lst_sectores']['72'] = 'Compra venta oro y otros metales.';
$app_list_strings['lst_sectores']['73'] = 'Mantenimiento informático';
$app_list_strings['lst_sectores']['74'] = 'Organización de bodas y eventos sociales';
$app_list_strings['lst_sectores']['75'] = 'Servicios asistenciales a las personas';
$app_list_strings['lst_sectores']['76'] = 'Servicios Financieros y aseguradores';
$app_list_strings['lst_sectores']['77'] = 'Servicios veterinarios';
$app_list_strings['lst_sectores']['78'] = 'Sistemas de alarma y seguridad';
$app_list_strings['lst_sectores']['79'] = 'Tintorerias y limpieza';
$app_list_strings['lst_sectores']['80'] = 'Atención al cliente, call centers';
$app_list_strings['lst_sectores']['81'] = 'Comercialización, distribución y Venta';
$app_list_strings['lst_sectores']['82'] = 'Comunicación, Internet, Marketing y Publicidad';
$app_list_strings['lst_sectores']['83'] = 'Eventos, Regalos de empresa y relaciones públicas';
$app_list_strings['lst_sectores']['84'] = 'limpieza, seguridad y mantenimiento profesional e industrial';
$app_list_strings['lst_sectores']['85'] = 'Consultoria';
$app_list_strings['lst_sectores']['86'] = 'Mantenimiento informático';
$app_list_strings['lst_sectores']['87'] = 'Rotulación e impresión';
$app_list_strings['lst_sectores']['88'] = 'Transporte y Mensajería';
$app_list_strings['franquicia_list']['1'] = '2MOBILE';
$app_list_strings['franquicia_list']['2'] = 'AEROMEDIA';
$app_list_strings['franquicia_list']['3'] = 'ANTONIA BUTRÓN';
$app_list_strings['franquicia_list']['4'] = 'CANAL OCIO';
$app_list_strings['franquicia_list']['5'] = 'CATIVOS';
$app_list_strings['franquicia_list']['6'] = 'CHISPASAT';
$app_list_strings['franquicia_list']['7'] = 'CORPORANZA';
$app_list_strings['franquicia_list']['8'] = 'EASY';
$app_list_strings['franquicia_list']['9'] = 'EDUCO';
$app_list_strings['franquicia_list']['10'] = 'EH VOILA';
$app_list_strings['franquicia_list']['11'] = 'ESTVDIO';
$app_list_strings['franquicia_list']['12'] = 'FOOTPLUS';
$app_list_strings['franquicia_list']['13'] = 'HELLS';
$app_list_strings['franquicia_list']['14'] = 'HTTV Media';
$app_list_strings['franquicia_list']['15'] = 'KNACK';
$app_list_strings['franquicia_list']['16'] = 'LEDS HOME';
$app_list_strings['franquicia_list']['17'] = 'MINICALL';
$app_list_strings['franquicia_list']['18'] = 'NyN';
$app_list_strings['franquicia_list']['19'] = 'ROSCO KING';
$app_list_strings['franquicia_list']['20'] = 'VUELTA Y VUELTA';
$app_list_strings['franquicia_list']['21'] = 'WEEKEND';
$app_list_strings['franquicia_list']['1000'] = 'ENVIAR SERVICIOS';
$app_list_strings['franquicia_list']['1001'] = 'OTRAS CADENAS';
$app_list_strings['franquicia_list'][''] = '';
$app_list_strings['estado_sol_list']['1'] = '1-No Atendido';
$app_list_strings['estado_sol_list']['2'] = '2-Programada acción de seguimiento';
$app_list_strings['estado_sol_list']['3'] = '2-Programada acción de seguimiento';
$app_list_strings['estado_sol_list']['4'] = '4-No localizado';
$app_list_strings['estado_sol_list']['5'] = '5-Datos erróneos';
$app_list_strings['estado_sol_list']['6'] = '6-Descartado por nosotros';
$app_list_strings['estado_sol_list']['7'] = '7-Descartado por el candidato';
$app_list_strings['estado_sol_list']['8'] = '8-Zona de no interés';
$app_list_strings['estado_sol_list']['9'] = '9-Colaboración con franquiciador';
$app_list_strings['estado_sol_list']['10'] = '10-Franquiciado';
$app_list_strings['estado_sol_list'][''] = '';
$app_list_strings['zonas_list']['10'] = 'Resto';
$app_list_strings['actuacion_inmediata_list']['1'] = 'Ejecución de documento';
$app_list_strings['actuacion_inmediata_list']['2'] = 'Pendiente protocolo Intermediación.';
$app_list_strings['actuacion_inmediata_list']['3'] = 'Gestión externa (gestión paralela al seguimiento de la propia candidatura)';
$app_list_strings['actuacion_inmediata_list']['4'] = 'Volver a enviar documentación';
$app_list_strings['actuacion_inmediata_list'][''] = '';
$app_list_strings['perfil_plurifranquiciado_list']['1'] = 'Perfil Plurifranquiciado';
$app_list_strings['perfil_plurifranquiciado_list']['2'] = 'Capacidad Inversión Alta';
$app_list_strings['perfil_plurifranquiciado_list'][''] = '';
$app_list_strings['rating_list']['1'] = 'A+';
$app_list_strings['rating_list']['2'] = 'A';
$app_list_strings['rating_list']['3'] = 'B';
$app_list_strings['rating_list']['4'] = 'C';
$app_list_strings['rating_list'][''] = '';
$app_list_strings['expan_franquicia_type_dom'][''] = '';
$app_list_strings['expan_franquicia_type_dom']['1'] = 'Consultoría';
$app_list_strings['expan_franquicia_type_dom']['2'] = 'Intermediacion Global';
$app_list_strings['expan_franquicia_type_dom']['3'] = 'Intermedicion Sin Medios';
$app_list_strings['expan_franquicia_type_dom']['4'] = 'Medios';
$app_list_strings['expan_franquicia_type_dom']['5'] = 'No cliente';
$app_list_strings['tipo_ficha_list'][''] = '';
$app_list_strings['tipo_ficha_list']['1'] = 'Gratuita';
$app_list_strings['tipo_ficha_list']['2'] = 'Simple';
$app_list_strings['tipo_ficha_list']['3'] = 'Ampliada';
$app_list_strings['zona_list'][''] = '';
$app_list_strings['zona_list']['0'] = 'Resto';
$app_list_strings['estado_validacion_list']['1'] = 'Sin validacion';
$app_list_strings['estado_validacion_list']['2'] = 'Validado por ExpandeNegocio';
$app_list_strings['estado_validacion_list']['3'] = 'Validado por el cliente';
$app_list_strings['gestionado_por_list']['1'] = 'ExpandeNegocio';
$app_list_strings['gestionado_por_list']['2'] = 'Otros';
$app_list_strings['tipo_de_franquiciado_list'][''] = '';
$app_list_strings['tipo_de_franquiciado_list']['1'] = 'Inversor';
$app_list_strings['tipo_de_franquiciado_list']['2'] = 'Gestor';
$app_list_strings['tipo_de_franquiciado_list']['3'] = 'Autoempleo';
$app_list_strings['tipo_de_franquiciado_list']['4'] = 'Cualquiera';
$app_list_strings['necesario_titulacion_list'][''] = '';
$app_list_strings['necesario_titulacion_list']['1'] = 'Si';
$app_list_strings['necesario_titulacion_list']['2'] = 'No';
$app_list_strings['tipo_franquicia_list']['1'] = 'Sin Local';
$app_list_strings['tipo_franquicia_list']['2'] = 'Con Local';
$app_list_strings['tipo_franquicia_list']['3'] = 'Corner';
$app_list_strings['tipo_franquicia_list']['4'] = 'Cualquiera';
$app_list_strings['necesita_local_list'][''] = '';
$app_list_strings['necesita_local_list']['1'] = 'Si';
$app_list_strings['necesita_local_list']['2'] = 'No';
$app_list_strings['superficie_local_list'][''] = '';
$app_list_strings['superficie_local_list']['1'] = '';
$app_list_strings['superficie_local_list']['2'] = '25-75 m2';
$app_list_strings['entorno_ubicacion_list'][''] = '';
$app_list_strings['entorno_ubicacion_list']['1'] = 'Cualquiera';
$app_list_strings['entorno_ubicacion_list']['2'] = 'Centro Comercial';
$app_list_strings['entorno_ubicacion_list']['3'] = 'Urbana 1ª Linea';
$app_list_strings['entorno_ubicacion_list']['4'] = 'Urbana 2ª Linea';
$app_list_strings['entorno_ubicacion_list']['5'] = 'No necesario planta calle';
$app_list_strings['provincias_list'][''] = '';
$app_list_strings['provincias_list']['2'] = 'Albacete';
$app_list_strings['poblacion_minima_list'][''] = '';
$app_list_strings['poblacion_minima_list']['1'] = 'sin minimo';
$app_list_strings['poblacion_minima_list']['2'] = '';
$app_list_strings['poblacion_minima_list']['3'] = '5.000';
$app_list_strings['poblacion_minima_list']['4'] = '10.000';
$app_list_strings['poblacion_minima_list']['5'] = '15.000';
$app_list_strings['poblacion_minima_list']['6'] = '20.000';
$app_list_strings['poblacion_minima_list']['7'] = '25.000';
$app_list_strings['poblacion_minima_list']['8'] = '40.000';
$app_list_strings['poblacion_minima_list']['9'] = '50.000';
$app_list_strings['poblacion_minima_list']['10'] = '75.000';
$app_list_strings['poblacion_minima_list']['11'] = '100.000';
$app_list_strings['poblacion_minima_list']['12'] = '150.000';
$app_list_strings['poblacion_minima_list']['13'] = '200.000';
$app_list_strings['poblacion_minima_list']['14'] = '> 200.000';
$app_list_strings['personal_minimo_list'][''] = '';
$app_list_strings['personal_minimo_list']['1'] = 'Solo el franquiciado';
$app_list_strings['personal_minimo_list']['2'] = '2 personas';
$app_list_strings['personal_minimo_list']['3'] = '3 personas';
$app_list_strings['personal_minimo_list']['4'] = '4 personas';
$app_list_strings['personal_minimo_list']['5'] = '5-10 personas';
$app_list_strings['personal_minimo_list']['6'] = '> 10 personas';
$app_list_strings['booleano_list'][''] = '';
$app_list_strings['booleano_list']['1'] = 'Si';
$app_list_strings['booleano_list']['2'] = 'No';
$app_list_strings['expan_chanchullo_type_dom'][''] = '';
$app_list_strings['expan_chanchullo_type_dom']['Analyst'] = 'Analyst';
$app_list_strings['expan_chanchullo_type_dom']['Competitor'] = 'Competitor';
$app_list_strings['expan_chanchullo_type_dom']['Customer'] = 'Customer';
$app_list_strings['expan_chanchullo_type_dom']['Integrator'] = 'Integrator';
$app_list_strings['expan_chanchullo_type_dom']['Investor'] = 'Investor';
$app_list_strings['expan_chanchullo_type_dom']['Partner'] = 'Partner';
$app_list_strings['expan_chanchullo_type_dom']['Press'] = 'Press';
$app_list_strings['expan_chanchullo_type_dom']['Prospect'] = 'Prospect';
$app_list_strings['expan_chanchullo_type_dom']['Reseller'] = 'Reseller';
$app_list_strings['expan_chanchullo_type_dom']['Other'] = 'Other';
$app_list_strings['sellos_calidad_list']['1'] = 'Sello Calidad de la Franquicia';
$app_list_strings['sellos_calidad_list']['2'] = 'Calidad (ISO 9001, EFQM…)';
$app_list_strings['sellos_calidad_list']['3'] = 'Medioambiente ISO 14001';
$app_list_strings['sellos_calidad_list']['4'] = 'Q Calidad turística';
$app_list_strings['sellos_calidad_list']['5'] = 'Calidad pequeño comercio UNE 175001.';
$app_list_strings['sellos_calidad_list']['6'] = 'Seguridad alimentaria (ISO 22000, IFS, BRC…)';
$app_list_strings['sellos_calidad_list']['7'] = 'Seguridad laboral OHSAS 18001';
$app_list_strings['sellos_calidad_list']['8'] = 'Responsabilidad Social (EFR, IQNet SR10…)';
$app_list_strings['sellos_calidad_list']['0'] = 'Otros';
$app_list_strings['countries_dom'][''] = '';
$app_list_strings['countries_dom']['ABU DHABI'] = 'ABU DHABI';
$app_list_strings['countries_dom']['ADEN'] = 'ADEN';
$app_list_strings['countries_dom']['AFGHANISTAN'] = 'AFGHANISTAN';
$app_list_strings['countries_dom']['ALBANIA'] = 'ALBANIA';
$app_list_strings['countries_dom']['ALGERIA'] = 'ALGERIA';
$app_list_strings['countries_dom']['AMERICAN SAMOA'] = 'AMERICAN SAMOA';
$app_list_strings['countries_dom']['ANDORRA'] = 'ANDORRA';
$app_list_strings['countries_dom']['ANGOLA'] = 'ANGOLA';
$app_list_strings['countries_dom']['ANTARCTICA'] = 'ANTARCTICA';
$app_list_strings['countries_dom']['ANTIGUA'] = 'ANTIGUA';
$app_list_strings['countries_dom']['ARGENTINA'] = 'ARGENTINA';
$app_list_strings['countries_dom']['ARMENIA'] = 'ARMENIA';
$app_list_strings['countries_dom']['ARUBA'] = 'ARUBA';
$app_list_strings['countries_dom']['AUSTRALIA'] = 'AUSTRALIA';
$app_list_strings['countries_dom']['AUSTRIA'] = 'AUSTRIA';
$app_list_strings['countries_dom']['AZERBAIJAN'] = 'AZERBAIJAN';
$app_list_strings['countries_dom']['BAHAMAS'] = 'BAHAMAS';
$app_list_strings['countries_dom']['BAHRAIN'] = 'BAHRAIN';
$app_list_strings['countries_dom']['BANGLADESH'] = 'BANGLADESH';
$app_list_strings['countries_dom']['BARBADOS'] = 'BARBADOS';
$app_list_strings['countries_dom']['BELARUS'] = 'BELARUS';
$app_list_strings['countries_dom']['BELGIUM'] = 'BELGIUM';
$app_list_strings['countries_dom']['BELIZE'] = 'BELIZE';
$app_list_strings['countries_dom']['BENIN'] = 'BENIN';
$app_list_strings['countries_dom']['BERMUDA'] = 'BERMUDA';
$app_list_strings['countries_dom']['BHUTAN'] = 'BHUTAN';
$app_list_strings['countries_dom']['BOLIVIA'] = 'BOLIVIA';
$app_list_strings['countries_dom']['BOSNIA'] = 'BOSNIA';
$app_list_strings['countries_dom']['BOTSWANA'] = 'BOTSWANA';
$app_list_strings['countries_dom']['BOUVET ISLAND'] = 'BOUVET ISLAND';
$app_list_strings['countries_dom']['BRAZIL'] = 'BRAZIL';
$app_list_strings['countries_dom']['BRITISH ANTARCTICA TERRITORY'] = 'BRITISH ANTARCTICA TERRITORY';
$app_list_strings['countries_dom']['BRITISH INDIAN OCEAN TERRITORY'] = 'BRITISH INDIAN OCEAN TERRITORY';
$app_list_strings['countries_dom']['BRITISH VIRGIN ISLANDS'] = 'BRITISH VIRGIN ISLANDS';
$app_list_strings['countries_dom']['BRITISH WEST INDIES'] = 'BRITISH WEST INDIES';
$app_list_strings['countries_dom']['BRUNEI'] = 'BRUNEI';
$app_list_strings['countries_dom']['BULGARIA'] = 'BULGARIA';
$app_list_strings['countries_dom']['BURKINA FASO'] = 'BURKINA FASO';
$app_list_strings['countries_dom']['BURUNDI'] = 'BURUNDI';
$app_list_strings['countries_dom']['CAMBODIA'] = 'CAMBODIA';
$app_list_strings['countries_dom']['CAMEROON'] = 'CAMEROON';
$app_list_strings['countries_dom']['CANADA'] = 'CANADA';
$app_list_strings['countries_dom']['CANAL ZONE'] = 'CANAL ZONE';
$app_list_strings['countries_dom']['CANARY ISLAND'] = 'ISLAS CANARIAS';
$app_list_strings['countries_dom']['CAPE VERDI ISLANDS'] = 'CAPE VERDI ISLANDS';
$app_list_strings['countries_dom']['CAYMAN ISLANDS'] = 'ISLAS CAIMAN';
$app_list_strings['countries_dom']['CEVLON'] = 'CEVLON';
$app_list_strings['countries_dom']['CHAD'] = 'CHAD';
$app_list_strings['countries_dom']['CHANNEL ISLAND UK'] = 'CHANNEL ISLAND UK';
$app_list_strings['countries_dom']['CHILE'] = 'CHILE';
$app_list_strings['countries_dom']['CHINA'] = 'CHINA';
$app_list_strings['countries_dom']['CHRISTMAS ISLAND'] = 'CHRISTMAS ISLAND';
$app_list_strings['countries_dom']['COCOS (KEELING) ISLAND'] = 'COCOS (KEELING) ISLAND';
$app_list_strings['countries_dom']['COLOMBIA'] = 'COLOMBIA';
$app_list_strings['countries_dom']['COMORO ISLANDS'] = 'COMORO ISLANDS';
$app_list_strings['countries_dom']['CONGO'] = 'CONGO';
$app_list_strings['countries_dom']['CONGO KINSHASA'] = 'CONGO KINSHASA';
$app_list_strings['countries_dom']['COOK ISLANDS'] = 'COOK ISLANDS';
$app_list_strings['countries_dom']['COSTA RICA'] = 'COSTA RICA';
$app_list_strings['countries_dom']['CROATIA'] = 'CROACIA';
$app_list_strings['countries_dom']['CUBA'] = 'CUBA';
$app_list_strings['countries_dom']['CURACAO'] = 'CURACAO';
$app_list_strings['countries_dom']['CYPRUS'] = 'CHIPRE';
$app_list_strings['countries_dom']['CZECH REPUBLIC'] = 'REPÚBLICA CHECA';
$app_list_strings['countries_dom']['DAHOMEY'] = 'DAHOMEY';
$app_list_strings['countries_dom']['DENMARK'] = 'DINAMARCA';
$app_list_strings['countries_dom']['DJIBOUTI'] = 'YIBUTI';
$app_list_strings['countries_dom']['DOMINICA'] = 'DOMINICA';
$app_list_strings['countries_dom']['DOMINICAN REPUBLIC'] = 'REPÚBLICA DOMINICANA';
$app_list_strings['countries_dom']['DUBAI'] = 'DUBAI';
$app_list_strings['countries_dom']['ECUADOR'] = 'ECUADOR';
$app_list_strings['countries_dom']['EGYPT'] = 'EGIPTO';
$app_list_strings['countries_dom']['EL SALVADOR'] = 'EL SALVADOR';
$app_list_strings['countries_dom']['EQUATORIAL GUINEA'] = 'GUINEA ECUATORIAL';
$app_list_strings['countries_dom']['ESTONIA'] = 'ESTONIA';
$app_list_strings['countries_dom']['ETHIOPIA'] = 'ETHIOPIA';
$app_list_strings['countries_dom']['FAEROE ISLANDS'] = 'FAEROE ISLANDS';
$app_list_strings['countries_dom']['FALKLAND ISLANDS'] = 'FALKLAND ISLANDS';
$app_list_strings['countries_dom']['FIJI'] = 'FIJI';
$app_list_strings['countries_dom']['FINLAND'] = 'FINLANDIA';
$app_list_strings['countries_dom']['FRANCE'] = 'FRANCIA';
$app_list_strings['countries_dom']['FRENCH GUIANA'] = 'GUAYANA FRANCESA';
$app_list_strings['countries_dom']['FRENCH POLYNESIA'] = 'POLINESIA FRANCESA';
$app_list_strings['countries_dom']['GABON'] = 'GABON';
$app_list_strings['countries_dom']['GAMBIA'] = 'GAMBIA';
$app_list_strings['countries_dom']['GEORGIA'] = 'GEORGIA';
$app_list_strings['countries_dom']['GERMANY'] = 'ALEMANIA';
$app_list_strings['countries_dom']['GHANA'] = 'GHANA';
$app_list_strings['countries_dom']['GIBRALTAR'] = 'GIBRALTAR';
$app_list_strings['countries_dom']['GREECE'] = 'GRECIA';
$app_list_strings['countries_dom']['GREENLAND'] = 'GROENLANDIA';
$app_list_strings['countries_dom']['GUADELOUPE'] = 'GUADELOUPE';
$app_list_strings['countries_dom']['GUAM'] = 'GUAM';
$app_list_strings['countries_dom']['GUATEMALA'] = 'GUATEMALA';
$app_list_strings['countries_dom']['GUINEA'] = 'GUINEA';
$app_list_strings['countries_dom']['GUYANA'] = 'GUYANA';
$app_list_strings['countries_dom']['HAITI'] = 'HAITI';
$app_list_strings['countries_dom']['HONDURAS'] = 'HONDURAS';
$app_list_strings['countries_dom']['HONG KONG'] = 'HONG KONG';
$app_list_strings['countries_dom']['HUNGARY'] = 'HUNGRÍA';
$app_list_strings['countries_dom']['ICELAND'] = 'ISLANDIA';
$app_list_strings['countries_dom']['IFNI'] = 'IFNI';
$app_list_strings['countries_dom']['INDIA'] = 'INDIA';
$app_list_strings['countries_dom']['INDONESIA'] = 'INDONESIA';
$app_list_strings['countries_dom']['IRAN'] = 'IRAN';
$app_list_strings['countries_dom']['IRAQ'] = 'IRAQ';
$app_list_strings['countries_dom']['IRELAND'] = 'IRLANDA';
$app_list_strings['countries_dom']['ISRAEL'] = 'ISRAEL';
$app_list_strings['countries_dom']['ITALY'] = 'ITALIA';
$app_list_strings['countries_dom']['IVORY COAST'] = 'COSTA DE MARFIL';
$app_list_strings['countries_dom']['JAMAICA'] = 'JAMAICA';
$app_list_strings['countries_dom']['JAPAN'] = 'JAPON';
$app_list_strings['countries_dom']['JORDAN'] = 'JORDANIA';
$app_list_strings['countries_dom']['KAZAKHSTAN'] = 'KAZAJSTÁN';
$app_list_strings['countries_dom']['KENYA'] = 'KENIA';
$app_list_strings['countries_dom']['KOREA'] = 'KOREA';
$app_list_strings['countries_dom']['KOREA, SOUTH'] = 'COREA DEL SUR';
$app_list_strings['countries_dom']['KUWAIT'] = 'KUWAIT';
$app_list_strings['countries_dom']['KYRGYZSTAN'] = 'KIRGUISTÁN';
$app_list_strings['countries_dom']['LAOS'] = 'LAOS';
$app_list_strings['countries_dom']['LATVIA'] = 'LETONIA';
$app_list_strings['countries_dom']['LEBANON'] = 'LÍBANO';
$app_list_strings['countries_dom']['LEEWARD ISLANDS'] = 'ISLAS DE SOTAVENTO';
$app_list_strings['countries_dom']['LESOTHO'] = 'LESOTHO';
$app_list_strings['countries_dom']['LIBYA'] = 'LIBIA';
$app_list_strings['countries_dom']['LIECHTENSTEIN'] = 'LIECHTENSTEIN';
$app_list_strings['countries_dom']['LITHUANIA'] = 'LITUANIA';
$app_list_strings['countries_dom']['LUXEMBOURG'] = 'LUXEMBURGO';
$app_list_strings['countries_dom']['MACAO'] = 'MACAO';
$app_list_strings['countries_dom']['MACEDONIA'] = 'MACEDONIA';
$app_list_strings['countries_dom']['MADAGASCAR'] = 'MADAGASCAR';
$app_list_strings['countries_dom']['MALAWI'] = 'MALAWI';
$app_list_strings['countries_dom']['MALAYSIA'] = 'MALAYSIA';
$app_list_strings['countries_dom']['MALDIVES'] = 'MALDIVES';
$app_list_strings['countries_dom']['MALI'] = 'MALI';
$app_list_strings['countries_dom']['MALTA'] = 'MALTA';
$app_list_strings['countries_dom']['MARTINIQUE'] = 'MARTINIQUE';
$app_list_strings['countries_dom']['MAURITANIA'] = 'MAURITANIA';
$app_list_strings['countries_dom']['MAURITIUS'] = 'MAURITIUS';
$app_list_strings['countries_dom']['MELANESIA'] = 'MELANESIA';
$app_list_strings['countries_dom']['MEXICO'] = 'MÉXICO';
$app_list_strings['countries_dom']['MOLDOVIA'] = 'MOLDOVIA';
$app_list_strings['countries_dom']['MONACO'] = 'MONACO';
$app_list_strings['countries_dom']['MONGOLIA'] = 'MONGOLIA';
$app_list_strings['countries_dom']['MOROCCO'] = 'MARRUECOS';
$app_list_strings['countries_dom']['MOZAMBIQUE'] = 'MOZAMBIQUE';
$app_list_strings['countries_dom']['MYANAMAR'] = 'MYANAMAR';
$app_list_strings['countries_dom']['NAMIBIA'] = 'NAMIBIA';
$app_list_strings['countries_dom']['NEPAL'] = 'NEPAL';
$app_list_strings['countries_dom']['NETHERLANDS'] = 'PAÍSES BAJOS';
$app_list_strings['countries_dom']['NETHERLANDS ANTILLES'] = 'ANTILLAS HOLANDESAS';
$app_list_strings['countries_dom']['NETHERLANDS ANTILLES NEUTRAL ZONE'] = 'ANTILLAS HOLANDESAS NEUTRAL ZONE';
$app_list_strings['countries_dom']['NEW CALADONIA'] = 'NUEVA CALADONIA';
$app_list_strings['countries_dom']['NEW HEBRIDES'] = 'NEW HEBRIDES';
$app_list_strings['countries_dom']['NEW ZEALAND'] = 'NUEVA ZELANDA';
$app_list_strings['countries_dom']['NICARAGUA'] = 'NICARAGUA';
$app_list_strings['countries_dom']['NIGER'] = 'NIGER';
$app_list_strings['countries_dom']['NIGERIA'] = 'NIGERIA';
$app_list_strings['countries_dom']['NORFOLK ISLAND'] = 'ISLA NORFOLK';
$app_list_strings['countries_dom']['NORWAY'] = 'NORWAY';
$app_list_strings['countries_dom']['OMAN'] = 'OMAN';
$app_list_strings['countries_dom']['OTHER'] = 'OTHER';
$app_list_strings['countries_dom']['PACIFIC ISLAND'] = 'ISLA DEL PACIFICO';
$app_list_strings['countries_dom']['PAKISTAN'] = 'PAKISTAN';
$app_list_strings['countries_dom']['PANAMA'] = 'PANAMA';
$app_list_strings['countries_dom']['PAPUA NEW GUINEA'] = 'PAPUA NUEVA GUINEA';
$app_list_strings['countries_dom']['PARAGUAY'] = 'PARAGUAY';
$app_list_strings['countries_dom']['PERU'] = 'PERU';
$app_list_strings['countries_dom']['PHILIPPINES'] = 'FILIPINAS';
$app_list_strings['countries_dom']['POLAND'] = 'POLONIA';
$app_list_strings['countries_dom']['PORTUGAL'] = 'PORTUGAL';
$app_list_strings['countries_dom']['PORTUGUESE TIMOR'] = 'PORTUGUESE TIMOR';
$app_list_strings['countries_dom']['PUERTO RICO'] = 'PUERTO RICO';
$app_list_strings['countries_dom']['QATAR'] = 'QATAR';
$app_list_strings['countries_dom']['REPUBLIC OF BELARUS'] = 'REPÚBLICA DE BIELORRUSIA';
$app_list_strings['countries_dom']['REPUBLIC OF SOUTH AFRICA'] = 'REPÚBLICA DE SUDÁFRICA';
$app_list_strings['countries_dom']['REUNION'] = 'REUNION';
$app_list_strings['countries_dom']['ROMANIA'] = 'RUMANIA';
$app_list_strings['countries_dom']['RUSSIA'] = 'RUSIA';
$app_list_strings['countries_dom']['RWANDA'] = 'RUANDA';
$app_list_strings['countries_dom']['RYUKYU ISLANDS'] = 'RYUKYU ISLANDS';
$app_list_strings['countries_dom']['SABAH'] = 'SABAH';
$app_list_strings['countries_dom']['SAN MARINO'] = 'SAN MARINO';
$app_list_strings['countries_dom']['SAUDI ARABIA'] = 'ARABIA SAUDITA';
$app_list_strings['countries_dom']['SENEGAL'] = 'SENEGAL';
$app_list_strings['countries_dom']['SERBIA'] = 'SERBIA';
$app_list_strings['countries_dom']['SEYCHELLES'] = 'SEYCHELLES';
$app_list_strings['countries_dom']['SIERRA LEONE'] = 'SIERRA LEONE';
$app_list_strings['countries_dom']['SINGAPORE'] = 'SINGAPORE';
$app_list_strings['countries_dom']['SLOVAKIA'] = 'SLOVAKIA';
$app_list_strings['countries_dom']['SLOVENIA'] = 'SLOVENIA';
$app_list_strings['countries_dom']['SOMALILIAND'] = 'SOMALILIAND';
$app_list_strings['countries_dom']['SOUTH AFRICA'] = 'SUDÁFRICA';
$app_list_strings['countries_dom']['SOUTH YEMEN'] = 'SOUTH YEMEN';
$app_list_strings['countries_dom']['SPAIN'] = 'ESPAÑA';
$app_list_strings['countries_dom']['SPANISH SAHARA'] = 'SAHARA ESPAÑOL';
$app_list_strings['countries_dom']['SRI LANKA'] = 'SRI LANKA';
$app_list_strings['countries_dom']['ST. KITTS AND NEVIS'] = 'ST. KITTS AND NEVIS';
$app_list_strings['countries_dom']['ST. LUCIA'] = 'ST. LUCIA';
$app_list_strings['countries_dom']['SUDAN'] = 'SUDAN';
$app_list_strings['countries_dom']['SURINAM'] = 'SURINAM';
$app_list_strings['countries_dom']['SW AFRICA'] = 'SW AFRICA';
$app_list_strings['countries_dom']['SWAZILAND'] = 'SWAZILAND';
$app_list_strings['countries_dom']['SWEDEN'] = 'SUECIA';
$app_list_strings['countries_dom']['SWITZERLAND'] = 'SUIZA';
$app_list_strings['countries_dom']['SYRIA'] = 'SIRIA';
$app_list_strings['countries_dom']['TAIWAN'] = 'TAIWAN';
$app_list_strings['countries_dom']['TAJIKISTAN'] = 'TAJIKISTAN';
$app_list_strings['countries_dom']['TANZANIA'] = 'TANZANIA';
$app_list_strings['countries_dom']['THAILAND'] = 'THAILAND';
$app_list_strings['countries_dom']['TONGA'] = 'TONGA';
$app_list_strings['countries_dom']['TRINIDAD'] = 'TRINIDAD';
$app_list_strings['countries_dom']['TUNISIA'] = 'TUNISIA';
$app_list_strings['countries_dom']['TURKEY'] = 'TURKEY';
$app_list_strings['countries_dom']['UGANDA'] = 'UGANDA';
$app_list_strings['countries_dom']['UKRAINE'] = 'UCRANIA';
$app_list_strings['countries_dom']['UNITED ARAB EMIRATES'] = 'EMIRATOS ÁRABES UNIDOS';
$app_list_strings['countries_dom']['UNITED KINGDOM'] = 'REINO UNIDO';
$app_list_strings['countries_dom']['UPPER VOLTA'] = 'ALTO VOLTA';
$app_list_strings['countries_dom']['URUGUAY'] = 'URUGUAY';
$app_list_strings['countries_dom']['US PACIFIC ISLAND'] = 'EE.UU. ISLA DEL PACIFICO';
$app_list_strings['countries_dom']['US VIRGIN ISLANDS'] = 'ISLAS VÍRGENES DE EE.UU.';
$app_list_strings['countries_dom']['USA'] = 'EE.UU.';
$app_list_strings['countries_dom']['UZBEKISTAN'] = 'UZBEKISTÁN';
$app_list_strings['countries_dom']['VANUATU'] = 'VANUATU';
$app_list_strings['countries_dom']['VATICAN CITY'] = 'CIUDAD DEL VATICANO';
$app_list_strings['countries_dom']['VENEZUELA'] = 'VENEZUELA';
$app_list_strings['countries_dom']['VIETNAM'] = 'VIETNAM';
$app_list_strings['countries_dom']['WAKE ISLAND'] = 'WAKE ISLAND';
$app_list_strings['countries_dom']['WEST INDIES'] = 'ANTILLAS';
$app_list_strings['countries_dom']['WESTERN SAHARA'] = 'SAHARA OCCIDENTAL';
$app_list_strings['countries_dom']['YEMEN'] = 'YEMEN';
$app_list_strings['countries_dom']['ZAIRE'] = 'ZAIRE';
$app_list_strings['countries_dom']['ZAMBIA'] = 'ZAMBIA';
$app_list_strings['countries_dom']['ZIMBABWE'] = 'ZIMBABWE';
$app_list_strings['expan_consultora_type_dom'][''] = '';
$app_list_strings['expan_consultora_type_dom']['Analyst'] = 'Analyst';
$app_list_strings['expan_consultora_type_dom']['Competitor'] = 'Competitor';
$app_list_strings['expan_consultora_type_dom']['Customer'] = 'Customer';
$app_list_strings['expan_consultora_type_dom']['Integrator'] = 'Integrator';
$app_list_strings['expan_consultora_type_dom']['Investor'] = 'Investor';
$app_list_strings['expan_consultora_type_dom']['Partner'] = 'Partner';
$app_list_strings['expan_consultora_type_dom']['Press'] = 'Press';
$app_list_strings['expan_consultora_type_dom']['Prospect'] = 'Prospect';
$app_list_strings['expan_consultora_type_dom']['Reseller'] = 'Reseller';
$app_list_strings['expan_consultora_type_dom']['Other'] = 'Other';
$app_list_strings['estado_fran_list'][''] = '';
$app_list_strings['estado_fran_list']['1'] = '1-Presentación';
$app_list_strings['estado_fran_list']['2'] = '2-Email propuesta';
$app_list_strings['estado_fran_list']['3'] = '3-Email contrato';
$app_list_strings['estado_fran_list']['4'] = '4-Pendiente de documentacion';
$app_list_strings['estado_fran_list']['5'] = '5-Envío de contrato';
$app_list_strings['estado_fran_list']['6'] = '6-Pendiente de cuestionario';
$app_list_strings['homologacion_list'][''] = '';
$app_list_strings['homologacion_list']['1'] = 'No';
$app_list_strings['homologacion_list']['2'] = 'Si';
$app_list_strings['homologacion_list']['3'] = 'Otro Consultor';
$app_list_strings['homologacion_list']['4'] = 'No interesado';
$app_list_strings['homologacion_list']['5'] = 'En Curso';
$app_list_strings['homologacion_list']['6'] = 'Anulado';
$app_list_strings['documentacion_pendiente_list']['1'] = 'DP1';
$app_list_strings['documentacion_pendiente_list']['2'] = 'DP2';
$app_list_strings['documentacion_pendiente_list']['3'] = 'DP3';
$app_list_strings['documentacion_pendiente_list']['4'] = 'DP4';
$app_list_strings['amortizacio_inversion_list'][''] = '';
$app_list_strings['amortizacio_inversion_list']['0'] = 'Menos de un año';
$app_list_strings['amortizacio_inversion_list']['1'] = '1 año';
$app_list_strings['amortizacio_inversion_list']['2'] = '2 años';
$app_list_strings['amortizacio_inversion_list']['3'] = '3 años';
$app_list_strings['amortizacio_inversion_list']['4'] = '4 años';
$app_list_strings['amortizacio_inversion_list']['5'] = '5 años';
$app_list_strings['amortizacio_inversion_list']['6'] = 'mas de 5 años';
$app_list_strings['expan_documentacion_category_dom'][''] = '';
$app_list_strings['expan_documentacion_category_dom']['Marketing'] = 'Marketing';
$app_list_strings['expan_documentacion_category_dom']['Knowledege Base'] = 'Knowledge Base';
$app_list_strings['expan_documentacion_category_dom']['Sales'] = 'Sales';
$app_list_strings['expan_documentacion_subcategory_dom'][''] = '';
$app_list_strings['expan_documentacion_subcategory_dom']['Marketing Collateral'] = 'Marketing Collateral';
$app_list_strings['expan_documentacion_subcategory_dom']['Product Brochures'] = 'Product Brochures';
$app_list_strings['expan_documentacion_subcategory_dom']['FAQ'] = 'FAQ';
$app_list_strings['expan_documentacion_status_dom']['Active'] = 'Active';
$app_list_strings['expan_documentacion_status_dom']['Draft'] = 'Draft';
$app_list_strings['expan_documentacion_status_dom']['FAQ'] = 'FAQ';
$app_list_strings['expan_documentacion_status_dom']['Expired'] = 'Expired';
$app_list_strings['expan_documentacion_status_dom']['Under Review'] = 'Under Review';
$app_list_strings['expan_documentacion_status_dom']['Pending'] = 'Pending';
$app_list_strings['tipo_origen_list'][''] = '';
$app_list_strings['tipo_origen_list']['1'] = 'ExpandeNegocio';
$app_list_strings['tipo_origen_list']['2'] = 'Portales';
$app_list_strings['tipo_origen_list']['3'] = 'Eventos';
$app_list_strings['tipo_origen_list']['4'] = 'Central';
$app_list_strings['cargo_contacto_general_list'][''] = '';
$app_list_strings['cargo_contacto_general_list']['1'] = 'Director General';
$app_list_strings['cargo_contacto_general_list']['2'] = 'Responsable de Expansión';
$app_list_strings['cargo_contacto_general_list']['3'] = 'Responsable de Márketing';
$app_list_strings['cargo_contacto_general_list']['4'] = 'Responsable de Administración';
$app_list_strings['cargo_contacto_general_list']['5'] = 'Otro';
$app_list_strings['vigencia_contrato_list'][''] = '';
$app_list_strings['vigencia_contrato_list']['1'] = '1 Año';
$app_list_strings['vigencia_contrato_list']['2'] = '2 Años';
$app_list_strings['vigencia_contrato_list']['3'] = '3 Años';
$app_list_strings['vigencia_contrato_list']['4'] = '4 Años';
$app_list_strings['vigencia_contrato_list']['5'] = '5 Años';
$app_list_strings['vigencia_contrato_list']['6'] = '6 Años';
$app_list_strings['vigencia_contrato_list']['7'] = '7 Años';
$app_list_strings['vigencia_contrato_list']['8'] = '8 Años';
$app_list_strings['vigencia_contrato_list']['9'] = '9 Años';
$app_list_strings['vigencia_contrato_list']['10'] = '10 Años';
$app_list_strings['vigencia_contrato_list']['11'] = 'Mas de 10 Años';
$app_list_strings['vigencia_contrato_list']['12'] = 'Indefinido';
$app_list_strings['tipo_cuenta_list']['1'] = 'Consultoria';
$app_list_strings['tipo_cuenta_list']['2'] = 'Intermediación';
$app_list_strings['tipo_cuenta_list']['3'] = 'Servicios Divulgativos';
$app_list_strings['tipo_cuenta_list']['4'] = 'No Cliente';
$app_list_strings['expan_medios_type_dom'][''] = '';
$app_list_strings['expan_medios_type_dom']['Analyst'] = 'Analyst';
$app_list_strings['expan_medios_type_dom']['Competitor'] = 'Competitor';
$app_list_strings['expan_medios_type_dom']['Customer'] = 'Customer';
$app_list_strings['expan_medios_type_dom']['Integrator'] = 'Integrator';
$app_list_strings['expan_medios_type_dom']['Investor'] = 'Investor';
$app_list_strings['expan_medios_type_dom']['Partner'] = 'Partner';
$app_list_strings['expan_medios_type_dom']['Press'] = 'Press';
$app_list_strings['expan_medios_type_dom']['Prospect'] = 'Prospect';
$app_list_strings['expan_medios_type_dom']['Reseller'] = 'Reseller';
$app_list_strings['expan_medios_type_dom']['Other'] = 'Other';
$app_list_strings['temporalizacion_list'][''] = '';
$app_list_strings['temporalizacion_list']['1'] = 'Inmediatamente';
$app_list_strings['temporalizacion_list']['2'] = 'En 6 meses';
$app_list_strings['temporalizacion_list']['3'] = 'En un año o más';
$app_list_strings['temporalizacion_list']['4'] = 'A largo Plazo';


/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expan_Franquiciado'] = 'Franquiciado';



/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expan_IncidenciaCorreo'] = 'IncidenciaCorreo';


/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expin_Informes'] = 'Informes';


/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expma_Mailing'] = 'Mailing';
$app_list_strings['emailTemplates_type_list'][''] = '';
$app_list_strings['emailTemplates_type_list']['1#C1'] = '2MOBILE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['1#C2'] = '2MOBILE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['1#C3'] = '2MOBILE-Precontrato';
$app_list_strings['emailTemplates_type_list']['1#C4'] = '2MOBILE-Contrato';
$app_list_strings['emailTemplates_type_list']['46#C1'] = '69SLAM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['46#C2'] = '69SLAM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['46#C3'] = '69SLAM-Precontrato';
$app_list_strings['emailTemplates_type_list']['46#C4'] = '69SLAM-Contrato';
$app_list_strings['emailTemplates_type_list']['50#C1'] = '987 SHOP-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['50#C2'] = '987 SHOP-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['50#C3'] = '987 SHOP-Precontrato';
$app_list_strings['emailTemplates_type_list']['50#C4'] = '987 SHOP-Contrato';
$app_list_strings['emailTemplates_type_list']['2#C1'] = 'AEROMEDIA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['2#C2'] = 'AEROMEDIA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['2#C3'] = 'AEROMEDIA-Precontrato';
$app_list_strings['emailTemplates_type_list']['2#C4'] = 'AEROMEDIA-Contrato';
$app_list_strings['emailTemplates_type_list']['57#C1'] = 'ALIADA DENTAL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['57#C2'] = 'ALIADA DENTAL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['57#C3'] = 'ALIADA DENTAL-Precontrato';
$app_list_strings['emailTemplates_type_list']['57#C4'] = 'ALIADA DENTAL-Contrato';
$app_list_strings['emailTemplates_type_list']['3#C1'] = 'ANTONIA BUTRÓN-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['3#C2'] = 'ANTONIA BUTRÓN-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['3#C3'] = 'ANTONIA BUTRÓN-Precontrato';
$app_list_strings['emailTemplates_type_list']['3#C4'] = 'ANTONIA BUTRÓN-Contrato';
$app_list_strings['emailTemplates_type_list']['38#C1'] = 'AREA EMPRESARIAL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['38#C2'] = 'AREA EMPRESARIAL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['38#C3'] = 'AREA EMPRESARIAL-Precontrato';
$app_list_strings['emailTemplates_type_list']['38#C4'] = 'AREA EMPRESARIAL-Contrato';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C1'] = 'Areas PLA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C2'] = 'Areas PLA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C3'] = 'Areas PLA-Precontrato';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C4'] = 'Areas PLA-Contrato';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C1'] = 'Asesoramiento-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C2'] = 'Asesoramiento-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C3'] = 'Asesoramiento-Precontrato';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C4'] = 'Asesoramiento-Contrato';
$app_list_strings['emailTemplates_type_list']['35#C1'] = 'ATENDO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['35#C2'] = 'ATENDO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['35#C3'] = 'ATENDO-Precontrato';
$app_list_strings['emailTemplates_type_list']['35#C4'] = 'ATENDO-Contrato';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C1'] = 'Ayudas+-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C2'] = 'Ayudas+-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C3'] = 'Ayudas+-Precontrato';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C4'] = 'Ayudas+-Contrato';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C1'] = 'Bodegas Collado-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C2'] = 'Bodegas Collado-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C3'] = 'Bodegas Collado-Precontrato';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C4'] = 'Bodegas Collado-Contrato';
$app_list_strings['emailTemplates_type_list']['4#C1'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['4#C2'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['4#C3'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Precontrato';
$app_list_strings['emailTemplates_type_list']['4#C4'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Contrato';
$app_list_strings['emailTemplates_type_list']['5#C1'] = 'CATIVOS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['5#C2'] = 'CATIVOS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['5#C3'] = 'CATIVOS-Precontrato';
$app_list_strings['emailTemplates_type_list']['5#C4'] = 'CATIVOS-Contrato';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C1'] = 'Cenea-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C2'] = 'Cenea-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C3'] = 'Cenea-Precontrato';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C4'] = 'Cenea-Contrato';
$app_list_strings['emailTemplates_type_list']['6#C1'] = 'CHISPASAT-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['6#C2'] = 'CHISPASAT-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['6#C3'] = 'CHISPASAT-Precontrato';
$app_list_strings['emailTemplates_type_list']['6#C4'] = 'CHISPASAT-Contrato';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C1'] = 'Co-Equipo-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C2'] = 'Co-Equipo-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C3'] = 'Co-Equipo-Precontrato';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C4'] = 'Co-Equipo-Contrato';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C1'] = 'COGNITIVA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C2'] = 'COGNITIVA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C3'] = 'COGNITIVA-Precontrato';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C4'] = 'COGNITIVA-Contrato';
$app_list_strings['emailTemplates_type_list']['7#C1'] = 'CORPORANZA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['7#C2'] = 'CORPORANZA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['7#C3'] = 'CORPORANZA-Precontrato';
$app_list_strings['emailTemplates_type_list']['7#C4'] = 'CORPORANZA-Contrato';
$app_list_strings['emailTemplates_type_list']['49#C1'] = 'CORTICENTER-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['49#C2'] = 'CORTICENTER-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['49#C3'] = 'CORTICENTER-Precontrato';
$app_list_strings['emailTemplates_type_list']['49#C4'] = 'CORTICENTER-Contrato';
$app_list_strings['emailTemplates_type_list']['53#C1'] = 'DE SANTA ROSALIA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['53#C2'] = 'DE SANTA ROSALIA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['53#C3'] = 'DE SANTA ROSALIA-Precontrato';
$app_list_strings['emailTemplates_type_list']['53#C4'] = 'DE SANTA ROSALIA-Contrato';
$app_list_strings['emailTemplates_type_list']['34#C1'] = 'DEPIDEL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['34#C2'] = 'DEPIDEL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['34#C3'] = 'DEPIDEL-Precontrato';
$app_list_strings['emailTemplates_type_list']['34#C4'] = 'DEPIDEL-Contrato';
$app_list_strings['emailTemplates_type_list']['55#C1'] = 'DON AIRE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['55#C2'] = 'DON AIRE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['55#C3'] = 'DON AIRE-Precontrato';
$app_list_strings['emailTemplates_type_list']['55#C4'] = 'DON AIRE-Contrato';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C1'] = 'EASY-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C2'] = 'EASY-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C3'] = 'EASY-Precontrato';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C4'] = 'EASY-Contrato';
$app_list_strings['emailTemplates_type_list']['8#C1'] = 'EASYINTERNETCAFÉ-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['8#C2'] = 'EASYINTERNETCAFÉ-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['8#C3'] = 'EASYINTERNETCAFÉ-Precontrato';
$app_list_strings['emailTemplates_type_list']['8#C4'] = 'EASYINTERNETCAFÉ-Contrato';
$app_list_strings['emailTemplates_type_list']['9#C1'] = 'EDUCO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['9#C2'] = 'EDUCO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['9#C3'] = 'EDUCO-Precontrato';
$app_list_strings['emailTemplates_type_list']['9#C4'] = 'EDUCO-Contrato';
$app_list_strings['emailTemplates_type_list']['10#C1'] = 'EH VOILA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['10#C2'] = 'EH VOILA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['10#C3'] = 'EH VOILA-Precontrato';
$app_list_strings['emailTemplates_type_list']['10#C4'] = 'EH VOILA-Contrato';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C1'] = 'Electro Escultura-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C2'] = 'Electro Escultura-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C3'] = 'Electro Escultura-Precontrato';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C4'] = 'Electro Escultura-Contrato';
$app_list_strings['emailTemplates_type_list']['45#C1'] = 'ENTREMARES-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['45#C2'] = 'ENTREMARES-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['45#C3'] = 'ENTREMARES-Precontrato';
$app_list_strings['emailTemplates_type_list']['45#C4'] = 'ENTREMARES-Contrato';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C1'] = 'Entrevidrios-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C2'] = 'Entrevidrios-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C3'] = 'Entrevidrios-Precontrato';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C4'] = 'Entrevidrios-Contrato';
$app_list_strings['emailTemplates_type_list']['11#C1'] = 'ESTVDIO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['11#C2'] = 'ESTVDIO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['11#C3'] = 'ESTVDIO-Precontrato';
$app_list_strings['emailTemplates_type_list']['11#C4'] = 'ESTVDIO-Contrato';
$app_list_strings['emailTemplates_type_list']['12#C1'] = 'FOOTPLUS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['12#C2'] = 'FOOTPLUS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['12#C3'] = 'FOOTPLUS-Precontrato';
$app_list_strings['emailTemplates_type_list']['12#C4'] = 'FOOTPLUS-Contrato';
$app_list_strings['emailTemplates_type_list']['13#C1'] = 'HELLS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['13#C2'] = 'HELLS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['13#C3'] = 'HELLS-Precontrato';
$app_list_strings['emailTemplates_type_list']['13#C4'] = 'HELLS-Contrato';
$app_list_strings['emailTemplates_type_list']['40#C1'] = 'HEXAGONE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['40#C2'] = 'HEXAGONE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['40#C3'] = 'HEXAGONE-Precontrato';
$app_list_strings['emailTemplates_type_list']['40#C4'] = 'HEXAGONE-Contrato';
$app_list_strings['emailTemplates_type_list']['52#C1'] = 'HOMER-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['52#C2'] = 'HOMER-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['52#C3'] = 'HOMER-Precontrato';
$app_list_strings['emailTemplates_type_list']['52#C4'] = 'HOMER-Contrato';
$app_list_strings['emailTemplates_type_list']['14#C1'] = 'HTTV Media-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['14#C2'] = 'HTTV Media-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['14#C3'] = 'HTTV Media-Precontrato';
$app_list_strings['emailTemplates_type_list']['14#C4'] = 'HTTV Media-Contrato';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C1'] = 'IAlma3d-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C2'] = 'IAlma3d-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C3'] = 'IAlma3d-Precontrato';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C4'] = 'IAlma3d-Contrato';
$app_list_strings['emailTemplates_type_list']['31#C1'] = 'INTERFILM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['31#C2'] = 'INTERFILM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['31#C3'] = 'INTERFILM-Precontrato';
$app_list_strings['emailTemplates_type_list']['31#C4'] = 'INTERFILM-Contrato';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C1'] = 'INTERTIONAL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C2'] = 'INTERTIONAL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C3'] = 'INTERTIONAL-Precontrato';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C4'] = 'INTERTIONAL-Contrato';
$app_list_strings['emailTemplates_type_list']['37#C1'] = 'ISONOR-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['37#C2'] = 'ISONOR-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['37#C3'] = 'ISONOR-Precontrato';
$app_list_strings['emailTemplates_type_list']['37#C4'] = 'ISONOR-Contrato';
$app_list_strings['emailTemplates_type_list']['22#C1'] = 'KEEB-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['22#C2'] = 'KEEB-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['22#C3'] = 'KEEB-Precontrato';
$app_list_strings['emailTemplates_type_list']['22#C4'] = 'KEEB-Contrato';
$app_list_strings['emailTemplates_type_list']['32#C1'] = 'KIONA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['32#C2'] = 'KIONA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['32#C3'] = 'KIONA-Precontrato';
$app_list_strings['emailTemplates_type_list']['32#C4'] = 'KIONA-Contrato';
$app_list_strings['emailTemplates_type_list']['15#C1'] = 'KRACK-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['15#C2'] = 'KRACK-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['15#C3'] = 'KRACK-Precontrato';
$app_list_strings['emailTemplates_type_list']['15#C4'] = 'KRACK-Contrato';
$app_list_strings['emailTemplates_type_list']['27#C1'] = 'KRACK KIDS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['27#C2'] = 'KRACK KIDS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['27#C3'] = 'KRACK KIDS-Precontrato';
$app_list_strings['emailTemplates_type_list']['27#C4'] = 'KRACK KIDS-Contrato';
$app_list_strings['emailTemplates_type_list']['24#C1'] = 'KUCHEN HOUSE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['24#C2'] = 'KUCHEN HOUSE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['24#C3'] = 'KUCHEN HOUSE-Precontrato';
$app_list_strings['emailTemplates_type_list']['24#C4'] = 'KUCHEN HOUSE-Contrato';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C1'] = 'La Okasion-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C2'] = 'La Okasion-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C3'] = 'La Okasion-Precontrato';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C4'] = 'La Okasion-Contrato';
$app_list_strings['emailTemplates_type_list']['16#C1'] = 'LEDS HOME-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['16#C2'] = 'LEDS HOME-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['16#C3'] = 'LEDS HOME-Precontrato';
$app_list_strings['emailTemplates_type_list']['16#C4'] = 'LEDS HOME-Contrato';
$app_list_strings['emailTemplates_type_list']['58#C1'] = 'MEGAPRINT-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['58#C2'] = 'MEGAPRINT-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['58#C3'] = 'MEGAPRINT-Precontrato';
$app_list_strings['emailTemplates_type_list']['58#C4'] = 'MEGAPRINT-Contrato';
$app_list_strings['emailTemplates_type_list']['17#C1'] = 'MINICALL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['17#C2'] = 'MINICALL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['17#C3'] = 'MINICALL-Precontrato';
$app_list_strings['emailTemplates_type_list']['17#C4'] = 'MINICALL-Contrato';
$app_list_strings['emailTemplates_type_list']['41#C1'] = 'MOVILQUICK-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['41#C2'] = 'MOVILQUICK-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['41#C3'] = 'MOVILQUICK-Precontrato';
$app_list_strings['emailTemplates_type_list']['41#C4'] = 'MOVILQUICK-Contrato';
$app_list_strings['emailTemplates_type_list']['42#C1'] = 'MUCHOCARTUCHO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['42#C2'] = 'MUCHOCARTUCHO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['42#C3'] = 'MUCHOCARTUCHO-Precontrato';
$app_list_strings['emailTemplates_type_list']['42#C4'] = 'MUCHOCARTUCHO-Contrato';
$app_list_strings['emailTemplates_type_list']['25#C1'] = 'MUEBLES BOOM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['25#C2'] = 'MUEBLES BOOM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['25#C3'] = 'MUEBLES BOOM-Precontrato';
$app_list_strings['emailTemplates_type_list']['25#C4'] = 'MUEBLES BOOM-Contrato';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C1'] = 'My Lingua-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C2'] = 'My Lingua-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C3'] = 'My Lingua-Precontrato';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C4'] = 'My Lingua-Contrato';
$app_list_strings['emailTemplates_type_list']['18#C1'] = 'Negocios & Networking NyN-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['18#C2'] = 'Negocios & Networking NyN-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['18#C3'] = 'Negocios & Networking NyN-Precontrato';
$app_list_strings['emailTemplates_type_list']['18#C4'] = 'Negocios & Networking NyN-Contrato';
$app_list_strings['emailTemplates_type_list']['48#C1'] = 'NETECK-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['48#C2'] = 'NETECK-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['48#C3'] = 'NETECK-Precontrato';
$app_list_strings['emailTemplates_type_list']['48#C4'] = 'NETECK-Contrato';
$app_list_strings['emailTemplates_type_list']['26#C1'] = 'NIFTY-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['26#C2'] = 'NIFTY-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['26#C3'] = 'NIFTY-Precontrato';
$app_list_strings['emailTemplates_type_list']['26#C4'] = 'NIFTY-Contrato';
$app_list_strings['emailTemplates_type_list']['39#C1'] = 'PLAN DE EMPRESA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['39#C2'] = 'PLAN DE EMPRESA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['39#C3'] = 'PLAN DE EMPRESA-Precontrato';
$app_list_strings['emailTemplates_type_list']['39#C4'] = 'PLAN DE EMPRESA-Contrato';
$app_list_strings['emailTemplates_type_list']['43#C1'] = 'PORTALDETUCIUDAD.COM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['43#C2'] = 'PORTALDETUCIUDAD.COM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['43#C3'] = 'PORTALDETUCIUDAD.COM-Precontrato';
$app_list_strings['emailTemplates_type_list']['43#C4'] = 'PORTALDETUCIUDAD.COM-Contrato';
$app_list_strings['emailTemplates_type_list']['23#C1'] = 'RECIS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['23#C2'] = 'RECIS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['23#C3'] = 'RECIS-Precontrato';
$app_list_strings['emailTemplates_type_list']['23#C4'] = 'RECIS-Contrato';
$app_list_strings['emailTemplates_type_list']['54#C1'] = 'RECITRONICA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['54#C2'] = 'RECITRONICA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['54#C3'] = 'RECITRONICA-Precontrato';
$app_list_strings['emailTemplates_type_list']['54#C4'] = 'RECITRONICA-Contrato';
$app_list_strings['emailTemplates_type_list']['19#C1'] = 'ROSCOKING-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['19#C2'] = 'ROSCOKING-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['19#C3'] = 'ROSCOKING-Precontrato';
$app_list_strings['emailTemplates_type_list']['19#C4'] = 'ROSCOKING-Contrato';
$app_list_strings['emailTemplates_type_list']['36#C1'] = 'TAILOR & CO.-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['36#C2'] = 'TAILOR & CO.-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['36#C3'] = 'TAILOR & CO.-Precontrato';
$app_list_strings['emailTemplates_type_list']['36#C4'] = 'TAILOR & CO.-Contrato';
$app_list_strings['emailTemplates_type_list']['56#C1'] = 'TE LO PRESTO CASH-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['56#C2'] = 'TE LO PRESTO CASH-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['56#C3'] = 'TE LO PRESTO CASH-Precontrato';
$app_list_strings['emailTemplates_type_list']['56#C4'] = 'TE LO PRESTO CASH-Contrato';
$app_list_strings['emailTemplates_type_list']['33#C1'] = 'VEDING25-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['33#C2'] = 'VEDING25-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['33#C3'] = 'VEDING25-Precontrato';
$app_list_strings['emailTemplates_type_list']['33#C4'] = 'VEDING25-Contrato';
$app_list_strings['emailTemplates_type_list']['21#C1'] = 'WEEKEND-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['21#C2'] = 'WEEKEND-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['21#C3'] = 'WEEKEND-Precontrato';
$app_list_strings['emailTemplates_type_list']['21#C4'] = 'WEEKEND-Contrato';
$app_list_strings['emailTemplates_type_list']['29#C1'] = 'WEEKEND (JACK AND JONES)-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['29#C2'] = 'WEEKEND (JACK AND JONES)-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['29#C3'] = 'WEEKEND (JACK AND JONES)-Precontrato';
$app_list_strings['emailTemplates_type_list']['29#C4'] = 'WEEKEND (JACK AND JONES)-Contrato';
$app_list_strings['emailTemplates_type_list']['28#C1'] = 'WEEKEND (ONLY)-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['28#C2'] = 'WEEKEND (ONLY)-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['28#C3'] = 'WEEKEND (ONLY)-Precontrato';
$app_list_strings['emailTemplates_type_list']['28#C4'] = 'WEEKEND (ONLY)-Contrato';
$app_list_strings['emailTemplates_type_list']['51#C1'] = 'Z GENERATION-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['51#C2'] = 'Z GENERATION-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['51#C3'] = 'Z GENERATION-Precontrato';
$app_list_strings['emailTemplates_type_list']['51#C4'] = 'Z GENERATION-Contrato';


/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


$app_list_strings['moduleList']['Expma_Mailing'] = 'Mailing';
$app_list_strings['emailTemplates_type_list'][''] = '';
$app_list_strings['emailTemplates_type_list']['1#C1'] = '2MOBILE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['1#C2'] = '2MOBILE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['1#C3'] = '2MOBILE-Precontrato';
$app_list_strings['emailTemplates_type_list']['1#C4'] = '2MOBILE-Contrato';
$app_list_strings['emailTemplates_type_list']['46#C1'] = '69SLAM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['46#C2'] = '69SLAM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['46#C3'] = '69SLAM-Precontrato';
$app_list_strings['emailTemplates_type_list']['46#C4'] = '69SLAM-Contrato';
$app_list_strings['emailTemplates_type_list']['50#C1'] = '987 SHOP-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['50#C2'] = '987 SHOP-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['50#C3'] = '987 SHOP-Precontrato';
$app_list_strings['emailTemplates_type_list']['50#C4'] = '987 SHOP-Contrato';
$app_list_strings['emailTemplates_type_list']['2#C1'] = 'AEROMEDIA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['2#C2'] = 'AEROMEDIA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['2#C3'] = 'AEROMEDIA-Precontrato';
$app_list_strings['emailTemplates_type_list']['2#C4'] = 'AEROMEDIA-Contrato';
$app_list_strings['emailTemplates_type_list']['57#C1'] = 'ALIADA DENTAL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['57#C2'] = 'ALIADA DENTAL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['57#C3'] = 'ALIADA DENTAL-Precontrato';
$app_list_strings['emailTemplates_type_list']['57#C4'] = 'ALIADA DENTAL-Contrato';
$app_list_strings['emailTemplates_type_list']['3#C1'] = 'ANTONIA BUTRÓN-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['3#C2'] = 'ANTONIA BUTRÓN-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['3#C3'] = 'ANTONIA BUTRÓN-Precontrato';
$app_list_strings['emailTemplates_type_list']['3#C4'] = 'ANTONIA BUTRÓN-Contrato';
$app_list_strings['emailTemplates_type_list']['38#C1'] = 'AREA EMPRESARIAL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['38#C2'] = 'AREA EMPRESARIAL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['38#C3'] = 'AREA EMPRESARIAL-Precontrato';
$app_list_strings['emailTemplates_type_list']['38#C4'] = 'AREA EMPRESARIAL-Contrato';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C1'] = 'Areas PLA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C2'] = 'Areas PLA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C3'] = 'Areas PLA-Precontrato';
$app_list_strings['emailTemplates_type_list']['a279f2dd-f53c-67b0-161a-53c173499dcc#C4'] = 'Areas PLA-Contrato';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C1'] = 'Asesoramiento-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C2'] = 'Asesoramiento-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C3'] = 'Asesoramiento-Precontrato';
$app_list_strings['emailTemplates_type_list']['380f0dc1-e38e-83e2-8c74-53df9ab90ac1#C4'] = 'Asesoramiento-Contrato';
$app_list_strings['emailTemplates_type_list']['35#C1'] = 'ATENDO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['35#C2'] = 'ATENDO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['35#C3'] = 'ATENDO-Precontrato';
$app_list_strings['emailTemplates_type_list']['35#C4'] = 'ATENDO-Contrato';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C1'] = 'Ayudas+-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C2'] = 'Ayudas+-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C3'] = 'Ayudas+-Precontrato';
$app_list_strings['emailTemplates_type_list']['d37a0d72-1068-b77a-0dc4-53c175146c0e#C4'] = 'Ayudas+-Contrato';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C1'] = 'Bodegas Collado-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C2'] = 'Bodegas Collado-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C3'] = 'Bodegas Collado-Precontrato';
$app_list_strings['emailTemplates_type_list']['5d7fbe53-043b-fe5b-76b5-53c17302c87d#C4'] = 'Bodegas Collado-Contrato';
$app_list_strings['emailTemplates_type_list']['4#C1'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['4#C2'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['4#C3'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Precontrato';
$app_list_strings['emailTemplates_type_list']['4#C4'] = 'CANAL OCIO CINE Y VIDEOJUEGOS-Contrato';
$app_list_strings['emailTemplates_type_list']['5#C1'] = 'CATIVOS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['5#C2'] = 'CATIVOS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['5#C3'] = 'CATIVOS-Precontrato';
$app_list_strings['emailTemplates_type_list']['5#C4'] = 'CATIVOS-Contrato';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C1'] = 'Cenea-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C2'] = 'Cenea-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C3'] = 'Cenea-Precontrato';
$app_list_strings['emailTemplates_type_list']['e414cd00-6b5a-0592-6d8a-53c175586d1b#C4'] = 'Cenea-Contrato';
$app_list_strings['emailTemplates_type_list']['6#C1'] = 'CHISPASAT-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['6#C2'] = 'CHISPASAT-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['6#C3'] = 'CHISPASAT-Precontrato';
$app_list_strings['emailTemplates_type_list']['6#C4'] = 'CHISPASAT-Contrato';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C1'] = 'Co-Equipo-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C2'] = 'Co-Equipo-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C3'] = 'Co-Equipo-Precontrato';
$app_list_strings['emailTemplates_type_list']['54782a22-3dc2-9d9d-5833-53c1753ff522#C4'] = 'Co-Equipo-Contrato';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C1'] = 'COGNITIVA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C2'] = 'COGNITIVA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C3'] = 'COGNITIVA-Precontrato';
$app_list_strings['emailTemplates_type_list']['bdb94894-e51b-52ff-7aa9-543fe203064b#C4'] = 'COGNITIVA-Contrato';
$app_list_strings['emailTemplates_type_list']['7#C1'] = 'CORPORANZA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['7#C2'] = 'CORPORANZA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['7#C3'] = 'CORPORANZA-Precontrato';
$app_list_strings['emailTemplates_type_list']['7#C4'] = 'CORPORANZA-Contrato';
$app_list_strings['emailTemplates_type_list']['49#C1'] = 'CORTICENTER-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['49#C2'] = 'CORTICENTER-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['49#C3'] = 'CORTICENTER-Precontrato';
$app_list_strings['emailTemplates_type_list']['49#C4'] = 'CORTICENTER-Contrato';
$app_list_strings['emailTemplates_type_list']['53#C1'] = 'DE SANTA ROSALIA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['53#C2'] = 'DE SANTA ROSALIA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['53#C3'] = 'DE SANTA ROSALIA-Precontrato';
$app_list_strings['emailTemplates_type_list']['53#C4'] = 'DE SANTA ROSALIA-Contrato';
$app_list_strings['emailTemplates_type_list']['34#C1'] = 'DEPIDEL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['34#C2'] = 'DEPIDEL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['34#C3'] = 'DEPIDEL-Precontrato';
$app_list_strings['emailTemplates_type_list']['34#C4'] = 'DEPIDEL-Contrato';
$app_list_strings['emailTemplates_type_list']['55#C1'] = 'DON AIRE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['55#C2'] = 'DON AIRE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['55#C3'] = 'DON AIRE-Precontrato';
$app_list_strings['emailTemplates_type_list']['55#C4'] = 'DON AIRE-Contrato';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C1'] = 'EASY-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C2'] = 'EASY-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C3'] = 'EASY-Precontrato';
$app_list_strings['emailTemplates_type_list']['6dcdbf88-d019-e9c2-7ecc-53c652bfb03e#C4'] = 'EASY-Contrato';
$app_list_strings['emailTemplates_type_list']['8#C1'] = 'EASYINTERNETCAFÉ-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['8#C2'] = 'EASYINTERNETCAFÉ-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['8#C3'] = 'EASYINTERNETCAFÉ-Precontrato';
$app_list_strings['emailTemplates_type_list']['8#C4'] = 'EASYINTERNETCAFÉ-Contrato';
$app_list_strings['emailTemplates_type_list']['9#C1'] = 'EDUCO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['9#C2'] = 'EDUCO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['9#C3'] = 'EDUCO-Precontrato';
$app_list_strings['emailTemplates_type_list']['9#C4'] = 'EDUCO-Contrato';
$app_list_strings['emailTemplates_type_list']['10#C1'] = 'EH VOILA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['10#C2'] = 'EH VOILA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['10#C3'] = 'EH VOILA-Precontrato';
$app_list_strings['emailTemplates_type_list']['10#C4'] = 'EH VOILA-Contrato';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C1'] = 'Electro Escultura-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C2'] = 'Electro Escultura-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C3'] = 'Electro Escultura-Precontrato';
$app_list_strings['emailTemplates_type_list']['d3a8f24f-d171-ba4e-60e4-543b909f08e9#C4'] = 'Electro Escultura-Contrato';
$app_list_strings['emailTemplates_type_list']['45#C1'] = 'ENTREMARES-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['45#C2'] = 'ENTREMARES-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['45#C3'] = 'ENTREMARES-Precontrato';
$app_list_strings['emailTemplates_type_list']['45#C4'] = 'ENTREMARES-Contrato';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C1'] = 'Entrevidrios-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C2'] = 'Entrevidrios-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C3'] = 'Entrevidrios-Precontrato';
$app_list_strings['emailTemplates_type_list']['8c9d2af5-a3b6-a9e4-ecd4-53c175c76b8e#C4'] = 'Entrevidrios-Contrato';
$app_list_strings['emailTemplates_type_list']['11#C1'] = 'ESTVDIO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['11#C2'] = 'ESTVDIO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['11#C3'] = 'ESTVDIO-Precontrato';
$app_list_strings['emailTemplates_type_list']['11#C4'] = 'ESTVDIO-Contrato';
$app_list_strings['emailTemplates_type_list']['12#C1'] = 'FOOTPLUS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['12#C2'] = 'FOOTPLUS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['12#C3'] = 'FOOTPLUS-Precontrato';
$app_list_strings['emailTemplates_type_list']['12#C4'] = 'FOOTPLUS-Contrato';
$app_list_strings['emailTemplates_type_list']['13#C1'] = 'HELLS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['13#C2'] = 'HELLS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['13#C3'] = 'HELLS-Precontrato';
$app_list_strings['emailTemplates_type_list']['13#C4'] = 'HELLS-Contrato';
$app_list_strings['emailTemplates_type_list']['40#C1'] = 'HEXAGONE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['40#C2'] = 'HEXAGONE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['40#C3'] = 'HEXAGONE-Precontrato';
$app_list_strings['emailTemplates_type_list']['40#C4'] = 'HEXAGONE-Contrato';
$app_list_strings['emailTemplates_type_list']['52#C1'] = 'HOMER-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['52#C2'] = 'HOMER-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['52#C3'] = 'HOMER-Precontrato';
$app_list_strings['emailTemplates_type_list']['52#C4'] = 'HOMER-Contrato';
$app_list_strings['emailTemplates_type_list']['14#C1'] = 'HTTV Media-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['14#C2'] = 'HTTV Media-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['14#C3'] = 'HTTV Media-Precontrato';
$app_list_strings['emailTemplates_type_list']['14#C4'] = 'HTTV Media-Contrato';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C1'] = 'IAlma3d-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C2'] = 'IAlma3d-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C3'] = 'IAlma3d-Precontrato';
$app_list_strings['emailTemplates_type_list']['a9e67e80-2d3f-31ce-86ac-543fdf7f166e#C4'] = 'IAlma3d-Contrato';
$app_list_strings['emailTemplates_type_list']['31#C1'] = 'INTERFILM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['31#C2'] = 'INTERFILM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['31#C3'] = 'INTERFILM-Precontrato';
$app_list_strings['emailTemplates_type_list']['31#C4'] = 'INTERFILM-Contrato';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C1'] = 'INTERTIONAL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C2'] = 'INTERTIONAL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C3'] = 'INTERTIONAL-Precontrato';
$app_list_strings['emailTemplates_type_list']['830a045f-e5c6-bc51-a117-53c17426e002#C4'] = 'INTERTIONAL-Contrato';
$app_list_strings['emailTemplates_type_list']['37#C1'] = 'ISONOR-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['37#C2'] = 'ISONOR-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['37#C3'] = 'ISONOR-Precontrato';
$app_list_strings['emailTemplates_type_list']['37#C4'] = 'ISONOR-Contrato';
$app_list_strings['emailTemplates_type_list']['22#C1'] = 'KEEB-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['22#C2'] = 'KEEB-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['22#C3'] = 'KEEB-Precontrato';
$app_list_strings['emailTemplates_type_list']['22#C4'] = 'KEEB-Contrato';
$app_list_strings['emailTemplates_type_list']['32#C1'] = 'KIONA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['32#C2'] = 'KIONA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['32#C3'] = 'KIONA-Precontrato';
$app_list_strings['emailTemplates_type_list']['32#C4'] = 'KIONA-Contrato';
$app_list_strings['emailTemplates_type_list']['15#C1'] = 'KRACK-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['15#C2'] = 'KRACK-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['15#C3'] = 'KRACK-Precontrato';
$app_list_strings['emailTemplates_type_list']['15#C4'] = 'KRACK-Contrato';
$app_list_strings['emailTemplates_type_list']['27#C1'] = 'KRACK KIDS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['27#C2'] = 'KRACK KIDS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['27#C3'] = 'KRACK KIDS-Precontrato';
$app_list_strings['emailTemplates_type_list']['27#C4'] = 'KRACK KIDS-Contrato';
$app_list_strings['emailTemplates_type_list']['24#C1'] = 'KUCHEN HOUSE-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['24#C2'] = 'KUCHEN HOUSE-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['24#C3'] = 'KUCHEN HOUSE-Precontrato';
$app_list_strings['emailTemplates_type_list']['24#C4'] = 'KUCHEN HOUSE-Contrato';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C1'] = 'La Okasion-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C2'] = 'La Okasion-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C3'] = 'La Okasion-Precontrato';
$app_list_strings['emailTemplates_type_list']['c807b99e-d8b2-6691-2c78-53c1744178b0#C4'] = 'La Okasion-Contrato';
$app_list_strings['emailTemplates_type_list']['16#C1'] = 'LEDS HOME-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['16#C2'] = 'LEDS HOME-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['16#C3'] = 'LEDS HOME-Precontrato';
$app_list_strings['emailTemplates_type_list']['16#C4'] = 'LEDS HOME-Contrato';
$app_list_strings['emailTemplates_type_list']['58#C1'] = 'MEGAPRINT-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['58#C2'] = 'MEGAPRINT-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['58#C3'] = 'MEGAPRINT-Precontrato';
$app_list_strings['emailTemplates_type_list']['58#C4'] = 'MEGAPRINT-Contrato';
$app_list_strings['emailTemplates_type_list']['17#C1'] = 'MINICALL-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['17#C2'] = 'MINICALL-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['17#C3'] = 'MINICALL-Precontrato';
$app_list_strings['emailTemplates_type_list']['17#C4'] = 'MINICALL-Contrato';
$app_list_strings['emailTemplates_type_list']['41#C1'] = 'MOVILQUICK-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['41#C2'] = 'MOVILQUICK-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['41#C3'] = 'MOVILQUICK-Precontrato';
$app_list_strings['emailTemplates_type_list']['41#C4'] = 'MOVILQUICK-Contrato';
$app_list_strings['emailTemplates_type_list']['42#C1'] = 'MUCHOCARTUCHO-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['42#C2'] = 'MUCHOCARTUCHO-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['42#C3'] = 'MUCHOCARTUCHO-Precontrato';
$app_list_strings['emailTemplates_type_list']['42#C4'] = 'MUCHOCARTUCHO-Contrato';
$app_list_strings['emailTemplates_type_list']['25#C1'] = 'MUEBLES BOOM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['25#C2'] = 'MUEBLES BOOM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['25#C3'] = 'MUEBLES BOOM-Precontrato';
$app_list_strings['emailTemplates_type_list']['25#C4'] = 'MUEBLES BOOM-Contrato';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C1'] = 'My Lingua-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C2'] = 'My Lingua-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C3'] = 'My Lingua-Precontrato';
$app_list_strings['emailTemplates_type_list']['def31a11-947c-f945-23e0-53c1666993c5#C4'] = 'My Lingua-Contrato';
$app_list_strings['emailTemplates_type_list']['18#C1'] = 'Negocios & Networking NyN-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['18#C2'] = 'Negocios & Networking NyN-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['18#C3'] = 'Negocios & Networking NyN-Precontrato';
$app_list_strings['emailTemplates_type_list']['18#C4'] = 'Negocios & Networking NyN-Contrato';
$app_list_strings['emailTemplates_type_list']['48#C1'] = 'NETECK-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['48#C2'] = 'NETECK-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['48#C3'] = 'NETECK-Precontrato';
$app_list_strings['emailTemplates_type_list']['48#C4'] = 'NETECK-Contrato';
$app_list_strings['emailTemplates_type_list']['26#C1'] = 'NIFTY-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['26#C2'] = 'NIFTY-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['26#C3'] = 'NIFTY-Precontrato';
$app_list_strings['emailTemplates_type_list']['26#C4'] = 'NIFTY-Contrato';
$app_list_strings['emailTemplates_type_list']['39#C1'] = 'PLAN DE EMPRESA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['39#C2'] = 'PLAN DE EMPRESA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['39#C3'] = 'PLAN DE EMPRESA-Precontrato';
$app_list_strings['emailTemplates_type_list']['39#C4'] = 'PLAN DE EMPRESA-Contrato';
$app_list_strings['emailTemplates_type_list']['43#C1'] = 'PORTALDETUCIUDAD.COM-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['43#C2'] = 'PORTALDETUCIUDAD.COM-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['43#C3'] = 'PORTALDETUCIUDAD.COM-Precontrato';
$app_list_strings['emailTemplates_type_list']['43#C4'] = 'PORTALDETUCIUDAD.COM-Contrato';
$app_list_strings['emailTemplates_type_list']['23#C1'] = 'RECIS-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['23#C2'] = 'RECIS-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['23#C3'] = 'RECIS-Precontrato';
$app_list_strings['emailTemplates_type_list']['23#C4'] = 'RECIS-Contrato';
$app_list_strings['emailTemplates_type_list']['54#C1'] = 'RECITRONICA-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['54#C2'] = 'RECITRONICA-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['54#C3'] = 'RECITRONICA-Precontrato';
$app_list_strings['emailTemplates_type_list']['54#C4'] = 'RECITRONICA-Contrato';
$app_list_strings['emailTemplates_type_list']['19#C1'] = 'ROSCOKING-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['19#C2'] = 'ROSCOKING-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['19#C3'] = 'ROSCOKING-Precontrato';
$app_list_strings['emailTemplates_type_list']['19#C4'] = 'ROSCOKING-Contrato';
$app_list_strings['emailTemplates_type_list']['36#C1'] = 'TAILOR & CO.-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['36#C2'] = 'TAILOR & CO.-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['36#C3'] = 'TAILOR & CO.-Precontrato';
$app_list_strings['emailTemplates_type_list']['36#C4'] = 'TAILOR & CO.-Contrato';
$app_list_strings['emailTemplates_type_list']['56#C1'] = 'TE LO PRESTO CASH-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['56#C2'] = 'TE LO PRESTO CASH-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['56#C3'] = 'TE LO PRESTO CASH-Precontrato';
$app_list_strings['emailTemplates_type_list']['56#C4'] = 'TE LO PRESTO CASH-Contrato';
$app_list_strings['emailTemplates_type_list']['33#C1'] = 'VEDING25-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['33#C2'] = 'VEDING25-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['33#C3'] = 'VEDING25-Precontrato';
$app_list_strings['emailTemplates_type_list']['33#C4'] = 'VEDING25-Contrato';
$app_list_strings['emailTemplates_type_list']['21#C1'] = 'WEEKEND-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['21#C2'] = 'WEEKEND-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['21#C3'] = 'WEEKEND-Precontrato';
$app_list_strings['emailTemplates_type_list']['21#C4'] = 'WEEKEND-Contrato';
$app_list_strings['emailTemplates_type_list']['29#C1'] = 'WEEKEND (JACK AND JONES)-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['29#C2'] = 'WEEKEND (JACK AND JONES)-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['29#C3'] = 'WEEKEND (JACK AND JONES)-Precontrato';
$app_list_strings['emailTemplates_type_list']['29#C4'] = 'WEEKEND (JACK AND JONES)-Contrato';
$app_list_strings['emailTemplates_type_list']['28#C1'] = 'WEEKEND (ONLY)-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['28#C2'] = 'WEEKEND (ONLY)-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['28#C3'] = 'WEEKEND (ONLY)-Precontrato';
$app_list_strings['emailTemplates_type_list']['28#C4'] = 'WEEKEND (ONLY)-Contrato';
$app_list_strings['emailTemplates_type_list']['51#C1'] = 'Z GENERATION-Informacion Inicial';
$app_list_strings['emailTemplates_type_list']['51#C2'] = 'Z GENERATION-Informacion Adicional';
$app_list_strings['emailTemplates_type_list']['51#C3'] = 'Z GENERATION-Precontrato';
$app_list_strings['emailTemplates_type_list']['51#C4'] = 'Z GENERATION-Contrato';



/*******************************************************************************
 * This file is integral part of the project "Extension Manager" for SugarCRM.
 * 
 * "Extension Manager" is a project created by: 
 * Dispage - Patrizio Gelosi
 * Via A. De Gasperi 91 
 * P. Potenza Picena (MC) - Italy
 * 
 * (Hereby referred to as "DISPAGE")
 * 
 * Copyright (c) 2010-2012 DISPAGE.
 * 
 * The contents of this file are released under the GNU General Public License
 * version 3 as published by the Free Software Foundation that can be found on
 * the "LICENSE.txt" file which is integral part of the SUGARCRM(TM) project. If
 * the file is not present, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You may not use the present file except in compliance with the License.
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied.  See the License
 * for the specific language governing rights and limitations under the
 * License.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * Dispage" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by Dispage".
 * 
 ******************************************************************************/

$app_strings['LBL_DISPAGE_MANAGER'] = array_merge((array)@$app_strings['LBL_DISPAGE_MANAGER'], array(
	'LBL_INSTALLED_PACKAGE' => 'Extension "%s" has been installed successfully.',
	'LBL_UNINSTALLED_PACKAGE' => 'Extension "%s" has been uninstalled successfully.',
	'LBL_ERROR_ADDING_USER_OBJECT' => '#0434: User Limit for a development installation exceeded.',
	'LBL_ERROR_LICENSE_SENT_OBJECT' => '#0435: Error checking serial number.',
	'LBL_ERROR_VERSION_NOT_FOUND_OBJECT' => '#0436: Extension version not found.',
	'LBL_ERROR_DEMO_USER_ACTIVATED_OBJECT' => '#0437: A Demo version has been already activated by this Dispage user.',
	'LBL_ERROR_DEMO_KEY_ACTIVATED_OBJECT' => '#0438: A Demo version has been already activated for this SugarCRM installation.',
	'LBL_ERROR_GENERATING_SERIAL_OBJECT' => '#0439: Error generating serial.',
	'LBL_UNINSTALLED_WITH_ERROR_OBJECT' => '#0420: Error uninstalling Extension',
	'LBL_UNABLE_TO_CONNECT_OBJECT' => '"#0423: Cannot connect to the Dispage Resource Center',
	'LBL_EMPTY_RESPONSE_OBJECT' => '#0424: Empty response from the server',
	'LBL_UNINSTALLED_SUCCESSFULLY_OBJECT' => 'Extension uninstalled',
));
$app_strings['LBL_DISPAGE_MANAGER_EXTENSION'] = array(
	'LBL_INSTALL_CONFIRM' => 'Before installing the Extension, the following terms must be entirely read, understood and accepted.',
	'LBL_UNINSTALL_ALL_MSG' => 'Dependency Exception:<br/>The following Extensions must be uninstalled before uninstalling this one:',
	'LBL_INSTALL_ALL_MSG' => 'Dependency Exception:<br/>The following Extensions must be installed/upgraded before installing this one:',
	'LBL_INSTALL_ALL_MSG_VERSION' => ' (current ver.:',
	'LBL_SELECT_ONE_EXTENSION' => 'Select at least one Extension',
	'LBL_SELECT_ONE_INSTALL_EXTENSION' => 'Select at least one Extension not yet installed',
	'LBL_UNINSTALL_CONFIRM' => 'Confirm Extension uninstallation?',
	'LBL_UNINSTALL_MULTIPLE_CONFIRM' => 'Confirm uninstallation of multiple Extensions?',
	'LBL_INSTALL_MULTIPLE_CONFIRM' => 'Confirm installation of multiple Extensions?',
	'LBL_REPAIR_CONFIRM' => 'Confirm <b>Repair</b> action for the selected Extension?',
	'LBL_UNINSTALL_NO_COMPATIBILITY' => 'Selected package is not compatible with the running SugarCRM version.',
);

$app_strings['LBL_DISPAGE_MANAGER_WELCOME'] = array_merge((array)@$app_strings['LBL_DISPAGE_MANAGER_WELCOME'], array(
	'WarnMsgNotConnected' => "Extension Manager Disconnected. ",
	'WarnMsgReconnect' => "<a href=\"javascript:document.location.href = EMAddURIParameter('disable_em', '0'),\">Click here</a> to reconnect.",

	'warnTextEmpty' => "Please enter a value",
	'connectingHeader' => "Dispage Extension Manager - Powered by <a href='http://www.dispage.com' target='_blank'>Dispage</a>",
	'connectingMsg' => "Connecting to Dispage",
	'synhronizingMsg' => "Synchronizing Extensions",
	'downloadingMsg' => "Downloading ",
	'enterSerialTooltip' => "The <b>activation serial code</b> is a unique 16-character code which a dispage registered user can obtain to activate <b>DEMO</b> and <b>FULL (PAID)</b> extensions.<br/><a class='em-external-link' id='em-purchase-link-tooltip' href='javascript:instConsole.submitBuyFull();'>Click here</a> to purchase the <b>FULL</b> version of the extension.<br/>Serial keys can be managed from <a class='em-external-link' href='javascript:instConsole.submitManageLic();'>this page</a>.",
	'enterSerialMsg' => "Enter the activation serial code",
	'retrievingSerialMsg' => "Retrieving demo activation serial code",
	'newSerialMsg' => "Serial code retrieved:",
	'currentSerialMsg' => "Serial code registered:",
	'forToken' => " for",
	'checkingSerialMsg' => "Checking the activation serial code",
	'checkedSerialMsg' => "The activation serial code is valid for the extension.",
	'selectExtVersion1' => "Extension version <b>",
	'selectExtVersion2' => "</b> is no longer available.<br/>Select a new version to install:",
	'selectExtVersionTooltip1' => "If an extension version is no longer supported in its new releases, a new version must be selected from the ones available.<br/><a href='",
	'selectExtVersionTooltip2' => "' target='_blank'>Click here</a> to check the different features of all the available versions.",
	'selectEnvironment' => "Select the environment for this SugarCRM installation",
	'currentEnvironment' => "Current environment",
	'environmentTooltip' => "It is essential to assign an <a href='http://www.dispage.com/wiki/Environment_selection' target='_blank'>environment</a> to each SugarCRM installation running a <b>FULL</b> or a <b>DEMO</b> extension.",
	'environmentProduction' => "Production",
	'environmentDevelopment' => "Development",
	'upgradeButtonDEMO' => "Try DEMO Version",
	'upgradeButtonPAID' => "Buy FULL Version",
	'serialButton' => "Change Serial Code",
	'installingMsg' => "Installing Extension ",
	'validatingMsg' => "Validating Installation",
	'updateCompleteMsg' => "Update Complete",
	'sendInstallRequestMsg' => "Sending Installation Request",
	'uninstallingMsg' => "Uninstalling ",
	'installQuestion' => "The following extension will be installed / upgraded:",
	'confirmInstallation' => "Do you want to proceed?",

	'noPackageFound' => "All the Extensions are updated",
	'noAdminConnectionComplete' => "Extensions activated",

	'doneMsg' => "Done",
	'ErrorMsg' => "Error",

	'ErrorMsgTable' => array(
		'Invalid_password' => "#0405: Invalid Password.",
		'User_does_not_exist' => "#0406: Unknown User ID.",
		'Session_error' => "#0407: Remote session has expired.<br/><a href=\"javascript:document.location.href = EMAddURIParameter('disable_em', '0');\">Click here</a> to reconnect.",
		'Not_connected' => "#0408: Extension Manager disconnected.",
		'Invalid_action' => "#0409: Connection Refused.",
		'Unable_authenticate' => "#0410: Unable to authenticate to Dispage.<br/>Extension Manager disconnected. ",
		'Connection_unsaved' => "#0411: Unable to authenticate to Dispage.<br/>Extension Manager disconnected. ",
		'Extension_not_found' => "#0412: Extension not available for this Sugar version/edition",
		'Post_return_error' => "#0413: Error in server response",
		'License_link_error' => "#0422: Error retreiving the License Link",
		'Error_retrieving_serial' => "#0440: Error retreiving a valid serial. ",
	),

	'WarningLoginOptionEmpty' => "Please fill both the username and password fields.",
	'WarningCheckLicenseAgreement' => "The extension cannot be installed without giving the explicit consent to the License Agreement.",
	'WarningValidationFile1' => "Warning: browser cannot open following resources",
	'WarningValidationFile2' => "The extension may not work until all the resources are correctly accessed to.",

	'welcomeMsg' => "
<table>
	<tr>
		<td width=\"20%\"'>Username:</td>
		<td class=\"em-input-row\" width=\"80%\">
			<input class=\"em-login-field\" type=\"text\" name=\"emuser\" autocomplete=\"off\" size=\"15\" />
		<td/>
	</tr>
	<tr>
		<td>Password:</td>
		<td>
			<input class=\"em-login-field\" type=\"password\" name=\"empwd\" autocomplete=\"off\" size=\"15\" />
		<td/>
	</tr>
	<tr>
		<td colspan=\"2\" style=\"padding-top:10px\">
			<input type=\"checkbox\" name=\"emautologin\" value=\"1\"/>&nbsp;Log in automatically next time.
		</td>
	</tr>
	<tr>
		<td colspan=\"2\">
			<div class='em-panel2-container'>
				<div class='em-helper-container'>
					<div class='em-question-point em-login-point'></div>
					<div class='em-register-point'>
						Sign on at the <a target=\"_blank\" href=\"http://www.dispage.com/index.php?option=com_comprofiler&task=registers\">Dispage Extension Service</a>.
						<div class='em-helpers' maxheight='54px'>
							New to the Extension Manager Services ?<br/>
							<b>The first step is to free register at the <a target=\"_blank\" href=\"http://www.dispage.com/index.php?option=com_comprofiler&task=registers\">Dispage Extension Service</a>.
							Then you have to log in and will be guided through the following steps.</b>
						</div>
					</div>
				</div>
				<div class='em-helper-container'>
					<div class='em-question-point em-login-point'></div>
					<div class='em-register-point'>
						Ask for a password reset at <a target=\"_blank\" href=\"http://www.dispage.com/index.php?option=com_comprofiler&task=lostPassword\">this link</a>.
						<div class='em-helpers' maxheight='25px'>
							Have an account, but you don't remember the password?<br/>
							<b>You can ask for a password reset at <a target=\"_blank\" href=\"http://www.dispage.com/index.php?option=com_user&view=reset\">this link</a></b>
						</div>
					</div>
				</div>
				<div class='em-helper-container'>
					<div class='em-question-point em-login-point'></div>
					<div class='em-register-point'>
						<a target=\"_blank\" href=\"http://www.sugarforge.org/frs/download.php/6306/privacy.txt\">Privacy Policy</a>.
						<div class='em-helpers' maxheight='25px'>
							To find out which data will be transmitted to Dispage from your SugarCRM installation, follow <a target=\"_blank\" href=\"http://www.sugarforge.org/frs/download.php/6306/privacy.txt\">this link</a>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>",
));


 // End of _dom files

 
$app_list_strings['moduleList']['KReports'] = 'KReports v3.0';

$app_list_strings['kreportstatus'] = array(
	'1' => 'draft',
	'2' => 'limited release',
	'3' => 'general release'
);



$app_strings['LBL_DEVTOOLKIT_MESSAGE_DUPLICATE_FIELD'] = 'Duplicate value';
$app_strings['ERR_DEVTOOLKIT_QUERY_DUPLICATE_FIELD'] = 'Error retrieving unique fields for DevToolKit Duplicate Fields extension: ';


 

$app_strings['LBL_GANTT_BUTTON_LABEL'] = 'Gantt';
$app_strings['LBL_GANTT_BUTTON_TITLE'] = 'View Gantt';



$app_list_strings['moduleList']['SYNO_Reports'] = 'SYNOLIA Reports';

$app_list_strings['syno_reports_type'] = array(
    'normal'  => 'Normal',
    'matrix'  => 'Matrix',
);



$app_list_strings['moduleList']['zr2_ReportParameter'] = 'Report Parameter';
$app_list_strings['moduleList']['zr2_ReportTemplate'] = 'JasperReports Template';
$app_list_strings['moduleList']['zr2_QueryTemplate'] = 'Query Template';
$app_list_strings['moduleList']['zr2_ReportParameterLink'] = 'Parameter Bindings';
$app_list_strings['moduleList']['zr2_Report'] = 'ZuckerReports';
$app_list_strings['moduleList']['zr2_ReportContainer'] = 'Report Archive';

$app_list_strings['PARAM_RANGE_TYPES']['SIMPLE'] = 'Direct Input';
$app_list_strings['PARAM_RANGE_TYPES']['DATE'] = 'Date Input';
$app_list_strings['PARAM_RANGE_TYPES']['DATE_NOW'] = 'Current Time and Date';
$app_list_strings['PARAM_RANGE_TYPES']['DATE_ADD'] = 'Future Timestamp';
$app_list_strings['PARAM_RANGE_TYPES']['DATE_SUB'] = 'Past Timestamp';
$app_list_strings['PARAM_RANGE_TYPES']['SQL'] = 'User-Defined Query';
$app_list_strings['PARAM_RANGE_TYPES']['LIST'] = 'User-Defined List';
$app_list_strings['PARAM_RANGE_TYPES']['DROPDOWN'] = 'Drop-Down List';
$app_list_strings['PARAM_RANGE_TYPES']['CURRENT_USER'] = 'Current User';
$app_list_strings['PARAM_RANGE_TYPES']['SCRIPT'] = 'PHP Script';
$app_list_strings['PARAM_DATE_TYPES']['MINUTE'] = 'Minute(s)';
$app_list_strings['PARAM_DATE_TYPES']['HOUR'] = 'Hour(s)';
$app_list_strings['PARAM_DATE_TYPES']['DAY'] = 'Day(s)';
$app_list_strings['PARAM_DATE_TYPES']['WEEK'] = 'Week(s)';
$app_list_strings['PARAM_DATE_TYPES']['MONTH'] = 'Month(s)';
$app_list_strings['PARAM_DATE_TYPES']['YEAR'] = 'Year(s)';



?>