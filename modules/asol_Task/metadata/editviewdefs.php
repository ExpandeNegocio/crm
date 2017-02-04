<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$module_name = 'asol_Task';
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
											'customCode' => '<link href="modules/asol_Task/css/asol_task_style.css?version={php} wfm_utils::echoVersionWFM(); {/php}" rel="stylesheet" type="text/css" />',
										),
									3 => 
										array(
											'customCode' => '<script src="modules/asol_Task/js/asol_task.js?version={php} wfm_utils::echoVersionWFM(); {/php}" type="text/javascript"></script>',
										),
									4 => 
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
											'name' => 'delay_type',
											'label' => 'LBL_DELAY_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_DELAY_TYPE',
											'customCode' => '
																{php}
																	require_once("modules/asol_Task/customFields/delay_type.php");
																{/php}
															',
										),
									1 => 
										array (
											'name' => 'delay',
											'label' => 'LBL_DELAY',
											'customCode' => '
																{php}
																	require_once("modules/asol_Task/customFields/delay.php");
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
									1 => 
										array (
											'name' => 'task_order',
											'label' => 'LBL_TASK_ORDER',
											'customCode' => '
																{php}
																	require_once("modules/asol_Task/customFields/task_order.php");
																{/php}
															',
										),
								),
						),

					'LBL_TASK_IMPLEMENTATION_PANEL' => 
						array (
							0 => 
								array (
									0 => 
										array (
											'name' => 'task_type',
											'label' => 'LBL_TASK_TYPE',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TASK_TYPE',
											'customCode' => '
																{php}
																	require_once("modules/asol_Task/customFields/task_type.php");
																{/php}
															',
										),
									1 => 
										array (
											'name' => 'task_implementation',
											'label' => 'LBL_TASK_IMPLEMENTATION',
											'popupHelp' => 'LBL_POPUPHELP_FOR_FIELD_TASK_IMPLEMENTATION',
											'customCode' => '
																<input type="hidden" id="task_implementation_hidden" name="task_implementation_hidden" value="">
																{php}
																	require_once("modules/asol_Task/customFields/task_implementation.php");
																{/php}
															',
										),
								),
						),
      
				),
  		),
);
?>
