<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class zr2_ReportParameterViewEdit extends ViewEdit
{
 	public function __construct()
 	{
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
	
	function preDisplay()
	{	
		//disables the sugar cache, as edit form is built up dynamically
		$GLOBALS['sugar_config']['developerMode']=1;
		parent::preDisplay();
	}
	
 	public function display()
 	{
        $this->ev->process();

		$range_name = $this->bean->range_name;
		$range_options = $this->bean->range_options;
		
		if (!empty($_REQUEST['range_name'])) {
			$range_name = $_REQUEST['range_name'];
		}
		if (!empty($_REQUEST['range_options'])) {
			$range_options = $_REQUEST['range_options'];
		}
        $this->ev->fieldDefs['range_name']['value'] = $range_name;
		
		if ($range_name == 'SQL') {
			if ($_REQUEST['sqltest'] == 'true') {
				if (is_admin($GLOBALS['current_user'])) {
					$table = $this->bean->get_sql_table(html_entity_decode($range_options), 20);		
					if (is_array($table)) {			
						$text = "<table border='1'><tr><th>KEY</th><th>VALUE</th></tr>";			
						foreach ($table as $key => $value) {				
							$text .= "<tr  border='1'><td border='1'>".$key."</td><td  border='1'>".$value."</td></tr>";			
						}			
						$text .= "</table>";		
					} else {			
						$text = $table;		
					}
				} else {
					$text = "only admin allowed";
				}
				$this->ss->assign('SQL_RESULT', $text);	
			}
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_LIST']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_DROPDOWN']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT_DISABLED']);
		}
		else if ($range_name == 'LIST')
		{
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SQL']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_DROPDOWN']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT_DISABLED']);
		}
		else if ($range_name == 'DROPDOWN')
		{
			global $app_list_strings;
			
			$options = array();
			foreach (array_keys($app_list_strings) as $app_list_key) {
				$options[$app_list_key] = $app_list_key;
			}
			asort($options);
			$this->ss->assign("DROPDOWN_OPTIONS", $options);

			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_LIST']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SQL']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT_DISABLED']);
		}
		else if ($range_name == 'SCRIPT')
		{
			require_once('modules/Administration/Administration.php');
			$admin = new Administration();
			$admin->retrieveSettings();
		
			if ($admin->settings['zuckerreports2_script_enabled'] != "yes")
			{
				unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT']);
			} 
			else 
			{
				unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT_DISABLED']);
			}
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SQL']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_LIST']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_DROPDOWN']);
		}
		else 
		{
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SQL']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_LIST']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_DROPDOWN']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT']);
			unset($this->ev->sectionPanels['LBL_PARAM_PANEL_SCRIPT_DISABLED']);
		}
		
		echo $this->ev->display($this->showTitle);
 	}
}
?>
