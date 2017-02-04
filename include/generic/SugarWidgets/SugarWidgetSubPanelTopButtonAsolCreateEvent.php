<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/generic/SugarWidgets/SugarWidgetSubPanelTopButton.php');

class SugarWidgetSubPanelTopButtonAsolCreateEvent extends SugarWidgetSubPanelTopButton {

	
    function display(&$widget_data) {
        global $app_strings;

        $button = '<form id="CreateStartEventForm" name="CreateStartEventForm" action="index.php" method="post">
						<input type="hidden" name="module" value="asol_Events">
						<input type="hidden" name="action" value="EditView">
						<input type="hidden" name="return_module" value="'.$_REQUEST['module'].'">
						<input type="hidden" name="return_action" value="'.$_REQUEST['action'].'">
						<input type="hidden" name="return_id" value="'.$_REQUEST['record'].'">
						<input type="hidden" name="return_relationship" value="asol_process_asol_events">
						
						<input type="submit" name="CreateStartEvent" id="CreateStartEvent" class="button" title="Create" value="Create"/>
				</form>';
       
	   return $button;

    } 
	
}
?>