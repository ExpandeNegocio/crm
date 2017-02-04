<?PHP

class asol_ProjectTask_sugar extends Basic {
	var $new_schema = true;
	var $module_dir = 'asol_ProjectTask';
	var $object_name = 'asol_ProjectTask';
	var $table_name = 'asol_projecttask';
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
	var $start;
	var $end;
	var $status;
	var $start_is_milestone;
	var $end_is_milestone;
	var $depends;
	var $level;
	var $duration;
	var $progress;
	var $task_order;
	var $assigs;
	
	function asol_ProjectTask_sugar(){
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