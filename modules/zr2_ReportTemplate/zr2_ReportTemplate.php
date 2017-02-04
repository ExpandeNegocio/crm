<?php
require_once('modules/Administration/Administration.php');
require_once('modules/Users/User.php');
require_once('modules/zr2_Report/ReportProviderBase.php');
require_once('modules/zr2_ReportParameterLink/zr2_ReportParameterLink.php');

function endsWith( $str, $sub ) {
	return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
}

class zr2_ReportTemplate extends ReportProviderBase {

	var $name;	
	var $filename;
	var $description;
	var $export_as;
	var $error_message;
	
	var $template_url;		
	var $compiled_filename;
	var $resources_folder;

	var $table_name = "zr2_reporttemplate";
	var $object_name = "zr2_ReportTemplate";
	var $module_dir = "zr2_ReportTemplate";
	
	function zr2_ReportTemplate() {		
		parent::ReportProviderBase();
		$this->new_schema = true;
	}	
	
	function get_summary_text() {		
		return $this->name;	
	}	
	
	function get_export_checkbox_array() {
		global $current_language;
	
		$mod_list_strings = return_mod_list_strings_language($current_language, "zr2_ReportTemplate");
		$export_types = $mod_list_strings["REPORT_EXPORT_TYPES"];
		
		$result = array();
		foreach ($export_types as $key => $value) {
			if (strpos($this->export_as, $key) === false) {
				$checked = "";
			} else {
				$checked = "checked";
			}
			$result[] = '<input type="checkbox" name="export_'.$key.'" value="true" '.$checked.'>'.$value;
		}
		return $result;
	}
	function set_export_from_checkboxes() {
		global $current_language;
	
		$mod_list_strings = return_mod_list_strings_language($current_language, "zr2_ReportTemplate");
		$export_types = $mod_list_strings["REPORT_EXPORT_TYPES"];
		
		$this->export_as = "";
		
		foreach ($export_types as $key => $value) {
			if (!empty($_REQUEST["export_".$key])) {
				$this->export_as .= $key." ";
			}
		}
		if (empty($this->export_as)) {
			$this->export_as = "PDF";
		}
	}
	
	
	function get_export_array() {
		global $current_language;
	
		$mod_list_strings = return_mod_list_strings_language($current_language, "zr2_ReportTemplate");
		$export_types = $mod_list_strings["REPORT_EXPORT_TYPES"];
		
		$result = array();
		foreach ($export_types as $key => $value) {
			if (!(strpos($this->export_as, $key) === false)) {
				$result[] = $value;
			}
		}
		return $result;
	}
	function get_export_selection_array($selected) {
		global $current_language;
	
		$mod_list_strings = return_mod_list_strings_language($current_language, "zr2_ReportTemplate");
		$export_types = $mod_list_strings["REPORT_EXPORT_TYPES"];
		
		$result = array();
		foreach ($export_types as $key => $value) {
			if (!(strpos($this->export_as, $key) === false)) {
				if ($key == $selected) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				$result[] = '<OPTION '.$sel.' value="'.$key.'">'.$value.'</OPTION>';
			}
		}
		return $result;
	}


	
	function fill_in_additional_detail_fields() {		
		global $current_language, $theme;		
		global $sugar_config;				

		$mod_strings = return_module_language($current_language, "zr2_ReportTemplate");

		$this->template_url = $this->get_resources_dir().($this->filename);
		$this->compiled_filename = $this->get_resources_dir().($this->filename);
		$this->resources_folder = $this->get_resources_dir().($this->filename)."_files/";
		
		$this->action_module = $this->module_dir;
		$this->type_desc = $mod_strings["LBL_REPORT"];
		$this->image_html = get_image("themes/".$theme."/images/zr2_ReportTemplate", "alt=\"ZuckerReportTemplate\"");
		$this->image_module = "zr2_ReportTemplate";
	}			

	function getByFilename($filename) {
		return zr2_ReportTemplate::get_by_filename($filename);
	}	
	
	function get_by_filename($filename) {
		$seed = new zr2_ReportTemplate();
		$results = $seed->get_full_list("", "filename='".$filename."'");
		if (!empty($results)) {
			$result = $results[0];
			$result->retrieve();
			return $result;
		} else {
			return NULL;
		}
	}	

