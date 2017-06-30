<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

/*********************************************************************************

 * Description:  Defines the English language pack for the base application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$entry_point_registry = array(
	'viewReport' => array('file' => 'modules/asol_Reports/DetailView.php', 'auth' => false),
	'reloadReport' => array('file' => 'modules/asol_Reports/DetailView.php', 'auth' => true),
	'scheduledTask' => array('file' => 'modules/asol_Reports/scheduledTask.php', 'auth' => false),
	'reportCleanUp' => array('file' => 'modules/asol_Reports/cleanUp.php', 'auth' => false),
	'vRender' => array('file' => 'modules/asol_Reports/vRender.php', 'auth' => false),
	'reportPopup' => array('file' => 'modules/asol_Reports/reportPopup.php', 'auth' => false),
	'reportDownload' => array('file' => 'modules/asol_Reports/reportDownload.php', 'auth' => false),
	'reportGenerateHtml' => array('file' => 'modules/asol_Reports/generateHTML.php', 'auth' => true),
	'scheduledStoredReport' => array('file' => 'modules/asol_Reports/scheduledEmailReport.php', 'auth' => true),
	'scheduledEmailReport' => array('file' => 'modules/asol_Reports/scheduledEmailReport.php', 'auth' => false),
	'asol_CheckHttpFileExists' => array('file' => 'modules/asol_Reports/CheckHttpFileExists.php', 'auth' => false),
	'reportVariableGenerator' => array('file' => 'modules/asol_Reports/variableGenerator.php', 'auth' => true),
	'ganttServerCanEditMode' => array('file' => 'modules/asol_Project/resources/jQueryGantt-master/server/ganttServerCanEditMode.php', 'auth' => true),
	'ganttServer' => array('file' => 'modules/asol_Project/resources/jQueryGantt-master/server/ganttServer.php', 'auth' => false),
	'wfm_engine' => array('file' => 'modules/asol_Process/workFlowManagerEngine.php', 'auth' => false),
	'wfm_export_workflows' => array('file' => 'modules/asol_Process/export_workflows.php', 'auth' => false),
	'wfm_flowChart' => array('file' => 'modules/asol_Process/_flowChart/flowChart3.php', 'auth' => true),
	'wfm_scheduled_task' => array('file' => 'modules/asol_Process/scheduledTask.php', 'auth' => false),
	'wfm_variable_generator' => array('file' => 'modules/asol_Process/___common_WFM_premium/php/wfm_variable_generator.php', 'auth' => true),
	'emailImage' => array('file' => 'modules/EmailMan/EmailImage.php', 'auth' => false),
	'download' => array('file' => 'download.php', 'auth' => true),
	'export' => array('file' => 'export.php', 'auth' => true),
	'export_dataset' => array('file' => 'export_dataset.php', 'auth' => true),
	'Changenewpassword' => array('file' => 'modules/Users/Changenewpassword.php', 'auth' => false),
	'GeneratePassword' => array('file' => 'modules/Users/GeneratePassword.php', 'auth' => false),
	'vCard' => array('file' => 'vCard.php', 'auth' => true),
	'pdf' => array('file' => 'pdf.php', 'auth' => true),
	'minify' => array('file' => 'jssource/minify.php', 'auth' => true),
    'json_server' => array('file' => 'json_server.php', 'auth' => true),
    'get_url' => array('file' => 'get_url.php', 'auth' => true),
	'HandleAjaxCall' => array('file' => 'HandleAjaxCall.php', 'auth' => true),
	'TreeData' => array('file' => 'TreeData.php', 'auth' => true),
    'image' => array('file' => 'modules/Campaigns/image.php', 'auth' => false),
    'campaign_trackerv2' => array('file' => 'modules/Campaigns/Tracker.php', 'auth' => false),
    'WebToLeadCapture' => array('file' => 'modules/Campaigns/WebToLeadCapture.php', 'auth' => false),
    'removeme' => array('file' => 'modules/Campaigns/RemoveMe.php', 'auth' => false),
    'acceptDecline' => array('file' => 'modules/Contacts/AcceptDecline.php', 'auth' => false),
    'leadCapture' => array('file' => 'modules/Leads/Capture.php', 'auth' => false),
    'process_queue' => array('file' => 'process_queue.php', 'auth' => true),
	'zipatcher' => array('file' => 'zipatcher.php', 'auth' => true),
    'mm_get_doc' => array('file' => 'modules/MailMerge/get_doc.php', 'auth' => true),
    'getImage' => array('file' => 'include/SugarTheme/getImage.php', 'auth' => false),
    'GenerateQuickComposeFrame' => array('file' => 'modules/Emails/GenerateQuickComposeFrame.php', 'auth' => true),
    'DetailUserRole' => array('file' => 'modules/ACLRoles/DetailUserRole.php', 'auth' => true),
    'getYUIComboFile' => array('file' => 'include/javascript/getYUIComboFile.php', 'auth' => false),
    'UploadFileCheck' => array('file' => 'modules/Configurator/UploadFileCheck.php', 'auth' => true),
    'SAML'=>  array('file' => 'modules/Users/authentication/SAMLAuthenticate/index.php', 'auth' => false),
    'reenvioDoc'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/reenviosDocu.php', 'auth' => false),
    'envioCorreosEvento'=>array('file' => 'custom/modules/Expan_Evento/metadata/envioCorreosEvento.php', 'auth' => false),
    'retrasarLlamadas'=>array('file' => 'custom/modules/Calls/metadata/retrasarLlamadas.php', 'auth' => false),
    'lanzarInforme'=>array('file' => 'custom/modules/Expin_Informes/metadata/lanzarInforme.php', 'auth' => false),
    'lanzarMailing'=>array('file' => 'custom/modules/Expma_Mailing/metadata/lanzarMailing.php', 'auth' => false),
    'reiniciarMailing'=>array('file' => 'custom/modules/Expma_Mailing/metadata/reiniciarMailing.php', 'auth' => false),
    'controlSolicitudes'=>array('file' => 'custom/modules/Expan_Solicitud/metadata/controlSolicitudes.php', 'auth' => false),
    'recogeSolicitud'=>array('file' => 'custom/modules/Expan_Solicitud/metadata/recogeSolicitud.php', 'auth' => false),
    'recogeGestion'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/recogeGestion.php', 'auth' => false),
    'gestionesHermanas'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/gestionesHermanas.php', 'auth' => false),
    'pasoEstado3'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/pasoEstado3.php', 'auth' => false),
    'asignaCorreosGestion'=>array('file' => 'custom/include/asignaCorreosGestion.php', 'auth' => false),
    'procesadoCandidaturasCron'=>array('file' => 'custom/include/ProcesarCandidaturas.php', 'auth' => false),
    'procesadoFormulariosCron'=>array('file' => 'custom/include/ProcesarFormularios.php', 'auth' => false), 
    'procesarGoogleForms'=>array('file' => 'custom/include/ProcesarGoogleForms.php', 'auth' => false), 
    'cambioEstadoGestion'=>array('file' => 'custom/include/CambioEstadoGestion.php', 'auth' => false),
    'recogellamadasGestion'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/recogellamadasGestion.php', 'auth' => false),
    'eliminarTareasCuestionario'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/eliminarTareasCuestionario.php', 'auth' => false),
    'recogeInfoC14'=>array('file' => 'custom/include/Formulario14.php', 'auth' => false),
    'recogeTelefonoGestion'=>array('file' => 'custom/include/RecogeTelefonoGestion.php', 'auth' => false), 
    'recogeSkypeGestion'=>array('file' => 'custom/include/RecogeSkypeGestion.php', 'auth' => false),      
    'correoLlamadas'=>array('file' => 'custom/include/CorreoLlamadas.php', 'auth' => false),
    'actualizarPrior'=>array('file' => 'custom/include/ActualizarPrior.php', 'auth' => false),
    'CorregirLlamadas'=>array('file' => 'custom/include/CorregirLlamadas.php', 'auth' => false),
    'CrearLlamadasDiarias'=>array('file' => 'custom/include/CrearLlamadasDiarias.php', 'auth' => false),
    'consultarFranquicia'=>array('file' => 'custom/include/consultarFranquicia.php', 'auth' => false),
    'LimpiezaBD'=>array('file' => 'custom/include/LimpiezaBD.php', 'auth' => false),
    'CrearLlamadaRecorFran'=>array('file' => 'custom/include/CrearLlamadaRecorFran.php', 'auth' => false),
    'RecogeSugerencias'=>array('file' => 'custom/modules/Expan_Solicitud/metadata/recogeSugerencias.php', 'auth' => false),
    'reenvioDocGestiones'=>array('file' => 'custom/modules/Expan_GestionSolicitudes/metadata/reenviosDocGestiones.php', 'auth' => false),
    'franquiciado'=>array('file' => 'custom/modules/Expan_Franquiciado/metadata/crearFranquiciado.php', 'auth' => false),
    'limpiezaLlamadasDuplicadas'=>array('file' => 'custom/include/limpiezaLlamadasDuplicadas.php', 'auth' => false),
    'envioPuertasAbiertas'=>array('file' => 'custom/modules/Expan_Franquicia/metadata/envioPuertasAbiertas.php', 'auth' => false),
);
?>
