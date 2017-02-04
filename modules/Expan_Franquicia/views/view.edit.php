<?php 

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 
    
    require_once('include/MVC/View/views/view.edit.php'); 
    
    
    class Expan_FranquiciaViewEdit extends ViewEdit {
        
         function Expan_FranquiciaViewEdit() 
         { 
            $this->options["show_subpanels"] = true;                                    
            parent::ViewEdit();  
         } 
         
         function display(){
             
             parent::display();           
            
         }
    }   

?>