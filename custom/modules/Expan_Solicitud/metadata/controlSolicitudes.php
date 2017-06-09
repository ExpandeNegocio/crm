<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax');
    
    $valida = $_GET['valida'];
    $telefono=$_GET['telefono'];
    $solId=$_GET['solId'];
    
    $idEmail=$_GET['idEmail'];
    $email=$_GET['email'];
    $idUser=$_GET['idUser'];
        
    global $current_user;
    //Comprobamos que el usuario no es de un franquicia
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax- Franquicia Usuario -'.$current_user->franquicia.'-');
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax- ID Usuario custom-'.$_SESSION["custom_current_user"].'-');
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax- Franquicia Usuario custom-'.$_SESSION["custom_current_userfranq"].'-');
    
    if ($_SESSION["custom_current_userfranq"]!='' ){                  
        return;        
    }
    
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax- Validacion -'.$valida);
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax- Telefono -'.$telefono);
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax- SolID -'.$solId);
    
    $db = DBManagerFactory::getInstance();
    
    switch ($valida){
        
        case 'telefono':
        
            if ($telefono!=''){
                $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono');
                
                $telefono=str_replace(" ", "", $telefono);
                
                $sql="SELECT id ";
                $sql=$sql."FROM   expan_solicitud ";
                $sql=$sql."WHERE  (phone_home = '".$telefono."' OR phone_mobile = '".$telefono."') AND ";
                $sql=$sql."deleted=0 AND id <>'".$solId."'";
                 
                $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - '.$sql); 
                 
                $resultSol = $db->query($sql, true);        
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                    if ($current_user->franquicia==null){
                        $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El telefono existe');                     
                        echo $rowSol['id'];
                        return;               
                    }else{
                        echo '';
                        return;
                    }
                }
            }
            break;
        
        case 'correo':
        
            if ($email!=''){
                                
                $sql="SELECT s.id,e.email_address,s.first_name,s.last_name ";
                $sql=$sql."FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
                $sql=$sql."WHERE s.id = r.bean_id AND e.id = r.email_address_id AND e.deleted=0 AND r.deleted=0 AND ";
                $sql=$sql."e.email_address='".$email."' AND e.id<>'".$idEmail."'";
                
                $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo correo - Consulta - '.$sql); 
                 
                $resultSol = $db->query($sql, true);        
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                    if ($current_user->franquicia==null){
                        $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El correo existe');                     
                        echo $rowSol[id];
                        return;
                    }else{
                        echo '';
                        return;
                    }
                }
    
            }

            break;
    }
    
?>