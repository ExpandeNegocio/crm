<?php
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Limpieza BD]Inicio');
    
    $db = DBManagerFactory::getInstance();
    
    echo 'Iniciando Proceso';
    
    //Limpiamos relaciones de Gestione y Solicitudes
    
    $query = "delete from expan_solicitud_expan_gestionsolicitudes_1_c where deleted=1; ";
    $result = $db -> query($query);
        
    $query = "DELETE FROM expan_solicitud_expan_gestionsolicitudes_1_c ";
    $query=$query."WHERE       id IN (SELECT id ";
    $query=$query."                   FROM   expan_solicitud_expan_gestionsolicitudes_1_c ";
    $query=$query."                   WHERE  expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida NOT IN (SELECT id FROM expan_solicitud)); ";
    $result = $db -> query($query);
    
    $query = "DELETE FROM expan_gestionsolicitudes ";
    $query=$query."WHERE       id IN (SELECT id ";
    $query=$query."                   FROM   expan_gestionsolicitudes ";
    $query=$query."                   WHERE  NOT id IN (SELECT expan_soli5dcccitudes_idb FROM expan_solicitud_expan_gestionsolicitudes_1_c)); ";
    $result = $db -> query($query);       
            
    //Calculamos la proovincia si esta vacia y el municipio si está ok
    $query = "UPDATE expan_solicitud ";
    $query=$query."SET    provincia_apertura_1 = CONVERT(left(localidad_apertura_1, 2), UNSIGNED INTEGER) ";
    $query=$query."WHERE  localidad_apertura_1 REGEXP '^[0-9]+$' AND provincia_apertura_1 IS NULL; ";
    $result = $db -> query($query);
    
    //Actualizacion de salutation
    $query = "update expan_solicitud s ";
    $query=$query."INNER JOIN expan_m_nombres n ";
    $query=$query."on UCASE(trim(s.first_name)) = n.nombre ";
    $query=$query."set s.salutation=case when n.tipo='H' then 'Mr.' else 'Ms.' end ";
    $query=$query."WHERE (salutation='' or salutation is null)  AND deleted = 0 AND NOT first_name IS NULL AND dummie != 1; ";
    $result = $db -> query($query);
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][Limpieza BD]Calculamos la proovincia si esta vacia y el municipio si está ok');
              
    //Limpieza de las auditorias de gestion que tienen el usuario vacio (si no se actualiza, los datos de auditoría no se ven bien)    
    $query = "update expan_gestionsolicitudes_audit set created_by=1 where expan_gestionsolicitudes_audit.created_by is null; ";    
    $result = $db -> query($query);
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][Limpieza BD]Limpieza de las auditorias de gestion que tienen el usuario vacio (si no se actualiza, los datos de auditoría no se ven bien)');
    
    //Limpieza de los correos que se han desenlazado
    
    $query = "delete from email_addr_bean_rel where deleted=1";
    $result = $db -> query($query);
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][Limpieza BD]Limpieza de las auditorias de gestion que tienen el usuario vacio (si no se actualiza, los datos de auditoría no se ven bien)');
    
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
    $query = "update expan_gestionsolicitudes set motivo_descarte = null, motivo_parada = null, motivo_positivo = null, envio_documentacion=null, chk_envio_documentacion=null  where estado_sol = ".Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO;
    $result = $db -> query($query);
    
    //BORRADO DE JOBS
    $query = "DELETE from job_queue where date_entered < DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
    $result = $db -> query($query);
    
    //BORRADO DE LLAMADAS
    $query = "delete from calls where deleted=1 and date_entered < DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
    $result = $db -> query($query);
    
    $query = "delete from calls where id in( select c.id from expan_gestionsolicitudes g, calls c where g.name like '%Dummie%' and g.id=c.parent_id and g.deleted=0 ); ";
    $result = $db -> query($query);
    
    //BORRADO ENLACE LLAMADAS
    $query = "delete from expan_gestionsolicitudes_calls_1_c where deleted=1 and date_modified < DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
    $result = $db -> query($query);
    
    //CONTROL FECHA DE LLAMADAS
    $query = "update calls set date_entered=date_modified where date_entered is null";
    $result = $db -> query($query);
    
    //LIMPIEZA SECTORES
    
    $query = "update expan_m_sectores set d_subsector= trim(d_subsector)";
    $result = $db -> query($query);
    
    //CONTROL NOMBRE LLAMADAS    
    $query = " ";
    $query=$query."UPDATE calls c ";
    $query=$query."       JOIN (SELECT g.name, g.id ";
    $query=$query."             FROM   expan_gestionsolicitudes g) gss ";
    $query=$query."         ON gss.id = c.parent_id ";
    $query=$query."SET    c.name = concat(gss.name, c.name) ";
    $query=$query."WHERE  c.name LIKE ' - %'; ";
    $result = $db -> query($query);    
    
    //BORRADO DE SOLICITUDES EN MAILINGS
    $query = "DELETE FROM expma_mailing_expan_solicitud_c WHERE DELETED=1";
    $result = $db -> query($query);
    
    //BORRADO DE CALLS USERS  
    $query = "DELETE from calls_users where deleted=1";
    $result = $db -> query($query);
    
    $query = "delete from notes where deleted=1";
    $result = $db -> query($query);
    
    $query = "DELETE FROM expan_gestionsolicitudes WHERE DELETED=1 and date_entered < DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
    $result = $db -> query($query);
    
    //LIMPIAMOS TAREAS
    
    $query = "delete from tasks where name='' AND parent_type is null; ";
    $result = $db -> query($query);
    
    
    //CORRECCION DE LOS EVENTOS QUE ESTAN COMO TIPO DE PARTICIPACION 3
    $query = "UPDATE expan_gestionsolicitudes  g  ";
    $query=$query."       INNER JOIN  ";
    $query=$query."       (SELECT g.id  ";
    $query=$query."        FROM   expan_gestionsolicitudes g, expan_franquicia_expan_evento_c ef  ";
    $query=$query."        WHERE  ef.expan_franquicia_expan_eventoexpan_franquicia_ida = g.franquicia AND g.expan_evento_id_c =  ";
    $query=$query."                 ef.expan_franquicia_expan_eventoexpan_evento_idb AND (ef.participacion = 3 || length(ef.participacion)=0)) a ";
    $query=$query."on      a.id = g.id             ";
    $query=$query."SET    tipo_origen = 1, subor_expande = 7,evento_bk=expan_evento_id_c, expan_evento_id_c=null; ";

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
    //No lo hacemos con caracter retroctivo por no modificar los informes previo
    // Lo dejamos comentado porque ya no lo aplicamos
    
 /*   $query = "update expan_gestionsolicitudes g ";
    $query=$query."join expan_evento e ";
    $query=$query."on  g.expan_evento_id_c=e.id ";
    $query=$query."set g.date_entered =e.fecha_celebracion ";
    $query=$query."where e.tipo_evento='FShop' and g.date_entered>STR_TO_DATE('20/10/2017','%d/%m/%Y') and g.deleted=0; ";
    $result = $db -> query($query);*/

    //Actualizar las

    $query = "UPDATE inbound_email b ";
    $query=$query."       INNER JOIN (SELECT s.id as sid , ie.id as ieid ";
    $query=$query."                   FROM   inbound_email ie, users_signatures s ";
    $query=$query."                   WHERE  ie.name LIKE s.name) a ";
    $query=$query."         ON b.id = a.ieid ";
    $query=$query."SET   template_id = sid ";
    $query=$query."where not sid is null; ";
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
    $query=$query."       INNER JOIN (SELECT t.id ";
    $query=$query."                   FROM   expan_gestionsolicitudes g, tasks t ";
    $query=$query."                   WHERE  t.parent_id = g.id AND g.estado_sol = 4 AND t.status = 'Not Started' AND g.deleted = 0 AND t.deleted = 0) a ";
    $query=$query."         ON t.id = a.id ";
    $query=$query."SET    status = 'Archived'; ";
    $result = $db -> query($query);
    
    //Actualizamos los usuarios contraseñas del correo saliente (Por alguna razón se cepilla las contraseñas)
    
  /*  $query = "UPDATE outbound_email g ";
    $query=$query."       JOIN (SELECT o.id,  t.mail_smtpuser,t.mail_smtppass ";
    $query=$query."             FROM   outbound_email o, outbound_email_bk t ";
    $query=$query."             WHERE  o.id=t.id) a ";
    $query=$query."         ON g.id=a.id ";
    $query=$query."SET    g.mail_smtpuser = a.mail_smtpuser, ";
    $query=$query."       g.mail_smtppass = a.mail_smtppass; ";
    $result = $db -> query($query);*/
    
    //Actualizamos la lista de usuarios con correo activo para cada franquicia
    
    $query = "UPDATE expan_franquicia  f  ";
    $query=$query."       INNER JOIN (select   f.id, concat('^', GROUP_CONCAT(group_id SEPARATOR '^,^'), '^') correo  ";
    $query=$query."                   from     inbound_email i, expan_franquicia f, users u  ";
    $query=$query."                   where    f.correo_envio = i.email_user AND i.group_id=u.id and u.status='Active'  ";
    $query=$query."                   and i.status='Active'  ";
    $query=$query."                   group by f.id) a  ";
    $query=$query."         ON f.id = a.id  ";
    $query=$query."SET    f.config_correo = a.correo; ";
    $result = $db -> query($query);
    
    
    // Solucionamos el problema de las gestiones tienen mal la fecha del envio de la documentacion
    
    $query = "UPDATE expan_gestionsolicitudes  g ";
    $query=$query."       JOIN (SELECT g.id, s.fecha_primer_contacto ";
    $query=$query."             FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
    $query=$query."             WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  g.id = gs.expan_soli5dcccitudes_idb ";
    $query=$query."             AND (s.fecha_primer_contacto is not null and g.envio_documentacion is null) ) p ";
    $query=$query."         ON g.id = p.id ";
    $query=$query."SET    g.envio_documentacion= p.fecha_primer_contacto; ";
    $result = $db -> query($query);
    
    //Solucionamos el problema de las solicitudes tienen mal la fecha del primer contacto

    $query = "UPDATE expan_solicitud  s ";
    $query=$query."       JOIN (SELECT s.id, min(g.envio_documentacion) envio_documentacion ";
    $query=$query."             FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
    $query=$query."             WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  g.id = gs.expan_soli5dcccitudes_idb ";
    $query=$query."             AND (s.fecha_primer_contacto is null and g.envio_documentacion is not null) Group by s.id ) p ";
    $query=$query."         ON s.id = p.id ";
    $query=$query."SET    s.fecha_primer_contacto= p.envio_documentacion; ";
    $result = $db -> query($query);
    
    
    //LLevamos la fecha de creacion de la gestion a la fecha de inicio de un evento si esta esta fuera del intervalo
    
    /*$query = "UPDATE expan_gestionsolicitudes g INNER JOIN expan_evento e ON g.expan_evento_id_c = e.id ";
    $query=$query."SET    g.date_entered=e.fecha_celebracion ";
    $query=$query."WHERE  g.date_entered BETWEEN e.fecha_celebracion AND DATE_ADD(e.fecha_fin, INTERVAL 1 DAY); ";*/
    
    
    //Limpiamos las posibles llamadas duplicadas
    
    $query = "UPDATE calls c ";
    $query=$query."       INNER JOIN ";
    $query=$query."       (SELECT  max(date_entered) date_entered, parent_id, count(1) ";
    $query=$query."          FROM     calls ";
    $query=$query."          WHERE    deleted = 0 AND status = 'Planned' ";
    $query=$query."          GROUP BY parent_id ";
    $query=$query."          HAVING   count(1) > 1";
    $query=$query."       ) a ";
    $query=$query."         ON c.parent_id =a.parent_id AND c.date_entered=a.date_entered ";
    $query=$query."SET    c.status='Archived'; ";
    $result = $db -> query($query);
    
   /* $query = "UPDATE calls c  ";
    $query=$query."       INNER JOIN  ";
    $query=$query."       (SELECT id, max(date_entered) date_entered, name, count(1)  ";
    $query=$query."          FROM     calls_bk  ";
    $query=$query."          WHERE    deleted = 0 AND status = 'Planned'  ";
    $query=$query."          GROUP BY name  ";
    $query=$query."          HAVING   count(1) > 1 ";
    $query=$query."       ) a  ";
    $query=$query."         ON c.id =a.id ";
    $query=$query."SET    c.status='Archived' ";
    $result = $db -> query($query);*/
    
    //Limpieza llamadas no válidas
    
