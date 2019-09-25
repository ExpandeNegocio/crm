<?php
 // created: 2014-08-01 17:17:40
global $current_user;

if  ($current_user->id=='875daf39-76a9-4eb7-2fbc-53c7fa8dec18' || 
    $current_user->id=='71f40543-2702-4095-9d30-536f529bd8b6'){
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
            'widget_class' => 'SubPanelTopChangeStateFranEvenButton',
            'estado' => '4',
          ),
        5 =>
        array (
          'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
          'formato' => 'SI',
        ),
        6 =>
        array (
          'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
          'formato' => 'CO',
        ),
        7 =>
        array (
          'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
          'formato' => 'SC',
        ),
        8 =>
        array (
          'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
          'formato' => 'MI',
        ),
        9 =>
        array (
          'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
          'formato' => 'MC',
        ),
        10 =>
        array (
          'widget_class' => 'SubPanelTopChangeGastoAsociadoFranEvenButton',      
        ),   
        11 =>
        array (
          'widget_class' => 'SubPanelTopChangeCosteAccionFranEvenButton',      
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
            
            'gastos_asociados'=> array(
                'vname' => 'Gastos Asociados',
                'sortable' => false,            
                'width' => '15%',   
             ),
             'coste_accion'=> array(
                'vname' => 'Coste Acción',
                'sortable' => false,            
                'width' => '15%',   
             ),  
             
             'coste_accion_gestion'=> array(
                'vname' => 'Coste Acción por Solicitud',
                'sortable' => false,            
                'width' => '15%',   
             ),
                             
            'total_gestiones'=> array(
                'vname' => 'total_gestiones',
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
             
             'e_coste_accion' =>
              array (
                'usage' => 'query_only',
             ),
             
            'e_gastos_asociados' =>
              array (
                'usage' => 'query_only',
             ),
            
             'franquicia_id' =>
             array (
                'usage' => 'query_only',
             ),
            ),
      
      
    );
}else{
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
            'widget_class' => 'SubPanelTopChangeStateFranEvenButton',
            'estado' => '4',
          ),
        5 =>
          array (
            'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
            'formato' => 'SI',
          ),
        6 =>
          array (
            'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
            'formato' => 'CO',
          ),
        7 =>
          array (
            'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
            'formato' => 'SC',
          ),
        8 =>
          array (
            'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
            'formato' => 'MI',
          ),
        9 =>
          array (
            'widget_class' => 'SubPanelTopChangeFormatoPartFranEvenButton',
            'formato' => 'MC',
          ),
        10 =>
          array (
            'widget_class' => 'SubPanelTopChangeGastoAsociadoFranEvenButton',
          ),
        11 =>
          array (
            'widget_class' => 'SubPanelTopChangeCosteAccionFranEvenButton',
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
            
            'gastos_asociados'=> array(
                'vname' => 'Gastos Asociados',
                'sortable' => false,            
                'width' => '15%',   
             ),
             'coste_accion'=> array(
                'vname' => 'Coste Acción',
                'sortable' => false,            
                'width' => '15%',   
             ),  
             
             'coste_accion_gestion'=> array(
                'vname' => 'Coste Acción por Solicitud',
                'sortable' => false,            
                'width' => '15%',   
             ),
                             
            'total_gestiones'=> array(
                'vname' => 'total_gestiones',
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
             
             'e_coste_accion' =>
              array (
                'usage' => 'query_only',
             ),
             
            'e_gastos_asociados' =>
              array (
                'usage' => 'query_only',
             ),
            
             'franquicia_id' =>
             array (
                'usage' => 'query_only',
             ),
            ),
      
      
    );
    
}