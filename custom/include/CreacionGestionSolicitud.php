<?php

require_once ('data/SugarBean.php');
require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once ('custom/include/EnvioAutoCorreos.php');

class AccionesGuardadoGestionSol {

    protected static $fetchedRow = array();

    const FRANQ_ASESORA = '380f0dc1-e38e-83e2-8c74-53df9ab90ac1';

    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments) {
        if ($bean -> fetched_row) {
            self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
        }
    }

    function guardadoGestionSolicitud(&$bean, $event, $arguments) {

        //Comprobacion de bulce infinito
        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {                       
            
            $bean->ignore_update_c = true;
            $fechaHoy=  new DateTime();
            
            $bean->ActChekByDate();

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Entramos en control bucle');

            //debemos distinguir cuando estamos creanado una nueva GestionSolicitud

            $db = DBManagerFactory::getInstance();
            $query = "select * from expan_gestionsolicitudes where id='" . $bean -> id . "'";

            $result = $db -> query($query, true);

            $estadoAnt = "";
            $subPreAnt="";
            $recepcio_cuestionario_ant="";
            $informacion_adicional_ant="";
            $sol_amp_info_ant="";
            $responde_C1_ant="";
            $entrevista_ant="";
            $visitado_fran_ant="";
            $envio_precontrato_ant="";
            $visita_local_ant="";
            $envio_contrato_ant="";
            $visita_central_ant="";
            $cand_cal_ant="";
            $usuario_ant="";
            $cand_avan_ant="";
            $motivoPositivoAnt="";
            $f_entrega_cuenta_pre_ant="";
            $chk_contrato_firmado_ant="";
            $pre_fir1_first_name_ant="";
            $chk_gestionado_central_ant="";
            $rating_ant="";
            $chk_entrevista_previa_ant="";

            while ($row = $db -> fetchByAssoc($result)) {

                //Recojo estados anteriores
                $estadoAnt = $row["estado_sol"];
                $envio_documentacion_ant = $row["chk_envio_documentacion"];
                $resolucion_dudas_ant = $row["chk_resolucion_dudas"];
                $sol_amp_info_ant = $row["chk_sol_amp_info"];

                $recepcio_cuestionario_ant = $row["chk_recepcio_cuestionario"];
                $informacion_adicional_ant = $row["chk_informacion_adicional"];

                $responde_C1_ant = $row["chk_responde_C1"];
                $entrevista_ant = $row["chk_entrevista"];
                $propuesta_zona_ant = $row["chk_propuesta_zona"];
                
                $visitado_fran_ant = $row["chk_visitado_fran"];
                $envio_precontrato_ant = $row["chk_envio_precontrato"];
                $visita_local_ant = $row["chk_visita_local"];
                $envio_contrato_ant = $row["chk_envio_contrato"];
                $visita_central_ant = $row["chk_visita_central"];
                $posible_colabora_ant = $row["chk_posible_colabora"];
                $chk_precontrato_firmado_ant=$row["chk_precontrato_firmado"];
                $chk_contrato_firmado_ant=$row["chk_contrato_firmado"];
                $chk_aprobacion_local_ant=$row["chk_aprobacion_local"];
                $chk_gestionado_central_ant=$row["chk_gestionado_central"];

                //Recojo fechas anteriores
                $fecha_envio_documentacion_ant = $row["envio_documentacion"];
                $fecha_resolucion_dudas_ant = $row["f_resolucion_dudas"];
                $fecha_sol_amp_info_ant = $row["f_sol_amp_info"];
                $fecha_recepcion_cuestionario_ant = $row["f_recepcion_cuestionario"];
                $fecha_envio_informacion_adicional_ant = $row["f_informacion_adicional"];

                $fecha_respuesta_C1 = $row["f_responde_C1"];
                $fecha_entrevista_ant = $row["f_entrevista"];
                $fecha_propuesta_zona_ant= $row["f_propuesta_zona"];
                
                $fecha_visitado_fran_ant = $row["f_visitado_fran"];
                $fecha_envio_precontrato_ant = $row["f_envio_precontrato"];
                $fecha_visita_local_ant = $row["f_visita_local"];
                $fecha_envio_contrato_ant = $row["f_envio_contrato"];
                $fecha_visita_central_ant = $row["f_visita_central"];
                $fecha_aprobacion_local_ant = $row["f_aprobacion_local"];
                
                $estadPreconAnt=$row["estado_precontrato"];
                $subPreAnt=$row["subestado_precandidato"];
                                
                $pre_fir1_first_name_ant=$row["pre_fir1_first_name"];
                
                $cand_cal_ant = $row["candidatura_caliente"];
                $cand_avan_ant = $row["candidatura_avanzada"];

                $usuario_ant = $row["assigned_user_id"];
                $chk_entrevista_previa_ant=$row["chk_entrevista_previa"];
                
                $motivoPositivoAnt =$row["motivo_positivo"];
                $rating_ant=$row["rating"];
                
                if (isset($row["f_entrega_cuenta_pre"])){$f_entrega_cuenta_pre_ant=$row["f_entrega_cuenta_pre"];}
                                
            }

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Estado Ant - ' . $estadoAnt);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Estado Act - ' . $bean -> estado_sol);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Recepcio_cuestionario Ant - ' . $recepcio_cuestionario_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Recepcio_cuestionario Act - ' . $bean -> chk_recepcio_cuestionario);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Informacion_adicional Ant - ' . $informacion_adicional_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Informacion_adicional Act - ' . $bean -> chk_informacion_adicional);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Solicitud Amp informacion Ant - ' . $sol_amp_info_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Informacion_adicional Act - ' . $bean -> chk_sol_amp_info);

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Responde C1 Ant - ' . $responde_C1_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Responde C1 Act - ' . $bean -> chk_responde_C1);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entrevista Ant - ' . $entrevista_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entrevista Act - ' . $bean -> chk_entrevista);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Visitado fran Ant - ' . $visitado_fran_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Visitado fran Act - ' . $bean -> chk_visitado_fran);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio_precontrato Ant - ' . $envio_precontrato_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio_precontrato Act - ' . $bean -> chk_envio_precontrato);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Visita_local Ant - ' . $visita_local_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Visita_local Act - ' . $bean -> chk_visita_local);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio_contrato Ant - ' . $envio_contrato_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio_contrato Act - ' . $bean -> chk_envio_contrato);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Visita_central Ant - ' . $visita_central_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Visita_central Act - ' . $bean -> chk_visita_central);

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Candidatura Caliente Ant - ' . $cand_cal_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Candidatura Caliente Act - ' . $bean -> candidatura_caliente);

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Uusario asig Ant - ' . $usuario_ant);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Uusario asig Act - ' . $bean -> assigned_user_id);

            //Recogemos la solicitud asociada a la gestion

            $solicitud = $bean -> GetSolicitud();
            $franquiciaid = $bean -> franquicia;
            $franquicia= new Expan_Franquicia();
            $franquicia->retrieve($franquiciaid);
            
            if ($solicitud== null){
                return;
            }

            //Miramos si la GestionSolicitud a la que pasamos es de tipo 2
            if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO) {

                //Si es un topo pasamos a 
                if ($bean->rating==5){
                    
                    $bean->estado_sol=Expan_GestionSolicitudes::ESTADO_DESCARTADO;
                    $bean->motivo_descarte=5; //Topo
                    
                    $bean -> archivarLLamadas();
                    $bean -> archivarTareas(); //Se ha cambiado varias veces de opinión (inicial mente se quitaron, luego se añadieron y ahora se quitan de nuevo)
                    $bean -> archivarReuniones();
                    
                    $bean -> calcularPrioridades();
                    $bean -> ignore_update_c = true;
                    $bean -> save();
                    
                    return null;
                }
                          
                $mayorCheck = 0;                                                                                 

                $bean -> ignore_update_c = true;

                //Recogemos el telefono de la solicitud

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Previo a recoge telefono');

                if ($solicitud != null) {
                    $telefono = $solicitud -> recogerTelefono();
                }

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Despues de recoger telefono');
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] $estadoAnt-'.$estadoAnt);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] $bean -> estado_sol-'.$bean -> estado_sol);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] $bean -> chk_envio_documentacion-'.$bean -> chk_envio_documentacion);

                //Si el estado cambia
                // REALIZAMOS ENVÍO C 1
                if ($estadoAnt != $bean -> estado_sol && ($bean -> chk_envio_documentacion == null || $bean -> chk_envio_documentacion == 0)) {
                                       
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entramos Envio 1');

                    //Si no tenemos correo debemos de programar llamada para pedir el mismo
                    if ($solicitud -> tieneCorreo()) {
                        if ($solicitud -> puedeAbrirZona()) {
                            if (!$solicitud -> zonaOcupada()) {

                                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Antes preparar Correo ');

                                //Controlamos si es de tipo asesoramiento
                                if ($bean -> franquicia == self::FRANQ_ASESORA) {
                                    if ($solicitud -> enviar_servicios_asesora == true) {
                                        $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio C1.1 de asesoramiento ');
                                        $salida = $bean -> preparaCorreo("C1.1");
                                    } else {
                                        $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio C1 de asesoramiento ');
                                        $salida = $bean -> preparaCorreo("C1");
                                    }

                                } else {
                                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envio C1');
                                    $salida = $bean -> preparaCorreo("C1");
                                }

                                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Resultado envío - ' . $salida);
                                if ($salida == "Ok") {
                                    $bean -> chk_envio_documentacion = true;
                                    if ($bean -> envio_documentacion == $fecha_envio_documentacion_ant || $bean -> envio_documentacion==null) {
                                        $bean -> envio_documentacion = $fechaHoy->format('d/m/Y H:i');                                                                                
                                    }

                                    //Si hemos podido pasar a estado dos. Creamos la llamada
                                    if ($telefono != "") {
                                        $mayorCheck = 1;
                                    } else {
                                        if($solicitud->skype!=""){
                                            $mayorCheck = 1;
                                        }else{
                                            
                                        $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envío de plantilla C1.5');
                                      //  $bean -> preparaCorreo("C1.5");
                                      }
                                    }
                                } elseif ($salida == "Alguno de los correos no han sido enviados. La plantilla no existe" || 
                                          $salida == "La plantilla de envío no está validada" || 
                                          $salida == "Los correos no se han enviado porque el usuario no quería recibirlos." || 
                                          $salida == "Alguno de los correos no han sido enviados. Posiblemente el correo no sea válido." 
                                          ) {
                                    //Si no hemos podido enviar el correo por la plantilla lo devolvemos al estado 1

                                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] No se ha podido enviar el correo');
                                    $bean -> chk_envio_documentacion = false;
                                    $bean -> estado_sol = Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO;
                                    $bean -> envio_documentacion = null;
                                } else {
                                    if ($telefono != "") {
                                        $mayorCheck = 1;
                                    } else {
                                        if($solicitud->skype!=""){
                                            $mayorCheck = 1;
                                        }else{
                                            
                                        $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Envío de plantilla C1.5');
                                      //  $bean -> preparaCorreo("C1.5");
                                      }
                                    }
                                }
                            } else {
                                $bean -> preparaCorreo("C1.1");
                                $bean -> estado_sol = Expan_GestionSolicitudes::ESTADO_PARADO;
                                $bean -> motivo_parada = Expan_GestionSolicitudes::PARADA_ZONA_NO_INTERES;
                            }
                        } else {
                            $bean -> preparaCorreo("C1.2");
                            $bean -> estado_sol = Expan_GestionSolicitudes::ESTADO_PARADO;
                            $bean -> motivo_parada = Expan_GestionSolicitudes::PARADA_ZONA_NO_INTERES;
                        }
                    } else {
                        
                         $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entra en pedir correo ');
                        $bean -> creaLlamada('[AUT]Pedir correo', 'SolCorreo',0);
                    }
                }
                if ($bean -> envio_documentacion != null) {
                    $bean -> chk_envio_documentacion = true;
                }

                //Paso a estado Resolucion de dudas
                if ($resolucion_dudas_ant != $bean -> chk_resolucion_dudas && $bean -> chk_resolucion_dudas == true) {
                    $mayorCheck = 3;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Estamos mocificando Resolucion dudas');
                    if ($bean -> f_resolucion_dudas == $fecha_resolucion_dudas_ant) {
                        $bean -> f_resolucion_dudas = $fechaHoy->format('d/m/Y H:i');                            
                    }
                }
                if ($bean -> f_resolucion_dudas != null) {
                    $bean -> chk_resolucion_dudas = true;
                }

                //Paso a estado Solicitud ampliacion información
                if ($sol_amp_info_ant != $bean -> chk_sol_amp_info && $bean -> chk_sol_amp_info == true) {
                    $mayorCheck = 3;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Estamos mocificando Ampliacion de información');
                    if ($bean -> f_sol_amp_info == $fecha_sol_amp_info_ant) {                                                         
                        $bean -> f_sol_amp_info = $fechaHoy->format('d/m/Y H:i');                           
                    }
                }
                if ($bean -> f_sol_amp_info != null) {
                    $bean -> chk_sol_amp_info = true;
                }

                //Actualizamos los check y fecha Responde C1
                if ($responde_C1_ant != $bean -> chk_responde_C1 && $bean -> chk_responde_C1 == true) {
                    $mayorCheck = 2;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Cambio a chk_responde_C1');
                //    $bean -> crearTarea("DOCURevCorreo");

                    if ($bean -> f_responde_C1 == $fecha_respuesta_C1) {
                        $bean -> f_responde_C1 = $fechaHoy->format('d/m/Y H:i');
                    }
                }
                if ($bean -> f_responde_C1 != null) {
                    $bean -> chk_responde_C1 = true;
                }

                //Tenemos que realizar el ENVIO C2
                if ($informacion_adicional_ant != $bean -> chk_informacion_adicional && $bean -> chk_informacion_adicional == true) {
                    $mayorCheck = 4;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entramos Envio 2');

                    $bean -> preparaCorreo("C2");
                    
                    if ($bean -> f_informacion_adicional == $fecha_envio_informacion_adicional_ant) {
                        $bean -> f_informacion_adicional = $fechaHoy->format('d/m/Y H:i');
                    }

                    // $bean -> creaLlamada('[AUT]Infor adicional enviada', 'InformacionAdicional');

                }
                if ($bean -> f_informacion_adicional != null) {
                    $bean -> chk_informacion_adicional = true;
                }

                //Actualizo REALIZAMOS ENVÍO C 1.3
                if ($recepcio_cuestionario_ant != $bean -> chk_recepcio_cuestionario && $bean -> chk_recepcio_cuestionario == true) {
                    $mayorCheck = 5;

                    $bean -> preparaCorreo("C1.3");

                    if ($bean -> f_recepcion_cuestionario == $fecha_recepcion_cuestionario_ant) {
                        $bean -> f_recepcion_cuestionario = $fechaHoy->format('d/m/Y H:i');
                    }

                    $bean -> crearTarea("DOCURevCu");
                    //$bean -> creaLlamada('[AUT]Recepcion cuestionario', 'Cuestionario');

                }
                if ($bean -> f_recepcion_cuestionario != null) {
                    $bean -> chk_recepcio_cuestionario = true;
                }

                //Actualizamos los check y fecha ENTREVISTA
                if ($entrevista_ant != $bean -> chk_entrevista && $bean -> chk_entrevista == true) {
                    $mayorCheck = 6;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Cambio a entrevista');
                    if ($bean -> f_entrevista == $fecha_entrevista_ant) {
                        $bean -> f_entrevista = $fechaHoy->format('d/m/Y H:i');
                        $solicitud -> actualizarEntrevista($bean -> f_entrevista);
                    }
                }
                if ($bean -> f_entrevista != null) {
                    $bean -> chk_entrevista = true;
                    $solicitud -> actualizarEntrevista($bean -> f_entrevista);
                }
                
                //Actualizamos los check y fecha envio propuesta Zona
                if ($propuesta_zona_ant != $bean ->chk_propuesta_zona && $bean -> chk_propuesta_zona == true) {
                    $mayorCheck = 7;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] zna propuesta');
                    if ($bean -> f_propuesta_zona == $fecha_propuesta_zona_ant) {
                        $bean -> f_propuesta_zona = $fechaHoy->format('d/m/Y H:i');                        
                    }
                    
      /*               //Marcamos también el precontrato
                    
                    if ($bean -> chk_envio_precontrato != true){
                        $bean -> chk_envio_precontrato=true;
                                        
                        if ($bean -> f_envio_precontrato == null){
                            $bean -> f_envio_precontrato = $fechaHoy->format('d/m/Y H:i');
                        }
                        $bean -> preparaCorreo("C3");
                        $bean -> crearTarea("DOCUPerPre");
                    }*/
                    
                }
                if ($bean -> f_propuesta_zona != null) {
                    $bean -> chk_propuesta_zona = true;
                }

                //Actualizamos los check y fecha visitado fran
                if ($visitado_fran_ant != $bean -> chk_visitado_fran && $bean -> chk_visitado_fran == true) {
                    $mayorCheck = 8;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Cambio a estado fran ant');

                    if ($bean -> f_visitado_fran == $fecha_visitado_fran_ant) {
                        $bean -> f_visitado_fran = $fechaHoy->format('d/m/Y H:i');
                    }                    
                }
                if ($bean -> f_visitado_fran != null) {
                    $bean -> chk_visitado_fran = true;
                }

                //Tenemos que realizar el ENVIO C 3
                if ($envio_precontrato_ant != $bean -> chk_envio_precontrato && $bean -> chk_envio_precontrato == true) {
                    $mayorCheck = 9;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entramos Envio 3');
                    $bean -> preparaCorreo("C3");
                    
                    //PIDE RUBEN ELIMINAR LA TAREA PROGRAMADA 18/7/2017
                   // $bean -> crearTarea("DOCUPerPre");

                    if ($bean -> f_envio_precontrato == $fecha_envio_precontrato_ant) {
                        $bean -> f_envio_precontrato = $fechaHoy->format('d/m/Y H:i');
                    }
                    
                    $customdate = DateTime::createFromFormat('d/m/Y', $bean->f_envio_precontrato);
                    if ($customdate==false){
                        $customdate = DateTime::createFromFormat('Y-m-d', $bean->f_envio_precontrato);
                    }
                    $duedate = $customdate->add(new DateInterval('P20D'));
                    
                    $bean-> fecha_precontrato_minima= $duedate->format('d/m/Y');
                }
                if ($bean -> f_envio_precontrato != null) {
                    $bean -> chk_envio_precontrato = true;
                }

                //Actualizamos los chexk y fecha de visita al local
                if ($visita_local_ant != $bean -> chk_visita_local && $bean -> chk_visita_local == true) {
                    $mayorCheck = 10;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Estado 6');

                    $bean -> crearTarea("DOCURevLoc");

                    if ($bean -> f_visita_local == $fecha_visita_local_ant) {
                        $bean -> f_visita_local = $fechaHoy->format('d/m/Y H:i');
                    }
                }
                if ($bean -> f_visita_local != null) {
                    $bean -> chk_visita_local = true;
                }
                
                
                if ($f_entrega_cuenta_pre_ant!= $bean->f_entrega_cuenta_pre && 
                    $bean->f_entrega_cuenta_pre!=""){
                        
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Hay entrega a cuenta');                                                                                                                      
                        
                    $envioAutoCorreos= new EnvioAutoCorreos();
                    
                    $addresses['0']['email_address']="administracion@expandenegocio.com";
                    $addresses['1']['email_address']=$franquicia->correo_general;
                    $rcp_name="Administracion ExpandeNegocio";
                    $salida=$envioAutoCorreos->rellenacorreoFicha("FPC","cons",$rcp_name,$addresses,$solicitud,$franquiciaid,$bean,null);
                    
                    $bean->chk_precontrato_firmado=1;
                }  
                
                
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]chk_firmado-'.$bean->chk_precontrato_firmado);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]chk_firmado Antes-'.$chk_precontrato_firmado_ant);
                
                //Si se firma precontrato se envía el C4
                if($bean->chk_precontrato_firmado==1 && $chk_contrato_firmado_ant!=$bean->chk_precontrato_firmado){
                    
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Nuevo precontrato firmado');                                            
                    
                    if ($bean->chk_envio_contrato!=1) {  
                        $bean->preparaCorreo("C4");
                        $bean -> crearTarea("DOCUPerCon");
                        $bean -> chk_envio_contrato=1;
                        if ($bean -> f_envio_contrato == $fecha_envio_contrato_ant) {
                            $bean -> f_envio_contrato = $fechaHoy->format('d/m/Y H:i');
                        }
                    }
                    
                    $bean->estado_sol=Expan_GestionSolicitudes::ESTADO_POSITIVO;
                    $bean->motivo_positivo=Expan_GestionSolicitudes::POSITIVO_PRECONTRATO;                                      
                }                            

                //Tenemos que realizar ENVIO C4 y crear apertura
                if ($envio_contrato_ant != $bean -> chk_envio_contrato && $bean -> chk_envio_contrato == true) {
                    $mayorCheck = 11;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entramos Envio 4');

                    $bean -> preparaCorreo("C4");
                    $bean -> crearTarea("DOCUPerCon");

                    if ($bean -> f_envio_contrato == $fecha_envio_contrato_ant) {
                        $bean -> f_envio_contrato = $fechaHoy->format('d/m/Y H:i');
                    }
                }
                if ($bean -> f_envio_contrato != null) {
                    $bean -> chk_envio_contrato = true;
                }
                
                //Envío e correo de local aprobado
                if ($chk_aprobacion_local_ant != $bean->chk_aprobacion_local && $bean ->chk_aprobacion_local == true){                 
                    $bean -> preparaCorreo("LA");  
                    if ($bean -> f_aprobacion_local == $fecha_aprobacion_local_ant) {
                        $bean -> f_aprobacion_local = $fechaHoy->format('d/m/Y H:i');
                    }                  
                }                              
                if ($bean -> f_aprobacion_local != null) {
                    $bean -> chk_aprobacion_local = true;
                }

                if ($visita_central_ant != $bean -> chk_visita_central && $bean -> chk_visita_central == true) {
                    $mayorCheck = 12;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Estado 8');
                    if ($bean -> f_visita_central == $fecha_visita_central_ant) {
                        $bean -> f_visita_central = $fechaHoy->format('d/m/Y H:i');
                    }

                    $bean -> creaReunion("Visita a la central", "VisCentral", 0);
                }
                if ($bean -> f_visita_central != null) {
                    $bean -> chk_visita_central = true;
                }
                
                //CReamos llamada si se checkea posible colaboración
                if ($posible_colabora_ant != $bean -> chk_posible_colabora && $bean -> chk_posible_colabora == true){
                    $mayorCheck = 13;
                }               
                
                //Si se firma precontrato se crea apertura y se envía el C4
                if($bean->chk_contrato_firmado==1 && $chk_contrato_firmado_ant!=$bean->chk_contrato_firmado){

                  $nameAperura=$solicitud->first_name." ".$solicitud->last_name."-".$franquicia->name;
                  Expan_Apertura::PreparaApertura($nameAperura,$solicitud,$bean);
                    
                    $bean->estado_sol=Expan_GestionSolicitudes::ESTADO_POSITIVO;
                    $bean->motivo_positivo=Expan_GestionSolicitudes::POSITIVO_CONTRATO;                                      
                } 
                
                //Creamos la llamadas

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] MayorCheck' . $mayorCheck);

                switch ($mayorCheck) {
                    case 1 :
                        if (!($bean->tipo_origen==Expan_GestionSolicitudes::TIPO_ORIGEN_CENTRAL &&
                            $bean->subor_central==Expan_GestionSolicitudes::TIPO_SUBORIGEN_CENTRAL_BB_ANT )){
                                $bean -> creaLlamada('[AUT]Primera llamada', 'Primera',0);
                            }                        
                        break;
                    case 2 :
                        $bean -> creaLlamada('[AUT]Resolucion primeras dudas', 'ResPriDuda',0);
                        break;
                    case 3 :
                        $bean -> creaLlamada('[AUT]Resolucion primeras dudas', 'ResPriDuda',1);
                        break;
                    case 4 :
                        $bean -> creaLlamada('[AUT]Llamada envio documentacion adicional', 'InformacionAdicional',0);
                        break;
                    case 5 :
                        $bean -> creaLlamada('[AUT]Recepcion cuestionario', 'Cuestionario',0);
                        break;
                    case 6 :
                        $bean -> creaLlamada('[AUT]Resolucion nuevas dudas', 'GESTReun',0);
                        break;
                    case 7 :    
                        
                        break;
                    case 8 :
                        $bean -> creaLlamada('[AUT]Llamada Visita Franquicia', 'VisitaF',0);
                        break;
                    case 9 :
                        $bean -> creaLlamada('[AUT]Llamada envio precontrato', 'SegPre',0);
                        break;
                    case 10 :
                        $bean -> creaLlamada('[AUT]Llamada locales', 'Locales',0);
                        break;
                    case 11 :
                        $bean -> creaLlamada('[AUT]Llamada Contrato', 'Contrato',0);
                        break;
                    case 12 :
                        $bean -> creaLlamada('[AUT]Puertas abiertas', 'PAbiertas',0);
                        break;
                    case 13 :
                        $bean -> creaLlamada('[AUT]De seguimiento', 'GESTSeg',0);
                        $fran = new Expan_Franquicia();
                        $fran -> retrieve($bean -> franquicia);
                        $nombre="[AUT]Pasar colaborador";
                        $fran -> creaLlamadaRecor($nombre,'PasarColaborador');
                        break;                        
                }
                
                //Si volvemos de parado añadimos un texto
                if($estadoAnt==Expan_GestionSolicitudes::ESTADO_PARADO){
                    $bean->observaciones_informe=$bean->observaciones_informe.$fechaHoy->format('d/m/Y').' : Pasamos a estado en curso \n';
                }

               if ($chk_entrevista_previa_ant!=$bean->chk_entrevista_previa && $bean->chk_entrevista_previa==1){
                 $bean->activarEntPrevia();
               }
                
                //Los demas estados que no son el dos
            } else {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entra otros estados');
                if (($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PRECANDIDATO && $estadoAnt!=$bean -> estado_sol &&
                    $bean ->subestado_precandidato == Expan_GestionSolicitudes::ESTADO_PRE_ENV_MAILING) ||
                  ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PRECANDIDATO && $bean ->subestado_precandidato!=$subPreAnt &&
                    $bean ->subestado_precandidato == Expan_GestionSolicitudes::ESTADO_PRE_ENV_MAILING)
                ) {
                  $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Entra envio C0.1');
                  $salida = $bean -> preparaCorreo("C0.1");
                }
                
                //Si pasamos a un estado positivo caida
                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO && 
                    $bean -> motivo_positivo=='CaiPre' &&
                    $bean -> motivo_positivo!=$motivoPositivoAnt)
                {    
                    $bean->estado_sol=Expan_GestionSolicitudes::ESTADO_DESCARTADO;
                    $bean->motivo_descarte=Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_CAIDA_COLABORA;                    
                }
                  //Si se cae un contrato se debe cerrar la apertura
                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO &&
                  $bean -> motivo_positivo=='CaiCon' &&
                  $bean -> motivo_positivo!=$motivoPositivoAnt)
                {
                  $aperturaId=$bean->getApertura();
                  if ($aperturaId!=''){
                    $apertura= new Expan_Apertura();
                    $apertura->retrieve($aperturaId);

                    $apertura->abierta=Expan_Apertura::ABIERTO_NO;
                    $apertura->save();
                  }
                }

                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO &&
                    $bean -> motivo_positivo=='Cont' &&
                  ($bean -> motivo_positivo!=$motivoPositivoAnt || estado_sol!=$estadoAnt))
                {
                  $GLOBALS['log']->info('[ExpandeNegocio][creacionGestionSolicitud]Tiene condiciones para apertura');
                  $nameAperura=$solicitud->first_name." ".$solicitud->last_name."-".$franquicia->name;
                  Expan_Apertura::PreparaApertura($nameAperura,$solicitud,$bean);
                }


                if ($bean->estado_precontrato== "PTE" && 
                $bean->estado_precontrato!=$estadPreconAnt){
                     $envioCorreos = new EnvioAutoCorreos();
                     $rcpt_name="Ruben Calleja";
                     $addresses=array("ruben@expandenegocio.com"=>"ruben@expandenegocio.com");
                     $subject="Nuevo precontrato para firmar";
                     $body="Hay un nuevo precontrato por firmar <br><br>";
                     $body=$body."<a href='www.expandenegocio.com/index.php?module=Expan_GestionSolicitudes&action=DetailView&record=".$bean->id."'>Enlace a la gestion</a>";
                     $fromName="Info Expandenegocio";
                     $cuentaCor="info@expandenegocio.com";
                     $idTemp='null';                     
                     $envioCorreos->sendMessageV2($rcpt_name, $addresses, $subject, $body, $fromName, $cuentaCor, $idTemp);   
                     $bean -> crearTarea("FIRMAPre");                
                }             
                
                //Si pasamos a un estado (descartado)
                if (($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO 
                    || $bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO) &&
                    ($bean -> estado_sol!=$estadoAnt)) {
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Archivamos llamadas');
                    $bean -> archivarLLamadas();
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Archivamos Tareas');
                    $bean -> archivarTareas(); //Se ha cambiado varias veces de opinión (inicial mente se quitaron, luego se añadieron y ahora se quitan de nuevo)
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Archivamos Reuniones');
                    $bean -> archivarReuniones();
                    
                }

                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO &&
                  $bean -> estado_sol!=$estadoAnt && $bean -> f_reactivacion_parado != null){
                  $bean -> f_reactivacion_parado = null;
                }

                //Si no localizamos para una gestión, debemos de pasar el resto de gestiones de la solicitud al mismo estado
                //4 - No localizado
                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO && 
                    $bean -> motivo_parada == Expan_GestionSolicitudes::PARADA_NO_LOCALIZADO &&                    
                    $estadoAnt==Expan_GestionSolicitudes::ESTADO_EN_CURSO) {
                    if ($solicitud != null) {                                                
                        $solicitud -> PasarGestionesSubEstado(Expan_GestionSolicitudes::ESTADO_PARADO,Expan_GestionSolicitudes::PARADA_NO_LOCALIZADO);
                        $solicitud -> EliminarLLamadas('Planned');
                        $solicitud -> EliminarTareas('Not Started');
                    }
                }

                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO && 
                    $bean -> motivo_parada == Expan_GestionSolicitudes::PARADA_DATOS_ERRORNEOS &&                    
                    $estadoAnt==Expan_GestionSolicitudes::ESTADO_EN_CURSO) {
                    if ($solicitud != null) {
                        $bean -> preparaCorreo("C1.4");
                    }
                }
                    
                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO && 
                    $bean -> motivo_parada == Expan_GestionSolicitudes::PARADA_ZONA_NO_INTERES &&
                    $bean -> estado_sol!=$estadoAnt) {
                    if ($solicitud != null) {
                        $bean -> preparaCorreo("C1.2");
                    }
                }    
                
                //si ha pasado a descartado con motivo, monta franquicia, se debe crear el franquiciado si es que no existía
                if($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO && 
                  ($bean -> motivo_descarte == Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_MISMO_SECTOR||
                    $bean -> motivo_descarte == Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_OTRO_SECTOR) &&
                    $bean -> estado_sol!=$estadoAnt){

                    Expan_Apertura::PreparaAperuraCompetencia($solicitud,$bean);
                }

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]tion no Estado 2');

                //Lo guardamos porque al estar desabilitados los checks, sugar los guarda vacios

                $bean -> chk_envio_documentacion = $envio_documentacion_ant;
                $bean -> chk_recepcio_cuestionario = $recepcio_cuestionario_ant;
                $bean -> chk_informacion_adicional = $informacion_adicional_ant;
                $bean -> chk_resolucion_dudas = $resolucion_dudas_ant;
                $bean -> chk_responde_C1 = $responde_C1_ant;
                $bean -> chk_entrevista = $entrevista_ant;
                $bean -> chk_visitado_fran = $visitado_fran_ant;
                $bean -> chk_envio_precontrato = $envio_precontrato_ant;
                $bean -> chk_visita_local = $visita_local_ant;
                $bean -> chk_envio_contrato = $envio_contrato_ant;
                $bean -> chk_visita_central = $visita_central_ant;

            }

            $bean -> calcAvanzado();
            $bean -> calcCaliente();
            $bean -> calcCorto();
            $bean -> procesarObservaciones();
            
            //Si pasamos a caliente o avanzada pero antes no lo eran
            if ($cand_cal_ant==0 && $cand_avan_ant==0 && 
                ($bean->candidatura_caliente==1 || $bean->candidatura_avanzada==1)){
                $bean->peparaEnvioFichaAuto();
            }            
            
            //Si tenemos precontrato relleno creamos una tarea           
            
            if ($pre_fir1_first_name_ant!=$bean ->pre_fir1_first_name && $bean ->pre_fir1_first_name!=""){
                $bean -> crearTarea("DOCUPerPre");
            }
            
            if ($chk_gestionado_central_ant!= $bean->chk_gestionado_central && $bean->chk_gestionado_central==1){
                $bean -> creaLlamada('[AUT]Reportar a Central de candidato', 'FRANRepCent',10);
            }

            if ($solicitud != null) {

                $solicitud -> actualizaEstadoAECP();

                //Tengo que pasar la candidatura caliente a las solicitudes
                $solicitud -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

                $solicitudCaliente = $bean -> candidatura_caliente;
                $solicitudAvanzada = $bean -> candidatura_avanzada;

                foreach ($solicitud->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestionHermana) {
                    if ($gestionHermana -> id != $bean -> id) {
                        if ($gestionHermana -> candidatura_caliente == true) {
                            $solicitudCaliente = true;
                        }
                        if ($gestionHermana -> candidatura_avanzada == true) {
                            $solicitudAvanzada = true;
                        }
                    }
                }
                //Actualizamos la solicitud
                $solicitud -> candidatura_caliente = $solicitudCaliente;
                $solicitud -> candidatura_avanzada = $solicitudAvanzada;

                //Cambios de asignacion                
                if ($usuario_ant != $bean -> assigned_user_id) {
                    $bean ->asignarAccionesUsuario($bean -> assigned_user_id);                        
                }else{                                   
                    //Candidatura Avanzada->director de cuenta
                    if ($bean -> candidatura_avanzada == true && $cand_avan_ant != $bean -> candidatura_avanzada){                                                                   
                        $bean -> asignarGestor();                        
                    } 
                }

                if ($bean->cuando_empezar!='' && $bean->cuando_empezar!=null &&
                    $solicitud->cuando_empezar!='' && $solicitud->cuando_empezar!=null){
                  $bean->cuando_empezar=$solicitud->cuando_empezar;
                }

                $bean -> ignore_update_c = true;
                $bean -> save();

                //Miramos si se ha cerrado una gestion de franquicia principal
                $solicitud -> pasaFranqiciaPrincipal();
                $solicitud -> actualizaRating();

                $solicitud -> ignore_update_c = true;
                $solicitud -> save();
                $prioridad=$bean -> calcularPrioridades();
                $bean->prioridad=$prioridad;
                //$solicitud -> prioridad=$prioridad;
            }

        }
    
    }

}