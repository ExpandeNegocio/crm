<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Calls/Call.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Pruebas');
    
    define('TIEMPO_REENVIO_C14_INI',10); 
    define('TIEMPO_REENVIO_C14_FIN',30);   
    define('TIEMPO_REENVIO_C14_INI_PORTAL',5);
    define('TIEMPO_REENVIO_C14_MED_PORTAL',15);  
    define('TIEMPO_REENVIO_C14_FIN_PORTAL',30);       
    define('TIEMPO_PASO_ESTADO_3',60);
    define('TIEMPO_PASO_ESTADO_3_LARGO',90);
    define('TIEMPO_PASO_ESTADO_2',20);
    
    $db = DBManagerFactory::getInstance();
    
    
    echo "LLega1";
    
    // Cuando una gestion en estado 3 tiene alguna llamda programada para menos de 20 días 
    // o esta la fecha de reactivacion a menos de 20 días, esta pasa a estado 2
    
    $query = "select id, max(PresenteRuta) PresenteRuta, max(DesplazaFecha) DesplazaFecha, max(PlanificaLlamada) PlanificaLlamada, max(EnvioCorreo) EnvioCorreo, max(ReactivacionAut) ReactivacionAut ";
    $query=$query."from (  ";
    $query=$query."  SELECT g.id, p.PresenteRuta, p.DesplazaFecha, p.PlanificaLlamada, p.EnvioCorreo, p.ReactivacionAut ";
    $query=$query."  FROM calls c, expan_gestionsolicitudes  g, tipo_parada p ";
    $query=$query."  WHERE   ";
    $query=$query."   c.parent_id = g.id AND   ";
    $query=$query."   c.status = 'Planned' AND   ";
    $query=$query."   g.deleted = 0 AND   ";
    $query=$query."   c.deleted = 0 AND   ";
    $query=$query."   p.id= g.motivo_parada AND ";
    $query=$query."   g.estado_sol =".Expan_GestionSolicitudes::ESTADO_PARADO." AND   ";
    $query=$query."   c.date_start < DATE_ADD(now(),INTERVAL ".TIEMPO_PASO_ESTADO_2." DAY)   ";
    $query=$query."  union  ";
    $query=$query."  SELECT g.id, p.PresenteRuta, p.DesplazaFecha, p.PlanificaLlamada, p.EnvioCorreo, p.ReactivacionAut   ";
    $query=$query."  from expan_gestionsolicitudes  g, tipo_parada p  ";
    $query=$query."  where  ";
    $query=$query."    p.id= g.motivo_parada AND ";
    $query=$query."    g.estado_sol =".Expan_GestionSolicitudes::ESTADO_PARADO." AND   ";
    $query=$query."    g.f_reactivacion_parado < DATE_ADD(now(),INTERVAL ".TIEMPO_PASO_ESTADO_2." DAY) AND  ";
    $query=$query."    g.deleted=0 ";
    $query=$query.")a group by id ";
    
    echo $query."<br>";
    
    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
    
        //recogemos la gestion
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($row["id"]);
        
        if ($row["PlanificaLlamada"]==1){
            $gestion->creaLlamada("[REACT]Reactivacion Gestion Parada", "React",TIEMPO_PASO_ESTADO_2);
        }
        
        if ($gestion->cuando_empezar<$gestion->f_reactivacion_parado && $row["DesplazaFecha"]==1){
            $gestion->cuando_empezar=$gestion->f_reactivacion_parado;
        }
        
        if ($row["EnvioCorreo"]){
                        
             $query = "select count(1) num from expan_gestionsolicitudes g, emails e, email_templates t ";
             $query=$query."where e.parent_id=g.id and t.subject=e.name and g.id='".$row["id"]."' and t.type='C1.4'; ";
                  
             echo $query."<br>";     
                  
            //  $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Consulta Num correos-'.$query);    
                    
             $result2 = $db -> query($query, true);
    
             $numEnv=0;
             while ($row2 = $db -> fetchByAssoc($result2)) {
                 $numEnv= $row2["num"];
             }   
             
             echo "Num envios-".$numEnv."<br>";
             
             $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]numCorr-'.$numEnv);
             
             if ($numEnv<2){
                 
                 echo "ENTRA-".$row["id"]."<br>";
                 $salida = $gestion -> preparaCorreo("C1.4");
             }
             
        }
        
        if ($row["ReactivacionAut"]==1){
            $gestion ->estado_sol=Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            $gestion->calcAvanzado();
            $gestion->calcCaliente();
        } 
                
        $gestion ->save();
        
    }
    
    //Cuando una gestion tiene mas de 60 días, esta en estad 2, y no tiene ninguna llamada/terea por realizar asociada
    //se pasa a estado 3    

    $query = "SELECT g.id id,ReactivacionAut ";
    $query=$query."FROM   expan_gestionsolicitudes g, tipo_parada p ";
    $query=$query."WHERE  p.id= g.motivo_parada AND deleted = 0 AND estado_sol = '".Expan_GestionSolicitudes::ESTADO_EN_CURSO."' AND chk_recepcio_cuestionario = 0 AND ";
    $query=$query."       chk_informacion_adicional = 0 AND chk_entrevista = 0 AND chk_envio_precontrato = 0 AND chk_visita_local = 0 AND ";
    $query=$query."       chk_envio_contrato = 0 AND chk_visita_central = 0 AND TIMESTAMPDIFF(DAY, DATE(date_modified), CURDATE()) > ".TIEMPO_PASO_ESTADO_3."  ";
    $query=$query."       AND g.id NOT IN (SELECT parent_id ";
    $query=$query."                      FROM   calls ";
    $query=$query."                      WHERE  STATUS = 'planned' AND parent_type = 'Expan_GestionSolicitudes' AND deleted = 0)  ";
    $query=$query."       AND g.id NOT IN (SELECT parent_id ";
    $query=$query."                      FROM   tasks ";
    $query=$query."                      WHERE  STATUS = 'Not Started' AND parent_type = 'Expan_GestionSolicitudes' AND deleted = 0) ";
    
    echo $query;
             
    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
        if ($row["ReactivacionAut"]==1){
            $gestion ->estado_sol=Expan_GestionSolicitudes::ESTADO_PARADO;
            $gestion ->save();
        } 
    }
    
    
    //Las gestiones que son de Rating B o C en estado 2, sin acciones antes de 3 meses, se pasa a parado, 
    
    
    $query = "UPDATE expan_gestionsolicitudes g  ";
    $query=$query."INNER JOIN(                        ";
    $query=$query."SELECT * ";
    $query=$query."FROM   expan_gestionsolicitudes g ";
    $query=$query."WHERE  deleted = 0 AND estado_sol = '".Expan_GestionSolicitudes::ESTADO_EN_CURSO."' AND chk_recepcio_cuestionario = 0 AND chk_informacion_adicional = 0 AND chk_entrevista = 0 ";
    $query=$query."       AND chk_envio_precontrato = 0 AND chk_visita_local = 0 AND chk_envio_contrato = 0 AND chk_visita_central = 0  ";
    $query=$query."       AND (rating=3  OR rating=4) AND g.id IN ";
    $query=$query."         (SELECT parent_id ";
    $query=$query."            FROM   calls ";
    $query=$query."            WHERE STATUS = 'planned' AND parent_type = 'Expan_GestionSolicitudes'  ";
    $query=$query."            AND deleted = 0 AND date_start > CURDATE() AND TIMESTAMPDIFF(DAY, DATE(date_start), CURDATE()) > ".TIEMPO_PASO_ESTADO_3_LARGO.")) c ";
    $query=$query."ON c.id = g.id  ";
    $query=$query."SET    g.estado_sol = '".Expan_GestionSolicitudes::ESTADO_PARADO."',g.motivo_parada='".Expan_GestionSolicitudes::PARADA_HASTA_NUEVO_CONTACTO."', g.candidatura_caliente = 0; ";
    
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
    
    
    //Las que tienen  10 0 20 o 30 días tenemos que enviarlas un C1.4 (reevío del C1)
    
    $query = "SELECT * ";
    $query=$query."FROM expan_gestionsolicitudes  ";
    $query=$query."WHERE  ";
    $query=$query."  deleted = 0 AND  ";
    $query=$query."  (estado_sol =".Expan_GestionSolicitudes::ESTADO_EN_CURSO.") AND  ";
    $query=$query."  chk_recepcio_cuestionario = 0 AND     ";
    $query=$query."   ( (tipo_origen=2 AND (TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_INI_PORTAL." OR  ";
    $query=$query."  TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_MED_PORTAL." OR  ";
    $query=$query."   TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_FIN_PORTAL."))    ";
    $query=$query."   OR ";
    $query=$query."   (tipo_origen!=2 AND(TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_INI." OR    ";
    $query=$query."   TIMESTAMPDIFF(DAY,DATE( date_entered),CURDATE())=".TIEMPO_REENVIO_C14_FIN.") ))      ";
    $query=$query." AND  ";
    $query=$query."  id NOT IN (SELECT parent_id  ";
    $query=$query."             FROM calls  ";
    $query=$query."             WHERE deleted=0 AND status = 'planned' AND parent_type = 'Expan_GestionSolicitudes') AND  ";
    $query=$query."  id NOT IN (SELECT parent_id  ";
    $query=$query."             FROM tasks  ";
    $query=$query."             WHERE deleted=0 AND status = 'Not Started' AND parent_type = 'Expan_GestionSolicitudes'); ";
        
    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
    
        //recogemos la gestion
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($row["id"]);
                
        $solicitud=$gestion->GetSolicitud();
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Enviado correo a usuario correo c1.4-'.$gestion->id);
    
        echo "ENVIADO c1.4-".$gestion->id."<br>";
        
        //Enviamos el correo        
        $salida = $gestion -> preparaCorreo("C1.4");
        
    }
       
?>