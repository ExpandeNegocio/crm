<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] LLega1');         
    
    $tag = $_POST['tags'];
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] LLega2');
        
    $tablaTag =$_POST['tipoTag'];
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] LLega3');
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] Tag-'.$tag);
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] tipoTag-'.$tablaTag);
    
    $db = DBManagerFactory::getInstance();
    
    $query = "SELECT tag FROM ".$tablaTag." WHERE tag LIKE '%".$tag."%'";
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] Consulta-'.$query);
    
    
    $resultSol = $db->query($query, true);
            
    while ($rowSol = $db->fetchByAssoc($resultSol)){                      
        echo '<div class="sug" class="ui-menu-item" style="margin-left:5px; margin-top:5px; cursor:pointer;"><a>'.$rowSol["tag"].'</a></div>';
    }
?>