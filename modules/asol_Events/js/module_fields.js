function InsertConditions(idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, idSelectRelatedFields, key, typeRelatedFields, related_enum_operator, related_enum_reference, calendar_dateformat) {
				
    var table = document.getElementById(idTable);
    var fields = document.getElementById(idSelectFields);
    //alert(fields);
    var types = typeFields.split("${comma}");
    
    var enum_operator_array = enum_operator.split("${comma}");
    var enum_reference_array = enum_reference.split("${comma}");
    
    var related_fields = document.getElementById(idSelectRelatedFields);
    var related_types = typeRelatedFields.split("${comma}");
    
    var related_enum_operator_array = related_enum_operator.split("${comma}");
    var related_enum_reference_array = related_enum_reference.split("${comma}");
    
	var fieldsLabelsAlias = fieldLabels.split("${pipe}");
	
    if (fields != null) {
    	InsertConditions_fields_And_related_fields("false", table, fields, types, enum_operator_array, enum_reference_array, "", calendar_dateformat);
    }
    
    if (related_fields != null) {
    	InsertConditions_fields_And_related_fields("true", table, related_fields, related_types, related_enum_operator_array, related_enum_reference_array, key, calendar_dateformat);
    }
}

function InsertConditions_customVariable(idTable) {

    var name = document.getElementById('custom_variable').value;
    var key = (document.getElementById('is_global').checked) ? 'g_c_var' : 'c_var';
    
    var table = document.getElementById(idTable);

    var rowIndex = document.getElementById("uniqueRowIndexes").value;

    var row = document.createElement("tr");
    row.setAttribute("class", "conditions_oddListRowS1");
    
    var cell_Logical_Parameters = document.createElement("td");
    var cell_Field = document.createElement("td");
    var cell_OldBean_NewBean_Changed = document.createElement("td");
    var cell_IsChanged = document.createElement("td");
    var cell_Operator = document.createElement("td");
    var cell_First_Parameter = document.createElement("td");
    var cell_Second_Parameter = document.createElement("td");
    var cell_Function = document.createElement("td");
    var cell_Button = document.createElement("td");
    cell_Button.align = "right";
    
    // (rowIndex, key, internal_value, label_key, label)
    
    cell_Logical_Parameters.innerHTML = generate_Logical_Parameters_HTML_and_Remember_DataBase_if_needed(rowIndex, "0:0:");
    var fieldName_array = {0:name, 1:'', 2:''};
    cell_Field.innerHTML = generate_Name_of_the_Field_HTML(rowIndex, key, fieldName_array);
    cell_OldBean_NewBean_Changed.innerHTML = generate_OldBean_NewBean_Changed_HTML_and_Remember_DataBase_if_needed(rowIndex, 'true', "new_bean");
    cell_IsChanged.innerHTML = generate_IsChanged_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
    
    // int
    cell_Operator.innerHTML = generate_Operator_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
    cell_First_Parameter.innerHTML = generate_First_Parameter_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
    cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_int_HTML(rowIndex);

    cell_Function.innerHTML = acv_generateFunction_HTML(rowIndex, '', key, 'en_us');

    cell_Button.innerHTML = generate_Button_detele_row_HTML(rowIndex, key, key, 'true', '', '', '');
   
    row.appendChild(cell_Logical_Parameters);
    row.appendChild(cell_Field);
    row.appendChild(cell_OldBean_NewBean_Changed);
    row.appendChild(cell_IsChanged);
    row.appendChild(cell_Operator);
    row.appendChild(cell_First_Parameter);
    row.appendChild(cell_Second_Parameter);
    row.appendChild(cell_Function);
    row.appendChild(cell_Button);
    table.getElementsByTagName('tbody')[0].appendChild(row);

    document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
}

function InsertConditions_fields_And_related_fields(isRelated, table, fields, types, enum_operator, enum_reference, key, calendar_dateformat) {
	
	var param1 = new Array();
    var param2 = new Array();
    
    var keys = key.split("${comma}");

	for (var i in fields.options) {

        if (fields.options[i].selected) {
        	
        	key = (keys.length == 1) ? key : keys[i];
        	
        	var rowIndex = document.getElementById("uniqueRowIndexes").value;

            var row = document.createElement("tr");
            row.setAttribute("class", "conditions_oddListRowS1");
            var cell_Logical_Parameters = document.createElement("td");
            var cell_Field = document.createElement("td");
            var cell_OldBean_NewBean_Changed = document.createElement("td");
            var cell_IsChanged = document.createElement("td");
            var cell_Operator = document.createElement("td");
            var cell_First_Parameter = document.createElement("td");
            var cell_Second_Parameter = document.createElement("td");
            var cell_Function = document.createElement("td");
            var cell_Button = document.createElement("td");
            cell_Button.align = "right";
            
            // (rowIndex, key, internal_value, label_key, label)
            
            cell_Logical_Parameters.innerHTML = generate_Logical_Parameters_HTML_and_Remember_DataBase_if_needed(rowIndex, "0:0:");
            var fieldName_array = {0:fields.options[i].value, 1:fields.options[i].getAttribute("label_key"), 2:fields.options[i].text};
            cell_Field.innerHTML = generate_Name_of_the_Field_HTML(rowIndex, key, fieldName_array);
            cell_OldBean_NewBean_Changed.innerHTML = generate_OldBean_NewBean_Changed_HTML_and_Remember_DataBase_if_needed(rowIndex, isRelated, "new_bean");
            cell_IsChanged.innerHTML = generate_IsChanged_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
            
			if (types[i].indexOf("int") === 0)
				types[i] = "int";
			
            switch (types[i]) {

            	case "enum":
            		cell_Operator.innerHTML = generate_Operator_for_enum_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                    
                    cell_First_Parameter.innerHTML = generate_First_Parameter_for_enum_HTML_and_Remember_DataBase_if_needed(rowIndex, "", "", enum_operator[i], enum_reference[i]);
                    cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_enum_HTML(rowIndex);
                    break;
    			
            	case 'bigint':
				case 'tinyint':	
        		case "int":
                case "double":
                case "currency":
                case "decimal":
                case 'c_var':///+++
                	
                	cell_Operator.innerHTML = generate_Operator_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                	cell_First_Parameter.innerHTML = generate_First_Parameter_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                    cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_int_HTML(rowIndex);
                    break;

                case "timestamp":
                case "datetime":
                case "date":
                	cell_Operator.innerHTML = generate_Operator_for_datetime_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                	var fixed_str = generate_var_fixed_str_for_First_Parameter_for_datetime_HTML_and_Remember_DataBase_if_needed("");
                	cell_First_Parameter.innerHTML = generate_First_Parameter_for_datetime_HTML(rowIndex, "input", "", fixed_str);
                	param1[param1.length] = rowIndex;
                	cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_datetime_HTML(rowIndex, "none", "none", "true", "");
                	param2[param2.length] = rowIndex;
                    break;

                case "tinyint(1)":
                	cell_Operator.innerHTML = generate_Operator_for_tinyint_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                	cell_First_Parameter.innerHTML = generate_First_Parameter_for_tinyint_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                    cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_tinyint_HTML(rowIndex);
                    break;

                default:
                	cell_Operator.innerHTML = generate_Operator_for_default_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                	cell_First_Parameter.innerHTML = generate_First_Parameter_for_default_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
                    cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_default_HTML(rowIndex);
                    break;
            }
            
            cell_Function.innerHTML = acv_generateFunction_HTML(rowIndex, '', types[i], 'en_us');
		
            cell_Button.innerHTML = generate_Button_detele_row_HTML(rowIndex, types[i], key, isRelated, i, enum_operator[i], enum_reference[i]);
           
            row.appendChild(cell_Logical_Parameters);
            row.appendChild(cell_Field);
            row.appendChild(cell_OldBean_NewBean_Changed);
            row.appendChild(cell_IsChanged);
            row.appendChild(cell_Operator);
            row.appendChild(cell_First_Parameter);
            row.appendChild(cell_Second_Parameter);
            row.appendChild(cell_Function);
            row.appendChild(cell_Button);
            table.getElementsByTagName('tbody')[0].appendChild(row);

           
            // Initialization: datetime, date
            for (var i in param1) {
            	Calendar.setup ({ inputField : "Param1_"+param1[i] , daFormat : calendar_dateformat, button : "trigger_"+param1[i] , singleClick : true, dateStr : '', step : 1, weekNumbers:false });
            }
            for (var i in param2) {
            	Calendar.setup ({ inputField : "Param2_"+param2[i] , daFormat : calendar_dateformat, button : "trigger2_"+param2[i] , singleClick : true, dateStr : '', step : 1, weekNumbers:false });
            }
            
            document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
        }
	}
}

