<?php
require_once('modules/Administration/Administration.php');
require_once('modules/Users/User.php');
require_once('modules/zr2_Report/ReportProviderBase.php');
require_once('modules/zr2_ReportParameterLink/zr2_ReportParameterLink.php');

class zr2_QueryTemplate extends ReportProviderBase {

	var $name;	
	var $sql1;
	var $description;
	
	var $table_name = "zr2_querytemplate";
	var $object_name = "zr2_QueryTemplate";
	var $module_dir = "zr2_QueryTemplate";
	

	function zr2_QueryTemplate() {		
		parent::ReportProviderBase();		
		$this->new_schema = true;
	}	
	
	function get_summary_text() {		
		return $this->name;	
	}	
	
	function fill_in_additional_detail_fields() {		
		global $current_language, $theme;

		$mod_strings = return_module_language($current_language, "zr2_QueryTemplate");
	
		$this->action_module = $this->module_dir;
		$this->type_desc = $mod_strings["LBL_QUERY"];
		$this->image_html = get_image("themes/".$theme."/images/zr2_QueryTemplate", "alt=\"ZuckerQueryTemplate\"");
		$this->image_module = "zr2_QueryTemplate";
	}			

	function getByName($name) {
		return zr2_QueryTemplate::get_by_name($name);
	}	
	
	function get_by_name($name) {
		$seed = new zr2_QueryTemplate();
		$results = $seed->get_full_list("", "name='".$name."'");
		if (!empty($results)) {
			$result = $results[0];
			$result->retrieve();
			return $result;
		} else {
			return NULL;
		}
	}	

	function get_parameter_links() {
		$this->load_relationship("zr2_reportparameterlink_zr2_querytemplate");
		$related = $this->zr2_reportparameterlink_zr2_querytemplate->getBeans();
		if (empty($related)) return FALSE;
		else return array_values($related);
	}	
	function get_module_link($module_name) {
		$this->load_relationship("zr2_reportparameterlink_zr2_querytemplate");

		$all_related = $this->zr2_reportparameterlink_zr2_querytemplate->getBeans();
		foreach ($all_related as $bean) {
			if ($bean->bind_to_module_name == $module_name) {
				return $bean;
			}
		}
		return FALSE;
	}		
	
	
	
	var $archive_dir;
	var $include_header;
	var $col_delim;
	var $row_delim;
	var $prospect_list_name;
	var $prospect_list_module;
	var $prospect_list_idcol;
	
	
	function execute_request($parameter_values = array(), $archive_dir = "") {

		if (empty($archive_dir)) $archive_dir = $this->get_archive_dir();

		$this->archive_dir = $archive_dir;
		
		if ($_REQUEST["format"] == "CSV") {
			$this->col_delim = $this->get_delim($_REQUEST["col_delim"]);
			$this->row_delim = $this->get_delim($_REQUEST["row_delim"]);
		}
		$this->include_header = isset($_REQUEST["include_header"]);
		
		if ($_REQUEST["format"] == "PROSPECTLIST") {
			$this->prospect_list_name = $_REQUEST["prospect_list_name"];
			$this->prospect_list_module = $_REQUEST["prospect_list_module"];
			$this->prospect_list_idcol = $_REQUEST["prospect_list_idcol"];
		}

		return $this->execute($_REQUEST["format"], $parameter_values, $archive_dir);
	}

