<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][recogeSolicitud]Recoge solicitud desde Gestion AJAX');
    
    $gestion = $_GET['gestion'];
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogeSolicitud]gestion-'.$gestion);
    $db = DBManagerFactory::getInstance();
    
    $query = "SELECT s.id ";
    $query=$query."FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
    $query=$query."g.id='".$gestion."'";
    
    
    
    $resultSol = $db->query($query, true);        
    while ($rowSol = $db->fetchByAssoc($resultSol)){
        
        $GLOBALS['log']->info('[ExpandeNegocio][recogeSolicitud]solicitud-'.$rowSol["id"]);
        echo $rowSol["id"];
        return;
    }    
    
?>