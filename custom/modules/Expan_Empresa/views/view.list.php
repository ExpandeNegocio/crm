<?php 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 

require_once('include/MVC/View/views/view.list.php'); 

class Expan_EmpresaViewList extends ViewList { 

     function Expan_EmpresaViewList() 
     { 
        parent::ViewList(); 
     } 

     function listViewProcess() 
     { 

        $this->processSearchForm(); 

        global $current_user;

       $GLOBALS['log'] -> info('[ExpandeNegocio][ViewList Empresa]$current_user->trust_user-' . $current_user->trust_user);

        if ($current_user->trust_user!=1){
            
            $consulta=' chk_es_cliente_potencial=0';
            
            if( $this-> where == "" ) 
            { 
                $this->where .= $consulta;
                } 
            else 
            { 
               $this->where .= " AND" . $consulta;
            } 
 
        }
         
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