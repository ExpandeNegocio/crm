<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][regogeGestion]Recoge solicitud desde Gestion AJAX');
        
    $gestionid = $_GET['gestionid'];
    $tipo = $_GET['tipo'];
    $llamadaid = $_GET['llamada'];
    
    $GLOBALS['log']->info('[ExpandeNegocio][regogeGestion]idGestion'-$gestionid);
    
    switch ($tipo) {
        case 'FromId':
            
            $gestion=new Expan_GestionSolicitudes();
            $gestion->retrieve($gestionid); 
            echo $gestion->name;
            
            break;
            
        case 'AgrupadasFromLLamada':
            
            $llamada= new Call();
            $llamada->retrieve($llamadaid);
            
            $solicitud=$llamada->getSolicitud();
            
            if ($llamada->gestion_agrupada==true){
                $query = "SELECT g.id ";
                $query=$query."FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, calls c ";
                $query=$query."WHERE  c.parent_id = g.id AND g.id = gs.expan_soli5dcccitudes_idb AND g.deleted = 0 AND c.deleted = 0 AND s.id = ";
                $query=$query."         gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.id = '".$solicitud->id."' AND gestion_agrupada = 1 AND ";
                $query=$query."       c.status = 'Planned' ";
                
                $db = DBManagerFactory::getInstance();
                        
                $result = $db -> query($query, true);
                
                $gestiones=array();
    
                while ($row = $db -> fetchByAssoc($result)) {
                    $gestiones[]= $row["id"];                
                }
                
                echo implode(",",$gestiones);
                
                
            }else{
                echo $llamada->parent_id;
            }

            break;
            
        default:
            
            break;
    }
    
    
?>