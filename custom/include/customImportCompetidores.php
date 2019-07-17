<?php

$accion = $_GET["accion"];

$campoName=2;
$campoCif=6;

$campos = array(0 => 'id',
 1 => '',
 2 => 'name',                     //Datos empresa
 3 => 'empresa_id',
 4 => '',
 5 => '',
 6 => 'cif',
 7 => 'direccion',
 8 => 'codigo_postal',
 9 => 'poblacion',
 10 => 'provincia',
 11 => '',
 12 => 'web',
 13 => 'sedes',
 14 => 'observaciones',
 15 => 'contacto1',
 16 => 'cargo1',
 17 => 'telefono1',
 18 => 'email_con_1',
 19 => 'observacion_con_1',
 20 => 'actividad_principal',
 21 => 'principales_prod_serv',
 22 => 'f_toma_datos',                //Datos de competidores
 23 => 'const_year',
 24 => 'f_creacion_cadena',
 25 => 'num_locales_propios',
 26 => 'num_locales_franquiciados',
 27 => 'num_locales_extran',
 28 => 'poblacion_min',
 29 => 'sup_local_min',
 30 => 'zona_prioritaria_antece',
 31 => 'otros_requisitos',
 32 => 'inversion',
 33 => 'canon_entrada',
 34 => 'royalty_explotacion',
 35 => 'fondo_marketing',
 36 => 'duracion_contrato',
 37 => 'ayuda_financiera',
 38 => 'personal_necesario',
 39 => 'perfil_candidato',
 40 => 'elementos_diferenciales',
 41 => 'posicionamiento_online',
 42 => 'ferias',
 43 => 'portales',
 44 => 'mailings',
 45 => 'publicaciones',
 46 => 'marketing_digital',
 47 => 'otras_acciones',
 48 => 'aperturas_propias',
 49 => 'aperturas_franquiciados',
 50 => 'cierres_propios',
 51 => 'cierres_franquiciados',
 52 => 'aperturas_extranjero',
 53 => 'cierres_extranjero',
 54 => 'tipo_competidor',
 55 => 'competdor_principal',
 );

$tablaInsert = array(0 => '*',
 1 => 'expan_empresa',
 2 => 'expan_empresa',
 3 => 'expan_empresa_competidores_c',
 4 => '',
 5 => '',
 6 => 'expan_empresa',
 7 => 'expan_empresa',
 8 => 'expan_empresa',
 9 => 'expan_empresa',
 10 => 'expan_empresa',
 11 => '',
 12 => 'expan_empresa',
 13 => 'expan_empresa',
 14 => 'expan_empresa',
 15 => 'expan_empresa',
 16 => 'expan_empresa',
 17 => 'expan_empresa',
 18 => 'expan_empresa',
 19 => 'expan_empresa',
 20 => 'expan_empresa',
 21 => 'expan_empresa',
 22 => 'expan_empresa',
 23 => 'expan_empresa',
 24 => 'expan_empresa',
 25 => 'expan_empresa',
 26 => 'expan_empresa',
 27 => 'expan_empresa',
 28 => 'expan_empresa',
 29 => 'expan_empresa',
 30 => 'expan_empresa',
 31 => 'expan_empresa',
 32 => 'expan_empresa',
 33 => 'expan_empresa',
 34 => 'expan_empresa',
 35 => 'expan_empresa',
 36 => 'expan_empresa',
 37 => 'expan_empresa',
 38 => 'expan_empresa',
 39 => 'expan_empresa',
 40 => 'expan_empresa',
 41 => 'expan_empresa',
 42 => 'expan_empresa',
 43 => 'expan_empresa',
 44 => 'expan_empresa',
 45 => 'expan_empresa',
 46 => 'expan_empresa',
 47 => 'expan_empresa',
 48 => 'expan_empresa',
 49 => 'expan_empresa',
 50 => 'expan_empresa',
 51 => 'expan_empresa', 
 52 => 'expan_empresa', 
 53 => 'expan_empresa', 
 54 => 'expan_empresa_competidores_c', 
 55 => 'expan_empresa_competidores_c', 
 );
 
 function getFields($campos,$tablaInsert,$nombreTabla){
    
    $arrayCampos=array();   
     
    for ($i = 0; $i < count($campos); $i++){                   
        $campo=$campos[$i];
        $tabla=$tablaInsert[$i];        
        
        if ($campo!='' && $tabla==$nombreTabla){
            $arrayCampos[]=$campo;
        }
    }    
    return implode(",", $arrayCampos);
 }
 
 function idRepetido($nombre,$cif){
     
    $id="";
    
    $db = DBManagerFactory::getInstance();
    
    $sql="select id from expan_empresa where name='".$nombre."' OR (cif='".$cif."' AND LENGTH(cif)>0)";      
    
    echo "<BR>".$sql."<BR>";

    $result = $db -> query($sql, true);
            
    while ($row = $db -> fetchByAssoc($result)) {                               
        $id = $row["id"];
    }  
     
    return $id;
 }

