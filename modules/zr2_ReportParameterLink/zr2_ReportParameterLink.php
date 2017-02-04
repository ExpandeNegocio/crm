<?php
require_once('modules/zr2_ReportParameter/zr2_ReportParameter.php');

class zr2_ReportParameterLink extends Basic {

	var $id;
	var $default_value;
	var $bind_to_module_name;
	var $friendly_name;
	var $range_description;

	var $created_by;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	
	var $parameter;
	
	var $table_name = "zr2_reportparameterlink";
	var $object_name = "zr2_ReportParameterLink";
	var $module_dir = "zr2_ReportParameterLink";
	
	
	function zr2_ReportParameterLink() {
		parent::Basic();
	}

	function get_summary_text() {
		return (empty($this->friendly_name) ? $this->name : $this->friendly_name);
	}

	function fill_in_additional_list_fields() {
		$this->fill_in_additional_detail_fields();
	}

	function fill_in_additional_detail_fields() {

		$this->load_relationship("zr2_reportparameterlink_zr2_reportparameter");
		if ($this->zr2_reportparameterlink_zr2_reportparameter) {
			$related = $this->zr2_reportparameterlink_zr2_reportparameter->getBeans();
			
			if (!empty($related)) {
				$id = array_shift(array_keys($related));
				$this->parameter = $related[$id];
				$this->parameter->fill_in_additional_detail_fields();
			
				$this->range_description = $this->parameter->range_description;
				$this->friendly_name = $this->parameter->friendly_name;
			}
		}
	}	
	
	
}

?>
