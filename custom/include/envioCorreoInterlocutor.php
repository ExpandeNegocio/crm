<?php
    require_once ('data/SugarBean.php');
    require_once ('custom/include/EnvioAutoCorreos.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][correoInterlocutor]Inicio' );

    $idGest = $_POST['id'];
    $tipoEnv = $_POST['tipoEnv'];
        
    $gestion=new Expan_GestionSolicitudes();
    $gestion->retrieve($idGest);
    
    $solicitud=$gestion->GetSolicitud();    
    $franquicia=$gestion->GetFranquicia();

    $correoEnvio='';       
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][EnvioCorreoInterno]Antes creacion addreses');
    
    $addresses = array( '0' => array('email_address'=>''));
    $rcp_name="";
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][EnvioCorreoInterno]Despues creacion addreses');
         
    switch ($tipoEnv) {
        case 'franq' :
            $addresses['0']['email_address']=$franquicia->correo_general;   
            $rcp_name=$franquicia->name;        
            break;
        case 'consultor' :
            $idUsuario=$franquicia->dir_cons_id_c; 
            $usuario= new User();
            $usuario->retrieve($idUsuario);
            $rcp_name=$usuario->name;
            
            $dirCorreoEnvio=getUserEmail($idUsuario);
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][EnvioCorreoInterno]Direccion Correo envio-'.$dirCorreoEnvio);
            
            $addresses['0']['email_address'] = $dirCorreoEnvio;
            break;
    }

    $GLOBALS['log'] -> info('[ExpandeNegocio][EnvioCorreoInterno]Addreses rellenas - '.$addresses['0']['email_address']);
    
    if($addresses['0']['email_address']!=""){//Tenemos correo de la franquicia
        $envioAutoCorreos= new EnvioAutoCorreos();
        $salida=$envioAutoCorreos->rellenacorreoFicha("FR",$tipoEnv,$rcp_name,$addresses,$solicitud,$franquicia,$gestion,null); 
        echo $salida;      
    }else{
        if ($tipoEnv=='franq'){
            echo "No existe el correo de la franquicia";
        }else{
            echo "No existe el correo del director de consultoria de la cuenta";
        }
        
    }         
            
    
    function getUserEmail($idUsuario){
        
        $db = DBManagerFactory::getInstance();
    
        $query = "SELECT e.email_address  ";
        $query=$query."FROM   email_addr_bean_rel r, email_addresses e  ";
        $query=$query."WHERE  r.bean_id = '".$idUsuario."' AND e.id = r.email_address_id AND e.deleted=0 AND r.deleted=0; ";
        
        $result = $db -> query($query, true);    
        
        $correo='';

        while ($row = $db -> fetchByAssoc($result)) {
            $correo=$row['email_address'];
        }
        
        return $correo;
        
    }
    
?>