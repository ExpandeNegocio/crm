<?php
    if (!defined('sugarEntry') || !sugarEntry)
        die('Not A Valid Entry Point');
    
    require_once ('data/SugarBean.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][eliminarTareasCuestionario]Pasa a realizadas tareas desde AJAX');
    
    $gestionid = $_GET['gestionid'];
    $GLOBALS['log'] -> info('[ExpandeNegocio][eliminarTareasCuestionario]idGestion-' . $gestionid);
    
    $gestion = new Expan_GestionSolicitudes();    
    $gestion -> retrieve($gestionid);
    
    $gestion -> load_relationship('expan_gestionsolicitudes_tasks_1');
    
    foreach ($gestion->expan_gestionsolicitudes_tasks_1->getBeans() as $tarea) {
        
        if ($tarea->status=="Not Started" && $tarea->task_type=="DOCURevCu"){            
            
            $tarea->status="Completed";
            $tarea->ignore_update_c = true;
            $tarea->save();
        }
    }

?>