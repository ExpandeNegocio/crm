<?php
    
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    //Recojemos los parámetros de la llamada Ajax
    
    $ids = $_POST['gestiones'];
    $tipoEnvio = $_POST['tipoEnvio'];
    $mensajes="";
    
    $listaGest=split('!', $ids);
    
    foreach($listaGest as $id){//para cada id de gestion
        if($id!=""){
            $bean = new Expan_GestionSolicitudes();
            $bean->retrieve($id);
            $bean -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
            $solicitud = null;
            foreach ($bean->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $sol) {
                $solicitud = $sol;
            }
            
            //Vamos a actualizar la fecha de envio de doc   
    
    $GLOBALS['log']->info('[ExpandeNegocio][Tipo Reenvio]Reenviamos-'.$tipoEnvio);
    
    $salida=$bean->preparaCorreo($tipoEnvio);
    
    if ($salida=='Ok'){
        
        if ($tipoEnvio=="C1"){
            $bean->envio_documentacion=TimeDate::getInstance()->nowDb();
            $bean->chk_envio_documentacion=true;
            $bean -> creaLlamada('[AUT]Primera llamada', 'Primera');
        }elseif ($tipoEnvio=="C2"){
            $bean->f_informacion_adicional=TimeDate::getInstance()->nowDb();     
            $bean->chk_informacion_adicional=true;  
            $bean -> creaLlamada('[AUT]Llamada envio documentacion adicional', 'InformacionAdicional');
        }elseif ($tipoEnvio=="C3"){
            $bean->f_envio_precontrato=TimeDate::getInstance()->nowDb();
            $bean->chk_envio_precontrato=true;
            $bean -> crearTarea("DOCUPerPre");    
            $bean -> creaLlamada('[AUT]Llamada envio precontrato', 'SegPre');  
        }elseif ($tipoEnvio=="C4"){
            $bean->f_envio_contrato=TimeDate::getInstance()->nowDb();
            $bean->chk_envio_contrato=true;
            $bean -> crearTarea("DOCUPerCon");
            $bean -> creaLlamada('[AUT]Llamada Contrato', 'Contrato');
        }
                
        $bean -> ignore_update_c = true;
        $bean -> save();
        
        $bean -> calcularPrioridades();       
    }else{
        $mensajes=$mensajes."No se ha podido enviar la documentación para: ".$bean->name."\n";
    }  
        }
    }
    
     ob_end_clean();
     echo $mensajes;
    
    
?>