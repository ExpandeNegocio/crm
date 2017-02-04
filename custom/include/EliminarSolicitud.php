<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    
    class AccionesEliminadoSol{
                
        function EliminarSol(&$bean, $event, $arguments){
            $bean->EliminarGestiones();
        }
        
    }
    
?>