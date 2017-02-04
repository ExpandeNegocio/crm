<?PHP

class asol_OnHold extends Basic {
	var $new_schema = true;
	var $module_dir = 'asol_OnHold';
	var $object_name = 'asol_OnHold';
	var $table_name = 'asol_onhold';
	var $importable = false;
	var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $modified_by_name;
	var $created_by;
	var $created_by_name;
	var $description;
	var $deleted;
	var $created_by_link;
	var $modified_user_link;
	var $assigned_user_id;
	var $assigned_user_name;
	var $assigned_user_link;
	var $asol_processinstances_id_c;
	var $process_instance_id;
	var $asol_workingnodes_id_c;
	var $working_node_id;
	/*
	var $trigger_module;
	var $bean_id;
	*/
	var $parent_id;
	var $parent_type;
	
	function asol_OnHold(){
		parent::Basic();
	}

	function bean_implements($interface){
		switch($interface){
			case 'ACL': return true;
		}
		return false;
	}
}
?>