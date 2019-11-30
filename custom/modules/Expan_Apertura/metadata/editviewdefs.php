<?php

$id = $_REQUEST["record"];
if ($id == "") {
  $id = $_POST["record"];
}
if ($id == "") {
  $id = $_GET["record"];
}
if ($id == "") {
  $id = $_SESSION["Expan_Apertura_detailview_record"];
}

$apertura = new Expan_Apertura();
$apertura->retrieve($id);

function getBotonGoGest(Expan_Apertura $apertura)
{
  $goGestion = "";
  if ($apertura->gestion == "") {
    $goGestion = '<a href="javascript:void(0)" style="cursor: default;">
               <input disabled style="cursor: default;" type="button" value="Ir Gestion">
            </a>';
  } else {
    $goGestion = '<a href="index.php?module=Expan_GestionSolicitudes&action=DetailView&record={$fields.gestion.value} ">
               <button>Ir Gestion</button>
            </a>';
  }
  return $goGestion;
}

function getBotonGoFcdo(Expan_Apertura $apertura)
{
  $goFcdo = "";
  if ($apertura->expan_franquiciado_id == "") {
    $goFcdo = '<a href="javascript:void(0)" style="cursor: default;">
               <input disabled style="cursor: default;" type="button" value="Ir Franquiciado">
            </a>';
  } else {
    $goFcdo = '<a href="index.php?module=Expan_Franquiciado&action=DetailView&record={$fields.expan_franquiciado_id.value} ">
               <button>Ir Franquiciado</button>
            </a>';
  }
  return $goFcdo;
}

$module_name = 'Expan_Apertura';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
    'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input type="submit" name="save" id="save" class="submit" 
                onClick="        
                    this.form.return_action.value=\'DetailView\'; 
                    this.form.action.value=\'Save\';             
                    var valido=controlarDuplicados(\'{$fields.id.value}\');       
                    return valido;" 
                value="Guardar">',
          ),
          1 => 'CANCEL',
          2 => array (
            'customCode' => getBotonGoGest($apertura),
          ),
          3 => array (
            'customCode' => getBotonGoFcdo($apertura),
          ),
        ),
      ),
      
      'javascript' => '{sugar_getscript file="include/javascript/jquery.js"}
      {sugar_getscript file="include/javascript/EditApertura.js"}',
    
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
    
    'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_GENERAL' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),             
        'LBL_ADMINISTRACION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),        
      ),
     ),
    'panels' => 
    array (
      'lbl_general' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 
          array (
            'name' => 'franquicia',
            'studio' => 'visible',
            'link' => true,
            'label' => 'LBL_FRANQUICIA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (           
          ),
          1 => 
          array (
            'name' => 'otra_franquicia',
            'label' => 'LBL_OTRA_FRANQUICIA',
          ),
        ),                
        2 => 
        array (
          0 => 
          array (
            'name' => 'tipo_apertura',
            'label' => 'LBL_TIPO_APERTURA',
          ),
          1 => 
          array (
            'name' => 'provincia_apertura',
            'label' => 'LBL_PROVINCIA_APERTURA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'abierta',
            'label' => 'LBL_ABIERTA',
          ),
          1 => 
          array (
            'name' => 'localidad_apertura',
            'label' => 'LBL_LOCALIDAD_APERTURA',
          ),
        ),
        
        4 => 
        array (
          0 => 
          array (
        
          ),
          1 => 
          array (
            'name' => 'direccion',
            'label' => 'LBL_DIRECCION',
          ),
        ),
        
        5 => 
        array (
          0 => 
          array (
              'name' => 'motivos_apertura',
                'studio' => 'visible',
                'label' => 'LBL_MOTIVOS_APERTURA',
          ), 
          1 => 
          array (
            'name' => 'incidencias',
            'studio' => 'visible',
            'label' => 'LBL_INCIDENCIAS',   
          ), 
        ),
        6 =>
        array(
            0 => 
            array(
                'name' => 'valoracion',
                'studio' => 'visible',
                'label' => 'LBL_VALORACION_FRAN',
            ),
            1 =>
            array(
                 'name' => 'num_empleados',
                'label' => 'LBL_NUM_EMPLEADOS',
            ),
        ),
        7 =>
         array(
            0 =>
            array(
                'name' => 'area_exclusividad',
                'label' => 'LBL_AREA_EXCLUSIVIDAD',
            ),
            1 =>
            array(
                'name' => 'inversion_inicial',
                'label' => 'LBL_INVERSION_INICIAL',
            ),
            
         ),
         8 =>
         array(
            0 =>
            array(
                'name' => 'f_inicio_contrato',
                'label' => 'LBL_FECHA_INICIO_CONTRATO',
            ),
            1 =>
            array(
                'name' => 'f_renovacion_contrato',
                'label' => 'LBL_FECHA_RENOVACION_CONTRATO',
            ),
            
         ),
         9 =>
         array(
            0 =>
            array(
                'name' => 'f_baja_contrato',
                'label' => 'LBL_FECHA_BAJA_CONTRATO',
            ),
            1 =>
            array(
                'name' => 'motivo_baja',
                'label' => 'LBL_MOTIVO_BAJA',
            ),
            
         ),
         
         10 =>
         array(
            0 =>
            array(
                'name' => 'observaciones',
                'label' => 'LBL_OBSERVACIONES',
            ),        
         ),                   
      ),                        
          
          'LBL_ADMINISTRACION' => 
          array (
          
             0 =>
             array(
                0 =>
                array(
                    'name' => 'Comision_cons_cartera',
                    'label' => 'LBL_COMISION_CONS_CARTERA',
                ),                      
             ),
          
             1 =>
             array(
                0 =>
                array(
                    'name' => 'f_ini_com_cons_cartera',
                    'label' => 'LBL_FECHA_INI_COM_CONS_CARTERA',
                ),
                1 =>
                array(
                    'name' => 'f_fin_com_cons_cartera',
                    'label' => 'LBL_FECHA_FIN_COM_CONS_CARTERA',
                ),            
             ),
          
          ),
      
       ),
      
    ),
);
?>
