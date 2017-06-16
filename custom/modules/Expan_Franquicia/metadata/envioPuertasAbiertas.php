<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][envioPuertasAbiertas]Inicio envío puertas abiertas');
    
    $franquicia = $_POST['idFran'];
    
    $GLOBALS['log']->info('[ExpandeNegocio][envioPuertasAbiertas]franquicia-'.$franquicia);
    $db = DBManagerFactory::getInstance();
    
    $query = "select g.id as idG, s.id as idS from expan_solicitud s, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query." where s.id=gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida and ";
    $query=$query." gs.expan_soli5dcccitudes_idb=g.id and g.franquicia='".$franquicia."' "; 
    $query=$query." and g.estado_sol='2' and s.check_puertas_abiertas=1 and s.deleted=0 and g.deleted=0 and gs.deleted=0;";
    
    $resultSol = $db->query($query, true);    //tengo los ids de las gestiones de la franquicia seleccionada, que tienen interes de puertas
     
     $salida='';
     
    while ($rowSol = $db->fetchByAssoc($resultSol)){
        
        $idGest=$rowSol["idG"];
        $idSol=$rowSol["idS"];
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($idGest);
        
        $gestion -> creaLlamada("[AUT]Puertas abiertas", "PAbiertas");
        
        $salida = $gestion -> preparaCorreo("C6");//Este correo será el envío de puertas abiertas, habrá que hacer la plantilla
        // if($salida=='Ok'){
            //desactivar check
            $query="update expan_solicitud s set s.check_puertas_abiertas=0 where id='".$idSol."';";
            $result = $db -> query($query);
       // }
        
    }    
    
    echo $salida;
?>