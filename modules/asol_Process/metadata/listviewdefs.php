<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");

global $sugar_config, $current_user;

$use_metadata_per_domain = ((isset($sugar_config['WFM_use_metadata_per_domain'])) && ($sugar_config['WFM_use_metadata_per_domain'])) ? true : false;

if ($use_metadata_per_domain) {
	require_once('AlineaSolMetadataFiles/forkingMetadatas/modules/Process/listviewdefs.php');
} else {
	$module_name = 'asol_Process';
	global $app_list_strings;
	$listViewDefs[$module_name] = 
	array (
	
	  'FLOWCHART' => array(
        'width' => '1', 
        //'label' => 'LBL_FLOWCHART_BUTTON', 
        'label' => '',
        'link' => false,
        'sortable' => false,
        'default' => true,
	   ),
	   
	   'VALIDATE_WORKFLOW' => array(
        'width' => '1', 
	    'label' => '',
        'link' => false,
        'sortable' => false,
        'default' => true,
	   ),
	   
	  'NAME' => 
	  array (
	    'width' => '30%',
	    'label' => 'LBL_NAME',
	    'default' => true,
	    'link' => true,
	  ),
	  /*
	  'STATUS' => 
	  array (
	    'type' => 'enum',
	    'default' => true,
	    'studio' => 'visible',
	    'label' => 'LBL_STATUS',
	    'sortable' => true,
	    'width' => '10%',
	  ),
	  */
	  'ACTIVATE_INACTIVATE_WORKFLOW' => array(
        'width' => '1', 
        //'label' => 'LBL_ACTIVATE_INACTIVATE_WORKFLOW_BUTTON', 
        'label' => '',
        'link' => false,
        'sortable' => false,
        'default' => true,
	   ),
	  'STATUS' => array(
        'width' => '3%', 
        'label' => 'LBL_STATUS', 
        'link' => false,
        'sortable' => false,
        'default' => true,
	   ),
	   
	   /*
	  'ALTERNATIVE_DATABASE' => 
	  array (
	    'type' => 'varchar',
	    'default' => true,
	    'label' => 'LBL_REPORT_USE_ALTERNATIVE_DB',
	    'width' => '10%',
	  ),
	  */
	   'ALTERNATIVE_DATABASE' => array(
        'width' => '1', 
        'label' => 'LBL_REPORT_USE_ALTERNATIVE_DB', 
        'link' => false,
        'sortable' => false,
        'default' => true,
	   ),
	   /*
	  'TRIGGER_MODULE' => 
	  array (
	    'type' => 'enum',
	    'default' => true,
	    'studio' => 'visible',
	    'label' => 'LBL_TRIGGER_MODULE',
	    //'customCode' => '{$fields.trigger_module.value}',
	    'sortable' => true,
	    'width' => '10%',
	  ),
	  */
	  
	  'TRIGGER_MODULE' => array(
        'width' => '1', 
        'label' => 'LBL_TRIGGER_MODULE', 
        'link' => false,
        'sortable' => false,
        'default' => true,
	   ),
	   
	  'DATE_ENTERED' => 
	  array (
	    'width' => '7%',
	    'label' => 'LBL_DATE_ENTERED',
	    'default' => true,
	  ),
	  'DATE_MODIFIED' => 
	  array (
	    'width' => '7%',
	    'label' => 'LBL_DATE_MODIFIED',
	    'default' => true,
	  ),
	  'CREATED_BY_NAME' => 
	  array (
	    'type' => 'relate',
	  	'module' => 'Users',
	    'link' => $current_user->is_admin,
	    'label' => 'LBL_CREATED',
	    'id' => 'CREATED_BY',
	    'width' => '10%',
	    'default' => true,
	  	'related_fields' => array('created_by'),
	  ),
	  'MODIFIED_BY_NAME' => 
	  array (
	    'type' => 'relate',
	  	'module' => 'Users',
	    'link' => $current_user->is_admin,
	    'label' => 'LBL_MODIFIED_NAME',
	    'id' => 'MODIFIED_USER_ID',
	    'width' => '10%',
	    'default' => true,
	    'related_fields' => array('modified_user_id'),
	  ),
	);
	
	if (wfm_domains_utils::wfm_isDomainsInstalled()) {
		$listViewDefs[$module_name]['ASOL_DOMAIN_NAME'] =  
		  array (
		    'type' => 'relate',
		    'studio' => 'visible',
		    'label' => 'LBL_ASOL_DOMAIN_NAME',
		    'width' => '5%',
		    'default' => true,
		  );
	}
	
	$listViewDefs[$module_name]['EXPORT_WORKFLOW'] = array(
        'width' => '1', 
        //'label' => 'LBL_EXPORT_WORKFLOW_BUTTON', 
        'label' => '',
        'link' => false,
        'sortable' => false,
        'default' => true,
	);
	$listViewDefs[$module_name]['IMPORT_WORKFLOW'] = array(
        'width' => '1', 
        //'label' => 'LBL_IMPORT_WORKFLOW_BUTTON', 
        'label' => '',
        'link' => false,
        'sortable' => false,
        'default' => true,
	);
	$listViewDefs[$module_name]['DELETE_WORKFLOW'] = array(
        'width' => '1', 
        //'label' => 'LBL_DELETE_WORKFLOW_BUTTON', 
        'label' => '',
        'link' => false,
        'sortable' => false,
        'default' => true,
	);
}
//$actionsMenuExtraItems[] = "test";
?>
