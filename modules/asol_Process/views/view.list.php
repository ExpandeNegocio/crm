<?php

require_once('include/MVC/View/views/view.list.php');

class asol_ProcessViewList extends ViewList {

	function asol_ProcessViewList(){
		parent::ViewList();
	}

	function listViewProcess(){
		global $mod_strings, $current_user;

		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;

		if(!$this->headers)
		return;
		if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
			$this->lv->ss->assign("SEARCH",true);
			$this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
			echo $this->lv->display();

			// BUTTONS
			require_once('modules/asol_Process/views/javascript.php');
			require_once('modules/asol_Process/views/wfm_action_buttons.php');
		}
	}

	function Display()
	{
		$this->lv->export = true;
		$this->lv->showMassupdateFields = false;
		parent::Display();
	}

}
//return sListView.send_form(true, 'asol_Process', 'index.php?entryPoint=export','Please select at least 1 record to proceed.')
?>

