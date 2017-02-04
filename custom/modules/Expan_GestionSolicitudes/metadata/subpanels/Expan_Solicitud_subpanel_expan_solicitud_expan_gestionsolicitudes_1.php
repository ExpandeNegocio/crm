<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    $module_name='Expan_GestionSolicitudes';
    $subpanel_layout = array(
        'top_buttons' => array(
            array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '1',),
              array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '2',),
             array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '3',),
              array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '4',),
              array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '5',),
        ),
    
        'where' => '',
    
        'list_fields' => array(
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
                'width' => '25%',
                'default' => true,
              ),
              'estado_sol' => 
              array (
                'type' => 'enum',
                'studio' => 'visible',
                'default' => true,
                'vname' => 'Estado',
                'width' => '10%',
              ),
              
             'subestado' => 
              array (               
                'studio' => 'visible',                
                'vname' => 'LBL_SUBESTADO',
                'width' => '20%',
              ),
                            
            'tipo_origen' => 
              array (               
                'studio' => 'visible',                
                'vname' => 'Origen',
                'width' => '10%',
              ),
              
              'suborigen' => 
              array (               
                'studio' => 'visible',                
                'vname' => 'LBL_SUBORIGEN',
                'width' => '20%',
              ),
               
             'date_entered' => 
              array (
                'vname' => 'LBL_DATE_ENTERED',
                'width' => '20%',
                'default' => true,
              ),
              
              'date_modified' => 
              array (
                'vname' => 'LBL_DATE_MODIFIED',
                'width' => '20%',
                'default' => true,
              ),
              
              'prioridad'=> 
              array (
                'vname' => 'LBL_PRIORIDAD',
                'width' => '10%',
                'default' => true,
              ),
              
              'edit_button' => 
              array (
                'vname' => 'LBL_EDIT_BUTTON',
                'widget_class' => 'SubPanelEditButton',
                'module' => 'Expan_GestionSolicitudes',
                'width' => '10%',
                'default' => true,
              ),
              'remove_button' => 
              array (
                'vname' => 'LBL_REMOVE',
                'widget_class' => 'SubPanelDeleteButton',
                'module' => 'Expan_GestionSolicitudes',
                'width' => '10%',
                'default' => true,
              ),
        ),
);
?>
