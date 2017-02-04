<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    $module_name='Expan_Documentacion';
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
              array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '6',),
              array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '7',),
              array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '8',),
                array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '9',),
               array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '10',),
               array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '11',),
               array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '12',),
               array('widget_class' => 'SubPanelTopChangeStateButton',
             'estado' => '15',),
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
              'date_modified' => 
              array (
                'vname' => 'LBL_DATE_MODIFIED',
                'width' => '20%',
                'default' => true,
              ),
              
              'edit_button' => 
              array (
                'vname' => 'LBL_EDIT_BUTTON',
                'widget_class' => 'SubPanelEditButton',
                'module' => 'Expan_Documentacion',
                'width' => '5%',
                'default' => true,
              ),
              'remove_button' => 
              array (
                'vname' => 'LBL_REMOVE',
                'widget_class' => 'SubPanelRemoveButton',
                'module' => 'Expan_Documentacion',
                'width' => '5%',
                'default' => true,
              ),
        ),
);
?>
