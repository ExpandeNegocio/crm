<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    require_once ('include/MVC/View/views/view.list.php');
    class Expan_GestionSolicitudesViewList extends ViewList {
        function Expan_GestionSolicitudesViewList() {
            parent::__construct();
        }
    
        function preDisplay() {
            parent::preDisplay();
        }
    
        function display() {
            parent::Display();
            echo '<script type="text/javascript"  src="include/javascript/EditGestionSolicitud.js"></script>';
            echo '<script type="text/javascript"> ModPaginaLista();</script>';
        }
    
    }
?>