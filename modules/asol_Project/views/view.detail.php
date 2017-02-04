<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class asol_ProjectViewDetail extends ViewDetail
{

	function asol_ProjectViewDetail()
	{
		parent::ViewDetail();
	}

	function _displaySubPanels(){

		require_once('include/SubPanel/SubPanelTiles.php');

		$subpanel = new SubPanelTiles($this->bean, $this->module);

		// Subpanels are not cached
		unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['asol_project_asol_projecttask']);

		echo $subpanel->display();
	}

//	function display() {
//
//		// Panels are cached
//		TemplateHandler::clearCache($this->module,'DetailView.tpl');
//
//		// Remove panel
//		//unset($this->dv->defs['panels']['lbl_detailview_panel1']);
//
//		// Remove fields
//		$GLOBALS['log']->fatal(print_r($this->dv->defs, true));
//
//		$removing_fields = Array(
//			'name',
//			'description',
//			'date_start',
//		);
//
//		//remove_fields($this->dv->defs['panels'], 'default', $removing_fields);
//		
//		$GLOBALS['log']->fatal(print_r($this->dv->defs, true));
//
//
//		$this->dv->process();
//		echo $this->dv->display();
//	}

}

// Remove fields
function remove_fields(&$whole, $pnl, $removing_fields) {

	$panels = array();

	if (gettype($pnl) == 'string') {
		$panels[] = $pnl;
	} else if (gettype($pnl) == 'array') {
		$panels = array();
		$panels = array_merge($panels, $pnl);
	} else {
		return false;
	}

	/* Process the panels along with the respective fields */
	$arr_inverted = array();
	foreach ($panels as $panel) {

		/* Remove field arrays. Since, we know there are only two levels. */
		foreach ($whole[$panel] as $k => $v) {

			foreach ($v as $key => $value) {
				if (in_array($value['name'], $removing_fields)) {
					//unset($whole[$panel][$k][$key]);
					$whole[$panel][$k][$key] = '';
				}

				if (empty($value)) {
					//unset($whole[$panel][$k][$key]);
					$whole[$panel][$k][$key] = '';
				}
			} /* End of For...loop $key */
		} /* End of For...loop $k */
	} /* End of For...loop $panel */

	return true;
}



