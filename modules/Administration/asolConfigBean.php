<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class AsolConfig extends SugarBean {
        
	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $created_by;
	var $deleted;
	var $config;

	var $table_name = "asol_config";
	var $object_name = "AsolConfig";
	var $module_dir = "Administration";
	
	var $importable = true;
	var $tablePath;
	var $joinSegments;
	var $rootGuid;
	var $fromString;

	var $evalSQLFunctions = true;
	var $maxDepth; 

	function AsolConfig() {
		parent::SugarBean();
	}
	
	function bean_implements($interface){
		switch($interface){
			case 'ACL':return true;
		}
		return false;
	}
	
	function get_summary_text()
	{
		return $this->name;
	}

	function fill_in_additional_detail_fields() 
	{
		parent::fill_in_additional_detail_fields();
	}

function getSelectionResults($query, $offset = 0, $entries = 0){
	
	global $db;
	
	$queryResults = $db->query($query);
	
	while($queryRow = $db->fetchByAssoc($queryResults))
	{
		$retArray[] = $queryRow;
	}
	return $retArray;
}

}
?>
