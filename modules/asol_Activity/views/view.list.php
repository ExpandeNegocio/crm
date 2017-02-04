<?php
require_once('include/MVC/View/views/view.list.php');
class asol_ActivityViewList extends ViewList {
	function asol_ActivityViewList(){
		parent::ViewList();
	}
	function Display()
	{
		$this->lv->export = true;
		$this->lv->showMassupdateFields = false;
		parent::Display();
	}
}
?>

