<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    require_once ('include/MVC/View/views/view.list.php');
    class Expan_SolicitudViewList extends ViewList {
        function Expan_SolicitudViewList() {
            parent::__construct();
        }
    
        function preDisplay() {
            parent::preDisplay();
        }
    
        function display() {
            $this->lv->export = false;
            $this->lv->mergeduplicates=false;
            parent::Display();
        }
    
    }
?>