	function execute($format = 'CSV', $parameter_values = array(), $archive_dir = "") {
		global $sugar_config, $current_user, $theme;

		if (empty($archive_dir)) $archive_dir = $this->get_archive_dir();

		$date = date("ymd_His");
		
		if ($format == 'CSV') {
			$this->report_result_type = "FILE";
			$this->report_result_name = $date."_".$this->name.".csv";
			$this->report_result_name = strtolower(join("_", explode(" ", $this->report_result_name)));
			$this->report_result = $this->archive_dir."/".$this->report_result_name;
		} else if ($format == 'HTML' || $format == 'SIMPLEHTML') {
			$this->report_result_type = "FILE";
			$this->report_result_name = $date."_".$this->name.".html";
			$this->report_result_name = strtolower(join("_", explode(" ", $this->report_result_name)));
			$this->report_result = $this->archive_dir."/".$this->report_result_name;
		} else if ($format == 'PROSPECTLIST') {
			$this->report_result_type = "FORWARD";
		} else {
			$this->report_result_type = "INLINE";
		}
		
		$seed = new zr2_QueryTemplate();
		$bean = $seed->retrieve($this->id, false);
		
		$sql = $bean->sql1;
		foreach ($parameter_values as $name => $value) {
			$sql = str_replace('$'.$name, ''.$value, $sql);
		}
		$sql = str_replace('$SUGAR_USER_ID', $current_user->id, $sql);
		$sql = str_replace('$SUGAR_USER_NAME', $current_user->user_name, $sql);
		$sql = str_replace('$SUGAR_SESSION_ID', $_REQUEST['PHPSESSID'], $sql);
		$this->report_output .= "Query: ".$sql."<br/>";
		
		$rs =& $this->db->query($sql, false, "Error executing query: ");
		if ($rs) {
			$result = true;

			$rows_found =  $this->db->getRowCount($rs);
			$this->report_output .= "Found ".$rows_found."<br/>";
			$this->report_output .= "Writing to ".$this->report_result."<br/>";
		
			$fields = $this->db->getFieldsArray($rs);
			if ($format == "CSV") {
				$f = fopen($this->report_result, "w");
				
				if ($this->include_header) {
					foreach ($fields as $field) {
						fwrite($f, $field);
						fwrite($f, $this->col_delim);
					}
					fwrite($f, $this->row_delim);
				}
				for($row = $this->db->fetchByAssoc($rs); $row; $row = $this->db->fetchByAssoc($rs))	{
					for ($i = 0; $i < count($fields); $i++) {
						$field = $fields[$i];
						$pieces = explode("\n", $row[$field]);
						$cleaned_pieces = array();
						foreach ($pieces as $piece) {
							$cleaned_pieces[] = trim($piece);
						}
						fwrite($f, join(" ", $cleaned_pieces));
						if ($i != count($fields) - 1) {
							fwrite($f, $this->col_delim);
						}
					}
					fwrite($f, $this->row_delim);
				}
				fclose($f);
				
				
			} else if ($format == "HTML") {
				$f = fopen($this->report_result, "w");
				
				$c = file_get_contents("modules/zr2_QueryTemplate/html/header.html");
				$c = str_replace("{SITE_URL}", $sugar_config["site_url"], $c);
				$c = str_replace("{THEME_URL}", $sugar_config["site_url"]."/themes/".$theme, $c);
				$c = str_replace("{CHARSET}", $this->get_charset(), $c);
				fwrite($f, $c);
				
				fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/table_header.html"));
				if ($this->include_header) {
					fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/table_header_row_start.html"));
					foreach ($fields as $field) {
						$c = file_get_contents("modules/zr2_QueryTemplate/html/table_header_col.html");
						$c = str_replace('{VALUE}', $field, $c);
						fwrite($f, $c);
					}
					fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/table_header_row_end.html"));
				}
				$ext = "1";
				for($row = $this->db->fetchByAssoc($rs); $row; $row = $this->db->fetchByAssoc($rs))	{
					fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/table_row_start.html"));
					
					foreach ($fields as $field) {
						if (empty($row[$field])) {
							$value = "&nbsp;";
						} else {
							$value = $this->format_value_for_html($row[$field]);
						}
						$c = file_get_contents("modules/zr2_QueryTemplate/html/table_row_col".$ext.".html");
						$c = str_replace('{VALUE}', $value, $c);
						fwrite($f, $c);
					}
					fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/table_row_end.html"));
					if ($ext == "1") $ext = "2";
					else $ext = "1";
				}
				fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/table_footer.html"));
				fwrite($f, file_get_contents("modules/zr2_QueryTemplate/html/footer.html"));

				fclose($f);

			} else if ($format == "SIMPLEHTML") {
				$f = fopen($this->report_result, "w");

 				fwrite($f, "<!DOCTYPE html PUBLIC \"-//W3C//DTD html 4.01 Transitional//".$this->get_charset()."\">\n");
 				fwrite($f, "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$this->get_charset()."\"></head>");
 				fwrite($f, "<body><table border=\"1\">");
				if ($this->include_header) {
					fwrite($f, "\n<tr>");
					foreach ($fields as $field) {
						fwrite($f, "<th>".$field."</th>");
					}
					fwrite($f, "</tr>");
				}
				for($row = $this->db->fetchByAssoc($rs); $row; $row = $this->db->fetchByAssoc($rs))	{
					fwrite($f, "\n<tr>");
					foreach ($fields as $field) {
						if (empty($row[$field])) {
							fwrite($f, "<td>&nbsp;</td>");
						} else {
							fwrite($f, "<td>".$this->format_value_for_html($row[$field])."</td>");
						}
					}
					fwrite($f, "</tr>");
				}
				fwrite($f, "\n</table></body></html>");
				fclose($f);
				
			} else if ($format == "PROSPECTLIST") {	
				
				if (in_array($this->prospect_list_idcol, $fields)) 
				{
					require_once("modules/ProspectLists/ProspectList.php");
					$pl = new ProspectList();
					$pl->name = (empty($this->prospect_list_name) ? $this->name : $this->prospect_list_name);
					$pl->assigned_user_id = $current_user->id;
					$pl->save();

					for($row = $this->db->fetchByAssoc($rs); $row; $row = $this->db->fetchByAssoc($rs))	{
						if ($this->prospect_list_module == "Contacts") {
							$pl->load_relationship('contacts');
							$pl->contacts->add($row[$this->prospect_list_idcol]);
						} else if ($this->prospect_list_module == "Leads") {
							$pl->load_relationship('leads');
							$pl->leads->add($row[$this->prospect_list_idcol]);
						} else if ($this->prospect_list_module == "Prospects") {
							$pl->load_relationship('prospects');
							$pl->prospects->add($row[$this->prospect_list_idcol]);
						} else if ($this->prospect_list_module == "Accounts") {
							$pl->load_relationship('accounts');
							$pl->accounts->add($row[$this->prospect_list_idcol]);
						} else if ($this->prospect_list_module == "Users") {
							$pl->load_relationship('users');
							$pl->users->add($row[$this->prospect_list_idcol]);
						}
					}
					$this->report_result = "index.php?module=ProspectLists&action=DetailView&record=".$pl->id;
				}
				else 
				{
					$this->report_output .= '<br/>Query Result has no column named '.$this->prospect_list_idcol.', please choose another column';
					$result = false;				
				}
				
			} else {
				$this->report_result = file_get_contents("modules/zr2_QueryTemplate/html/table_header.html");
				if ($this->include_header) {
					$this->report_result .= file_get_contents("modules/zr2_QueryTemplate/html/table_header_row_start.html");
					foreach ($fields as $field) {
						$c = file_get_contents("modules/zr2_QueryTemplate/html/table_header_col.html");
						$c = str_replace('{VALUE}', $field, $c);
						$this->report_result .= $c;
					}
					$this->report_result .= file_get_contents("modules/zr2_QueryTemplate/html/table_header_row_end.html");
				}
				$ext = "1";
				for($row = $this->db->fetchByAssoc($rs); $row; $row = $this->db->fetchByAssoc($rs))	{
					$this->report_result .= file_get_contents("modules/zr2_QueryTemplate/html/table_row_start.html");
					foreach ($fields as $field) {
						if (empty($row[$field])) {
							$value = "&nbsp;";
						} else {
							$value = $this->format_value_for_html($row[$field]);
						}
						$c = file_get_contents("modules/zr2_QueryTemplate/html/table_row_col".$ext.".html");
						$c = str_replace('{VALUE}', $value, $c);
						$this->report_result .= $c;
					}
					$this->report_result .= file_get_contents("modules/zr2_QueryTemplate/html/table_row_end.html");
					
					if ($ext == "1") $ext = "2";
					else $ext = "1";
				}
				$this->report_result .= file_get_contents("modules/zr2_QueryTemplate/html/table_footer.html");
			}
		
		} else {
			$result = false;
			if ($this->db->dbType == "mysql") {
				$this->report_output .= "MySQL error ".mysql_errno().": ".mysql_error()."<br/>";
			} else {
				$this->report_output .= $this->database->getMessage()."<br/>";
			}			
		}
		return $result;
	}
	
