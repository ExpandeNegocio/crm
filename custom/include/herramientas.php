<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Herramientas]Inicio' );
    $tipo = $_POST["tipo"];     
   // $tipoComp = $_POST["tipoComp"];
    
    
    switch ($tipo) {
        case 'getUser':
                 
            echo $_SESSION["custom_current_user"];
          
            $GLOBALS['log'] -> info('[ExpandeNegocio][Herramientas]Uusario-'.$_SESSION["custom_current_userfranq"] );
             
            break;
          
         case 'getFran':
            
            echo $_SESSION["custom_current_userfranq"];
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Herramientas]Franquicia-'.$_SESSION["custom_current_userfranq"] );
             
            break;  
            
         case 'getSectorComp':                       
                        
            $db = DBManagerFactory::getInstance();
             
            $query = "SELECT e.sector ";
            $query=$query."FROM   expan_empresa_competidores_c c, expan_empresa e ";
            $query=$query."WHERE  c.empresa_id IN (SELECT e.id ";
            $query=$query."                      FROM   expan_franquicia f, expan_empresa e ";
            $query=$query."                      WHERE  e.id = f.empresa AND f.tipo_cuenta in (1,2)); ";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Herramientas]Consulta-'.$query);
                        
            $result = $db -> query($query, true);
            
            $sectores="";

            while ($row = $db -> fetchByAssoc($result)) {
                $sectores =$sectores . $row["sector"];
                $GLOBALS['log'] -> info('[ExpandeNegocio][Actualizacion de llamada][ActulizaRel]Telefono - ' . $row['phone_mobile']);
            }
            
            echo $sectores;
      
        default:
            
            break;
            
    }
?>