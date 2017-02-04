<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Calls/Call.php');
    
    class AccionesEliminadoGest {
    
        function EliminarGestion(&$bean, $event, $arguments) {                       
    
            $bean -> eliminarTodasLLamadas();
            $bean -> eliminarTodasTareas();
        }
    }
?>
