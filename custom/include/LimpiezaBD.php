<?php
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Pruebas');
    
    $db = DBManagerFactory::getInstance();
    
    echo 'Iniciando Proceso';
    
    //Limpieza de las auditorias de gestion que tienen el usuario vacio (si no se actualiza, los datos de auditoría no se ven bien)
    
    $query = "update expan_gestionsolicitudes_audit set created_by=1 where expan_gestionsolicitudes_audit.created_by is null; ";    
    $result = $db -> query($query);
    
    //CONS_LIMPIA_GESTIONES_VACIAS
    $query = "delete from expan_gestionsolicitudes where name=''";
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ORIG_EXPANDE
    $query = "update expan_gestionsolicitudes set expan_evento_id_c=null,subor_central=null,subor_medios=null,portal=null,subor_mailing= null  where tipo_origen = '1'";
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ORIG_PORTAL
    $query = "update expan_gestionsolicitudes set expan_evento_id_c = null, subor_expande = null, subor_central = null, subor_medios = null,subor_mailing= null  where tipo_origen = '2'";
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ORIG_EVENTOS
    $query = "update expan_gestionsolicitudes set subor_expande = null, subor_central = null, subor_medios = null, portal = null,subor_mailing= null  where tipo_origen = '3'";
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ORIG_CENTRAL
    $query = "update expan_gestionsolicitudes set expan_evento_id_c = null, subor_expande = null, subor_medios = null, portal = null,subor_mailing= null  where tipo_origen = '4'";
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ORIG_MEDIOS
    $query = "update expan_gestionsolicitudes set expan_evento_id_c = null, subor_expande = null, subor_central = null, portal = null,subor_mailing= null  where tipo_origen = '5'";
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ORIG_MAILLING
    $query = "update expan_gestionsolicitudes set expan_evento_id_c = null, subor_expande = null, subor_central = null, portal = null, subor_medios = null  where tipo_origen = '6'";
    $result = $db -> query($query);
    
    
    //CONS_LIMPIA_ESTADO_INI
    $query = "update expan_gestionsolicitudes set motivo_descarte = null, motivo_parada = null, motivo_positivo = null where estado_sol = ".Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO;
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ESTADO_CURSO
    $query = "update expan_gestionsolicitudes set motivo_descarte = null, motivo_parada = null, motivo_positivo = null where estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO;
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ESTADO_PARADO
    $query = "update expan_gestionsolicitudes set motivo_descarte = null, motivo_positivo = null where estado_sol = ".Expan_GestionSolicitudes::ESTADO_PARADO;
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ESTADO_DESCAR
    $query = "update expan_gestionsolicitudes set motivo_parada = null, motivo_positivo = null where estado_sol = ".Expan_GestionSolicitudes::ESTADO_DESCARTADO;
    $result = $db -> query($query);
    
    //CONS_LIMPIA_ESTADO_EXITO
    $query = "update expan_gestionsolicitudes set motivo_descarte = null, motivo_parada = null where estado_sol = ".Expan_GestionSolicitudes::ESTADO_POSITIVO;
    $result = $db -> query($query);
        
    //CONS_LIMPIA_AVANZADAS
    $query = "update expan_gestionsolicitudes set candidatura_avanzada=0,candidatura_caliente=0 where estado_sol=".Expan_GestionSolicitudes::ESTADO_PARADO." or estado_sol=".Expan_GestionSolicitudes::ESTADO_DESCARTADO;
    $result = $db -> query($query);    
    
    //CONS_ADD_DESCARTE
    $query = "update expan_gestionsolicitudes set motivo_descarte=99 where estado_sol = ".Expan_GestionSolicitudes::ESTADO_DESCARTADO." and motivo_descarte is null";
    $result = $db -> query($query);
    
    //Limpia relacion de llamadas
    
    $query = "UPDATE calls c " ;
    $query =$query . "join (SELECT c.id c_id, g.id g_id ";
    $query =$query . "FROM   expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gc, calls c ";
    $query =$query . "WHERE  g.id =gc.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida  AND  c.parent_id ='' AND  ";
    $query =$query . "gc.expan_gestionsolicitudes_calls_1calls_idb=c.id AND c.parent_type='Expan_GestionSolicitudes' ) a ";
    $query =$query . "on a.c_id=c.id ";
    $query =$query . "set c.parent_id=a.g_id";
    $result = $db -> query($query);
    
    //Actualiza los origenes de las llamadas
    $query = "UPDATE calls c INNER JOIN expan_gestionsolicitudes g ON c.parent_id = g.id ";
    $query=$query."SET    c.origen=g.tipo_origen; ";
    $result = $db -> query($query);
    
    $query = "update calls set parent_type='Expan_GestionSolicitudes' where parent_type='Accounts'"; 
    $result = $db -> query($query);
    
    //Actualiza la fecha de recogida de las gestiones que vienen de FranquiShop 
    //No lo hacemos con caracter retroctivo por no modificar los informes previos
    
    $query = "update expan_gestionsolicitudes g ";
    $query=$query."join expan_evento e ";
    $query=$query."on  g.expan_evento_id_c=e.id ";
    $query=$query."set g.date_entered =e.fecha_celebracion ";
    $query=$query."where e.tipo_evento='FShop' and g.date_entered>STR_TO_DATE('20/10/2017','%d/%m/%Y') and g.deleted=0; ";
    $result = $db -> query($query);
        
        
    //Copia de capos de solicitud a gestiones si las gestiones están vacías
    
    
    $query = "UPDATE expan_gestionsolicitudes b ";
    $query=$query."       INNER JOIN ";
    $query=$query."       (SELECT g.id, s.rating ";
    $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida) a ";
    $query=$query."         ON b.id = a.id ";
    $query=$query."SET    b.rating=a.rating ";
    $query=$query."where b.rating is null; ";
    $result = $db -> query($query);
    
    
    $query = "UPDATE expan_gestionsolicitudes b ";
    $query=$query."       INNER JOIN ";
    $query=$query."       (SELECT g.id, s.prioridad ";
    $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida) a ";
    $query=$query."         ON b.id = a.id ";
    $query=$query."SET    b.prioridad=a.prioridad ";
    $query=$query."where b.prioridad is null; ";
    $result = $db -> query($query);
    
    
    $query = "UPDATE expan_gestionsolicitudes b ";
    $query=$query."       INNER JOIN ";
    $query=$query."       (SELECT g.id, s.recursos_propios ";
    $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida) a ";
    $query=$query."         ON b.id = a.id ";
    $query=$query."SET    b.recursos_propios=a.recursos_propios ";
    $query=$query."where b.recursos_propios is null; ";
    $result = $db -> query($query);
    
    $query = "UPDATE expan_gestionsolicitudes b ";
    $query=$query."       INNER JOIN ";
    $query=$query."       (SELECT g.id, s.cuando_empezar ";
    $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida) a ";
    $query=$query."         ON b.id = a.id ";
    $query=$query."SET    b.cuando_empezar=a.cuando_empezar ";
    $query=$query."where b.cuando_empezar is null; ";
    $result = $db -> query($query);
    
    //LImpiamos acciones de gestiones que están en estado 4
    
    $query = "UPDATE calls  c ";
    $query=$query."       INNER JOIN (SELECT c.id ";
    $query=$query."                   FROM   expan_gestionsolicitudes g, calls c ";
    $query=$query."                   WHERE  c.parent_id = g.id AND g.estado_sol = 4 AND c.status = 'Planned' AND g.deleted = 0 AND c.deleted = 0) a ";
    $query=$query."         ON c.id = a.id ";
    $query=$query."SET    status = 'Archived'; ";
    $result = $db -> query($query);
        
    $query = "UPDATE tasks  t ";
    $query=$query."       INNER JOIN (SELECT c.id ";
    $query=$query."                   FROM   expan_gestionsolicitudes g, tasks t ";
    $query=$query."                   WHERE  c.parent_id = g.id AND g.estado_sol = 4 AND c.status = 'Not Started' AND g.deleted = 0 AND t.deleted = 0) a ";
    $query=$query."         ON t.id = a.id ";
    $query=$query."SET    status = 'Archived'; ";
    $result = $db -> query($query);
    
    
    
    
    echo 'FinlizadoProceso';
?>