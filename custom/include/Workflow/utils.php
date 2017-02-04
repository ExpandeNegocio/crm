<?php
function wf_getNewStatuses($focus = null, $name = null, $value = null, $view = null) {
    global $current_user;
    require_once('custom/include/Workflow/Statuses.php');
//sugar_die('23 ' . $focus->module_name . ', ' . $focus->wf_type);
    $wf = new WF_Statuses ($focus->module_name, $focus->wf_type);
    $statusField = $wf->getStatusField();
    $status = $focus->$statusField;
    $allStatuses = $wf->getAllStatuses();
    if (isset($allStatuses[$status])) $s = array ($status => $allStatuses[$status]);
    else $s = array ($status => $status);

    if ($view == 'EditView') $res = $wf->getNewStatuses($status, $current_user->id);
    else $res = $allStatuses;

    if (!empty($focus->id)) $res = array_merge ($s, $res);
    return $res;
}

function wf_getModulesList($focus = null, $name = null, $value = null, $view = null) {
  return array ('Opportunities' => 'Заявки');
}

function wf_getTypes($focus = null, $name = null, $value = null, $view = null) {
  return array ('default' => 'Обычный');
}

// FIXME надо в форме фильтровать по выбранному модулю!!!
function wf_getRoles($focus = null, $name = null, $value = null, $view = null) {
  require_once('custom/include/Workflow/Statuses.php');
  $res = array ();
  $modules = wf_getModulesList();
  foreach ($modules as $module => $l) {
    // FIXME: пока только default схема, а надо смотреть, какие каталоги существуют в custom/modules/$v/workflow
    $type = 'default';
    $wf = new WF_Statuses ($module, $type);
    $res = array_merge ($res, $wf->getAllRoles ());
  }
  return $res;
}
 

?>
