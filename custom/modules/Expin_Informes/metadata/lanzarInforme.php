<?php

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    require_once ('modules/Expin_Informes/Expin_Informes.php');
    require ('lib/PHPExcel/PHPExcel.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    
    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]Inicio Creacion informe');

    $idConsulta = $_GET['idConsulta'];
    $idFich=$_GET['idFich'];
    $fIni=$_GET['fIni'];
    $fFin=$_GET['fFin'];  
    
    //Si las fechas no se marcan cojemos todo el espectro de fechas
    
    if ($fIni==''){
       $fIni='01/01/2000'; 
    }    

    if ($fFin==''){
       $fFin='31/12/2150';
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
        $plantillaExce=$row["plantilla"];
        $hoja=$row["hoja_ins"];
        $fila=$row["fila_ins"];
        $col=$row["columna_ins"];
    }

    $GLOBALS['log']->info('[ExpandeNegocio][CreacionInformes]Plantilla-'.$plantillaExce);

    $objPHPExcel=createPHPExcel($plantillaExce);
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][CreacionInformes] Consulta - ' . $plantillaConsulta);
    
    //Reemplazamos los valores de la plantilla de conuslta y creamos la consulta
    
    $plantillaConsulta=str_replace("#F_INI#", $fIni, $plantillaConsulta);
    $consulta=str_replace("#F_FIN#", $fFin, $plantillaConsulta);
        
    $GLOBALS['log'] -> info('[ExpandeNegocio][CreacionInformes] Consulta - ' . $consulta);

    rellenarExcel($objPHPExcel,$hoja,$col,$fila,$consulta);

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

    function createPHPExcel($template){

      if ($template==null || $template==""){
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
      }else{

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("custom/landing/".$template);
      }
      return $objPHPExcel;
    }

    function rellenarExcel($objPHPExcel,$hoja,$col,$fila,$consulta){

      $cabecera=false;

      if ($hoja==null || $hoja==""){
        $hoja=0;
      }
      if ($col==null || $col==""){
        $col="A";
        $cabecera=true;
      }
      if ($fila==null || $fila==""){
        $fila="1";
        $cabecera=true;
      }

      //Lanzamos la consulta
      $db =  DBManagerFactory::getInstance();
      $result = $db -> query($consulta, true);
      $i=0;
      $colIni=$col;

      while ($row = $db -> fetchByAssoc($result)) {

        $col=$colIni;
        foreach ($row as $clave=>$valor)
        {
          //Escribimos la cabecera
          if ($cabecera==true && $i==0){
            $objPHPExcel->setActiveSheetIndex($hoja)->setCellValue($col.$fila,$clave);
          }
          if ($cabecera==true){
            $objPHPExcel->setActiveSheetIndex($hoja)->setCellValue($col.($fila+1), $valor);
          }else{
            $objPHPExcel->setActiveSheetIndex($hoja)->setCellValue($col.$fila, $valor);
          }

          //Escribimos cada linea
          $col++;
        }
        $fila++;
        $i++;
      }
    }
    
?>