	function get_delim($in) {
		if ($in == "tab") {
			return "\t";
		} else if ($in == "newline") {
			return "\n";
		} else {
			return $in;
		}
	}
	
	function get_format_selection() {
		global $current_language, $app_strings;
	
		$mod_strings = return_module_language($current_language, $this->module_dir);
		$mod_list_strings = return_mod_list_strings_language($current_language, $this->module_dir);
	
		if (isset($_REQUEST["format"])) {
			if (!array_key_exists($_REQUEST["format"], $mod_list_strings["QUERY_EXPORT_TYPES"])) {
				$_REQUEST["format"] = null;
			}
		}
		if (!isset($_REQUEST["format"])) {
			$_REQUEST["format"] = "CSV";
		}
		
		if ($_REQUEST["format"] == "CSV") {
			$this->report_result_type = "FILE";
		} else if ($_REQUEST["format"] == "TABLE") {
			$this->report_result_type = "INLINE";
		} else if ($_REQUEST["format"] == "HTML" || $_REQUEST["format"] == "SIMPLEHTML") {
			$this->report_result_type = "FILE";
		} else if ($_REQUEST["format"] == "PROSPECTLIST") {
			$this->report_result_type = "FORWARD";
		}
		
		asort($mod_list_strings["QUERY_EXPORT_TYPES"]);
		return get_select_options_with_id($mod_list_strings["QUERY_EXPORT_TYPES"], $_REQUEST["format"]);
	}	

	
	function get_format_parameters() {
		global $current_language, $app_strings;
	
		$mod_strings = return_module_language($current_language, $this->module_dir);
		$mod_list_strings = return_mod_list_strings_language($current_language, $this->module_dir);

		$xtpl = new XTemplate('modules/zr2_QueryTemplate/OnDemand.html');
		$xtpl->assign("MOD", $mod_strings);
		$xtpl->assign("APP", $app_strings);		

		if ($_REQUEST["format"] == "CSV") {
			asort($mod_list_strings["COL_DELIMS"]);
			asort($mod_list_strings["ROW_DELIMS"]);
			$xtpl->assign("COL_DELIM_SELECTION", get_select_options_with_id($mod_list_strings["COL_DELIMS"], $_REQUEST["col_delim"]));
			$xtpl->assign("ROW_DELIM_SELECTION", get_select_options_with_id($mod_list_strings["ROW_DELIMS"], $_REQUEST["row_delim"]));
			if (isset($_REQUEST["include_header"])) {
				$xtpl->assign("INCLUDE_HEADER_CHECKED", "checked");
			}
			$xtpl->parse("queryCSV");
			return $xtpl->text("queryCSV");
		} else if ($_REQUEST["format"] == "HTML"  || $_REQUEST["format"] == "SIMPLEHTML") {
			if (isset($_REQUEST["include_header"])) {
				$xtpl->assign("INCLUDE_HEADER_CHECKED", "checked");
			}
			$xtpl->parse("queryHTML");
			return $xtpl->text("queryHTML");
		} else if ($_REQUEST["format"] == "TABLE") {
			if (isset($_REQUEST["include_header"])) {
				$xtpl->assign("INCLUDE_HEADER_CHECKED", "checked");
			}
			$xtpl->parse("queryTABLE");
			return $xtpl->text("queryTABLE");
		} else if ($_REQUEST["format"] == "PROSPECTLIST") {
			$xtpl->assign("PROSPECTLISTNAME", empty($_REQUEST["prospect_list_name"]) ? $this->name : $_REQUEST["prospect_list_name"]);
			$xtpl->assign("PROSPECTLIST_MODULE_SELECTION", get_select_options_with_id($mod_list_strings["PROSPECTLIST_MODULE"], $_REQUEST["prospect_list_module"]));
			$xtpl->assign("PROSPECTLIST_IDCOL", empty($_REQUEST["prospect_list_idcol"]) ? "id" : $_REQUEST["prospect_list_idcol"]);
			$xtpl->parse("queryProspectlist");
			return $xtpl->text("queryProspectlist");
		}
	}
	
	function get_format_scheduler_parameters(&$params) {
		$params["format"] = $_REQUEST["format"];
		if ($_REQUEST["format"] == "CSV") {
			$params["col_delim"] = $_REQUEST["col_delim"];
			$params["row_delim"] = $_REQUEST["row_delim"];
			if (isset($_REQUEST["include_header"])) {
				$params["include_header"] = $_REQUEST["include_header"];
			}
		} else if ($_REQUEST["format"] == "HTML"  || $_REQUEST["format"] == "SIMPLEHTML") {
			if (isset($_REQUEST["include_header"])) {
				$params["include_header"] = $_REQUEST["include_header"];
			}
		} else if ($_REQUEST["format"] == "TABLE") {
			if (isset($_REQUEST["include_header"])) {
				$params["include_header"] = $_REQUEST["include_header"];
			}
		}
	}	
}

?>
