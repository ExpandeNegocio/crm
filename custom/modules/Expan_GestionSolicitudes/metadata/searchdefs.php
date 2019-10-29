<?php
$module_name = 'Expan_GestionSolicitudes';
$searchdefs [$module_name] =
  array(
    'layout' =>
      array(
        'basic_search' =>
          array(
            0 => 'name',
            1 =>
              array(
                'name' => 'current_user_only',
                'label' => 'LBL_CURRENT_USER_FILTER',
                'type' => 'bool',
              ),
          ),
        'advanced_search' =>
          array(
            'name' =>
              array(
                'name' => 'name',
                'default' => true,
                'width' => '10%',
              ),
            'candidatura_avanzada' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'LBL_CANDIDATURA_AVANZADA',
                'width' => '10%',
                'name' => 'candidatura_avanzada',
              ),
            'chk_envio_contrato' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Envio contrato',
                'width' => '10%',
                'name' => 'chk_envio_contrato',
              ),
            'franquicia' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_FRANQUICIA',
                'width' => '10%',
                'default' => true,
                'name' => 'franquicia',
              ),
            'candidatura_caliente' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Candidatura caliente',
                'width' => '10%',
                'name' => 'candidatura_caliente',
              ),

            'chk_gestionado_central' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'LBL_CHK_GESTIONADO_CENTRAL',
                'width' => '10%',
                'name' => 'chk_gestionado_central',
              ),

            'chk_visita_central' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Visita Central',
                'width' => '10%',
                'name' => 'chk_visita_central',
              ),
            'provincia_apertura_1' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_PROVINCIA_APERTURA_1',
                'width' => '10%',
                'default' => true,
                'name' => 'provincia_apertura_1',
              ),
            'chk_envio_documentacion' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Envio de documentacion inicial',
                'width' => '10%',
                'name' => 'chk_envio_documentacion',
              ),
            'rating' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_RATING',
                'width' => '10%',
                'default' => true,
                'name' => 'rating',
              ),
            'pais_apertura' =>
              array(
                'type' => 'enum',
                'label' => 'LBL_PAIS_APERTURA',
                'width' => '10%',
                'default' => true,
                'name' => 'pais_apertura',
              ),
            'chk_responde_C1' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Responde a C1',
                'width' => '10%',
                'name' => 'chk_responde_C1',
              ),
            'estado_sol' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'default' => true,
                'label' => 'LBL_ESTADO_SOL',
                'width' => '10%',
                'name' => 'estado_sol',
              ),
            'tipo_origen' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_TIPO_ORIGEN',
                'width' => '10%',
                'default' => true,
                'name' => 'tipo_origen',
              ),
            'chk_resolucion_dudas' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Resolucion de primeras dudas',
                'width' => '10%',
                'name' => 'chk_resolucion_dudas',
              ),
            'motivo_descarte' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_MOTIVO_DESCARTE',
                'width' => '10%',
                'default' => true,
                'name' => 'motivo_descarte',
              ),
            'portal' =>
              array(
                'type' => 'enum',
                'default' => true,
                'studio' => 'visible',
                'label' => 'LBL_PORTAL',
                'width' => '10%',
                'name' => 'portal',
              ),
            'chk_recepcio_cuestionario' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Recepción del cuestionario',
                'width' => '10%',
                'name' => 'chk_recepcio_cuestionario',
              ),
            'motivo_parada' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_MOTIVO_PARADA',
                'width' => '10%',
                'default' => true,
                'name' => 'motivo_parada',
              ),
            'expan_evento_id_c' =>
              array(
                'type' => 'enum',
                'default' => true,
                'studio' => 'visible',
                'label' => 'LBL_EVENTO',
                'width' => '10%',
                'name' => 'expan_evento_id_c',
              ),
            'chk_informacion_adicional' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Envio Información adicional',
                'width' => '10%',
                'name' => 'chk_informacion_adicional',
              ),
            'motivo_positivo' =>
              array(
                'type' => 'enum',
                'studio' => 'visible',
                'label' => 'LBL_MOTIVO_POSITIVO',
                'width' => '10%',
                'default' => true,
                'name' => 'motivo_positivo',
              ),
            'date_entered' =>
              array(
                'type' => 'datetime',
                'label' => 'LBL_DATE_ENTERED',
                'width' => '10%',
                'default' => true,
                'name' => 'date_entered',
              ),
            'chk_entrevista' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Entrevista',
                'width' => '10%',
                'name' => 'chk_entrevista',
              ),
            'perfil_ideoneo' =>
              array(
                'type' => 'bool',
                'studio' => 'visible',
                'label' => 'LBL_PERFIL_IDONEO',
                'width' => '10%',
                'default' => true,
                'name' => 'perfil_ideoneo',
              ),
            'date_modified' =>
              array(
                'type' => 'datetime',
                'label' => 'LBL_DATE_MODIFIED',
                'width' => '10%',
                'default' => true,
                'name' => 'date_modified',
              ),
            'chk_visitado_fran' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Visitado franquiciado/unidad propia',
                'width' => '10%',
                'name' => 'chk_visitado_fran',
              ),
            'oportunidad_inmediata' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
                'width' => '10%',
                'name' => 'oportunidad_inmediata',
              ),
            'assigned_user_id' =>
              array(
                'name' => 'assigned_user_id',
                'label' => 'LBL_ASSIGNED_TO',
                'type' => 'enum',
                'function' =>
                  array(
                    'name' => 'get_user_array',
                    'params' =>
                      array(
                        0 => false,
                      ),
                  ),
                'default' => true,
                'width' => '10%',
              ),
            'chk_envio_precontrato' =>
              array(
                'type' => 'bool',
                'default' => true,
                'label' => 'Envio precontrato',
                'width' => '10%',
                'name' => 'chk_envio_precontrato',
              ),
          ),
      ),
    'templateMeta' =>
      array(
        'maxColumns' => '3',
        'maxColumnsBasic' => '4',
        'widths' =>
          array(
            'label' => '10',
            'field' => '30',
          ),
      ),
  );
?>
