<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]Inicio' );

    $db = DBManagerFactory::getInstance();

    $idGest=$_POST["id"];
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]IdGest-'.$idGest );
    
    $gestion=new Expan_GestionSolicitudes();
    
    $gestion->retrieve($idGest);
    
    $telefono="";
    
    if ($gestion !=null){
       
       $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]Pillo Gestion' ); 
        
       $solicitud= $gestion->GetSolicitud();
       
       $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]Pillo Solicitud-'.$solicitud->id ); 
        
       if ($solicitud !=null){           
           $telefono=$solicitud->phone_mobile;  
           $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]Pillo Telefono-'.$telefono );          
       }
    }
    
    echo $telefono;
?>