<?php
require_once('modules/zr2_ReportContainer/zr2_ReportContainer.php');

global $icon_map;

$icon_map = array(
	"csv" => "excel.gif",
	"html" => "html.gif",
	"xls" => "excel.gif",
	"txt" => "txt.gif",
	"pdf" => "pdf.gif",
	"doc" => "word.gif",
	"dot" => "word.gif",
);

class zr2_Report extends Basic {

	var $id;
	var $filename;
	var $description;
	
	var $created_by;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	
	var $icon_url;
	
	var $table_name = "zr2_report";
	var $object_name = "zr2_Report";
	var $module_dir = "zr2_Report";
	
	function zr2_Report() {
		parent::Basic();
	}

	function fill_in_additional_list_fields() {
		$this->fill_in_additional_detail_fields();
	}

	function fill_in_additional_detail_fields() {
		global $mod_strings, $icon_map;
		//TODO überprüfen ob da was drinnen steht
		$ext = substr($this->filename, strrpos($this->filename, ".") + 1);
		if (array_key_exists($ext, $icon_map)) {
			$this->icon_url = "modules/ZuckerReports/icons/".($icon_map[$ext]);
		} else {
			$this->icon_url = "modules/ZuckerReports/icons/txt.gif";
		}
	}
	
	function get_summary_text() {
		return $this->filename;
	}
	
	function get_parent_container() {
		if (!empty($this->container_id)) {
			$parent = new zr2_ReportContainer();
			return $parent->retrieve($this->container_id);
		}
		return false;
	}		
	
}

?>
