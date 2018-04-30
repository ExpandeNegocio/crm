<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][regogeGestion]Recoge solicitud desde Gestion AJAX');
        
    $gestionid = $_GET['gestionid'];
    $tipo = $_GET['tipo'];    
        
    switch ($tipo) {
        case 'ValidaRating':
            
            $gestion=new Expan_GestionSolicitudes();
            $gestion->retrieve($gestionid); 
            
            $condRating=false;
            
            if ($gestion!=null){                                      
                
                if ($gestion->tieneLlamadasRealizadas() ||
                    $gestion->tieneReunionesRealizadas()){                        
                    $condRating=true;
                }
       
            }

            echo $condRating;
            
            break;                 
            
        default:
            
            break;
    }
?>