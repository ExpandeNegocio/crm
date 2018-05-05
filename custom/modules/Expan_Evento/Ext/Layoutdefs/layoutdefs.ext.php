<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2014-08-01 17:17:40
$layout_defs["Expan_Evento"]["subpanel_setup"]['expan_franquicia_expan_evento'] = array (
  'order' => 100,
  'module' => 'Expan_Franquicia',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_FRANQUICIA_EXPAN_EVENTO_FROM_EXPAN_FRANQUICIA_TITLE',
  'get_subpanel_data' => 'expan_franquicia_expan_evento',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopChangeStateFranEvenButton',
      'estado' => '1',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopChangeStateFranEvenButton',
      'estado' => '2',
    ),
    3 => 
    array (
      'widget_class' => 'SubPanelTopChangeStateFranEvenButton',
      'estado' => '3',
    ),
    4 => 
    array (
      'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
      'formato' => 'SI',
    ),
    5 => 
    array (
      'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
      'formato' => 'CO',
    ),
    6 => 
    array (
      'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
      'formato' => 'SC',
    ),
    7 => 
    array (
      'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
      'formato' => 'MI',
    ),
    8 => 
    array (
      'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
      'formato' => 'MC',
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
        
        'tipo_participacion'=> array(
            'vname' => 'Participacion',
            'sortable' => false,            
            'width' => '25%',
        ), 
        
        'formato_participacion'=> array(
            'vname' => 'formato_participacion',
            'sortable' => false,            
            'width' => '25%',
        ),       
        
        'edit_button'=>array(
            'vname' => 'LBL_EDIT_BUTTON',
            'widget_class' => 'SubPanelEditButton',
            'module' => $module_name,
            'width' => '4%',
        ),
        'remove_button'=>array(
            'vname' => 'LBL_REMOVE',
            'widget_class' => 'SubPanelRemoveButton',
            'module' => $module_name,
            'width' => '5%',
        ),
        
         'e_participacion' =>
         array (
            'usage' => 'query_only',
         ),
         
         'e_formato_participacion' =>
         array (
            'usage' => 'query_only',
         ),
        
         'franquicia_id' =>
         array (
            'usage' => 'query_only',
         ),
        ),
  
  
);


//auto-generated file DO NOT EDIT
$layout_defs['Expan_Evento']['subpanel_setup']['expan_franquicia_expan_evento']['override_subpanel_name'] = 'Expan_Evento_subpanel_expan_franquicia_expan_evento';

?>