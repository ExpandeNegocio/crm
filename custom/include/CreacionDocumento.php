<?php
    require_once ('data/SugarBean.php');
   
    class AccionesGuardadoDocumento {
        
        protected static $fetchedRow = array();              
        
        /**
         * Called as before_save logic hook to grab the fetched_row values
         */
        public function saveFetchedRow($bean, $event, $arguments) {
            if ($bean -> fetched_row) {
                self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
            }
        }
    
        public function ModificacionDocumento(&$bean, $event, $arguments) {

             if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
                $bean->ignore_update_c = true;                           
            
               //Creacion de un nuevo Documento
                if (!isset(self::$fetchedRow[$bean -> id])) {
            
                //Modificamos el Documento
                }else{                    
                    $is_validAnt=self::$fetchedRow[$bean -> id]['is_valid'];
                    $is_validAct=$bean->is_valid;
                    
                    // Si se modifica el check
                    if ($is_validAnt!=$is_validAct){
                        $this->activarChecksFranquicia($bean->id,$is_validAct);                                               
                    }
                }
             }    
        }

        private function activarChecksFranquicia($docId,$act) {
            
            $db = DBManagerFactory::getInstance();
            
            $query = "select t.franquicia,t.type  ";
            $query=$query."from documents d, documents_notes dn, email_templates t, notes n ";
            $query=$query."where n.parent_id=t.id AND n.id=dn.note_id AND  ";
            $query=$query."  d.id=dn.document_id AND t.deleted=0 AND n.deleted=0 AND d.id='".$docId."'; ";
                                       
            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {
                $franquiciaId = $row["franquicia"];
                if ($franquiciaId!=null){
                    
                   $franquicia= new Expan_Franquicia();
                   $franquicia->retrieve($franquiciaId);
                   
                   $type= $row["type"];
                   
                   $typeOk=false;
                    
                   switch ($type) {                                                                                                                      
                        case 'C1':
                            $franquicia->chk_c1=$act;
                            $typeOk=true;
                            break;
                        case 'C2':
                            $franquicia->chk_c2=$act;
                            $typeOk=true;
                            break;
                        case 'C3':
                            $franquicia->chk_c3=$act;
                            $typeOk=true;
                            break;
                        case 'C4':
                            $franquicia->chk_c4=$act;
                            $typeOk=true;
                            break;
                        case 'C1.1':
                            $franquicia->chk_c11=$act;
                            $typeOk=true;
                            break;
                        case 'C1.2':
                            $franquicia->chk_c12=$act;
                            $typeOk=true;
                            break;
                        case 'C1.3':
                            $franquicia->chk_c13=$act;
                            $typeOk=true;
                            break;
                        case 'C1.4':
                            $franquicia->chk_c14=$act;
                            $typeOk=true;
                            break;
                        case 'C1.5':
                            $franquicia->chk_c15=$act;
                            $typeOk=true;
                            break;                                            
                   }

                    if ($typeOk==true){
                        $franquicia->ignore_update_c=false;
                        $franquicia->save();
                        if ($act==false){                       
                            $franquicia->crearTarea('INTPlantilla');                       
                        }
                    }                                    
                }               
            }           
        }               
    }
?>