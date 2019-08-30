<?php 

$layout_defs["Expan_Empresa"]["subpanel_setup"]['expan_empresa_competidor'] = array (
      'order' => 1,
      'module' => 'Expan_Empresa',
      'subpanel_name' => 'default',
      'sort_order' => 'desc',
      'sort_by' => 'id',
      'title_key' => 'LBL_EXPAN_FRANQUICIA_EXPAN_EVENTO_FROM_EXPAN_FRANQUICIA_TITLE',
      'get_subpanel_data' => 'expan_empresa_competidor',
      'top_buttons' => 
      array (
        0 => 
        array (
          'widget_class' => 'SubPanelTopSelectButton',
          'mode' => 'MultiSelect',
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
            
        ),
            
    );
?>