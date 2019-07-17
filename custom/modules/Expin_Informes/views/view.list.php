<?php 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 

require_once('include/MVC/View/views/view.list.php'); 
require_once("modules/ACLRoles/ACLRole.php"); 

class Expin_InformesViewList extends ViewList { 

     function Expin_InformesViewList() 
     { 
        parent::ViewList(); 
     } 

     function listViewProcess() 
     {       

        $this->processSearchForm(); 

        global $current_user;
         
        $acl_role_obj = new ACLRole(); 
        $user_roles = $acl_role_obj->getUserRolesid($current_user->id);                            
                        
        if( $this-> where != "" )         
        { 
           $this->where .= " AND ";
        } 
        
         $this->where .= "id in (select id_informe from expan_informes_rol where id_rol='".$user_roles[0]."' )  ";
         
        $this->lv->searchColumns = $this->searchForm->searchColumns; 
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) 
        { 
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params); 
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']); 
            echo get_form_header($GLOBALS['mod_strings']['LBL_LIST_FORM_TITLE'] . $savedSearchName, '', false); 
            echo $this->lv->display(); 
        }     
    
     } 

    function display() {
        $this->lv->export = false;
        $this->lv->mergeduplicates=false;
        parent::Display();
       
    }

} 

?>