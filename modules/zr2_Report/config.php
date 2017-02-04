<?php

global $zuckerreports_config;
global $sugar_config;

$zuckerreports_config = array(
	
	//This is the list of supported report providers - don't change it unless you know what you are doing
	"providers" => array(
	
			array(
				"module" => "zr2_ReportTemplate",
				"class_name" => "zr2_ReportTemplate",
				"include" => "modules/zr2_ReportTemplate/zr2_ReportTemplate.php",
				"lang_key_new" => "LBL_REPORT_TEMPLATE_NEW",
				"menu_ext" => "yes",
			),

			array(
				"module" => "zr2_QueryTemplate",
				"class_name" => "zr2_QueryTemplate",
				"include" => "modules/zr2_QueryTemplate/zr2_QueryTemplate.php",
				"lang_key_new" => "LBL_QUERY_TEMPLATE_NEW",
				"menu_ext" => "yes",
			),

		),
);

?>