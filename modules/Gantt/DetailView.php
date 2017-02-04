<?php
require_once('Gantt.php');
$gantt = new Gantt();
if(!empty($_REQUEST['project_id'])) {
    if(!empty($_REQUEST['zoom']) && is_numeric($_REQUEST['zoom'])) {
        $gantt->zoom = $_REQUEST['zoom'];
    }
    if(!empty($_REQUEST['date'])) {
        $gantt->date = $_REQUEST['date'];
    }
    $gantt->Draw($_REQUEST['project_id']);
}
