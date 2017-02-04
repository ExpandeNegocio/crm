var wfm_module = 'asol_Task';

/**
 * To manage the task implementation panel. When you select a task_type and it has to change the task implementation.
 */
function generate_taskImplementation_default_noData(task_select_id, override_opt, users_opts, acl_roles_opts, notificationEmails_opts, calendar_dateformat) {

	// BEGIN - Language Labels
	var lbl_asol_task_js_send_email_email_tpl = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_EMAIL_TPL');
	var lbl_asol_task_js_send_email_from = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_FROM');
	var lbl_asol_task_js_send_email_all = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_ALL');
	var lbl_asol_task_js_send_email_all_tip = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_ALL_TIP');
	var lbl_asol_task_js_send_email_to = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_TO');
	var lbl_asol_task_js_send_email_cc = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_CC');
	var lbl_asol_task_js_send_email_bcc = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_BCC');
	var lbl_asol_task_js_send_email_users = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_USERS');
	var lbl_asol_task_js_send_email_roles = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_ROLES');
	var lbl_asol_task_js_send_email_notificationEmails = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_NOTIFICATIONEMAILS');
	var lbl_asol_task_js_send_email_distribution_list = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_SEND_EMAIL_DISTRIBUTION_LIST');
	var lbl_asol_task_js_php_custom_php_code = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_PHP_CUSTOM_PHP_CODE');
	var lbl_asol_task_js_end_terminate_process = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_END_TERMINATE_PROCESS');
	var lbl_asol_task_js_continue_wait_for_sugar_task_to_continue_process = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_CONTINUE_WAIT_FOR_SUGAR_TASK_TO_CONTINUE_PROCESS');
	var lbl_asol_task_js_call_process_process = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_CALL_PROCESS_PROCESS');
	var lbl_asol_task_js_call_process_event_from_process = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_CALL_PROCESS_EVENT_FROM_PROCESS');
    var lbl_asol_task_js_call_process_execute_subprocess_immediately = SUGAR.language.get('asol_Task', 'LBL_ASOL_TASK_JS_CALL_PROCESS_EXECUTE_SUBPROCESS_IMMEDIATELY');
	// END - Language Labels
	
	var task_type_selected = (override_opt != null) ? override_opt : document.getElementById(task_select_id).value;
	var users = ((users_opts=="")||(users_opts==null)) ? new Array() : users_opts.split("${pipe}");
	var acl_roles = ((acl_roles_opts=="")||(acl_roles_opts==null)) ? new Array() : acl_roles_opts.split("${pipe}");
	var notificationEmails = ((notificationEmails_opts=="")||(notificationEmails_opts==null)) ? new Array() : notificationEmails_opts.split("${pipe}");

	document.getElementById("task_implementation.default").innerHTML = "<div style='clear: both'></div>";
	
	switch (task_type_selected) {

	case "send_email":
		
		// users select: to,cc,bcc
		var users_select_for_to = generate_SendEmail_UsersSelect_HTML('to', users);
		var users_select_for_cc = generate_SendEmail_UsersSelect_HTML('cc', users);
		var users_select_for_bcc = generate_SendEmail_UsersSelect_HTML('bcc', users);
		
		// acl_roles select: to,cc,bcc
		var acl_roles_select_for_to = generate_SendEmail_AclrolesSelect_HTML('to', acl_roles);
		var acl_roles_select_for_cc = generate_SendEmail_AclrolesSelect_HTML('cc', acl_roles);
		var acl_roles_select_for_bcc = generate_SendEmail_AclrolesSelect_HTML('bcc', acl_roles);
		
		// notificationEmails select: to,cc,bcc
        var notificationEmails_select_for_to = generate_SendEmail_notificationEmailsSelect_HTML('to', notificationEmails);
        var notificationEmails_select_for_cc = generate_SendEmail_notificationEmailsSelect_HTML('cc', notificationEmails);
        var notificationEmails_select_for_bcc = generate_SendEmail_notificationEmailsSelect_HTML('bcc', notificationEmails);
		
		var menu_to_cc_bcc_HTML = ""
			+ "<ol id='toc' clear='both'>"
		    	+ "<li>"
		    	    + "<a href='#all' id='a_all'>"
		    	        + "<span>"+lbl_asol_task_js_send_email_all+"</span>"
		    	    + "</a>"
                + "</li>"
		    	+ "<li>"
		    	    + "<a href='#to' id='a_to'>"
		    	        + "<span>"+lbl_asol_task_js_send_email_to+"</span>"
	    	        + "</a>"
	    	    + "</li>"
		    	+ "<li>"
		    	    + "<a href='#cc' id='a_cc'>"
		    	        +"<span>"+lbl_asol_task_js_send_email_cc+"</span>"
		    	    + "</a>"
	    	    + "</li>"
		    	+ "<li>"
		    	    +"<a href='#bcc' id='a_bcc'>"
		    	        +"<span>"+lbl_asol_task_js_send_email_bcc+"</span>"
	    	        +"</a>"
    	        +"</li>"
			+ "</ol>"
		;
				
		var tab_all_HTML = ""
			+ "<div class='content' id='all'>"
                + "<h2>"+lbl_asol_task_js_send_email_all+" "+lbl_asol_task_js_send_email_all_tip+"</h2>"
                + "<table class='edit view'>"
                    // summary
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_email_tpl+":</td>"
                        + "<td>"
                            + "<input type='text' ondblclick='' onmouseover='this.title=this.value;' autocomplete='off' title='' value='' size='38' id='email_tpl_name' name='email_tpl_name' class='send_email_tpl_name' />"
                            + "<input type='hidden' value='' id='email_tpl_id' name='email_tpl_id' />"
                            + "<button onclick='openSelectedEmailTemplatePopup(document.getElementById(\"email_tpl_id\").value, 100, 100);' value='Select' class='button firstChild' id='btn_open_assigned_user_name' name='btn_open_assigned_user_name' type='button'>"
                                + "<img src='modules/asol_Process/___common_WFM/images/open_email_template_14.png'>"
                            + "</button>"
                            + "<button onclick='openPopupEmailTemplate();' value='Select' class='button firstChild' id='btn_assigned_user_name' name='btn_assigned_user_name' type='button'>"
                                + "<img src='themes/default/images/id-ff-select.png'>"
                            + "</button>"
                            + "<button value='Clear' onclick='document.getElementById(\"email_tpl_name\").value =\"\"; document.getElementById(\"email_tpl_id\").value = \"\";' class='button lastChild' id='btn_clr_assigned_user_name' name='btn_clr_assigned_user_name' type='button'>"
                                + "<img src='themes/default/images/id-ff-clear.png'>"
                            + "</button>"
                        + "</td>"
                    + "</tr>"
                    //from
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_from+":</td>"
                        + "<td>"
                            + "<input type='text' id='email_from' name='email_from' value='' class='send_email_from' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    //to
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_to+":</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_users+"</td>"
                        + "<td>"
                            + "<input id='email_users_for_to_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_roles+"</td>"
                        + "<td>"
                            + "<input id='email_roles_for_to_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_notificationEmails+"</td>"
                        + "<td>"
                            + "<input id='email_notificationEmails_for_to_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_distribution_list+":</td>"
                        + "<td>"
                            + "<textarea id='email_list_for_to_readonly' name='email_list_for_to' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;'></textarea>"
                        + "</td>"
                        + "<td colspan='2'></td>" 
                    + "</tr>"
                    //cc
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_cc+":</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_users+"</td>"
                        + "<td>"
                            + "<input id='email_users_for_cc_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_roles+"</td>"
                        + "<td>"
                            + "<input id='email_roles_for_cc_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_notificationEmails+"</td>"
                        + "<td>"
                            + "<input id='email_notificationEmails_for_cc_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_distribution_list+":</td>"
                        + "<td>"
                            + "<textarea id='email_list_for_cc_readonly' name='email_list_for_to' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' ></textarea>"
                        + "</td>"
                        + "<td colspan='2'></td>" 
                    + "</tr>"
                    //bcc
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_bcc+":</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_users+"</td>"
                        + "<td>"
                            + "<input id='email_users_for_bcc_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"+"</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_roles+"</td>"
                        + "<td>"
                            + "<input id='email_roles_for_bcc_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_notificationEmails+"</td>"
                        + "<td>"
                            + "<input id='email_notificationEmails_for_bcc_readonly' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' />"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td>"+lbl_asol_task_js_send_email_distribution_list+":</td>"
                        + "<td>"
                            + "<textarea id='email_list_for_bcc_readonly' name='email_list_for_to' type='text' readonly='' class='send_email_summary' onmouseover='this.title=this.value;' ></textarea>"
                        + "</td>"
                        + "<td colspan='2'></td>" 
                    + "</tr>"
                + "</table>"
            + "</div>"
		;
			
		var tab_to_HTML = ""
			+ "<div class='content' id='to'>"
                + "<h2>"+lbl_asol_task_js_send_email_to+"</h2>"
                + "<table class='edit view'>"
                    + "<tr>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_users+"</b>"
                            + "<br>"
                            +users_select_for_to
                        +"</td>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_roles+"</b>"
                            + "<br>"
                            +acl_roles_select_for_to
                        +"</td>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_notificationEmails+"</b>"
                            + "<br>"
                            +notificationEmails_select_for_to
                        +"</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td colspan='3'>"
                            + "<b>"+lbl_asol_task_js_send_email_distribution_list+"</b>"
                            + "<br>"
                            + "<textarea id='email_list_for_to' name='email_list_for_to' rows='6' cols='121' style='height: 50px;'></textarea>"
                        + "</td>"
                    + "</tr>"
                + "</table>"
            + "</div>"
		;
		
		var tab_cc_HTML = ""
            + "<div class='content' id='cc'>"
                + "<h2>"+lbl_asol_task_js_send_email_cc+"</h2>"
                + "<table class='edit view'>"
                    + "<tr>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_users+"</b>"
                            + "<br>"
                            +users_select_for_cc
                        +"</td>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_roles+"</b>"
                            + "<br>"
                            +acl_roles_select_for_cc
                        +"</td>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_notificationEmails+"</b>"
                            + "<br>"
                            +notificationEmails_select_for_cc
                        +"</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td colspan='3'>"
                            + "<b>"+lbl_asol_task_js_send_email_distribution_list+"</b>"
                            + "<br>"
                            + "<textarea id='email_list_for_cc' name='email_list_for_cc' rows='6' cols='121' style='height: 50px;'></textarea>"
                        + "</td>"
                    + "</tr>"
                + "</table>"
            + "</div>"
        ;
		
		var tab_bcc_HTML = ""
            + "<div class='content' id='bcc'>"
                + "<h2>"+lbl_asol_task_js_send_email_bcc+"</h2>"
                + "<table class='edit view'>"
                    + "<tr>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_users+"</b>"
                            + "<br>"
                            +users_select_for_bcc
                        +"</td>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_roles+"</b>"
                            + "<br>"
                            +acl_roles_select_for_bcc
                        +"</td>"
                        + "<td>"
                            + "<b>"+lbl_asol_task_js_send_email_notificationEmails+"</b>"
                            + "<br>"
                            +notificationEmails_select_for_bcc
                        +"</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td colspan='3'>"
                            + "<b>"+lbl_asol_task_js_send_email_distribution_list+"</b>"
                            + "<br>"
                            + "<textarea id='email_list_for_bcc' name='email_list_for_bcc' rows='6' cols='121' style='height: 50px;'></textarea>"
                        + "</td>"
                    + "</tr>"
                + "</table>"
            + "</div>"
        ;
		
		document.getElementById("task_implementation.default").innerHTML += ""
			+ menu_to_cc_bcc_HTML
			+ tab_all_HTML
			+ tab_to_HTML
			+ tab_cc_HTML
			+ tab_bcc_HTML
		;
		
		break;

	case "php_custom":
	
		document.getElementById("task_implementation.default").innerHTML += ""
			+ "<table class='edit view'>"
                + "<tr>"
                    + "<td>"+lbl_asol_task_js_php_custom_php_code+":</td>"
                    + "<td>"
                        + "<textarea id='php_custom' name='php_custom' rows='10' cols='60'></textarea>"
                    + "</td>"
                + "</tr>"
            + "</table>"
		;
			
		break;

	case "end":
		
		document.getElementById("task_implementation.default").innerHTML += ""
			+ "<table class='edit view'>"
                + "<tr>"
                    + "<td>"+lbl_asol_task_js_end_terminate_process+": <input type='checkbox' id='terminate_process' name='terminate_process'></td>"
                + "</tr>" 
            + "</table>"
        ;
        
		break;

	case "continue":
		
		document.getElementById("task_implementation.default").innerHTML += ""
			+ "<table class='edit view'>" 
                + "<tr>" 
                    + "<td>"+lbl_asol_task_js_continue_wait_for_sugar_task_to_continue_process+"...</td>"
                + "</tr>" 
			+ "</table>"
		;
		
		break;

	case "call_process":
		
		document.getElementById("task_implementation.default").innerHTML += ""
			+ "<table class='edit view'>"
                + "<tr>"
                    + "<td>"+lbl_asol_task_js_call_process_process+":</td>"
                    + "<td>"
                        + "<input type='text' autocomplete='off' title='' value='' size='' id='process_name' name='process_name'>"
                        + "<input type='hidden' value='' id='process_id' name='process_id'>"
                        + "<button onclick='open_popup(\"asol_Process\", 600, 400, \"\", true, false, {\"call_back_function\":\"set_return\",\"form_name\":\"EditView\",\"field_to_name_array\":{\"id\":\"process_id\",\"name\":\"process_name\"}}, \"single\", true );' value='Select' class='button firstChild' id='btn_assigned_user_name' name='btn_assigned_user_name' type='button'>"
                            + "<img src='themes/default/images/id-ff-select.png'>"
                        + "</button>"
                        + "<button value='Clear' onclick='document.getElementById(\"process_name\").value =\"\"; document.getElementById(\"process_id\").value = \"\";' class='button lastChild' id='btn_clr_assigned_user_name' name='btn_clr_assigned_user_name' type='button'>"
                            + "<img src='themes/default/images/id-ff-clear.png'>"
                        + "</button>"
                    + "</td>"
                    + "<td>"+lbl_asol_task_js_call_process_event_from_process+":</td>"
                    + "<td>"
                        + "<input type='text' autocomplete='off' title='' value='' size='' id='event_name' name='event_name'>"
                        + "<input type='hidden' value='' id='event_id' name='event_id'>"
                        + "<button onclick='open_popup(\"asol_Events\", 600, 400, \"\", true, false, {\"call_back_function\":\"set_return\",\"form_name\":\"EditView\",\"field_to_name_array\":{\"id\":\"event_id\",\"name\":\"event_name\"}}, \"single&parent_module=asol_Task&parent_id=\" + document.getElementById(\"process_id\").value , true );' value='Select' class='button firstChild' id='btn_assigned_user_name2' name='btn_assigned_user_name2' type='button'>"
                            + "<img src='themes/default/images/id-ff-select.png'>"
                        + "</button>"
                        + "<button value='Clear' onclick='document.getElementById(\"event_name\").value =\"\"; document.getElementById(\"event_id\").value = \"\";' class='button lastChild' id='btn_clr_assigned_user_name2' name='btn_clr_assigned_user_name2' type='button'>"
                            + "<img src='themes/default/images/id-ff-clear.png'>"
                        + "</button>"
                    + "</td>"
                + "</tr>"
                + "<tr>"
                    + "<td colspan='4'>"
                        + "<br>"
                    + "</td>"
                + "<tr>"
                     + "<td colspan='4'>"+lbl_asol_task_js_call_process_execute_subprocess_immediately+": <input type='checkbox' id='execute_subprocess_immediately' name='execute_subprocess_immediately'></td>"
                + "</tr>"
			+ "</table>"
		;
		
		break;
		
	default:
		break;
	}
}

