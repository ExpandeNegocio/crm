<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

$dictionary['Expan_Evento'] = array(
	'table'=>'expan_evento',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
  'year' => 
  array (
    'required' => true,
    'name' => 'year',
    'vname' => 'LBL_YEAR',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '4',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
    'min' => 2000,
    'max' => 2100,
    'validation' => 
    array (
      'type' => 'range',
      'min' => 2000,
      'max' => 2100,
    ),
  ),
  
  'num_rev' => 
  array (
    'required' => true,
    'name' => 'num_rev',
    'vname' => 'LBL_REVISTAS',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '4',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
  ),
  
  'fecha_celebracion' => 
  array (
    'required' => true,
    'name' => 'fecha_celebracion',
    'vname' => 'LBL_FECHA_CELEBRACION',
    'type' => 'date',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => false,
  ),
  
    'fecha_fin' => 
  array (
    'required' => true,
    'name' => 'fecha_fin',
    'vname' => 'LBL_FECHA_FIN',
    'type' => 'date',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => false,
  ),
  
  'ciudad' => 
  array (
    'required' => false,
    'name' => 'ciudad',
    'vname' => 'LBL_CIUDAD',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'cuerpo' => 
  array (
    'required' => false,
    'name' => 'cuerpo',
    'vname' => 'LBL_CUERPO',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '4000',
    'studio' => 'visible',
    'rows' => '40',
    'cols' => '60',
  ),
  
  'observaciones' => 
  array (
    'required' => false,
    'name' => 'observaciones',
    'vname' => 'LBL_OBSERVACIONES',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '4000',
    'studio' => 'visible',
    'rows' => '6',
    'cols' => '80',
  ),
  
   'tipo_evento' => 
  array (
    'required' => false,
    'name' => 'tipo_evento',
    'vname' => 'LBL_TIPO_EVENTO',
    'type' => 'enum',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'lst_tipo_evento',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
    //ESTADISTICAS
  
  'total_solicitudes' => 
  array (
    'required' => false,
    'name' => 'total_solicitudes',
    'vname' => 'LBL_TOTAL_SOLICITUDES',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
  
  'total_gestiones' => 
  array (
    'required' => false,
    'name' => 'total_gestiones',
    'vname' => 'LBL_TOTAL_GESTIONES',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
  
  'empresas_ratio_sg' => 
  array (
    'required' => false,
    'name' => 'empresas_ratio_sg',
    'vname' => 'LBL_TOTAL_EMPRESAS_RATIO_SG',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
  
  'total_empresas_parti' => 
  array (
    'required' => false,
    'name' => 'total_empresas_parti',
    'vname' => 'LBL_TOTAL_EMPRESAS_PARTI',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
  
  'total_gest_EN' => 
  array (
    'required' => false,
    'name' => 'total_gest_EN',
    'vname' => 'LBL_TOTAL_GEST_EN',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
  
  'total_gest_Cliente' => 
  array (
    'required' => false,
    'name' => 'total_gest_Cliente',
    'vname' => 'LBL_TOTAL_GEST_CLIENTE',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'total_gest_tablet' => 
  array (
    'required' => false,
    'name' => 'total_gest_tablet',
    'vname' => 'LBL_TOTAL_GEST_TABLET',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'total_gest_fran_part' => 
  array (
    'required' => false,
    'name' => 'total_gest_fran_part',
    'vname' => 'LBL_TOTAL_GEST_PART',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'total_gest_fran_nopart' => 
  array (
    'required' => false,
    'name' => 'total_gest_fran_nopart',
    'vname' => 'LBL_TOTAL_GEST_NOPART',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  
  'total_empresas_con_stand' => 
  array (
    'required' => false,
    'name' => 'total_empresas_con_stand',
    'vname' => 'LBL_TOTAL_EMPRESAS_CON_STAND',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
  
  'total_empresas_corner' => 
  array (
    'required' => false,
    'name' => 'total_empresas_corner',
    'vname' => 'LBL_TOTAL_EMPRESAS_CORNER',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'total_empresas_compartido' => 
  array (
    'required' => false,
    'name' => 'total_empresas_compartido',
    'vname' => 'LBL_TOTAL_EMPRESAS_COMPARTIDO',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'total_empresas_mesa_inde' => 
  array (
    'required' => false,
    'name' => 'total_empresas_mesa_inde',
    'vname' => 'LBL_TOTAL_EMPRESAS_MESA_INDE',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'total_empresas_mesa_compa' => 
  array (
    'required' => false,
    'name' => 'total_empresas_mesa_compa',
    'vname' => 'LBL_TOTAL_EMPRESAS_MESA_COMPA',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ),
  
  'sol_unicas' => 
  array (
    'required' => false,
    'name' => 'sol_unicas',
    'vname' => 'LBL_SOL_UNICAS',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',    
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',        
    'source' => 'non-db',
  ), 
 
 'consultores' => 
  array (
    'required' => false,
    'name' => 'consultores',
    'vname' => 'LBL_CONSULTORES',
    'type' => 'multienum',
    'massupdate' => 0,
    'no_default' => true,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'options' => 'usuarios_list',
    'studio' => 'visible',
    'isMultiSelect' => true,
  ),
  
  'total_rating_real_a_plus' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_real_a_plus',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_SOL_RATING_REAL_A_PLUS',
     'importable' => 'false',
   ),
   
   'total_rating_real_a' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_real_a',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_REAL_A',
     'importable' => 'false',
   ),
   
   'total_rating_real_b' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_real_b',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_REAL_B',
     'importable' => 'false',
   ),
  
   'total_rating_real_c' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_real_c',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_REAL_C',
     'importable' => 'false',
   ),  
  
   'total_rating_real_topo' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_real_topo',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_REAL_TOPO',
     'importable' => 'false',
   ),  
  
   'total_rating_real_norating' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_real_norating',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_REAL_NORATING',
     'importable' => 'false',
   ),  
   
   'total_rating_orig_a_plus' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_orig_a_plus',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_SOL_RATING_ORIG_A_PLUS',
     'importable' => 'false',
   ),
   
   'total_rating_orig_a' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_orig_a',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_ORIG_A',
     'importable' => 'false',
   ),
   
   'total_rating_orig_b' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_orig_b',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_ORIG_B',
     'importable' => 'false',
   ),
  
   'total_rating_orig_c' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_orig_c',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_ORIG_C',
     'importable' => 'false',
   ),  
  
   'total_rating_orig_topo' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_orig_topo',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_ORIG_TOPO',
     'importable' => 'false',
   ),  
  
   'total_rating_orig_norating' =>
     array(
     'massupdate' => false,
     'name' => 'total_rating_orig_norating',
     'type' => 'int',
     'studio' => 'false',
     'source' => 'non-db',
     'vname' => 'LBL_TOTAL_RATING_ORIG_NORATING',
     'importable' => 'false',
   ),
   
  'incidencias' => 
  array (
    'required' => false,
    'name' => 'incidencias',
    'vname' => 'LBL_INCIDENCIAS',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '4000',
    'studio' => 'visible',
    'rows' => '40',
    'cols' => '60',
  ),
  
  'mejoras' => 
  array (
    'required' => false,
    'name' => 'mejoras',
    'vname' => 'LBL_MEJORAS',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '4000',
    'studio' => 'visible',
    'rows' => '40',
    'cols' => '60',
  ),

  'citas_solicitadas' =>
    array (
      'required' => false,
      'name' => 'citas_solicitadas',
      'vname' => 'LBL_CITAS_SOLICITADAS',
      'type' => 'int',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'source' => 'non-db',
    ),

  'citas_realizadas_con_cita' =>
    array (
      'required' => false,
      'name' => 'citas_realizadas_con_cita',
      'vname' => 'LBL_CITAS_REALIZADAS_CON_CITA',
      'type' => 'int',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'source' => 'non-db',
    ),

  'citas_realizadas_sin_cita' =>
    array (
      'required' => false,
      'name' => 'citas_realizadas_sin_cita',
      'vname' => 'LBL_CITAS_REALIZADAS_SIN_CITA',
      'type' => 'int',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'source' => 'non-db',
    ),

  'citas_canceladas' =>
    array (
      'required' => false,
      'name' => 'citas_canceladas',
      'vname' => 'LBL_CITAS_CANCELADAS',
      'type' => 'int',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'source' => 'non-db',
    ),

  'citas_no_acuden' =>
    array (
      'required' => false,
      'name' => 'citas_no_acuden',
      'vname' => 'LBL_CITAS_NO_ACUDEN',
      'type' => 'int',
      'massupdate' => 0,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'source' => 'non-db',
    ),

  
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('Expan_Evento','Expan_Evento', array('basic','assignable'));