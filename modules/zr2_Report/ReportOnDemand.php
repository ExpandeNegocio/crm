<?php
require_once('XTemplate/xtpl.php');
require_once('modules/zr2_Report/config.php');
require_once('modules/zr2_Report/zr2_Report.php');
require_once('modules/zr2_ReportContainer/zr2_ReportContainer.php');
require_once('modules/zr2_ReportParameter/zr2_ReportParameter.php');
require_once('modules/zr2_ReportParameterLink/zr2_ReportParameterLink.php');
require_once('modules/Administration/Administration.php');
require_once('include/ListView/ListView.php');
require_once('modules/Notes/Note.php');
require_once('include/upload_file.php');
require_once('include/TimeDate.php');
require_once('include/JSON.php');
require_once('include/SugarPHPMailer.php');

$timedate = new TimeDate();
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $mod_list_strings;
global $current_user;
global $current_language;
global $zuckerreports_config;

$admin = new Administration();
$admin->retrieveSettings();



if (empty($current_language)) $current_language = $sugar_config['default_language'];
if (empty($app_strings)) $app_strings = return_application_language($current_language);
if (empty($app_list_strings)) $app_strings = return_app_list_strings_language($current_language);
if (empty($mod_strings)) $mod_strings = return_module_language($current_language, "zr2_Report");
if (empty($mod_list_strings)) $mod_list_strings = return_mod_list_strings_language($current_language, "zr2_Report");

$focus = NULL;

if (isset($_REQUEST['record'])) {
	foreach ($zuckerreports_config["providers"] as $provider) {
		if (!empty($provider["include"])) require_once($provider["include"]);
		
		$seed = new $provider["class_name"];
		if (empty($seed)) continue;
		$focus = $seed->retrieve($_REQUEST['record']);
		if ($focus) break;
	}
}

if (isset($focus)) {
	$title = $mod_strings['LNK_REPORT_ONDEMAND'].": ".$focus->name;
} else {
	$title = $mod_strings['LNK_REPORT_ONDEMAND'];
}
	
echo "\n<p>\n";
echo get_module_title("ZuckerReports", $title, false); 
echo "\n</p>\n";
	
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');
	
