<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class asol_ProjectVersionViewEdit extends ViewEdit{
 	function asol_ProjectVersionViewEdit(){
 		parent::ViewEdit();
 	}
 	function display(){
		if (isset($this->bean->id)) {
			$this->ss->assign("FILE_OR_HIDDEN", "hidden");
			if (empty($_REQUEST['isDuplicate']) || $_REQUEST['isDuplicate'] == 'false') {
				$this->ss->assign("DISABLED", "disabled");
			}
		} else {
			$this->ss->assign("FILE_OR_HIDDEN", "file");
		}
		parent::display();
 	}
}

?>