<?php
require_once ('data/SugarBean.php');
require_once ('modules/Expan_Mailings/Expan_Mailings.php');
require_once ('modules/Expma_Mailing/Expma_Mailing.php');


class controlEnvios {

    protected static $fetchedRow = array();
    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments) {
        if ($bean -> fetched_row) {
            self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
        }
    }

    public function modEnvios(&$bean, $event, $arguments) {

        //Creación
        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {

            $bean->ignore_update_c = true;           

            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]Tipo del que cuelga-' . $bean -> parent_type);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Tarea]ID del padre-' . $bean -> parent_id);

            $mailing= new Expan_Mailings();
            $mailing->name=$bean->name;
            $mailing->plantilla=$bean->plantilla;
            $mailing->tipo="CRM";
            $mailing->fecha_envio=$bean->date_entered;            
            $mailing->envio= $bean->id;
                        
            $mailing->save();

        //Modificacion
        }else{
            
        }
    }

    function ActualizarRel(&$bean, $event, $arguments ){
        
        //NO BORRAR
    }

}
?>
