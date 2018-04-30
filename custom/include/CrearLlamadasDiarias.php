<?php
   
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Calls/Call.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Llamadas Diarias]Inicio');
    
    $db = DBManagerFactory::getInstance();
   
    $query = "select distinct id from (  ";
    $query=$query."SELECT g.id  ";
    $query=$query."FROM   expan_gestionsolicitudes g , expan_franquicia f ";
    $query=$query."WHERE  f.id=g.franquicia AND f.tipo_cuenta in (1,2) AND g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND g.deleted = 0 AND candidatura_avanzada=0 AND g.id IN (SELECT parent_id  ";
    $query=$query."FROM   calls  ";
    $query=$query."WHERE  deleted=0 and TIMESTAMPDIFF(DAY, DATE(date_start), CURDATE()) < 30)  ";
    $query=$query."  UNION  ";
    $query=$query."SELECT g.id   ";
    $query=$query."FROM   expan_gestionsolicitudes g , expan_franquicia f ";
    $query=$query."WHERE  f.id=g.franquicia AND f.tipo_cuenta in (1,2) AND g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND g.deleted = 0 AND candidatura_avanzada=1 AND candidatura_caliente=0 AND g.id IN (SELECT parent_id  ";
    $query=$query."FROM   calls  ";
    $query=$query."WHERE  deleted=0 and TIMESTAMPDIFF(DAY, DATE(date_start), CURDATE()) < 20)  ";
    $query=$query."  UNION  ";
    $query=$query."SELECT g.id   ";
    $query=$query."FROM   expan_gestionsolicitudes g , expan_franquicia f ";
    $query=$query."WHERE  f.id=g.franquicia AND f.tipo_cuenta in (1,2) AND g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND g.deleted = 0 AND candidatura_caliente=1 AND g.id IN (SELECT parent_id  ";
    $query=$query."FROM   calls  ";
    $query=$query."WHERE  deleted=0 and TIMESTAMPDIFF(DAY, DATE(date_start), CURDATE()) < 10)) a ; ";

   // $query=$query."where id not in (select parent_id from calls where status='Planned' AND TIMESTAMPDIFF(DAY, DATE(date_start), CURDATE()) > -5 and deleted=0); ";
       
       
    $result = $db -> query($query, true);    
    
    //Recorremos los usuarios
    while ($row = $db -> fetchByAssoc($result)) {
                  
        $ideGestion=$row['id'];  
        
        $gestion=new Expan_GestionSolicitudes();        
        $gestion->retrieve($ideGestion);
        
        if ($gestion->tieneLlamadasPendientes()==false){
            $gestion->creaLlamada('[AUT]Revision Estado', 'RevEst');
        }                    
    }   
      
?>