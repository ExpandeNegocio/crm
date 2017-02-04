<?php 
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

?>

<script src="modules/asol_Process/___common_WFM/plugins_js_css_images/jsLab/LAB.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>" type="text/javascript"></script>

<link href="modules/asol_Process/___common_WFM/css/tabs.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<link href="modules/asol_Process/___common_WFM/css/asol_popupHelp.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<link href="modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/css/jquery.ui.min.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />

<script>

	var asol_var = new Array();
	// WFM
	asol_var['trigger_type'] = "<?php echo $trigger_type; ?>";
	asol_var['conditions'] = "<?php echo $conditions; ?>";
	asol_var['scheduled_tasks'] = "<?php echo $scheduled_tasks; ?>";
	asol_var['translateFieldLabels'] = "<?php echo $translateFieldLabels; ?>";
	//asol_var['moduleTables'] = <?php echo json_encode($moduleTables); ?>;
    // sugarcrm
	asol_var['_REQUEST'] = Array();
	asol_var['_REQUEST']['action'] = "<?php echo $_REQUEST['action']; ?>";
	asol_var['calendar_dateformat'] = "<?php echo $timedate->get_cal_date_format(); ?>";

	asol_var['fields_labels_imploded'] = "<?php echo $fields_labels_imploded; ?>";
	asol_var['fields_type_imploded'] = "<?php echo $fields_type_imploded; ?>";
	asol_var['fields_enum_operators_imploded'] = "<?php echo $fields_enum_operators_imploded; ?>";
	asol_var['fields_enum_references_imploded'] = "<?php echo $fields_enum_references_imploded; ?>";

	asol_var['rhs_key'] = "<?php echo $rhs_key; ?>";
	asol_var['related_fields_type_imploded'] = "<?php echo $related_fields_type_imploded; ?>";
	asol_var['related_fields_enum_operators_imploded'] = "<?php echo $related_fields_enum_operators_imploded; ?>";
	asol_var['related_fields_enum_references_imploded'] = "<?php echo $related_fields_enum_references_imploded; ?>";
	
	// Load javascript-libraries only if needed
	if (typeof jQuery === "undefined") {
		$LAB.script("modules/asol_Process/___common_WFM/js/jquery.min.js").wait().script("modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/js/jquery.ui.min.js").wait(function(){ main(); });
	} else if (typeof jQuery.ui === "undefined") {
		$LAB.script("modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/js/jquery.ui.min.js").wait(function(){ main(); });
	} else {
		 main();
	}
	
	function main() {
		//alert("JQuery is now loaded");

		// jQuery-ui
		$.fx.speeds._default = 500;
		$.extend($.ui.dialog.prototype.options, {width: 500, show: "side", hide: "scale"});
		
		$(document).ready(function() {
			//alert("jQuery ready");
			
			switch (asol_var['trigger_type']) {
				case 'logic_hook':
					visibility_triggerType_logicHook();
					RememberConditions("conditions_Table", asol_var['conditions'], asol_var['calendar_dateformat']);
					break;
				case 'scheduled':
					visibility_triggerType_scheduled();
					RememberTasks("tasks_Table", asol_var['scheduled_tasks'], asol_var['calendar_dateformat']);
					RememberConditions("conditions_Table", asol_var['conditions'], asol_var['calendar_dateformat']);
					break;
				case 'subprocess':
					visibility_triggerType_subprocess();
					break;
				default:
				    visibility_triggerType_logicHook();
			}
						
			$("select#trigger_type").change(function () {
				switch ($(this).val()) {
					case 'logic_hook':
						visibility_triggerType_logicHook();
						break;
					case 'scheduled':
						visibility_triggerType_scheduled();
						break;
					case 'subprocess':
						visibility_triggerType_subprocess();
						break;
				}
			});
			
			// Rewrite the onclick-code of the Save-button (because of ajaxUI-sugarcrm; but in EditView only exist ajax-submit-call-to-javascript-function, not ajaxUI-load-page)
			$("#EditView .primary").each(function() {
				var onclickCode = this.getAttribute("onclick");
				var new_onclickCode = "if (!wfm_save()) {return false}; " + onclickCode;
				$(this).removeAttr("onclick");
				this.setAttribute("onclick", new_onclickCode);
			});
			
			/**
			 *	Old way to collect conditions info
			 *	$("#EditView").bind("submit", function () { document.getElementById("conditions").value=format_conditions('conditions_Table'); } );
			*/
		});
	}

	function wfm_save() {
		switch ($("select#trigger_type").val()) {
			case 'logic_hook':
				if (!checkParenthesis()) {
					return false;
				} 
				document.getElementById('conditions').value = format_conditions('conditions_Table');
				break;
			case 'scheduled':
				if (!checkParenthesis()) {
					return false;
				}
				document.getElementById('scheduled_tasks_hidden').value = format_tasks();
				document.getElementById('conditions').value = format_conditions('conditions_Table');
				break;
			case 'subprocess':
				break;
		}

		return true;
	}

	function visibility_triggerType_logicHook() {
		
		//$("#type, #type_label").css("display", "inline");
		//$("#scheduled_type, #scheduled_type_label").css("display", "none");

		$("#type, #type_label").css("visibility", "visible");
		$("#scheduled_type, #scheduled_type_label").css("visibility", "hidden");
		$("#subprocess_type, #subprocess_type_label").css("visibility", "hidden");

		$("#type, #type_label, #scheduled_type, #scheduled_type_label, #subprocess_type, #subprocess_type_label").css("display", "inline");

		$("#scheduled_tasks_label").parent().css("display", "none");
		$("#trigger_event_label, #trigger_event").css("visibility", "visible");
		$("div#LBL_ASOL_TRIGGERING_PANEL, div#LBL_ASOL_EVENT_CONDITION_PANEL").css("display", "block"); /*For sugarcrm 641*/
		$("#detailpanel_2, #detailpanel_3").css("display", "block"); /*As of sugarcrm 655*/
	}

	function visibility_triggerType_subprocess() {
		
		//$("#type, #type_label").css("display", "none");
		//$("#scheduled_type, #scheduled_type_label").css("display", "inline");

		$("#type, #type_label").css("visibility", "hidden");
		$("#scheduled_type, #scheduled_type_label").css("visibility", "hidden");
		$("#subprocess_type, #subprocess_type_label").css("visibility", "visible");

		$("#type, #type_label, #scheduled_type, #scheduled_type_label, #subprocess_type, #subprocess_type_label").css("display", "inline");
		
		$("div#LBL_ASOL_TRIGGERING_PANEL, div#LBL_ASOL_EVENT_CONDITION_PANEL").css("display", "none"); /*For sugarcrm 641*/
		$("#detailpanel_2, #detailpanel_3").css("display", "none"); /*As of sugarcrm 655*/
	}

	function visibility_triggerType_scheduled() {
		
		//$("#type, #type_label").css("display", "none");
		//$("#scheduled_type, #scheduled_type_label").css("display", "inline");

		$("#type, #type_label").css("visibility", "hidden");
		$("#scheduled_type, #scheduled_type_label").css("visibility", "visible");
		$("#subprocess_type, #subprocess_type_label").css("visibility", "hidden");

		$("#type, #type_label, #scheduled_type, #scheduled_type_label, #subprocess_type, #subprocess_type_label").css("display", "inline");
		
		$("#scheduled_tasks_label").parent().css("display", "");
		$("#trigger_event_label, #trigger_event").css("visibility", "hidden");
		$("div#LBL_ASOL_TRIGGERING_PANEL, div#LBL_ASOL_EVENT_CONDITION_PANEL").css("display", "block"); /*For sugarcrm 641*/
		$("#detailpanel_2, #detailpanel_3").css("display", "block"); /*As of sugarcrm 655*/
	}

</script>

<?php 
require_once("modules/asol_Process/___common_WFM/php/javascript_common_event_activity.php"); 
require_once("modules/asol_Process/___common_WFM/php/javascript_common_event_activity_task.php"); 
?>