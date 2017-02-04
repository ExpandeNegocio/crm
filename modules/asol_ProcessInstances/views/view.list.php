<?php
require_once('include/MVC/View/views/view.list.php');
class asol_ProcessInstancesViewList extends ViewList
{
	function asol_ProcessInstancesViewList()
	{
		parent::ViewList();
	}
	function Display()
	{
		$this->lv->quickViewLinks = false;
		$this->lv->export = false;
		$this->lv->showMassupdateFields = false;
		parent::Display();
	}
}
?>