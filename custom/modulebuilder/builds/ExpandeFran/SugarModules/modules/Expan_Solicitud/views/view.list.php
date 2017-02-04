<?php 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 

require_once('include/MVC/View/views/view.list.php'); 

class Expan_SolicitudViewList extends ViewList { 

     function Expan_SolicitudViewList() 
     { 
        parent::ViewList(); 
     } 

     function listViewProcess() 
     { 

     	echo "------------------------------ESTAMOS EN PRUEBAS ---------------- DISCULPEN LAS MOLESTIAS---------------";

        $this->processSearchForm(); 


        echo "Where-".$this->where;
        ECHO "<br/>";
        ECHO "<br/>";
         
                 if( $this-> where == "" ) 
                 { 
                         $this->where .= "  salutation = 'Mr.'"; 
                 } 
                 else 
                 { 
                        $this->where .= " and salutation = 'Mr.'"; 
                } 
         

		echo "Where-".$this->where;


        $this->lv->searchColumns = $this->searchForm->searchColumns; 
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) 
        { 
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params); 
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']); 
            echo get_form_header($GLOBALS['mod_strings']['LBL_LIST_FORM_TITLE'] . $savedSearchName, '', false); 
            echo $this->lv->display(); 
        } 
     } 
} 

?>