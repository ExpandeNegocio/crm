<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require ('lib/PHPExcel/PHPExcel.php');
    require_once ('include/SugarPHPMailer.php');

    $ROL_ADMINISTRACION='d3986de5-b388-658b-c656-5392fbb0c529';
    $CORREO_RUBEN='ruben@expandenegocio.com';
    $NUM_DIAS_MAX_CENTRAL=15;
    $NUM_DIAS_ANTES_EVENTO_ALTA_FRANQUICIA=30;
    $NUM_DIAS_ANTES_EVENTO_FACTURACION=10;
    $TIPO_EVENTO_ALTA='ALTA';
    $TIPO_EVENTO_INICIO='INICIO';
    $TIPO_EVENTO_FACTURCION='FACTURCION';

    $DIR='tmp/';         
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio de correo Mañanas]Inicio');
    
    
    deleteFiles($DIR);
    
    $db = DBManagerFactory::getInstance();
        
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
        echo $filePath."<br>";
        CreaFicheroEnvioDiario($filePath,$user_id);
        EnviarCorreo($row['email_address'],from_html("Informe ".date('d-n-Y')),$filePath,'');
     
        echo "USUARIO-".$user_id."<br>";
        
        if (esAdministracion($user_id)){
            
            echo "***************************************<BR>";
            echo "ENTRA<BR>";
            echo "***************************************<BR>";
            //Control de Contratos / Precontratos
            if (date('d')==14 || date('d')==29){
                              
                $idFich='Administracion-'.$usuario.'-'.date('d-n-Y');
                $filePath = $DIR . $idFich . '.xlsx';
                echo $filePath;
                CreaFicheroEnvioAdministracion($filePath,$user_id);
                
                EnviarCorreo($row['email_address'],from_html("Informe ".date('d-n-Y')),$filePath,'');  
           }
            //Control de alta de enentos
            $eventosAlta=controlAltaEvento();
            if (count($eventosAlta)!=0){
                $bodyCorreo=CrearCuerpoCorreoEvento($eventosAlta,$TIPO_EVENTO_ALTA);
                EnviarCorreo($row['email_address'],from_html("Nuevas altas de eventos"),null,$bodyCorreo);     
                createTask("Validar datos de eventos creados ayer");
                           
            }
            // Indicacion de franquicias de evento
            $eventosInicioAlta=controlInicioEvento($NUM_DIAS_ANTES_EVENTO_ALTA_FRANQUICIA);
            if (count($eventosInicioAlta)!=0){
                $bodyCorreo=CrearCuerpoCorreoEvento($eventosInicioAlta,$TIPO_EVENTO_INICIO);
                EnviarCorreo($row['email_address'],from_html("Quedan ".$NUM_DIAS_ANTES_EVENTO_ALTA_FRANQUICIA. " para la celebracion de un evento"),null,$bodyCorreo); 
                createTask("Validar datos de eventos para los que falta un mes");
            }
            // Indicamos la facturacion            
            $eventosInicioFact=controlInicioEvento($NUM_DIAS_ANTES_EVENTO_FACTURACION);
            if (count($eventosInicioFact)!=0){
                $bodyCorreo=CrearCuerpoCorreoEvento($eventosInicioFact,$TIPO_EVENTO_FACTURCION);
                EnviarCorreo($row['email_address'],from_html("Nuevas altas de eventos"),null,$bodyCorreo); 
                createTask("Facturar asistentes a eventos comienzan en 10 dias");
            }                       
            
        }       
               
        echo "Terminado<BR>";
        echo "---------------------------------------------------------------------------------<BR><BR>";           
    }  
    
    echo 'Finaliza<BR>';
        

    function CreaFicheroEnvioDiario($filePath,$user_id) {
        
        // Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();
        
        echo "Inicia Creacion Fichero<br>";
        
        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("ExpandeNegocio") //Autor
                             ->setLastModifiedBy("ExpandeNegocio") //Ultimo usuario que lo modificó
                             ->setTitle("Reporte Excel con PHP y MySQL")
                             ->setSubject("Reporte Excel con PHP y MySQL")
                             ->setDescription("Informe Expandenegocio")
                             ->setKeywords("ExpandeNegocio")
                             ->setCategory("Reporte excel");
        
        $titulo = 'Ayuda';                  
        $pagina=0;
                          
        if ($objPHPExcel -> setActiveSheetIndex($pagina)->getTitle()!=$titulo){
            $objPHPExcel->createSheet();
            $objPHPExcel -> setActiveSheetIndex($pagina) -> setTitle($titulo);
            
            echo "Crea nueva pestaña<br>";
        }                             
    
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
            
        InsertaConsulta($objPHPExcel,$query,'Usuario Asignado-Llamadas');
                
        $descripcion = array("Llamadas  por cada uno de los técnicos . Realizadas en los últimos 7 días, realizadas ayer , retrasadas (llamadas con fechaplanificada antes de hoy) y planificadas no retrasadas");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Precontratos');
        
        echo "inserta Usuario Asignado-LLamada<BR>";
        
        
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
            
        InsertaConsulta($objPHPExcel,$query,'Usuario Modifica-Llamadas');
        
        $descripcion = array("Para cada usuario llamadas que se han realizado con éxito, Porcentaje de llamadas realizadas con éxito, numero de llamadas realizadas sin éxito, porcentaje de llamadas sin éxito, llamadas archivadas, porcentaje de llamadas archivadas.",         
                            "Estas estadísticas se muestran para los días : Ayer, hace 2 días, hace 3 días, hace 4 días, hace 5 días, hace 6 días, durante los últimos 7 días, durante los últimos 30 días");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Usuario Modifica-Llamadas');
        
        echo "inserta Usuario-LLamada<BR>";
        

        $query = "SELECT  concat(u.first_name,\" \",u.last_name) Usuario, c.call_type TipoLLamada, count(1) Numero  ";
        $query=$query."FROM     calls c , users u ";
        $query=$query."WHERE    c.status = 'Planned' AND c.date_start < CURDATE() AND c.deleted=0 and c.assigned_user_id= u.id  ";
        $query=$query."GROUP BY c.call_type,c.assigned_user_id ";
        $query=$query."order by Usuario,tipollamada ";
        
         $GLOBALS['log'] -> info('[ExpandeNegocio][Envo de correoMañanas]Consulta Tipo Llamada'.$query);
        
         InsertaConsulta($objPHPExcel,$query,'Usr-Llamadas Retrasadas Tipo');
         
         $descripcion = array("Número de llamadas retrasadas por tipo y usuraio");
        
         InsertarDescripcion($objPHPExcel,$descripcion,'Usr-Llamadas Retrasadas Tipo');
         
         echo "inserta retrasadas tipo<BR>";
        
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

        InsertaConsulta($objPHPExcel,$query,'Usuarios-Tareas');
        
        $descripcion = array("Número de tareas realizadas por usuario.",
                             "Las columnas son: Realizadas estos últimos 7 días, realizadas ayer, canceladas estos últimos 7 días, canceladas ayer, retrasadas (tareas por realiazar con fecha inicio anterior a hoy), por hacer (tareas por realiazar con fecha inicio anterior a hoy), total planificadas");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Usuarios-Tareas');
        
        echo "inserta usuario Tareas<BR>";
        
        
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
        
        InsertaConsulta($objPHPExcel,$query,'Usuarios-Reuniones');       
        
        $descripcion = array("Número de reuniones por usuario.",
                             "Las columnas son: Realizadas estos últimos 7 días, realizadas ayer, sin éxito estos últimos 7 días, sin éxito ayer, retrasadas (reuniones por realiazar con fecha inicio anterior a hoy), por hacer (tareas por realiazar con fecha inicio anterior a hoy), reuniones posibles");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Usuarios-Reuniones');
        
        echo "inserta reuniones<BR>";
        
        
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
        $query=$query."order by f.tipo_cuenta,  f.name, Total_Planificadas desc ";

        InsertaConsulta($objPHPExcel,$query,'Franquicia-Llamadas');
        
        $descripcion = array("Datos relacionados con franquicia, centrado en llamadas",
                             "Las columnas son: Nombre, Tipo de cueta (consultoría-intermediacion), Si la franquicia tiene contratado portales",
                             "Llamadas realizadas los útimos 7 días, llamadas realizadas ayer, llamadas por hacer, retrasadas primera llamada (llamadas con fechaplanificada antes de hoy), retrasadas resto, total planificadas y director de expansión",
                             "Ordenadas por tipo de cuenta,  por nombre de franquicia y total planificadas");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Franquicia-Llamadas');
        
        echo "inserta franquicia llamadas<BR>";
        
        
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
        $query=$query."order by f.tipo_cuenta, f.name, Total_Planificadas desc; ";
                
        InsertaConsulta($objPHPExcel,$query,'Franquicia-Tareas');
        
        $descripcion = array("Datos de tareas agruadas por franquicia",
                             "Las columnas son: Nombre, Tipo de cueta (consultoría-intermediacion),",
                             "Tareas realizadas los útimos 7 días, tareas realizadas ayer, tareas canceladas los últimos 7 días, tareas canceladas ayer, tareas por hacer (tareas con fecha planificada para hoy o posterior), retrasadas (tareas con fecha planificada anterior a hoy), total planificadas",
                             "Ordenadas por tipo de cuenta, por nombre de franquicia y total planificadas");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Franquicia-Tareas');
        
        echo "inserta franquicia llamadas<BR>";
        
        echo "inserta franquicia tareas<BR>";
        
        
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
        $query=$query."order by f.tipo_cuenta, f.name, Total_Planificadas desc; ";
                
        InsertaConsulta($objPHPExcel,$query,'Franquicia-Reuniones');           
        
        $descripcion = array("Datos de reuniones agruadas por franquicia",
                             "Las columnas son: Nombre, Tipo de cueta (consultoría-intermediacion),",
                             "Reuniones realizadas los útimos 7 días, Reuniones realizadas ayer, Reuniones realizadas sin exito los útimos 7 días, Reuniones realizadas sin exito ayer", 
                             "reuniones por hacer (reuniones con fecha planificada para hoy o posterior), retrasadas (reniones con fecha planificada anterior a hoy), total planificadas, reuniones posibles",
                             "Ordenadas por tipo de cuenta, por nombre de franquicia y total planificadas");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Franquicia-Reuniones');
        
        echo "inserta franquicia reuniones<BR>";
        
        
        //Gestiones avanzadas/Calientas por franquicia
        $query = "SELECT f.name, EnCurso, Avanzadas, PorAvanzadas as '% Avanzadas',Calientes, PorCalientes as '% Calientes' ";
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
        $query=$query."order by Calientes desc,Avanzadas desc; ";
        
        InsertaConsulta($objPHPExcel,$query,'Franquicia-Avanzadas_Calientes');     
        
        $descripcion = array("Numero de gestiones agrupadas por franquicia",
                             "Las columnas son: Nombre de la franquicia, gestiones en estado 2 (en curso), gestiones en curso avanzadas, porcentaje de avanzadas respecto a las que están en curso ,",
                             "gestiones en curso calientes, porcentaje de calientes respecto a las que están en curso", 
                             "Ordenadas por: numero de avanzadas");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Franquicia-Avanzadas_Calientes');
                          
        echo "inserta Gestiones avanzadas/Calientas por franquicia<BR>";
        
        
        //Gestiones avanzadas/Calientas por Usuario
        $query = "SELECT   concat(u.first_name, ' ', u.last_name) Nombre, EnCurso, Avanzadas, PorAvanzadas as '% Avanzadas', Calientes, PorCalientes as '% Calientes' ";
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
        
        InsertaConsulta($objPHPExcel,$query,'Usuario-Avanzadas_Calientes');
        
        $descripcion = array("Numero de gestiones agrupadas por usuario asignado",
                             "Las columnas son: técnico, gestiones en estado 2 (en curso), gestiones en curso avanzadas, porcentaje de avanzadas respecto a las que están en curso ,",
                             "gestiones en curso calientes, porcentaje de calientes respecto a las que están en curso", 
                             "Ordenadas por: numero de calientes, por numero de avanzadas"); 
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Usuario-Avanzadas_Calientes');
        
        echo "inserta Gestiones avanzadas/Calientas por usuario<BR>";
                
        //Candidaturas Calientes
        $query = "SELECT name Franquicia, Nombre, d_prov Provincia  ";
        $query=$query."FROM   (SELECT   f.name, concat(COALESCE(s.first_name,NULL,''), ' ', COALESCE(s.last_name,NULL,'')) nombre, s.provincia_apertura_1 prov  ";
        $query=$query."        FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_franquicia f  ";
        $query=$query."        WHERE    f.id = g.franquicia AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id =  ";
        $query=$query."                   gs.expan_soli5dcccitudes_idb AND g.candidatura_caliente = 1 AND g.deleted = 0  ";
        $query=$query."        ORDER BY f.name) a  ";
        $query=$query."       JOIN expan_m_provincia p  ";
        $query=$query."WHERE  a.prov = p.c_prov ORDER BY Franquicia  ";
        
        InsertaConsulta($objPHPExcel,$query,'Candidaturas Calientes');
        
        $descripcion = array("Listado de candidaturas calientes",
                             "Las columnas son: franquicia solicitda, nombre y provincia,",
                             "Ordenadas por: nombre de la franquicia");
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Usuario-Avanzadas_Calientes');
        
        echo "inserta Candidaturas Calientes<BR>";         
              
        //Gestiones no atendidas
        $query = "select f.name Franquicia,min(c.nombre) Tipo,count(1) NumGestiones from expan_gestionsolicitudes g, expan_franquicia f , tipo_cuenta c ";
        $query=$query."where g.estado_sol=1 and g.deleted = 0 and g.franquicia=f.id and f.tipo_cuenta=c.id ";
        $query=$query."group by f.name ";
        $query=$query."order by c.orden, f.name; ";
                
        InsertaConsulta($objPHPExcel,$query,'Gestiones No Atendidas');
        
        $descripcion = array("Número de gestiones no atendidas por franquicia",
                             "Las columnas son: nombre franquicia , tipo de cuenta y número de gestiones",
                             "Ordenadas por: tipo de cuenta, nombre de la franquicia"); 
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Gestiones No Atendidas');
        
        echo "Inserta Gestiones No Atendidas<BR>";
        
        //Listado de correos devueltos
        $query = "SELECT e.name, i.name, e.date_sent, et.description  ";
        $query=$query."FROM   emails e, emails_text et , inbound_email i ";
        $query=$query."WHERE i.id=e.mailbox_id AND   e.id = et.email_id AND e.date_sent BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND   ";
        $query=$query."(from_addr LIKE '%delivery%' or from_addr LIKE '%daemon%'  or from_addr LIKE '%postmaster%') ; ";
                
        InsertaConsulta($objPHPExcel,$query,'Correos Devueltos Semanal');
        
        $descripcion = array("Listado de correos devueltos en la última semana",
                             "Las columnas son: nombre franquicia , fecha de envío, texto del correo de devolución"); 
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Correos Devueltos Semanal');
        
        echo "Correos no Atendidos<BR>";
        
        //Listado de franquicias no dadas de alta
        limpiaFranquicia();               

        $query = "select s.first_name Nombre, s.last_name Apellido, w.name_fran Franquicia, 'Solicitud' Modulo, w.campo , s.date_entered ";
        $query=$query."from w_franq w , expan_solicitud s  ";
        $query=$query."where w.id=s.id and w.name_fran not in (select name from expan_franquicia where deleted=0) AND  ";
        $query=$query."ucase(w.name_fran) not in (select ucase (franq_excep) from w_fran_excep)  ";
        $query=$query."UNION ALL ";
        $query=$query."select name Nombre, '' Apellido, w.name_fran Franquicia, 'Gestion' Modulo, w.campo , g.date_entered ";
        $query=$query."from w_franq w , expan_gestionsolicitudes g  ";
        $query=$query."where w.id=g.id and w.name_fran not in (select name from expan_franquicia where deleted=0) AND  ";
        $query=$query."ucase(w.name_fran) not in (select ucase (franq_excep) from w_fran_excep)";
                      
        InsertaConsulta($objPHPExcel,$query,'Franquicias no dadas de alta');
        
        $descripcion = array("Listado de franquicias recogidas en los campos de franquicias_contactadas y otras franquicias que no están dadas de alta en franquicias");         
        InsertarDescripcion($objPHPExcel,$descripcion,'Franquicias no dadas de alta');
        
        //Listado de sectores no dados de alta
        limpiaSectores();

        $query = "SELECT s.first_name Nombre, s.last_name Apellido, 'Solicitud' Modulo, DATE_FORMAT(s.date_entered, '%d/%m/Y') Fecha, w.name_sector Sector ";
        $query=$query."FROM   w_sector w, expan_solicitud s ";
        $query=$query."WHERE  w.id_sol = s.id AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase(d_subsector) FROM expan_m_sectores) AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase(c_sector) FROM expan_m_sectores) AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase(c_grupo_act) FROM expan_m_sectores) AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase (sector_excep) FROM w_sector_excep) ";
        $query=$query."UNION ALL ";
        $query=$query."SELECT e.name Nombre, '' Apellido, 'Empresa' Modulo, DATE_FORMAT(e.date_entered, '%d/%m/Y') Fecha, w.name_sector Sector ";
        $query=$query."FROM   w_sector w, expan_empresa e ";
        $query=$query."WHERE  w.id_sol = e.id AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase(d_subsector) FROM expan_m_sectores) AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase(c_sector) FROM expan_m_sectores) AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase(c_grupo_act) FROM expan_m_sectores) AND  ";
        $query=$query."  ucase(w.name_sector) NOT IN (SELECT ucase (sector_excep) FROM w_sector_excep); ";
        $query=$query." ";
        
        echo $query."<br>";
                      
        InsertaConsulta($objPHPExcel,$query,'Sectores no dados de alta');
        
        $descripcion = array("Listado de sectores recogidos en los campos de otros_sectores y otras sectores que no están dados de alta en sectores");         
        InsertarDescripcion($objPHPExcel,$descripcion,'Sectores no dados de alta');
        
        
        // Añadimos los proveedores que han marcado los solicitantes
        
        $query = "select informacion_proveedores from expan_gestionsolicitudes where not informacion_proveedores is null";
        
        echo $query."<br>";
        
        InsertaConsulta($objPHPExcel,$query,'Proveedores por dar de alta');
        
        $descripcion = array("Listado de proveedores que nos indican los usuarios");         
        InsertarDescripcion($objPHPExcel,$descripcion,'Proveedores por dar de alta');
        
        
        //Franquicias ein gestiones de la central
        $query = "SELECT   fmax AS 'Fecha último', name AS Nombre, fq as 'Fq sin gestiones de Central' ";
        $query=$query."FROM     (SELECT   max(g.date_entered) fmax, f.name, DATEDIFF(CURDATE(), max(g.date_entered)) AS fq ";
        $query=$query."          FROM     expan_gestionsolicitudes g, expan_franquicia f ";
        $query=$query."          WHERE    g.franquicia = f.id AND tipo_origen = 4 AND f.tipo_cuenta IN (1) ";
        $query=$query."          GROUP BY f.name) c ";
        $query=$query."WHERE    NOT (fmax BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND CURDATE()) ";
        $query=$query."ORDER BY fq DESC; ";
        
       // echo "<BR>".$query."<BR>";
        
        InsertaConsulta($objPHPExcel,$query,'Fq sin Gest de Central');       
        
        $descripcion = array("Número de dias que un franquicia lleva sin que se crea una gestión proviniente de la central",
                             "Se ordena por número de dias que han pasado desde el último alta"); 
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Fq sin Gest de Central');



      //Creiterios de competidor por franquicia
      $query = "SELECT  f.name Franquicia, ";
      $query=$query."cd_sector as Sector, ";
      $query=$query."cd_subsector as Subsector, ";
      $query=$query."cd_acttividad as Actividad, ";
      $query=$query."cd_inversion as Inversion, ";
      $query=$query."cd_opera_inter as \"Opera internacionamente\", ";
      $query=$query."cd_num_centros as \"Nº Centros\", ";
      $query=$query."cd_perfil_franquiciado as \"Perfil\", ";
      $query=$query."cd_oferta_comercial as \"Oferta comercial\", ";
      $query=$query."cd_modal_negocio as \"Modalidades de negocio\", ";
      $query=$query."cd_canon as Canon, ";
      $query=$query."cd_royaltys as Royalties, ";
      $query=$query."cd_pobl_minima as \"Poblacion minima\", ";
      $query=$query."cd_caract_local as \"Caracteríaticas del local\", ";
      $query=$query."cd_estruct_personal as \"Estructura personal\" ";
      $query=$query."                FROM   expan_franquicia f ";
      $query=$query."                WHERE   tipo_cuenta IN (1, 2) and deleted=0 order by f.name; ";

      // echo "<BR>".$query."<BR>";

      InsertaConsulta($objPHPExcel,$query,'Criterios competidor');

      $descripcion = array("Criterios para que se considere un competidor de la franquicia",
        "Se ordena por nombre");

      InsertarDescripcion($objPHPExcel,$descripcion,'Fq sin Gest de Central');


      //listado de competidores por franquicia
      $query = "SELECT (select name from expan_empresa where id=c.empresa_id) as Franquicia,e.name as Competidor, c.tipo_competidor, c.competidor_principal ";
      $query=$query."FROM   expan_empresa e, expan_empresa_competidores_c c ";
      $query=$query."WHERE e.id= c.competidor_id and c.empresa_id  IN (SELECT e.id ";
      $query=$query."                FROM   expan_franquicia f, expan_empresa e ";
      $query=$query."                WHERE  f.empresa_id = e.id AND f.tipo_cuenta IN (1, 2) and f.deleted=0) ";
      $query=$query."                order by franquicia,e.name; ";


      // echo "<BR>".$query."<BR>";

      InsertaConsulta($objPHPExcel,$query,'Competidores');

      $descripcion = array("listado de competidores por franquicia",
        "Se ordena por nombre de la franquicia");

      InsertarDescripcion($objPHPExcel,$descripcion,'Competidores');
        
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
            $query=$query."ORDER BY tipo_cuenta, f.name; ";
            
            InsertaConsulta($objPHPExcel,$query,'Informe franquicias');
            
            $descripcion = array("Informe de gestiones creadas por franquicia en los últims 30 días",
                             "Las colunas son: Nombre de la franquicia, gestiones que hay ahora mismo en estado caliente, gestiones creadas, gestiones creadas con origen expandenegocio, estiones creadas con origen portales ",
                             "gestiones creadas con origen eventos, estiones creadas con origen central, estiones creadas con origen medios de comunicacion, estiones creadas con origen mailing",
                             "Se ordena por tipo de cuenta y por el nombre");
        
            InsertarDescripcion($objPHPExcel,$descripcion,'Fq sin Gest de Central');
            
            echo "Informe franquicias<BR>";
        }

        $USUARIO_RUBEN='71f40543-2702-4095-9d30-536f529bd8b6';
        if ($user_id==$USUARIO_RUBEN){
            
            $query = "SELECT Nombre, Apellidos, m.d_municipio Localidad, Telefono, Correo, Franquicia, Tipo, F_Entrada ";
            $query=$query."FROM   (SELECT   first_name Nombre, last_name Apellidos, localidad_apertura_1, phone_mobile telefono, e.email_address correo, f.name franquicia, CASE WHEN delegado = 1 THEN \"Delegado\" WHEN delegado = 2 THEN \"Agente\" ELSE \"\" END tipo, s.date_entered F_Entrada ";
            $query=$query."        FROM     expan_solicitud s, expan_franquicia f, email_addr_bean_rel r, email_addresses e ";
            $query=$query."        WHERE    s.franquicia_principal = f.id AND s.id = r.bean_id AND e.id = r.email_address_id AND delegado IS NULL AND s.deleted ";
            $query=$query."                 = 0 ";
            $query=$query."        GROUP BY e.email_address) a ";
            $query=$query."      LEFT JOIN expan_m_municipios m ON c_provmun = a.localidad_apertura_1; ";

            
            InsertaConsulta($objPHPExcel,$query,'Delegado - Agente');           
            
            echo "Informe franquicias<BR>";
        }  
                   
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer -> save($filePath);
    }

    function CreaFicheroEnvioAdministracion($filePath,$user_id) {
        
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
        
        $objPHPExcel->createSheet();
        
    
        // CONSULTA PRECONTRATO    
        $query = "SELECT  ";
        $query=$query." nombre,Apellidos,Franquicia,localidad_apertura_pre as 'Poblacion',prov.d_prov, mn as 'Modelo de Negocio', a.fecha 'Fecha firma precontrato'  ";
        $query=$query."FROM  ";
        $query=$query." (SELECT  ";
        $query=$query."   s.first_name Nombre,  ";
        $query=$query."   s.last_name Apellidos,  ";
        $query=$query."   f.name AS 'Franquicia',  ";
        $query=$query."   localidad_apertura_pre,  ";
        $query=$query."   g.provincia_apertura_pre,       ";
        $query=$query."   date_format(g.f_precontrato_firma,'%d/%m/%Y') fecha,  ";
        $query=$query."   CASE WHEN g.tiponegocio1 = 1 THEN f.modNeg1     ";
        $query=$query."      WHEN g.tiponegocio2 = 1 THEN f.modNeg2   ";
        $query=$query."      WHEN g.tiponegocio3 = 1 THEN f.modNeg3   ";
        $query=$query."      WHEN g.tiponegocio4 = 1 THEN f.modNeg4   ";
        $query=$query."   ELSE '' END mn  ";
        $query=$query."  FROM  ";
        $query=$query."   expan_gestionsolicitudes g,  ";
        $query=$query."   expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
        $query=$query."   expan_solicitud s,  ";
        $query=$query."   expan_franquicia f    ";
        $query=$query."  WHERE  ";
        $query=$query."   gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = s.id AND  ";
        $query=$query."   gs.expan_soli5dcccitudes_idb = g.id AND  ";
        $query=$query."   f.id = g.franquicia AND  ";
        $query=$query."   s.deleted = 0 AND  ";
        $query=$query."   g.deleted = 0 AND  ";
        $query=$query."   TIMESTAMPDIFF(DAY, DATE(g.f_precontrato_firma), CURDATE()) < 17) a  ";
        $query=$query." LEFT JOIN expan_m_provincia prov ON a.provincia_apertura_pre = prov.c_prov ; ";

            
        InsertaConsulta($objPHPExcel,$query,'Precontratos');    
        
        $descripcion = array("Informe de precontratos firmados los últimos 15 días",
                             "Las colunas son: Nombre, apellidos, franquicia, localidad apertura, provincia , modelo de negocio y fecha firma del precontrato ");                        
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Precontratos');                  
        
        echo "inserta Precontratos<br>";
        
        // CONSULTA CONTRATO   
        $query = "SELECT ";
        $query=$query." nombre,Apellidos,Franquicia,localidad_apertura_pre 'Poblacion',prov.d_prov, mn as 'Modelo de Negocio', a.fecha 'Fecha firma contrato' ";
        $query=$query."FROM ";
        $query=$query." (SELECT ";
        $query=$query."   s.first_name Nombre, ";
        $query=$query."   s.last_name Apellidos, ";
        $query=$query."   f.name AS 'Franquicia', ";
        $query=$query."   localidad_apertura_pre, ";
        $query=$query."   g.provincia_apertura_pre,      ";
        $query=$query."   date_format(g.f_contrato_firmado ,'%d/%m/%Y') fecha, ";
        $query=$query."   CASE WHEN g.tiponegocio1 = 1 THEN f.modNeg1    ";
        $query=$query."      WHEN g.tiponegocio2 = 1 THEN f.modNeg2  ";
        $query=$query."      WHEN g.tiponegocio3 = 1 THEN f.modNeg3  ";
        $query=$query."      WHEN g.tiponegocio4 = 1 THEN f.modNeg4  ";
        $query=$query."   ELSE '' END mn ";
        $query=$query."  FROM ";
        $query=$query."   expan_gestionsolicitudes g, ";
        $query=$query."   expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
        $query=$query."   expan_solicitud s, ";
        $query=$query."   expan_franquicia f, ";
        $query=$query."   expan_m_municipios m ";
        $query=$query."  WHERE ";
        $query=$query."   gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = s.id AND ";
        $query=$query."   gs.expan_soli5dcccitudes_idb = g.id AND ";
        $query=$query."   f.id = g.franquicia AND ";
        $query=$query."   m.c_provmun = s.localidad_apertura_1 AND ";
        $query=$query."   s.deleted = 0 AND ";
        $query=$query."   g.deleted = 0 AND ";
        $query=$query."   TIMESTAMPDIFF(DAY, DATE(g.f_contrato_firmado), CURDATE()) < 17 AND ";
        $query=$query."   chk_contrato_firmado = 1) a ";
        $query=$query." LEFT JOIN expan_m_provincia prov ON a.provincia_apertura_pre = prov.c_prov; ";               
        
        InsertaConsulta($objPHPExcel,$query,'Contratos');
        
         $descripcion = array("Informe de contratos firmados los últimos 15 días",
                             "Las colunas son: Nombre, apellidos, franquicia, localidad apertura, provincia , modelo de negocio y fecha firma del precontrato ");                        
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Contratos');
        
        echo "inserta Contratos<br>";
        
        $query='https://expandenegocio.easyredmine.com/issues.xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6&status_id=6&easy_query_q=Tareas%20Cuentas%20Extra&limit=1000&sort=updated_on:desc';
        InsertaERM($objPHPExcel,$query,'Tareas Extra');
        
        $descripcion = array("Informe de tareas del ERM terminadas que están como tipo tareas extra");                        
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Tareas Extra');
        
        
        $query='https://expandenegocio.easyredmine.com/issues.xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6&cf_56=*&status_id=6&sort=updated_on:desc';
        InsertaERM($objPHPExcel,$query,'Tareas de Colaborador');
        
         $descripcion = array("Informe de tareas del ERM terminadas que tienen un colaborador asignado");                        
        
        InsertarDescripcion($objPHPExcel,$descripcion,'Tareas de Colaborador');
        
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer -> save($filePath);
    }

    function limpiaSectores(){
             
        $db = DBManagerFactory::getInstance();
               
        $query ="delete from w_sector";             
        $db -> query($query);
             
        $query = "SELECT id,  trim(BOTH ',' FROM concat(COALESCE(replace(otros_sectores,\"\",\",\"),\"\"),\",\",coalesce(replace(sectores_historicos,\"\",\",\"),\"\")))  sector_cont,    ";
        $query=$query."      concat(first_name,' ', last_name) nombre   ";
        $query=$query."    FROM   expan_solicitud   ";
        $query=$query."    WHERE  NOT otros_sectores IS NULL OR NOT sectores_historicos IS NULL    ";
        $query=$query."    AND deleted = 0  ";
        $query=$query."UNION ";
        $query=$query."SELECT id,trim(BOTH ',' FROM concat(COALESCE(replace(otros_sectores,\"\",\",\"),\"\"))) sector_cont, ";
        $query=$query."  name nombre ";
        $query=$query."  from expan_empresa ";
        $query=$query."  where NOT otros_sectores IS NULL AND deleted=0 ";        
        
        echo $query."<br>";
                        
        $result = $db -> query($query, true);
        
        echo "Llega1<br>";
        
        while ($row = $db -> fetchByAssoc($result)) {
           
            $lista=explode(",", $row["sector_cont"]);                                 
            foreach( $lista as $value ){
                
                 $value=trim($value);
                 if ($value!=""){
                    $query="insert into w_sector (id_sol,name_sector) values ('".$row["id"]."','".$value."')";
                 //   echo $query;
                 //   echo "<br>";
                    $result2 = $db -> query($query);

                }
            }                                                           
        }
    }
    
    function limpiaFranquicia(){
             
        $db = DBManagerFactory::getInstance();
               
        $query ="delete from w_franq";             
        $db -> query($query);
             
        $query = "SELECT id,  trim(BOTH ',' FROM concat(COALESCE(replace(franquicias_contactadas,'',','),''),',',   ";
        $query=$query."                                 coalesce(replace(otras_franquicias,'',','),''),',',   ";
        $query=$query."                                 coalesce(replace(franquicia_historicos,'',','),'')))  franq_cont,    ";
        $query=$query."            concat(coalesce(first_name,''),' ', coalesce(last_name,'')) nombre, 'Solicitud' Modulo,   ";
        $query=$query."            case WHEN NOT franquicias_contactadas IS NULL THEN 'Franquicias contactadas' ";
        $query=$query."                 WHEN NOT otras_franquicias IS NULL THEN 'Otras Franquicias' ";
        $query=$query."                 WHEN NOT otras_franquicias IS NULL THEN 'Historico de franquicias' ";
        $query=$query."              ELSE ''  ";
        $query=$query."            END AS Campo ";
        $query=$query."             ";
        $query=$query."FROM   expan_solicitud   ";
        $query=$query."WHERE  NOT franquicias_contactadas IS NULL OR NOT otras_franquicias IS NULL  OR NOT franquicia_historicos IS NULL AND deleted = 0   ";
        $query=$query."UNION ALL  ";
        $query=$query."select id ,trim(BOTH ',' FROM concat(COALESCE(replace(franq_apertura_desca,'',','),''),''))  franq_cont ,  ";
        $query=$query."      name nombre,'Solicitud' Modulo, ";
        $query=$query."      'Franquicia de apertura por descarte' as Campo ";
        $query=$query."from expan_gestionsolicitudes  ";
        $query=$query."WHERE  NOT franq_apertura_desca IS NULL and deleted = 0  ";


                        
        $result = $db -> query($query, true);
        
        echo "Llega1";
        
        while ($row = $db -> fetchByAssoc($result)) {
           
            $lista=explode(",", $row["franq_cont"]);                                 
            foreach( $lista as $value ){
                
                 $value=trim($value);
                 if ($value!=""){
                    $query="insert into w_franq (id,name_fran,modulo,campo) values ('".$row["id"]."','".$value."','".$row["Modulo"]."','".$row["Campo"]."')";
                    echo "CONSULTA INSERCCION W_FRANQ - ". $query;
                    echo "<br>";
                    $result2 = $db -> query($query);

                }
            }                                                           
        }
    }    

    function InsertaERM($objPHPExcel, $consulta,$titulo){
        
        $fil = 2;
        
        $objPHPExcel->createSheet();
        $pagina=$objPHPExcel->getSheetCount()-2;
        
        $objPHPExcel -> setActiveSheetIndex($pagina) -> setTitle($titulo);
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $consulta);               
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/xml"
        ));
            
        $response = curl_exec($ch);    
         
        curl_close($ch);
        
        $tareas = new SimpleXMLElement($response);
        
        $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue('A1', 'ID');
        $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue('B1', 'Nombre Tarea');
        $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue('C1', 'Fecha Ultima Actualizacion');
        
        
        $fil = 2;
        
        foreach ($tareas as $tarea) {
            
            $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue('A' . $fil, $tarea->id);
            $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue('B' . $fil, $tarea->subject);
            $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue('B' . $fil, $tarea->updated_on);                                 
             
            $fil++;
                   
            echo $tarea->id." - ".$tarea->subject."-".$tarea->updated_on."<BR>";
        }
        
    }
    
    function InsertaConsulta($objPHPExcel, $consulta,$titulo) {
                
        $db = DBManagerFactory::getInstance();               
        
      //  echo $consulta. "<BR><BR>";
        
        //Lanzamos la consulta
        $result = $db -> query($consulta, true);
                       
        $fil = 2;
        
        $objPHPExcel->createSheet();
        $pagina=$objPHPExcel->getSheetCount()-2;
        
        $objPHPExcel -> setActiveSheetIndex($pagina) -> setTitle($titulo);
        
        while ($row = $db -> fetchByAssoc($result)) {
    
            $col = 'A';
            
            foreach ($row as $clave => $valor) {
                              
                //Escribimos la cabecera
                if ($fil == 2) {
                    $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue($col . '1', $clave);                    
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

    function InsertarDescripcion($objPHPExcel,$descripcion,$nomPestaña){
        
        echo "----------INICO INSERTA DESCRIPCION---------------------------<br>";
        
        $pagina=0;
        $colPestaña = 'A';
        $colDescrip = 'B';
               
        $filaIni=BuscarFila($objPHPExcel,$pagina);
        
        $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue($colPestaña . $filaIni, $nomPestaña);
        
        $longitud = count($descripcion);
        
        
        for($i=0; $i<$longitud; $i++)
        {
            $fila =  $i+$filaIni;  
            $celda =  $colDescrip . $fila; 
            
            echo "Celda-".$celda."<BR>";     
            $objPHPExcel -> setActiveSheetIndex($pagina) -> setCellValue($colDescrip . $fila, $descripcion[$i]);
        }
        
        
        
        echo "----------FIN INSERTA DESCRIPCION---------------------------<br>";
        
    }
    
    function BuscarFila($objPHPExcel,$pagina){
        
        $columna=1;
        $fila=1;
        
        while ($objPHPExcel -> setActiveSheetIndex($pagina) ->getCellByColumnAndRow($columna,$fila)!=''){
                echo "+++". $objPHPExcel -> setActiveSheetIndex($pagina) ->getCellByColumnAndRow($columna,$fila)."<BR>";
            
            $fila++;
        }
        
        return $fila;
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
    
    function esAdministracion($user_id){
        
      /*   $current_user->id;
        $objACLRole = new ACLRole();
        $roles = $objACLRole->getUserRoles($user_id);
        
        foreach($roles as $rol){ 
          if($rol->id=='$ROL_ADMINISTRACION'){
             return true;
          }            
        } 
        */
        
        if ($user_id=='875daf39-76a9-4eb7-2fbc-53c7fa8dec18' || 
            $user_id=='71f40543-2702-4095-9d30-536f529bd8b6'){
            return true;
        }
        
        return false;        
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
        
        $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
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
    
    function CrearCuerpoCorreoEvento($listaEventos,$tipo)
    {
            
        $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $message=$message."<html>";
        $message=$message."<head>";
        $message=$message."</head>";
        $message=$message."<body>";

      $TIPO_EVENTO_ALTA='ALTA';
      $TIPO_EVENTO_INICIO='INICIO';
      $TIPO_EVENTO_FACTURCION='FACTURCION';

      switch ($tipo) {
            case $TIPO_EVENTO_INICIO:
                $message=$message."<p>Listado de eventos queda un mes para su inicio.</p>";
                $message=$message."<p>Es necesario validar los datos del mismo y añadir las franquicias asistentes.</p>";
                break;
            
            case $TIPO_EVENTO_ALTA:
                $message=$message."<p>Listado de eventos que se han creado hoy.</p>";
                $message=$message."<p>Es necesario validar los datos del mismo y añadir las franquicias asistentes.</p>";
                break;
                
            case $TIPO_EVENTO_FACTURCION:
                $message=$message."<p>Listado de eventos a cuyos asistentes facturar (quedan 10 días para el inicio).</p>";
                $message=$message."<p>Es necesario facturar a las franquicias asistentes.</p>";
                
        }
        
        $message=$message."<table style='width:80%'>";
        $message=$message."<tr>";
        $message=$message."<td><b>EVENTO</b></td>";        
        $message=$message."</tr><tr>";
        
        foreach( $listaEventos as $value ){
            $message=$message."<td><b>".$value."</td></b>";
            $message=$message."</tr><tr>";
        }        
        
        $message=$message."</tr>";
        $message=$message."</table>";
        $message=$message."</body>";
        $message=$message."</html>";
        
        echo "<br>-----MENSAJE CORREO-----------------------------------------------------------<br>";
        echo $message;
        
        return $message;
    }
    
    function controlAltaEvento(){
            
        $listaEventos=array();
        
        $db = DBManagerFactory::getInstance();
        
        $query = "select * from expan_evento where TIMESTAMPDIFF(DAY, DATE(date_entered), CURDATE()) < 1";
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {            
            $listaEventos[]=$row["name"]; 
        } 
        
        return $listaEventos;   
        
    }
    
    function controlInicioEvento($dias){
            
        $listaEventos=array();
        
        $db = DBManagerFactory::getInstance();
        
        $query = "select * from expan_evento where TIMESTAMPDIFF(DAY, DATE( fecha_celebracion), CURDATE()) =".$dias." AND fecha_celebracion > CURDATE();";
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {            
            $listaEventos[]=$row["name"]; 
            echo "Evento-".$row["name"];
        } 
        
        return $listaEventos;   
        
    }
    
    function createTask($nombre){
        
        $tarea = new Task();
       
        $tarea -> name = $nombre;
        
        $tarea -> status = "Not Started";
        $tarea -> task_type= "OTRO";
               
        $tarea -> date_start = TimeDate::getInstance()->nowDb();
        $tarea -> date_due = TimeDate::getInstance()->nowDb();
        
        $tarea->save();
        
    }
    
?>