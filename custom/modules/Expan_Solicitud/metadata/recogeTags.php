<?php
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

    
    $tag = $_POST['tags'];
    $tablaTag =$_POST['tipoTag'];
    
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] Tag-'.$tag);
    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] tipoTag-'.$tablaTag);
    
    $db = DBManagerFactory::getInstance();
    if ($tablaTag=='expan_tag_perfil') {
      $query = "SELECT distinct(tag) tag FROM expan_tag_perfil WHERE tag LIKE '%$tag%' and (tipoperfil='P' or tipoperfil='PF') ";
    }else{
      $query = "SELECT distinct(tag) tag FROM expan_tag_perfil WHERE tag LIKE '%$tag%' and (tipoperfil='F' or tipoperfil='PF')";
    }

    $GLOBALS['log']->info('[ExpandeNegocio][recogerTags] Consulta-'.$query);

    $resultSol = $db->query($query, true);
            
    while ($rowSol = $db->fetchByAssoc($resultSol)){
        if ($tablaTag=='expan_tag_perfil'){
          echo '<div class="sug" class="ui-menu-item" style="margin-left:5px; margin-top:5px; cursor:pointer;"><a>'.$rowSol["tag"].'</a></div>';
        }else{
          echo '<div class="sug_form" class="ui-menu-item" style="margin-left:5px; margin-top:5px; cursor:pointer;"><a>'.$rowSol["tag"].'</a></div>';
        }
    }
?>