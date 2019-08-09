<?php

$accion = $_GET["accion"];
$idEvento = $_GET["evento"];
$db =  DBManagerFactory::getInstance();

$campos = array(
  0 => 'Franquicia',
  1 => 'formato_participacion',
  2 => 'participacion',
  3 => 'coste',
  4 => 'gastos_asociados',
);

$campoFranquicia=0;
$campoFormato=1;
$campoParticipacion=2;
$campoCoste=3;
$campoGastos=4;

switch ($accion) {
  case 'showLoad' :

    $eventoName= getEventoName($idEvento, $db);

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
                <h2> Subida de Archivo de Importación de Franquicias del Evento - '.$eventoName.'  </h2>
                <div class="clear"></div></div>
                
                                <br>
                                
                
                <style>
                
                .link {
                    text-decoration:underline
                }
                </style>                               
                
                <div class="import_instruction">Seleccione un archivo de su ordenador que contenga los datos de las franquicias de los evento que desea importar</div>
                
                <div class="hr"></div>
                
                <form enctype="multipart/form-data" name="importstep2" method="POST" action="index.php?entryPoint=customImportEventos&accion=load&evento='.$idEvento.'" id="importstep2">
                <input type="hidden" name="module" value="Import">
                <input type="hidden" name="custom_delimiter" value=",">
                <input type="hidden" name="custom_enclosure" value="">
                <input type="hidden" name="source" value="">
                <input type="hidden" name="source_id" value="">
                <input type="hidden" name="action" value="Confirm">
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="import_module" value="Expan_Evento">
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

    echo "Procesando fichero: " . $target_file . "<br>";

    validateFile($target_file);

    $linea = 0;
    //Abrimos nuestro archivo
    $archivo = fopen($target_file, "r");

    //Lo recorremos
    while (($datos = fgetcsv($archivo, 1000, ";")) == true) {
      if ($linea == 0) {
        //Cabecera
        $str = implode(";", $datos);

      } else {
        $num = count($datos);

        $arrayValuesFranquicias = array();

        // VER QUE PASA SI ESTA REPETIDO O SI ES NUEVO

        $franquicia = $datos[$campoFranquicia];

        $idFranq = getFranquiciaId($franquicia);
        if ($idFranq != "") {
          if (getFranquiciaEnEventoId($idFranq, $idEvento)=="") {

            $sql = "insert into expan_franquicia_expan_evento_c (id,date_modified,expan_franquicia_expan_eventoexpan_evento_idb,expan_franquicia_expan_eventoexpan_franquicia_ida,formato_participacion,participacion,coste_accion,gastos_asociados,deleted) ";
            $sql = $sql . "values ('" . getUuid() . "','" .
              $GLOBALS['timedate']->nowDb() . "','" .
              $idEvento . "','" .
              $idFranq . "','" .
              getCodeFromList($GLOBALS['app_list_strings']['lst_formato_participa_Evento'],$datos[$campoFormato]) . "','" .
              getCodeFromList($GLOBALS['app_list_strings']['lst_tipo_participa_Evento'],$datos[$campoParticipacion]). "'," .
              getCoste($datos[$campoCoste]) . "," .
              getCoste($datos[$campoGastos]) . ",0)";

            $result = $db->query($sql);

            if ($result==false){
              echo "<BR>La franquicia " . $franquicia . " NO se ha podido insertar";
            }else{
              echo "<BR>La franquicia " . $franquicia . " se ha insertado correctamente";
            }

          } else {
            echo "<BR>La franquicia " . $franquicia . " ya está cargada en el evento por lo qu no se procsará";
          }
        } else {
          echo "<BR>La franquicia " . $franquicia . " no está dada de alta como franquicia en el CRM por lo qu no se procsará";
        }

      }
      $linea++;
    }
    fclose($archivo);

    echo "<BR><BR>Proceso de carga finalizado<BR>";

    echo '<a href="index.php?module=Expan_Evento&action=DetailView&record='.$idEvento.'">
             <input type="button" value="Volver al evento" />
          </a>';

    break;

  default :
    break;
}

function getFields($campos, $tablaInsert, $nombreTabla)
{

  $arrayCampos = array();

  for ($i = 0; $i < count($campos); $i++) {
    $campo = $campos[$i];
    $tabla = $tablaInsert[$i];

    if ($campo != '' && $tabla == $nombreTabla) {
      $arrayCampos[] = $campo;
    }
  }
  return implode(",", $arrayCampos);
}
function getCoste($val){
  $output='null';
  if ($val!=""){
    $output=$val;
  }
  return $output;
}

function getField($campos, $fieldNname)
{

  for ($i = 0; $i < count($campos); $i++) {
    if ($campos[$i] == $fieldNname) {
      return i;
    }
  }
  return -1;
}

function validateFile($target_file)
{
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image

  // Check file size
  if ($_FILES["userfile"]["size"] > 500000) {
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
}

function getCodeFromList($list,$val){
  $code=$val;
  foreach ($list as $clave => $valor){
    if ($valor==$val){
      $code=$clave;
    }
  }
  return $code;
}

function getFranquiciaEnEventoId($idFran, $idEvento)
{

  $id = "";

  $db = DBManagerFactory::getInstance();

  $sql = "select id from expan_franquicia_expan_evento_c where expan_franquicia_expan_eventoexpan_franquicia_ida='";
  $sql = $sql . $idFran . "'  and expan_franquicia_expan_eventoexpan_evento_idb='$idEvento' and deleted=0";

 // echo "<BR>" . $sql . "<BR>";

  $result = $db->query($sql, true);

  while ($row = $db->fetchByAssoc($result)) {
    $id = $row["id"];
  }
  return $id;
}

function getFranquiciaId($nombre)
{

  $id = "";

  $db = DBManagerFactory::getInstance();

  $sql = "select id from expan_franquicia where ucase(name)=ucase('" . $nombre . "') and deleted=0";

  //echo "<BR>" . $sql . "<BR>";

  $result = $db->query($sql, true);

  while ($row = $db->fetchByAssoc($result)) {
    $id = $row["id"];
  }

  return $id;
}

function getUuid()
{
  return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    mt_rand(0, 0xffff), mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0x0fff) | 0x4000,
    mt_rand(0, 0x3fff) | 0x8000,
    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
  );
}

function getEventoName($idEvento, $db)
{
  $eventoName = "";

  $sql = "select * from expan_evento where id='" . $idEvento . "'";

  $result = $db->query($sql, true);

  while ($row = $db->fetchByAssoc($result)) {
    $eventoName = $row["name"];
  }
  return $eventoName;
}

?>