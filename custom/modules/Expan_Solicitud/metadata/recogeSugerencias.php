<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][recogeSugerencias]Recoge sugerencias AJAX');
    
    $fran = $_POST['franquicias'];
    $GLOBALS['log']->info('[ExpandeNegocio][recogeSugerencias]franquicias-'.$fran);
    $db = DBManagerFactory::getInstance();
    
    $query = "SELECT id, name FROM expan_franquicia WHERE name LIKE '".$fran."%' and deleted=0 ORDER BY name";
    
    $resultSol = $db->query($query, true);
            
    while ($rowSol = $db->fetchByAssoc($resultSol)){
        
        
        $GLOBALS['log']->info('[ExpandeNegocio][recogeSolicitud]solicitud-'.$rowSol["name"]);
        echo '<div class="sug" class="ui-menu-item" style="margin-left:5px; margin-top:5px; cursor:pointer;"><a>'.$rowSol["name"].'</a></div>';
    }
    
        
?>