	function get_parameter_links() {
		$this->load_relationship("zr2_reportparameterlink_zr2_reporttemplate");
		$related = $this->zr2_reportparameterlink_zr2_reporttemplate->getBeans();
		if (empty($related)) return FALSE;
		else return array_values($related);
	}	
	function get_module_link($module_name) {
		$this->load_relationship("zr2_reportparameterlink_zr2_reporttemplate");

//		//Only works in Sugar 6.5		
//		$filter_params = array(
//			'where' => array(
//				'lhs_field' => 'bind_to_module_name',
//				'operator' => '=',
//				'rhs_value' => $module_name,
//				),
//			'limit' => '1',
//			);		
//		$related = $this->zr2_reportparameterlink_zr2_reporttemplate->getBeans($filter_params);
//		if (empty($related)) return FALSE;
//		else return $related[array_shift(array_keys($related))];

		$all_related = $this->zr2_reportparameterlink_zr2_reporttemplate->getBeans();
		foreach ($all_related as $bean) {
			if ($bean->bind_to_module_name == $module_name) {
				return $bean;
			}
		}
		return FALSE;
	}	
	
	
	
	
	
	function unlink_all_files() {
		@unlink($this->compiled_filename);
		$this->rec_delete($this->resources_folder);
	}
	
	function set_reportfile($infile, $orig_filename) {
		global $mod_strings;
		
		if (substr($orig_filename, strrpos($orig_filename, ".") + 1) == "jrxml") {
			$this->filename = substr($orig_filename, 0, strrpos($orig_filename, ".")).".jasper";
			$this->fill_in_additional_detail_fields();

			$admin = new Administration();
			$admin->retrieveSettings();
			$deployment = $admin->settings['zuckerreports2_deployment'];
			
			if ($deployment == "ondemand") 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_URL, $admin->settings['zuckerreports2_ondemandservice'].'SetReportFile');

				$jsondata = array(
					'appSecret' => $admin->settings['zuckerreports2_ondemandappsecret'],
					'id' => $this->id, 
					'filename' => $orig_filename, 
					'filecontents' => base64_encode(file_get_contents($infile)), 
				  );
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsondata));
				
				$result_json = curl_exec($ch);
				if ($result_json === false) 
				{
					$this->report_output = 'ERROR '.curl_errno($ch).' - '.curl_error($ch);
					return false;
				} 
				else {
					$result = json_decode($result_json);
					
					$this->report_output = $result;
					if ($result->result == "ok") return true;
					else return false;
				}
			}
			else
			{
				$classpath = $this->get_classpath();
				$result = $this->execute_java("-classpath ".$classpath." at.go_mobile.zuckerreports.JasperCompileMain ".$infile." ".$this->compiled_filename);
				return $result;
			}
		} else {
			$this->report_output = $mod_strings['ERR_TEMPLATE_INVALID_FILE'];
			return FALSE;
		}
	}

	function add_subreportfile($infile, $orig_filename) {
		global $mod_strings;

		if (substr($orig_filename, strrpos($orig_filename, ".") + 1) == "jrxml") {

			$admin = new Administration();
			$admin->retrieveSettings();
			$deployment = $admin->settings['zuckerreports2_deployment'];
			
			if ($deployment == "ondemand") 
			{

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_URL, $admin->settings['zuckerreports2_ondemandservice'].'AddSubreportFile');

				$jsondata = array(
					'appSecret' => $admin->settings['zuckerreports2_ondemandappsecret'],
					'id' => $this->id, 
					'filename' => $orig_filename, 
					'filecontents' => base64_encode(file_get_contents($infile)), 
				  );
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsondata));
			
				$result_json = curl_exec($ch);
				if ($result_json === false) 
				{
					$this->report_output = 'ERROR '.curl_errno($ch).' - '.curl_error($ch);
					return false;
				} 
				else {
					$result = json_decode($result_json);
					
					$this->report_output = $result;
					if ($result->result == "ok") return true;
					else return false;
				}
			}
			else 
			{
				$filename = substr($orig_filename, 0, strrpos($orig_filename, ".")).".jasper";
				$compiled_filename = ($this->resources_folder)."/".($filename);

				if (!file_exists($this->resources_folder)) {
					mkdir($this->resources_folder, 0700);		
				}

				$classpath = $this->get_classpath();
				$result = $this->execute_java('-classpath '.$classpath.' at.go_mobile.zuckerreports.JasperCompileMain "'.$infile.'" "'.$compiled_filename.'"');
				return $result;	
			}
		} 
		else 
		{
			$this->report_output = $mod_strings['ERR_TEMPLATE_INVALID_FILE'];
			return FALSE;
		}
	}

	function add_resource_file($infile, $orig_filename) {
	
		$admin = new Administration();
		$admin->retrieveSettings();
		$deployment = $admin->settings['zuckerreports2_deployment'];
			
		if ($deployment == "ondemand") 
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_URL, $admin->settings['zuckerreports2_ondemandservice'].'AddResourceFile');

			$jsondata = array(
				'appSecret' => $admin->settings['zuckerreports2_ondemandappsecret'],
				'id' => $this->id, 
				'filename' => $orig_filename, 
				'filecontents' => base64_encode(file_get_contents($infile)), 
			  );
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsondata));
			
			$result_json = curl_exec($ch);
			
			if ($result_json === false) 
			{
				$this->report_output = 'ERROR '.curl_errno($ch).' - '.curl_error($ch);
				return false;
			} 
			else {
				$result = json_decode($result_json);
					
				$this->report_output = $result;
				if ($result->result == "ok") return true;
				else return false;
			}
		}
		else 
		{
			if (!file_exists($this->resources_folder)) {
				mkdir($this->resources_folder, 0700);
			}
			$result = copy($infile, $this->resources_folder."/".$orig_filename);
			return $result;
		}
	}
	
	function execute_request($parameter_values = array(), $archive_dir = "") {
		if (empty($archive_dir)) $archive_dir = $this->get_archive_dir();
		return $this->execute($_REQUEST['format'], $parameter_values, $archive_dir);
	}
	
	
	//$format = "PDF", "XLS", "CSV", "HTML", "XML", "XML_EMBED"
	function execute($format = 'PDF', $parameter_values = array(), $archive_dir = "") {
		global $sugar_config, $current_user;

		if (empty($archive_dir)) $archive_dir = $this->get_archive_dir();
		
		$base = substr($this->filename, 0, strrpos($this->filename, "."));
		
		$date = date("ymd_His");
		if ($format == 'XLS') {
			$this->report_result_name = $date."_".$base.".xls";
		} else if ($format == 'CSV') {
			$this->report_result_name = $date."_".$base.".csv";
		} else if ($format == 'HTML') {
			$this->report_result_name = $date."_".$base.".html";
		} else if ($format == 'XML') {
			$this->report_result_name = $date."_".$base.".xml";
		} else if ($format == 'XML_EMBED') {
			$this->report_result_name = $date."_".$base.".xml";
		} else {
			$this->report_result_name = $date."_".$base.".pdf";
		}
		$this->report_result_name = strtolower(join("_", explode(" ", $this->report_result_name)));
		$this->report_result = $archive_dir."/".$this->report_result_name;
		
		if ($format == 'HTML') {
			$this->report_result_type = "FORWARD";
		} else {
			$this->report_result_type = "FILE";
		}

		$admin = new Administration();
		$admin->retrieveSettings();
		$deployment = $admin->settings['zuckerreports2_deployment'];
			
		if ($deployment == "ondemand") 
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_URL, $admin->settings['zuckerreports2_ondemandservice'].'RunReport');

			$sugarWebserviceUrl = $admin->settings['zuckerreports2_ondemandsugarservice'];
			if (empty($sugarWebserviceUrl)) $sugarWebserviceUrl = ($sugar_config['site_url'])."/custom/ZuckerReports2/service/v4/rest.php";
			
			$sugaruser = $admin->settings['zuckerreports2_ondemandsugaruser'];
			$userbean = new User();
			$sugaruserid = $userbean->retrieve_user_id($sugaruser);
			$user = $userbean->retrieve($sugaruserid);
			
			$jsondata = array(
				'appSecret' => $admin->settings['zuckerreports2_ondemandappsecret'],
				'format' => $format,
				'id' => $this->id, 
				'reportFilename' => $this->filename,
				'outputFilename' => $this->report_result_name,
				'sugarSiteUrl' => ($sugar_config['site_url']),
				'sugarWebserviceUrl' => $sugarWebserviceUrl,
				'sugarUser' => $user->user_name,
				'sugarPasswordHash' => $user->user_hash,
			);
			$jsonparams = array();
			$jsonparams[] = array('name' => 'SUGAR_USER_ID', 'value' => $current_user->id);
			$jsonparams[] = array('name' => 'SUGAR_USER_NAME', 'value' => $current_user->user_name);
			$jsonparams[] = array('name' => 'SUGAR_SESSION_ID', 'value' => $_REQUEST['PHPSESSID']);
			foreach ($parameter_values as $name => $value) {			
				$jsonparams[] = array('name' => $name, 'value' => $value);
			}			  
			$jsondata['parameters'] = $jsonparams;
			
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsondata));
				
			$result_json = curl_exec($ch);
			if ($result_json === false) 
			{
				$this->report_output = 'ERROR '.curl_errno($ch).' - '.curl_error($ch);
				return false;
			} 
			else {
				$result = json_decode($result_json);
				
				if ($result->result == "ok") {
					foreach ($result->reportOutputFiles as $outputFile) {
						$file = $archive_dir."/".($outputFile->filename);
						$dir = dirname($file);
						if (!is_dir($dir)) mkdir($dir, 0777, true);
						file_put_contents($file, base64_decode($outputFile->filecontents));
					}
					$this->report_output = $result_json;
					return true;
				} else {
					$this->report_output = $result_json;
					return false;
				}
			}
		}
		else
		{
			$tempdir = ($this->get_temp_dir()).create_guid();	
			$cmdfile = $tempdir."/cmd.properties";
			mkdir($tempdir, 0700);		
			$f = fopen($cmdfile, "w");
			fwrite($f, "jasper.datasource=jdbc\n");

			if ($sugar_config["dbconfig"]["db_type"] == 'mysql') {
				$mysql_port = "3306";
				if (!empty($sugar_config["dbconfig"]["db_port"]))$mysql_port = $sugar_config["dbconfig"]["db_port"];
			
				fwrite($f, "jdbc.driver=com.mysql.jdbc.Driver\n");
				fwrite($f, "jdbc.url=jdbc:mysql://".($sugar_config["dbconfig"]["db_host_name"]).":".$mysql_port."/".($sugar_config["dbconfig"]["db_name"]).html_entity_decode($admin->settings["zuckerreports2_jdbcurlextension"])."\n");
			} else if ($sugar_config["dbconfig"]["db_type"] == 'mssql') {
				fwrite($f, "jdbc.driver=com.microsoft.sqlserver.jdbc.SQLServerDriver\n");
				//fwrite($f, "jdbc.url=jdbc:sqlserver://".($sugar_config["dbconfig"]["db_host_name"])."\\\\".($sugar_config["dbconfig"]["db_host_instance"]).";databaseName=".($sugar_config["dbconfig"]["db_name"]).$admin->settings["zuckerreports2_jdbcurlextension"]."\n");
				fwrite($f, "jdbc.url=jdbc:sqlserver://localhost\\\\".($sugar_config["dbconfig"]["db_host_instance"]).";databaseName=".($sugar_config["dbconfig"]["db_name"]).html_entity_decode($admin->settings["zuckerreports2_jdbcurlextension"])."\n");
			} else {
				return "Database Type ".$sugar_config["dbconfig"]["db_type"]." not supported by ZuckerReports";
			}
			
			fwrite($f, "jdbc.user=".($sugar_config["dbconfig"]["db_user_name"])."\n");
			fwrite($f, "jdbc.password=".($sugar_config["dbconfig"]["db_password"])."\n");
			fwrite($f, "jasper.sourcefile=".$this->compiled_filename."\n");
			fwrite($f, "jasper.targetfile=".$this->report_result."\n");
			fwrite($f, "jasper.format=".$format."\n");
			fwrite($f, "sugar.site_url=".($sugar_config['site_url'])."/\n");
			fwrite($f, "parameter.SUGAR_USER_ID=".($current_user->id)."\n");
			fwrite($f, "parameter.SUGAR_USER_NAME=".($current_user->user_name)."\n");
			fwrite($f, "parameter.SUGAR_SESSION_ID=".($_REQUEST['PHPSESSID'])."\n");
			fwrite($f, "parameter.SUBREPORT_DIR=".($this->resources_folder)."\n");
			foreach ($parameter_values as $name => $value) {			
				fwrite($f, "parameter.".$name."=".$value."\n");
			}		
			fclose($f);

			$classpath = $this->get_classpath();
			$result = $this->execute_java("-classpath ".$classpath." at.go_mobile.zuckerreports.JasperBatchMain ".$cmdfile."");
			
			if ($admin->settings['zuckerreports2_debug_enabled'] != "yes") $this->rec_delete($tempdir);
			return $result;
		}
	}

	function execute_java($args) {
	
		$admin = new Administration();
		$admin->retrieveSettings();
		$pattern = trim(html_entity_decode($admin->settings['zuckerreports2_localjdkpath']));
		
		if (empty($pattern)) {
			if ($this->isWindows()) {
				$pattern = "javaw %ARGS% 2>&1";
			} else {
				$pattern = "java -Djava.awt.headless=true %ARGS% 2>&1";
			}
		}
		$cmdline = str_replace("%ARGS%", $args, $pattern);
		$exec_mode = $admin->settings['zuckerreports2_execmode'];
		
		if (empty($exec_mode) || $exec_mode == "exec") {
			exec($cmdline, $output, $return_var);
			$GLOBALS['log']->debug("execute_java (exec): ".$cmdline." => ".$return_var);
		} 
		else if ($exec_mode == "shell_exec") {
			$output_str = shell_exec($cmdline);
			if ($output_str == NULL) {
				$return_var = 1;
				$output = array();
			} else {
				$return_var = 0;
				$output = explode("\n", $output_str); 
			}
		}
		
		if ($return_var == 0) {			
			$this->report_output = join("<br/>", $output);
			return TRUE;		
		} else {			
			$this->report_output = "cmdline: ".$cmdline." <br/>".join("<br/>", $output);				
			return FALSE;		
		}	
	}
	function execute_cmd($cmdline) {
		exec($cmdline, $output, $return_var);
		$GLOBALS['log']->debug("execute_cmd: ".$cmdline." => ".$return_var);
		
		if ($return_var == 0) {			
			$this->report_output = join("<br/>", $output);
			return TRUE;		
		} else {			
			$this->report_output = "cmdline: ".$cmdline." <br/>".join("<br/>", $output);				
			return FALSE;		
		}	
	}

	function get_classpath() {
	
		if ($this->isWindows()) {
			$cp_sep = ";";
		} else {
			$cp_sep = ":";
		}	

		$classpath = $this->get_resources_dir().$cp_sep.($this->resources_folder);
	
		$jars = array();
		$d = opendir("modules/zr2_Report/jasper");
		if ($d) {
			while (false !== ($file = readdir($d))) {
				if ($file == "." || $file == "..") continue;
				if (endsWith($file, ".zip") || endsWith($file, ".jar")) {
					$jars[] = "modules/zr2_Report/jasper/".$file;
				}
			}
			closedir($d);
			$classpath .= $cp_sep.(implode($cp_sep, $jars));
		}

		if (file_exists($this->resources_folder)) {
			$jars = array();
			$d = opendir($this->resources_folder);
			if ($d) {
				while (false !== ($file = readdir($d))) {
					if ($file == "." || $file == "..") continue;
					if (endsWith($file, ".zip") || endsWith($file, ".jar")) {
						$jars[] = ($this->resources_folder)."/".$file;
					}
				}
				closedir($d);
				$classpath .= $cp_sep.(implode($cp_sep, $jars));
			}
		}
		return '"'.$classpath.'"';
	}
	
	function isWindows() {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	
	function rec_delete($dir) {
		if (file_exists($dir)) {
			$d = opendir($dir);
			while (false !== ($file = readdir($d))) {
				if ($file == "." || $file == "..") continue;
				@unlink($dir."/".$file);
			}
			@rmdir($dir);
		}
	}
		
	function get_format_selection() {
		global $current_language, $app_strings;
	
		$mod_strings = return_module_language($current_language, $this->module_dir);
		$mod_list_strings = return_mod_list_strings_language($current_language, $this->module_dir);
	
		if (isset($_REQUEST["format"])) {
			if (!array_key_exists($_REQUEST["format"], $mod_list_strings["REPORT_EXPORT_TYPES"])) {
				$_REQUEST["format"] = null;
			}
		}
		if (!isset($_REQUEST["format"])) {
			$_REQUEST["format"] = "PDF";
		}
		
		if ($_REQUEST["format"] == "HTML") {
			$this->report_result_type = "FORWARD";
		} else {
			$this->report_result_type = "FILE";
		}
		
		$export_types = $this->get_export_selection_array($_REQUEST['format']);
		return join("\n", $export_types);
	}	
	
	function get_format_scheduler_parameters(&$params) {
		if (!isset($_REQUEST["format"])) {
			$params["format"] = "PDF";
		} else {
			$params["format"] = $_REQUEST["format"];
		}
	}
	
	
}

?>