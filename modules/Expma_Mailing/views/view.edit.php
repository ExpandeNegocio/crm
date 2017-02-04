<?php 

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 
    
    require_once('include/MVC/View/views/view.edit.php'); 
    
    
    class Expma_MailingViewEdit extends ViewEdit {
        
         function Expma_MailingViewEdit() 
         { 
            $this->options["show_subpanels"] = true;  
                parent::ViewEdit();  
         } 
    }   

?>