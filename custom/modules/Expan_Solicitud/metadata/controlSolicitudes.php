<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de duplicidades Ajax');
    
    $valida = $_POST['valida'];
    $telefono=$_POST['telefono'];
    $solId=$_POST['solId'];
    $ratingAct=$_POST['rating'];
    
    $idEmail=$_POST['idEmail'];
    $email=$_POST['email'];
    $idUser=$_POST['idUser'];
    $fecha=$_POST['fecha'];
        
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

                if ($current_user->franquicia!=null){
                  echo '';
                  return;
                }
                $telefono=str_replace(" ", "", $telefono);
                
                $sql="SELECT id ";
                $sql=$sql."FROM   expan_solicitud ";
                $sql=$sql."WHERE  (phone_home = '".$telefono."' OR phone_mobile = '".$telefono."') AND ";
                $sql=$sql."deleted=0 AND id <>'".$solId."'";
                 
                $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - '.$sql); 
                 
                $resultSol = $db->query($sql, true);        
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                  $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El telefono existe');
                  echo $rowSol['id'];
                  return;
                }

                // Probamos si es un topo
                $query = "SELECT name ";
                $query=$query."FROM expan_empresa ";
                $query=$query."WHERE ";
                $query=$query."movil1 =".$telefono." OR ";
                $query=$query."movil2 =".$telefono." OR ";
                $query=$query."telefono_contacto_1 =".$telefono." OR ";
                $query=$query."telefono_contacto_2 =".$telefono." OR ";
                $query=$query."telefono_contacto_3 =".$telefono." OR ";
                $query=$query."telefono_contacto_observa1 =".$telefono." OR ";
                $query=$query."telefono_contacto_observa2 =".$telefono." OR ";
                $query=$query."telefono_contacto_observa3 =".$telefono." OR ";
                $query=$query."telefono1 =".$telefono." OR ";
                $query=$query."telefono2 =".$telefono;
                $query=$query." UNION ";
                $query=$query."SELECT name ";
                $query=$query."FROM expan_franquicia  ";
                $query=$query."where phone_office =".$telefono."  OR ";
                $query=$query."phone_alternate =".$telefono."  OR ";
                $query=$query."telefono_intermediacion =".$telefono."  OR ";
                $query=$query."telefono_contacto_2 =".$telefono."  OR ";
                $query=$query."telefono_alternativo_2 =".$telefono."  OR ";
                $query=$query."telefono_administracion =".$telefono."  OR ";
                $query=$query."movil_intermediacion =".$telefono."  OR ";
                $query=$query."movil_general_2 =".$telefono."  OR ";
                $query=$query."movil_general =".$telefono."  OR ";
                $query=$query."movil_administracion  =".$telefono;

                $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - '.$query);

                $resultSol = $db->query($query, true);
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                  $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El telefono existe');
                  echo $rowSol['name'];
                  return;
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
                        echo $rowSol['id'];
                        return;
                    }else{
                        echo '';
                        return;
                    }
                }
    
            }

            break;
            
        case 'pregRating':
        
            $query = "select * from expan_solicitud where id = '".$solId."'";
            
            $ratingAnt='';
            $resultSol = $db->query($query, true);        
            while ($rowSol = $db->fetchByAssoc($resultSol)){
                $ratingAnt=$rowSol['rating'];
            }
        
            if ($ratingAnt!='' && $ratingAct!='' && $ratingAct!=$ratingAnt){
                echo 'true';
            }else{
                echo 'false';
            }
                    
            break;
            
        case 'modRating':
        
            $query = "UPDATE expan_gestionsolicitudes  g ";
            $query=$query."       JOIN (SELECT gs.expan_soli5dcccitudes_idb, s.rating ";
            $query=$query."             FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
            $query=$query."             WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.id = '".$solId."') s ";
            $query=$query."         on g.id = s.expan_soli5dcccitudes_idb ";
            $query=$query."set    g.rating = s.rating; ";
            
            $result = $db -> query($query);
        
            break;
            
        case 'controlTiempo':
            
            $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Control de tiempo entra');
            
            $hoy=new DateTime();
            
            $solicitud=new Expan_Solicitud();
            $solicitud->retrieve($solId);
            
            $fechaCreacion= $solicitud->date_entered;
            
            $hoy->modify('-1 day');                       
            
            if ($fechaCreacion < $hoy){
                echo 'true';  
            }else{
                echo 'false';
            }
            
            break;
        
        case 'marcarReunion':                         
            
            $query = "UPDATE expan_gestionsolicitudes  g ";
            $query=$query."       INNER JOIN (SELECT g.id ";
            $query=$query."                   FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
            $query=$query."                   WHERE  g.id = gs.expan_soli5dcccitudes_idb AND gs.deleted = 0 AND g.deleted = 0 AND gs. ";
            $query=$query."                          expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$solId."') a ";
            $query=$query."         ON g.id = a.id ";
            $query=$query."SET    chk_entrevista = 1, f_entrevista = '".$fecha."' ";
            $query=$query."WHERE  g.f_entrevista IS NULL ";
            
                       
            $result = $db -> query($query);
        
            break;
            
    }   
    
?>