function getField($campos,$fieldNname){
       
    for ($i = 0; $i < count($campos); $i++){                           
        if ($campos[$i]==$fieldNname){
            return i;
        }       
    }    
    return -1;
}

switch ($accion) {
    case 'showLoad' :
        echo '
                <table style="width:100%"><tbody><tr><td>
                
                <style>
                
                .moduleTitle h2
                {
                    font-size: 18px;
                }
                
                </style>
                <script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js?v=pDv_G0dUwDzv9p6_ZKqqIQ"></script>
                <div class="dashletPanelMenu wizard">
                    <div class="bd">
                            <div class="screen">
                                <div class="moduleTitle">
                <h2> Subida de Archivo de Importación de Competidores </h2>
                <div class="clear"></div></div>
                
                                <br>
                                
                
                <style>
                
                .link {
                    text-decoration:underline
                }
                </style>                               
                
                <div class="import_instruction">Seleccione un archivo de su ordenador que contenga los datos de competidores que desea importar</div>
                
                <div class="hr"></div>
                
                <form enctype="multipart/form-data" name="importstep2" method="POST" action="index.php?entryPoint=customImportCompetidores&accion=load" id="importstep2">
                <input type="hidden" name="module" value="Import">
                <input type="hidden" name="custom_delimiter" value=",">
                <input type="hidden" name="custom_enclosure" value="">
                <input type="hidden" name="source" value="">
                <input type="hidden" name="source_id" value="">
                <input type="hidden" name="action" value="Confirm">
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="import_module" value="Expan_Franquicia">
                <input type="hidden" name="from_admin_wizard" value="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody><tr>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                        <tr>
                            <td scope="row" colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="row" colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" scope="row" colspan="3"><label for="userfile">Seleccione un archivo:</label> <input type="hidden"><input size="20" id="userfile" name="userfile" type="file" accept=".csv"> &nbsp;<img border="0" onclick="return SUGAR.util.showHelpTips(this,\'Seleccione un archivo que contenga datos separados por un delimitador, ya sea por comas o por tabulaciones. Se recomienda archivos .csv.\' );" src="themes/Sugar5/images/helpInline.gif?v=pDv_G0dUwDzv9p6_ZKqqIQ" alt="Información" class="inlineHelpTip"></td>
                        </tr>
                        <tr>
                            <td scope="row" colspan="4"><div class="hr">&nbsp;</div></td>
                        </tr>
                        <tr>
                            <td scope="row" colspan="4">&nbsp;</td>
                        </tr>                        
                    </tbody></table>
                    <br>
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                          
                                    
                              </table>
                </td>
                </tr>
                </tbody></table>
                
                <br>
                
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr>
                  <td align="left">
                              <input title="Siguiente >" class="button" type="submit" name="button" value="  Siguiente >  " id="gonext">
                    </td>
                </tr>
                </tbody></table>
                
                
                
                </script>  
                </form>
                
                            </div>
                    </div>
                </div>
                
                
                </script><!--end body panes-->
        </td></tr></tbody></table>';

        break;

    case 'load' :
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
        $uploadOk = 1;

        echo "Procesando fichero: " . $target_file . "<br>";

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "El fichero es demasiado grande.<br>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "csv") {
            echo "Solo se pueden cargar ficheros de tipo csv.<br>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "El fichero no se ha podido subir al CRM.<br>";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                echo "El fichero " . basename($_FILES["userfile"]["name"]) . " ha sido subido al CRM.<br>";
            } else {
                echo "Ha habido un error subiendo el fichero.<br>";
            }
        }

        $linea = 0;
        //Abrimos nuestro archivo
        $archivo = fopen($target_file, "r");
        
        $sqlInsertEmpresa="Insert into expan_empresa (id," . getFields($campos,$tablaInsert,"expan_empresa"). ") values ('";
        $sqlUpdateEmpresa="Update expan_empresa set ";        
        
        $sqlInsertEmpresaCompetidor="Insert into expan_empresa_competidor_c (id,competidor_id," . getFields($campos,$tablaInsert,"expan_empresa_competidor_c"). ") values ('";  
        $sqlUpdateEmpresaCompetidor="Update expan_empresa_competidor_c set ";     

        //Lo recorremos
        while (($datos = fgetcsv($archivo, 1000,";")) == true) {
            if ($linea == 0) {
                //Cabecera
                $str = implode(";", $datos);
                echo $str . '<br>';
            } else {
                $num = count($datos);
                
                $arrayValuesEmpresa= array();
                $arrayValuesEmpresaCompetidor= array();
                
                // VER QUE PASA SI ESTA REPETIDO O SI ES NUEVO    
                
                $nombre=$datos[$campoName-1]; //getField($campos,"name")];
                $cif=$datos[$campoCif-1];  //getField($campos,"cif")];                                                 
                
                $idCompetidor=idRepetido($nombre,$cif);                
                $idEncontrado=true;
                
                echo "id Prov-".$idCompetidor."<br>";    
                
                if ($idCompetidor==""){
                    $idCompetidor=getUuid();                                 
                    $arrayValuesEmpresa[]=$idCompetidor;
                    $arrayValuesEmpresaCompetidor[]=getUuid();              
                    $arrayValuesEmpresaCompetidor[]=$idCompetidor; 
                    $idEncontrado=false;                                                      
                }
                
                //Recorremos las columnas de esa linea                              
                for ($columna = 1; $columna < $num+1; $columna++) {                   
                    
                    $tabla = $tablaInsert[$columna];     
                    if ($tabla=="expan_empresa" || $tabla=="*")  {                        
                        $arrayValuesEmpresa[]=$datos[$columna-1];                                               
                    }      
                    if ($tabla=='expan_empresa_competidor_c' || $tabla=="*"){
                        if ($campos[$columna]=='empresa_id'){
                            $arrayValuesEmpresaCompetidor[]=$idCompetidor;
                        }else{
                            $arrayValuesEmpresaCompetidor[]=$datos[$columna-1];
                        }                                               
                    }    

                }               
                
                $db = DBManagerFactory::getInstance();
                
                if ($idEncontrado==false){                                                                         
                    $sqlEmpresa=$sqlInsertEmpresa.implode("','", $arrayValuesEmpresa)."')";
                    $result = $db -> query($sqlEmpresa);
                    
                    $sqlEmpresaCompetidor=$sqlInsertEmpresaCompetidor.implode("','", $arrayValuesEmpresaCompetidor)."')";        
                    $result = $db -> query($sqlEmpresaCompetidor);    
                    
                    echo $sqlEmpresa."<br>";
                    echo $sqlEmpresaCompetidor."<br>";
                    
                }else{
                    
                    echo "<BR>ENCONTRADO<BR>";
                                        
                    $sqlEmpresa=$sqlUpdateEmpresa;
                    $sqlEmpresaCompetidor=$sqlUpdateEmpresaCompetidor;
                    
                    for ($columna = 1; $columna < $num+1; $columna++) {                   
                    
                        $tabla = $tablaInsert[$columna];  
                        if ($tabla=="expan_empresa" || $tabla=="*")  {                           
                            $sqlEmpresa=$sqlEmpresa.$campos[$columna]."='".$datos[$columna]."',";                            
                        }      
                        if ($tabla=='expan_empresa_competidor_c' || $tabla=="*"){
                            if ($campos[$columna]!='empresa_id'){
                                $arrayValuesEmpresaCompetidor[]=$idCompetidor;
                            
                            }                                               
                        }    
    
                    } 
                    
                    $sqlEmpresa=rtrim($sqlEmpresa,",")." where id='".$idCompetidor."'";
                    
                    echo $sqlEmpresa."<br>";
                                                          
                    $result = $db -> query($sqlEmpresa);
                    
                    $sqlEmpresaCompetidor=$sqlEmpresaCompetidor." where competidor_id='".$idCompetidor."'";      
                    
                     echo $sqlEmpresaCompetidor."<br>";
                    
                    $result = $db -> query($sqlEmpresaCompetidor);                    
                                  
                }                                               
               
            }
            $linea++;
        }
        fclose($archivo);

        break;

    default :
        break;
}

function getUuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',     
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),        
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
?>