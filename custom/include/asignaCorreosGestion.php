<?php
    require_once ('custom/include/CreacionGestionSolicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos]Entra en asignacion de gestiones");
    
    $db = DBManagerFactory::getInstance();
    
    //previamente calculamos los campos de email para que la consulta sea inmediata
    
    $query = "update emails_text set to_addrs_clean= to_addrs where not to_addrs like ('%<%>%');";
    $db -> query($query);
    $query = "update emails_text set to_addrs_clean=substr(to_addrs,instr(to_addrs,'<') + 1, instr(to_addrs,'>') - instr(to_addrs,'<') - 1) where  to_addrs like ('%<%>%');";
    $db -> query($query);
    
    //Procesamos los correos entrantes
    
    $query = "SELECT t.email_id, g.id, e.date_sent ";
    $query=$query."FROM   emails e, emails_text t, expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, email_addr_bean_rel r, expan_franquicia f, email_addresses ea ";
    $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
    $query=$query."       substring_index(substring_index(t.from_addr, '<', -1),'>', 1) = ea.email_address AND ";
    $query=$query." g.deleted = 0 AND s.deleted = 0 AND s.id = r.bean_id AND ea.id = r.email_address_id AND e.id = ";
    $query=$query."         t.email_id AND e.parent_type IS NULL AND e.parent_id IS NULL AND f.id = g.franquicia AND t.to_addrs_clean = f.correo_envio; ";

    
    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
    
        $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos] ID email-" . $row["email_id"]);
    
        //Asigno la gestion
        $sqlUp = "UPDATE emails SET parent_type='Expan_GestionSolicitudes', parent_id='" . $row['id'] . "' WHERE id='" . $row['email_id'] . "'";
        $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos]Consulta asignacion Gestion-" . $sqlUp);
        $db -> query($sqlUp);
    
        //Marco como recibida informacion
        $sqlUp = "UPDATE expan_gestionsolicitudes SET chk_responde_C1=1, f_responde_C1='" . $row['date_sent'] . "' WHERE id='" . $row['id'] . "' AND chk_responde_C1=0";
        $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos] Actualizacion Gestion-" . $sqlUp);
        $db -> query($sqlUp);
    
        //Pasamos todas las gestiones que tenemos en estado 3,4 o 9 pasan a estado 2 si recibimos un correo
    
        $gestion = new Expan_GestionSolicitudes();
        $gestion -> retrieve($row['id']);
    
        if ($gestion ->isParadoCandidato() == true ||
            $gestion->isDescartadoUsuario() == true ||
            ($gestion -> estado_sol = Expan_GestionSolicitudes::ESTADO_PARADO && $gestion->motivo_parada==Expan_GestionSolicitudes::PARADA_NO_LOCALIZADO)
        ){
            $gestion -> estado_sol = Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            $gestion -> save();
        }
    
        //$gestion -> crearTarea("DOCURevCorreo");
    
    }
    
    //Procesamos los correos salientes que no estan ya asociados
    
    $query = "SELECT t.email_id, g.id, e.date_sent ";
    $query=$query."FROM   emails e, emails_text t, expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, email_addr_bean_rel r, expan_franquicia f, email_addresses ea ";
    $query=$query."WHERE  substring_index(substring_index(t.from_addr, '<', -1), '>', 1) = f.correo_envio AND g.id = gs.expan_soli5dcccitudes_idb AND ";
    $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.deleted = 0 AND s.deleted = 0 AND s.id = ";
    $query=$query."         r.bean_id AND ea.id = r.email_address_id AND e.id = t.email_id AND e.parent_type IS NULL AND e.parent_id IS NULL AND f.id ";
    $query=$query."       = g.franquicia AND substring_index(substring_index(t.to_addrs, '<', -1), '>', 1) = ea.email_address; ";

    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
    
        $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos] ID email-" . $row["email_id"]);
    
        //Asigno la gestion
        $sqlUp = "UPDATE emails SET parent_type='Expan_GestionSolicitudes', parent_id='" . $row['id'] . "' WHERE id='" . $row['email_id'] . "'";
        $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos]Consulta asignacion Gestion-" . $sqlUp);
        $db -> query($sqlUp);
    
    }
    $GLOBALS['log'] -> info("[ExpandeNegocio][Cargo correos]Finaliza");
    return;
?>