<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$module_name = 'asol_Process';
$viewdefs[$module_name] = 
array (
	'DetailView' => 
		array (
		
			'templateMeta' => 
				array (
					'form' => 
						array (
							'buttons' => 
								array (
									0 => 'EDIT',
									1 => 'DUPLICATE',
									2 => 'DELETE',
								),
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
											'name' => 'date_entered',
											'label' => 'LBL_DATE_ENTERED',
											'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
										),
									1 => 
										array (
											'name' => 'date_modified',
											'label' => 'LBL_DATE_MODIFIED',
											'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
										),
								),
							2 => 
								array (
									0 => 
										array (
											'name' => 'trigger_module',
											'label' => 'LBL_TRIGGER_MODULE',
										),
									1 => 
										array (
											'name' => 'status',
											'label' => 'LBL_STATUS',
										),
								),
							3 => 
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
						
				),
		),
);

if (wfm_domains_utils::wfm_isDomainsInstalled()) {
	$viewdefs[$module_name]['DetailView']['panels']['LBL_ASOL_DOMAINS_PUBLISH_FEATURE_PANEL'] = 
		array(
			0 =>
			array (
				0 =>
				array (
		            'name' => 'asol_domain_name',
		            'label' => 'LBL_ASOL_DOMAIN_NAME',
		            'customCode' => '{$fields.asol_domain_name.value}',
				),
			),
			1 =>
			array (
				0 =>
				array (
				    'label' => 'LBL_ASOL_MANAGE_DOMAINS',
				    'customCode' => '{php} require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php"); $bean = $GLOBALS["FOCUS"]; echo asol_manageDomains::getManageDomainPublicationButtonHtml($bean->id, $bean->table_name); {/php}',
				),
				1 =>
				array (
				    'name' => 'asol_published_domain',
				    'label' => 'LBL_ASOL_PUBLISHED_DOMAIN',
				),
			),
		);
}
?>
