<?php

$accion = $_GET["accion"];


$campos = array(
 1 => '',
 2 => 'name',
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
 22 => 'ambito_actuacion',
 23 => 'zonas_no_opera',
 24 => 'intranet_catalogo',
 25 => 'cert_calidad',
 26 => 'condiciones_generales',
 27 => '',
 28 => '',
 29 => '',
 30 => '',
 31 => '',
 32 => '',
 33 => '',
 34 => '',
 35 => 'nombre_contacto',
 36 => 'cargo_contacto',
 37 => 'telefono_contacto',
 38 => 'email_contacto',
 39 => 'ofertas',
 40 => 'pedido_minimo',
 41 => 'formas_pago',
 42 => 'condiciones_portes',
 43 => 'plazo_entrega',
 44 => 'rappel_central',
 45 => 'rappel_fdo',
 46 => 'garantia_producto',
 47 => 'politica_devoluciones',
 48 => 'otras_condiciones',
 49 => 'duracion_acuerdo',
 50 => 'f_renovacion_acuerdo',
 51 => 'observaciones',
 );

$tablaInsert = array(0 => '*',
 1 => '',
 2 => 'expan_empresa',
 3 => 'expan_empresa_proveedor',
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
 27 => '',
 28 => '',
 29 => '',
 30 => '',
 31 => '',
 32 => '',
 33 => '',
 34 => '',
 35 => 'expan_empresa_proveedor',
 36 => 'expan_empresa_proveedor',
 37 => 'expan_empresa_proveedor',
 38 => 'expan_empresa_proveedor',
 39 => 'expan_empresa_proveedor',
 40 => 'expan_empresa_proveedor',
 41 => 'expan_empresa_proveedor',
 42 => 'expan_empresa_proveedor',
 43 => 'expan_empresa_proveedor',
 44 => 'expan_empresa_proveedor',
 45 => 'expan_empresa_proveedor',
 46 => 'expan_empresa_proveedor',
 47 => 'expan_empresa_proveedor',
 48 => 'expan_empresa_proveedor',
 49 => 'expan_empresa_proveedor',
 50 => 'expan_empresa_proveedor',
 51 => 'expan_empresa_proveedor', 
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
                <h2> Subida de Archivo de Importación de Proveedores </h2>
                <div class="clear"></div></div>
                
                                <br>
                                
                
                <style>
                
                .link {
                    text-decoration:underline
                }
                </style>                               
                
                <div class="import_instruction">Seleccione un archivo de su ordenador que contenga los datos de proveedores que desea importar</div>
                
                <div class="hr"></div>
                
                <form enctype="multipart/form-data" name="importstep2" method="POST" action="index.php?entryPoint=customImportEventos&accion=load" id="importstep2">
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
        
        $sqlInsertEmpresa="Insert into expan_empresa (id,chk_es_proveedor," . getFields($campos,$tablaInsert,"expan_empresa"). ") values ('";
        $sqlUpdateEmpresa="Update expan_empresa set ";        
        
        $sqlInsertEmpresaProveedor="Insert into expan_empresa_proveedor (id,proveedor_id," . getFields($campos,$tablaInsert,"expan_empresa_proveedor"). ") values ('";  
        $sqlUpdateEmpresaProveedor="Update expan_empresa_proveedor set ";     

        //Lo recorremos
        while (($datos = fgetcsv($archivo, 1000,";")) == true) {
            if ($linea == 0) {
                //Cabecera
                $str = implode(";", $datos);
                echo $str . '<br>';
            } else {
                $num = count($datos);
                
                $arrayValuesEmpresa= array();
                $arrayValuesEmpresaProveedor= array();
                
                // VER QUE PASA SI ESTA REPETIDO O SI ES NUEVO    
                
                $nombre=$datos[$campoName-1]; //getField($campos,"name")];
                $cif=$datos[$campoCif-1];  //getField($campos,"cif")];                                                 
                
                $idProveedor=idRepetido($nombre,$cif);                
                $idEncontrado=true;
                
                echo "id Prov-".$idProveedor."<br>";    
                
                if ($idProveedor==""){
                    $idProveedor=getUuid();                                 
                    $arrayValuesEmpresa[]=$idProveedor;
                    $arrayValuesEmpresa[]=1;  //Es proveedor
                    
                    $arrayValuesEmpresaProveedor[]=getUuid();              
                    $arrayValuesEmpresaProveedor[]=$idProveedor; 
                    $idEncontrado=false;                                                      
                }
                
                //Recorremos las columnas de esa linea                              
                for ($columna = 1; $columna < $num+1; $columna++) {                   
                    
                    $tabla = $tablaInsert[$columna];     
                    if ($tabla=="expan_empresa" || $tabla=="*")  {                        
                        $arrayValuesEmpresa[]=$datos[$columna-1];                                               
                    }      
                    if ($tabla=='expan_empresa_proveedor' || $tabla=="*"){
                        if ($campos[$columna]=='empresa_id'){
                            $arrayValuesEmpresaProveedor[]=$idProveedor;
                        }else{
                            $arrayValuesEmpresaProveedor[]=$datos[$columna-1];
                        }                                               
                    }    

                }               
                
                $db = DBManagerFactory::getInstance();
                
                if ($idEncontrado==false){                                                                         
                    $sqlEmpresa=$sqlInsertEmpresa.implode("','", $arrayValuesEmpresa)."')";
                    $result = $db -> query($sqlEmpresa);
                    
                    $sqlEmpresaProveedor=$sqlInsertEmpresaProveedor.implode("','", $arrayValuesEmpresaProveedor)."')";        
                    $result = $db -> query($sqlEmpresaProveedor);    
                    
                    echo $sqlEmpresa."<br>";
                    echo $sqlEmpresaProveedor."<br>";
                    
                }else{
                    
                    echo "<BR>ENCONTRADO<BR>";
                                        
                    $sqlEmpresa=$sqlUpdateEmpresa;
                    $sqlEmpresaProveedor=$sqlUpdateEmpresaProveedor;
                    
                    for ($columna = 1; $columna < $num+1; $columna++) {                   
                    
                        $tabla = $tablaInsert[$columna];  
                        if ($tabla=="expan_empresa" || $tabla=="*")  {                           
                            $sqlEmpresa=$sqlEmpresa.$campos[$columna]."='".$datos[$columna-1]."',";                            
                        }      
                        if ($tabla=='expan_empresa_proveedor' || $tabla=="*"){
                            if ($campos[$columna]!='empresa_id'){
                                $arrayValuesEmpresaProveedor[]=$idProveedor;
                            
                            }                                               
                        }    
    
                    } 
                    
                               
                    
                    $sqlEmpresa=rtrim($sqlEmpresa,",")." where id='".$idProveedor."'";
                    
                    echo $sqlEmpresa."<br>";
                                                          
                    $result = $db -> query($sqlEmpresa);
                    
                    $sqlEmpresaProveedor=$sqlEmpresaProveedor." where proveedor_id='".$idProveedor."'";      
                    
                     echo $sqlEmpresaProveedor."<br>";
                    
                    $result = $db -> query($sqlEmpresaProveedor);                    
                                  
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