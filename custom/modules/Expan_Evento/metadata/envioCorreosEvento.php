<?php

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
	require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
	require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
	require_once ('custom/include/CreacionGestionSolicitud.php');
    require ('lib/PHPExcel/PHPExcel.php');
	
	$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    
    $db =  DBManagerFactory::getInstance();
    
    
        // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("ExpandeNegocio") //Autor
                         ->setLastModifiedBy("ExpandeNegocio") //Ultimo usuario que lo modificó
                         ->setTitle("Reporte envio Evento")
                         ->setSubject("Reporte envio Evento con PHP y MySQL")
                         ->setDescription("Datos Expandenegocio")
                         ->setKeywords("ExpandeNegocio")
                         ->setCategory("Reporte excel");
				
	//Recojemos los parámetros de la llamada Ajax	
	$id = $_POST['id'];
	
	$GLOBALS['log']->info('[ExpandeNegocio][EnviarCorreosEvento]Evento - '.$id);
    
    
    //Recogemos el texto a encajar en la plantilla
    
    $query = "select * from expan_evento e ";
    $query =$query ."where e.id='".$id."'";
    
    $cuerpo="";
    
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)){
        $cuerpo=$row["cuerpo"];
    }
    
	
	//Tenemos que recoger las franquicias asociadas al evento
	
	
	$query = "select f.id id,f.name name ";
	$query =$query ."from expan_franquicia f, expan_evento e , expan_franquicia_expan_evento_c fe ";
	$query =$query ."where fe.expan_franquicia_expan_eventoexpan_franquicia_ida=f.id AND ";
	$query =$query ."fe.expan_franquicia_expan_eventoexpan_evento_idb=e.id AND ";
	$query =$query ."fe.deleted=0 AND ";
	$query =$query ."e.id='".$id."'";
	
	$GLOBALS['log']->info('[ExpandeNegocio][EnviarCorreosEvento]Consulta - '.$query);

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)){
    	$franquicia=$row["name"];
		$GLOBALS['log']->info('[ExpandeNegocio][EnviarCorreosEvento]Franquicia - '.$franquicia);
		
		$idFran=$row["id"];
		
        //Recogemos la plantilla
        
        $query="select * from email_templates where deleted=0 AND type='".$idFran."#"."M1'";
         
        $resultSol = $db->query($query, true);
 
        $idTemplate='';    
        while ($row = $db->fetchByAssoc($resultSol)){
            $idTemplate=$row["id"];
        }
        if ($idTemplate!=''){                   
            //Recogemos cada direccion de correo
    		
    		$query = "SELECT email_address , s.id ";
    		$query =$query ."FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e, expan_solicitud_cstm cs ";
    		$query =$query ."WHERE  s.id = r.bean_id AND e.id = r.email_address_id AND s.deleted = 0 AND e.deleted = 0 AND cs.no_correos_c=0 AND cs.id_c=s.id AND ";
    		$query =$query ."s.cerrada<>1 AND s.positiva<>1 AND ";
    		$query =$query ."franquicias_secundarias LIKE  '%^".$idFran."^%'";
           		
        	$resultSol = $db->query($query, true);
        	
        	$listaCorreos=array();
            $listaIDSol=array();
    
    	    while ($rowSol = $db->fetchByAssoc($resultSol)){
    	    	$listaCorreos[]=$rowSol["email_address"];
                $listaIDSol[] = $rowSol["id"];
    		}
    		$envioCorreos=new EnvioAutoCorreos;    		
    		$envioCorreos->envioCorreosMailing($listaCorreos, $idTemplate, $listaIDSol,$cuerpo);
    				
    		$GLOBALS['log']->info('[ExpandeNegocio][EnviarCorreosEvento]Solicitud - '.$correo);
		}else{
		    //No hay plantilla
            
            
            
		}
	}
?>