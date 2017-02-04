<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/MVC/View/views/view.list.php');
    class MeetingsViewList extends ViewList
    {
        function MeetingsViewList ()
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
            echo '<script type="text/javascript"  src="include/javascript/EditReuniones.js"></script>';
            echo '<script type="text/javascript"> OcultarCreacionListado();</script>';
        }
        
    }
?>