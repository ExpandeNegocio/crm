<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]Inicio' );

    $db = DBManagerFactory::getInstance();

    $idGest=$_POST["idGest"];
    $idCall=$_POST["idCall"];
    $tipo=$_POST["tipo"]; 
    
    switch ($tipo) {
        case 'numTelefono':
    
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
            
            break;
            
        case 'doNotCall':
            
            $gestion=new Expan_GestionSolicitudes();            
            $gestion->retrieve($idGest);
            
            $notCall=0;
            
            if ($gestion !=null){
               
               $GLOBALS['log'] -> info('[ExpandeNegocio][doNotCall]Pillo Gestion' ); 
                
               $solicitud= $gestion->GetSolicitud();
               
               $GLOBALS['log'] -> info('[ExpandeNegocio][doNotCall]Pillo Solicitud-'.$solicitud->id ); 
                
               if ($solicitud !=null){           
                    $notCall=$solicitud -> do_not_call;
               }
            }

            $GLOBALS['log'] -> info('[ExpandeNegocio][doNotCall]LLamo-'.$notCall );          
            
            echo $notCall;
            
            break; 
            
        case 'fechaRetraso':
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][RecogeTelefono]IdCall-'.$idCall );
            
            $call=new Call();            
            $call->retrieve($idCall);
                        
            $numDias = $call -> CalcularRetraso();
            $nuevaFecha = date("Y-m-d-H-i-s", $call -> addBusinessDays($numDias));
            
            echo $nuevaFecha;
            
            break;
            
        default:
            
            break;
            
    }
?>