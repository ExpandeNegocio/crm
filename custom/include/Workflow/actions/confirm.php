<?php
require_once ('custom/include/Workflow/Statuses.php');


global $beanList, $current_user;


$wf = new WF_Statuses ($_POST['module'], $_POST['wf_type']);
$statusField = $wf->getStatusField();
$obj = new $beanList[$_POST['module']]();

$obj->retrieve($_POST['record']);
if (empty($obj->id)) sugar_die ("Запись не найдена");

$ca = $wf->getConfirmActionForEvent ($obj->$statusField, $_POST['status']);

$obj->$statusField = $_POST['status'];
if (isset($_POST['executer'])) $obj->assigned_user_id = $_POST['executer'];
$obj->save(true); 

$url = "index.php?action={$_POST['return_action']}&module={$_POST['return_module']}&record={$_POST['return_record']}";
if (isset($ca['url_transform'])) $url = $ca['url_transform']($url);

header("Location: $url");
?>