function openSelectedEmailTemplatePopup(email_template_id, left, top) {
    
    var url = 'index.php?module=EmailTemplates&offset=1&stamp=1368534347003501000&return_module=EmailTemplates&action=DetailView&record='+email_template_id;
    
    var popup = window.open(url, email_template_id, 'width=500, height=500, top='+top+', left='+left+', location=no, menubar=no, resizable=yes, scrollbars=yes, status=no, titlebar=no, toolbar=no');
    popup.focus();
}

function insertCustomVariables(idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, idSelectRelatedFields, key, typeRelatedFields, related_enum_operator, related_enum_reference, calendar_dateformat) {
                
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
    
    if (fields != null) {
        insertCustomVariables_fields_And_relatedFields("false", table, fields, types, enum_operator_array, enum_reference_array, "", calendar_dateformat);
    }
    
    if (related_fields != null) {
        insertCustomVariables_fields_And_relatedFields("true", table, related_fields, related_types, related_enum_operator_array, related_enum_reference_array, key, calendar_dateformat);
    }
}

function insertCustomVariables_fields_And_relatedFields(isRelated, table, fields, types, enum_operator, enum_reference, key, calendar_dateformat) {
    
    var param1 = new Array();
    var param2 = new Array();

    var keys = key.split("${comma}");

    for (var i in fields.options) {

        if (fields.options[i].selected) {
            
            key = (keys.length == 1) ? key : keys[i];
            
            var rowIndex = document.getElementById("uniqueRowIndexes").value;

            var row = document.createElement("tr");
            row.setAttribute("class", "customVariables_oddListRowS1");
            
            var cell_Name = document.createElement("td");
            var cell_Type = document.createElement("td");
            var cell_ModuleField = document.createElement("td");
            var cell_Function = document.createElement("td");
            var cell_IsGlobal = document.createElement("td");
            var cell_Hidden = document.createElement("td"); 
            cell_Hidden.align = "right";
            
            cell_Name.innerHTML = acv_generateName_HTML(rowIndex, fields.options[i].value);
            cell_Type.innerHTML = acv_generateType_HTML(rowIndex, "sql");
            var moduleField_array = {0:fields.options[i].value, 1:fields.options[i].getAttribute("label_key"), 2:fields.options[i].text};
            cell_ModuleField.innerHTML = acv_generateModuleField_HTML(rowIndex, key, moduleField_array);
            cell_Function.innerHTML = acv_generateFunction_HTML(rowIndex, '', types[i], 'en_us');
            cell_IsGlobal.innerHTML = acv_generateIsGlobal_HTML(rowIndex, "false");
            cell_Hidden.innerHTML = acv_generateDeleteRow_HTML(rowIndex, types[i], key, isRelated, i, enum_operator[i], enum_reference[i]);
           
            row.appendChild(cell_Name);
            row.appendChild(cell_Type);
            row.appendChild(cell_ModuleField);
            row.appendChild(cell_Function);
            row.appendChild(cell_IsGlobal);
            row.appendChild(cell_Hidden);
            table.getElementsByTagName('tbody')[0].appendChild(row); 

            document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
        }
    }
}


