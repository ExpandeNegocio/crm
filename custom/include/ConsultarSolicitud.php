<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultarSolicitud]Inicio' );

    $db = DBManagerFactory::getInstance();

    $idSol=$_POST["solId"];   
    $tipo=$_POST["tipo"];
    $provincia=$_POST["provincia"];
    $ccaa=$_POST["ccaa"];
    
    switch ($tipo) {
        case 'RecogeAccionesHistorico':
            
            $db = DBManagerFactory::getInstance();
            
            $query="select * from ";
            $query=$query."(SELECT 'llamada' icono, ";
            $query=$query."concat ('<a href=\"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCalls%26action%3DDetailView%26record%3D',a.id,'\">',ct.name,'</a>') tipo, CASE WHEN a.status = 'Planned' THEN 'Planificada' ELSE CASE WHEN a.status = 'Held' THEN 'Realizada con Exito' ELSE CASE WHEN a.status = 'Not Held' THEN 'Realizada sin Exito' ELSE CASE WHEN a.status = 'Archived' THEN 'Archivada por protocolo' ELSE CASE WHEN a.status = 'Paused' THEN 'Pausada' ELSE 'Otra' END END END END END Estado, f.name franquicia, a.date_entered fecha_creacion, a.date_modified, a.date_start, concat(u.first_name, ' ', u.last_name) usuario_asignado ";
            $query=$query."FROM   (SELECT call_type,c.id, g.name gestion, g.franquicia, c.status, c.date_entered, c.date_modified, c.date_start, c.assigned_user_id ";
            $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, calls c ";
            $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND c.parent_id = g.id AND c.deleted = 0 AND c.status<>'Planned' AND gs. ";
            $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
            $query=$query."       LEFT JOIN expan_franquicia f ON f.id = franquicia ";
            $query=$query."       LEFT JOIN expan_tipo_llamadas ct ON ct.id = call_type ";
            $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id ";
            $query=$query."UNION  ";
            $query=$query."SELECT 'tarea' icono, ";
            $query=$query."concat ('<a href=\"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DTasks%26action%3DDetailView%26record%3D',a.id,'\">',tt.name,'</a>') tipo, CASE WHEN a.status = 'Not Started' THEN 'No iniciada' ELSE CASE WHEN a.status = 'In Progress' THEN 'En Progreso' ELSE CASE WHEN a.status = 'Pending Input' THEN 'Pendiente de Información' ELSE CASE WHEN a.status = 'Completed' THEN 'Completada' ELSE CASE WHEN a.status = 'Cancelada' THEN 'Cancelada' ELSE CASE WHEN a.status = 'Deferred' THEN 'Aplazada (No Usar)' ELSE CASE WHEN a.status = 'Paused' THEN 'Pausada' ELSE 'Otra' END END END END END END END Estado, f.name franquicia, a.date_entered fecha_creacion, a.date_modified, a.date_start, concat(u.first_name, ' ', u.last_name) usuario_asignado ";
            $query=$query."FROM   (SELECT task_type, t.id, g.name gestion, g.franquicia, t.status, t.date_entered, t.date_modified, t.date_start, t.assigned_user_id ";
            $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, tasks t ";
            $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND t.parent_id = g.id AND t.deleted = 0 AND t.status<>'Not Started' AND gs. ";
            $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
            $query=$query."       LEFT JOIN expan_franquicia f ON f.id = franquicia ";
            $query=$query."       LEFT JOIN expan_tipo_tarea tt ON tt.id = task_type ";
            $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id ";
            $query=$query."UNION  ";
            $query=$query."SELECT 'reunion' icono, ";
            $query=$query."concat ('<a href=\"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DMeetings%26action%3DDetailView%26record%3D',a.id,'\">',tr.name,'</a>') tipo, CASE WHEN a.status = 'Planned' THEN 'Planificada' ELSE CASE WHEN a.status = 'Held' THEN 'Realizada con Exito' ELSE CASE WHEN a.status = 'Not Held' THEN 'Realizada sin Exito' ELSE CASE WHEN a.status = 'Archived' THEN 'Archivada por protocolo' ELSE CASE WHEN a.status = 'Paused' THEN 'Pausada' ELSE CASE WHEN a.status = 'Could' THEN 'Posible' ELSE 'Otra' END END END END END END Estado, f.name franquicia, a.date_entered fecha_creacion, a.date_modified, a.date_start, concat(u.first_name, ' ', u.last_name) usuario_asignado ";
            $query=$query."FROM   (SELECT meeting_type,m.id, g.name gestion, g.franquicia, m.status, m.date_entered, m.date_modified, m.date_start, m.assigned_user_id ";
            $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, meetings m ";
            $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND m.parent_id = g.id AND m.deleted = 0 AND m.status<>'Planned' AND gs. ";
            $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
            $query=$query."       LEFT JOIN expan_franquicia f ON f.id = franquicia ";
            $query=$query."       LEFT JOIN expan_tipo_reunion tr ON tr.id = meeting_type ";
            $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id ";
            $query=$query."UNION  ";
            $query=$query."SELECT 'correo' icono, tipo, Estado, f.name franquicia, a.date_entered, a.date_modified, '' date_start, concat_ws(COALESCE(u.first_name,''), ' ', COALESCE(u.last_name,'')) usuario_asignado ";
            $query=$query."FROM   (SELECT e.name tipo, CASE WHEN e.status = 'sent' THEN 'Enviado' ELSE CASE WHEN e.status = 'read' THEN 'Leido' ELSE CASE WHEN e.status = 'unread' THEN 'Por leer' ELSE CASE WHEN e.status = 'draft' THEN 'Enviado' ELSE '' END END END END Estado, g.franquicia, e.date_entered, e.date_modified, e.assigned_user_id ";
            $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, emails e ";
            $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND gs. ";
            $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
            $query=$query."       LEFT JOIN expan_franquicia f ON a.franquicia = f.id ";
            $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id) z ";
            $query=$query." order by date_modified desc";
                        
            $result = $db -> query($query, true);
            
            $return = array();

            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }     
                                  
            echo json_encode($return,JSON_FORCE_OBJECT);
                    
            break;     
            
        case 'RecogeAccionesPorHacer':        
                   
            $user= new User();
            $user->  retrieve($_SESSION['authenticated_user_id']);
        
            if ($user->franquicia!=null){                
                echo "UsuarioFranquicia";                
            } else{
                $db = DBManagerFactory::getInstance();
            
                $query="select * from ";
                $query=$query."(SELECT 'llamada' icono, ";
                $query=$query."concat ('<a href=\"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCalls%26action%3DDetailView%26record%3D',a.id,'\">',ct.name,'</a>') tipo, CASE WHEN a.status = 'Planned' THEN 'Planificada' ELSE CASE WHEN a.status = 'Held' THEN 'Realizada con Exito' ELSE CASE WHEN a.status = 'Not Held' THEN 'Realizada sin Exito' ELSE CASE WHEN a.status = 'Archived' THEN 'Archivada por protocolo' ELSE CASE WHEN a.status = 'Paused' THEN 'Pausada' ELSE 'Otra' END END END END END Estado, f.name franquicia, a.date_entered fecha_creacion, a.date_modified, a.date_start, concat(u.first_name, ' ', u.last_name) usuario_asignado ";
                $query=$query."FROM   (SELECT call_type,c.id, g.name gestion, g.franquicia, c.status, c.date_entered, c.date_modified, c.date_start, c.assigned_user_id ";
                $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, calls c ";
                $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND c.parent_id = g.id AND c.deleted = 0 AND c.status='Planned' AND gs. ";
                $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
                $query=$query."       LEFT JOIN expan_franquicia f ON f.id = franquicia ";
                $query=$query."       LEFT JOIN expan_tipo_llamadas ct ON ct.id = call_type ";
                $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id ";
                $query=$query."UNION  ";
                $query=$query."SELECT 'tarea' icono, ";
                $query=$query."concat ('<a href=\"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DTasks%26action%3DDetailView%26record%3D',a.id,'\">',tt.name,'</a>') tipo, CASE WHEN a.status = 'Not Started' THEN 'No iniciada' ELSE CASE WHEN a.status = 'In Progress' THEN 'En Progreso' ELSE CASE WHEN a.status = 'Pending Input' THEN 'Pendiente de Información' ELSE CASE WHEN a.status = 'Completed' THEN 'Completada' ELSE CASE WHEN a.status = 'Cancelada' THEN 'Cancelada' ELSE CASE WHEN a.status = 'Deferred' THEN 'Aplazada (No Usar)' ELSE CASE WHEN a.status = 'Paused' THEN 'Pausada' ELSE 'Otra' END END END END END END END Estado, f.name franquicia, a.date_entered fecha_creacion, a.date_modified, a.date_start, concat(u.first_name, ' ', u.last_name) usuario_asignado ";
                $query=$query."FROM   (SELECT task_type,t.id ,g.name gestion, g.franquicia, t.status, t.date_entered, t.date_modified, t.date_start, t.assigned_user_id ";
                $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, tasks t ";
                $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND t.parent_id = g.id AND t.deleted = 0 AND t.status='Not Started' AND gs. ";
                $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
                $query=$query."       LEFT JOIN expan_franquicia f ON f.id = franquicia ";
                $query=$query."       LEFT JOIN expan_tipo_tarea tt ON tt.id = task_type ";
                $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id ";
                $query=$query."UNION  ";
                $query=$query."SELECT 'reunion' icono, ";
                $query=$query."concat ('<a href=\"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DMeetings%26action%3DDetailView%26record%3D',a.id,'\">',tr.name,'</a>') tipo, CASE WHEN a.status = 'Planned' THEN 'Planificada' ELSE CASE WHEN a.status = 'Held' THEN 'Realizada con Exito' ELSE CASE WHEN a.status = 'Not Held' THEN 'Realizada sin Exito' ELSE CASE WHEN a.status = 'Archived' THEN 'Archivada por protocolo' ELSE CASE WHEN a.status = 'Paused' THEN 'Pausada' ELSE CASE WHEN a.status = 'Could' THEN 'Posible' ELSE 'Otra' END END END END END END Estado, f.name franquicia, a.date_entered fecha_creacion, a.date_modified, a.date_start, concat(u.first_name, ' ', u.last_name) usuario_asignado ";
                $query=$query."FROM   (SELECT meeting_type,m.id ,g.name gestion, g.franquicia, m.status, m.date_entered, m.date_modified, m.date_start, m.assigned_user_id ";
                $query=$query."        FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, meetings m ";
                $query=$query."        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND m.parent_id = g.id AND m.deleted = 0 AND m.status='Planned' AND gs. ";
                $query=$query."               expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."') a ";
                $query=$query."       LEFT JOIN expan_franquicia f ON f.id = franquicia ";
                $query=$query."       LEFT JOIN expan_tipo_reunion tr ON tr.id = meeting_type ";
                $query=$query."       LEFT JOIN users u ON u.id = a.assigned_user_id) z";           
                $query=$query." order by date_modified desc";
                            
                $result = $db -> query($query, true);
                
                $return = array();
    
                while ($row = $db -> fetchByAssoc($result)) {                   
                    $return[] = $row;
                }     
                                      
                echo json_encode($return,JSON_FORCE_OBJECT);        
            
            }   
            break;                     
        
        case  'RecogeDocumentosRecibidosSolicitud':
        
            $db = DBManagerFactory::getInstance();
            
            $return = array();
            
            $query = "SELECT concat('<a href=index.php?entryPoint=download&id=', n.id, '&type=Notes\">', n.name, '</a>') Documento, n.date_entered Fecha ";
            $query=$query."FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, emails e, notes n ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0 AND (e. ";
            $query=$query."       status = 'read' OR e.status = 'unread') AND n.parent_id = e.id AND gs. ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."' ";
            $query=$query."order by  n.date_entered DESC; ";
            
            $result = $db -> query($query, true);
            
            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }  

            echo json_encode($return,JSON_FORCE_OBJECT);        
            break;      
        
        case  'RecogeDocumentosEnviados':
            
             $db = DBManagerFactory::getInstance();
            
            $return = array();
            
            $query = "SELECT   DISTINCT concat('<a href=index.php?entryPoint=download&id=', nid, '&type=Notes\">', name, '</a>') Documento, Fecha  ";
            $query=$query."FROM     (SELECT n.id nid, n.name, e.date_sent fecha  ";
            $query=$query."          FROM   expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, emails e, notes n  ";
            $query=$query."          WHERE  g.id = gs.expan_soli5dcccitudes_idb AND e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0  ";
            $query=$query."                 AND (e.status = 'sent') AND n.parent_id = e.id AND gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida  ";
            $query=$query."                 = '".$idSol."'  ";
            $query=$query."          UNION  ";
            $query=$query."          SELECT n.id nid, n.name, e.date_sent fech ";
            $query=$query."FROM   emails e, email_templates et, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, notes n ";
            $query=$query."WHERE  gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '".$idSol."' AND g.id = ";
            $query=$query."         gs.expan_soli5dcccitudes_idb AND e.parent_id = g.id AND n.parent_id = et.id AND e.status = 'sent' AND e.deleted = 0 AND n ";
            $query=$query."       .deleted = 0 AND (modeloneg IS NULL OR (modeloneg = 1 AND g.tiponegocio1 = 1) OR (modeloneg = 2 AND g.tiponegocio2 = 1) OR ";
            $query=$query."       (modeloneg = 3 AND g.tiponegocio3 = 1) OR (modeloneg = 4 AND g.tiponegocio4 = 1)) AND e.name = replace(et.subject, \"'\", \"\")) yy  ";
            $query=$query."ORDER BY fecha DESC ; ";
            
            $result = $db -> query($query, true);
            
            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }  
                        
            echo json_encode($return,JSON_FORCE_OBJECT);        
            break;
            
        case 'RecogeMunicipiosCC':

            $query = "select cod, nombre  ";
            $query=$query."from ( select 1 orden,id cod, concat('--',name) nombre ";
            $query=$query."        from expan_centrocomercial where provincia_apertura=$provincia  ";
            $query=$query."        union all ";
            $query=$query."        select 2 orden, c_provmun cod, d_municipio nombre ";
            $query=$query."        from expan_m_municipios where c_pro=$provincia) a ";
            $query=$query."order by orden, nombre ";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultarSolicitud][RecogeMunicipios]Consulta-'.$query );
            
            $result = $db -> query($query, true);
            
            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }  
                        
            echo json_encode($return,JSON_FORCE_OBJECT);       
            
            break;

        case 'RecogeMunicipios':

            $query = "select c_provmun,d_municipio from expan_m_municipios ";
            $query=$query."where c_pro=".$provincia;

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultarSolicitud][RecogeMunicipios]Consulta-'.$query );

            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {
              $return[] = $row;
            }

            echo json_encode($return,JSON_FORCE_OBJECT);

            break;

        case 'RecogeProvincias':

          $query = "select c_prov,d_prov from expan_m_provincia ";
          $query=$query."where c_ca=".$ccaa;

          $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultarSolicitud][RecogeMunicipios]Consulta-'.$query );

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