//    $query = "delete from calls where status='Planned' and deleted=0 and parent_id not in (select id from expan_gestionsolicitudes where deleted=0);";
//    $result = $db -> query($query);

        
    //Pasamos a Archivadas las tareas del ERM finalizadas hace tiempo
    
    $hoy=new DateTime();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues.xml?limit=100&status_id=6&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
    
    
    $response = curl_exec($ch);    
    curl_close($ch);
    
    $tareas = new SimpleXMLElement($response);
    
   /* foreach ($tareas as $tarea) {
        
        echo "Entra<br>";
        
        $fecha=DateTime::createFromFormat("Y-m-d\TH:i:s\Z",$tarea->closed_on);
        
        if ($fecha->add(new DateInterval('P10D'))<$hoy){
            
            echo "Procesa<br>";
           
            $chmod = curl_init();
        
            curl_setopt($chmod, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues/".$tarea->id.".xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
            curl_setopt($chmod, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($chmod, CURLOPT_HEADER, FALSE);
            
            curl_setopt($chmod, CURLOPT_CUSTOMREQUEST, "PUT");
            
            curl_setopt($chmod, CURLOPT_POSTFIELDS, "<issue>
              <status_id>12</status_id>     
            </issue>");
        
            curl_setopt($chmod, CURLOPT_HTTPHEADER, array(
              "Content-Type: application/xml"
            ));
            
            $response = curl_exec($chmod);
            curl_close($chmod);
            
            
            echo $i."-".$tarea->id."-".$tarea->status_id."-".$tarea->subject."-".$fecha->format('Y-m-d H:i:s')."-".$hoy->format('Y-m-d H:i:s')."-".$tarea->closed_on."<br>";
            echo "https://expandenegocio.easyredmine.com/issues/".$tarea->id.".xml&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6"."<br>";
            $i++;
        }           
    
    }*/

    //Campos que se pueden perder por guardado automático

    $query = "UPDATE ";
    $query=$query." expan_gestionsolicitudes g ";
    $query=$query." JOIN expan_gestionsolicitudes_audit a ON g.id = a.parent_id ";
    $query=$query."SET ";
    $query=$query." g.observaciones_descarte = a.before_value_text ";
    $query=$query."WHERE ";
    $query=$query." g.deleted = 0 AND ";
    $query=$query." a.after_value_text = '' AND ";
    $query=$query." a.field_name = 'observaciones_descarte' AND ";
    $query=$query." (g.observaciones_descarte = '' OR ";
    $query=$query."  g.observaciones_descarte IS NULL); ";

    $result = $db -> query($query);

    //Correccion con franquicias secundarias

    $query = "update expan_solicitud s  left join  (SELECT   s.id, concat('^', GROUP_CONCAT(g.franquicia SEPARATOR '^,^'), '^') sec_calc, s.franquicias_secundarias, ";
    $query=$query."case when length(s.franquicias_secundarias)<>length(concat('^', GROUP_CONCAT(g.franquicia SEPARATOR '^,^'), '^')) then 'x' else '' end ";
    $query=$query."FROM     expan_solicitud s, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s. ";
    $query=$query."         deleted = ";
    $query=$query."         0 AND g.deleted = 0 AND gs.deleted = 0 ";
    $query=$query."GROUP BY s.id) a ";
    $query=$query."on a.id=s.id ";
    $query=$query."set s.franquicias_secundarias=a.sec_calc ";
    $query=$query."where a.sec_calc<>s.franquicias_secundarias; ";

    $result = $db -> query($query);

  //Correccion problemas franquicia principal

    $query = "SELECT * ";
    $query=$query."FROM expan_solicitud s ";
    $query=$query."WHERE INSTR(franquicias_secundarias,concat('^',franquicia_principal,'^')) = 0 AND deleted = 0; ";   
    
    $result = $db -> query($query, true);
    
    echo "Cnsulta Limpieza fs - ".$query."<br>";
    
    while ($row = $db -> fetchByAssoc($result)) {                          
        $list=explode('^,^', $row["franquicias_secundarias"]);        
        $query="update expan_solicitud set franquicia_principal='".str_replace("^","",$list[0])."' where id='".$row["id"]."'";
        echo $query."<BR>";    
        $result2 = $db -> query($query);
    }



    //Correccion problemas franquicias principal

    $query = "update expan_solicitud ";
    $query=$query."inner join (SELECT s.id, concat('^', GROUP_CONCAT(g.franquicia SEPARATOR '^,^'), '^') fs ";
    $query=$query."FROM   expan_solicitud s, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query=$query."WHERE   g.id = gs.expan_soli5dcccitudes_idb AND ";
    $query=$query."  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
    $query=$query."LENGTH(franquicias_secundarias) = 65535 AND s.deleted = 0 and g.deleted=0 and gs.deleted=0 ";
    $query=$query."group by s.id) a ";
    $query=$query."set franquicias_secundarias= a.fs ";
    $query=$query."where LENGTH(franquicias_secundarias) = 65535 ";

    $result = $db -> query($query);

    echo "Cnsulta Limpieza fs - ".$query."<br>";

    //Correccion empresas franquicia sin Franquicia asociada

    $query = "SELECT id ";
    $query=$query."FROM   expan_empresa ";
    $query=$query."WHERE  empresa_type = 'fa' AND deleted = 0 AND name NOT IN (SELECT name ";
    $query=$query."                                                            FROM   expan_franquicia ";
    $query=$query."                                                            WHERE  deleted = 0); ";

    $result = $db -> query($query, true);

    while ($row = $db -> fetchByAssoc($result)) {
      $emp= new Expan_Empresa();
      $emp->retrieve($row["id"]);
      $emp->copyFranquicia();
    }


    //Correccion Franqucia sin empresa

    $query = "SELECT id ";
    $query=$query."FROM   expan_franquicia ";
    $query=$query."WHERE  deleted = 0 AND name NOT IN (SELECT name ";
    $query=$query."                                    FROM   expan_empresa ";
    $query=$query."                                    WHERE  empresa_type = 'fa' AND deleted = 0); ";

    $result = $db -> query($query, true);

    while ($row = $db -> fetchByAssoc($result)) {
      $fran= new Expan_Franquicia();
      $fran->retrieve($row["id"]);
      $fran->CreateEmpresa();
    }

  /*******************************************/

