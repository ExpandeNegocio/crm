<?php
// created: 2015-12-06 11:21:05

$subpanel_layout['where'] ='';

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
    'width' => '20%',
    'default' => true,
  ),

  'tipo_participacion'=> array(
    'vname' => 'Participacion tipo',
    'sortable' => false,            
    'width' => '25%',
  ), 
  'num_solicitudes'=> array(
    'vname' => 'LBL_NUMEROSOLICITUDES',
    'sortable' => false,            
    'width' => '25%',
  ),
  
  'sol_rating_a_plus'=> array(
    'vname' => 'LBL_SOL_RATING_A_PLUS',
    'sortable' => false,            
    'width' => '25%',
  ), 
   'sol_rating_a'=> array(
    'vname' => 'LBL_SOL_RATING_A',
    'sortable' => false,            
    'width' => '25%',
  ), 
   'sol_rating_b'=> array(
    'vname' => 'LBL_SOL_RATING_B',
    'sortable' => false,            
    'width' => '25%',
  ), 
   'sol_rating_c'=> array(
    'vname' => 'LBL_SOL_RATING_C',
    'sortable' => false,            
    'width' => '25%',
  ), 
  
  'total_gestiones'=> array(
    'vname' => 'LBL_TOTALGESTIONES',
    'sortable' => false,            
    'width' => '25%',
  ),  
  
  'dummies'=> array(
    'vname' => 'LBL_DUMMIES',
    'sortable' => false,            
    'width' => '25%',
  ),
  
    'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Expan_Franquicia',
    'width' => '14%',
    'default' => true,
  ),

  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Expan_Franquicia',
    'width' => '15%',
    'default' => true,
  ),
  
   'e_participacion' =>
 array (
    'usage' => 'query_only',
 ),

 'franquicia_id' =>
 array (
    'usage' => 'query_only',
 ),
);