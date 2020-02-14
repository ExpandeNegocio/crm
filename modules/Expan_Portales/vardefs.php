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

$dictionary['Expan_Portales'] = array(
    'table'=>'expan_portales',
    'audited'=>true,
        'duplicate_merge'=>true,
        'fields'=>array (            
      
      'telefono_contacto' => 
      array (
        'required' => false,
        'name' => 'telefono_contacto',
        'vname' => 'LBL_TELEFONO_CONTACTO',
        'type' => 'phone',
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
        'len' => '30',
        'size' => '20',
        'dbType' => 'varchar',
      ),
 
      'correo_contacto' => 
      array (
        'required' => false,
        'name' => 'correo_contacto',
        'vname' => 'LBL_CORREO_CONTACTO',
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
        'len' => '100',
        'size' => '20',
      ),
      
      'persona_contacto' => 
      array (
        'required' => false,
        'name' => 'persona_contacto',
        'vname' => 'LBL_PERSONA_CONTACTO',
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

      'portal_activo' =>
        array (
          'required' => false,
          'name' => 'portal_activo',
          'vname' => 'LBL_PORTAL_ACTIVO',
          'type' => 'bool',
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
          'len' => 1,
          'size' => '20',
          'source' => 'non-db',
        ),


      
      //ESTADISTICAS

      'franquicias_alta' =>
        array (
          'required' => false,
          'name' => 'franquicias_alta',
          'vname' => 'LBL_FRANQUICIAS_ALTA',
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
          'len' => 1,
          'size' => '20',
          'source' => 'non-db',
        ),

      'franquicias_alta_act' =>
        array (
          'required' => false,
          'name' => 'franquicias_alta_act',
          'vname' => 'LBL_FRANQUICIAS_ALTA_ACT',
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
          'len' => 1,
          'size' => '20',
          'source' => 'non-db',
        ),

        'franquicias_prueba' =>
          array (
            'required' => false,
            'name' => 'franquicias_prueba',
            'vname' => 'LBL_FRANQUICIAS_PRUEBA',
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
            'len' => 1,
            'size' => '20',
            'source' => 'non-db',
          ),
      
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
      
      'total_gestiones_ultima_cont' => 
      array (
        'required' => false,
        'name' => 'total_gestiones_ultima_cont',
        'vname' => 'LBL_TOTAL_GEST_ULT_CONT',
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
            
      'gestiones_existentes_portal' => 
      array (
        'required' => false,
        'name' => 'gestiones_existentes_portal',
        'vname' => 'LBL_GEST_EXISTENTES_PORTAL',
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
      
      'mailing' => 
      array (
        'required' => false,
        'name' => 'mailing',
        'vname' => 'LBL_MAILING',
        'type' => 'bool',
        'massupdate' => 0,
        'default' => '0',
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
      

  
),
    'relationships'=>array (
),
    'optimistic_locking'=>true,
        'unified_search'=>true,
    );
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('Expan_Portales','Expan_Portales', array('basic','assignable'));