//Recogemos los proyectos del ERM y los llevo a una lista

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/projects.xml?limit=1000&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));

  $response = curl_exec($ch);
  curl_close($ch);

  try{
      $proyectos = new SimpleXMLElement($response);
      $myArrayProyERM[''] = '';

      $query = "delete from erm_proyectos";
      $result = $db -> query($query);

      foreach ($proyectos as $proyecto) {
          $id=(string)$proyecto->id;
          $nombre=(string)$proyecto->name;
          $query = "insert into erm_proyectos (id,nombre ) values ('$id','$nombre') ";

          echo "Proyecto - ".$query."<br>";

          $result = $db -> query($query);
      }
  } catch (Exception $e){

  }

  /*****************************************/

  /*******************************************/

//Recogemos los usuarios del ERM y los llevo a una lista

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/users.xml?limit=100&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));

  $response = curl_exec($ch);
  curl_close($ch);

  try{
      $usuarios = new SimpleXMLElement($response);
      $myArrayUserERM[''] = '';

      $query = "delete from erm_usuarios";
      $result = $db -> query($query);

      foreach ($usuarios as $usuario) {
        $id=(string)$usuario->id;
        $nombre=(string)$usuario->firstname." ".(string)$usuario->lastname;
        $query = "insert into erm_usuarios (id,nombre ) values ('$id','$nombre') ";
        $result = $db -> query($query);
      }
  } catch (Exception $e){

  }
  /*****************************************/



    echo 'FinlizadoProceso';
?>