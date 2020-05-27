<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Empresa/Expan_Empresa.php');
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

        public function BorrarFranquicia (&$bean, $event, $arguments){

          $db = DBManagerFactory::getInstance();

          $query="update expan_empresa set deleted=1 where id='".$bean->empresa_id."'";

          $db -> query($query);

        }

        public function ModificacionFranq(&$bean, $event, $arguments) {

            if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
                $bean->ignore_update_c = true;

                $db = DBManagerFactory::getInstance();

               //Creacion de una nueva Franquicia
                if (!isset(self::$fetchedRow[$bean -> id])) {

                    //Si la cuenta es de consultoria
                    if ($bean->tipo_cuenta==1){
                       $bean-> llamar_todos=1;
                    }
                    $bean->name=trim($bean->name);

                    $bean->CreateEmpresa();

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

                    if (self::$fetchedRow[$bean -> id]['chk_c4']==1){
                        $val_chk_c4_Ant=true;
                    }else{
                        $val_chk_c4_Ant=false;
                    }
                    $val_chk_c4_Act=$bean->chk_c4;


                    if (self::$fetchedRow[$bean -> id]['chk_c11']==1){
                        $val_chk_c11_Ant=true;
                    }else{
                        $val_chk_c11_Ant=false;
                    }
                    $val_chk_c11_Act=$bean->chk_c11;

                    if (self::$fetchedRow[$bean -> id]['chk_c12']==1){
                        $val_chk_c12_Ant=true;
                    }else{
                        $val_chk_c12_Ant=false;
                    }
                    $val_chk_c12_Act=$bean->chk_c12;

                    if (self::$fetchedRow[$bean -> id]['chk_c13']==1){
                        $val_chk_c13_Ant=true;
                    }else{
                        $val_chk_c13_Ant=false;
                    }
                    $val_chk_c13_Act=$bean->chk_c13;

                    if (self::$fetchedRow[$bean -> id]['chk_c14']==1){
                        $val_chk_c14_Ant=true;
                    }else{
                        $val_chk_c14_Ant=false;
                    }
                    $val_chk_c14_Act=$bean->chk_c14;

                    if (self::$fetchedRow[$bean -> id]['chk_c15']==1){
                        $val_chk_c15_Ant=true;
                    }else{
                        $val_chk_c15_Ant=false;
                    }
                    $val_chk_c15_Act=$bean->chk_c15;

                    //Miramos si se ha cambiado el filtro
                    $GLOBALS['log'] -> info('[ExpandeNegocio]_[Modificacion de Franquicia]Filtro Antes-'.$filtroAnt);
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Filtro Ahora-'.$filtroAct);

                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Cuenta Antes-'.$dirCuentaAnt);
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Cuenta Ahora-'.$dirCuentaAct);

                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Consultoria Antes-'.$dirConsultoriaAnt);
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Director Consultoria Ahora-'.$dirConsultoriaAct);

                    //Miramos si se cambia el filtro
                    if ($filtroAnt!='' && $filtroAnt!=$filtroAct){
                        $bean->cambioUsuarioGestion($filtroAnt,$filtroAct);
                    }

                    //Miramos si se cambia el Director de la cuenta
                    if ($dirCuentaAnt!='' && $dirCuentaAnt!=$dirCuentaAct)
                    {
                       $bean->cambioUsuarioGestion($dirCuentaAnt,$dirCuentaAct);
                    }

                    if (($tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_EXCLIENTE ||
                        $tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_DESAPARECIDA) &&
                        ($tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_INTERMEDIA || $tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_CONSULTORIA))
                    {
                        $bean->pasoaExcliente();
                    }

                    if (($tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_EXCLIENTE ||
                        $tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_DESAPARECIDA) &&
                        ($tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_INTERMEDIA || $tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_CONSULTORIA)){
                        $bean->vueltaExcliente();
                    }

                    if ($tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_CLIENTE_PARADO  &&
                        ($tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_INTERMEDIA || $tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_CONSULTORIA))
                    {
                        $bean->pasoaClienteParado();
                    }

                    if ($tipoCuentaAnt==Expan_Franquicia::TIPO_FRAN_CLIENTE_PARADO &&
                        ($tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_INTERMEDIA || $tipoCuentaAct==Expan_Franquicia::TIPO_FRAN_CONSULTORIA)){
                        $bean->vueltaClienteParado();
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

                    if ($val_chk_c4_Ant!=$val_chk_c4_Act &&
                    $val_chk_c4_Act==true){
                        $bean->lanzaIncidencias("C4");
                    }

                    if ($val_chk_c1_Ant!=$val_chk_c1_Act &&
                    $val_chk_c1_Act==true){
                        $bean->lanzaIncidencias("C1.1");
                    }

                    if ($val_chk_c12_Ant!=$val_chk_c12_Act &&
                    $val_chk_c12_Act==true){
                        $bean->lanzaIncidencias("C1.2");
                    }

                    if ($val_chk_c13_Ant!=$val_chk_c13_Act &&
                    $val_chk_c13_Act==true){
                        $bean->lanzaIncidencias("C1.3");
                    }

                    if ($val_chk_c14_Ant!=$val_chk_c14_Act &&
                    $val_chk_c14_Act==true){
                        $bean->lanzaIncidencias("C1.4");
                    }

                    if ($val_chk_c15_Ant!=$val_chk_c15_Act &&
                    $val_chk_c15_Act==true){
                        $bean->lanzaIncidencias("C1.5");
                    }

                    if ($llamarTodosAnt!=$llamarTodosAct &&
                    $llamarTodosAct==true){
                        $bean->creaLlamadasPortal();
                    }

                    $bean -> procesarObservaciones();
                }

              if ($bean -> tipo_cuenta!=1 and $bean -> tipo_cuenta!=2){
                $bean->assigned_user_id=null;
              }
              $bean -> ignore_update_c=true;
              $bean -> save();

              $this->CloneEmpresa($bean);

            }
        }

        private function CloneEmpresa ($bean){

          if ($bean->empresa_id!=""){

            $empresa= new Expan_Empresa();
            $empresa->retrieve($bean->empresa_id);

            if (self::$fetchedRow[$bean -> id]['chk_es_cliente_potencial']!=$bean->chk_es_cliente_potencial){
              $empresa->chk_es_cliente_potencial= $bean->chk_es_cliente_potencial;
            }
            if (self::$fetchedRow[$bean -> id]['chk_es_proveedor']!=$bean->chk_es_proveedor){
              $empresa->chk_es_proveedor= $bean->chk_es_proveedor;
            }
            if (self::$fetchedRow[$bean -> id]['chk_es_competidor']!=$bean->chk_es_competidor){
              $empresa->chk_es_competidor= $bean->chk_es_competidor;
            }
            if (self::$fetchedRow[$bean -> id]['chk_alianza']!=$bean->chk_alianza){
              $empresa->chk_alianza= $bean->chk_alianza;
            }
            if (self::$fetchedRow[$bean -> id]['cif']!=$bean->cif){
              $empresa->cif= $bean->cif;
            }
            if (self::$fetchedRow[$bean -> id]['razon_social']!=$bean->razon_social){
              $empresa->razon_social= $bean->razon_social;
            }
            if (self::$fetchedRow[$bean -> id]['regmarca']!=$bean->regmarca){
              $empresa->regmarca= $bean->regmarca;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_1']!=$bean->telefono_contacto_1){
              $empresa->telefono_contacto_1= $bean->telefono_contacto_1;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_observa1']!=$bean->telefono_contacto_observa1){
              $empresa->telefono_contacto_observa1= $bean->telefono_contacto_observa1;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_2']!=$bean->telefono_contacto_2){
              $empresa->telefono_contacto_2= $bean->telefono_contacto_2;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_observa2']!=$bean->telefono_contacto_observa2){
              $empresa->telefono_contacto_observa2= $bean->telefono_contacto_observa2;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_3']!=$bean->telefono_contacto_3){
              $empresa->telefono_contacto_3= $bean->telefono_contacto_3;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_observa3']!=$bean->telefono_contacto_observa3){
              $empresa->telefono_contacto_observa3= $bean->telefono_contacto_observa3;
            }
            if (self::$fetchedRow[$bean -> id]['persona_contacto']!=$bean->persona_contacto){
              $empresa->contacto1= $bean->persona_contacto;
            }
            if (self::$fetchedRow[$bean -> id]['contacto_general_2']!=$bean->contacto_general_2){
              $empresa->contacto2= $bean->contacto_general_2;
            }
            if (self::$fetchedRow[$bean -> id]['phone_office']!=$bean->phone_office){
              $empresa->telefono1= $bean->phone_office;
            }
            if (self::$fetchedRow[$bean -> id]['telefono_contacto_2']!=$bean->telefono_contacto_2){
              $empresa->telefono2= $bean->telefono_contacto_2;
            }
            if (self::$fetchedRow[$bean -> id]['movil_general']!=$bean->movil_general){
              $empresa->movil1= $bean->movil_general;
            }
            if (self::$fetchedRow[$bean -> id]['movil_general_2']!=$bean->movil_general_2){
              $empresa->movil2= $bean->movil_general_2;
            }
            if (self::$fetchedRow[$bean -> id]['correo_general']!=$bean->correo_general){
              $empresa->email_con_1= $bean->correo_general;
            }
            if (self::$fetchedRow[$bean -> id]['correo_contacto_2']!=$bean->correo_contacto_2){
              $empresa->email_con_2= $bean->correo_contacto_2;
            }
            if (self::$fetchedRow[$bean -> id]['observacion_con_1']!=$bean->observacion_con_1){
              $empresa->observacion_con_1= $bean->observacion_con_1;
            }
            if (self::$fetchedRow[$bean -> id]['observacion_con_2']!=$bean->observacion_con_2){
              $empresa->observacion_con_2= $bean->observacion_con_2;
            }
            if (self::$fetchedRow[$bean -> id]['direccion_direccion']!=$bean->direccion_direccion){
              $empresa->direccion= $bean->direccion_direccion;
            }
            if (self::$fetchedRow[$bean -> id]['direccion_provincia']!=$bean->direccion_provincia){
              $empresa->provincia= $bean->direccion_provincia;
            }
            if (self::$fetchedRow[$bean -> id]['ccaa']!=$bean->ccaa){
              $empresa->ccaa= $bean->ccaa;
            }
            if (self::$fetchedRow[$bean -> id]['pais']!=$bean->pais){
              $empresa->pais= $bean->pais;
            }
            if (self::$fetchedRow[$bean -> id]['direccion_codigo_postal']!=$bean->direccion_codigo_postal){
              $empresa->codigo_postal= $bean->direccion_codigo_postal;
            }
            if (self::$fetchedRow[$bean -> id]['website']!=$bean->website){
              $empresa->web= $bean->website;
            }
            if (self::$fetchedRow[$bean -> id]['sector']!=$bean->sector){
              $empresa->sector= $bean->sector;
            }
            $empresa->ignore_update_c=true;
            $empresa->save();

          }
        }
    }
?>