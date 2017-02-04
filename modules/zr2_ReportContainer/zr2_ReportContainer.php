<?php
require_once('include/utils.php');
require_once('modules/zr2_Report/zr2_Report.php');

class zr2_ReportContainer extends Basic {

	var $id;
	var $name;
	var $description;
	var $assigned_user_id;
	var $assigned_user_name;
	var $created_by;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	
	var $table_name = "zr2_reportcontainer";
	var $object_name = "zr2_ReportContainer";	
	var $module_dir = "zr2_ReportContainer";


	function zr2_ReportContainer() {
		parent::Basic();
	}
	
	function get_summary_text() {
		return $this->name;
	}
	
	function get_category_select_options() {
		$seed = new zr2_ReportContainer();

		$result = array();
		$result[""] = "";
		
		$list = $seed->get_list("name", "", 0, 1000, 1000, 0);
		$list = $list["list"];
		foreach ($list as $cat) {
			$result[$cat->id] = $cat->name;
		}
		return $result;	
	}
}

?>
