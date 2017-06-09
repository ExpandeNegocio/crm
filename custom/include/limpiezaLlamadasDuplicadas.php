<?php
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][LimpiezaLlamadasDuplicadas] Entra a limpiar llamadas');
    
    $db = DBManagerFactory::getInstance();
    

    $query = "update calls c JOIN (select ides from ";
    $query=$query. " (select a.cid as ides, IF(@last=(@last:=gid), @curRow:=@curRow + 1, @curRow:=1) as row_number ";
    $query=$query. " from (select c.name, c.id as cid, c.date_entered as fec, g.id as gid, g.name as gname, s.id as idS, s.first_name, s.last_name ";
    $query=$query. " from calls c, expan_gestionsolicitudes_calls_1_c gc, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, "; 
    $query=$query. " expan_gestionsolicitudes g where g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida and "; 
    $query=$query. " gc.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida=g.id and gc.expan_gestionsolicitudes_calls_1calls_idb=c.id and "; 
    $query=$query. " c.status='Planned' and c.parent_type='Expan_GestionSolicitudes' and s.deleted=0 and g.deleted=0 and c.deleted=0 order by idS, c.date_entered desc ";
    $query=$query. " )a, (SELECT @curRow:=0, @last:=0) r)tabla where tabla.row_number <>1) t "; 
    $query=$query. " on c.id=t.ides set c.status='Archived';"; 
    
    $result = $db -> query($query);
    
    echo 'Finalizado proceso de limpieza de llamadas duplicadas';
    
?>