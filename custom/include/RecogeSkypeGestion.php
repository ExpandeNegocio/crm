<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeSkype]Inicio' );

    $db = DBManagerFactory::getInstance();

    $idGest=$_POST["id"];
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeSkype]IdGest-'.$idGest );
    
    $gestion=new Expan_GestionSolicitudes();
    
    $gestion->retrieve($idGest);
    
    $skype="";
    
    if ($gestion !=null){
       
       $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeSkype]Pillo Gestion' ); 
        
       $solicitud= $gestion->GetSolicitud();
       
       $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeSkype]Pillo Solicitud-'.$solicitud->id ); 
        
       if ($solicitud !=null){           
           $skype=$solicitud->skype;  
           $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeSkype]Pillo Skype-'.$Skype );          
       }
    }
    
    echo $skype;
?>