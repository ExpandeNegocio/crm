<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('include/SugarPHPMailer.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Inicio');
    
    $db = DBManagerFactory::getInstance();
    
    $query = "select * from sin_llamadas;";
   
    $result = $db -> query($query, true);    
    
    //Recorremos los usuarios
    while ($row = $db -> fetchByAssoc($result)) {
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Creamos una llamada 1');
                  
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($row['id']);        
                  
        $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Creamos una llamada 2');                  
                  
        $gestion->creaLlamada('[AUT]Primera llamada', 'Primera');      

    }

    $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Fin');
    
    echo 'Fnalizado';
   
?>