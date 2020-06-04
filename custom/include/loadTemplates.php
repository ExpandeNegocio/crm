<?php

  $accion = $_GET["accion"];
  if ($accion==null){
    $accion='showLoad';
  }

  $target_dir = "custom/landing/";

  $listadoArchivos=listarArchivos($target_dir,"html");


  switch ($accion) {
    case 'showLoad':

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
                <h2> Subida de landing </h2>
                <div class="clear"></div></div>
                
                                <br>
                                
                
                <style>
                
                .link {
                    text-decoration:underline
                }
                </style>                               
                
                <div class="import_instruction">Seleccione la landing que desea importar</div>
                
                <div class="hr"></div>
                
                <form enctype="multipart/form-data" name="importstep2" method="POST" action="index.php?entryPoint=loadTemplates&accion=load">
                <input type="hidden" name="module" value="Import">
                <input type="hidden" name="custom_delimiter" value=",">
                <input type="hidden" name="custom_enclosure" value="">
                <input type="hidden" name="source" value="">
                <input type="hidden" name="source_id" value="">
                <input type="hidden" name="action" value="Confirm">
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="import_module" value="landing">
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
                            <td align="left" scope="row" colspan="3"><label for="userfile">Seleccione un archivo:</label> <input type="hidden"><input size="20" id="userfile" name="userfile" type="file" accept=".html"> &nbsp;<img border="0" onclick="return SUGAR.util.showHelpTips(this,\'Seleccione un archivo que contenga datos separados por un delimitador, ya sea por comas o por tabulaciones. Se recomienda archivos .csv.\' );"  alt="Información" class="inlineHelpTip"></td>
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
                                
                
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr>
                  <td align="left">
                              <input title="Siguiente >" class="button" type="submit" name="button" value="  Siguiente >  " id="gonext">
                    </td>
                </tr>
                </tbody></table>
                
                 <br>
                
                Plantillas:<br>'.$listadoArchivos.'<br>
                
                </script>  
                </form>
                
                            </div>
                    </div>
                </div>
                
                
                </script><!--end body panes-->
        </td></tr></tbody></table>';

      break;

    case 'load' :

      $target_file = $target_dir . basename($_FILES["userfile"]["name"]);

      echo "Procesando fichero: " . $target_file . "<br>";

      validateFile($target_file);

      break;

    default :
      break;
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
    if ($imageFileType != "html") {
      echo "Solo se pueden cargar ficheros de tipo html.<br>";
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

  function listarArchivos( $path,$fileExtension ){
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);

    $out='<ul>';

    while ($elemento = readdir($dir)){
      if( $elemento != "." && $elemento != ".." && $elemento){

        if(! is_dir($path.$elemento) ){
          $ext = substr($elemento, strrpos($elemento, '.') + 1);
          if ($ext==$fileExtension){
            $out .= "<li>" . $elemento."</li>";
          }
        }
      }
    }
    return $out.'</ul>';
  }

?>