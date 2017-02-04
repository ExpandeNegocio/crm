<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$module_name = 'asol_Events';
$viewdefs[$module_name] = 
array (
	'EditView' => 
		array (
		
			'templateMeta' => 
				array (
					'form' => 
						array(
							'buttons' => 
								array(
									0 => 'SAVE', 
									1 => 'CANCEL',
									2 =>
										array(
											'customCode' => '<link href="modules/asol_Events/css/asol_events_style.css?version={php} wfm_utils::echoVersionWFM(); {/php}" rel="stylesheet" type="text/css" />',
										),
									3 => 
										array(
											'customCode' => '<script src="modules/asol_Events/js/asol_events.js?version={php} wfm_utils::echoVersionWFM(); {/php}" type="text/javascript"></script>',
										),
									4 => 
										array(
											'customCode' => '<script src="modules/asol_Events/js/module_fields.js?version={php} wfm_utils::echoVersionWFM(); {/php}" type="text/javascript"></script>',
										),
									5 => 
										array(
											'customCode' => '<script src="modules/asol_Process/___common_WFM/js/common_event_activity_task.js?version={php} wfm_utils::echoVersionWFM(); {/php}" type="text/javascript"></script>',
										),
								),
								'hideAudit' => true,
						),
					'maxColumns' => '2',
					'widths' => 
						array (
							0 => 
								array (
									'label' => '10',
									'field' => '30',
								),
							1 => 
								array (
									'label' => '10',
									'field' => '30',
								),
						),
					'useTabs' => false,
					/*
					'includes' => 
						array(
							array('file'=>'modules/Accounts/Account.js'),
						),
					*/
	    		),
	    		
			'panels' => 
				array (
				
					'default' => 
						array (
							0 => 
								array (
									0 => 'name',
									/*1 => 'assigned_user_name',*/
								),
							1 => 
								array (
									0 => 
										array(
											'name' => 'trigger_type',
											'label' => 'LBL_TRIGGER_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TRIGGER_TYPE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Events/customFields/trigger_type.php");
																{/php}
															',
										),
									1 => 
										array (
											'name' => 'type',
											'label' => 'LBL_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TYPE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Events/customFields/type.php");
																{/php}
															',
										),
									2 => 
										array(
											'name' => 'scheduled_type',
											'label' => 'LBL_SCHEDULED_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_SCHEDULED_TYPE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Events/customFields/scheduled_type.php");
																{/php}
															',
										),
									3 => 
										array(
											'name' => 'subprocess_type',
											'label' => 'LBL_SUBPROCESS_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_SUBPROCESS_TYPE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Events/customFields/subprocess_type.php");
																{/php}
															',
										),
								),
							2 => 
								array (
									0 => 
										array (
											'name' => 'description',
											/*
											'customCode' => '
																{php} 
																	require_once("modules/asol_Process/customFields/description.php");
																{/php}
															',
											*/
										),
								),
						),
						
					'LBL_ASOL_TRIGGERING_PANEL' => 
						array (
							0 =>
								array(
									0 =>
										array(
											'name' => 'scheduled_tasks',
											'label' => 'LBL_SCHEDULED_TASKS',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_SCHEDULED_TASKS',
											'customCode' => '
																{php}
																	require_once("modules/asol_Events/customFields/scheduled_tasks.php"); 
																{/php}
															',
										),
								),
							1 => 
								array (
									0 => 
										array (
											'name' => 'trigger_module',
											'label' => 'LBL_ASOL_TRIGGER_MODULE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Events/customFields/trigger_module.php");
																{/php}
															',
										),
									1 => 
										array (
											'name' => 'trigger_event',
											'label' => 'LBL_ASOL_TRIGGER_EVENT',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TRIGGER_EVENT',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Events/customFields/trigger_event.php");
																{/php}
															',
										),
								),
							
						),

					'LBL_ASOL_EVENT_CONDITION_PANEL' => 
						array (
							0 => 
								array (
									0 => 
										array (
											'name' => 'module_fields',
											'label' => 'LBL_ASOL_MODULE_FIELDS',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_MODULE_FIELDS',
											'customCode' => '
																{php}
																	require_once("modules/asol_Events/customFields/module_fields.php"); 
																{/php}
															',
										),
									1 => 
										array (
											'name' => 'module_conditions',
											'label' => 'LBL_CONDITIONS',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_MODULE_CONDITIONS',
											'customCode' => '
																{php}
																	require_once("modules/asol_Events/customFields/module_conditions.php"); 
																{/php}
															',
										),
								),
							/*
							1 =>
								array(
									0 => array (
										'name' => 'custom_variables',
										'label' => 'LBL_CUSTOM_VARIABLES',
										'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_CUSTOM_VARIABLES',
										'customCode' => '
															{php}
																require_once("modules/asol_Events/customFields/custom_variables.php"); 
															{/php}
														',
									),
								),
							*/
						),
				),
		),
);
?>
