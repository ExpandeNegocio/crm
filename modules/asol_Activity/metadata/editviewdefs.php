<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$module_name = 'asol_Activity';
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
											'customCode' => '<link href="modules/asol_Activity/css/asol_activity_style.css?version={php} wfm_utils::echoVersionWFM(); {/php}" rel="stylesheet" type="text/css" />',
										),
									3 => 
										array(
											'customCode' => '<script src="modules/asol_Activity/js/asol_activity.js?version={php} wfm_utils::echoVersionWFM(); {/php}" type="text/javascript"></script>',
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
				),
				
			'panels' => 
				array (
				
					'default' => 
						array (
							0 => 
								array (
									0 => 'name',
								),
							1 => 
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
									1 => 
										array (
											'name' => 'delay',
											'label' => 'LBL_DELAY',
											'customCode' => '
																{php}
																	require_once("modules/asol_Activity/customFields/delay.php");
																{/php}
															',
										),
								),
							2 => 
								array(
									0 => 
										array (
											'name' => 'type',
											'label' => 'LBL_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TYPE',
											'customCode' => '
																{php}
																	require_once("modules/asol_Activity/customFields/type.php");
																{/php}
															',
										),
								),
						),
      
					'LBL_ASOL_TRIGGERING_PANEL' => 
						array (
							0 => 
								array (
									0 => 
										array (
											'name' => 'trigger_module',
											'label' => 'LBL_ASOL_TRIGGER_MODULE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Activity/customFields/trigger_module.php");
																{/php}
															',
										),
									1 => '',
								),
						),
      
					'LBL_ASOL_ACTIVITY_CONDITION_PANEL' => 
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
																	require_once("modules/asol_Activity/customFields/module_fields.php"); 
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
																	require_once("modules/asol_Activity/customFields/module_conditions.php"); 
																{/php}
															',
										),
								),
							1 =>
								array(
									0 => array (
										'name' => 'custom_variables',
										'label' => 'LBL_CUSTOM_VARIABLES',
										'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_CUSTOM_VARIABLES',
										'customCode' => '
															{php}
																require_once("modules/asol_Activity/customFields/custom_variables.php"); 
															{/php}
														',
									),
								),
						),
      
    			),
		),
);
?>
