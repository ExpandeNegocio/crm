<?php
$module_name = 'Expma_Mailing';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
        'includes' => array (
            0 =>array ('file' => 'include/javascript/EditMailing.js',),
            1 =>array ('file' => 'include/javascript/include.js"',),
        ),
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DELETE',
          2 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="generarMailing(\'{$fields.id.value}\',\'{$fields.plantilla.value}\',\'{$fields.chk_por_franquicia.value}\');" value="Lanzar Mailing">{/if}',
            ),            
          3 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="inicia" id="inicia" class="submit" 
                    onClick="reinicializarMailing(\'{$fields.id.value}\',\'{$fields.plantilla.value}\',\'{$fields.chk_por_franquicia.value}\');" value="Limpiar Mailing">{/if}',
            ),
          
        ),
      ),
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'plantilla',
            'studio' => 'visible',
            'label' => 'LBL_PLANTILLA',
          ),
        ),
        
        1 => 
        array (
          0 => 
          array (
            'name' => 'texto_informe',
            'label' => 'LBL_TEXTO_INFORME',
          ),
          1 => 
          array (
            'name' => 'n_reenvios',
            'label' => 'LBL_N_REENVIOS',
          ),
        ),        

        2 => 
        array (
          0 => 
          array (
            'name' => 'evento',
            'label' => 'LBL_EVENTO_ASOCIADO',
          ),
          1 => 
          array (

          ),
        ),

        3 => 
        array (
          0 => 
          array (
            'name' => '',
          ),
          1 => 
          array (
            'name' => 'total_correos',
            'label' => 'LBL_TOTALCORREOS',
          ),
        ),
        
        4 => 
        array (
          0 => 
          array (
            'name' => '',
          ),
          1 => 
          array (
            'name' => 'correos_protocolo',
            'label' => 'LBL_CORREOSPROTOCOLO',
          ),
        ),
                
        5 => 
        array (
          0 => 
          array (
            'name' => 'fecha_primer_envio',
            'label' => 'LBL_FECHA_PRIMER_ENVIO',
          ),
          1 => 
          array (
            'name' => 'correos_ok',
            'label' => 'LBL_CORREOS_OK',
          ),
        ),
        
        6 => 
        array (
          0 => 
          array (
            'name' => 'fecha_ultimo_envio',
            'label' => 'LBL_FECHA_ULTIMO_ENVIO',
          ),
          1 => 
          array (
            'name' => 'correos_ko',
            'label' => 'LBL_CORREOS_KO',
          ),
        ),
                     
        7=> 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'guardar_correo',
            'label' => 'LBL_GUARDAR_CORREO',
          ),  
        ),
      ),
    ),
  ),
);
?>
