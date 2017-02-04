<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");

/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2011 SugarCRM Inc.
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


$app_list_strings['moduleList']['asol_Activity'] = 'Activit&eacute;';
$app_list_strings['moduleList']['asol_Events'] = 'Ev&eacute;nement';
$app_list_strings['moduleList']['asol_Process'] = 'Processus';
$app_list_strings['moduleList']['asol_Task'] = 'T&acirc;che';
$app_list_strings['moduleList']['asol_ProcessInstances'] = 'Instances du processus';
$app_list_strings['moduleList']['asol_WorkingNodes'] = 'Noeuds de travail';
$app_list_strings['moduleList']['asol_OnHold'] = 'En attente';
wfm_utils::addPremiumAppListStrings($app_list_strings, 'fr_FR', 'addAppListStrings_loginAudit');

$app_list_strings['wfm_process_status_list']['active'] = 'Actif';
$app_list_strings['wfm_process_status_list']['inactive'] = 'Inactif';
$app_list_strings['wfm_events_type_list']['start'] = 'D&eacute;marrer';
$app_list_strings['wfm_events_type_list']['intermediate'] = 'Interm&eacute;diaire';
$app_list_strings['wfm_events_type_list']['cancel'] = 'Annuler';
$app_list_strings['wfm_trigger_type_list']['logic_hook'] = 'Logic Hook';
$app_list_strings['wfm_trigger_type_list']['subprocess'] = 'Sous-processus';
$app_list_strings['wfm_task_delay_type_list']['no_delay'] = 'Pas de d&eacute;lai';
$app_list_strings['wfm_task_delay_type_list']['on_creation'] = 'En cr&eacute;ation';
$app_list_strings['wfm_task_delay_type_list']['on_modification'] = 'En modification';
$app_list_strings['wfm_task_delay_type_list']['on_finish_previous_task'] = 'En fin de la t&acirc;che pr&eacute;c&eacute;dente';
/////////////////////////////////////////////////////
$app_list_strings['wfm_task_type_list']['send_email'] = 'Envoyer un email';
//$app_list_strings['wfm_task_type_list']['assign_call'] = 'Assigner un appel';
//$app_list_strings['wfm_task_type_list']['assign_task'] = 'Assigner une t&acirc;che';
$app_list_strings['wfm_task_type_list']['php_custom'] = 'Modifier le PHP';
$app_list_strings['wfm_task_type_list']['continue'] = 'Continuer';
$app_list_strings['wfm_task_type_list']['end'] = 'Fin';
$app_list_strings['wfm_task_type_list']['create_object'] = 'Cr&eacute;er l&acute;objet';
$app_list_strings['wfm_task_type_list']['modify_object'] = 'Modifier l&acute;objet';
$app_list_strings['wfm_task_type_list']['call_process'] = 'Appeler un processus';
///////////////////////////////////////////////////////

// working_node status
$app_list_strings['wfm_working_node_status']['not_started'] = 'Not Started';
$app_list_strings['wfm_working_node_status']['executing'] = 'Executing';
$app_list_strings['wfm_working_node_status']['delayed_by_activity'] = 'Delayed By Activity';
$app_list_strings['wfm_working_node_status']['delayed_by_task'] = 'Delayed By Task';
$app_list_strings['wfm_working_node_status']['in_progress'] = 'In Progress';
$app_list_strings['wfm_working_node_status']['terminated'] = 'Terminated';
$app_list_strings['wfm_working_node_status']['held'] = 'Held';


// DISABLE AJAX-UI
$sugar_config['addAjaxBannedModules'][] = "asol_Process";
$sugar_config['addAjaxBannedModules'][] = "asol_Events";
$sugar_config['addAjaxBannedModules'][] = "asol_Activity";
$sugar_config['addAjaxBannedModules'][] = "asol_Task";
$sugar_config['addAjaxBannedModules'][] = "asol_ProcessInstances";
$sugar_config['addAjaxBannedModules'][] = "asol_WorkingNodes";
$sugar_config['addAjaxBannedModules'][] = "asol_OnHold";