function addCustomVariable_from_notAField(idTable) {

    var table = document.getElementById(idTable);

    var rowIndex = document.getElementById("uniqueRowIndexes").value;

    var row = document.createElement("tr");
    row.setAttribute("class", "customVariables_oddListRowS1");

    var cell_Name = document.createElement("td");
    var cell_Type = document.createElement("td");
    var cell_ModuleField = document.createElement("td");
    var cell_Function = document.createElement("td");
    var cell_IsGlobal = document.createElement("td");
    var cell_Hidden = document.createElement("td");
    cell_Hidden.align = "right";

    cell_Name.innerHTML = acv_generateName_HTML(rowIndex, 'custom_variable name');
    cell_Type.innerHTML = acv_generateType_HTML(rowIndex, "literal");
    var moduleField_array = {
        0 : '',
        1 : '',
        2 : ''
    };
    cell_ModuleField.innerHTML = acv_generateModuleField_HTML(rowIndex, '', moduleField_array);
    cell_Function.innerHTML = acv_generateFunction_HTML(rowIndex, '', '', 'en_us');
    cell_IsGlobal.innerHTML = acv_generateIsGlobal_HTML(rowIndex, "false");
    cell_Hidden.innerHTML = acv_generateDeleteRow_HTML(rowIndex, '', '', 'false', '0', '', '');

    row.appendChild(cell_Name);
    row.appendChild(cell_Type);
    row.appendChild(cell_ModuleField);
    row.appendChild(cell_Function);
    row.appendChild(cell_IsGlobal);
    row.appendChild(cell_Hidden);
    table.getElementsByTagName('tbody')[0].appendChild(row);

    document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
}

/**
 * When you select a Object Module within asol_Task, this is the code intended to create and to fill the object's fields(only the mandatory fields).
 */
function fillRequiredFields(idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, relate_modules, is_required, calendar_dateformat) {
	
	insertObjectField_OR_fillRequiredFields("fillRequiredFields", idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, relate_modules, is_required, calendar_dateformat);
}

/**
 * When you want to add a new field to an object.
 */
function insertObjectField(idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, relate_modules, is_required, calendar_dateformat) {

	insertObjectField_OR_fillRequiredFields("insertObjectField", idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, relate_modules, is_required, calendar_dateformat);
}

function insertObjectField_OR_fillRequiredFields(is_InsertObjectField_OR_is_FillRequiredFields, idTable, idSelectFields, fieldLabels, typeFields, enum_operator, enum_reference, relate_modules, is_required, calendar_dateformat) {

	var table = document.getElementById(idTable);
	var fields = document.getElementById(idSelectFields);
	var types = typeFields.split("${comma}");
	var enum_operator_array = enum_operator.split("${comma}");
	var enum_reference_array = enum_reference.split("${comma}");
	var relateModules = relate_modules.split("${comma}");
	var required = is_required.split("${comma}");
	
	if (fields != null) {

		for (var i = 0; i < fields.options.length; i++) {

			var rowIndex = document.getElementById("uniqueRowIndexes").value;
			
			if (  ((is_InsertObjectField_OR_is_FillRequiredFields == "insertObjectField") && fields.options[i].selected)   ||   ((is_InsertObjectField_OR_is_FillRequiredFields == "fillRequiredFields") && (required[i] == "true"))  ) {

				if ((is_InsertObjectField_OR_is_FillRequiredFields == "insertObjectField") && (required[i] == "true") && (document.getElementById("task_type").value == "create_object")) {
					// BEGIN - Language Labels
					var lbl_asol_insert_not_allowed_alert = SUGAR.language.get('asol_Task', 'LBL_ASOL_INSERT_NOT_ALLOWED_ALERT');
					// END - Language Labels
					alert(lbl_asol_insert_not_allowed_alert);
				} else {
					var row = document.createElement("tr");
					var cell_Field = document.createElement("td");
					var cell_Value = document.createElement("td");
					var cell_Hidden = document.createElement("td");
	
					var fieldName_array = {0:fields.options[i].value, 1:fields.options[i].getAttribute("label_key"), 2:fields.options[i].text};
					cell_Field.innerHTML = generate_Name_of_the_Field_HTML(rowIndex, required[i], fieldName_array);
					
					if (types[i].indexOf("int") === 0)
						types[i] = "int";
	
					switch (types[i]) {
	
					case "enum":
						cell_Value.innerHTML = generate_Enum_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, "", enum_operator_array[i], enum_reference_array[i]);
						break;
	
					case "int":
					case "double":
					case "currency":
						cell_Value.innerHTML = generate_Int_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
						break;
	
					case "datetime":
		               	cell_Value.innerHTML = generate_DateTime_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, '${current_datetime_db_format}', '+' ,"", "", "", "", "");
						break;
	
					case "date":
		               	cell_Value.innerHTML = generate_Date_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, '${current_date_db_format}', '+', "", "", "");
						break;
	
					case "tinyint(1)":
						cell_Value.innerHTML = generate_Tinyint_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
						break;
	
					case "relate":
						cell_Value.innerHTML = generate_Relate_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, "${comma}", relateModules[i])
						break;
	
					default:
						cell_Value.innerHTML = generate_Default_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, "");
						break;
					}
					
					cell_Hidden.innerHTML = generate_Hidden_delete_row_HTML(rowIndex, required[i], i, types[i], enum_operator_array[i], enum_reference_array[i], relateModules[i]);
					
					row.appendChild(cell_Field);
					row.appendChild(cell_Value);
					row.appendChild(cell_Hidden);
					table.getElementsByTagName('tbody')[0].appendChild(row);
					
					document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
				}
			}
		}
	}
}

