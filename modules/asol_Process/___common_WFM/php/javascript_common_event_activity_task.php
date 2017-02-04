<script>

function fill_info_icon() {

	var task_type_array = ['send_email', 'php_custom', 'continue', 'end', 'call_process'];
	var lbl_asol_info_icon_array = [];
	for (var i in task_type_array) {
		lbl_asol_info_icon_array[task_type_array[i]] = SUGAR.language.get('asol_Task', 'LBL_ASOL_INFO_ICON_'+task_type_array[i].toUpperCase());
	}

	$("#info_icon").attr("qtip_info", lbl_asol_info_icon_array[$("#task_type").val()]);

	
	$('#info_icon').qtip({
		content: {
			attr: 'qtip_info'
		},
		style: {
			classes: 'ui-tooltip-rounded ui-tooltip-shadow myTooltip'
		},
		position: {
			my: 'bottom right',
			at: 'top left'
		}
	});
}

</script>