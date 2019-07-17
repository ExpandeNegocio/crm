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
    $respnointeresado=$_POST["respnointeresado"];
    $idGestion=$_POST["idgestion"];
        
    $GLOBALS['log'] -> info('[ExpandeNegocio][Paso a Estado 3]Pruebas' );
    
    switch ($resp) {
    case INTERESADO:
        PasarInteresado($idGestion);
        break;
    case NOINTERESADO:
        PasarNoInteresado($idGestion, $respnointeresado);
        break;
    case VALORANDO:
        PasarValorando($idGestion);
        break;
    }
    
    function PasarInteresado($idGestion){
    
        
        $gestion=new Expan_GestionSolicitudes();
        $gestion -> retrieve($idGestion);
        
        $gestion -> creaLlamada('[AUT]Revision Estado' , 'RevEst',0);
        $gestion -> ignore_update_c=true;
        $gestion -> save();
        
     }
     
     function PasarValorando($idGestion){
    
        $gestion=new Expan_GestionSolicitudes();
        $gestion -> retrieve($idGestion);
           
        $gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_PARADO;   
        $gestion->motivo_parada=Expan_GestionSolicitudes::PARADA_POR_PROTOCOLO;
        $gestion -> archivarLLamadas();
        //$gestion -> archivarTareas(); //cambio no se archivan las tareas
        $gestion -> archivarReuniones();            
        $gestion->ignore_update_c=true;
        $gestion->save();
     }
     
     function PasarNoInteresado($idGestion, $respuesta){
    
        $gestion=new Expan_GestionSolicitudes();
        $gestion -> retrieve($idGestion);
               
        $gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_DESCARTADO;
        if($respuesta!="0"){//ha seleccionado un motivo
            $gestion->motivo_descarte=$respuesta;  
        }else{
            $gestion->motivo_descarte=Expan_GestionSolicitudes::DESCARTE_OTROS;
        }
              
        $gestion->ignore_update_c=true;
        $gestion->save();
     }
     
?>