/**
 * Remember data from DataBase
 */
function remember_taskImplementation(taskType, implementationField) {

    //alert(implementationField);

	switch (taskType) {

		case "send_email":
			
			var emailInfo = implementationField.split("${pipe}");
			
			// "all"-tab
			if (typeof emailInfo[0] != 'undefined') {
				document.getElementById("email_tpl_id").value = emailInfo[0];
			}
			if (typeof emailInfo[1] != 'undefined') {
				document.getElementById("email_tpl_name").value = unescape(emailInfo[1]);
			}
			if (typeof emailInfo[2] != 'undefined') {
				document.getElementById("email_from").value = unescape(emailInfo[2]);
			}
			
			// to,cc,bcc tabs
			var to_cc_bcc = {3:'to', 4:'cc', 5:'bcc'};
			for (var index in to_cc_bcc) {
				
				index = parseInt(index);// problems adding: "index+3" (literal + number)
				
				// users select: to,cc,bcc -->(3,4,5)
				if (typeof emailInfo[index] != 'undefined') {
					users_selected = emailInfo[index].split("${comma}");
					
					//document.getElementById("email_users_for_"+to_cc_bcc[index]+"_readonly").value = emailInfo[index].replace(/${comma}/g,',');
					
					for (var i=0; i< document.getElementById("email_users_for_"+to_cc_bcc[index]).options.length; i++) {
						for (var j=0; j< users_selected.length; j++) {
							if (document.getElementById("email_users_for_"+to_cc_bcc[index]).options[i].value == users_selected[j]) {
								document.getElementById("email_users_for_"+to_cc_bcc[index]).options[i].selected = "true";
								
								document.getElementById("email_users_for_"+to_cc_bcc[index]+"_readonly").value += document.getElementById("email_users_for_"+to_cc_bcc[index]).options[i].innerHTML + ',';
							}
						}
					}
					document.getElementById("email_users_for_"+to_cc_bcc[index]+"_readonly").value = document.getElementById("email_users_for_"+to_cc_bcc[index]+"_readonly").value.slice(0,-1);
				}
				
				// acl_roles select: to,cc,bcc -->(6,7,8)
				if (typeof emailInfo[index+3] != 'undefined') {
					roles_selected = emailInfo[index+3].split("${comma}");
					
					//document.getElementById("email_roles_for_"+to_cc_bcc[index]+"_readonly").value = emailInfo[index+3].replace(/${comma}/g,',');
					
					for (var i=0; i< document.getElementById("email_roles_for_"+to_cc_bcc[index]).options.length; i++) {
						for (var j=0; j< roles_selected.length; j++) {
							if (document.getElementById("email_roles_for_"+to_cc_bcc[index]).options[i].value == roles_selected[j]) {
								document.getElementById("email_roles_for_"+to_cc_bcc[index]).options[i].selected = "true";
								
								document.getElementById("email_roles_for_"+to_cc_bcc[index]+"_readonly").value += document.getElementById("email_roles_for_"+to_cc_bcc[index]).options[i].innerHTML + ',';
							}
						}
					}
					document.getElementById("email_roles_for_"+to_cc_bcc[index]+"_readonly").value = document.getElementById("email_roles_for_"+to_cc_bcc[index]+"_readonly").value.slice(0,-1);
				}
				
				// email_list textarea: to,cc,bcc -->(9,10,11)
				if (typeof emailInfo[index+6] != 'undefined') {
					document.getElementById("email_list_for_"+to_cc_bcc[index]).value = unescape(emailInfo[index+6]);
					
					document.getElementById("email_list_for_"+to_cc_bcc[index]+"_readonly").value = unescape(emailInfo[index+6]);
				}
				
				// notificationEmails select: to,cc,bcc -->(12,13,14)
                if (typeof emailInfo[index+9] != 'undefined') {
                    notificationEmails_selected = emailInfo[index+9].split("${comma}");
                    
                    //document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index+9]+"_readonly").value = emailInfo[index+9].replace(/${comma}/g,',');
                    
                    for (var i=0; i< document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]).options.length; i++) {
                        for (var j=0; j< notificationEmails_selected.length; j++) {
                            if (document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]).options[i].value == notificationEmails_selected[j]) {
                                document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]).options[i].selected = "true";
                                
                                document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]+"_readonly").value += document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]).options[i].innerHTML + ',';
                            }
                        }
                    }
                    document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]+"_readonly").value = document.getElementById("email_notificationEmails_for_"+to_cc_bcc[index]+"_readonly").value.slice(0,-1);
                }
			}
			
			break;

		case "php_custom":
			document.getElementById("php_custom").value = unescape(implementationField);
			break;
	
		case "end":
			document.getElementById("terminate_process").checked = (implementationField == "true") ? true : false;
			break;
	
		case "continue":
			break;
	
		case "create_object":
		case "modify_object":
			
			document.getElementById('task_implementation.default').style.display = "none";
			document.getElementById('task_implementation.create_modify_object').style.display = "block";
			
			var fieldModule = implementationField.split("${mod}");
			var module = fieldModule[0];
			
			var fields = fieldModule[1].split("${pipe}");
			var table = document.getElementById('module_values_Table');
			
			if (fields[0] == "") { fields = [];	} // Fixed-bug when remembering a modify_object with no info
			for (var i in fields) {
				
				var rowIndex = document.getElementById("uniqueRowIndexes").value;
				
				var values = fields[i].split("${dp}");
				// BEGIN - values array
				var fieldName = values[0];
				var fieldName_array = fieldName.split("${comma}");
				var fieldValue = values[1];
				//alert(fieldValue);
				var fieldIndex = values[2];// index of module_fields, not rowIndex
				var fieldType = values[3];
				var required = values[4];
				var enum_operator = values[5];
				var enum_reference = values[6];
				var relate_module = values[7];
				// END - values array
				var row = document.createElement("tr");
				var cell_Field = document.createElement("td");
				var cell_Value = document.createElement("td");
				var cell_Hidden = document.createElement("td");
				
				cell_Field.innerHTML = generate_Name_of_the_Field_HTML(rowIndex, required, fieldName_array);
				
				switch (fieldType) {
				
					case "enum":
						cell_Value.innerHTML = generate_Enum_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, unescape(fieldValue), /*options, options_db,*/ enum_operator, enum_reference);
						break;
					
					case "int":
					case "double":
					case "currency":
						cell_Value.innerHTML = generate_Int_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, fieldValue);
						break;
	
					case "datetime":
						
						// new_version ${old_bean->date_start}${make_datetime}add${offset}YY-mm-dd HH:ii
						// old_version ${current_datetime->02-03-04 05:06}
						
						var unescape_values = unescape(fieldValue);
						
						var baseDateTime_offset = unescape_values.split('${make_datetime}');
						var baseDateTime = baseDateTime_offset[0];
						var offset = baseDateTime_offset[1];
						
						var offset_array = offset.split('${offset}');
						var offset_sign = offset_array[0];
						var offset_value = offset_array[1];
						
						// offset
						var delta = offset_value;
						var delta__array = delta.split(" ");
						var delta_date = delta__array[0];
						var delta_time = delta__array[1];
						
						var delta_date__array = delta_date.split("-");
						var years = delta_date__array[0];
						var months = delta_date__array[1];
						var days = delta_date__array[2];
						
						var delta_time__array = delta_time.split(":");
						var hours = delta_time__array[0];
						var minutes = delta_time__array[1];
							
						cell_Value.innerHTML = generate_DateTime_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, baseDateTime, offset_sign, years, months, days, hours, minutes);
							
						break;
	
					case "date":
					
					    // new_version ${old_bean->date_closed}${make_date}add${offset}YY-mm-dd
                        // old_version ${current_date->02-03-04}
	
						var unescape_values = unescape(fieldValue);
						
						var baseDate_offset = unescape_values.split('${make_date}');
                        var baseDate = baseDate_offset[0];
                        var offset = baseDate_offset[1];
                        
                        var offset_array = offset.split('${offset}');
                        var offset_sign = offset_array[0];
                        var offset_value = offset_array[1];
                        
                        // offset
                        var delta = offset_value;
						var delta_date = delta;
						var delta_date__array = delta_date.split("-");
						var years = delta_date__array[0];
						var months = delta_date__array[1];
						var days = delta_date__array[2];
						
						cell_Value.innerHTML = generate_Date_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, baseDate, offset_sign, years, months, days);
	
						break;
	
					case "tinyint(1)":
						cell_Value.innerHTML = generate_Tinyint_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, fieldValue);
						break;
	
					case "relate":
						cell_Value.innerHTML = generate_Relate_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, fieldValue, relate_module);
						break;
	
					default:
						cell_Value.innerHTML = generate_Default_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, fieldValue);
						break;
				}
				
				cell_Hidden.innerHTML = generate_Hidden_delete_row_HTML(rowIndex, required, fieldIndex, fieldType, /*options, options_db,*/ enum_operator, enum_reference, relate_module);
				
				//alert(values);
				row.appendChild(cell_Field);
				row.appendChild(cell_Value);
				row.appendChild(cell_Hidden);
				table.getElementsByTagName('tbody')[0].appendChild(row);
				
				document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
			}
			
			break;
	
		case "call_process":
		
			var implementationField_array = implementationField.split("${pipe}");
			document.getElementById("process_id").value = implementationField_array[0];
			document.getElementById("process_name").value = implementationField_array[1];
			document.getElementById("event_id").value = implementationField_array[2];
			document.getElementById("event_name").value = implementationField_array[3];
			document.getElementById("execute_subprocess_immediately").checked = (implementationField_array[4] == "true") ? true : false;
			
			break;

		case "add_custom_variables":
			
			var table = document.getElementById('acv_Table');
            //customVariables_Values = customVariables_Values.replace(/"/g, "&quot;");
            var customVariables = implementationField.split("${pipe}");
        
            if (implementationField != "") {
        
                for (var i in customVariables) {
                    
                    var rowIndex = document.getElementById("uniqueRowIndexes").value;
        
                    var values = customVariables[i].split("${dp}");
                    
                    // BEGIN - values array
                    var name = values[0];
                    var type = values[1];
                    var moduleField = values[2];
                    var moduleField_array = moduleField.split("${comma}");
                    var ffunction = values[3];
                    var fieldType = values[4];
                    var key = values[5];
                    var isRelated = values[6];
                    var isGlobal = values[7];
                    var fieldIndex = values[8];
                    // END - values array
                    
                    var row = document.createElement("tr");
                    row.setAttribute("class", "customVariables_oddListRowS1");
                    
                    var cell_Name = document.createElement("td");
                    var cell_Type = document.createElement("td");
                    var cell_ModuleField = document.createElement("td");
                    var cell_Function = document.createElement("td");
                    var cell_IsGlobal = document.createElement("td");
                    var cell_Hidden = document.createElement("td"); 
                    cell_Hidden.align = "right";
                    
                    cell_Name.innerHTML = acv_generateName_HTML(rowIndex, name);
                    cell_Type.innerHTML = acv_generateType_HTML(rowIndex, type);
                    cell_ModuleField.innerHTML = acv_generateModuleField_HTML(rowIndex, key, moduleField_array);
                    cell_Function.innerHTML = acv_generateFunction_HTML(rowIndex, ffunction, fieldType, 'en_us');
                    cell_IsGlobal.innerHTML = acv_generateIsGlobal_HTML(rowIndex, isGlobal);
                    cell_Hidden.innerHTML = acv_generateDeleteRow_HTML(rowIndex, fieldType, key, isRelated, fieldIndex, enum_operator, enum_reference);
                   
                    row.appendChild(cell_Name);
                    row.appendChild(cell_Type);
                    row.appendChild(cell_ModuleField);
                    row.appendChild(cell_Function);
                    row.appendChild(cell_IsGlobal);
                    row.appendChild(cell_Hidden);
                    table.getElementsByTagName('tbody')[0].appendChild(row); 
        
                    document.getElementById("uniqueRowIndexes").value = parseInt(document.getElementById("uniqueRowIndexes").value) + 1;
                }
            }
			
			break;
	}
}

