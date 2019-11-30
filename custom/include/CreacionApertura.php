<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_Apertura/Expan_Apertura.php');

class AccionesGuardadoApertura {
    
    protected static $fetchedRow = array();
    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments) {
        if ($bean -> fetched_row) {
            self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
        }       
    }
    
    public function AsignacionApertura(&$bean, $event, $arguments) {

        if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
            
            $bean->ignore_update_c = true;
            
            $gestion= new Expan_GestionSolicitudes();
            $gestion->retrieve($bean->id);
            $solicitud=$gestion->GetSolicitud();
            
            $f_entrega_cuenta_cont_ant=self::$fetchedRow[$bean -> id]['f_entrega_cuenta_cont'];
            $f_abierta_ant=self::$fetchedRow[$bean -> id]['abierta'];
            
             // Creacion de Apertura
             if (!isset(self::$fetchedRow[$bean -> id])) {

             // Modificacion de Apertura    
             }else{
                 
                 if ($f_entrega_cuenta_cont_ant!=$bean->f_entrega_cuenta_cont 
                    && $bean->f_entrega_cuenta_cont!=""
                    && $solicitud!=null){
                     
                    $envioAutoCorreos= new EnvioAutoCorreos();
                    $franquicia=$bean->franquicia;
                    
                    $addresses['0']['email_address']="administracion@expandenegocio.com"; 
                    $rcp_name="Administracion ExpandeNegocio";  
               //     $salida=$envioAutoCorreos->rellenacorreoFicha("FC",$rcp_name,$addresses,$solicitud,$franquicia,null,$bean);
                    
                /*   $addresses['0']['email_address']=$franquicia->correo_general; 
                    $rcp_name=$franquicia->name;  
                    $salida=$envioAutoCorreos->rellenacorreoFicha("FC",$rcp_name,$addresses,$solicitud,$franquicia,null,$bean);
                     */
                 }
             }      

             if ($f_abierta_ant!=$bean->abierta &&
               $bean->abierta== Expan_Apertura::ABIERTO_NO ){
                $this->actualizaCotratoCaido($bean);
             }
            //Actualizamos el estado del franquiciado
            $this->actualizaEstadoFranquiciado($bean);
        }        
    }

    private function actualizaEstadoFranquiciado($bean){
         if ($bean->expan_franquiciado_id!=''){
            $franquiciado=new Expan_Franquiciado();
            $franquiciado->retrieve($bean->expan_franquiciado_id);
            $franquiciado->estado= $franquiciado->getEstado();
            $franquiciado -> ignore_update_c = true;
            $franquiciado -> save();
        }
    }

    private function actualizaCotratoCaido($bean){
      if ($bean->gestion!=''){
        $gestion= new Expan_GestionSolicitudes();
        $gestion->retrieve($bean->gestion);

        if ($gestion->estado_sol=Expan_GestionSolicitudes::ESTADO_POSITIVO){
          $gestion->motivo_positivo=Expan_GestionSolicitudes::POSITIVO_CAI_CONTRATO;
        }
        $gestion->save();
      }
    }
}