<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class WF_User extends SugarBean {

	var $id;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $created_by;
	var $created_by_name;
	var $modified_by_name;
	var $name;
        var $wf_module;
        var $wf_type;
        var $role;
        var $kind;
        var $user_id;
        var $user_name;

	var $table_name = "wf_users";

	var $object_name = "WF_User";
	var $module_dir = 'WF_Users';

	var $importable = true;

	function WF_User() {
		parent::SugarBean();
	}

	var $new_schema = true;

	function get_summary_text()
	{
		return "{$this->wf_module}/{$this->wf_type}/{$this->role}/{$this->kind}/{$this->user_name}";
	}

	function bean_implements($interface){
		switch($interface){
			case 'ACL':return true;
		}
		return false;
	}
}

require_once ("custom/include/Workflow/utils.php");
