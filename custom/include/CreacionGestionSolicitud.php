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

        $LINEA = '#-------------------------------------------------------#';

        //Comprobacion de bulce infinito
        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {                       
            
            $bean->ignore_update_c = true;
            $fechaHoy=  new DateTime();

            $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Entramos en control bucle');

            //debemos distinguir cuando estamos creanado una nueva GestionSolicitud

            $db = DBManagerFactory::getInstance();
            $query = "select * from expan_gestionsolicitudes where id='" . $bean -> id . "'";

            $result = $db -> query($query, true);

            $estadoAnt = "";

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

                $cand_cal_ant = $row["candidatura_caliente"];
                $cand_avan_ant = $row["candidatura_avanzada"];

                $usuario_ant = $row["assigned_user_id"];

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

            //Miramos si la GestionSolicitud a la que pasamos es de tipo 2
            if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO) {
                          
                $mayorCheck = 0;                                                                                 

                $bean -> ignore_update_c = true;

                //Recogemos el telefono de la solicitud

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Previo a recoge telefono');

                if ($solicitud != null) {
                    $telefono = $solicitud -> recogerTelefono();
                }

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Despues de recoger telefono');

                //Si el estado cambia
                // REALIZAMOS ENVÍO C 1
                if ($estadoAnt != $bean -> estado_sol && ($bean -> chk_envio_documentacion == null)) {
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
                                } elseif ($salida == "Alguno de los correos no han sido enviados. La plantilla no existe" || $salida == "La plantilla de envío no está validada" || $salida == "Los correos no se han enviado porque el usuario no quería recibirlos." || $salida == "Alguno de los correos no han sido enviados. Posiblemente el correo no sea válido.") {
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
                        $bean -> creaLlamada('[AUT]Pedir correo', 'SolCorreo');
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
                    $mayorCheck = 2;
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

                    $salida=$bean -> preparaCorreo("C2");

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

                //Actualizamos los chexk y fecha ENTREVISTA
                if ($entrevista_ant != $bean -> chk_entrevista && $bean -> chk_entrevista == true) {
                    $mayorCheck = 6;
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] Cambio a entrevista');
                    if ($bean -> f_entrevista == $fecha_entrevista_ant) {
                        $bean -> f_entrevista = $fechaHoy->format('d/m/Y H:i');
                    }
                }
                if ($bean -> f_entrevista != null) {
                    $bean -> chk_entrevista = true;
                }
                
                //Actualizamos los chexk y fecha envio propuesta Zona
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
                            $bean -> f_envio_precontrato = TimeDate::getInstance()->nowDb();
                        }
                        $bean -> preparaCorreo("C3");
                        $bean -> crearTarea("DOCUPerPre");
                    }*/
                    
                }
                if ($bean -> f_propuesta_zona != null) {
                    $bean -> chk_propuesta_zona = true;
                }

                //Actualizamos los chexk y fecha visitado fran
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

                //Tenemos que realizar ENVIO C4
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
                

                //Creamos la llamadas

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud] MayorCheck' . $mayorCheck);

                switch ($mayorCheck) {
                    case 1 :
                        $bean -> creaLlamada('[AUT]Primera llamada', 'Primera');
                        break;
                    case 2 :
                        $bean -> creaLlamada('[AUT]Resolucion primeras dudas', 'ResPriDuda');
                        break;
                    case 3 :
                        $bean -> creaLlamada('[AUT]Resolucion primeras dudas', 'ResPriDuda');
                        break;
                    case 4 :
                        $bean -> creaLlamada('[AUT]Llamada envio documentacion adicional', 'InformacionAdicional');
                        break;
                    case 5 :
                        $bean -> creaLlamada('[AUT]Recepcion cuestionario', 'Cuestionario');
                        break;
                    case 6 :
                        $bean -> creaLlamada('[AUT]Resolucion nuevas dudas', 'ResNueDudas');
                        break;
                    case 7 :    
                        
                        break;
                    case 8 :
                        $bean -> creaLlamada('[AUT]Llamada Visita Franquicia', 'VisitaF');
                        break;
                    case 9 :
                        $bean -> creaLlamada('[AUT]Llamada envio precontrato', 'SegPre');
                        break;
                    case 10 :
                        $bean -> creaLlamada('[AUT]Llamada locales', 'Locales');
                        break;
                    case 11 :
                        $bean -> creaLlamada('[AUT]Llamada Contrato', 'Contrato');
                        break;
                    case 12 :
                        $bean -> creaLlamada('[AUT]Puertas abiertas', 'PAbiertas');
                        break;
                    case 13 :
                        $bean -> creaLlamada('[AUT]De seguimiento', 'GESTSeg');
                        $fran = new Expan_Franquicia();
                        $fran -> retrieve($bean -> franquicia);
                        $nombre="[AUT]Pasar colaborador";
                        $fran -> creaLlamadaRecor($nombre,'PasarColaborador');
                        break;                        
                }
                
                //Los demas estados que no son el dos
            } else {
                //Si pasamos a un estado (descartado)
                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO || $bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO) {
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud]Archivamos llamadas');
                    $bean -> archivarLLamadas();
                    //$bean -> archivarTareas(); //cambio no se archivan las tareas
                    $bean -> archivarReuniones();
                    
                }

                //Si no localizamos para una gestión, debemos de pasar el resto de gestiones de la solicitud al mismo estado
                //4 - No localizado
                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO && $bean -> motivo_parada == Expan_GestionSolicitudes::PARADA_NO_LOCALIZADO) {
                    if ($solicitud != null) {
                        $solicitud -> PasarGestionesEstado('4');
                        $solicitud -> EliminarLLamadas('Planned');
                        $solicitud -> EliminarTareas('Not Started');
                    }
                }

                if ($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO && $bean -> motivo_parada == Expan_GestionSolicitudes::PARADA_DATOS_ERRORNEOS) {
                    if ($solicitud != null) {
                        $salida = $bean -> preparaCorreo("C1.4");
                    }
                }
                
                //si ha pasado a descartado con motivo, monta franquicia, se debe crear el franquiciado si es que no existía
                if($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO && ($bean -> motivo_descarte == Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_MISMO_SECTOR||$bean -> motivo_descarte == Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_OTRO_SECTOR)){
                        
                    
                    $franquiciado= Expan_Franquiciado::existeFranquiciado($solicitud->id);
                    if($franquiciado==false){ //se crea el franquiciado
                        $franquiciado=Expan_Franquiciado::crearFranquiciado($solicitud);
                    }
                    $name=$solicitud-> first_name ." ".$solicitud->last_name. " - Franquicia Competencia";
                    if (Expan_Apertura::existeApertura($name)==false){
                        Expan_Apertura::crearApertura($name, $solicitud, $franquiciado);
                    }
                    
                }
                
                //Si pasamos a estados positivo, con motivo positivo-> contrato, se crea la apertura con los datos de la solicitud
                if($bean -> estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO && $bean -> motivo_positivo == Expan_GestionSolicitudes::POSITIVO_FRANQUICIADO){
                      
                    if(Expan_Apertura::existeApertura($bean->name)==false) {//no está creada la apertura
                        
                        $franquiciado=Expan_Franquiciado::existeFranquiciado($solicitud->id);
                        
                        if($franquiciado==false) {//se crea el franquiciado a partir de la solicitud, no existe
                            $franquiciado=Expan_Franquiciado::crearFranquiciado($solicitud);
                        }
                        Expan_Apertura::crearApertura($bean->name, $solicitud, $franquiciado);
                    
                    }   
                    
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

                $Fran = new Expan_Franquicia();
                $Fran -> retrieve($bean -> franquicia);

                //Candidatura Avanzada->director de cuenta
                if ($bean -> candidatura_avanzada == true && $cand_avan_ant != $bean -> candidatura_avanzada) {
                    //Si no cambiamos el usuario durante la edicion lo cambiamos al ser avanzada
                    if ($usuario_ant == $bean -> assigned_user_id) {
                        $bean -> assigned_user_id = $Fran -> assigned_user_id;
                        $bean -> asociarLLamadas("Planned", $Fran -> assigned_user_id);
                        $bean -> asociarTareas("Not Started", $Fran -> assigned_user_id);
                        $bean -> asociarReuniones("Planned", $Fran -> assigned_user_id);
                        $bean -> asociarReuniones("Could", $Fran -> assigned_user_id);
                    }
                } else {
                    //Si cambiamos al usuario a mano
                    if ($usuario_ant != $bean -> assigned_user_id) {
                        $bean -> asociarLLamadas("Planned", $bean -> assigned_user_id);
                        $bean -> asociarTareas("Not Started", $bean -> assigned_user_id);
                        $bean -> asociarReuniones("Planned", $Fran -> assigned_user_id);
                        $bean -> asociarReuniones("Could", $Fran -> assigned_user_id);
                    }
                }

                $bean -> ignore_update_c = true;
                $bean -> save();

                //Miramos si se ha cerrado una gestion de franquicia principal
                $solicitud -> pasaFranqiciaPrincipal();

                $solicitud -> ignore_update_c = true;
                $solicitud -> save();
                $prioridad=$bean -> calcularPrioridades();
                $bean->prioridad=$prioridad;
                //$solicitud -> prioridad=$prioridad;
            }

        }
    
    }

}
?>