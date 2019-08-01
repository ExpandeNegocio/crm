<?php
	
	require_once ('data/SugarBean.php');
	require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
	require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
	require_once ('custom/include/CreacionGestionSolicitud.php');
	
	//Recojemos los parámetros de la llamada Ajax
	
	$id = $_POST['id'];
	$tipoEnvio = $_POST['tipoEnvio'];
	$estadoEdicion= $_POST['estadoEdicion'];
	
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
        
        $fechaHoy=  new DateTime();
        
        if ($tipoEnvio=="C1"){
           if($estadoEdicion="Detalle"){
                $bean->envio_documentacion=$fechaHoy->format('d/m/Y H:i');
                $bean->chk_envio_documentacion=true;                
            }
            if ($bean->estado_sol==Expan_GestionSolicitudes::ESTADO_EN_CURSO ||
                $bean->estado_sol==Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO){
                $bean -> creaLlamada('[AUT]Primera llamada', 'Primera',0);
            } elseif ($bean->estado_sol==Expan_GestionSolicitudes::ESTADO_PARADO ||
                $bean->estado_sol==Expan_GestionSolicitudes::ESTADO_DESCARTADO){
                $bean -> creaLlamada('[REACT]Llamada de reactivacion', 'React',0);
            }                                  
            $bean->estado_sol = Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            
        }elseif ($tipoEnvio=="C2"){
            if($estadoEdicion="Detalle"){
                $bean->f_informacion_adicional=$fechaHoy->format('d/m/Y H:i');     
                $bean->chk_informacion_adicional=true;  
            }
            if ($bean->estado_sol==Expan_GestionSolicitudes::ESTADO_EN_CURSO ||
                $bean->estado_sol==Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO){
                $bean -> creaLlamada('[AUT]Llamada envio documentacion adicional', 'InformacionAdicional',0);
            } elseif ($bean->estado_sol==Expan_GestionSolicitudes::ESTADO_PARADO ||
                $bean->estado_sol==Expan_GestionSolicitudes::ESTADO_DESCARTADO){
                $bean -> creaLlamada('[REACT]Llamada de reactivacion', 'React',0);
            }
            $bean->estado_sol = Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            
        }elseif ($tipoEnvio=="C3"){
            if($estadoEdicion="Detalle"){
                $bean->f_envio_precontrato=$fechaHoy->format('d/m/Y H:i');
                $bean->chk_envio_precontrato=true;
            }
            $bean -> crearTarea("DOCUPerPre");    
            $bean -> creaLlamada('[AUT]Llamada envio precontrato', 'SegPre',0);              
            $bean->estado_sol = Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            
            
        }elseif ($tipoEnvio=="C4"){
            if($estadoEdicion="Detalle"){
                $bean->f_envio_contrato=$fechaHoy->format('d/m/Y H:i');                
                $bean->chk_envio_contrato=true;
            }
            $bean -> crearTarea("DOCUPerCon");
            $bean -> creaLlamada('[AUT]Llamada Contrato', 'Contrato',0);
            $bean->estado_sol = Expan_GestionSolicitudes::ESTADO_EN_CURSO;
        }
                
        $bean -> ignore_update_c = true;
        $bean -> save();
        
        $prioridad=$bean -> calcularPrioridades();
        $bean->prioridad=$prioridad;
        //$solicitud->prioridad=$prioridad;       
    }
	
    echo $salida;
?>