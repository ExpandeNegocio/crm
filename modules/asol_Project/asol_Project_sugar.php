<?PHP

class asol_Project_sugar extends Basic {
	var $new_schema = true;
	var $module_dir = 'asol_Project';
	var $object_name = 'asol_Project';
	var $table_name = 'asol_project';
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
	var $date_start;
	var $date_end;
	var $status;
	var $priority;
	var $log;
	var $wiki_link;
	var $wiki_link_alias;
	var $asol_projectversion_id_c;
	var $working_version;
	var $asol_projectversion_id1_c;
	var $last_published_version;

	function asol_Project_sugar(){
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