/**
 * This function is to collect the data that will be stored to the database.
 */
function format_taskImplementation(task_select_id) {
	
	var task_type_selected = document.getElementById(task_select_id).value;
	var formated_string = "";

	switch (task_type_selected) {

	case "send_email":
		
		var to_cc_bcc = {3:'to', 4:'cc', 5:'bcc'};
		var users_opts_string_for = [];
		var acl_roles_opts_string_for = [];
		var email_list_for = [];
		var notificationEmails_opts_string_for = [];
		for (var index in to_cc_bcc) {
			users_opts_string_for[to_cc_bcc[index]] = get_Emails_from_UsersSelect(to_cc_bcc[index]);
			acl_roles_opts_string_for[to_cc_bcc[index]] = get_Emails_from_AclrolesSelect(to_cc_bcc[index]);
			email_list_for[to_cc_bcc[index]] = (document.getElementById('email_list_for_'+to_cc_bcc[index]).value).replace(/ /g,'').replace(/\n/g,'');
			notificationEmails_opts_string_for[to_cc_bcc[index]] = get_Emails_from_notificationEmailsSelect(to_cc_bcc[index]);
		}
		
		formated_string = ""
			+ document.getElementById('email_tpl_id').value
			+ "${pipe}" + escape(document.getElementById('email_tpl_name').value)
			+ "${pipe}" + escape(document.getElementById('email_from').value)
			
			+ "${pipe}" + users_opts_string_for['to']
			+ "${pipe}" + users_opts_string_for['cc'] 
			+ "${pipe}" + users_opts_string_for['bcc']
			
			+ "${pipe}"	+ acl_roles_opts_string_for['to']
			+ "${pipe}"	+ acl_roles_opts_string_for['cc']
			+ "${pipe}"	+ acl_roles_opts_string_for['bcc']
			
			+ "${pipe}"	+ escape(email_list_for['to'])
			+ "${pipe}"	+ escape(email_list_for['cc'])
			+ "${pipe}"	+ escape(email_list_for['bcc'])
			
			+ "${pipe}" + notificationEmails_opts_string_for['to']
            + "${pipe}" + notificationEmails_opts_string_for['cc'] 
            + "${pipe}" + notificationEmails_opts_string_for['bcc']
			
			;
		
		break;

	case "php_custom":
		formated_string = escape(document.getElementById('php_custom').value);
		break;

	case "end":
		formated_string = (document.getElementById('terminate_process').checked) ? "true" : "false";
		break;

	case "continue":
		formated_string = "";
		break;

	case "create_object":
	case "modify_object":
		
		var uniqueRowIndexes = parseInt(document.getElementById("uniqueRowIndexes").value);

		formated_string = "";
		
		for (var rowIndex=0; rowIndex<uniqueRowIndexes; rowIndex++) {

            if (document.getElementById('fieldName_'+rowIndex) !== null) {	
			
	    		formated_string += document.getElementById('fieldName_'+rowIndex).getAttribute("value") +"${comma}"+ document.getElementById('fieldName_'+rowIndex).getAttribute("label_key") +"${comma}"+ document.getElementById('fieldName_'+rowIndex).innerHTML;
	    		
	    		formated_string += "${dp}";
	    	
	    		switch (document.getElementById('field_type_'+rowIndex).value) {
	    			case "datetime":
	    				formated_string += escape(document.getElementById('baseDatetime_'+rowIndex).value + '${make_datetime}' + document.getElementById('offsetSign_'+rowIndex).value + '${offset}' + document.getElementById('date_start_years_'+rowIndex).value + "-" + document.getElementById('date_start_months_'+rowIndex).value + "-" + document.getElementById('date_start_days_'+rowIndex).value + " " + document.getElementById('date_start_hours_'+rowIndex).value + ":" + document.getElementById('date_start_minutes_'+rowIndex).value + "");
	    				break;
	    			case "date":
	    				formated_string += escape(document.getElementById('baseDate_'+rowIndex).value + '${make_date}' + document.getElementById('offsetSign_'+rowIndex).value + '${offset}' + document.getElementById('date_start_years_'+rowIndex).value + "-" + document.getElementById('date_start_months_'+rowIndex).value + "-" + document.getElementById('date_start_days_'+rowIndex).value + "");
	    				break;
	    			case "relate":
	    				formated_string += document.getElementById('record_id_'+rowIndex).value + "${comma}" + escape(document.getElementById('record_name_'+rowIndex).value);
	    				break;
	    			case "tinyint(1)":
	    				formated_string +=  document.getElementById('Param1_'+rowIndex).checked;
	    				break;
	    			default:
	    				formated_string += escape(document.getElementById('Param1_'+rowIndex).value);
	    				break;
	    		}
	    		
	    		formated_string += "${dp}";
	        		
	    		formated_string += document.getElementById('index_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('field_type_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('is_required_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('enum_operator_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('enum_reference_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('relate_module_'+rowIndex).value;
	            
	            formated_string += "${pipe}";
	        }
		}
		
		formated_string = document.getElementById("objectModule").value+"${mod}"+formated_string.slice(0, -7);
		
		break;

	case "call_process":
		formated_string = 	
			document.getElementById("process_id").value
			+ "${pipe}" + document.getElementById("process_name").value
			+ "${pipe}" + document.getElementById("event_id").value
			+ "${pipe}" + document.getElementById("event_name").value;
			
		formated_string += "${pipe}";
		formated_string += (document.getElementById('execute_subprocess_immediately').checked) ? "true" : "false";
		break;
	
	case "add_custom_variables":
		
		var uniqueRowIndexes = parseInt(document.getElementById("uniqueRowIndexes").value);

		formated_string = "";
		
		for (var rowIndex=0; rowIndex<uniqueRowIndexes; rowIndex++) {

            if (document.getElementById('acv_variable_name_'+rowIndex) !== null) {	
			    
			    formated_string += document.getElementById('acv_variable_name_'+rowIndex).value + "${dp}";
			    formated_string += document.getElementById('acv_variable_type_'+rowIndex).value + "${dp}";
			    formated_string += document.getElementById('acv_variable_moduleFields_'+rowIndex).getAttribute("value") +"${comma}"+ document.getElementById('acv_variable_moduleFields_'+rowIndex).getAttribute("label_key") +"${comma}"+ document.getElementById('acv_variable_moduleFields_'+rowIndex).innerHTML + "${dp}";
	    		formated_string += document.getElementById("function_"+rowIndex).value +"${comma}"+ document.getElementById("configure_calculated_value_"+rowIndex).value+"${dp}";
	    		formated_string += document.getElementById('field_type_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('key_'+rowIndex).value + "${dp}";
	    		formated_string += document.getElementById('is_related_'+rowIndex).value + "${dp};";
	    		formated_string += (document.getElementById('is_global').checked) ? "true" : "false";
	    		formated_string += "${dp}";
	    		formated_string += document.getElementById('index_'+rowIndex).value ;
	    	    
	            formated_string += "${pipe}";
	        }
		}
		
		formated_string = formated_string.slice(0, -7);
		formated_string = formated_string;
		break;
		
	}

	//alert(formated_string);
	return formated_string;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////AUX FUNCTIONS///////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function generate_Name_of_the_Field_HTML(rowIndex, required, fieldName_array) {
	
	var translateFieldLabels = asol_var['translateFieldLabels'];
	
	var value = fieldName_array[0];
	var label_key = fieldName_array[1];
	var label = fieldName_array[2];
	
	var module = document.getElementById("objectModule").value;
	
	var lbl_field = SUGAR.language.get(module, label_key);
    if (lbl_field === 'undefined') {
        lbl_field = value;
    }

    if (translateFieldLabels) {
        inner_html = lbl_field;
    } else {
        inner_html = value;
    }

    inner_html = inner_html.trim();
    inner_html = inner_html.removeColon();
	
	var requiredSymbol = (required == "true") ? "<span> *</span>" : "";
	
	return "<b><span id='fieldName_"+rowIndex+"' name='fieldName_"+rowIndex+"' value='"+value+"' label_key='"+label_key+"'>"+inner_html+"</span>"+requiredSymbol+"</b>";
}

function generate_Enum_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, selectedValue, enum_operator, enum_reference) {
	
	var dropdown = SUGAR.language.get('app_list_strings', enum_reference);
	
	var option_db_values = [];
	var option_values = [];
	for (var key in dropdown) {
		option_db_values.push(key);
		option_values.push(dropdown[key])
	}
	
	var optionsSelect = "";
	for (var x in option_db_values) {
		var selected = (selectedValue == option_db_values[x]) ? " selected" : "";
		optionsSelect += "<option"+selected+" value='" + option_db_values[x] + "'>" + option_values[x] + "</option>";
	}

	var cell_Value_HTML = "<select name='Param1_"+rowIndex+"' id='Param1_"+rowIndex+"' style='width:140px'>" + optionsSelect + "</select>";

	return cell_Value_HTML;
}

function generate_Int_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, value) {
	
	var cell_Value_HTML = "<input type='text' name='Param1_"+rowIndex+"' id='Param1_"+rowIndex+"'  style='width:140px' value='"+value+"'>";
	
	return cell_Value_HTML;
}

function generate_Date_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, BaseDate, cell_offsetSign_SelectedValue, years, months, days) {
    
    var cell_Value_HTML = generate_BaseDate_HTML_and_Remember_DataBase_if_needed(rowIndex, BaseDate);
    cell_Value_HTML += generate_offsetSign_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_offsetSign_SelectedValue);
    cell_Value_HTML += generate_Date_DropDownLists_HTML_and_Remember_DataBase_if_needed(rowIndex, years, months, days);
    
    return cell_Value_HTML;
}