function RememberConditions(idTable, condition_Values, calendar_dateformat) {

    var param1 = new Array();
    var param2 = new Array();

    var table = document.getElementById(idTable);
    //alert(condition_Values);
    condition_Values = condition_Values.replace(/"/g, "&quot;");
    //alert(condition_Values);
    var conditions = condition_Values.split("${pipe}");

    if (condition_Values != "") {

        for (var i in conditions) {
        	
        	var rowIndex = document.getElementById("uniqueRowIndexes").value;

    		var values = conditions[i].split("${dp}");
    		// BEGIN - values array
    		var fieldName = values[0];
    		var fieldName_array = fieldName.split("${comma}");
    		var OldBean_NewBean_Changed = values[1];
    		var isChanged = values[2];
    		var operator = values[3];
    		var Param1 = values[4];
    		var Param2 = values[5];
    		var fieldType = values[6];
    		var key = values[7];
    		var isRelated = values[8];
    		var fieldIndex = values[9];// index of module_fields, not rowIndex
            var enum_operator = values[10];
            var enum_reference = values[11];
            var logical_parameters = values[12];
            var ffunction = values[13];
    		// END - values array
            var row = document.createElement("tr");
            row.setAttribute("class", "conditions_oddListRowS1");
            var cell_Logical_Parameters = document.createElement("td");
            var cell_Field = document.createElement("td");
            var cell_OldBean_NewBean_Changed = document.createElement("td");
            var cell_IsChanged = document.createElement("td");
            var cell_Operator = document.createElement("td");
            var cell_First_Parameter = document.createElement("td");
            var cell_Second_Parameter = document.createElement("td");
            var cell_Function = document.createElement("td");
            var cell_Button = document.createElement("td");
            cell_Button.align = "right";
            
            cell_Logical_Parameters.innerHTML = generate_Logical_Parameters_HTML_and_Remember_DataBase_if_needed(rowIndex, logical_parameters);
            cell_Field.innerHTML = generate_Name_of_the_Field_HTML(rowIndex, key, fieldName_array);
            cell_OldBean_NewBean_Changed.innerHTML = generate_OldBean_NewBean_Changed_HTML_and_Remember_DataBase_if_needed(rowIndex, isRelated, OldBean_NewBean_Changed);
            cell_IsChanged.innerHTML = generate_IsChanged_HTML_and_Remember_DataBase_if_needed(rowIndex, isChanged) ;
			
            // initial values of disabled property for selects -> at the end of this function
			
			if (fieldType.indexOf("int") === 0)
				fieldType = "int";
			
            switch (fieldType) {

				case "enum":
					cell_Operator.innerHTML = generate_Operator_for_enum_HTML_and_Remember_DataBase_if_needed(rowIndex, operator);
					cell_First_Parameter.innerHTML = generate_First_Parameter_for_enum_HTML_and_Remember_DataBase_if_needed(rowIndex, operator, Param1, enum_operator, enum_reference);
					cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_enum_HTML(rowIndex);
					break;
				
				case 'bigint':
				case 'tinyint':	
				case "int":
				case "double":
				case "currency":
				case "decimal":
				case 'c_var':///+++
					
					cell_Operator.innerHTML = generate_Operator_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, operator);
					cell_First_Parameter.innerHTML = generate_First_Parameter_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, Param1);
					cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_int_HTML(rowIndex);
					break;

				case "timestamp":
				case "datetime":
				case "date":
					cell_Operator.innerHTML = generate_Operator_for_datetime_HTML_and_Remember_DataBase_if_needed(rowIndex, operator);
					
					var fixed_str = generate_var_fixed_str_for_First_Parameter_for_datetime_HTML_and_Remember_DataBase_if_needed(Param1);
					
					switch (operator) {
						case "last":
						case "this":
						case "next":
						case "not last":
						case "not this":
						case "not next":
							cell_First_Parameter.innerHTML = generate_First_Parameter_for_datetime_HTML(rowIndex, "select", "", fixed_str);
							param1[param1.length] = rowIndex;
							break;
						default: // [between, not between]
							cell_First_Parameter.innerHTML = generate_First_Parameter_for_datetime_HTML(rowIndex, "input", Param1, fixed_str);
							param1[param1.length] = rowIndex;
							break;
					}
					
					switch (operator) {
						case "between":
						case "not between":
							cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_datetime_HTML(rowIndex, "inline", "inline", "true", Param2);
							param2[param2.length] = rowIndex;
							break;
						case "last":
						case "next":
						case "not last":
						case "not next":
							cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_datetime_HTML(rowIndex, "inline", "none", "false", Param2);
							param2[param2.length] = rowIndex;
							break;
						default: // [this, not this]
							cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_datetime_HTML(rowIndex, "none", "none", "true", Param2);
							param2[param2.length] = rowIndex;
							break;
					}
					
					break;

				case "tinyint(1)":
					cell_Operator.innerHTML = generate_Operator_for_tinyint_HTML_and_Remember_DataBase_if_needed(rowIndex, operator);
					cell_First_Parameter.innerHTML = generate_First_Parameter_for_tinyint_HTML_and_Remember_DataBase_if_needed(rowIndex, Param1);
					cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_tinyint_HTML(rowIndex);
					break;

				default:
					cell_Operator.innerHTML = generate_Operator_for_default_HTML_and_Remember_DataBase_if_needed(rowIndex, operator);
					cell_First_Parameter.innerHTML = generate_First_Parameter_for_default_HTML_and_Remember_DataBase_if_needed(rowIndex, Param1);
					cell_Second_Parameter.innerHTML = generate_Second_Parameter_for_default_HTML(rowIndex);
					break;
            }

            cell_Function.innerHTML = acv_generateFunction_HTML(rowIndex, ffunction, fieldType, 'en_us');
            
            cell_Button.innerHTML = generate_Button_detele_row_HTML(rowIndex, fieldType, key, isRelated, fieldIndex, enum_operator, enum_reference);
            
            row.appendChild(cell_Logical_Parameters);
            row.appendChild(cell_Field);
            row.appendChild(cell_OldBean_NewBean_Changed);
            row.appendChild(cell_IsChanged);
            row.appendChild(cell_Operator);
            row.appendChild(cell_First_Parameter);
            row.appendChild(cell_Second_Parameter);
            row.appendChild(cell_Function);
            row.appendChild(cell_Button);
            table.getElementsByTagName('tbody')[0].appendChild(row);
            
            // initial disabled values for selects
            if (isRelated == "true") {	// if is_related
            	cell_OldBean_NewBean_Changed.childNodes[0].style.visibility = "hidden";
            	cell_IsChanged.childNodes[0].style.visibility = "hidden";
				
				cell_Operator.childNodes[0].style.visibility = "visible";
				cell_First_Parameter.style.visibility = "visible";
				cell_Second_Parameter.style.visibility = "visible";
            } else {
                if (OldBean_NewBean_Changed == "changed") {
					cell_IsChanged.childNodes[0].style.visibility = "visible";
					
					cell_Operator.childNodes[0].style.visibility = "hidden";
					cell_First_Parameter.style.visibility = "hidden";
					cell_Second_Parameter.style.visibility = "hidden";
				} else {
					cell_IsChanged.childNodes[0].style.visibility = "hidden";
					
					cell_Operator.childNodes[0].style.visibility = "visible";
					cell_First_Parameter.style.visibility = "visible";
					cell_Second_Parameter.style.visibility = "visible";
				}
            }
            
            document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
        }
        
        // Initialization: datetime, date
        for (var i in param1) {
        	Calendar.setup ({ inputField : "Param1_"+param1[i] , daFormat : calendar_dateformat, button : "trigger_"+param1[i] , singleClick : true, dateStr : '', step : 1, weekNumbers:false });
        }
        for (var i in param2) {
        	Calendar.setup ({ inputField : "Param2_"+param2[i] , daFormat : calendar_dateformat, button : "trigger2_"+param2[i] , singleClick : true, dateStr : '', step : 1, weekNumbers:false });
        }
    }
}

