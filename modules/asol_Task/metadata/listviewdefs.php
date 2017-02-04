<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");

global $sugar_config, $current_user;

$use_metadata_per_domain = ((isset($sugar_config['WFM_use_metadata_per_domain'])) && ($sugar_config['WFM_use_metadata_per_domain'])) ? true : false;

if ($use_metadata_per_domain) {
	require_once('AlineaSolMetadataFiles/forkingMetadatas/modules/Task/listviewdefs.php');
} else {
	$module_name = 'asol_Task';
	$listViewDefs[$module_name] = 
	array (
	  'NAME' => 
	  array (
	    'width' => '30%',
	    'label' => 'LBL_NAME',
	    'default' => true,
	    'link' => true,
	  ),
	  'TASK_TYPE' => 
	  array (
	    'type' => 'varchar',
	    'label' => 'LBL_TASK_TYPE',
	    'width' => '10%',
	    'default' => true,
	  ),
	  'DELAY_TYPE' => 
	  array (
	    'type' => 'enum',
	    'default' => true,
	    'studio' => 'visible',
	    'label' => 'LBL_DELAY_TYPE',
	    'sortable' => true,
	    'width' => '10%',
	  ),
	  'DELAY' => 
	  array (
	    'type' => 'varchar',
	    'label' => 'LBL_DELAY',
	    'width' => '10%',
	    'default' => true,
	  ),
	  'TASK_ORDER' => 
	  array (
	    'type' => 'varchar',
	    'label' => 'LBL_TASK_ORDER',
	    'width' => '10%',
	    'default' => true,
	  ),
	  'ASOL_ACTIVITY_ASOL_TASK_NAME' => 
	  array (
	    'type' => 'relate',
	    'link' => true,
	    'label' => 'LBL_ASOL_ACTIVITY_ASOL_TASK_FROM_ASOL_ACTIVITY_TITLE',
	    'id' => 'ASOL_ACTIV5B86CTIVITY_IDA',
	    'width' => '10%',
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
}
?>