function generate_DateTime_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, BaseDatetime, cell_offsetSign_SelectedValue, years, months, days, hours, minutes) {
    
    var cell_Value_HTML = generate_BaseDatetime_HTML_and_Remember_DataBase_if_needed(rowIndex, BaseDatetime);
    cell_Value_HTML += generate_offsetSign_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_offsetSign_SelectedValue);
    cell_Value_HTML += generate_DateTime_DropDownLists_HTML_and_Remember_DataBase_if_needed(rowIndex, years, months, days, hours, minutes);
    
    return cell_Value_HTML;
}

function generate_DateTime_DropDownLists_HTML_and_Remember_DataBase_if_needed(rowIndex, years, months, days, hours, minutes) {
	
	var cell_Value_HTML = '';
	cell_Value_HTML += generate_Date_DropDownLists_HTML_and_Remember_DataBase_if_needed(rowIndex, years, months, days);
	
	// hours
	var hourOpts =  "<option value=''></option>";
	
	var hourValues = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
	var hourLabels = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
	for (var x in hourValues) {
			var selected = (hours == hourValues[x]) ? " selected" : "";
			hourOpts +=  "<option value='"+hourValues[x]+"'"+selected+">"+hourLabels[x]+"</option>";
	}
		
	// minutes
	var minOpts =  "<option value=''></option>";
	
	var minValues = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"];
	var minLabels = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"];
	for (var x in minValues) {
			var selected = (minutes == minValues[x]) ? " selected" : "";
			minOpts +=  "<option value='"+minValues[x]+"'"+selected+">"+minLabels[x]+"</option>";
	}
	
	cell_Value_HTML += 
		"<label for='date_start_hours_"+rowIndex+"'>h:</label>"
		+ "<select class='datetimecombo_time' size='1' id='date_start_hours_"+rowIndex+"'>" + hourOpts + "</select>&nbsp;&nbsp;"
		+ "<label for='date_start_minutes_"+rowIndex+"'>i:</label>"
		+ "<select class='datetimecombo_time' size='1' id='date_start_minutes_"+rowIndex+"'>" + minOpts + "</select>";
	
	return cell_Value_HTML;
}

