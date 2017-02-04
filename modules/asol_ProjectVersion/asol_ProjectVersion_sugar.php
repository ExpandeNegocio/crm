<?PHP


class asol_ProjectVersion_sugar extends Basic {
	var $new_schema = true;
	var $module_dir = 'asol_ProjectVersion';
	var $object_name = 'asol_ProjectVersion';
	var $table_name = 'asol_projectversion';
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
	var $version_number;
	var $json_gantt_tasks;
	var $is_published;
	var $published_datetime;
	var $type;
	var $user_id_c;
	var $current_editor;
	var $last_editor_call;
	var $wiki_link;
	var $wiki_link_alias;

	function asol_ProjectVersion_sugar(){
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