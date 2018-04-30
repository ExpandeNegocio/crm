<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Tasks/Task.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Inicio' );

    $db = DBManagerFactory::getInstance();
    
    $query = "select * from tasks  ";
    $query=$query."where status not in ('Canceled','Deferred','Paused','Completed') AND ERM_tasks_id is not null";
    
    $result = $db -> query($query, true);       

    while ($row = $db -> fetchByAssoc($result)) {
        
        $task= new Task();
        $task->retrieve($row[id]);
                     
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues/".$task->ERM_tasks_id.".xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
                
        $response = curl_exec($ch);
        curl_close($ch);
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Respuesta-'.$response );
        
        $issueresp = new SimpleXMLElement($response);         
                                    
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Status-'.$issueresp->status['id'] );
        $GLOBALS['log'] -> info('[ExpandeNegocio][ActualizaTareasFromERM]Inicio-'.$issueresp->assigned_to['id'] );
        
        //Modificamos el estado, el usuario asignado, descripcion
        $task->status=$task->setStatustoERM($issueresp->status['id']);
        $task->assigned_user_id=$task->getCRMUser($issueresp->assigned_to['id']);      
        $task->description=$issueresp->description;         
        
        $task->ignore_update_c=true;
        $task->save();
                                  
        $estTime=$row['est_time'];
       
    }            
    
?>