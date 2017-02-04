<?php

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    require_once ('modules/Expin_Informes/Expin_Informes.php');
    require ('lib/PHPExcel/PHPExcel.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]Inicio Creacion informe');

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("ExpandeNegocio") //Autor
                         ->setLastModifiedBy("ExpandeNegocio") //Ultimo usuario que lo modificó
                         ->setTitle("Reporte Excel con PHP y MySQL")
                         ->setSubject("Reporte Excel con PHP y MySQL")
                         ->setDescription("Informe Expandenegocio")
                         ->setKeywords("ExpandeNegocio")
                         ->setCategory("Reporte excel");
    
    $idConsulta = $_GET['idConsulta'];
    $idFich=$_GET['idFich'];
    $fIni=$_GET['fIni'];
    $fFin=$_GET['fFin'];  
    
    //Si las fechas no se marcan cojemos todo el espectro de fechas
    
    if ($fIni==''){
       $fIni='01/01/2000'; 
    }    

    if ($fFin==''){
       $fFin='31/12/2050'; 
    }    
    
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]ID consulta - '.$idConsulta);    
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]ID Fichero - '.$idFich);   
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]Fecha Inicio - '.$fIni);   
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]Fecha fin - '.$fFin);    
    
    //Tenemos que recoger la consulta
    $db =  DBManagerFactory::getInstance();
    
    $query="select * from expin_informes where id='".$idConsulta."'";
    $result = $db -> query($query, true);
    
    while ($row = $db -> fetchByAssoc($result)) {
        $plantillaConsulta=htmlspecialchars_decode($row["consulta"],ENT_QUOTES);
    }
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][CreacionInformes] Consulta - ' . $plantillaConsulta);
    
    //Reemplazamos los valores de la plantilla de conuslta y creamos la consulta
    
    $plantillaConsulta=str_replace("#F_INI#", $fIni, $plantillaConsulta);
    $consulta=str_replace("#F_FIN#", $fFin, $plantillaConsulta);
        
    $GLOBALS['log'] -> info('[ExpandeNegocio][CreacionInformes] Consulta - ' . $consulta);
        
        
    //Lanzamos la consulta
    $result = $db -> query($consulta, true);    
    $fil=2;
    while ($row = $db -> fetchByAssoc($result)) {
                      
        $col='A';
                
        foreach ($row as $clave=>$valor)
        {            
            //Escribimos la cabecera
            if ($fil==2){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col.'1',$clave);
            }
            //Escribimos cada linea
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col.$fil, $valor);
            $col++;
        }                
        $fil++;
    }
     
    $filePath = 'tmp/'.$idFich.'.xlsx';    
    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');     
    $writer->save($filePath);
     
    $response = array(
        'success' => true,
        'url' => $filePath
    );
    echo json_encode($response);
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]Finalizacion creacion informe');
    exit();
    
?>