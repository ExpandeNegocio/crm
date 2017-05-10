<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_Franquicia/Expan_Franquicia.php');
    require_once ('modules/Calls/Call.php');

    class AccionesGuardadoFranq {
        
        protected static $fetchedRow = array();              
        
        /**
         * Called as before_save logic hook to grab the fetched_row values
         */
        public function saveFetchedRow($bean, $event, $arguments) {
            if ($bean -> fetched_row) {
                self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
            }
        }
    
        public function ModificacionFranq(&$bean, $event, $arguments) {
            
            if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
                $bean->ignore_update_c = true;

                $db = DBManagerFactory::getInstance();
            
               //Creacion de una nueva Franquicia
                if (!isset(self::$fetchedRow[$bean -> id])) {
            
                //Modificamos la franquicia
                }else{
                    
                    $filtroAnt=self::$fetchedRow[$bean -> id]['user_id1_c'];
                    $filtroAct=$bean->user_id1_c;
            
                    $dirCuentaAnt=self::$fetchedRow[$bean -> id]['assigned_user_id'];
                    $dirCuentaAct=$bean->assigned_user_id;
            
                    $dirConsultoriaAnt=self::$fetchedRow[$bean -> id]['dir_cons_id_c'];
                    $dirConsultoriaAct=$bean->dir_cons_id_c;
            
                    $tipoCuentaAnt=self::$fetchedRow[$bean -> id]['tipo_cuenta'];
                    $tipoCuentaAct=$bean->tipo_cuenta;         
                    
                    $cha=self::$fetchedRow[$bean -> id]['tipo_cuenta'];
                    $tipoCuentaAct=$bean->tipo_cuenta;    
                    
                    $llamarTodosAnt=self::$fetchedRow[$bean -> id]['llamar_todos'];     
                    $llamarTodosAct=$bean->llamar_todos;                                                           
                                                                 
                    if (self::$fetchedRow[$bean -> id]['chk_c1']==1){
                        $val_chk_c1_Ant=true;
                    }else{
                        $val_chk_c1_Ant=false;
                    }
                    $val_chk_c1_Act=$bean->chk_c1;    
                    
                    if (self::$fetchedRow[$bean -> id]['chk_c2']==1){
                        $val_chk_c2_Ant=true;
                    }else{
                        $val_chk_c2_Ant=false;
                    }    
                    $val_chk_c2_Act=$bean->chk_c2;   
                                        
                    if (self::$fetchedRow[$bean -> id]['chk_c3']==1){
                        $val_chk_c3_Ant=true;
                    }else{
                        $val_chk_c3_Ant=false;
                    }    
                    $val_chk_c3_Act=$bean->chk_c3; 
                                                                                                                                                              
                                                                  
                    //Miramos si se ha cambiado el filtro
                    $GLOBALS['log'] -> info('[ExpandeNegocio]_[Modificacion de Franquicia]Filtro Antes-'.$filtroAnt);
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Filtro Ahora-'.$filtroAct);
                    
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Cuenta Antes-'.$dirCuentaAnt);
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Cuenta Ahora-'.$dirCuentaAct);
                    
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Consultoria Antes-'.$dirConsultoriaAnt);
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Consultoria Ahora-'.$dirConsultoriaAct);                        
                    
                    //Miramos si se cambia el filtro                           
                    if ($filtroAnt!='' && $filtroAnt!=$filtroAct){
                        $bean->cambioFiltro($filtroAnt,$filtroAct);
                    }
                    
                    //Miramos si se cambia el Director de la cuenta                           
                    if ($dirCuentaAnt!='' && $dirCuentaAnt!=$dirCuentaAct)
                    {                            
                       $bean->cambioDirCuenta($dirCuentaAnt,$dirCuentaAct);                               
                    }  
                    
                    if ($tipoCuentaAnt!=$tipoCuentaAct && 
                        $tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_EXCLIENTE)
                    {
                        $bean->pasoaExcliente();
                    }   
                    
                    if ($tipoCuentaAnt!=$tipoCuentaAct && 
                        $tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_EXCLIENTE &&
                        ($tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_INTERMEDIA || $tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_CONSULTORIA)){
                        $bean->vueltaExcliente();
                    }
                        
                        
                    if ($val_chk_c1_Ant!=$val_chk_c1_Act &&
                    $val_chk_c1_Act==true){
                        $bean->lanzaIncidencias("C1");
                    }   
                    
                    if ($val_chk_c2_Ant!=$val_chk_c2_Act &&
                    $val_chk_c2_Act==true){
                        $bean->lanzaIncidencias("C2");
                    }   
                    
                    if ($val_chk_c3_Ant!=$val_chk_c3_Act &&
                    $val_chk_c3_Act==true){
                        $bean->lanzaIncidencias("C3");
                    } 
                    
                    if ($llamarTodosAnt!=$llamarTodosAct &&
                    $llamarTodosAct==true){
                        $bean->creaLlamadasPortal();
                    }
                                              
                }
            
            }
        }    
       
    }
?>