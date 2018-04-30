<?php
    require_once ('data/SugarBean.php');
   
    class AccionesGuardadoRevisionDoc {
        
        protected static $fetchedRow = array();              
        
        /**
         * Called as before_save logic hook to grab the fetched_row values
         */
        public function saveFetchedRow($bean, $event, $arguments) {
            if ($bean -> fetched_row) {
                self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
            }
        }
    
        public function ModificacionRevDoc(&$bean, $event, $arguments) {
   
           echo 'Hola';
   
        }
        
        
    }
?>