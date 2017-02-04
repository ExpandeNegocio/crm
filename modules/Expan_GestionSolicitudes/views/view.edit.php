<?php 

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 
    
    require_once('include/MVC/View/views/view.edit.php'); 
    
    
    class Expan_GestionSolicitudesViewEdit extends ViewEdit {
        
         function Expan_GestionSolicitudesViewEdit() 
         { 
            $this->options["show_subpanels"] = true;                                    
            parent::ViewEdit();  
         } 
         
         function display(){
             
             parent::display();           
             
            echo "
            <script language=\"javascript\">
            window.onload=function() 
            {          
                $('#activities_nuevatarea_button').hide();
                $('#activities_programarreunión_button').hide();
                $('#activities_registrarllamada_button').hide();
            }
            </script>";
         }
    }   

?>