<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Meetings/Meeting.php');
    
    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    
    class AccionesBorradoReunion {
        
        protected static $parentId=null;
        
        function before_delete_method($bean, $event, $arguments)
        {     
            self::$parentId=$bean->parent_id;                   
        }
        
    
        function after_delete_method($bean, $event, $arguments)
        {
               
           $GLOBALS['log'] -> info('[ExpandeNegocio][Borrado de Reunion]Entro');
                
            if ($bean->parent_type=='Expan_GestionSolicitudes'){                               
                $gestion = new Expan_GestionSolicitudes();
                $gestion -> retrieve(self::$parentId);    
                $gestion -> calcularOportunidadInmediata(false); 
                
                $solicitud = $gestion ->GetSolicitud();
                if ($solicitud!=null){
                    $solicitud -> calcularOportunidadInmediata(); 
                }                   
                $gestion -> calcularPrioridades();
            }    
                               
        }
    
    }
?>