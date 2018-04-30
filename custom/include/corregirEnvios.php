<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');

    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Inicio');
    
    $db = DBManagerFactory::getInstance();
    
    $query = "SELECT * FROM   expan_gestionsolicitudes ";
    $query=$query."WHERE  estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." ";
    $query=$query."AND deleted=0 ";
    $query=$query."AND envio_documentacion is null ";
    $query=$query."AND date_entered > STR_TO_DATE('20-06-2017', '%d-%m-%Y')";
   
   
    $result = $db -> query($query, true);    
    
    //Recorremos los usuarios
    while ($row = $db -> fetchByAssoc($result)) {
        
        echo "Inicio Procesado Gestion - ". $row['id']."<br>"; 
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Creamos una llamada 1');
                  
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($row['id']);        
        
        $gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO;
        $gestion->ignore_update_c=true;
        $gestion->save();
                  
        $gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_EN_CURSO;
        $gestion->ignore_update_c=false;
        $gestion->save();

        echo "Finalizo Procesado Gestion - ". $row['id']."<br>";
    }

    $GLOBALS['log'] -> info('[ExpandeNegocio][Corregir Llamadas]Fin');
    
    echo 'Fnalizado';
   
?>