<?php
    
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    //Recojemos los parámetros de la llamada Ajax
    $operacion=$_POST['operacion'];
    $ids = $_POST['gestiones'];
    $tipoEnvio = $_POST['tipoEnvio'];
    $mensajes="";
    
    $listaGest=explode('!', $ids);
    
    
    switch ($operacion) {
        case 'reenvio':
            
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
                        
                        $fechaHoy=  new DateTime();
                        
                        if ($tipoEnvio=="C1"){
                            $bean->envio_documentacion=$fechaHoy->format('d/m/Y H:i'); 
                            $bean->chk_envio_documentacion=true;
                            $bean -> creaLlamada('[AUT]Primera llamada', 'Primera',0);
                        }elseif ($tipoEnvio=="C2"){
                            $bean->f_informacion_adicional=$fechaHoy->format('d/m/Y H:i');  
                            $bean->chk_informacion_adicional=true;  
                            $bean -> creaLlamada('[AUT]Llamada envio documentacion adicional', 'InformacionAdicional',0);
                        }elseif ($tipoEnvio=="C3"){
                            $bean->f_envio_precontrato=$fechaHoy->format('d/m/Y H:i'); 
                            $bean->chk_envio_precontrato=true;
                            $bean -> crearTarea("DOCUPerPre");    
                            $bean -> creaLlamada('[AUT]Llamada envio precontrato', 'SegPre',0);  
                        }elseif ($tipoEnvio=="C4"){
                            $bean->f_envio_contrato=$fechaHoy->format('d/m/Y H:i'); 
                            $bean->chk_envio_contrato=true;
                            $bean -> crearTarea("DOCUPerCon");
                            $bean -> creaLlamada('[AUT]Llamada Contrato', 'Contrato',0);
                        }
                        
                        //Pasamos a: En curso
                        if ($bean -> estado_sol== Expan_GestionSolicitudes::ESTADO_PARADO){
                            $bean -> estado_sol=Expan_GestionSolicitudes::ESTADO_EN_CURSO;
                        }                        
                                
                        $bean -> ignore_update_c = true;
                        $bean -> save();
                        
                        $prioridad=$bean -> calcularPrioridades();
                        $bean->prioridad=$prioridad;
                        //$solicitud->prioridad=$prioridad;   
                            
                    }else{
                        $mensajes=$mensajes."No se ha podido enviar la documentación para: ".$bean->name."\n";
                    }  
                }
            }
            
            ob_end_clean();
            echo $mensajes;
            
            break;
        
        case 'valida':
            
            $GLOBALS['log']->info('[ExpandeNegocio][Tipo Reenvio]Validamos-'.$tipoEnvio);
            
            $db = DBManagerFactory::getInstance();
            
            $query = "select f.chk_".$tipoEnvio." chk ";
            $query=$query."from expan_franquicia f, expan_gestionsolicitudes g  ";
            $query=$query."where g.franquicia=f.id and g.id='".$ids."'; ";
            
            $result = $db -> query($query, true);
            
            $val=0;
    
            while ($row = $db -> fetchByAssoc($result)) {        
                $val = $row["chk"];                                    
            }                       
            
            $GLOBALS['log']->info('[ExpandeNegocio][Tipo Reenvio]Validamos-Valor-'.$val);
            
            echo $val;
            
            break;
    }      
    
?>