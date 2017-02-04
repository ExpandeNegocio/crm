<script>

function fields_onClick(dropdownlist) {
	if (dropdownlist.options[dropdownlist.selectedIndex].style.color == 'blue') { 
		document.getElementById('show_related_button').style.display = 'inline';
	} else {
		document.getElementById('show_related_button').style.display = 'none';
	}
}

function fields_onDblClick(dropdownlist) {
	window.onbeforeunload = function () {
		return;
	};
	
	if (dropdownlist.options[dropdownlist.selectedIndex].style.color == 'blue') { 
		dropdownlist.form.action.value = asol_var['_REQUEST']['action'];
		dropdownlist.form.rhs_key.value = dropdownlist.value;

		if (dropdownlist.form.scheduled_tasks_hidden !== undefined)  {
			dropdownlist.form.scheduled_tasks_hidden.value = format_tasks();
		}
		if (dropdownlist.form.conditions !== undefined) {
			dropdownlist.form.conditions.value = format_conditions('conditions_Table');
		}
		dropdownlist.form.submit();
	}
}

function onClick_showRelated_button(button) {
	window.onbeforeunload = function () {
		return;
	};

	var fields_dropdown = document.getElementById('fields');
	if ((fields_dropdown.options[fields_dropdown.selectedIndex].style.color == 'blue')) {
		button.form.action.value = asol_var['_REQUEST']['action'];
		button.form.rhs_key.value = fields_dropdown.value;

		if (button.form.scheduled_tasks_hidden !== undefined)  {
			button.form.scheduled_tasks_hidden.value = format_tasks();
		}
		if (button.form.conditions !== undefined) {
			button.form.conditions.value = format_conditions('conditions_Table');
		}
		button.form.submit();
	} 
}

function onClick_addFields_button() {
	var result_string = '';
	var result_input = document.getElementById('wfm_variable_result');
	var fields_select = document.getElementById('fields');
	if (result_input !== null) {
		if (document.getElementById('bean').checked) {
			result_string += '${bean->';
		} else {
			result_string += '${old_bean->';
		}

		result_string += fields_select.value +'}';

		result_input.value = result_string;
	} else {
		InsertConditions('conditions_Table', 'fields', asol_var['fields_labels_imploded'], asol_var['fields_type_imploded'], asol_var['fields_enum_operators_imploded'], asol_var['fields_enum_references_imploded'], null, asol_var['rhs_key'], asol_var['related_fields_type_imploded'], asol_var['related_fields_enum_operators_imploded'], asol_var['related_fields_enum_references_imploded'], asol_var['calendar_dateformat']);
	}
}

function onClick_addRelatedFields_button() {

	var result_string = '';
	var result_input = document.getElementById('wfm_variable_result');
	var fields = document.getElementById('related_fields');
	var key = document.getElementById('rhs_key');
	
	if (result_input !== null) {
		for (var i in fields.options) {
	        if (fields.options[i].selected) {
	        	var aux = fields.options[i].getAttribute("label_key");
	        	var aux_array = aux.split('.');
	        	var module = aux_array[0];
	        	var aux2 = fields.options[i].value;
	        	var aux2_array = aux2.split('.');
	        	var field = aux2_array[1];
	        	result_string = '${' +module+ '->' +key.value+ '->' +field+ '}';
		        break;
	        }
		}
		result_input.value = result_string;
	} else {	
		InsertConditions('conditions_Table', null, asol_var['fields_labels_imploded'], asol_var['fields_type_imploded'], asol_var['fields_enum_operators_imploded'], asol_var['fields_enum_references_imploded'], 'related_fields', asol_var['rhs_key'], asol_var['related_fields_type_imploded'], asol_var['related_fields_enum_operators_imploded'], asol_var['related_fields_enum_references_imploded'], asol_var['calendar_dateformat']);
	}
}

function onClick_add_custom_variable_button() {
	InsertConditions_customVariable('conditions_Table');
	document.getElementById('custom_variable').value = '';
	document.getElementById('is_global').checked = false;
}

function onClick_custom_variable_predefined_button() {
	var result_string = '';
	var result_input = document.getElementById('wfm_variable_result');
	var custom_variable_predefined_select = document.getElementById('custom_variable_predefined');
	
	result_string += '${c_var';
	
	result_string += '->' + custom_variable_predefined_select.value;

	if ($('#custom_variable_predefined_secondary option').size() > 0) {
		result_string += '->' + $('#custom_variable_predefined_secondary').val();
	}

	result_string += '}';

	result_input.value = result_string;
}

function onClick_custom_variable_user_defined_button() {
	var result_string = '';
	var result_input = document.getElementById('wfm_variable_result');
	var custom_variable_user_defined_select = document.getElementById('custom_variable_user_defined');
	
	result_string += '${c_var->';
	result_string += custom_variable_user_defined_select.value +'}';

	result_input.value = result_string;
}

function onClick_datetime_button() {
	var result_string = '';
	var result_input = document.getElementById('wfm_variable_result');
	var custom_variable_user_defined_select = document.getElementById('datetime_date');

	result_string += '${';
	result_string += custom_variable_user_defined_select.value +'}';

	result_input.value = result_string;
}

</script>