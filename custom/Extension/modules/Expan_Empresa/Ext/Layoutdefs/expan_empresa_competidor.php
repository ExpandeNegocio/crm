<?php
$layout_defs["Expan_Empresa"]["subpanel_setup"]['expan_empresa_competidores'] = array (
      'order' => 100,
      'module' => 'Expan_Empresa',
      'subpanel_name' => 'default',
      'sort_order' => 'asc',
      'sort_by' => 'id',
      'title_key' => 'LBL_EXPAN_EMPRESA_COMPETIDOR_TITLE',
      'get_subpanel_data' => 'expan_empresa_competidores',
      'top_buttons' => 
      array (
        0 => 
        array (
          'widget_class' => 'SubPanelTopSelectButton',
          'mode' => 'MultiSelect',
        ),
        1 => 
        array (
          'widget_class' => 'SubPanelTopChangeCompetidorTipoButton',
          'tipoComp' => 'CD',
        ),   
        2 =>
        array (
          'widget_class' => 'SubPanelTopChangeCompetidorTipoButton',
          'tipoComp' => 'CI',
        ), 
        3 =>
        array (
          'widget_class' => 'SubPanelTopChangeCompetidorPrinButton',
        ),   
      ),           
      
      'list_fields' => array(
            'name'=>array(
                'vname' => 'LBL_NAME',
                'widget_class' => 'SubPanelDetailViewLink',
                'width' => '25%',
            ),
            'date_modified'=>array(
                'vname' => 'LBL_DATE_MODIFIED',
                'width' => '25%',
            ),    
            'e_tipo_competidor' => array (
                'usage' => 'query_only',
             ), 
               
        ),           
    );
?>
