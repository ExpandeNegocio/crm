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

$dictionary['Expan_Mailings'] = array(
    'table'=>'expan_mailings',
    'audited'=>true,
        'duplicate_merge'=>true,
        'fields'=>array (   
                
      'tipo' => 
      array (
        'required' => false,
        'name' => 'tipo',
        'vname' => 'LBL_TIPO_MAILING',
        'type' => 'enum',
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
        'options' => 'tipo_mailing_list',
        'studio' => 'visible',        
      ),                                    
 
      'herramienta_envio' => 
      array (
        'required' => false,
        'name' => 'herramienta_envio',
        'vname' => 'LBL_HERRAMIENTA_ENVIO',
        'type' => 'varchar',
        'massupdate' => 0,
        'no_default' => false,
        'comments' => '',
        'help' => '',
        'importable' => 'true',
        'duplicate_merge' => 'disabled',
        'duplicate_merge_dom_value' => '0',
        'audited' => true,
        'reportable' => true,
        'unified_search' => false,
        'merge_filter' => 'disabled',
        'len' => '255',
        'size' => '20',
      ),
      
      'fecha_envio' => 
      array (
        'required' => false,
        'name' => 'fecha_envio',
        'vname' => 'LBL_F_ENVIO',
        'type' => 'date',
        'massupdate' => 0,
        'no_default' => false,
        'comments' => '',        
        'importable' => 'true',
        'duplicate_merge' => 'disabled',
        'duplicate_merge_dom_value' => '0',
        'audited' => true,
        'reportable' => true,
        'unified_search' => false,
        'merge_filter' => 'disabled',
        'size' => '20',
        'enable_range_search' => false,
        'display_default' => 'now',
      ),   
            
      'mailings_enviados_medio' => 
      array (
        'required' => false,
        'name' => 'mailings_enviados_medio',
        'vname' => 'LBL_MAILINGS_ENVIADOS_MEDIO',
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
      ),
      
      'franquicias_envio' => 
      array (
        'required' => false,
        'name' => 'franquicias_envio',
        'vname' => 'LBL_FRANQUICIAS_ENVIO',
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
        'options' => 'franquicia_list',
        'studio' => 'visible',
        'isMultiSelect' => true,
      ),    
      
      'correos_enviados' => 
      array (
        'required' => false,
        'name' => 'correos_enviados',
        'vname' => 'LBL_CORREOS_ENVIADOS',
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
      ),
      
      'envio_link' =>
      array (
        'name' => 'envio_link',
        'type' => 'link',
        'relationship' => 'mailing_envio_interno',
        'vname' => 'LBL_MAILING_INTERNO',
        'link_type' => 'one',
        'module'=>'Expma_Mailing',
        'bean_name'=>'Expma_Mailing',
        'source'=>'non-db',
      ),
      
      'envio' => array (
        'name' => 'envio',
        'rname' => 'id',
        'id_name' => 'envio',
        'vname' => 'LBL_ENVIO',
        'type' => 'assigned_user_name',
        'table' => 'created_by_users',
        'isnull' => false,
        'dbType' => 'id',
        'len' => 36,
      ),
      
       'envio_name' =>
          array (
            'name' => 'envio_name',
            'vname' => 'LBL_ENVIO',
            'type' => 'relate',
            'reportable'=>false,
            'link' => 'envio_link',
            'rname' => 'user_name',
            'source'=>'non-db',
            'table' => 'expma_mailing',
            'id_name' => 'envio',
            'module'=>'Expma_Mailing',
            'duplicate_merge'=>'disabled',
            'importable' => 'false',
            'massupdate' => false,
        ),
             
      'f_ultima_entrada' => 
      array (
        'required' => false,
        'name' => 'f_ultima_entrada',
        'vname' => 'LBL_F_ULTIMA_ENTRADA',
        'type' => 'date',
        'massupdate' => 0,
        'no_default' => false,
        'comments' => '',
        'importable' => 'true',
        'duplicate_merge' => 'disabled',
        'duplicate_merge_dom_value' => '0',
        'audited' => true,
        'reportable' => true,
        'unified_search' => false,
        'merge_filter' => 'disabled',
        'size' => '20',
        'enable_range_search' => false,
        'display_default' => 'now',
      ),
      
      'plantilla' => 
      array (
        'required' => false,
        'name' => 'plantilla',
        'vname' => 'LBL_PLANTILLA',
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
        'options' => 'plantillas',
        'studio' => 'visible',
        'dependency' => false,
      ),       
                  
      // ----ADMINISTRACION -------------------------------------------------------------
      
      
        'coste_accion' => 
          array (
            'required' => false,
            'name' => 'coste_accion',
            'vname' => 'LBL_COSTE_ACCION',
            'type' => 'currency',
            'massupdate' => 0,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => true,
            'reportable' => true,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'len' => 26,
            'size' => '20',
            'enable_range_search' => false,
            'precision' => 2,
          ),
      
      //------ESTADISTICAS-----------------------------------------
      
      
      'total_gestiones' => 
      array (
        'required' => false,
        'name' => 'total_gestiones',
        'vname' => 'LBL_TOTAL_GEST',
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
      
      'total_gestiones_ultimo_mes' => 
      array (
        'required' => false,
        'name' => 'total_gestiones_ultimo_mes',
        'vname' => 'LBL_TOTAL_GEST_ULT_MES',
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
            
      'gestiones_existentes' => 
      array (
        'required' => false,
        'name' => 'gestiones_existentes',
        'vname' => 'LBL_GEST_EXISTENTES',
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
            
      'gestiones_existentes_mailing' => 
      array (
        'required' => false,
        'name' => 'gestiones_existentes_mailing',
        'vname' => 'LBL_GEST_EXISTENTES_MAILING',
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
      
      'gestiones_encurso' => 
      array (
        'required' => false,
        'name' => 'gestiones_encurso',
        'vname' => 'LBL_GEST_EN_CURSO',
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
      
      'gestiones_paradas' => 
      array (
        'required' => false,
        'name' => 'gestiones_paradas',
        'vname' => 'LBL_GEST_PARADAS',
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
      
      'gestiones_descartadas' => 
      array (
        'required' => false,
        'name' => 'gestiones_descartadas',
        'vname' => 'LBL_GEST_DESCARTADAS',
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
      
      'gestiones_descartadas_nosector' => 
      array (
        'required' => false,
        'name' => 'gestiones_descartadas_nosector',
        'vname' => 'LBL_GEST_DESCARTADAS_NOSECTOR',
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
            
      'gestiones_descartadas_nocadena' => 
      array (
        'required' => false,
        'name' => 'gestiones_descartadas_nocadena',
        'vname' => 'LBL_GEST_DESCARTADAS_NOCADENA',
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
            
      'solicitudes_aplus' => 
      array (
        'required' => false,
        'name' => 'solicitudes_aplus',
        'vname' => 'LBL_SOL_APLUS',
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
      
      'solicitudes_a' => 
      array (
        'required' => false,
        'name' => 'solicitudes_a',
        'vname' => 'LBL_SOL_A',
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
      
      'solicitudes_b' => 
      array (
        'required' => false,
        'name' => 'solicitudes_b',
        'vname' => 'LBL_SOL_B',
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
      
      'solicitudes_c' => 
      array (
        'required' => false,
        'name' => 'solicitudes_c',
        'vname' => 'LBL_SOL_C',
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
      
      'solicitudes_t' => 
      array (
        'required' => false,
        'name' => 'solicitudes_t',
        'vname' => 'LBL_SOL_T',
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
      
      'solicitudes_no_rating' => 
      array (
        'required' => false,
        'name' => 'solicitudes_no_rating',
        'vname' => 'LBL_SOL_NO_RATING',
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
            
      'orden' => 
      array (
        'required' => false,
        'name' => 'orden',
        'vname' => 'LBL_ORDEN',
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
      ),                
  
),
'relationships' => array (
        'mailing_envio_interno' => array(
            'lhs_module'        => 'Expma_Mailing',
            'lhs_table'         => 'expma_mailing',
            'lhs_key'           => 'id',
            'rhs_module'        => 'Expan_Mailings',
            'rhs_table'         => 'expan_mailings',
            'rhs_key'           => 'envio',
            'relationship_type' => 'one-to-one'
        ),        
    ),
//This enables optimistic locking for Saves From EditView
    'optimistic_locking'=>true,
        'unified_search'=>true,
    );
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('Expan_Mailings','Expan_Mailings', array('basic','assignable'));