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
	asol_var['conditions'] = "<?php echo $conditions; ?>";
	asol_var['translateFieldLabels'] = "<?php echo $translateFieldLabels; ?>";
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
			
			RememberConditions("conditions_Table", asol_var['conditions'], asol_var['calendar_dateformat']);
			
			// Rewrite the onclick-code of the Save-button (because of ajaxUI-sugarcrm; but in EditView only exist ajax-submit-call-to-javascript-function, not ajaxUI-load-page)
			$("#EditView .primary").each(function() {
				var onclickCode = this.getAttribute("onclick");
				var new_onclickCode = "if (!wfm_save()) {return false}; " + onclickCode;
				$(this).removeAttr("onclick");
				this.setAttribute("onclick", new_onclickCode);
			});
			
			/**
			 **** Old way to collect conditions info
			 	$("#EditView").bind("submit", function () { document.getElementById("activity_conditions").value=format_conditions(\'conditions_Table\'); } );
			*/
		});
	}

	function wfm_save () {
		if (!checkParenthesis()) {
			return false;
		} 
		document.getElementById('conditions').value = format_conditions('conditions_Table');

		return true;
	}
			
</script>

<?php 
require_once("modules/asol_Process/___common_WFM/php/javascript_common_event_activity.php"); 
require_once("modules/asol_Process/___common_WFM/php/javascript_common_activity_task.php"); 
require_once("modules/asol_Process/___common_WFM/php/javascript_common_event_activity_task.php"); 
?>