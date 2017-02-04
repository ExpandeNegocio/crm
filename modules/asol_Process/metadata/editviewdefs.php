<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$module_name = 'asol_Process';
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
											'customCode' => '<link href="modules/asol_Process/css/asol_process_style.css?version={php} wfm_utils::echoVersionWFM(); {/php}" rel="stylesheet" type="text/css" />',
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
									1 => 
										array (
											'name' => 'status',
											'label' => 'LBL_STATUS',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_STATUS',
										),
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
								),
						),

					'LBL_DB_CONFIGURATION_PANEL' => 
						array (
							0 => 
								array (
								
									0 => 
										array (
											'name' => 'alternative_database',
											'label' => 'LBL_REPORT_USE_ALTERNATIVE_DB',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_ALTERNATIVE_DATABASE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Process/customFields/alternative_database.php");
																{/php}
															',
										),
								
									1 => 
										array (
											'name' => 'trigger_module',
											'label' => 'LBL_ASOL_TRIGGER_MODULE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TRIGGER_MODULE',
											'customCode' => '
																{php} 
																	require_once("modules/asol_Process/customFields/trigger_module.php");
																{/php}
															',
										),
								),
						),
						
				),
		),
);
?>
