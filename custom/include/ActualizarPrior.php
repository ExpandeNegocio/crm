<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaPrioridades]Inicio' );

    $db = DBManagerFactory::getInstance();
     
    $GLOBALS['log'] -> info('[ExpandeNegocio][calcularPrioridades] Iniciamos calculo');
    
    //Actualizamos las prioridades de las gestiones         
    $query = "  update expan_gestionsolicitudes g  ";
    $query=$query."  inner join (SELECT g.id,ra.sid,  ";
    $query=$query."       g.name,  ";
    $query=$query."    CASE WHEN estado_sol='".Expan_GestionSolicitudes::POSITIVO_PRECONTRATO."' THEN 200  ";
    $query=$query."    WHEN estado_sol='".Expan_GestionSolicitudes::POSITIVO_COLABORACION."' THEN 100  ";
    $query=$query."    WHEN estado_sol='".Expan_GestionSolicitudes::POSITIVO_CONTRATO."' THEN 100 ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_visita_central = 1 THEN 100   ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_contrato = 1 THEN 90   ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_precontrato = 1 THEN 80   ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_visitado_fran = 1 THEN 70   ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_entrevista = 1 THEN 60   ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_informacion_adicional = 1 THEN 50    ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_recepcio_cuestionario = 1 THEN 40    ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_resolucion_dudas = 1 THEN 30    ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_responde_C1 = 1 THEN 20    ";
    $query=$query."    WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_documentacion = 1 THEN 10           ";
    $query=$query."    ELSE 0 END +IFNULL(ra.punt, 0) + IFNULL(lla.puntLLamada, 0) + IFNULL(co.puntCorreo, 0) final  ";
    $query=$query." FROM   expan_gestionsolicitudes g  ";
    $query=$query."  LEFT JOIN  ";
    $query=$query."     (SELECT   g.id, g.rating,s.id sid,  ";
    $query=$query."                           SUM(CASE WHEN g.rating = 1 THEN 50 WHEN g.rating = 2 THEN 30 WHEN g.rating = 3 THEN 10 ELSE 0 END) punt  ";
    $query=$query."                  FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
    $query=$query."                  WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida  ";
    $query=$query."                  GROUP BY g.id) ra  ";
    $query=$query."                   ON g.id = ra.id   ";
    $query=$query."       LEFT JOIN (SELECT   g.id,  ";
    $query=$query."                           SUM(CASE WHEN c.direction = 'Inbound' THEN 5 WHEN c.direction = 'Outbound' THEN 1 ELSE 0 END) puntLlamada  ";
    $query=$query."                  FROM     expan_gestionsolicitudes g, calls c  ";
    $query=$query."                  WHERE    c.parent_id = g.id AND c.status = 'Held'  ";
    $query=$query."                  GROUP BY g.id) lla  ";
    $query=$query."         ON g.id = lla.id  ";
    $query=$query."       LEFT JOIN (SELECT   g.id, SUM(3) puntCorreo  ";
    $query=$query."                  FROM     expan_gestionsolicitudes g, emails e  ";
    $query=$query."                  WHERE    e.parent_id = g.id AND e.type = 'inbound' AND e.parent_type = 'Expan_GestionSolicitudes'  ";
    $query=$query."                  GROUP BY g.id) co   ";
    $query=$query."         ON g.id = co.id) op  ";
    $query=$query."  on op.id=g.id    ";
    $query=$query."  set g.prioridad=op.final; ";
           
    $result = $db -> query($query);  
    
    //Actualizo las solicitudes
    
    $query = "  update expan_solicitud s ";
    $query=$query."  inner join (SELECT s.id, max(g.prioridad) prio ";
    $query=$query."              FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."              WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.deleted= 0 group by s.id) p ";
    $query=$query."  on s.id=p.id ";
    $query=$query."  set s.prioridad=p.prio; ";
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][calcularPrioridades] Actualizamos solicitudes');
    
    $result = $db -> query($query); 
    
    //Actualizo llamadas
    $query = "  update calls c ";
    $query=$query."  inner join expan_gestionsolicitudes g ";
    $query=$query."  on g.id=c.parent_id ";
    $query=$query."  set c.prioridad=g.prioridad; ";
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][calcularPrioridades] Actualizamos llamadas');
    
    $result = $db -> query($query); 
    
    //Actualizo tareas
    $query = "  update tasks t ";
    $query=$query."  inner join expan_gestionsolicitudes g ";
    $query=$query."  on g.id=t.parent_id ";
    $query=$query."  set t.prioridad=g.prioridad; ";
    
    $result = $db -> query($query);
            
    $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_GestionSolicitudes]Se han calculado las prioridades de las tareas');
    
    //Actualizo reuniones
    $query = "  update meetings m ";
    $query=$query."  inner join expan_gestionsolicitudes g ";
    $query=$query."  on g.id=m.parent_id ";
    $query=$query."  set m.prioridad=g.prioridad; ";
    
    $result = $db -> query($query);
            
    $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_GestionSolicitudes]Se han calculado las prioridades de las reuniones');
    
    echo "Finalizado proceso";

?>    