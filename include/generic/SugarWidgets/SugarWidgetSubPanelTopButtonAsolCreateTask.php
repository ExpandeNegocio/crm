<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/generic/SugarWidgets/SugarWidgetSubPanelTopButton.php');

class SugarWidgetSubPanelTopButtonAsolCreateTask extends SugarWidgetSubPanelTopButton {

	
    function display(&$widget_data) {
        global $app_strings;

        $button = '<form id="CreateStartEventForm" name="CreateStartEventForm" action="index.php" method="post">
						<input type="hidden" name="module" value="asol_Task">
						<input type="hidden" name="action" value="EditView">
						<input type="hidden" name="return_module" value="'.$_REQUEST['module'].'">
						<input type="hidden" name="return_action" value="'.$_REQUEST['action'].'">
						<input type="hidden" name="return_id" value="'.$_REQUEST['record'].'">
						<input type="hidden" name="return_relationship" value="asol_activity_asol_task">
						
						<input type="submit" name="CreateTask" id="CreateTask" class="button" title="Create" value="Create"/>
				</form>';
       
	   return $button;

    } 
	
}
?>