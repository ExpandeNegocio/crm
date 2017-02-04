<script>

function onChange_time(dropdown) {
	var time = dropdown.options[dropdown.selectedIndex].value;
	var max_time_amount = SUGAR.language.get('app_list_strings', 'wfm_delay_time_amount')[time];
	
	var time_amount_dropdown = document.getElementById("time_amount");
	time_amount_dropdown.length = max_time_amount;
	
	for (var i=0; i<max_time_amount; i++) {
		time_amount_dropdown.options[i].text = i;
	}
}

</script>