<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
     
    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log']->info('[ExpandeNegocio][recogeSugerencias]Recoge sugerencias AJAX');
    
    $fran = $_POST['franquicias'];
    $sector = $_POST['sectores'];
    $tipo = $_POST['tipo'];
    
    
    switch ($tipo) {
        case 'franquicia':
            
            $GLOBALS['log']->info('[ExpandeNegocio][recogeSugerencias]franquicias-'.$fran);
            $db = DBManagerFactory::getInstance();
            
            $query = "SELECT id, name FROM expan_franquicia WHERE name LIKE '%".$fran."%' and deleted=0 ORDER BY name";
            
            $resultSol = $db->query($query, true);
                    
            while ($rowSol = $db->fetchByAssoc($resultSol)){                                               
                echo '<div class="sug" class="ui-menu-item" style="margin-left:5px; margin-top:5px; cursor:pointer;"><a>'.$rowSol["name"].'</a></div>';
            }                                                                   
            
            break;
            
        case 'sector':
            
            $GLOBALS['log']->info('[ExpandeNegocio][recogeSugerencias]Sector-'.$fran);
            $db = DBManagerFactory::getInstance();
            
            $query = "SELECT c_id, d_subsector FROM expan_m_sectores WHERE d_subsector LIKE '%".$sector."%' ORDER BY d_subsector";
            
            $resultSol = $db->query($query, true);
                    
            while ($rowSol = $db->fetchByAssoc($resultSol)){                                               
                echo '<div class="sug_sec" class="ui-menu-item" style="margin-left:5px; margin-top:5px; cursor:pointer;"><a>'.$rowSol["d_subsector"].'</a></div>';
            }                                                                   
            
            break;
        
        default:
            
            break;
    }
    
    
    
    
        
?>