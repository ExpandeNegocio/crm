<?php
require_once ('data/SugarBean.php');
require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once ('modules/Calls/Call.php');

class AccionesGuardadoTel {

    protected static $fetchedRow = array();
    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments) {
        if ($bean -> fetched_row) {
            self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
        }
    }

    public function AsignacionTelefono(&$bean, $event, $arguments) {

        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
            
            $bean->ignore_update_c = true;

            $db = DBManagerFactory::getInstance();

            //Recogemos la solicitud
            
            $prevStatus=self::$fetchedRow[$this -> id]['status'];

            $idSol = $bean -> LocalizaSolicitud();
            $solicitud = new Expan_Solicitud();
            $solicitud -> retrieve($idSol);
                        
            if ($bean->parent_type=='Expan_GestionSolicitudes'){                               
                $gestion = new Expan_GestionSolicitudes();
                $gestion -> retrieve($bean -> parent_id);    
                
                $franquicia = new Expan_Franquicia();
                $franquicia -> retrieve($gestion->franquicia);   
                            
            }else{                   
                $franquicia = new Expan_Franquicia();
                $franquicia -> retrieve($bean -> parent_id);                                           
            }

            //Creacion de una nueva llamada
            if (!isset(self::$fetchedRow[$bean -> id])) {
                if($bean -> parent_type=='Expan_Franquicia'){
                    $franquicia -> archivarLlamadas("Planned");
                }else{
                    $solicitud->ArchivarLLamadas("Planned");
                }
                
               
                $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion de llamada]Entro');
                $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion de llamada]Nombre - ' . $bean -> name);

                $bean -> telefono = $solicitud->phone_mobile;
                $bean -> franquicia = $gestion->franquicia;
                $bean -> origen = $gestion->tipo_origen;

                $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion de llamada]NumGestiones - ' . $solicitud -> NumGestiones());
                $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion de llamada]Cambia la hora');
                
                //Actualizamos la fecha de creacion
                $query = "UPDATE calls SET date_entered = UTC_TIMESTAMP() WHERE id = '" . $bean -> id . "'";
                $db = DBManagerFactory::getInstance();
                $result = $db -> query($query);       

                global $timedate;
                $bean->date_entered = $timedate->nowDb();

                //Puede venir ya relleno si esta creado de forma automatica
                if ($solicitud -> NumGestiones() > 1 && ($bean -> call_type == 'Primera' || 
                                                         $bean -> call_type == 'SolCorreo' ||
                                                         $bean -> call_type == 'InformacionAdicional'
                                                         )) 
                {
                    $bean -> gestion_agrupada = true;
                    $bean -> name = $solicitud -> name . ' - Gestion Agrupada - ' . $GLOBALS['app_list_strings']['tipo_llamada_list'][$bean -> call_type];
                } else {
                    if ($bean->parent_type=='Expan_GestionSolicitudes'){
                        $bean -> name = $gestion->name . ' - ' . $GLOBALS['app_list_strings']['tipo_llamada_list'][$bean -> call_type];
                    }else{                   
                        $bean -> name = $franquicia->name . ' - ' . $GLOBALS['app_list_strings']['tipo_llamada_list'][$bean -> call_type];
                    }
                }
              
                //Si esta asociada a una gestion
                if ($gestion!=null){
                    $bean->assigned_user_id=$gestion->assigned_user_id;
                    if ($bean->status=="Not Held"){                        
                        $bean->LlamadaNoRealizada($gestion);                                        
                    }                 
                }               

            } else{              

                //Modificacion de llamada existente                
                
                if ($solicitud -> NumGestionesEstado("2") > 1 && 
                    ($bean -> call_type == 'Primera' || $bean -> call_type == 'SolCorreo' || $bean -> call_type == 'InformacionAdicional') &&
                    ($gestion->tipo_origen == Expan_GestionSolicitudes::TIPO_ORIGEN_EVENTOS || 
                    $gestion->tipo_origen == Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO || 
                    $gestion->tipo_origen == Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES ||
                    $gestion->tipo_origen == Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO ))                    
                {
                    $bean -> gestion_agrupada = 1;
                    $bean -> name = $solicitud -> name . ' - Gestion Agrupada - ' . $GLOBALS['app_list_strings']['tipo_llamada_list'][$bean -> call_type];
                } else {
                    if ($bean -> parent_type=='Expan_GestionSolicitudes'){
                        $bean -> name = $gestion->name . ' - ' . $GLOBALS['app_list_strings']['tipo_llamada_list'][$bean -> call_type];
                    }else{                   
                        $bean -> name = $franquicia->name . ' - ' . $GLOBALS['app_list_strings']['tipo_llamada_list'][$bean -> call_type];                       
                    }
                }

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de llamada]Estado Anterior - ' . self::$fetchedRow[$bean -> id]['status']);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de llamada]Estado Nuevo - ' . $bean -> status);

                // si modificamos una gestion_agrupada debo cambiar el estado de las demas
                if ($bean -> gestion_agrupada == true) {
                    $solicitud -> ProcesarLLamadasAgrupadas($bean,$franquicia,$gestion,$solicitud,$prevStatus,$bean -> status);                     
                    return;                                                         
                }else{
                    $bean->procesarLLamadaModificada($gestion,$solicitud,$prevStatus,$bean->status);
                }                                                              

            }
            
            $bean->procesarLLamadaFinal($franquicia,$gestion,$solicitud);
            //$this -> archivarLlamadasPlanned($bean, $gestion, $solicitud);//Por si hay alguna duplicacion, se archivan las llamadas planificadas anteriores a esta.
                                                                          //Con esto no se deberían producir. Y si lo hicieran, cuando se crea un nueva se archivarán las anteriores
                                                                          //o cuando se modifique una de las llamadas planificadas también se archivarán las que hubiera. 
                                                                          //Evita el error o lo corrige si se da.
    
        }

    }
    //funcion para las llamadas!!
    function archivarLlamadasPlanned($bean, $gestion, $solicitud){
        
        $db = DBManagerFactory::getInstance();
        
        //coger la última llamada
        $query="select id from calls mi where mi.status='Planned' and mi.parent_id='".$gestion->id."' order by mi.date_entered DESC limit 1;";
        $result = $db -> query($query,true);
        $idLlamadaU="";
        
        while ($row = $db -> fetchByAssoc($result)) {
            $idLlamadaU=$row["id"];
        }
        
        $query="update calls c JOIN (SELECT g.id ";
        $query=$query. "FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs "; 
        $query= $query. "WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida "; 
        $query=$query."AND s.id = '".$solicitud->id."' and g.id='".$gestion->id."') t ";
        $query = $query. "on c.parent_id=t.id set c.status='Archived' where c.parent_id = t.id and status='Planned' and c.id <> '".$idLlamadaU."' "; 
        //revisar la llamada
        $result = $db -> query($query,true);
        
    }
    
    function ActualizarRel(&$bean, $event, $arguments) {

        //logic goes here;

        $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]Nombre - ' . $bean -> name);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]ID - ' . $bean -> id);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]Modulo - ' . $arguments['related_module']);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]ID - ' . $arguments['related_id']);

        //Actualizamo los
        $db = DBManagerFactory::getInstance();
        $query = "SELECT * ";
        $query = $query . " FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs,expan_gestionsolicitudes g ";
        $query = $query . " WHERE  g.id = gs.expan_soli5dcccitudes_idb AND ";
        $query = $query . " s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query = $query . " g.id = '" . $arguments['related_id'] . "'";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]SQL -' . $query);

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $bean -> telefono = $row["phone_mobile"];
            $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]Telefono - ' . $row['phone_mobile']);
        }

        $query = "select * from expan_gestionsolicitudes_calls_1_c where expan_gestionsolicitudes_calls_1calls_idb='".$bean->id."'";

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $bean -> parent_id = $row["expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida"];
            $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]Telefono - ' . $row['phone_mobile']);
        }

        if ($bean -> parent_type==null){
            $bean -> parent_type = $arguments['related_module'];
        }
        if ($bean -> parent_id==null){
            $bean -> parent_id = $arguments['related_id'];
        }

        //Si pasamos a no llamadao lo realizamos sobre el resto de las franquicias
      /*  if ($bean -> status == 'Not Held') {
            $this -> ControlNoLocalizado($bean);
        }*/

        $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]LLEga');
        
         //Actualizamos la fecha de creacion
        $query = "UPDATE calls SET date_entered = UTC_TIMESTAMP() WHERE id = '" . $bean -> id . "'";
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query);       
        
        //$bean -> ignore_update_c = true;
        $bean->save();

    }


    function NumLLamadasHermanas($Gestion, $estado, $tipo) {

        $db = DBManagerFactory::getInstance();
        $query = "select count(*) c from calls where parent_id='" . $Gestion -> id . "' and call_type='" . $tipo . "' and status='" . $estado . "'";

        $result = $db -> query($query, true);

        $numLlamadas = 0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numLlamadas = $row["c"];
        }
        return $numLlamadas;
    }
}
?>