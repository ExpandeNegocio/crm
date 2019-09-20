<?php
// created: 2015-12-06 11:21:05

$subpanel_layout['where'] ='';

global $current_user;

if  ($current_user->id=='875daf39-76a9-4eb7-2fbc-53c7fa8dec18' || 
    $current_user->id=='71f40543-2702-4095-9d30-536f529bd8b6'){
    
    $subpanel_layout['list_fields'] = array (
    
      'Accesos' => 
          array (
            'width' => '2%',
            'label' => 'Sel',
            'sortable' => false,
            'widget_class' => 'SelectField',
            'default' => true,
      ),
    
      'name' => 
      array (
        'vname' => 'LBL_NAME',
        'widget_class' => 'SubPanelDetailViewLink',
        'width' => '20%',
        'default' => true,
      ),
      'assigned_user_name' => 
      array (
        'name' => 'assigned_user_name',
        'vname' => 'LBL_ASSIGNED_USER',
        'widget_class' => 'SubPanelDetailViewLink',
        'target_record_key' => 'assigned_user_id',
        'target_module' => 'Employees',
        'width' => '20%',
        'default' => true,
      ),
      'tipo_cuenta' => 
      array (
        'vname' => 'LBL_TIPO_CUENTA',
        'width' => '15%',
        'default' => true,
      ),
    
      'tipo_participacion'=> array(
        'vname' => 'Tipo de Participacion',
        'sortable' => false,            
        'width' => '15%',
      ), 
      'formato_participacion'=> array(
        'vname' => 'Formato Participacion',
        'sortable' => false,            
        'width' => '15%',   
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
      'coste_accion_solicitud'=> array(
        'vname' => 'Coste Acción por solicitud',
        'sortable' => false,            
        'width' => '15%',   
      ),
      'total_gestiones'=> array(
        'vname' => 'LBL_TOTALGESTIONES',
        'sortable' => false,            
        'width' => '10%',
      ),     
      
      'sol_expande_franq'=> array(
        'vname' => 'LBL_SOL_EXPANDE_FRANQ',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_franq_misma'=> array(
        'vname' => 'LBL_SOL_FRANQ_MISMA',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_franq_tablet'=> array(
        'vname' => 'LBL_SOL_FRANQ_TABLET',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_rating_a_plus'=> array(
        'vname' => 'LBL_SOL_RATING_A_PLUS',
        'sortable' => false,            
        'width' => '10%',
      ), 
       'sol_rating_a'=> array(
        'vname' => 'LBL_SOL_RATING_A',
        'sortable' => false,            
        'width' => '10%',
      ), 
       'sol_rating_b'=> array(
        'vname' => 'LBL_SOL_RATING_B',
        'sortable' => false,            
        'width' => '10%',
      ), 
       'sol_rating_c'=> array(
        'vname' => 'LBL_SOL_RATING_C',
        'sortable' => false,            
        'width' => '10%',
      ), 
      'sol_rating_topo'=> array(
        'vname' => 'LBL_SOL_RATING_TOPO',
        'sortable' => false,            
        'width' => '10%',
      ),   
      'sol_rating_no_rating'=> array(
        'vname' => 'LBL_SOL_RATING_NO_RATING',
        'sortable' => false,            
        'width' => '10%',
      ), 
      
      'dummies'=> array(
        'vname' => 'LBL_DUMMIES',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'edit_button' => 
      array (
        'vname' => 'LBL_EDIT_BUTTON',
        'widget_class' => 'SubPanelEditButton',
        'module' => 'Expan_Franquicia',
        'width' => '10%',
        'default' => true,
      ),
    
      'remove_button' => 
      array (
        'vname' => 'LBL_REMOVE',
        'widget_class' => 'SubPanelRemoveButton',
        'module' => 'Expan_Franquicia',
        'width' => '10%',
        'default' => true,
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
    );
    
    
}else{

    $subpanel_layout['list_fields'] = array (
    
      'Accesos' => 
          array (
            'width' => '2%',
            'label' => 'Sel',
            'sortable' => false,
            'widget_class' => 'SelectField',
            'default' => true,
      ),
    
      'name' => 
      array (
        'vname' => 'LBL_NAME',
        'widget_class' => 'SubPanelDetailViewLink',
        'width' => '20%',
        'default' => true,
      ),
      'assigned_user_name' => 
      array (
        'name' => 'assigned_user_name',
        'vname' => 'LBL_ASSIGNED_USER',
        'widget_class' => 'SubPanelDetailViewLink',
        'target_record_key' => 'assigned_user_id',
        'target_module' => 'Employees',
        'width' => '20%',
        'default' => true,
      ),
      'tipo_cuenta' => 
      array (
        'vname' => 'LBL_TIPO_CUENTA',
        'width' => '15%',
        'default' => true,
      ),
    
      'tipo_participacion'=> array(
        'vname' => 'Tipo de Participacion',
        'sortable' => false,            
        'width' => '15%',
      ), 
      'formato_participacion'=> array(
        'vname' => 'Formato Participacion',
        'sortable' => false,            
        'width' => '15%',   
      ),   
      'total_gestiones'=> array(
        'vname' => 'LBL_TOTALGESTIONES',
        'sortable' => false,            
        'width' => '10%',
      ),
      
       'sol_expande_franq'=> array(
        'vname' => 'LBL_SOL_EXPANDE_FRANQ',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_franq_misma'=> array(
        'vname' => 'LBL_SOL_FRANQ_MISMA',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_franq_tablet'=> array(
        'vname' => 'LBL_SOL_FRANQ_TABLET',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_rating_a_plus'=> array(
        'vname' => 'LBL_SOL_RATING_A_PLUS',
        'sortable' => false,            
        'width' => '10%',
      ), 
       'sol_rating_a'=> array(
        'vname' => 'LBL_SOL_RATING_A',
        'sortable' => false,            
        'width' => '10%',
      ), 
       'sol_rating_b'=> array(
        'vname' => 'LBL_SOL_RATING_B',
        'sortable' => false,            
        'width' => '10%',
      ), 
       'sol_rating_c'=> array(
        'vname' => 'LBL_SOL_RATING_C',
        'sortable' => false,            
        'width' => '10%',
      ), 
      'sol_rating_topo'=> array(
        'vname' => 'LBL_SOL_RATING_TOPO',
        'sortable' => false,            
        'width' => '10%',
      ),   
      'sol_rating_no_rating'=> array(
        'vname' => 'LBL_SOL_RATING_NO_RATING',
        'sortable' => false,            
        'width' => '10%',
      ), 
      
      'dummies'=> array(
        'vname' => 'LBL_DUMMIES',
        'sortable' => false,            
        'width' => '10%',
      ),
      
      'sol_mailings'=> array(
        'vname' => 'LBL_SOL_MAILINGS',
        'sortable' => false,            
        'width' => '10%',
      ),
      
        'edit_button' => 
      array (
        'vname' => 'LBL_EDIT_BUTTON',
        'widget_class' => 'SubPanelEditButton',
        'module' => 'Expan_Franquicia',
        'width' => '10%',
        'default' => true,
      ),
    
      'remove_button' => 
      array (
        'vname' => 'LBL_REMOVE',
        'widget_class' => 'SubPanelRemoveButton',
        'module' => 'Expan_Franquicia',
        'width' => '10%',
        'default' => true,
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
    );
}
?>