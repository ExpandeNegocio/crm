<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    const NOINTERESADO= "NI";
    const INTERESADO= "IN";
    const VALORANDO= "VAL";
    
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ProcesoForm1.4]Inicio' );

    $db = DBManagerFactory::getInstance();

    $resp=$_POST["resp"];
    $email=$_POST["email"];
    $franquicia=$_POST["franquicia"];
        
    $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Pruebas' );
    
    switch ($resp) {
    case INTERESADO:
        PasarInteresado($email,$franquicia);
        break;
    case NOINTERESADO:
        PasarNoInteresado($email,$franquicia);
        break;
    case VALORANDO:
        PasarValorando($email,$franquicia);
        break;
    }
    
    function PasarInteresado($email,$franquicia){
    
        $solicitud=getSol($email);
        
        if ($solicitud==null){
            return null;
        }
        
        $gestion=$solicitud->getGestionFromFranID($franquicia);
        $gestion -> creaLlamada('[AUT]Revision Estado' , 'RevEst');
        $gestion -> ignore_update_c=true;
        $gestion -> save();
        
     }
     
     function PasarValorando($email,$franquicia){
    
        $solicitud=getSol($email);
        
        if ($solicitud==null){
            return null;
        }
        
        $gestion=$solicitud->getGestionFromFranID($franquicia);        
        $gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_PARADO;   
        $gestion->motivo_parada=Expan_GestionSolicitudes::PARADA_POR_PROTOCOLO;            
        $gestion->ignore_update_c=true;
        $gestion->save();
     }
     
     function PasarNoInteresado($email,$franquicia){
    
        $solicitud=getSol($email);
        
        if ($solicitud==null){
            return null;
        }
        
        $gestion=$solicitud->getGestionFromFranID($franquicia);        
        $gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_DESCARTADO;  
        $gestion->motivo_descarte=Expan_GestionSolicitudes::DESCARTE_PERSONAL;      
        $gestion->ignore_update_c=true;
        $gestion->save();
     }
     
     function getSol($email){
         
       $idSol=localizaSolicitudPoremail($email);       
        
        if ($idSol!=""){                      
            
            $solicitud = new Expan_Solicitud();
            $solicitud -> retrieve($idSol);
            
           return $solicitud;
        }else{
            return null;
        }
     }     
     
     function localizaSolicitudPoremail($email) {

        $db = DBManagerFactory::getInstance();

        $query = "SELECT s.id ";
        $query = $query . "FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
        $query = $query . "WHERE s.id = r.bean_id AND s.deleted=0 AND e.id = r.email_address_id AND lower(trim(e.email_address))='" . strtolower(trim($email)) . "'";

        echo $query."<br>";
        
        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Consulta-".$query);

        $result = $db -> query($query, true);
        $idSol = "";

        while ($row = $db -> fetchByAssoc($result)) {
            
            $idSol = $row["id"];
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Bucle ENtra-".$idSol);
        }
        
        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]idSol-".$idSol);

        return $idSol;
    } 
     
?>