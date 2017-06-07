<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][Franquiciado]Entra a crear un franquiciado o comprobar telefono');
    
    $accion = $_POST['accion'];
    $solId=$_POST['id'];
    
    $db = DBManagerFactory::getInstance();
    $salida= '';
    switch($accion){
        
        case '1':
            $salida= 'Ok';
            
            $GLOBALS['log']->info('[ExpandeNegocio][ControlFranquiciado]Validar Telefono');
            
                $sql="SELECT id as idF FROM   expan_franquiciado f, ";
                $sql=$sql." (select phone_home as phf, phone_mobile as pmf from expan_solicitud where id='".$solId."') b ";
                $sql=$sql." WHERE  (phone_home =phf OR phone_home=pmf OR phone_mobile =phf OR phone_mobile=pmf) AND deleted=0;";
                 
                $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - '.$sql); 
                 
                $resultSol = $db->query($sql, true);
                
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                        $salida='';    
                        return; 
                }
                
             break;
        
        case '2':
            
                 $sol =new Expan_Solicitud();
                 $sol->retrieve($solId);
                 
                 $franq=new Expan_Franquiciado();
                 
                 $franq -> date_entered=TimeDate::getInstance()->getNow()->asDb();
                 $franq -> first_name= $sol->first_name;
                 $franq -> last_name=$sol->last_name;
                 $franq -> salutation =$sol->salutation;
                 $franq -> phone_home=$sol ->phone_home;
                 $franq -> phone_mobile=$sol->phone_mobile;
                 $franq -> no_correos=$sol->no_correos;
                 $franq -> no_newsletter=$sol->no_newsletter;
                 $franq -> skype=$sol->skype;
                 $franq -> email1=$sol->email1;
                 $franq -> email2=$sol->email2;
                 $franq -> pais=$sol->pais_c;
                  
                 //guardar los cambios del franquiciado
                 $franq -> ignore_update_c = true;
                 $franq -> save();
                 
                 $salida='Ok';
                 
             break;
    }
        echo $salida;
?>