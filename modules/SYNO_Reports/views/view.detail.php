<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class SYNO_ReportsViewDetail extends ViewDetail {

 	function SYNO_ReportsViewDetail(){
 		parent::ViewDetail();
 	}

    function preDisplay(){
        parent::preDisplay();
        $this->options['show_subpanels'] = false;
    } 	

    function display() {
        $this->ss->assign('SQL_HEADER',     (!empty($this->bean->synoReportsData['SQL_HEADER']) ? $this->bean->synoReportsData['SQL_HEADER'] : array()));
        $this->ss->assign('SQL_RESULT',     (!empty($this->bean->synoReportsData['SQL_RESULT']) ? $this->bean->synoReportsData['SQL_RESULT'] : array()));

        $this->ss->assign('SQL_HEADER_MATRICE',     (!empty($this->bean->synoReportsData['SQL_HEADER_MATRICE']) ? $this->bean->synoReportsData['SQL_HEADER_MATRICE'] : array()));
        $this->ss->assign('SQL_RESULT_MATRICE',     (!empty($this->bean->synoReportsData['SQL_RESULT_MATRICE']) ? $this->bean->synoReportsData['SQL_RESULT_MATRICE'] : array()));
        $this->ss->assign('MATRICE_OK', (!empty($this->bean->synoReportsData['MATRICE_OK']) ? $this->bean->synoReportsData['MATRICE_OK'] : 0));


        parent::display();
    }
}
?>
