<?php

require_once('include/MVC/View/views/view.list.php');

class asol_ProjectVersionViewList extends ViewList {

	public function preDisplay() {
		
		parent::preDisplay();
		
		$this->lv->quickViewLinks = false;
		$this->lv->export = false;
		$this->lv->mergeduplicates = false;
		$this->lv->showMassupdateFields = false;
		$this->lv->delete = false;
	}

}

?>

