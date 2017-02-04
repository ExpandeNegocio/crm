<?php

  require_once ("custom/include/Logic/Logic.php");
  require_once ("custom/include/Logic/GetJavascript.php");

// FIXME: полагаемся, что одновременно подключили и GetJavascript из logic,
// FIXME: поэтому эта функция уже определена. 
// FIXME: а надо ее в utils.php вынести
/*
  function array_flat ($as) {
    return array_reduce ($as, 'array_merge', array ());
  }
*/

function getJavascriptWorkflow ($module, $form, &$focus) {
    global $current_user;

    require_once ('custom/include/Workflow/Statuses.php');
    $wf = new WF_Statuses ($module, $focus->wf_type);
    $statusField = $wf->getStatusField();
    $s1 = $focus->$statusField;

    $statuses = $wf->getNewStatuses ($s1, $current_user->id);

    $logic = array ();
    $statusId = "wf_status"; // FIXME: только чтобы в модулях такой параметр не завели сами

    $logic = array_filter (
               array_map (function ($s2) use (&$wf, $s1, $statusId, $statusField) {
                   return
                   array_map (function ($e) use ($s2, $statusId, $statusField) {
                       $e['expr'] = Expr::ORop (
                                        Expr::NOTop(Expr::EQ(Expr::constantQ($s2), Expr::variableQ($statusId))),
                                        $e['expr']);
                       $e['params'][] = array ('name' => $statusId, 'field' => $statusField);
                       return $e;
                   }, array_filter ($wf->getLogicForEvent ($s1, $s2), function ($i) { return $i['type'] == 'check'; }));


               }, array_keys($statuses)),
               
               function ($i) { return count($i) > 0; });

    $logic = array_flat ($logic);

    if (count($logic) > 0) $res = getJavascript0 ($module, $form, $focus, $logic);

    return $res;
}

// FIXME: полагаемся, что одновременно подключили и GetJavascript из logic,
// FIXME: поэтому эта функция уже определена. 
// FIXME: а надо ее в utils.php вынести
/*
function array_any ($a) {
  return array_reduce ($a, function ($res, $v) { return $res || $v; }, false);
}
*/
