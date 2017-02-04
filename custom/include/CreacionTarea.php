<?php
require_once ('data/SugarBean.php');
require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once ('modules/Expan_Franquicia/Expan_Franquicia.php');
require_once ('modules/Tasks/Task.php');

class controlTareas {

    protected static $fetchedRow = array();
    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments) {
        if ($bean -> fetched_row) {
            self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
        }
    }

    public function modTareas(&$bean, $event, $arguments) {

        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
            $bean->ignore_update_c = true;           

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Tipo del que cuelga-' . $bean -> parent_type);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]ID del padre-' . $bean -> parent_id);

            $gestion = null;
            $franquicia = null;

            if ($bean -> parent_type = 'Expan_GestionSolicitudes') {
                $gestion = new Expan_GestionSolicitudes();
                $gestion -> retrieve($bean -> parent_id);

                $franquicia = new Expan_Franquicia();
                $franquicia -> retrieve($gestion -> franquicia);

            } else {
                $franquicia = new Expan_Franquicia();
                $franquicia -> retrieve($bean -> parent_id);
            }

            if (!isset(self::$fetchedRow[$bean -> id])) {
                //Tarea nueva

            } else {
                //Tarea Modificada

            }

            //Si la Tarea se ha realizado ya no puede estar como oportunidad

            if ($gestion != null) {
                $solicitud = $gestion -> GetSolicitud();
                
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Nombre Solicitud-' . $solicitud->name);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Nombre Solicitud-' . $bean -> status);
                
                if ($bean -> status != 'Not Started') {
                    $bean -> oportunidad_inmediata == false;
                }
                if ($solicitud!=null){                                       
                    
                    $this->controlOpInmediata($gestion,$solicitud);
                    
                    $gestion-> ignore_update_c = true;
                    $gestion->save();
                    $solicitud -> ignore_update_c = true;
                    $solicitud->save();
                    $gestion->calcularPrioridades();
                    $bean->assigned_user_id=$gestion->assigned_user_id; 
                }
            }
            //Si la tarea es de tipo Franquicia
            if (substr($bean -> task_type, 0, 4) == 'FRAN') {

                $franquicia -> load_relationship('expan_franquicia_tasks_1');
                $franquicia -> expan_franquicia_tasks_1 -> add($bean -> id);
                $franquicia->save_relationship_changes(true);
                $bean->assigned_user_id=$franquicia->assigned_user_id;
            }           
            if ($bean->parent_type=='Expan_GestionSolicitudes'){
                $bean -> name = $gestion -> name . ' - ' . $GLOBALS['app_list_strings']['tipo_tarea_list'][$bean -> task_type];    
            }else{
                $bean -> name = $franquicia -> name . ' - ' . $GLOBALS['app_list_strings']['tipo_tarea_list'][$bean -> task_type];
            }
            

            //Guardo al final
            
            $bean -> ignore_update_c = true;
            $bean -> save();

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Se ha guardado la Tarea');
        }

    }

    function ActualizarRel(&$bean, $event, $arguments ){
        
        //NO BORRAR
    }


    function tareasHermanasOportunidadInmediata($Gestion, $estado) {

        $db = DBManagerFactory::getInstance();
        $query = "select oportunidad_inmediata from tasks where parent_id='" . $Gestion -> id . "' and status='" . $estado . "'";

        $result = $db -> query($query, true);

        $opIn = false;

        while ($row = $db -> fetchByAssoc($result)) {
            if ($row["oportunidad_inmediata"] == 1) {
                return true;
            }
        }
        return $opIn;
    }
    
    function controlOpInmediata(&$gestion,&$solicitud){
        if ($this -> tareasHermanasOportunidadInmediata($gestion, "Not Started")) {
                        
            if ($solicitud -> tieneLlamadasPendientes() == true || 
                $solicitud -> tieneReunionesPendientes() == true || 
                $solicitud -> tieneTareasPendientes() == true) {

                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Activamos OI');

                    $gestion -> oportunidad_inmediata = true;
                    $solicitud -> oportunidad_inmediata = true;

            } else {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Desactivamos OI-1');
                $gestion -> oportunidad_inmediata = false;
                $solicitud -> oportunidad_inmediata = false;
            }
        
        } else {
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Desactivamos OI-2');
            $gestion -> oportunidad_inmediata = false;
            $solicitud -> oportunidad_inmediata = false;
        }
    }

}
?>
