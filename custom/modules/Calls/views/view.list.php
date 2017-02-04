<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/MVC/View/views/view.list.php');
    class CallsViewList extends ViewList
    {
        function CallsViewList ()
        {
            parent::__construct();
        }
        function preDisplay()
        {         
            parent::preDisplay();
        }
        
        function display()
        {
            parent::Display();
            echo '<script type="text/javascript"  src="include/javascript/EditLlamadas.js"></script>';
            echo '<script type="text/javascript"> ModPaginaLista();</script>';
        }
        
    }
?>