function generate_Date_DropDownLists_HTML_and_Remember_DataBase_if_needed(rowIndex, years, months, days) {
	
	//years
	var yearOpts =  "<option value=''></option>";
	
	var yearValues = ["01","02","03","04","05","06","07","08","09","10"];
	var yearLabels = ["01","02","03","04","05","06","07","08","09","10"];
	for (var x in yearValues) {
			var selected = (years == yearValues[x]) ? " selected" : "";
			yearOpts +=  "<option value='"+yearValues[x]+"'"+selected+">"+yearLabels[x]+"</option>";
	}
	
	//months
	var monthOpts =  "<option value=''></option>";
	
	var monthValues = ["01","02","03","04","05","06","07","08","09","10","11"];
	var monthLabels = ["01","02","03","04","05","06","07","08","09","10","11"];
	for (var x in monthValues) {
			var selected = (months == monthValues[x]) ? " selected" : "";
			monthOpts +=  "<option value='"+monthValues[x]+"'"+selected+">"+monthLabels[x]+"</option>";
	}
	
	//days
	var dayOpts =  "<option value=''></option>";
	
	var dayValues = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30"];
	var dayLabels = ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30"];
	for (var x in dayValues) {
			var selected = (days == dayValues[x]) ? " selected" : "";
			dayOpts +=  "<option value='"+dayValues[x]+"'"+selected+">"+dayLabels[x]+"</option>";
	}
	
	var cell_Value_HTML = 
		"<label for='date_start_years_"+rowIndex+"'>Y:</label>"
		+ "<select class='datetimecombo_time' size='1' id='date_start_years_"+rowIndex+"'>" + yearOpts + "</select>&nbsp;&nbsp;"
		+ "<label for='date_start_months_"+rowIndex+"'>M:</label>"
		+ "<select class='datetimecombo_time' size='1' id='date_start_months_"+rowIndex+"'>" + monthOpts + "</select>&nbsp;&nbsp;"
		+ "<label for='date_start_days_"+rowIndex+"'>D:</label>"
		+ "<select class='datetimecombo_time' size='1' id='date_start_days_"+rowIndex+"'>" + dayOpts + "</select>&nbsp;&nbsp;";
	
	return cell_Value_HTML;
}

function generate_BaseDate_HTML_and_Remember_DataBase_if_needed(rowIndex, value) {
    
    var cell_Value_HTML = "<input type='text' name='baseDate_"+rowIndex+"' id='baseDate_"+rowIndex+"' style='width:140px' value='"+unescape(value)+"' onmouseover='this.title=this.value;'>";
    
    return cell_Value_HTML;
}

function generate_BaseDatetime_HTML_and_Remember_DataBase_if_needed(rowIndex, value) {
    
    var cell_Value_HTML = "<input type='text' name='baseDatetime_"+rowIndex+"' id='baseDatetime_"+rowIndex+"' style='width:140px' value='"+unescape(value)+"' onmouseover='this.title=this.value;'>";
    
    return cell_Value_HTML;
}

function generate_offsetSign_HTML_and_Remember_DataBase_if_needed(rowIndex, cell_offsetSign_SelectedValue) {
    
    // BEGIN - Language Labels
    var lbl_asol_true = '+';
    var lbl_asol_false = '-';
    // END - Language Labels
    
    var cell_offsetSign_HTML = "<select id='offsetSign_"+rowIndex+"' name='offsetSign_"+rowIndex+"' style='width: auto;' class='offsetSign'>";
    
    var cell_offsetSign_Values = ["add","substract"];
    var cell_offsetSign_Labels = [lbl_asol_true,lbl_asol_false];
    for (var x in cell_offsetSign_Values) {
        var selected = (cell_offsetSign_SelectedValue == cell_offsetSign_Values[x]) ? " selected" : "";
        cell_offsetSign_HTML +=  "<option value='"+cell_offsetSign_Values[x]+"'"+selected+">"+cell_offsetSign_Labels[x]+"</option>";
    }
    
    cell_offsetSign_HTML += "</select> ";
    
    return cell_offsetSign_HTML;
}

function generate_Tinyint_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, isChecked) {
	
	var checked = (isChecked == "true") ? " checked=''" : "";
	var cell_Value_HTML = "<input type='checkbox'"+checked+" name='Param1_"+rowIndex+"' id='Param1_"+rowIndex+"'>";
	
	return cell_Value_HTML;
}

function generate_Relate_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, relateValuesString, relateModule) {
	
	var relateValues = relateValuesString.split("${comma}");
	var popup_name = (relateModule == 'Users') ? "user_name" : "name";
	
	var cell_Value_HTML = 
		"<input type='text' autocomplete='off' title='' value='" + unescape(relateValues[1]) + "' size='' id='record_name_"+rowIndex+"' name='record_name_"+rowIndex+"' onmouseover='this.title=this.value;'>"
		+ "<input type='hidden' value='" + relateValues[0] + "' id='record_id_"+rowIndex+"' name='record_id_"+rowIndex+"'>"
		+ "<button onclick='open_popup(\"" + relateModule + "\", 600, 400, \"\", true, false, {\"call_back_function\":\"set_return\",\"form_name\":\"EditView\",\"field_to_name_array\":{\"id\":\"record_id_" + rowIndex + "\",\"" + popup_name + "\":\"record_name_" + rowIndex + "\"}}, \"single\", true );' value='Select' class='button firstChild' id='btn_assigned_user_name' name='btn_assigned_user_name' type='button'>"
		+ "<img src='themes/default/images/id-ff-select.png'>"
		+ "</button>"
		+ "<button value='Clear' onclick='document.getElementById(\"record_name_" + rowIndex + "\").value =\"\"; document.getElementById(\"record_id_" + rowIndex + "\").value = \"\";' class='button lastChild' id='btn_clr_assigned_user_name' name='btn_clr_assigned_user_name' type='button'>"
		+ "<img src='themes/default/images/id-ff-clear.png'>"
		+ "</button>";
	
	return cell_Value_HTML;
}

function generate_Default_Field_HTML_and_Remember_DataBase_if_needed(rowIndex, value) {
	
	var cell_Value_HTML = "<input type='text' name='Param1_"+rowIndex+"' id='Param1_"+rowIndex+"' style='width:140px' value='"+unescape(value)+"' onmouseover='this.title=this.value;'>";
	
	return cell_Value_HTML;
}

function generate_Hidden_delete_row_HTML(rowIndex, is_required, index, field_type, enum_operator, enum_reference, relate_module) {
	
	// BEGIN - Language Labels
	var lbl_asol_delete_button = SUGAR.language.get('asol_Task', 'LBL_ASOL_DELETE_BUTTON');
	var lbl_asol_delete_row_alert = SUGAR.language.get('asol_Task', 'LBL_ASOL_DELETE_ROW_ALERT');
	// END - Language Labels
	
	var cell_Hidden_HTML = ((is_required == "true") && (document.getElementById("task_type").value == "create_object")) ? "<span></span>" : "<img border='0' src='themes/default/images/minus_inline.gif' title=\""+lbl_asol_delete_button+"\" OnMouseOver='this.style.cursor=\"pointer\"' OnMouseOut='this.style.cursor=\"default\"' onClick='if(confirm(\""+lbl_asol_delete_row_alert+"\")) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }' name='del_button_"+rowIndex+"'>";
	cell_Hidden_HTML += 
		"<input type='hidden' id='index_"+rowIndex+"' name='index_"+rowIndex+"' value='"+ index +"'>"
		+ "<input type='hidden' id='field_type_"+rowIndex+"' name='field_type_"+rowIndex+"' value='"+ field_type +"'>"
		+ "<input type='hidden' id='is_required_"+rowIndex+"' name='is_required_"+rowIndex+"' value='"+ is_required +"'>" 
		+ "<input type='hidden' id='enum_operator_"+rowIndex+"' name='enum_operator_"+rowIndex+"' value='"+ enum_operator +"'>"
		+ "<input type='hidden' id='enum_reference_"+rowIndex+"' name='enum_reference_"+rowIndex+"' value='"+ enum_reference +"'>"
		+ "<input type='hidden' id='relate_module_"+rowIndex+"' name='relate_module_"+rowIndex+"' value='"+ relate_module +"'>"
	;
	
	return cell_Hidden_HTML;
}

