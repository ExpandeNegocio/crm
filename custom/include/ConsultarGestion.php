<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Inicio' );

    $db = DBManagerFactory::getInstance();

    $idGest=$_POST["gestId"];   
    $tipo=$_POST["tipo"];
    
    switch ($tipo) {
        case 'RecogeDocumentosRecibidosGestion':               
        
            $db = DBManagerFactory::getInstance();
            
            $return = array();
            
            $query = "SELECT concat('<a href=index.php?entryPoint=download&id=', n.id, '&type=Notes\">', n.name, '</a>') Documento, n.date_entered Fecha ";
            $query=$query."FROM   expan_gestionsolicitudes g, emails e, notes n ";
            $query=$query."WHERE  e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0 AND (e. ";
            $query=$query."       status = 'read' OR e.status = 'unread') AND n.parent_id = e.id AND g.id='".$idGest."'";
            $query=$query."order by  n.date_entered DESC; ";
            
            $result = $db -> query($query, true);
            
            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }  

            echo json_encode($return,JSON_FORCE_OBJECT);        
            break;           
            
        case 'RecogeDocumentosEnviadosGestion':
            
            $db = DBManagerFactory::getInstance();
            
            $return = array();
            
            $query = "SELECT   DISTINCT concat('<a href=index.php?entryPoint=download&id=', nid, '&type=Notes\">', name, '</a>') Documento, Fecha  ";
            $query=$query."FROM     (SELECT n.id nid, n.name, e.date_sent fecha  ";
            $query=$query."          FROM   expan_gestionsolicitudes g,  emails e, notes n  ";
            $query=$query."          WHERE e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0  ";
            $query=$query."                 AND (e.status = 'sent') AND n.parent_id = e.id AND g.id= '".$idGest."'  ";
            $query=$query."          UNION  ";
            $query=$query."          SELECT n.id nid, n.name, e.date_sent fech ";
            $query=$query."FROM   emails e, email_templates et, expan_gestionsolicitudes g, notes n ";
            $query=$query."WHERE  g.id = '".$idGest."' AND e.parent_id = g.id AND n.parent_id = et.id AND e.status = 'sent' AND e.deleted = 0 AND n ";
            $query=$query."       .deleted = 0 AND (modeloneg IS NULL OR (modeloneg = 1 AND g.tiponegocio1 = 1) OR (modeloneg = 2 AND g.tiponegocio2 = 1) OR ";
            $query=$query."       (modeloneg = 3 AND g.tiponegocio3 = 1) OR (modeloneg = 4 AND g.tiponegocio4 = 1)) AND e.name = replace(et.subject, \"'\", \"\")) yy  ";
            $query=$query."ORDER BY fecha DESC ; ";
            
            $result = $db -> query($query, true);
            
            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }  
                        
            echo json_encode($return,JSON_FORCE_OBJECT);        
            break;    
            
        default:
            
            break;
    }

?>