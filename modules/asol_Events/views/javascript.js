
// FORCE_EXECUTE_EVENT
function forceExecuteEvents() {

    sugarListView.get_checks();
    var events_string = document.MassUpdate.uid.value;

    if (events_string == '') {
        alert(SUGAR.language.get('asol_Events', 'LBL_FORCE_EXECUTE_EVENTS_PLEASE'));
        return;
    } 

    var url = 'index.php?module=asol_Process&action=scheduledTask&uid=' + events_string;
    document.location = url;
}

function forceExecuteEvent(event_id) {

    var url = 'index.php?module=asol_Process&action=scheduledTask&uid=' + event_id;
    document.location = url;
}