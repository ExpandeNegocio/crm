<?php
require_once ('data/SugarBean.php');
require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once ('modules/Meetings/Meeting.php');

class AccionesGuardadoReunion {

    protected static $fetchedRow = array();
    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments) {
        if ($bean -> fetched_row) {
            self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
        }
        if ($bean->status=='Could'){
            $bean->date_start=null;
            $bean->date_end=null;
        }
    }

    public function AsignacionReunion(&$bean, $event, $arguments) {

        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
            
            $bean->ignore_update_c = true;
            
             if ($_REQUEST["relate_to"]=='Expan_Empresa'){
                $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion de Reunion]Relacionada con empresa');
                $bean->parent_type = $_REQUEST["relate_to"];
                $bean->parent_id= $_REQUEST["relate_id"];
                $bean->name= $GLOBALS['app_list_strings']['tipo_reunion_list'][$bean -> meeting_type];
                
                $bean ->save();
                return;
            }

            $db = DBManagerFactory::getInstance();

            //recogemos solicitud y gestion
            $solicitud = $bean -> GetSolicitud($bean);
            $gestion = $bean -> GetGestion($bean);           

            //Creacion de una nueva Reunion
            if (!isset(self::$fetchedRow[$bean -> id])) {

                $bean -> name = $gestion -> name . ' - ' . $GLOBALS['app_list_strings']['tipo_reunion_list'][$bean -> meeting_type];

                if ($bean -> provincia == null) {
                    $bean -> provincia -> $solicitud -> provincia_apertura_1;
                }

            }            
                       
            if ($gestion != null) {
                 //Si la Tarea se ha realizado ya no puede estar como oportunidad

               if ($bean->status=='Held'){
                   $gestion->chk_entrevista=1;
                   $gestion->f_entrevista="".date ("d/m/Y",strtotime($bean->date_start));
                   $gestion-> ignore_update_c = true;
                   $gestion->save();
               }       
               
               $gestion -> calcularOportunidadInmediata($this->oportunidad_inmediata);   
               if($solicitud!=null){
                   $solicitud -> calcularOportunidadInmediata();  
               }               
               $prioridad=$gestion->calcularPrioridades();

               $prioridad=$gestion->calcularPrioridades();
               $gestion->prioridad=$prioridad;

            }
            
            $durMinutos=$bean -> asignarTiempo($bean -> meeting_type);                        
            $bean -> duration_minutes = $durMinutos % 60;
            $bean -> duration_hours = floor($durMinutos / 60);             

            if ($bean->status=='Could'){
                $bean->date_start=null;
                $bean->date_end=null;
            }

            //Guardo al final
            $bean -> ignore_update_c = true;
            $bean -> save();
            
            if ($gestion != null) {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Reuion]Entra Modificar ERM');
                 //Creacion de una nueva tarea que se lleva al CRM
                if (!isset(self::$fetchedRow[$bean -> id])) {
                    $bean->addToERM();
                }else{
                    $bean->updateFromERM();
                }
            }

        }

    }

}
?>