function generate_SendEmail_UsersSelect_HTML(to_cc_bcc, users) {
	
	var users_select = "<select id='email_users_for_"+to_cc_bcc+"' name='email_users_for_"+to_cc_bcc+"' multiple='' size=23 style='width: 200px'>";
	for (var i = 0; i < users.length; i++) {
		var user = users[i].split("${comma}");
		users_select += "<option value='" + user[0] + "'>" + user[1] + "</option>";
	}
	users_select += "</select>";
	
	return users_select
}

function generate_SendEmail_AclrolesSelect_HTML(to_cc_bcc, acl_roles) {
	
	var acl_roles_select = "<select id='email_roles_for_"+to_cc_bcc+"' name='email_roles_for_"+to_cc_bcc+"' multiple='' size=23 style='width: 200px'>";
	for (var i = 0; i < acl_roles.length; i++) {
		var acl_role = acl_roles[i].split("${comma}");
		acl_roles_select += "<option value='" + acl_role[0] + "'>" + acl_role[1] + "</option>";
	}
	acl_roles_select += "</select>";
	
	return acl_roles_select;
}

function generate_SendEmail_notificationEmailsSelect_HTML(to_cc_bcc, notificationEmails) {
    
    var notificationEmails_select = "<select id='email_notificationEmails_for_"+to_cc_bcc+"' name='email_notificationEmails_for_"+to_cc_bcc+"' multiple='' size=23 style='width: 200px'>";
    for (var i = 0; i < notificationEmails.length; i++) {
        var notificationEmail = notificationEmails[i].split("${comma}");
        notificationEmails_select += "<option value='" + notificationEmail[0] + "'>" + notificationEmail[1] + "</option>";
    }
    notificationEmails_select += "</select>";
    
    return notificationEmails_select
}

function get_Emails_from_UsersSelect(to_cc_bcc) {
	
	var users_opts_string = "";
	for (var i = 0; i < document.getElementById('email_users_for_'+to_cc_bcc).options.length; i++) {
		if (document.getElementById('email_users_for_'+to_cc_bcc).options[i].selected) {
			users_opts_string += document.getElementById('email_users_for_'+to_cc_bcc).options[i].value + "${comma}";
		}
	}
	users_opts_string = users_opts_string.slice(0, -8);
	
	return users_opts_string;
}

function get_Emails_from_AclrolesSelect(to_cc_bcc) {

	var acl_roles_opts_string = "";
	for (var i = 0; i < document.getElementById('email_roles_for_'+to_cc_bcc).options.length; i++) {
		if (document.getElementById('email_roles_for_'+to_cc_bcc).options[i].selected) {
			acl_roles_opts_string += document.getElementById('email_roles_for_'+to_cc_bcc).options[i].value + "${comma}";
		}
	}
	acl_roles_opts_string = acl_roles_opts_string.slice(0, -8);

	return acl_roles_opts_string;
}

function get_Emails_from_notificationEmailsSelect(to_cc_bcc) {
    
    var notificationEmails_opts_string = "";
    for (var i = 0; i < document.getElementById('email_notificationEmails_for_'+to_cc_bcc).options.length; i++) {
        if (document.getElementById('email_notificationEmails_for_'+to_cc_bcc).options[i].selected) {
            notificationEmails_opts_string += document.getElementById('email_notificationEmails_for_'+to_cc_bcc).options[i].value + "${comma}";
        }
    }
    notificationEmails_opts_string = notificationEmails_opts_string.slice(0, -8);
    
    return notificationEmails_opts_string;
}

// Custom Variables

function acv_generateName_HTML(rowIndex, value) {
    
    return "<input type='text' id='acv_variable_name_"+rowIndex+"' value='"+value+"' />";
}

function acv_generateType_HTML(rowIndex, selectedValue) {
    
    var dropdown = SUGAR.language.get('app_list_strings', 'wfm_add_custom_variables_type');
    
    var option_db_values = [];
    var option_values = [];
    for (var key in dropdown) {
        option_db_values.push(key);
        option_values.push(dropdown[key])
    }
    
    var optionsSelect = "";
    for (var x in option_db_values) {
        var selected = (selectedValue == option_db_values[x]) ? " selected" : "";
        optionsSelect += "<option"+selected+" value='" + option_db_values[x] + "'>" + option_values[x] + "</option>";
    }

    var cell_Value_HTML = "<select name='acv_variable_type_"+rowIndex+"' id='acv_variable_type_"+rowIndex+"'>" + optionsSelect + "</select>";

    return cell_Value_HTML;
}

function acv_generateModuleField_HTML(rowIndex, key, fieldName_array) {
    
    var translateFieldLabels = asol_var['translateFieldLabels'];
    
    var value = fieldName_array[0];
    var label_key = fieldName_array[1]; // first I try to get the inner_html from label_key and if not posible I take it from label
    var label = fieldName_array[2];
    
    var inner_html = '';
    
    var value_array = value.split('.');
    var label_key_array = label_key.split('.');
    if (value_array.length == 2) {
        
        if (value_array[0].indexOf("_cstm") != -1) {
            
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
                var module = document.getElementById("objectModule").value;
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
        
        var objectModule_select = document.getElementById("objectModule");
        if (objectModule_select !== null) {
            var module = objectModule_select.value;

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
    
    return "<b><span id='acv_variable_moduleFields_"+rowIndex+"' name='acv_variable_moduleFields_"+rowIndex+"' value='"+value+"' title='"+key+"' label_key='"+label_key+"'>"+inner_html+"</span></b>";
}

function acv_generateIsGlobal_HTML(rowIndex, isGlobal) {
    
    var checked = (isGlobal == 'true') ? 'checked' : '';
    
    return "<input type='checkbox' id='is_global' name='is_global' "+checked+" class='checkbox_center' />";
}

function acv_generateDeleteRow_HTML(rowIndex, value_type, key, is_related, index, enum_operator, enum_reference) {
    
    // BEGIN - Language Labels
    var lbl_asol_delete_button = SUGAR.language.get('asol_Task', 'LBL_ASOL_DELETE_BUTTON');
    var lbl_asol_delete_row_alert = SUGAR.language.get('asol_Task', 'LBL_ASOL_DELETE_ROW_ALERT');
    // END - Language Labels
    
    var cell_Hidden_HTML = 
        "<img name='del_button_"+rowIndex+"' border='0' src='themes/default/images/minus_inline.gif' title=\""+lbl_asol_delete_button+"\" OnMouseOver='this.style.cursor=\"pointer\"' OnMouseOut='this.style.cursor=\"default\"' onClick='if(confirm(\""+lbl_asol_delete_row_alert+"\")) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }' >"
        + "<input type='hidden' id='field_type_"+rowIndex+"' name='field_type_"+rowIndex+"' value='" + value_type + "'>"
        + "<input type='hidden' id='key_"+rowIndex+"' name='key_"+rowIndex+"' value='" + key + "'>"
        + "<input type='hidden' id='is_related_"+rowIndex+"' name='is_related_"+rowIndex+"' value='"+is_related+"'>"
        + "<input type='hidden' id='index_"+rowIndex+"' name='index_"+rowIndex+"' value='" + index + "'>" 
        + "<input type='hidden' id='enum_operator_"+rowIndex+"' name='enum_operator_"+rowIndex+"' value='" + enum_operator + "'>" 
        + "<input type='hidden' id='enum_reference_"+rowIndex+"' name='enum_reference_"+rowIndex+"' value='" + enum_reference + "'>"
    ;
    
    return cell_Hidden_HTML;
}

// EmailTemplates popup
var popupRequestData = {'call_back_function':'set_return','form_name':'EditView','field_to_name_array':{'id':'email_tpl_id','name':'email_tpl_name'}};
function openPopupEmailTemplate() {open_popup('EmailTemplates', 700, 500, '', true, false, popupRequestData, 'single', true );};

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