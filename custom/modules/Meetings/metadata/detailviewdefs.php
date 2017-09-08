<?php
$viewdefs ['Meetings'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' =>
    array(
    'includes' => array (
            0 =>array ('file' => 'include/javascript/limpiarReunionDetail.js',),
            ),
    ),
    array (
      'form' => 
      array (      
        'buttons' => 
        array (
          0 => 'EDIT',       
          1 => 'DELETE',
        ),
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew">',
          1 => '<input type="hidden" name="status">',
          2 => '<input type="hidden" name="isSaveFromDetailView">',
          3 => '<input type="hidden" name="isSave">',
        ),
        'headerTpl' => 'modules/Meetings/tpls/detailHeader.tpl',
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
    ),
    
    'panels' => 
    array (
      'lbl_meeting_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'meeting_type',
            'label' => 'LBL_MEETING_TYPE',
          ),
          1 => 'status',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'label' => 'LBL_DATE_TIME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'duration',
            'customCode' => '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV} ',
            'label' => 'LBL_DURATION',
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'customLabel' => '{sugar_translate label=\'LBL_MODULE_NAME\' module=$fields.parent_type.value}',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'reminder_time',
            'customCode' => '{include file="modules/Meetings/tpls/reminders.tpl"}',
            'label' => 'LBL_REMINDER',
          ),
          1 => 'location',
        ),
        4 => 
        array (
          0 => 'description',
          1=>array(
            'name' => 'provincia',
            'label' => 'LBL_PROVINCIA_TYPE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'expan_gestionsolicitudes_meetings_1_name',
          ),
          1 => 
          array (
            'name' => 'oportunidad_inmediata',
            'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
          ),
        ),
       
        6 => 
        array (
          0 => 
          array (
           'name' =>'modified_by_name',     
            'label' => 'LBL_MODIFICADO_POR',            
            'comment' => 'Ultimo usuario en modificar',
          ),        
        ),
        
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
           1 => 
          array (
            'name' => 'skype',
            'label' => 'LBL_SKYPE',
          ),
        ),
      ),
    ),
  ),
);
?>