$xtpl=new XTemplate ('modules/zr2_Report/ReportOnDemand.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("THEME", $theme);
$xtpl->assign("IMAGE_PATH", $image_path);
	
$templates = array();
foreach ($zuckerreports_config["providers"] as $provider) {
	if (!empty($provider["include"])) require_once($provider["include"]);
		
	$seed = new $provider["class_name"];
	if (empty($seed)) continue;
	$templates1 = $seed->get_all("name");
	if (is_array($templates1)) $templates = array_merge($templates, $templates1);
}
	
if (count($templates) > 0) {
	
	$template_select = array("" => "");
	foreach ($templates as $template) {
		$template_select[$template->id] = $template->get_summary_text();
	}
	asort($template_select);
		
	$xtpl->assign("REPORT_SELECTION_HEADER", get_form_header ($mod_strings["LBL_ONDEMAND_REPORT_SELECTION"], "", false));
	if (empty($focus)) $templateOptions = get_select_options_with_id($template_select, NULL);
	else $templateOptions = get_select_options_with_id($template_select, $focus->id);
	$xtpl->assign("TEMPLATE_SELECTION", $templateOptions);
	$xtpl->parse("report_selection");
	$report_selection = $xtpl->text("report_selection");
	
	if (!empty($focus->id)) {
	
		$xtpl->assign("FORMAT_SELECTION_HEADER", get_form_header ($mod_strings["LBL_ONDEMAND_FORMAT_SELECTION"], "", false));
		$xtpl->assign("FORMAT_SELECTION", $focus->get_format_selection());
		$xtpl->assign("FORMAT_PARAMETERS", $focus->get_format_parameters());

		$xtpl->parse("format_selection");			
		$format_selection = $xtpl->text("format_selection");
	}

	if (!empty($focus->id)) {	
		if ($focus->report_result_type == "FILE") {
			$types = parse_list_modules($app_list_strings['record_type_display_notes']);
			$types = array_merge(array("" => ""), $types);
			asort($types);
		
			$xtpl->assign("TYPE_OPTIONS", get_select_options_with_id($types, empty($_REQUEST['parent_module']) ? NULL : $_REQUEST['parent_module']));
		
			//$change_parent_button = "<input title='".$app_strings['LBL_CHANGE_BUTTON_TITLE']."' type='button' class='button' value='".$app_strings['LBL_CHANGE_BUTTON_LABEL']."' name='parent_button' onclick='return window.open(\"index.php?module=\"+ document.EditView.parent_module.value + \"&action=Popup&html=Popup_picker&form=TasksEditView\",\"test\",\"width=600,height=400,resizable=1,scrollbars=1\");'>";
			//$xtpl->assign("CHANGE_PARENT_BUTTON", $change_parent_button);
			$popup_request_data = array(
				'call_back_function' => 'set_return',
				'form_name' => 'EditView',
				'field_to_name_array' => array(
					'id' => 'parent_id',
					'name' => 'parent_name',
				),
			);
			$json = new JSON(JSON_LOOSE_TYPE);
			$encoded_popup_request_data = $json->encode($popup_request_data);
			
			$xtpl->assign('encoded_popup_request_data', $encoded_popup_request_data);
			$xtpl->assign("ATTACH_SELECTION_HEADER", get_form_header ($mod_strings["LBL_ONDEMAND_ATTACH_SELECTION"], "", false));
			$xtpl->assign("PARENT_ID", empty($_REQUEST['parent_id']) ? NULL : $_REQUEST['parent_id']);
			$xtpl->assign("PARENT_NAME", empty($_REQUEST['parent_name']) ? NULL : $_REQUEST['parent_name']);
			$cat_options = zr2_ReportContainer::get_category_select_options();
			asort($cat_options);
			$xtpl->assign("CAT_OPTIONS", get_select_options_with_id($cat_options, empty($_REQUEST['parent_category']) ? NULL : $_REQUEST['parent_category']));
			$xtpl->assign("SEND_EMAIL", $_REQUEST['send_email']);
			
			$xtpl->parse("attach_selection");
			$attach_selection = $xtpl->text("attach_selection");
		} else {
			$xtpl->assign("PARENT_ID", empty($_REQUEST['parent_id']) ? NULL : $_REQUEST['parent_id']);
			$xtpl->assign("PARENT_MODULE", empty($_REQUEST['parent_module']) ? NULL : $_REQUEST['parent_module']);	
			$xtpl->assign("PARENT_NAME", empty($_REQUEST['parent_name']) ? NULL : $_REQUEST['parent_name']);
			
			$xtpl->parse("attach_selection_hidden");
			$attach_selection = $xtpl->text("attach_selection_hidden");
		}
	}		
		
	if (!empty($focus->id)) {

		$links = $focus->get_parameter_links();
		
		if ($links && count($links) > 0) {
			$input_required = false;
			foreach ($links as $link) {
				$link->fill_in_additional_detail_fields();
				if ($link->parameter) {
					$parameter_html .= zr2_ReportParameter::get_parameter_html($link->parameter, $link);
					
					if ($link->parameter->input_required()) $input_required = true;
				}
			}
			if ($input_required) {
				$xtpl->assign("PARAMETER_HEADER", get_form_header ($mod_strings["LBL_ONDEMAND_PARAMETERS"], "", false));
				$xtpl->assign("PARAMETERS", $parameter_html);
				$xtpl->parse("parameters");			
				$parameters = $xtpl->text("parameters");
			} else {
				$parameters = $parameter_html;
			}
		}
	}

	if (!empty($focus->id)) {
		$xtpl->parse("execbutton");			
		$execbutton = $xtpl->text("execbutton");
	}
	
	if (!empty($report_selection)) $xtpl->assign("REPORT_SELECTION", $report_selection);
	if (!empty($format_selection)) $xtpl->assign("FORMAT_SELECTION", $format_selection);
	if (!empty($attach_selection)) $xtpl->assign("ATTACH_SELECTION", $attach_selection);
	if (!empty($parameters)) $xtpl->assign("PARAMETERS", $parameters);
	if (!empty($execbutton)) $xtpl->assign("EXEC_BUTTON", $execbutton);
	if (!empty($schedulebutton)) $xtpl->assign("SCHEDULE_BUTTON", $schedulebutton);
	
	$xtpl->parse("main");
	$xtpl->out("main");
}
	
	
if (!empty($focus->id) && $_REQUEST['run'] == "true") {

	$parameter_values = array();
	$links = $focus->get_parameter_links();
	if ($links && count($links) > 0) {
		foreach ($links as $link) {
			$parameter_values[$link->name] = zr2_ReportParameter::get_parameter_value($link->parameter, $link);
		}
	}
	$success = $focus->execute_request($parameter_values);
		
	if ($success) {
		
		if ($focus->report_result_type == "FILE") {
			if (!empty($_REQUEST['parent_category'])) {
				$report = new zr2_Report();
				if ($admin->settings['zuckerreports2_debug_enabled'] == "yes") $report->description = $focus->report_output;
				$report->filename = $focus->report_result_name;
				$report->name = $focus->report_result_name;
				$report->assigned_user_id = $current_user->id;
				$report->save();
				
				$report->load_relationship("zr2_reportcontainer_zr2_report");
				$report->zr2_reportcontainer_zr2_report->add($_REQUEST['parent_category']);
				
				$note = new Note();
				$note->name = $focus->report_result_name;
				if ($admin->settings['zuckerreports2_debug_enabled'] == "yes") $note->description = $focus->report_output;
				$note->filename = $focus->report_result_name;
				$note->parent_type = "zr2_Report";
				$note->parent_id = $report->id;
				$note->id = $report->id;
				$note->new_with_id = true;
				$note->save();
				
				$uf = new UploadFile("upload");
				$uf->set_for_soap($focus->report_result_name, file_get_contents($focus->report_result));
				$uf->stored_file_name = $uf->create_stored_filename();
				$uf->final_move($report->id);
				$cat_url = "index.php?action=DetailView&module=zr2_Report&record=".($report->id);
			} 
			if (!empty($_REQUEST['parent_module'])) {
			
				$note = new Note();
				$note->name = $focus->name;
				if ($admin->settings['zuckerreports2_debug_enabled'] == "yes")  $note->description = $focus->report_output;
				$note->filename = $focus->report_result_name;
				if ($_REQUEST['parent_module'] == 'Contacts') {
					$note->contact_id = $_REQUEST['parent_id'];
				} else {
					$note->parent_type = $_REQUEST['parent_module'];
					$note->parent_id = $_REQUEST['parent_id'];
				}
				$note->save();
			
				$uf = new UploadFile("upload");
				$uf->set_for_soap($focus->report_result_name, file_get_contents($focus->report_result));
				$uf->stored_file_name = $uf->create_stored_filename();
				$uf->final_move($note->id);
					
				$note_url = "index.php?action=DetailView&module=Notes&record=".($note->id)."&return_module=zr2_Report&return_action=ReportOnDemand";
			}

			if (!empty($_REQUEST['send_email'])) {

				$mail = new SugarPHPMailer();
				$mail->setMailer();
				$emails = split(",", $_REQUEST['send_email']);
				foreach ($emails as $email) {
					$mail->AddAddress($email);
				}
				$reportname = (empty($_REQUEST["reportname"]) ? $focus->get_summary_text() : $_REQUEST["reportname"]);
				
				$mail->From = $admin->settings['notify_fromaddress'];
				$mail->FromName = empty($admin->settings['notify_fromname']) ? ' ' : $admin->settings['notify_fromname'];
				$mail->Subject = sprintf($mod_strings["LBL_SEND_EMAIL_SUBJECT"], $reportname);
				$mail->Body = sprintf($mod_strings["LBL_SEND_EMAIL_BODY"], date('Y-m-d H:i:s', time()), $reportname);
				$mail->AddAttachment($focus->report_result);

				if($mail->Send()) {
					$mail_msg = sprintf($mod_strings["LBL_SEND_EMAIL_OK"], $_REQUEST['send_email']);
				} else {
					$mail_msg = $mail->ErrorInfo;
				}
			}

			if (!empty($note_url)) {
				header("Location: ".$note_url);
				sugar_die();
			} else if (!empty($cat_url)) {
				header("Location: ".$cat_url);
				sugar_die();
			} else if (!empty($mail_msg)) {
				?>
				<script language="javascript">window.alert('<?php echo $mail_msg; ?>');</script>
				<?php
				if ($admin->settings['zuckerreports2_debug_enabled'] == "yes") echo $focus->report_output;
			} else {
				?>
				<script language="javascript">window.open('<?php echo $focus->report_result; ?>', '_blank');</script>
				<?php
				if ($admin->settings['zuckerreports2_debug_enabled'] == "yes") echo $focus->report_output;
			}
			
		} else if ($focus->report_result_type == "FORWARD") {
			header("Location: ".($focus->report_result));
			sugar_die();
		} else {
			if ($admin->settings['zuckerreports2_debug_enabled'] == "yes") echo $focus->report_output;
			echo get_form_header ($mod_strings["LBL_ONDEMAND_RESULT"], "", false);
			echo $focus->report_result;
		}
	} else {
		echo "\n<p>\n";
		echo  	get_form_header ($mod_strings['LBL_ONDEMAND_OUTPUT'], "", false);
		echo "\n</p>\n";
		echo $mod_strings['LBL_ONDEMAND_ERROR'];
		$xtpl->assign("REPORT_OUTPUT", $focus->report_output);
		$xtpl->parse("runerror");
		$xtpl->out("runerror");
	}
}
?>