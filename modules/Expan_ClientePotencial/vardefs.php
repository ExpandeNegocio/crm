<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

 $dictionary['Expan_ClientePotencial'] = array(
    'table'=>'expan_clientepotencial',
    'audited'=>true,
        'duplicate_merge'=>true,
        'fields'=>array (
    
    // --- DATOS CLIENTE POTENCIAL -----------------------------------------------------
    
  'rating' => 
  array (
    'required' => false,
    'name' => 'rating',
    'vname' => 'LBL_RATING',
    'type' => 'enum',
    'massupdate' => '1',
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
    'len' => 3,
    'size' => '20',
    'options' => 'rating_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
    
  'estado' => 
  array (
    'required' => false,
    'name' => 'estado',
    'vname' => 'LBL_ESTADO',
    'type' => 'enum',
    'massupdate' => '0',
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
    'len' => 5,
    'size' => '20',
    'options' => 'estado_cp_list',
    'studio' => 'visible',
    'dependency' => false,
    'default' => '1',
  ),  
 
  'observaciones_estado' => 
  array (
    'required' => false,
    'name' => 'observaciones_estado',
    'vname' => 'LBL_OBSERVACIONES_ESTADO',
    'type' => 'text',
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
    'size' => '20',
    'studio' => 'visible',
    'rows' => '4',
    'cols' => '60',
  ),
        
  'chk_corto_plazo' => 
  array (
    'required' => false,
    'name' => 'chk_corto_plazo',
    'vname' => 'LBL_CORTO_PLAZO',
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
  ), 
  
  'chk_interesa' => 
  array (
    'required' => false,
    'name' => 'chk_interesa',
    'vname' => 'LBL_INTERESA',
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
  ), 
       
  'decision' => 
  array (
    'required' => false,
    'name' => 'decision',
    'vname' => 'LBL_DECISION',
    'type' => 'enum',
    'massupdate' => '0',
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
    'len' => 3,
    'size' => '20',
    'options' => 'tipo_decision_list',
    'studio' => 'visible',
    'dependency' => false,
    'default' => '1',
  ),
  
  'f_plazo' => 
  array (
    'required' => false,
    'name' => 'f_plazo',
    'vname' => 'LBL_PLAZO',
    'type' => 'date',
    'massupdate' => '1',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'enable_range_search' => false,
  ),
  
  'tipo_propuesta' => 
  array (
    'required' => false,
    'name' => 'tipo_propuesta',
    'vname' => 'LBL_TIPO_PROPUESTA',
    'type' => 'enum',
    'massupdate' => '1',
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
    'len' => 3,
    'size' => '20',
    'options' => 'tipo_propuesta_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'f_envio_propuesta' => 
  array (
    'required' => false,
    'name' => 'f_envio_propuesta',
    'vname' => 'LBL_ENVIO_PROPUESTA',
    'type' => 'date',
    'massupdate' => '1',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'enable_range_search' => false,
  ),
  
  'observaciones_propuesta' => 
  array (
    'required' => false,
    'name' => 'observaciones_propuesta',
    'vname' => 'LBL_OBSERVACIONES_PROPUESTA',
    'type' => 'text',
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
    'size' => '20',
    'studio' => 'visible',
    'rows' => '4',
    'cols' => '60',
  ),
  
  'chk_franquicia' => 
  array (
    'required' => false,
    'name' => 'chk_franquicia',
    'vname' => 'LBL_FRANQUICIA',
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
  ), 
  
  'consultora' => 
  array (
    'required' => false,
    'name' => 'consultora',
    'vname' => 'LBL_CONSULTORA',
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
  
  'informacion_proyecto' => 
  array (
    'required' => false,
    'name' => 'informacion_proyecto',
    'vname' => 'LBL_INFORMACION_PROYECTO',
    'type' => 'text',
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
    'size' => '20',
    'studio' => 'visible',
    'rows' => '4',
    'cols' => '60',
  ),
  
  'chk_alta_news' => 
  array (
    'required' => false,
    'name' => 'chk_alta_news',
    'vname' => 'LBL_ALTA_NEWS',
    'type' => 'bool',
    'massupdate' => 0,
    'default' => '1',
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
VardefManager::createVardef('Expan_ClientePotencial','Expan_ClientePotencial', array('basic','assignable','empresa'));