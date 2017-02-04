<?php 

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 
    
    require_once('include/MVC/View/views/view.edit.php'); 
    
    
    class Expan_SolicitudViewEdit extends ViewEdit {
        
         function Expan_SolicitudViewEdit() 
         { 
            $this->options["show_subpanels"] = true;  
                parent::ViewEdit();  
         } 
    }   

?>