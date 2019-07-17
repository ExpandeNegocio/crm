<?php
    if (!defined('sugarEntry') || !sugarEntry)
        die('Not A Valid Entry Point');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]Inicio Lanzamiento mailing');

    require_once ('data/SugarBean.php');
    require_once ('modules/Expma_Mailing/Expma_Mailing.php');
    require_once ('custom/include/EnvioAutoCorreos.php');
    
    $idMailing = rawurldecode($_GET['idMailing']);
    $idplantilla = rawurldecode($_GET['template']);
    $porFranquicia = rawurldecode($_GET['porFranquicia']);
    
    
    $emailTemp = new EmailTemplate();
    $emailTemp -> disable_row_level_security = true;
    $emailTemp -> retrieve($idTemp);
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]ID mailing-' . $idMailing);
    $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]ID Plantilla-' . $idplantilla);
    $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]PorFranquicia-' . $porFranquicia);
    
    //Recogemos el cuerpo del mailing si no queremos meter una plantilla
    
    $db = DBManagerFactory::getInstance();
    
    $query = "SELECT cuerpo ";
    $query = $query . "FROM expma_mailing m ";
    $query = $query . "WHERE m.id = '" . $idMailing . "' ";
    
    $resultCuerpo = $db -> query($query, true);
    
    while ($rowCuerpo = $db -> fetchByAssoc($resultCuerpo)) {
        $cuerpo = $rowCuerpo["cuerpo"];
    }
    
    //Si tenemos que enviar un mismo correo para todos y solo a los que no hemos enviado
    // if ($porFranquicia==0){
    
    $query = "SELECT ";
    $query=$query." s.id AS id, s.tipo_origen tipoorigen, franquicia_principal, email_address ";
    $query=$query."FROM ";
    $query=$query." expma_mailing m, ";
    $query=$query." expma_mailing_expan_solicitud_c ms, ";
    $query=$query." expan_solicitud s, ";
    $query=$query." email_addr_bean_rel r, ";
    $query=$query." email_addresses e, ";
    $query=$query." expan_solicitud_cstm cs, ";
    $query=$query." email_templates et ";
    $query=$query."WHERE ";
    $query=$query." ms.expma_mailing_expan_solicitudexpma_mailing_ida = m.id AND ";
    $query=$query." m.plantilla = et.id AND ";
    $query=$query." s.id = r.bean_id AND ";
    $query=$query." e.id = r.email_address_id AND ";
    $query=$query." (et.franquicia = '' OR s.cerrada <> 1) AND ";
    $query=$query." (et.franquicia = '' OR s.positiva <> 1) AND ";
    $query=$query." cs.no_correos_c = 0 AND ";
    $query=$query." cs.id_c = s.id AND ";
    $query=$query." enviado = 0 AND ";
    $query=$query." ms.deleted = 0 AND ";
    $query=$query." e.deleted = 0 AND ";
    $query=$query." r.deleted = 0 AND ";
    $query=$query." s.dummie = 0 AND ";
    $query=$query." ms.expma_mailing_expan_solicitudexpan_solicitud_idb = s.id AND ";
    $query=$query." m.id = '" . $idMailing . "' ";
    $query=$query."GROUP BY ";
    $query=$query." s.id, email_address ";

           
    $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]Query-' . $query);
    
    $resultSol = $db -> query($query, true);
    $correos = array();
    
    while ($rowSol = $db -> fetchByAssoc($resultSol)) {
        $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]Correo-' . $rowSol["email_address"]);
        $correos[] = $rowSol["email_address"];
        
        if (!($rowSol["tipoorigen"]==Expan_Solicitud::TIPO_ORIGEN_CENTRAL && 
            $rowSol["franquicia_principal"]!=$emailTemp->franquicia)){            
            $listaIDSol[] = $rowSol["id"];            
        }              
    }
    
    if (count($correos)!=0){
       $envioCorreos = new EnvioAutoCorreos;
       $envioCorreos -> envioCorreosMailing($correos, $idplantilla, $cuerpo,$idMailing);
    }
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][LanzarMailing]Finalizacion Lanzamiento mailing');
?>