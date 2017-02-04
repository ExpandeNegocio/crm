<?php
require_once('include/MVC/View/views/view.list.php');
class asol_EventsViewList extends ViewList {

	function asol_EventsViewList(){
		parent::ViewList();
	}

	function listViewProcess(){
		global $mod_strings;

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
			require_once('modules/asol_Events/views/javascript.php');

			// Force Execute Events
			echo '
				<span style="white-space:nowrap;">
				     <a onClick="forceExecuteEvents();" style="cursor: pointer;">
						<img border="0" align="absmiddle" alt="'.$mod_strings['LBL_FORCE_EXECUTE_EVENTS_BUTTON'].'" src="modules/asol_Process/___common_WFM/images/force_execute_event.png">
						<span>'.$mod_strings['LBL_FORCE_EXECUTE_EVENTS_BUTTON'].'</span>
					 </a>
				</span>
			';
		}
	}

	function Display()
	{
		$this->lv->export = true;
		$this->lv->showMassupdateFields = false;
		parent::Display();
	}
}
?>