function format_conditions(idConditionsTable) {

    //Escapar caracteres conflictivos
	
	var uniqueRowIndexes = parseInt(document.getElementById("uniqueRowIndexes").value);
	
    var parsed_string = "";

    for (var rowIndex=0; rowIndex<uniqueRowIndexes; rowIndex++) {

    	if (document.getElementById('fieldName_'+rowIndex) !== null) {	
    	
    		// j==0
			parsed_string += document.getElementById('fieldName_'+rowIndex).getAttribute("value") +"${comma}"+ document.getElementById('fieldName_'+rowIndex).getAttribute("label_key") +"${comma}"+ document.getElementById('fieldName_'+rowIndex).innerHTML;
			parsed_string += "${dp}";
    			
    		// j==1   -> OldBean_NewBean_Changed
			parsed_string += document.getElementById('OldBean_NewBean_Changed_'+rowIndex).value.replace(/[\\]/g , "\\\\").replace(/[']/g , "\\\'").replace(/[%]/g , "\\\%").replace(/[_]/g , "\\\_");
			parsed_string += "${dp}";
    			
			// j==2   -> isChanged
			parsed_string += document.getElementById('isChanged_'+rowIndex).value.replace(/[\\]/g , "\\\\").replace(/[']/g , "\\\'").replace(/[%]/g , "\\\%").replace(/[_]/g , "\\\_");
			parsed_string += "${dp}";
    		
			// j==3   -> operator
			parsed_string += document.getElementById('operator_'+rowIndex).value.replace(/[\\]/g , "\\\\").replace(/[']/g , "\\\'").replace(/[%]/g , "\\\%").replace(/[_]/g , "\\\_");
			parsed_string += "${dp}";
    		
			// j==4   -> Param1 o Param1_select
			var Param1 = document.getElementById('Param1_'+rowIndex);
			var operator = document.getElementById('operator_'+rowIndex);
			
			if (Param1 == "[object HTMLSelectElement]") { // field_type == enum
			
                var options = Param1.options;
                var values = "";
                for ( var k = 0; k < options.length; k++) {
                	if (Param1.options[k].selected == true)
                		values += Param1.options[k].value + "${dollar}";
                }
                values = values.slice(0, -9);

                parsed_string += values;
                
			} else if (  (operator.value == "last") || (operator.value == "this") || (operator.value == "next" ) || (operator.value == "not last") || (operator.value == "not this") || (operator.value == "not next")  ) {// part of datetime
				 
				parsed_string += document.getElementById('Param1_select_'+rowIndex).value;
			} else { // part of datetime, varchar, tinyint, int ...   -----> all but enum and part of datetime
				parsed_string += Param1.value.replace(/[\\]/g , "\\\\").replace(/[']/g , "\\\'").replace(/[%]/g , "\\\%").replace(/[_]/g , "\\\_");
			}
			
			parsed_string += "${dp}";

    		// j==5 Param2
			parsed_string += document.getElementById('Param2_'+rowIndex).value.replace(/[\\]/g , "\\\\").replace(/[']/g , "\\\'").replace(/[%]/g , "\\\%").replace(/[_]/g , "\\\_");
 			parsed_string += "${dp}";
    			 
            // j==6
            parsed_string += document.getElementById('value_type_'+rowIndex).value + "${dp}";
            parsed_string += document.getElementById('key_'+rowIndex).value + "${dp}";
            parsed_string += document.getElementById('is_related_'+rowIndex).value + "${dp}";
            parsed_string += document.getElementById('index_'+rowIndex).value + "${dp}";
            parsed_string += document.getElementById('enum_operator_'+rowIndex).value + "${dp}";
            parsed_string += document.getElementById('enum_reference_'+rowIndex).value + "${dp}";
            
            // j==12
            parsed_string += document.getElementById("parenthesis_"+rowIndex).value + ":" + document.getElementById("logical_operator_"+rowIndex).value + "${dp}";
    	
            // j==13
            parsed_string += document.getElementById("function_"+rowIndex).value +"${comma}"+ document.getElementById("configure_calculated_value_"+rowIndex).value;
            
            parsed_string += "${pipe}";
    	}
    }

    parsed_string = parsed_string.slice(0, -7);
    //alert(parsed_string);
    return parsed_string;
}

function insert_Task(idTable, calendar_dateformat) {

	var taskIndex = document.getElementById('tasksGlobalIndex').value;
	
    var table = document.getElementById(idTable);
    var row = document.createElement("tr");
    row.setAttribute("class", "scheduledTasks_oddListRowS1");

    
    var cell_Task = document.createElement("td");
    var cell_Range = document.createElement("td");
    var cell_Day_Parameter = document.createElement("td");
    var cell_Time_Parameter = document.createElement("td");
    var cell_End_Date = document.createElement("td");
    var cell_State = document.createElement("td");
    var cell_Button = document.createElement("td");
    cell_Button.align = "right";

    cell_Task.innerHTML = getCellTaskHtml(taskIndex, "");				
	cell_Range.innerHTML = getCellRangeHtml(taskIndex, "");
	cell_Day_Parameter.innerHTML = getCellDayHtml(taskIndex, '', '', 'display: inline;', 'display: none;');
	cell_Time_Parameter.innerHTML = getCellTimeHtml(taskIndex, "", "");
    cell_End_Date.innerHTML = getCellRangeEndDateHtml(taskIndex, "", table.getElementsByTagName("tr").length);
	cell_State.innerHTML = getCellStateHtml(taskIndex, "");
    cell_Button.innerHTML = getCellTaskButtonsHtml();

    row.appendChild(cell_Task);
    row.appendChild(cell_Range);
    row.appendChild(cell_Day_Parameter);
    row.appendChild(cell_Time_Parameter);
    row.appendChild(cell_End_Date);
    row.appendChild(cell_State);
    row.appendChild(cell_Button);

    table.getElementsByTagName('tbody')[0].appendChild(row);

    Calendar.setup ({ inputField : "range_end_date_"+taskIndex , daFormat : calendar_dateformat, button : "range_end_date_trigger_"+taskIndex , singleClick : true, dateStr : '', step : 1, weekNumbers:false });

    document.getElementById('tasksGlobalIndex').value = parseInt(taskIndex)+1;
}

function RememberTasks(idTable, task_Values, calendar_dateformat) {

    var taskIndex = 0;

    var table = document.getElementById(idTable);
    var rows = task_Values.split("|");

    if (task_Values != "") {

        for (var i = 0; i < rows.length; i++) {

            var values = rows[i].split(":");

            var row = document.createElement("tr");
            row.setAttribute("class", "scheduledTasks_oddListRowS1");

            var cell_Task = document.createElement("td");
            var cell_Range = document.createElement("td");
            var cell_Day_Parameter = document.createElement("td");
            var cell_Time_Parameter = document.createElement("td");
            var cell_End_Date = document.createElement("td");
            var cell_State = document.createElement("td");
            var cell_Button = document.createElement("td");
            cell_Button.align = "right";

            cell_Task.innerHTML = getCellTaskHtml(taskIndex, values[0]);
            cell_Range.innerHTML = getCellRangeHtml(taskIndex, values[1]);

            switch (values[1]) {
                case 'monthly':
                    cell_Day_Parameter.innerHTML = getCellDayHtml(taskIndex, values[2], '', 'display: inline;', 'display: none;');
                    cell_Time_Parameter.innerHTML = getCellTimeHtml(taskIndex, values[3], '');
                    break;
                case 'weekly':
                    cell_Day_Parameter.innerHTML = getCellDayHtml(taskIndex, '', values[2], 'display: none;', 'display: inline;');
                    cell_Time_Parameter.innerHTML = getCellTimeHtml(taskIndex, values[3], '');
                    break;
                case 'daily':
                    cell_Day_Parameter.innerHTML = getCellDayHtml(taskIndex, '', '', 'display: none;', 'display: none;');
                    cell_Time_Parameter.innerHTML = getCellTimeHtml(taskIndex, values[3], '');
                    break;
                case 'hourly':
                    cell_Day_Parameter.innerHTML = getCellDayHtml(taskIndex, '', '', 'display: none;', 'display: none;');
                    cell_Time_Parameter.innerHTML = getCellTimeHtml(taskIndex, values[3], 'visibility: hidden;');
                    break;
            }
 
            //cell_Time_Parameter.innerHTML = getCellTimeHtml(taskIndex, values[3]);
            cell_End_Date.innerHTML = getCellRangeEndDateHtml(taskIndex, values[4]);
            cell_State.innerHTML = getCellStateHtml(taskIndex, values[5]);
            cell_Button.innerHTML = getCellTaskButtonsHtml();

            row.appendChild(cell_Task);
            row.appendChild(cell_Range);
            row.appendChild(cell_Day_Parameter);
            row.appendChild(cell_Time_Parameter);
            row.appendChild(cell_End_Date);
            row.appendChild(cell_State);
            row.appendChild(cell_Button);

            table.getElementsByTagName('tbody')[0].appendChild(row);

            taskIndex++;
        }
        document.getElementById('tasksGlobalIndex').value = taskIndex;
    }

    for (var i = 0; i < taskIndex; i++) {
        Calendar.setup({
            inputField : "range_end_date_" + i,
            daFormat : calendar_dateformat,
            button : "range_end_date_trigger_" + i,
            singleClick : true,
            dateStr : '',
            step : 1,
            weekNumbers : false
        });
    }
}



function format_tasks() {

    var parsed_string = "";
    var taskIndex = document.getElementById('tasksGlobalIndex').value;

    for (var i = 0; i < parseInt(taskIndex); i++) {

        if (document.getElementById("task_name_" + i) == null) {
            continue;
        }

        if (document.getElementById("task_name_" + i).value == "") {
            document.getElementById("task_name_" + i).value = "Task " + i;
        }

        parsed_string += document.getElementById("task_name_" + i).value + ":";
        parsed_string += document.getElementById("execution_range_" + i).value + ":";

        if (document.getElementById("execution_range_" + i).value == "monthly") {
            parsed_string += document.getElementById("range_day_value_" + i).value + ":";
        } else if (document.getElementById("execution_range_" + i).value == "weekly") {
            parsed_string += document.getElementById("range_week_value_" + i).value + ":";
        } else {
            parsed_string += ":";
        }

        parsed_string += document.getElementById("range_hour_value_" + i).value + "," + document.getElementById("range_minute_value_" + i).value + ":";

        if (document.getElementById("range_end_date_" + i).value == "") {
        }
        parsed_string += document.getElementById("range_end_date_" + i).value + ":";

        parsed_string += document.getElementById("task_state_" + i).value + "|";

    }

    parsed_string = parsed_string.slice(0, -1);
    parsed_string += "${GMT}";

    return parsed_string;
}


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////AUX FUNCTIONS////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////
///// MODULE FIELDS /////
/////////////////////////

function generate_Logical_Parameters_HTML_and_Remember_DataBase_if_needed(rowIndex, selectedValue) {

	if (typeof selectedValue == 'undefined')
		selectedValue = "0:0:";
	
	var lbl_and = SUGAR.language.get(wfm_module, 'LBL_ASOL_AND');
	var lbl_or = SUGAR.language.get(wfm_module, 'LBL_ASOL_OR');
	
	var cell_LogicalParameters_HTML = "";
	
	var selectedValues = selectedValue.split(':');
	var parenthesis = selectedValues[0];
	var logicalOperator = selectedValues[1];
		
	cell_LogicalParameters_HTML += "<select class='logical_parameters' name='parenthesis_"+rowIndex+"' id='parenthesis_"+rowIndex+"'>";
	var parenthesisValues = ["0", "1", "2", "3", "-1", "-2", "-3"];
	var parenthesisLabels = ["", "(", "((", "(((", "..)", "..))", "..)))"];
	for (x = 0; x < parenthesisValues.length; x++) {
		cell_LogicalParameters_HTML += (parenthesisValues[x] == parenthesis) ? "<option value='"+parenthesisValues[x]+"' selected>"+parenthesisLabels[x]+"</option>" : "<option value='"+parenthesisValues[x]+"'>"+parenthesisLabels[x]+"</option>";
	}
	cell_LogicalParameters_HTML += "</select>&nbsp;";
	
	cell_LogicalParameters_HTML += "<select class='logical_parameters' name='logical_operator_"+rowIndex+"' id='logical_operator_"+rowIndex+"'>";
	var logicValues = ["", "AND", "OR"];
	var logicLabels = ["", lbl_and, lbl_or];
	for (x = 0; x < logicValues.length; x++) {
		cell_LogicalParameters_HTML += (logicValues[x] == logicalOperator) ? "<option value='"+logicValues[x]+"' selected>"+logicLabels[x]+"</option>" : "<option value='"+logicValues[x]+"'>"+logicLabels[x]+"</option>";
	}
	cell_LogicalParameters_HTML += "</select>";
	
	return cell_LogicalParameters_HTML;
}

function checkParenthesis() {

	var lbl_parenthesis_matching_alert = SUGAR.language.get(wfm_module, 'LBL_ASOL_MATCHING_PARENTHESIS_ALERT');
	var lbl_last_condition_logical_link_alert = SUGAR.language.get(wfm_module, 'LBL_ASOL_LAST_CONDITION_LOGICAL_LINK_ALERT');
	
	var returned_value = true;
	
	var table = document.getElementById("conditions_Table");
    var numberOfFilters = (table.getElementsByTagName("tr").length)-1;
    
    var checkParenthesis = 0;
    var lastConditionOperator = "";
    
    var uniqueRowIndexes = parseInt(document.getElementById("uniqueRowIndexes").value);
	
    for (var rowIndex=0; rowIndex<uniqueRowIndexes; rowIndex++) {
    	if (document.getElementById('fieldName_'+rowIndex) !== null) {	
			var rowParenthesis = document.getElementById("parenthesis_"+rowIndex).value;
			lastConditionOperator = document.getElementById("logical_operator_"+rowIndex).value;
			
			checkParenthesis += parseInt(rowParenthesis);
		}
    }
	
  	if (lastConditionOperator != "") {
  		alert(lbl_last_condition_logical_link_alert);
  		returned_value = false; 
  	}

  	if (checkParenthesis != 0) {
    	alert(lbl_parenthesis_matching_alert);
    	returned_value = false; 
	}
    
    return returned_value;
}

function generate_Name_of_the_Field_HTML(rowIndex, key, fieldName_array) {
    
	var translateFieldLabels = asol_var['translateFieldLabels'];
	
	var value = fieldName_array[0];
	var label_key = fieldName_array[1]; // first I try to get the inner_html from label_key and if not posible I take it from label
	var label = fieldName_array[2];
	
	var inner_html = '';
	
	var value_array = value.split('.');
	var label_key_array = label_key.split('.');
	
	if (value_array.length == 2) { // not a regular_field
		
		if (value_array[0].indexOf("_cstm") != -1) { // custom_field
			
			if (label_key_array.length == 2) { // custom_field(from related_field)
			    var module = label_key_array[0];
			    var lbl_module = SUGAR.language.get('app_list_strings', 'moduleList')[module];
                if (lbl_module === 'undefined') {
                    lbl_module = module;
                }
                
                var field = value_array[1];
                var lbl_field = SUGAR.language.get(module, label_key_array[1]);
                if (lbl_field === 'undefined') {
                    lbl_field = field;
                }
                
                if (translateFieldLabels) {
                    inner_html = lbl_module+"_cstm."+lbl_field;
                } else {
                    inner_html = value;
                }
			    
			} else { // custom_field(from regular_field)
			    var module = document.getElementById("trigger_module").value;
			    var lbl_module = SUGAR.language.get('app_list_strings', 'moduleList')[module];
			    if (lbl_module === 'undefined') {
			        lbl_module = module;
			    }
			    
			    var field = value_array[1];
                var lbl_field = SUGAR.language.get(module, label_key);
                if (lbl_field === 'undefined') {
                    lbl_field = field;
                }
                
                if (translateFieldLabels) {
                    inner_html = lbl_module+"_cstm."+lbl_field;
                } else {
                    inner_html = value;
                }
			}
		} else { // related_field
		    
			relatedModule = label_key_array[0];
			var lbl_relatedModule = SUGAR.language.get('app_list_strings', 'moduleList')[relatedModule];
			if (lbl_relatedModule === 'undefined') {
			    lbl_relatedModule = relatedModule;
			}
			
			var fieldRelatedModule = value_array[1];
			var lbl_fieldRelatedModule = SUGAR.language.get(relatedModule, label_key_array[1]);
			if (lbl_fieldRelatedModule === 'undefined') {///+++ Users.created_by, LBL_ASSIGNED_TO ??? algo va raro con este campo en particular
				lbl_fieldRelatedModule = fieldRelatedModule;
			}
			
			if (translateFieldLabels) {
				inner_html = lbl_relatedModule+"."+lbl_fieldRelatedModule;
			} else {
				inner_html = value;
			}
		}
	} else { // regular_field
	    
	    var trigger_module_select = document.getElementById("trigger_module");
	    if (trigger_module_select !== null) {
    		var module = trigger_module_select.value;
    		
    		var lbl_field = SUGAR.language.get(module, label_key);
    		if (lbl_field === 'undefined') {
    		    lbl_field = value;
    		}
    		
    		if (translateFieldLabels) {
    			inner_html = lbl_field;
    		} else {
    			inner_html = value;
    		}
		} else {
		    inner_html = value;
		}
	}
	
	inner_html = inner_html.trim();
	inner_html = inner_html.removeColon();
	
	return "<b><span id='fieldName_"+rowIndex+"' name='fieldName_"+rowIndex+"' value='"+value+"' title='"+key+"' label_key='"+label_key+"'>"+inner_html+"</span></b>";
}

function onChange_OldBean_NewBean_Changed(dropdownlist, rowIndex) {
    if (dropdownlist.selectedIndex == 2) {
        document.getElementById("isChanged_"+rowIndex).style.visibility = "visible";
        document.getElementById("operator_"+rowIndex).style.visibility = "hidden";
        document.getElementById("Param1_"+rowIndex).parentNode.style.visibility = "hidden";
        document.getElementById("Param2_"+rowIndex).style.visibility = "hidden";
    } else {
        document.getElementById("isChanged_"+rowIndex).style.visibility = "hidden";
        document.getElementById("operator_"+rowIndex).style.visibility = "visible";
        document.getElementById("Param1_"+rowIndex).parentNode.style.visibility = "visible";
        document.getElementById("Param2_"+rowIndex).style.visibility = "visible";
    }
}

function generate_OldBean_NewBean_Changed_HTML_and_Remember_DataBase_if_needed(rowIndex, isRelated, cell_OldBean_NewBean_Changed_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_asol_old_bean = SUGAR.language.get(wfm_module, 'LBL_ASOL_OLD_BEAN');
	var lbl_asol_new_bean = SUGAR.language.get(wfm_module, 'LBL_ASOL_NEW_BEAN');
	var lbl_asol_changed = SUGAR.language.get(wfm_module, 'LBL_ASOL_CHANGED');
	// END - Language Labels
	
	var visibility = (isRelated == "true") ? " visibility: hidden;" : "";
	var cell_OldBean_NewBean_Changed_HTML = 
		"<select id='OldBean_NewBean_Changed_"+rowIndex+"' name='OldBean_NewBean_Changed_"+rowIndex+"' style='width:90px;"+visibility+"' class='OldBean_NewBean_Changed' onChange='onChange_OldBean_NewBean_Changed(this, "+rowIndex+");'>";
	 
	var cell_OldBean_NewBean_Changed_Values = ["old_bean","new_bean","changed"];
	var cell_OldBean_NewBean_Changed_Labels = [lbl_asol_old_bean,lbl_asol_new_bean,lbl_asol_changed];
	for (var x in cell_OldBean_NewBean_Changed_Values) {
		var selected = (cell_OldBean_NewBean_Changed_SelectedValue == cell_OldBean_NewBean_Changed_Values[x]) ? " selected" : "";
		cell_OldBean_NewBean_Changed_HTML +=  "<option value='"+cell_OldBean_NewBean_Changed_Values[x]+"'"+selected+">"+cell_OldBean_NewBean_Changed_Labels[x]+"</option>";
	}
	 
	cell_OldBean_NewBean_Changed_HTML += "</select> ";
	 
	return cell_OldBean_NewBean_Changed_HTML;
}

function generate_IsChanged_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_IsChanged_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_asol_true = SUGAR.language.get(wfm_module, 'LBL_ASOL_TRUE');
	var lbl_asol_false = SUGAR.language.get(wfm_module, 'LBL_ASOL_FALSE');
	// END - Language Labels
	
	var cell_IsChanged_HTML = "<select id='isChanged_"+rowIndex+"' name='isChanged_"+rowIndex+"' style='width:65px; visibility: hidden;' class='isChanged'>";
    
    var cell_IsChanged_Values = ["true","false"];
    var cell_IsChanged_Labels = [lbl_asol_true,lbl_asol_false];
    for (var x in cell_IsChanged_Values) {
		var selected = (cell_IsChanged_SelectedValue == cell_IsChanged_Values[x]) ? " selected" : "";
		cell_IsChanged_HTML +=  "<option value='"+cell_IsChanged_Values[x]+"'"+selected+">"+cell_IsChanged_Labels[x]+"</option>";
    }
    
    cell_IsChanged_HTML += "</select> ";
    
    return cell_IsChanged_HTML;
}

function onChange_Operator_for_enum(dropdownlist, rowIndex) {
    if (dropdownlist.selectedIndex >= 2) {
        document.getElementById("Param1_"+rowIndex).multiple = true;
        document.getElementById("Param1_"+rowIndex).size = 3;
    } else {
        document.getElementById("Param1_"+rowIndex).multiple = false;
        document.getElementById("Param1_"+rowIndex).size = 1;
    }
}

function generate_Operator_for_enum_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_Operator_for_enum_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_EQUALS');
	var lbl_not_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_EQUALS');
	var lbl_one_of = SUGAR.language.get(wfm_module, 'LBL_EVENT_ONE_OF');
	var lbl_not_one_of = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_ONE_OF');
	// END - Language Labels
	
	var cell_Operator_for_enum_HTML = 
		"<select id='operator_"+rowIndex+"' name='operator_"+rowIndex+"' style='width:90px' onChange='onChange_Operator_for_enum(this, "+rowIndex+");'>";
    
    var cell_Operator_for_enum_Values = ["equals","not equals","one of","not one of"];
    var cell_Operator_for_enum_Labels = [lbl_equals,lbl_not_equals,lbl_one_of,lbl_not_one_of];
    for (var x in cell_Operator_for_enum_Values) {
		var selected = (cell_Operator_for_enum_SelectedValue == cell_Operator_for_enum_Values[x]) ? " selected" : "";
		cell_Operator_for_enum_HTML +=  "<option value='"+cell_Operator_for_enum_Values[x]+"'"+selected+">"+cell_Operator_for_enum_Labels[x]+"</option>";
    }
    
    cell_Operator_for_enum_HTML += "</select> ";
    
    return cell_Operator_for_enum_HTML;
}

function generate_First_Parameter_for_enum_HTML_and_Remember_DataBase_if_needed(rowIndex, operator, Param1, enum_operator, enum_reference) {
	
	//alert("enum_reference"+enum_reference);
	
	var dropdown = SUGAR.language.get('app_list_strings', enum_reference);
	//alert("dropdown"+dropdown);
	
	var options_db = [];
	var options = [];
	for (var key in dropdown) {
		options_db.push(key);
		options.push(dropdown[key])
	}
	//alert("options_db"+options_db);
	//alert("options"+options);
	
	var options_First_Paramenter_HTML = "";
	var options_selected_First_Parameter = Param1.split("${dollar}");
	for (var y in options_db) {
		var selected = "";
		for (var z in options_selected_First_Parameter) {
			if (options_db[y] == options_selected_First_Parameter[z]) {
				selected = " selected";
				break;
			}
		}
		options_First_Paramenter_HTML += "<option"+selected+" value='"+options_db[y]+"'>"+options[y].replace(/\${sq}/g, "\'")+"</option>";
	}
	
	var multiple = "";
	if ((operator == "one of") || (operator == "not one of")) {
		multiple = " multiple size=3";
	}
	var cell_First_Parameter_for_enum_HTML = "<select id='Param1_"+rowIndex+"' name='Param1_"+rowIndex+"' style='width:140px' "+multiple+">"+options_First_Paramenter_HTML+"</select>";
	
	return cell_First_Parameter_for_enum_HTML;
}

function generate_Second_Parameter_for_enum_HTML(rowIndex) {
	
	return  "<input type='text' id='Param2_"+rowIndex+"' name='Param2_"+rowIndex+"' value='' style='display:none; width:140px'>";
}

function generate_Operator_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_Operator_for_int_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_EQUALS');
	var lbl_not_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_EQUALS');
	var lbl_less_than = SUGAR.language.get(wfm_module, 'LBL_EVENT_LESS_THAN');
	var lbl_more_than = SUGAR.language.get(wfm_module, 'LBL_EVENT_MORE_THAN');
	// END - Language Labels
	
	var cell_Operator_for_int_HTML = "<select id='operator_"+rowIndex+"' name='operator_"+rowIndex+"' style='width:90px'>";
    
    var cell_Operator_for_int_Values = ["equals","not equals","less than","more than"];
    var cell_Operator_for_int_Labels = [lbl_equals,lbl_not_equals,lbl_less_than,lbl_more_than];
    for (var x in cell_Operator_for_int_Values) {
		var selected = (cell_Operator_for_int_SelectedValue == cell_Operator_for_int_Values[x]) ? " selected" : "";
		cell_Operator_for_int_HTML +=  "<option value='"+cell_Operator_for_int_Values[x]+"'"+selected+">"+cell_Operator_for_int_Labels[x]+"</option>";
    }
    
    cell_Operator_for_int_HTML += "</select> ";
    
    return cell_Operator_for_int_HTML;
}

function generate_First_Parameter_for_int_HTML_and_Remember_DataBase_if_needed(rowIndex, value) {
	
	return "<input type='text' name='Param1_"+rowIndex+"' id='Param1_"+rowIndex+"' style='width:140px' value='"+value+"'>";
}

function generate_Second_Parameter_for_int_HTML(rowIndex) {
	
	return "<input type='text' name='Param2_"+rowIndex+"' id='Param2_"+rowIndex+"' value='' style='display:none; width:140px'>";
}


function onChange_Operator_for_datetime(dropdownlist, rowIndex) {
    
    if ((dropdownlist.selectedIndex == 4) || (dropdownlist.selectedIndex == 5)) {
        document.getElementById("Param2_"+rowIndex).value = "";
        document.getElementById("Param1_select_"+rowIndex).style.display = "none";
        document.getElementById("Param1_"+rowIndex).style.display = "inline";
        document.getElementById("trigger_"+rowIndex).style.display = "inline";
        document.getElementById("Param2_"+rowIndex).style.display = "inline";
        document.getElementById("trigger2_"+rowIndex).style.display = "inline";
        document.getElementById("Param2_"+rowIndex).disabled = true;
    } else {
        document.getElementById("Param1_select_"+rowIndex).style.display = "none";
        document.getElementById("Param1_"+rowIndex).style.display = "inline";
        document.getElementById("trigger_"+rowIndex).style.display = "inline";
        document.getElementById("Param2_"+rowIndex).style.display = "none";
        document.getElementById("trigger2_"+rowIndex).style.display = "none";
        if (dropdownlist.selectedIndex >= 6) {
            document.getElementById("Param1_"+rowIndex).style.display = "none";
            document.getElementById("trigger_"+rowIndex).style.display = "none";
            document.getElementById("Param1_select_"+rowIndex).style.display = "inline";
            if ((dropdownlist.selectedIndex == 6) || (dropdownlist.selectedIndex == 7) || (dropdownlist.selectedIndex == 10) || (dropdownlist.selectedIndex == 11)) {
                document.getElementById("Param2_"+rowIndex).style.display = "inline";
                document.getElementById("Param2_"+rowIndex).value = ""
            }
        }
        document.getElementById("Param2_"+rowIndex).disabled = false;
    }
}

function generate_Operator_for_datetime_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_Operator_for_datetime_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_EQUALS');
	var lbl_not_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_EQUALS');
	var lbl_before_date = SUGAR.language.get(wfm_module, 'LBL_EVENT_BEFORE_DATE');
	var lbl_after_date = SUGAR.language.get(wfm_module, 'LBL_EVENT_AFTER_DATE');
	var lbl_between = SUGAR.language.get(wfm_module, 'LBL_EVENT_BETWEEN');
	var lbl_not_between = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_BETWEEN');
	var lbl_last = SUGAR.language.get(wfm_module, 'LBL_EVENT_LAST');
	var lbl_not_last = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_LAST');
	var lbl_this = SUGAR.language.get(wfm_module, 'LBL_EVENT_THIS');
	var lbl_not_this = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_THIS');
	var lbl_next = SUGAR.language.get(wfm_module, 'LBL_EVENT_NEXT');
	var lbl_not_next = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_NEXT');
	// END - Language Labels
	
	var cell_Operator_for_datetime_HTML = 
		"<select id='operator_"+rowIndex+"' name='operator_"+rowIndex+"' style='width:90px' onChange='onChange_Operator_for_datetime(this, "+rowIndex+");'>";
    
    var cell_Operator_for_datetime_Values = ["equals", "not equals", "before date", "after date", "between", "not between", "last", "not last", "this", "not this", "next", "not next"];
    var cell_Operator_for_datetime_Labels = [lbl_equals, lbl_not_equals, lbl_before_date, lbl_after_date, lbl_between, lbl_not_between, lbl_last, lbl_not_last, lbl_this, lbl_not_this, lbl_next, lbl_not_next];
    for (var x in cell_Operator_for_datetime_Values) {
		var selected = (cell_Operator_for_datetime_SelectedValue == cell_Operator_for_datetime_Values[x]) ? " selected" : "";
		cell_Operator_for_datetime_HTML +=  "<option value='"+cell_Operator_for_datetime_Values[x]+"'"+selected+">"+cell_Operator_for_datetime_Labels[x]+"</option>";
    }
    
    cell_Operator_for_datetime_HTML += "</select> ";
    
    return cell_Operator_for_datetime_HTML;
}

function generate_var_fixed_str_for_First_Parameter_for_datetime_HTML_and_Remember_DataBase_if_needed(var_fixed_str_for_First_Paremeter_for_datetime_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_day = SUGAR.language.get(wfm_module, 'LBL_EVENT_DAY');
	var lbl_week = SUGAR.language.get(wfm_module, 'LBL_EVENT_WEEK');
	var lbl_month = SUGAR.language.get(wfm_module, 'LBL_EVENT_MONTH');
	var lbl_nquarter = SUGAR.language.get(wfm_module, 'LBL_EVENT_NQUARTER');
	var lbl_fquarter = SUGAR.language.get(wfm_module, 'LBL_EVENT_FQUARTER');
	var lbl_nyear = SUGAR.language.get(wfm_module, 'LBL_EVENT_NYEAR');
	var lbl_fyear = SUGAR.language.get(wfm_module, 'LBL_EVENT_FYEAR');
	// END - Language Labels
	
	var var_fixed_str_for_First_Paremeter_for_datetime_HTML = "";
	
    var var_fixed_str_for_First_Paremeter_for_datetime_Values = ["day","week","month","Nquarter","Fquarter","Nyear","Fyear"];
    var var_fixed_str_for_First_Paremeter_for_datetime_Labels = [lbl_day,lbl_week,lbl_month,lbl_nquarter,lbl_fquarter,lbl_nyear,lbl_fyear];
    for (var x in var_fixed_str_for_First_Paremeter_for_datetime_Values) {
		var selected = (var_fixed_str_for_First_Paremeter_for_datetime_SelectedValue == var_fixed_str_for_First_Paremeter_for_datetime_Values[x]) ? " selected" : "";
		var_fixed_str_for_First_Paremeter_for_datetime_HTML +=  "<option value='"+var_fixed_str_for_First_Paremeter_for_datetime_Values[x]+"'"+selected+">"+var_fixed_str_for_First_Paremeter_for_datetime_Labels[x]+"</option>";
    }
    
    return var_fixed_str_for_First_Paremeter_for_datetime_HTML;
}

function generate_First_Parameter_for_datetime_HTML(rowIndex, show_InputOrSelect, value, fixed_str) {
	
	var displayInput = "";
	var displaySelect = "";
	
	if (show_InputOrSelect == "input") {
		displayInput = "inline";
		displaySelect = "none";
	} else {
		displayInput = "none";
		displaySelect = "inline";
	}
	
	var cell_First_Parameter_HTML =
	"<input type='text' id='Param1_"+rowIndex+"' name='Param1_"+rowIndex+"' style='display:"+displayInput+"; width:120px;' disabled='' value='"+value+"'>"
	+ "<img id='trigger_"+rowIndex+"' style='display:"+displayInput+"' border='0' align='absmiddle' src='themes/default/images/jscalendar.gif?s=9006669fd2606c8bf6e2569fac9b1f65&amp;c=1&amp;developerMode=732502144' alt='Enter Date'>"
	+ "<span></span>"
	+ "<select id='Param1_select_"+rowIndex+"' name='Param1_select_"+rowIndex+"'style='display:"+displaySelect+"; width:140px''>"
	+ fixed_str	+ "</select>";
	
	return cell_First_Parameter_HTML;
}

function generate_Second_Parameter_for_datetime_HTML(rowIndex, displayModeInput, displayModeImg, isDisabled, value) {
	
	var displayInput = (displayModeInput == "inline") ? "inline" : "none";
	var displayImg = (displayModeImg == "inline") ? "inline" : "none";
	var disabled = (isDisabled == "true") ? " disabled=''" : "";
	
	var cell_Second_Parameter_HTML = 
		"<input type='text' id='Param2_"+rowIndex+"' name='Param2_"+rowIndex+"' style='display:"+displayInput+"; width:120px'"+disabled+" value='"+value+"'>"
		+ "<img id='trigger2_"+rowIndex+"' name='trigger2_"+rowIndex+"' style='display:"+displayImg+"' border='0' align='absmiddle' src='themes/default/images/jscalendar.gif?s=9006669fd2606c8bf6e2569fac9b1f65&amp;c=1&amp;developerMode=732502144' alt='Enter Date'>";

	return cell_Second_Parameter_HTML;
}

function generate_Operator_for_tinyint_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_Operator_for_tinyint_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_EQUALS');
	var lbl_not_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_EQUALS');
	// END - Language Labels
	
	var cell_Operator_for_tinyint_HTML = "<select id='operator_"+rowIndex+"' name='operator_"+rowIndex+"' style='width:90px'>";
    
    var cell_Operator_for_tinyint_Values = ["equals","not equals"];
    var cell_Operator_for_tinyint_Labels = [lbl_equals,lbl_not_equals];
    for (var x in cell_Operator_for_tinyint_Values) {
		var selected = (cell_Operator_for_tinyint_SelectedValue == cell_Operator_for_tinyint_Values[x]) ? " selected" : "";
		cell_Operator_for_tinyint_HTML +=  "<option value='"+cell_Operator_for_tinyint_Values[x]+"'"+selected+">"+cell_Operator_for_tinyint_Labels[x]+"</option>";
    }
    
    cell_Operator_for_tinyint_HTML += "</select> ";
    
    return cell_Operator_for_tinyint_HTML;
}

function generate_First_Parameter_for_tinyint_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_First_Parameter_for_tinyint_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_true = SUGAR.language.get(wfm_module, 'LBL_EVENT_TRUE');
	var lbl_false = SUGAR.language.get(wfm_module, 'LBL_EVENT_FALSE');
	// END - Language Labels
	
	var cell_First_Parameter_for_tinyint_HTML = "<select id='Param1_"+rowIndex+"' name='Param1_"+rowIndex+"' style='width:140px'>";
    
    var cell_First_Parameter_for_tinyint_Values = ["true","false"];
    var cell_First_Parameter_for_tinyint_Labels = [lbl_true,lbl_false];
    for (var x in cell_First_Parameter_for_tinyint_Values) {
		var selected = (cell_First_Parameter_for_tinyint_SelectedValue == cell_First_Parameter_for_tinyint_Values[x]) ? " selected" : "";
		cell_First_Parameter_for_tinyint_HTML +=  "<option value='"+cell_First_Parameter_for_tinyint_Values[x]+"'"+selected+">"+cell_First_Parameter_for_tinyint_Labels[x]+"</option>";
    }
    
    cell_First_Parameter_for_tinyint_HTML += "</select> ";
    
    return cell_First_Parameter_for_tinyint_HTML;
}

function generate_Second_Parameter_for_tinyint_HTML(rowIndex) {
	
	return "<input type='text' id='Param2_"+rowIndex+"' name='Param2_"+rowIndex+"' value='' style='display:none; width:140px'>";
}

function generate_Operator_for_default_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_Operator_for_default_SelectedValue) {
	
	// BEGIN - Language Labels
	var lbl_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_EQUALS');
	var lbl_not_equals = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_EQUALS');
	var lbl_like = SUGAR.language.get(wfm_module, 'LBL_EVENT_LIKE');
	var lbl_not_like = SUGAR.language.get(wfm_module, 'LBL_EVENT_NOT_LIKE');
	// END - Language Labels
	
	var cell_Operator_for_default_HTML = "<select id='operator_"+rowIndex+"' name='operator_"+rowIndex+"' style='width:90px'>";
    
    var cell_Operator_for_default_Values = ["equals","not equals","like","not like"];
    var cell_Operator_for_default_Labels = [lbl_equals,lbl_not_equals,lbl_like,lbl_not_like];
    for (var x in cell_Operator_for_default_Values) {
		var selected = (cell_Operator_for_default_SelectedValue == cell_Operator_for_default_Values[x]) ? " selected" : "";
		cell_Operator_for_default_HTML +=  "<option value='"+cell_Operator_for_default_Values[x]+"'"+selected+">"+cell_Operator_for_default_Labels[x]+"</option>";
    }
    
    cell_Operator_for_default_HTML += "</select> ";
    
    return cell_Operator_for_default_HTML;
}

function generate_First_Parameter_for_default_HTML_and_Remember_DataBase_if_needed(rowIndex, value) {
	
	return "<input type='text' name='Param1_"+rowIndex+"' id='Param1_"+rowIndex+"' style='width:140px' value='"+value.replace(/\'/g, "\'")+"'>";
}

function generate_Second_Parameter_for_default_HTML(rowIndex) {
	
	return "<input type='text' name='Param2_"+rowIndex+"' id='Param2_"+rowIndex+"' value='' style='display:none; width:140px'>";
}

function generate_Button_detele_row_HTML(rowIndex, value_type, key, is_related, index, enum_operator, enum_reference) {
	
	// BEGIN - Language Labels
	var lbl_asol_delete_button = SUGAR.language.get(wfm_module, 'LBL_ASOL_DELETE_BUTTON');
	var lbl_asol_delete_row_alert = SUGAR.language.get(wfm_module, 'LBL_ASOL_DELETE_ROW_ALERT');
	// END - Language Labels
	
	var cell_Button_HTML = 
    	"<img border='0' src='themes/default/images/minus_inline.gif' title=\""+lbl_asol_delete_button+"\" OnMouseOver='this.style.cursor=\"pointer\"' OnMouseOut='this.style.cursor=\"default\"' onClick='if(confirm(\""+lbl_asol_delete_row_alert+"\")) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }' name='del_button_"+rowIndex+"''>"
        + "<input type='hidden' id='value_type_"+rowIndex+"' name='value_type_"+rowIndex+"' value='" + value_type + "'>"
        + "<input type='hidden' id='key_"+rowIndex+"' name='key_"+rowIndex+"' value='" + key + "'>"
        + "<input type='hidden' id='is_related_"+rowIndex+"' name='is_related_"+rowIndex+"' value='"+is_related+"'>"
        + "<input type='hidden' id='index_"+rowIndex+"' name='index_"+rowIndex+"' value='" + index + "'>" 
        + "<input type='hidden' id='enum_operator_"+rowIndex+"' name='enum_operator_"+rowIndex+"' value='" + enum_operator + "'>" 
        + "<input type='hidden' id='enum_reference_"+rowIndex+"' name='enum_reference_"+rowIndex+"' value='" + enum_reference + "'>"
    ;
	
	return cell_Button_HTML;
}

///////////////////////////
///// SCHEDULED_TASKS /////
///////////////////////////

function getCellTaskHtml(taskIndex, selectedValue) {
    
    var AlphanumericAlert = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_ALPHANUMERIC_ALERT');
    
    var cell_Task_Html = "<input type='text' id='task_name_"+taskIndex+"' name='task_name' class='task_name' size='30' maxlength='' value='" + selectedValue + "' title='' >";
    return cell_Task_Html;
}

function onChange_executionRange(dropwdownlist, taskIndex) {

    switch (dropwdownlist.value) {
        case 'monthly':
            document.getElementById('range_day_value_'+taskIndex).style.display = "inline";
            document.getElementById('range_week_value_'+taskIndex).style.display = "none";
            
            document.getElementById('range_hour_value_'+taskIndex).style.visibility = "visible";
            document.getElementById('range_colon_'+taskIndex).style.visibility = "visible";
            break;
        case 'weekly':
            document.getElementById('range_day_value_'+taskIndex).style.display = "none";
            document.getElementById('range_week_value_'+taskIndex).style.display = "inline";
            
            document.getElementById('range_hour_value_'+taskIndex).style.visibility = "visible";
            document.getElementById('range_colon_'+taskIndex).style.visibility = "visible";
            break;
        case 'daily':
            document.getElementById('range_day_value_'+taskIndex).style.display = "none";
            document.getElementById('range_week_value_'+taskIndex).style.display = "none";
            
            document.getElementById('range_hour_value_'+taskIndex).style.visibility = "visible";
            document.getElementById('range_colon_'+taskIndex).style.visibility = "visible";
            break;
        case 'hourly':
            document.getElementById('range_day_value_'+taskIndex).style.display = "none";
            document.getElementById('range_week_value_'+taskIndex).style.display = "none";
            
            document.getElementById('range_hour_value_'+taskIndex).style.visibility = "hidden";
            document.getElementById('range_colon_'+taskIndex).style.visibility = "visible";
            break;
        case 'minutely':
            document.getElementById('range_day_value_'+taskIndex).style.display = "none";
            document.getElementById('range_week_value_'+taskIndex).style.display = "none";
            
            document.getElementById('range_hour_value_'+taskIndex).style.visibility = "hidden";
            document.getElementById('range_colon_'+taskIndex).style.visibility = "hidden";
            break;
    }
}

function getCellRangeHtml(taskIndex, selectedValue) {

    var lbl_monthly = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_MONTHLY');
    var lbl_weekly = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_WEEKLY');
    var lbl_daily = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_DAILY');
    var lbl_hourly = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_HOURLY');
    //var lbl_minutely = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_MINUTELY');
        
    var cell_Range_HTML = "<select id='execution_range_"+taskIndex+"' class='execution_range' name='execution_range' onChange='onChange_executionRange(this, "+taskIndex+");'>";
    var rangeValues = ["monthly", "weekly", "daily", "hourly"];
    var rangeLabels = [lbl_monthly, lbl_weekly, lbl_daily, lbl_hourly];
    for (x = 0; x < rangeValues.length; x++) {
        cell_Range_HTML += (rangeValues[x] == selectedValue) ? "<option value='"+rangeValues[x]+"' selected>"+rangeLabels[x]+"</option>" : "<option value='"+rangeValues[x]+"'>"+rangeLabels[x]+"</option>";
    }
    cell_Range_HTML += "</select>";
    return cell_Range_HTML;
}

function getCellDayHtml(taskIndex, selectedValueDay, selectedValueWeek, dayStyle, weekStyle) {

    var lbl_monday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_MONDAY');
    var lbl_tuesday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_TUESDAY');
    var lbl_wednesday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_WEDNESDAY');
    var lbl_thursday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_THURSDAY');
    var lbl_friday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_FRIDAY');
    var lbl_saturday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_SATURDAY');
    var lbl_sunday = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_SUNDAY');

    var cell_Day_Parameter_HTML = "<select id='range_day_value_"+taskIndex+"' class='range_day_value' name='range_day_value' style='"+dayStyle+"'>";
    var dayValues = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
    var dayLabels = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
    for (x = 0; x < dayValues.length; x++) {
        cell_Day_Parameter_HTML += (dayValues[x] == selectedValueDay) ? "<option value='"+dayValues[x]+"' selected>"+dayLabels[x]+"</option>" : "<option value='"+dayValues[x]+"'>"+dayLabels[x]+"</option>";
    }
    cell_Day_Parameter_HTML += "</select>";
    
    cell_Day_Parameter_HTML += "<select id='range_week_value_"+taskIndex+"' class='range_week_value' name='range_week_value' style='"+weekStyle+"'>";
    var weekValues = ["1", "2", "3", "4", "5", "6", "7"];
    var weekLabels = [lbl_monday, lbl_tuesday, lbl_wednesday, lbl_thursday, lbl_friday, lbl_saturday, lbl_sunday];
    for (x = 0; x < weekValues.length; x++) {
        cell_Day_Parameter_HTML += (weekValues[x] == selectedValueWeek) ? "<option value='"+weekValues[x]+"' selected>"+weekLabels[x]+"</option>" : "<option value='"+weekValues[x]+"'>"+weekLabels[x]+"</option>";
    }
    cell_Day_Parameter_HTML += "</select>";
    
    return cell_Day_Parameter_HTML;
}

function getCellTimeHtml(taskIndex, selectedValue, hourStyle) {

    var selectedValueHour = selectedValue.split(",")[0];
    var selectedValueMinute = selectedValue.split(",")[1];
    
    var cell_Time_Parameter_HTML = "<select id='range_hour_value_"+taskIndex+"' class='range_hour_value' name='range_hour_value' style='"+hourStyle+"'>";
    var hourValues = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
    var hourLabels = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
    for (x = 0; x < hourValues.length; x++) {
        cell_Time_Parameter_HTML += (hourValues[x] == selectedValueHour) ? "<option value='"+hourValues[x]+"' selected>"+hourLabels[x]+"</option>" : "<option value='"+hourValues[x]+"'>"+hourLabels[x]+"</option>";
    }
    cell_Time_Parameter_HTML += "</select><span id='range_colon_"+taskIndex+"' style='font-weight:bold'>:</span>";
    
    cell_Time_Parameter_HTML += "<select id='range_minute_value_"+taskIndex+"' class='range_minute_value' name='range_minute_value'>";
    var minuteValues = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"];
    var minuteLabels = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"];
    for (x = 0; x < minuteValues.length; x++) {
        cell_Time_Parameter_HTML += (minuteValues[x] == selectedValueMinute) ? "<option value='"+minuteValues[x]+"' selected>"+minuteLabels[x]+"</option>" : "<option value='"+minuteValues[x]+"'>"+minuteLabels[x]+"</option>";
    }
    cell_Time_Parameter_HTML += "</select>";
        
    return cell_Time_Parameter_HTML;
}
    
function getCellRangeEndDateHtml(taskIndex, selectedValue) {    

    var cell_RangeEndDate_Html = ""
        + "<input type='text' id='range_end_date_"+taskIndex+"' value='" + selectedValue + "' disabled=true>"
        + "<img border='0' align='absmiddle' src='themes/default/images/jscalendar.gif' alt='Enter Date' id='range_end_date_trigger_"+taskIndex+"'>"
        + "<img border='0' align='absmiddle' src='themes/default/images/id-ff-clear.png' alt='Empty Date' onClick='document.getElementById(\"range_end_date_"+taskIndex+"\").value=\"\";' >"
    ;
    
    return cell_RangeEndDate_Html;
}

function getCellStateHtml(taskIndex, selectedValue) {   
    
    var lbl_active = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_ACTIVE');
    var lbl_inactive = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_INACTIVE');
    
    var cell_State_HTML = "<select id='task_state_"+taskIndex+"' class='task_state' class='task_state' name='task_state'>";
    var stateValues = ["active", "inactive"];
    var stateLabels = [lbl_active, lbl_inactive];
    for (x = 0; x < stateValues.length; x++) {
        cell_State_HTML += (stateValues[x] == selectedValue) ? "<option value='"+stateValues[x]+"' selected>"+stateLabels[x]+"</option>" : "<option value='"+stateValues[x]+"'>"+stateLabels[x]+"</option>";
    }
    cell_State_HTML += "</select>";
    
    return cell_State_HTML;
}

function onClick_TaskDeleteButton(button) {
    
    var DeleteTaskAlert = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_DELETE_TASK_ALERT');
    
    if (confirm(DeleteTaskAlert)) {
        button.parentNode.parentNode.parentNode.removeChild(button.parentNode.parentNode);
    }
}

function getCellTaskButtonsHtml() { 
    
    var DeleteButton = SUGAR.language.get(wfm_module, 'LBL_SCH_EV_DELETE_TASK');
    
    
    var cell_Buttons_Html = "<img class='asol_icon' src='modules/asol_Process/___common_WFM/images/asol_delete.png' title=\""+DeleteButton+"\" OnMouseOver='this.style.cursor=\"pointer\"' OnMouseOut='this.style.cursor=\"default\"' onClick='onClick_TaskDeleteButton(this);'>";
    return cell_Buttons_Html;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////JAVASCRIPT AUX FUNCTIONS////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
}
String.prototype.rtrim = function() {
	return this.replace(/\s+$/,"");
}
String.prototype.removeColon = function() {
	return this.replace(/:$/, "");
}