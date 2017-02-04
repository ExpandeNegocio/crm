<?php
require_once('modules/Administration/Administration.php');
require_once('modules/zr2_ReportParameterLink/zr2_ReportParameterLink.php');
require_once('modules/zr2_ReportParameter/zr2_ReportParameter.php');

class ReportProviderBase extends SugarBean {

	var $id;	
	var $created_by;	
	var $date_entered;	
	var $date_modified;	
	var $modified_user_id;		

	var $assigned_user_id;
	var $assigned_user_name;
	
	var $image_html;
	var $image_module;
	var $action_module;
	var $type_desc;

	function ReportProviderBase() {		
		parent::SugarBean();		
		$this->new_schema = true;
		global $current_user;
		if(empty($current_user))
		{
			$this->assigned_user_id = 1;
			$this->assigned_user_name = 'admin';
		}
		else
		{
			$this->assigned_user_id = $current_user->id;
			$this->assigned_user_name = $current_user->user_name;
		}
	}	

	function get_archive_dir() {
		$dir = "custom/ZuckerReports2/archive/";
		if (!is_dir($dir)) mkdir($dir, 0700, true);
		return $dir;
	}
	function get_temp_dir() {
		$dir = "custom/ZuckerReports2/temp/";
		if (!is_dir($dir)) mkdir($dir, 0700, true);
		return $dir;
	}
	function get_resources_dir() {
		$dir = "custom/ZuckerReports2/resources/";
		if (!is_dir($dir)) mkdir($dir, 0700, true);
		return $dir;
	}	

	function get_all($order_by = "", $where = "") {
		$list = parent::get_list($order_by, $where, 0, 1000, 1000, 0);
		$list = $list["list"];
		return $list;
	}
	
	function get_charset() {
		global $sugar_config;

		$admin = new Administration();
		$admin->retrieveSettings();
		$charset = $admin->settings['zuckerreports2_charset'];
		
		
		if (empty($charset)) {
			return $sugar_config["default_charset"];
		} else {
			return $charset;
		}
	}
	
	function fill_in_additional_list_fields() {		
		$this->fill_in_additional_detail_fields();	
	}	

	function format_value_for_html($value) {
		return nl2br(htmlentities(from_html($value), ENT_COMPAT, $this->get_charset()));
	}
	
	var $report_output;
	//FILE | INLINE | FORWARD
	var $report_result_type;
	var $report_result_name;
	var $report_result;
	
	
	

	function execute_request($parameter_values = array()) {
		return FALSE;
	}
	function get_format_selection() {
	}	
	function get_format_parameters() {
	}

	function get_parameter_links() {
	}	
	function get_module_link($module_name) {
	}	
}

?>
