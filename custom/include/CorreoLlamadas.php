<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require ('lib/PHPExcel/PHPExcel.php');
    require_once ('include/SugarPHPMailer.php');
    
    $USUARIO_RUBEN='71f40543-2702-4095-9d30-536f529bd8b6';
    $CORREO_RUBEN='ruben@expandenegocio.com';
    $NUM_DIAS_MAX_CENTRAL=15;
    $DIR='tmp/';
    
          
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio de correo Mañanas]Inicio');
    
    
    deleteFiles($DIR);
    
    $db = DBManagerFactory::getInstance();
    
    echo 'LLega<BR>';
    
    //No se muestran ni los de las franquicias ni los que no show_on_employees=1  
    $query = "SELECT u.id, u.user_name, e.email_address ";
    $query=$query."FROM   users u, email_addr_bean_rel r, email_addresses e ";
    $query=$query."WHERE  r.bean_id = u.id AND e.id = r.email_address_id AND u.status = 'Active' AND e.deleted=0 AND r.deleted=0 AND ";
    $query=$query."u.deleted = 0 AND show_on_employees=1 AND u.franquicia IS NULL; ";
    
    $result = $db -> query($query, true);    
    
    //Recorremos los usuarios
    while ($row = $db -> fetchByAssoc($result)) {
                  
        $usuario=$row['user_name'];  
        $user_id=$row['id'];                
        $idFich='Trabajos-'.$usuario.'-'.date('d-n-Y');
        $filePath = $DIR . $idFich . '.xlsx';
        echo $filePath;
        echo "<br>";
        CreaFicheroEnvio($filePath,$user_id);
        EnviarCorreo($row['email_address'],from_html("Informe ".date('d-n-Y')),$filePath,'');    
        echo "Termiado";       
    }
    
    //Miramos si hay franquicias sin gestiones desde la central en los últimos 15 días    
    $message=CoprobarCandidatosCentral($NUM_DIAS_MAX_CENTRAL);    
    if ($message!=''){
            echo 'Entra enviar correo<BR>';        
        EnviarCorreo($CORREO_RUBEN,from_html("Franquicias sin gestiones Central ".date('d-n-Y')),null,$message);           
    } 
    
    echo 'Finaliza<BR>';
        

    function CreaFicheroEnvio($filePath,$user_id) {
        
        // Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();
        
        echo "Inicia Creacion Fichero";
        
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("ExpandeNegocio") //Autor
                             ->setLastModifiedBy("ExpandeNegocio") //Ultimo usuario que lo modificó
                             ->setTitle("Reporte Excel con PHP y MySQL")
                             ->setSubject("Reporte Excel con PHP y MySQL")
                             ->setDescription("Informe Expandenegocio")
                             ->setKeywords("ExpandeNegocio")
                             ->setCategory("Reporte excel");
    
        //Llamadas por usuario    
        $query = "SELECT   concat(u.first_name, ' ', u.last_name) Nombre ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real. 7dias' ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real. Ayer'          ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Planned' AND c.date_start <CURDATE() THEN 1 ELSE 0 END) AS 'Retrasadas' ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Planned' AND (c.date_start >CURDATE() or c.date_start is null) THEN 1 ELSE 0 END) AS 'Por Hacer' ";        
        $query=$query."         , Sum(CASE WHEN c.status = 'Planned' THEN 1 ELSE 0 END) AS 'Total Planificadas' ";
        $query=$query."FROM     calls c, users u ";
        $query=$query."WHERE    c.assigned_user_id = u.id AND c.deleted = 0 AND u.status = 'Active' and not(u.first_name is null) ";
        $query=$query."GROUP BY assigned_user_id order by u.first_name; ";
            
        InsertaConuslta($objPHPExcel,$query,0,'Usuario Asignado-Llamadas');
        
        echo "inserta Usuario Asignado-LLamada";
        
        
        //Llamadas por usuario  modificado 
        
        $query = "SELECT   concat(u.first_name, ' ', u.last_name) Nombre   ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS '+ Ayer'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ Ayer'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS '- Ayer'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- Ayer'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Arch Ayer'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch Ayer'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END) AS '+ Dia 2'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ Dia 2'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END) AS '- Dia 2'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- Dia 2'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END) AS 'Arch Dia 2'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch Dia 2'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END) AS '+ Dia 3'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ Dia 3'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END) AS '- Dia 3'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- Dia 3'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END) AS 'Arch Dia 3'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch Dia 3'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END) AS '+ Dia 4'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ Dia 4'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END) AS '- Dia 4'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- Dia 4'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END) AS 'Arch Dia 4'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch Dia 4'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END) AS '+ Dia 5'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ Dia 5'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END) AS '- Dia 5'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- Dia 5'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END) AS 'Arch Dia 5'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch Dia 5'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END) AS '+ Dia 6'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ Dia 6'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END) AS '- Dia 6'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- Dia 6'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END) AS 'Arch Dia 6'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch Dia 6'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END) AS '+ Dia 7'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+  Dia 7'                     ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END) AS '-  Dia 7'            ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%-  Dia 7'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END) AS 'Arch  Dia 7'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 6 DAY) THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch  Dia 7'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS '+ 7dias'   ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ 7dias'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS '- 7dias'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- 7dias'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Arch 7dias'  ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch 7dias'            ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS '+ 30dias'   ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%+ 30dias'   ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS '- 30dias'   ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Not Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%- 30dias'   ";
        $query=$query."         , Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Arch 30dias'   ";
        $query=$query."         , concat(coalesce(round((Sum(CASE WHEN c.status = 'Archived' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END)/  ";
        $query=$query."         Sum(CASE WHEN c.status <> 'Planned' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END))*100,2),'-'),'%') AS '%Arch 30dias'   ";
        $query=$query."FROM     calls c, users u   ";
        $query=$query."WHERE    c.modified_user_id = u.id AND c.deleted = 0 AND u.status = 'Active' and not(u.first_name is null)   ";
        $query=$query."GROUP BY c.modified_user_id order by u.first_name   ";                                        
            
        InsertaConuslta($objPHPExcel,$query,1,'Usuario Modifica-Llamadas');
        
        echo "inserta Usuario-LLamada";
        

        $query = "SELECT  concat(u.first_name,\" \",u.last_name) Usuario, c.call_type TipoLLamada, count(1) Numero  ";
        $query=$query."FROM     calls c , users u ";
        $query=$query."WHERE    c.status = 'Planned' AND c.date_start < CURDATE() AND c.deleted=0 and c.assigned_user_id= u.id  ";
        $query=$query."GROUP BY c.call_type,c.assigned_user_id ";
        $query=$query."order by Usuario,tipollamada ";
        
         $GLOBALS['log'] -> info('[ExpandeNegocio][Envo de correoMañanas]Consulta Tipo Llamada'.$query);
        
         InsertaConuslta($objPHPExcel,$query,2,'Usr-Llamadas Retrasadas Tipo');
         
         echo "inserta retrasadas tipo";
        
        //Tareas por usuario
        $query = "SELECT   concat(u.first_name, ' ', u.last_name) Nombre ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Completed' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real. 7dias' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Completed' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real. Ayer'          ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Canceled' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Canc. 7dias' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Canceled' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Canc. Ayer'          ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Not Started' AND t.date_start <CURDATE() THEN 1 ELSE 0 END) AS 'Retrasadas' ";        
        $query=$query."         , Sum(CASE WHEN t.status = 'Not Started' AND (t.date_start >CURDATE() or t.date_start is null) THEN 1 ELSE 0 END) AS 'Por Hacer' ";        
        $query=$query."         , Sum(CASE WHEN t.status = 'Not Started' THEN 1 ELSE 0 END) AS 'Total Planificadas' ";
        $query=$query."FROM     tasks t, users u ";
        $query=$query."WHERE    t.assigned_user_id = u.id AND t.deleted = 0 AND u.status = 'Active' and not(u.first_name is null) ";
        $query=$query."GROUP BY assigned_user_id order by u.first_name; ";

        InsertaConuslta($objPHPExcel,$query,3,'Usuarios-Tareas');
        
        echo "inserta usuario Tareas";
        
        
        //Reunion por usuario
        $query = "SELECT   concat(u.first_name, ' ', u.last_name) Nombre ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real. 7dias' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real. Ayer'          ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Not Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'SinEx 7dias' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Not Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'SinEx Ayer'          ";                
        $query=$query."         , Sum(CASE WHEN t.status = 'Planned' AND (t.date_start <CURDATE() and not( t.date_start is null)) THEN 1 ELSE 0 END) AS 'Retrasadas' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Planned' AND (t.date_start >CURDATE() or t.date_start is null) THEN 1 ELSE 0 END) AS 'Por Hacer' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Planned' THEN 1 ELSE 0 END) AS 'Total Planificadas' ";
        $query=$query."         , Sum(CASE WHEN t.status = 'Could' THEN 1 ELSE 0 END) AS 'Posibles' ";
        $query=$query."FROM     meetings t, users u ";
        $query=$query."WHERE    t.assigned_user_id = u.id AND t.deleted = 0 AND u.status = 'Active' and not(u.first_name is null) ";
        $query=$query."GROUP BY assigned_user_id order by u.first_name; ";
        
        InsertaConuslta($objPHPExcel,$query,4,'Usuarios-Reuniones');       
        
        echo "inserta reuniones";
        
        
        //Llamadas por franquicia
        $query = "select f.name Nombre,  ";
        $query=$query."  case WHEN f.tipo_cuenta=1 THEN 'CONSULTORIA' ELSE 'INTERMEDIACION' END 'Tipo Cuenta',  ";
        $query=$query."  case WHEN f.llamar_todos=1 THEN 'Si' ELSE 'No' END 'Portales',  ";
        $query=$query."  Real_7dias,  ";
        $query=$query."  Real_Ayer,  ";
        $query=$query."  Por_Hacer,  ";
        $query=$query."  Retrasadas_Pri,  ";
        $query=$query."  Retrasadas_Resto,  ";
        $query=$query."  Total_Planificadas,  ";
        $query=$query."  concat(u.first_name,' ',u.last_name) Dir_Expansion  ";
        $query=$query."from (  ";
        $query=$query."    SELECT   g.franquicia   ";
        $query=$query."             ,c.status  ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real_7dias'  ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Held' AND c.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real_Ayer'   ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Planned' AND call_type='Primera' AND c.date_start <CURDATE() THEN 1 ELSE 0 END) AS Retrasadas_Pri  ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Planned' AND call_type!='Primera' AND c.date_start <CURDATE() THEN 1 ELSE 0 END) AS Retrasadas_Resto  ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Planned' AND c.date_start <CURDATE() THEN 1 ELSE 0 END) AS Retrasadas  ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Planned' AND (c.date_start >CURDATE() or c.date_start is null) THEN 1 ELSE 0 END) AS Por_Hacer  ";
        $query=$query."             , Sum(CASE WHEN c.status = 'Planned' THEN 1 ELSE 0 END) AS Total_Planificadas  ";
        $query=$query."    FROM     calls c,expan_gestionsolicitudes g  ";
        $query=$query."    WHERE    c.parent_id=g.id AND c.deleted = 0 and c.parent_type!='Expan_Franquicia' ";
        $query=$query."    GROUP BY g.franquicia) a  ";
        $query=$query."RIGHT JOIN expan_franquicia f on a.franquicia = f.id ";
        $query=$query."RIGHT JOIN users u on u.id=f.assigned_user_id ";
        $query=$query."where f.deleted=0 and f.tipo_cuenta in (1,2) ";
        $query=$query."order by f.tipo_cuenta, f.prime desc, f.name, Total_Planificadas desc ";

        InsertaConuslta($objPHPExcel,$query,5,'Franquicia-Llamadas');
        
        echo "inserta franquicia llamadas";
        
        
        $query = "select f.name, ";
        $query=$query."  case WHEN f.tipo_cuenta=1 THEN 'CONSULTORIA' ELSE 'INTERMEDIACION' END 'Tipo Cuenta', ";
        $query=$query."  Real_7dias, ";
        $query=$query."  Real_Ayer, ";
        $query=$query."  Canc_7dias, ";
        $query=$query."  Canc_Ayer, ";
        $query=$query."  Por_Hacer, ";
        $query=$query."  Retrasadas, ";
        $query=$query."  Total_Planificadas ";
        $query=$query."from ( ";
        $query=$query."    SELECT   g.franquicia  ";
        $query=$query."             ,t.status ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Completed' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real_7dias' ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Completed' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real_Ayer'         ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Canceled' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Canc_7dias' ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Canceled' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Canc_Ayer'         ";                
        $query=$query."             , Sum(CASE WHEN t.status = 'Not Started' AND t.date_start <CURDATE() THEN 1 ELSE 0 END) AS Retrasadas ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Not Started' AND (t.date_start >CURDATE() or t.date_start is null) THEN 1 ELSE 0 END) AS Por_Hacer ";        
        $query=$query."             , Sum(CASE WHEN t.status = 'Not Started' THEN 1 ELSE 0 END) AS Total_Planificadas ";
        $query=$query."    FROM     tasks t,expan_gestionsolicitudes g ";
        $query=$query."    WHERE    t.parent_id=g.id AND t.deleted = 0 ";
        $query=$query."    GROUP BY g.franquicia) a ";
        $query=$query."RIGHT JOIN expan_franquicia f on a.franquicia = f.id ";
        $query=$query."where f.deleted=0 and f.tipo_cuenta in (1,2) ";
        $query=$query."order by f.tipo_cuenta, f.prime desc, f.name, Total_Planificadas desc; ";
                
        InsertaConuslta($objPHPExcel,$query,6,'Franquicia-Tareas');
        
        echo "inserta franquicia tareas";
        
        
        //Reuniones por franquicia
        $query = "select f.name, ";
        $query=$query."  case WHEN f.tipo_cuenta=1 THEN 'CONSULTORIA' ELSE 'INTERMEDIACION' END 'Tipo Cuenta', ";        
        $query=$query."  Real_7dias, ";
        $query=$query."  Real_Ayer, ";
        $query=$query."  SinEx_7dias, ";
        $query=$query."  SinEx_Ayer, ";
        $query=$query."  Por_Hacer, ";
        $query=$query."  Retrasadas, ";
        $query=$query."  Total_Planificadas, ";
        $query=$query."  Posibles ";
        $query=$query."from ( ";
        $query=$query."    SELECT   g.franquicia  ";
        $query=$query."             ,t.status ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real_7dias' ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'Real_Ayer'         ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Not Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'SinEx_7dias' ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Not Held' AND t.date_modified BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() THEN 1 ELSE 0 END) AS 'SinEx_Ayer'         ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Planned' AND t.date_start <CURDATE() THEN 1 ELSE 0 END) AS Retrasadas ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Planned' AND (t.date_start >CURDATE() or t.date_start is null) THEN 1 ELSE 0 END) AS Por_Hacer ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Planned' THEN 1 ELSE 0 END) AS Total_Planificadas ";
        $query=$query."             , Sum(CASE WHEN t.status = 'Could' THEN 1 ELSE 0 END) AS 'Posibles' ";
        $query=$query."    FROM     meetings t,expan_gestionsolicitudes g ";
        $query=$query."    WHERE    t.parent_id=g.id AND t.deleted = 0 ";
        $query=$query."    GROUP BY g.franquicia) a ";
        $query=$query."RIGHT JOIN expan_franquicia f on a.franquicia = f.id ";
        $query=$query."where f.deleted=0 and f.tipo_cuenta in (1,2) ";
        $query=$query."order by f.tipo_cuenta, f.prime desc, f.name, Total_Planificadas desc; ";
                
        InsertaConuslta($objPHPExcel,$query,7,'Franquicia-Reuniones');               
        
        echo "inserta franquicia reuniones";
        
        
        //Gestiones avanzadas/Calientas por franquicia
        $query = "SELECT f.name, EnCurso, Avanzadas, PorAvanzadas ,Calientes, PorCalientes ";
        $query=$query."FROM   (SELECT   g.franquicia f_id, ";
        $query=$query."                  Sum(CASE WHEN g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." THEN 1 ELSE 0 END) EnCurso, ";
        $query=$query."                  Sum(CASE WHEN g.candidatura_avanzada = 1 THEN 1 ELSE 0 END) Avanzadas, ";
        $query=$query."                  round((Sum(CASE WHEN g.candidatura_avanzada = 1 THEN 1 ELSE 0 END)/Sum(CASE WHEN g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." THEN 1 ELSE 0 END))*100,2) PorAvanzadas, ";
        $query=$query."                 Sum(CASE WHEN g.candidatura_caliente = 1 THEN 1 ELSE 0 END) Calientes, ";
        $query=$query."                 round((Sum(CASE WHEN g.candidatura_caliente = 1 THEN 1 ELSE 0 END)/Sum(CASE WHEN g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." THEN 1 ELSE 0 END))*100,2) PorCalientes ";
        $query=$query."        FROM     expan_gestionsolicitudes g ";
        $query=$query."        WHERE g.deleted=0 ";
        $query=$query."        GROUP BY g.franquicia) a ";
        $query=$query."join expan_franquicia f ";
        $query=$query."on f.id=a.f_id ";
        $query=$query."where f.tipo_cuenta in (1,2)  ";
        $query=$query."order by f.prime desc, Calientes desc,Avanzadas desc; ";
        
        InsertaConuslta($objPHPExcel,$query,8,'Franquicia-Avanzadas_Calientes');                       
        echo "inserta Gestiones avanzadas/Calientas por franquicia";
        
        
        //Gestiones avanzadas/Calientas por Usuario
        $query = "SELECT   concat(u.first_name, ' ', u.last_name) Nombre, EnCurso, Avanzadas, PorAvanzadas, Calientes, PorCalientes ";
        $query=$query."FROM     (SELECT   f.assigned_user_id ";
        $query=$query."                   , Sum(CASE WHEN g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." THEN 1 ELSE 0 END) EnCurso ";
        $query=$query."                   , Sum(CASE WHEN g.candidatura_avanzada = 1 THEN 1 ELSE 0 END) Avanzadas ";
        $query=$query."                   , round((Sum(CASE WHEN g.candidatura_avanzada = 1 THEN 1 ELSE 0 END) / Sum(CASE WHEN g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." THEN 1 ELSE 0 END)) * 100, 2) PorAvanzadas ";
        $query=$query."                   , Sum(CASE WHEN g.candidatura_caliente = 1 THEN 1 ELSE 0 END) Calientes ";
        $query=$query."                   , round((Sum(CASE WHEN g.candidatura_caliente = 1 THEN 1 ELSE 0 END) / Sum(CASE WHEN g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_EN_CURSO." THEN 1 ELSE 0 END)) * 100, 2) PorCalientes ";
        $query=$query."          FROM     expan_gestionsolicitudes g, expan_franquicia f ";
        $query=$query."          WHERE    g.franquicia = f.id AND f.tipo_cuenta IN (1, 2) AND g.deleted=0 ";
        $query=$query."          GROUP BY f.assigned_user_id) a ";
        $query=$query."         JOIN users u ON u.id = a.assigned_user_id ";
        $query=$query."         WHERE u.status ='Active' ";
        $query=$query."ORDER BY Calientes DESC, Avanzadas DESC; ";
        
        InsertaConuslta($objPHPExcel,$query,9,'Usuario-Avanzadas_Calientes');
        echo "inserta Gestiones avanzadas/Calientas por usuario";
        
        
        //Candidaturas Calientes
        $query = "SELECT name Franquicia, Nombre, d_prov Provincia ";
        $query=$query."FROM   (SELECT   f.name, f.prime, concat(s.first_name, ' ', s.last_name) nombre, s.provincia_apertura_1 prov ";
        $query=$query."        FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_franquicia f ";
        $query=$query."        WHERE    f.id = g.franquicia AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id = ";
        $query=$query."                   gs.expan_soli5dcccitudes_idb AND g.candidatura_caliente = 1 AND g.deleted = 0 ";
        $query=$query."        ORDER BY f.name) a ";
        $query=$query."       JOIN expan_m_provincia p ";
        $query=$query."WHERE  a.prov = p.c_prov ORDER BY a.prime desc, Franquicia; ";
        
        InsertaConuslta($objPHPExcel,$query,10,'Candidaturas Calientes');
        echo "inserta Candidaturas Calientes";         
              
        
        $query = "select f.name Franquicia,min(c.nombre) Tipo,count(1) NumGestiones from expan_gestionsolicitudes g, expan_franquicia f , tipo_cuenta c ";
        $query=$query."where g.estado_sol=1 and g.deleted = 0 and g.franquicia=f.id and f.tipo_cuenta=c.id ";
        $query=$query."group by f.name ";
        $query=$query."order by c.orden, f.name; ";
                
        InsertaConuslta($objPHPExcel,$query,11,'Gestiones No Atendidas');
        echo "Inserta Gestiones No Atendidas";
        
        
        $query = "SELECT e.name, i.name, e.date_sent, et.description  ";
        $query=$query."FROM   emails e, emails_text et , inbound_email i ";
        $query=$query."WHERE i.id=e.mailbox_id AND   e.id = et.email_id AND e.date_sent BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND   ";
        $query=$query."(from_addr LIKE '%delivery%' or from_addr LIKE '%daemon%'  or from_addr LIKE '%postmaster%') ; ";
                
        InsertaConuslta($objPHPExcel,$query,12,'Correos Devueltos Semanal');
        echo "Correos no Atendidos";
                              
        
        $user=new User();
        $user -> retrieve($user_id);
        
        if($user -> is_admin==1){//solo para admin, mostrar el informe de franquicias
            
            $query = "SELECT   f.name as Franquicia,  ";
            $query=$query."          sum(CASE WHEN g.candidatura_caliente = 1 THEN 1 ELSE 0 END) \"Calientes\", ";
            $query=$query."          sum(CASE WHEN g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas\", ";
            $query=$query."          sum(CASE WHEN g.tipo_origen = \"1\" AND g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas Origen Expande\", ";
            $query=$query."          sum(CASE WHEN g.tipo_origen = \"2\" AND g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas Origen Portales\", ";
            $query=$query."          sum(CASE WHEN g.tipo_origen = \"3\" AND g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas Origen Eventos\", ";
            $query=$query."          sum(CASE WHEN g.tipo_origen = \"4\" AND g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas Origen Central\", ";
            $query=$query."          sum(CASE WHEN g.tipo_origen = \"5\" AND g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas Origen Medios Comunicacion\", ";
            $query=$query."          sum(CASE WHEN g.tipo_origen = \"6\" AND g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Creadas Origen Mailing\", ";
            $query=$query."          sum(CASE WHEN g.estado_sol=".Expan_GestionSolicitudes::ESTADO_POSITIVO." THEN 1 ELSE 0 END) \"Positivas\" ";
            $query=$query."FROM     expan_gestionsolicitudes g, expan_franquicia f ";
            $query=$query."WHERE    g.deleted = 0 AND  ";
            $query=$query."         f.id = g.franquicia AND  ";
            $query=$query."         tipo_cuenta IN (1, 2) ";
            $query=$query."GROUP BY franquicia ";
            $query=$query."ORDER BY tipo_cuenta,f.prime desc, f.name; ";
            
            InsertaConuslta($objPHPExcel,$query,13,'Informe franquicias');
            echo "Informe franquicias";
        }
                   
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer -> save($filePath);
    }
    
    function InsertaConuslta($objPHPExcel, $consulta, $pagina,$titulo) {
                
        $db = DBManagerFactory::getInstance();
        
        //Lanzamos la consulta
        $result = $db -> query($consulta, true);
        $fil = 2;
        
        $objPHPExcel->createSheet();
        
        while ($row = $db -> fetchByAssoc($result)) {
    
            $col = 'A';
    
            foreach ($row as $clave => $valor) {
                //Escribimos la cabecera
                if ($fil == 2) {
                    $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue($col . '1', $clave);
                    $objPHPExcel -> setActiveSheetIndex($pagina) ->setTitle($titulo);
                }
                //Escribimos cada linea
                if ($valor==null){
                    $valor=0;
                }
                $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue($col . $fil, $valor);
                $col++;
            }
            $fil++;
        }
    }
    
    function EnviarCorreo($emailAddr,$subject,$file,$body){
        $GLOBALS['log'] -> info('[ExpandeNegocio][CorreoLlamadas][Envio correos]Entra');
         
        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();

        $mail -> From = $defaults['email'];
        $mail -> FromName = $defaults['name'];

        $mail -> AddAddress($emailAddr, $emailAddr);
        $mail -> Subject = $subject;
        $mail -> Body=$body;
        $mail -> IsHTML(TRUE);
        if ($file!=null){
            $mail->AddAttachment($file);            
        }        
                
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;            
        } else {
            echo "Message sent!";
        }
               
    }
    
    function deleteFiles($folder){
                
        $files = glob($folder.'*'); // get all file names
        foreach($files as $file){ // iterate files
          if(is_file($file)){
              unlink($file); // delete file
          }            
        }               
    };
        
    function CoprobarCandidatosCentral($numDias){
        
        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT   max(g.date_entered) last,f.name ";
        $query=$query."FROM     expan_gestionsolicitudes g, expan_franquicia f ";
        $query=$query."WHERE    g.franquicia = f.id AND tipo_origen = 4 AND f.tipo_cuenta in (1)  ";
        $query=$query."  AND not( g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL ".$numDias." DAY) AND CURDATE()) ";
        $query=$query."GROUP BY f.name  ORDER BY last asc;";
        
        echo $query."<BR>";
       
        //Lanzamos la consulta
        $result = $db -> query($query, true);
        
        $message=$message.'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $message=$message."<html>";
        $message=$message."<head>";
        $message=$message."</head>";
        $message=$message."<body>";
        
        $message=$message."<p>Listado de las franquicias de las que no se han recibido gestiones desde la central en los últimos ".$numDias." días</p>";
        
        $message=$message."<table style='width:80%'>";
        $message=$message."<tr>";
        $message=$message."<td><b>FRANQUICIA</b></td>";
        $message=$message."<td><b>FECHA ULTIMA GESTION CENTRAL</b></td>";
        $message=$message."</tr><tr>";

        $cont=0;
        
        while ($row = $db -> fetchByAssoc($result)) {
            
             echo "Entra Bucle<BR>";
                   
            $nameFran=$row["name"];
            $last=$row["last"];
            
            $message=$message."<td><b>".$nameFran."</td></b>";
            $message=$message."<td>".$last."</td>";
            $message=$message."</tr><tr>";
            
            $cont++;
            
        }     
        $message=$message."</tr>";
        $message=$message."</table>";
        $message=$message."</body>";
        $message=$message."</html>";   
        
        echo $message;
        
        if ($cont==0){
            return "";
        }else{
            return $message;
        }              
                     
    }
?>