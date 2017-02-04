
// FLOWCHART
function openAllFlowChartsPopups() {

    sugarListView.get_checks();
    var processes_string = document.MassUpdate.uid.value;

    if (processes_string == '') {
        alert(SUGAR.language.get('asol_Process', 'LBL_FLOWCHART_PLEASE'));
        return;
    }

    var process_ids = processes_string.split(',');
    var top = 100;
    var left = 100;
    for (var i in process_ids) {
        openFlowChartPopup(process_ids[i], left, top);
        top = top + 100;
        left = left + 100;
    }
}

function openFlowChartPopup(process_id, left, top) {
    var popup = window.open('index.php?entryPoint=wfm_flowChart&uid=' + process_id, process_id, 'width=500, height=500, top=' + top + ', left=' + left + ', location=no, menubar=no, resizable=yes, scrollbars=yes, status=no, titlebar=no, toolbar=no');
    popup.focus();
}

// VALIDATE
function validateWorkFlow(process_id) {

    var url = 'index.php?module=asol_Process&action=validate_button&uid=' + process_id;
    document.location = url;
}

function validateWorkFlows() {

    sugarListView.get_checks();
    var processes_string = document.MassUpdate.uid.value;

    if (processes_string == '') {
        alert(SUGAR.language.get('asol_Process', 'LBL_VALIDATE_WORKFLOWS_PLEASE'));
        return;
    }

    var url = 'index.php?module=asol_Process&action=validate_button&uid=' + processes_string;
    document.location = url;
}

// ACTIVATE
function activateWorkFlows() {

    sugarListView.get_checks();
    var processes_string = document.MassUpdate.uid.value;

    if (processes_string == '') {
        alert(SUGAR.language.get('asol_Process', 'LBL_ACTIVATE_WORKFLOWS_PLEASE'));
        return;
    } else {
        /*
         if (!confirm(SUGAR.language.get('asol_Process', 'LBL_ACTIVATE_WORKFLOWS_WARNING'))) {
         return;
         }
         */
    }

    var url = 'index.php?module=asol_Process&action=activate_workflows&uid=' + processes_string;
    wfm_get_request(url);
}

function activateWorkFlow(process_id) {

    /*
     if (!confirm(SUGAR.language.get('asol_Process', 'LBL_ACTIVATE_WORKFLOW_WARNING'))) {
     return;
     }
     */

    var url = 'index.php?module=asol_Process&action=activate_workflows&uid=' + process_id;
    wfm_get_request(url);
}

// INACTIVATE
function inactivateWorkFlows() {

    sugarListView.get_checks();
    var processes_string = document.MassUpdate.uid.value;

    if (processes_string == '') {
        alert(SUGAR.language.get('asol_Process', 'LBL_INACTIVATE_WORKFLOWS_PLEASE'));
        return;
    } else {
        /*
         if (!confirm(SUGAR.language.get('asol_Process', 'LBL_INACTIVATE_WORKFLOWS_WARNING'))) {
         return;
         }
         */
    }

    var url = 'index.php?module=asol_Process&action=inactivate_workflows&uid=' + processes_string;
    wfm_get_request(url);
}

function inactivateWorkFlow(process_id) {

    /*
     if (!confirm(SUGAR.language.get('asol_Process', 'LBL_INACTIVATE_WORKFLOW_WARNING'))) {
     return;
     }
     */
    var url = 'index.php?module=asol_Process&action=inactivate_workflows&uid=' + process_id;
    wfm_get_request(url);
}

// DELETE
function deleteWorkFlows() {

    sugarListView.get_checks();
    var processes_string = document.MassUpdate.uid.value;

    if (processes_string == '') {
        alert(SUGAR.language.get('asol_Process', 'LBL_DELETE_WORKFLOWS_PLEASE'));
        return;
    } else {
        if (!confirm(SUGAR.language.get('asol_Process', 'LBL_DELETE_WORKFLOWS_WARNING'))) {
            return;
        }
    }

    var url = 'index.php?module=asol_Process&action=delete_workflows&uid=' + processes_string;
    wfm_get_request(url);
}

function deleteWorkFlow(process_id) {

    if (!confirm(SUGAR.language.get('asol_Process', 'LBL_DELETE_WORKFLOW_WARNING'))) {
        return;
    }

    var url = 'index.php?module=asol_Process&action=delete_workflows&uid=' + process_id;
    wfm_get_request(url);
}

// EXPORT
function exportWorkFlows() {
    return sugarcrm_export();
}

function exportWorkFlow(process_id) {
    return wfm_send_form(process_id, true, 'asol_Process', 'index.php?entryPoint=wfm_export_workflows');
}

function sugarcrm_export() {
    return sListView.send_form(true, 'asol_Process', 'index.php?entryPoint=wfm_export_workflows', SUGAR.language.get('asol_Process', 'LBL_EXPORT_WORKFLOWS_PLEASE'));
}

// IMPORT
function importWorkFlow(process_id) {

    /*
     if (!confirm(SUGAR.language.get('asol_Process', 'LBL_IMPORT_WORKFLOW_WARNING'))) {
     return;
     }
     */

    var url = 'index.php?module=asol_Process&action=import_button.standard.in_context&uid=' + process_id;
    document.location = url;
}

function importWorkFlowsBasic() {

    var url = 'index.php?module=asol_Process&action=import_button.standard.without_context';
    document.location = url;
}

function importWorkFlowsAdvanced() {

    var url = 'index.php?module=asol_Process&action=import_button.advanced';
    document.location = url;
}

function wfm_send_form(process_ids, select, currentModule, action, no_record_txt, action_module, return_info) {

    // create new form to post (can't access action property of MassUpdate form due to action input)
    var newForm = document.createElement('form');
    newForm.method = 'post';
    newForm.action = action;
    newForm.name = 'newForm';
    newForm.id = 'newForm';
    var uidTa = document.createElement('textarea');
    uidTa.name = 'uid';
    uidTa.style.display = 'none';
    uidTa.value = process_ids;

    if (uidTa.value == '') {
        alert(no_record_txt);
        return false;
    }

    newForm.appendChild(uidTa);

    var moduleInput = document.createElement('input');
    moduleInput.name = 'module';
    moduleInput.type = 'hidden';
    moduleInput.value = currentModule;
    newForm.appendChild(moduleInput);

    var actionInput = document.createElement('input');
    actionInput.name = 'action';
    actionInput.type = 'hidden';
    actionInput.value = 'index';
    newForm.appendChild(actionInput);

    if ( typeof action_module != 'undefined' && action_module != '') {
        var actionModule = document.createElement('input');
        actionModule.name = 'action_module';
        actionModule.type = 'hidden';
        actionModule.value = action_module;
        newForm.appendChild(actionModule);
    }
    //return_info must follow this pattern."&return_module=Accounts&return_action=index"
    if ( typeof return_info != 'undefined' && return_info != '') {
        var params = return_info.split('&');
        if (params.length > 0) {
            for (var i = 0; i < params.length; i++) {
                if (params[i].length > 0) {
                    var param_nv = params[i].split('=');
                    if (param_nv.length == 2) {
                        returnModule = document.createElement('input');
                        returnModule.name = param_nv[0];
                        returnModule.type = 'hidden';
                        returnModule.value = param_nv[1];
                        newForm.appendChild(returnModule);
                    }
                }
            }
        }
    }

    document.MassUpdate.parentNode.appendChild(newForm);

    newForm.submit();

    return false;
}

function wfm_get_request(url) {
    $.get(url, function(data) {
        // $( ".result" ).html( data );
        //alert( "Load was performed." );
        location.reload();
    });
}

