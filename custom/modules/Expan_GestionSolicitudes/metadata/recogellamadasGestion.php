<?php
    if (!defined('sugarEntry') || !sugarEntry)
        die('Not A Valid Entry Point');
    
    require_once ('data/SugarBean.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][regogellamadasGestion]Recoge llamadas desde Gestion AJAX');
    
    $gestionid = $_GET['gestionid'];
    $GLOBALS['log'] -> info('[ExpandeNegocio][regogellamadasGestion]idGestion-' . $gestionid);
    
    $gestion = new Expan_GestionSolicitudes();    
    $gestion -> retrieve($gestionid);
    
    $gestion -> load_relationship('expan_gestionsolicitudes_calls_1');
    
    $compLlamadas = '';
    
    foreach ($gestion->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {
        $GLOBALS['log'] -> info('[ExpandeNegocio][regogellamadasGestion]idLlamada-' . $llamada -> id."-estado-".$llamada->status);
        if ($llamada->status=="Planned"){
            $compLlamadas = $llamada -> id . "#";
        }
    }
    
    echo $compLlamadas;
?>