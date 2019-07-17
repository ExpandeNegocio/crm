<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Tasks/Task.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Inicio' );

    $db = DBManagerFactory::getInstance();
    
    $query = "select * from tasks  ";
    $query=$query."where status not in ('Canceled','Deferred','Paused','Completed') AND length(ERM_tasks_id)>0;";
    
    $result = $db -> query($query, true);       

    while ($row = $db -> fetchByAssoc($result)) {
                       
        $tarea= new Task();
        $tarea->retrieve($row['id']);
                     
        $ch = curl_init();
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]rowID-'.$row['id'].' - $tarea->id - '.$tarea->id );

        curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues/".$tarea->ERM_tasks_id.".xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
                
        $response = curl_exec($ch);
        curl_close($ch);
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Respuesta-'.$response );
        
        libxml_use_internal_errors(true);
        $sxe = simplexml_load_string($response);
        if ($sxe) {
            $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Task válida-'. $row['ERM_tasks_id']);
            $issueresp = new SimpleXMLElement($response);  
            
            $status=$tarea->setStatustoERM($issueresp->status['id']);
            $asigUser= $tarea->getCRMUser($issueresp->assigned_to['id']);
            $descripcion=$issueresp->description;
            
            $query="update tasks set status='".$status."',assigned_user_id='".$asigUser."',description='".$descripcion."' ";
            $query=$query."where id='".$row['id']."'";      
            
        }else{
            $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Task NO válida-'. $row['ERM_tasks_id']);
            $status=$tarea->setStatustoERM('7');                       
                                   
            $query="update tasks set status='".$status."' ";
            $query=$query."where id='".$row['id']."'"; 
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Task NO válida-consulta-'. $query);           
        }                   
        $result2 = $db -> query($query);              
    }            
    
?>