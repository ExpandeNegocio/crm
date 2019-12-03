<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Inicio' );

    $db = DBManagerFactory::getInstance();

   
    $idEmpresa=$_POST["idEmpresa"];          
    $idFranquicia=$_POST["idFranquicia"];
    
    $tipo_proveedor=$_POST["tipo_proveedor"];
    $chk_cotizado= $_POST["chk_cotizado"];
    $chk_validado = $_POST["chk_validado"];
    $chk_requiere_dosier = $_POST["chk_requiere_dosier"];
    $dosier_enviado = $_POST["dosier_enviado"];
    $rappel_central = $_POST["rappel_central"];
    $rappel_fdo = $_POST["rappel_fdo"];
    $otras_condiciones = $_POST["otras_condiciones"];
    $duracion_acuerdo = $_POST["duracion_acuerdo"];
    $f_renovacion_acuerdo = $_POST["f_renovacion_acuerdo"];
    $observaciones_proveedor_franq = $_POST["observaciones_proveedor_franq"];
    $ofertas = $_POST["ofertas"];
    $pedido_minimo = $_POST["pedido_minimo"];
    $formas_pago = $_POST["formas_pago"];
    $condiciones_portes = $_POST["condiciones_portes"];
    
    $plazo_entrega = $_POST["plazo_entrega"];
    $garantia_producto = $_POST["garantia_producto"];
    $politica_devoluciones = $_POST["politica_devoluciones"];
    $ambito_act = $_POST["ambito_act"];
    
    $nombre_contacto=$_POST["nombre_contacto"];
    $cargo_contacto=$_POST["cargo_contacto"];
    $telefono_contacto=$_POST["telefono_contacto"];
    $email_contacto=$_POST["email_contacto"];
        
    $nombreEmpresa=$_POST["$nombreEmpresa"];
         
    $tipo=$_POST["tipo"];
    $valor=$_POST["valor"];
    $id=$_POST["id"];
    $idEmail=$_POST['idEmail'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    $tipoComp=$_POST["tipoComp"];
    $idCompetidores=$_POST["idCompetidores"];
    
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]tipo-'.$tipo );

    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]idEmpresa-'.$idEmpresa);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]idFranquicia-'.$idFranquicia);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]tipo_proveedor-'.$tipo_proveedor);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]chk_cotizado-'.$chk_cotizado);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]chk_validado-'.$chk_validado);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]chk_requiere_dosier-'.$chk_requiere_dosier);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]dosier_enviado-'.$dosier_enviado);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]rappel_central-'.$rappel_central);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]rappel_fdo-'.$rappel_fdo);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]otras_condiciones-'.$otras_condiciones);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]duracion_acuerdo-'.$duracion_acuerdo);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]f_renovacion_acuerdo-'.$f_renovacion_acuerdo);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]observaciones_proveedor_franq-'.$observaciones_proveedor_franq);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]ofertas-'.$ofertas);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]pedido_minimo-'.$pedido_minimo);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]formas_pago-'.$formas_pago);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]condiciones_portes-'.$condiciones_portes);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]plazo_entrega-'.$plazo_entrega);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]garantia_producto-'.$garantia_producto);
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]politica_devoluciones-'.$politica_devoluciones);
            

    switch ($tipo) {
        case 'AltaProveedor':            

           $query="insert into expan_empresa_proveedor" ;
           $query=$query."(id,empresa_id,chk_cotizado,chk_requiere_dosier,chk_validado,condiciones_portes,dosier_enviado,duracion_acuerdo,f_renovacion_acuerdo,formas_pago,garantia_producto,observaciones,ofertas,otras_condiciones,pedido_minimo,plazo_entrega,politica_devoluciones,proveedor_id,rappel_central,rappel_fdo,tipo_proveedor,ambito_act,nombre_contacto,cargo_contacto,telefono_contacto,email_contacto) values "; 
           $query=$query."(UUID(),'".$idFranquicia."',".$chk_cotizado.",".$chk_requiere_dosier.",".$chk_validado.",'".$condiciones_portes."',STR_TO_DATE('".$dosier_enviado."', '%d/%m/%Y'),'".$duracion_acuerdo;
           $query=$query."',STR_TO_DATE('".$f_renovacion_acuerdo."', '%d/%m/%Y'),'".$formas_pago."','".$garantia_producto."','".$observaciones."','".$ofertas."','".$otras_condiciones."','".$pedido_minimo."','".$plazo_entrega;           
           $query=$query."','".$politica_devoluciones."','".$idEmpresa."','".$rappel_central."','".$rappel_fdo."','".$tipo_proveedor."','".$ambito_act. "','".$nombre_contacto."','";
           $query=$query.$cargo_contacto."','".$telefono_contacto."','".$email_contacto."')";
        
           $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Consulta-'.$query);
        
           $result = $db -> query($query); 
           
           echo "Ok";

           break;           
           
        case 'BajaEmpresaProveedor':
        
           $query="delete from expan_empresa_proveedor " ;
           $query=$query."where id='".$id."'";
        
           $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Consulta-'.$query);
        
           $result = $db -> query($query); 
           
           echo "Ok";

           break;
           
        case 'ConsultaProveedor':            
            
            $query = "select ep.* ";
            $query=$query." from expan_empresa_proveedor ep ";
            $query=$query." where ep.id='".$id."'";
        
            $return = array();
            
            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }     
                                  
            echo json_encode($return,JSON_FORCE_OBJECT);
                    
            break; 
            
        case 'ValidaCorreo':
        
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Valida correo' );
        
            if ($email!=''){
                                
                $query = "SELECT em.id,e.email_address, em.name ";
                $query=$query."FROM   expan_empresa em, email_addr_bean_rel r, email_addresses e  ";
                $query=$query."WHERE em.id = r.bean_id AND e.id = r.email_address_id AND e.deleted=0 AND r.deleted=0 AND  ";
                $query=$query."e.email_address='".$email."' AND e.id<>'".$idEmail."' ";
                
                $GLOBALS['log']->info('[ExpandeNegocio][ControlEmpresas]Validadndo correo - Consulta - '.$query); 
                 
                $resultSol = $db->query($query, true);        
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                    
                    $GLOBALS['log']->info('[ExpandeNegocio][ControlEmpresas]El correo existe');                     
                    echo $rowSol['id'];
                    return;
                   
                }

                echo '';
    
            }
        
            break;
            
        case 'ValidaNombre':
        
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Valida nombre' );
        
            if ($name!=''){
                                
                $query = "SELECT id from expan_empresa where ucase(trim(name))=ucase(trim('".$name."')) and id!='".$idEmpresa."'";
                
                $GLOBALS['log']->info('[ExpandeNegocio][ControlEmpresas]Validadndo nombre - Consulta - '.$query); 
                 
                $resultSol = $db->query($query, true);        
                while ($rowSol = $db->fetchByAssoc($resultSol)){
                    
                    $GLOBALS['log']->info('[ExpandeNegocio][ControlEmpresas]El nombre existe');                     
                    echo $rowSol['id'];
                    return;                  
                }
                echo '';
            }
            break;
            
        case 'CambioCompetidor':
            
            $idCompetidores=str_replace("#","','",$idCompetidores);
            
            $query ="update expan_empresa_competidores_c set tipo_competidor='".$tipoComp."' where empresa_id='".$idEmpresa."' and competidor_id in('".$idCompetidores."')";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Consulta-'.$query);
        
            $result = $db -> query($query);     
            
            echo 'ok';
            
            break;
            
        case 'CompetidorPrincipal':

            $idCompetidores=str_replace("#","','",$idCompetidores);

            $query ="update expan_empresa_competidores_c set competidor_principal=0 where empresa_id='".$idEmpresa."'";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Consulta-'.$query);        
            $result = $db -> query($query);
            
            $query ="update expan_empresa_competidores_c set competidor_principal=1 where empresa_id='".$idEmpresa."' and competidor_id in('".$idCompetidores."')";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaEmpresa]Consulta-'.$query);        
            $result = $db -> query($query);     
            
            echo 'ok';
            
            break;
                   
            
        default:

            break;
    }

?>
