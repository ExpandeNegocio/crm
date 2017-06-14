<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Pruebas');
    
    define('TIEMPO_REENVIO_C14_INI',10); 
    define('TIEMPO_REENVIO_C14_MED',15);   
    define('TIEMPO_REENVIO_C14_FIN',30); 
    define('TIEMPO_PASO_ESTADO_3',60);
    
    $db = DBManagerFactory::getInstance();
    
    //Cuando una gestion tiene mas de 60 días, esta en estad 2, y no tiene ninguna llamada/terea por realizar asociada
    //se pasa a estado 3
    
    $query = "UPDATE expan_gestionsolicitudes g ";
    $query = $query . "       INNER JOIN ";
    $query = $query . "       (SELECT id ";
    $query = $query . "        FROM   expan_gestionsolicitudes ";
    $query = $query . "        WHERE  deleted = 0 AND estado_sol = '".Expan_GestionSolicitudes::ESTADO_EN_CURSO."' AND chk_recepcio_cuestionario = 0 AND chk_informacion_adicional =0 ";
    $query = $query . "                           AND chk_entrevista =0 AND chk_envio_precontrato=0 AND chk_visita_local=0 AND chk_envio_contrato=0 AND chk_visita_central=0  AND  TIMESTAMPDIFF(DAY, DATE(date_modified), CURDATE()) ";
    $query = $query . "               > ".TIEMPO_PASO_ESTADO_3." AND id NOT IN (SELECT parent_id ";
    $query = $query . "                                   FROM   calls ";
    $query = $query . "                                   WHERE  STATUS = 'planned' AND parent_type = 'Expan_GestionSolicitudes' AND deleted=0) AND id NOT IN (SELECT parent_id ";
    $query = $query . "                                                                                                                          FROM ";
    $query = $query . "               tasks ";
    $query = $query . "                                                                                                                          WHERE ";
    $query = $query . "               STATUS = 'Not Started' AND parent_type = 'Expan_GestionSolicitudes' AND deleted=0)) c ";
    $query = $query . "         ON c.id = g.id ";
    $query = $query . "SET    estado_sol = '".Expan_GestionSolicitudes::ESTADO_PARADO."',motivo_parada='".Expan_GestionSolicitudes::PARADA_POR_PROTOCOLO."', candidatura_caliente = 0; ";
    
    $result = $db -> query($query);
    
    
    /*Actualizamos la candidatura caliente de las Solicitudes*/
    $query = "UPDATE ";
    $query=$query."  expan_solicitud ";
    $query=$query."SET ";
    $query=$query."  candidatura_caliente = 0; ";
    
    $result = $db -> query($query);    
    
    $query = "UPDATE ";
    $query=$query."  expan_solicitud s ";
    $query=$query."  RIGHT JOIN ";
    $query=$query."  (SELECT ";
    $query=$query."     s.id ";
    $query=$query."   FROM ";
    $query=$query."     expan_gestionsolicitudes g, ";
    $query=$query."     expan_solicitud s, ";
    $query=$query."     expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."   WHERE ";
    $query=$query."     g.id = gs.expan_soli5dcccitudes_idb AND ";
    $query=$query."     s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
    $query=$query."     g.deleted = 0 AND ";
    $query=$query."     s.deleted = 0 AND ";
    $query=$query."     g.candidatura_caliente = 1) a ";
    $query=$query."    ON s.id = a.id ";
    $query=$query."SET ";
    $query=$query."  candidatura_caliente = 1; ";
    
    $result = $db -> query($query);
        

    
    //Las que tienen  10 o 20 o 30 días tenemos que enviarlas un C1.4 (reevío del C1)
    
    $query = "SELECT * ";
    $query = $query . "FROM expan_gestionsolicitudes ";
    $query = $query . "WHERE ";
    $query = $query . "  deleted = 0 AND ";
    $query = $query . "  (estado_sol =".Expan_GestionSolicitudes::ESTADO_EN_CURSO.") AND ";
    $query = $query . "  chk_recepcio_cuestionario = 0 AND  ";
    $query = $query . "  (TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_INI." OR ";
    $query = $query . "  TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_MED." OR ";
    $query = $query . "   TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_FIN.") AND ";
    $query = $query . "  id NOT IN (SELECT parent_id ";
    $query = $query . "             FROM calls ";
    $query = $query . "             WHERE deleted=0 AND status = 'planned' AND parent_type = 'Expan_GestionSolicitudes') AND ";
    $query = $query . "  id NOT IN (SELECT parent_id ";
    $query = $query . "             FROM tasks ";
    $query = $query . "             WHERE deleted=0 AND status = 'Not Started' AND parent_type = 'Expan_GestionSolicitudes'); ";
    
    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
    
        //recogemos la gestion
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($row["id"]);
                
        $solicitud=$gestion->GetSolicitud();
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Enviado correo a usuario correo c1.4-'.$gestion->id);
    
        //Enviamos el correo        
        $salida = $gestion -> preparaCorreo("C1.4");
        
    }
    
    
?>