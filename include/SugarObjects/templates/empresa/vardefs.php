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

$vardefs= array (  
'fields' => array (
   'name' =>
  array (
    'name' => 'name',
    'type' => 'name',
    'dbType' => 'varchar',
    'vname' => 'LBL_NAME',
    'len' => 150,
    'comment' => 'Name of the Company',
    'unified_search' => true,
    'full_text_search' => array('boost' => 3),
    'audited' => true,
	'required'=>true,
    'importable' => 'required',
    'merge_filter' => 'selected',  //field will be enabled for merge and will be a part of the default search criteria..other valid values for this property are enabled and disabled, default value is disabled.
                            //property value is case insensitive.
  ),
   
  'empresa_type' => 
  array (
    'name' => 'empresa_type',
    'vname' => 'LBL_TYPE',
    'type' => 'enum',
    'required'=>true,
    'options' => 'tipo_empresa_list',
    'len'=>50,
    'comment' => 'Tipo de empresa',
  ),  
  
  'fecha_contacto' => 
  array (
    'required' => false,
    'name' => 'fecha_contacto',
    'vname' => 'LBL_FECHA_CONTACTO',
    'type' => 'date',
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
    'enable_range_search' => true,
  ),
  
  'origen' => 
  array (
    'required' => true,
    'name' => 'origen',
    'vname' => 'LBL_ORIGEN',
    'type' => 'enum',
    'options' => 'empresa_origen_type_list',
    'len'=>50,
    'audited' => true,
    'comment' => 'Origen de la empresa',
  ), 
       
  'sector' => 
  array (
    'required' => false,
    'name' => 'sector',
    'vname' => 'LBL_SECTOR',
    'type' => 'multienum',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'required' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'lst_sectores_completo',
    'studio' => 'visible',
    'isMultiSelect' => true,
    'dependency' => false,
  ),
  
  'actividad_principal' => 
  array (
    'required' => false,
    'name' => 'actividad_principal',
    'vname' => 'LBL_ACTIVIDAD_PRINCIPAL',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '220',
    'studio' => 'visible',
    'rows' => '2',
    'cols' => '80',
  ),
  
  'contacto1' => 
  array (
    'required' => false,
    'name' => 'contacto1',
    'vname' => 'LBL_CONTACTO',
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
  
  'cargo1' => 
  array (
    'required' => false,
    'name' => 'cargo1',
    'vname' => 'LBL_CARGO',
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
  
  'telefono1' => 
  array (
    'required' => false,
    'name' => 'telefono1',
    'vname' => 'LBL_TELEFONO',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'movil1' => 
  array (
    'required' => false,
    'name' => 'movil1',
    'vname' => 'LBL_MOVIL',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'email_con_1' => 
  array (
    'required' => false,
    'name' => 'email_con_1',
    'vname' => 'LBL_EMAIL',
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
  
  'observacion_con_1' => 
  array (
    'required' => false,
    'name' => 'observacion_con_1',
    'vname' => 'LBL_OBSERVACIONES_CONTACTO',
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
    'rows' => '4',
    'cols' => '80',
  ),
  
  'contacto2' => 
  array (
    'required' => false,
    'name' => 'contacto2',
    'vname' => 'LBL_CONTACTO',
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
    'size' => '60',
  ),
  
  'cargo2' => 
  array (
    'required' => false,
    'name' => 'cargo2',
    'vname' => 'LBL_CARGO',
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
  
  'telefono2' => 
  array (
    'required' => false,
    'name' => 'telefono2',
    'vname' => 'LBL_TELEFONO',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'movil2' => 
  array (
    'required' => false,
    'name' => 'movil2',
    'vname' => 'LBL_MOVIL',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'email_con_2' => 
  array (
    'required' => false,
    'name' => 'email_con_2',
    'vname' => 'LBL_EMAIL',
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
  
  'observacion_con_2' => 
  array (
    'required' => false,
    'name' => 'observacion_con_2',
    'vname' => 'LBL_OBSERVACIONES_CONTACTO',
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
    'rows' => '4',
    'cols' => '80',
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
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'studio' => 'visible',
    'rows' => '4',
    'cols' => '80',
  ),
  
  'cif' => 
  array (
    'required' => false,
    'name' => 'cif',
    'vname' => 'LBL_CIF',
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
    'len' => '20',
    'size' => '20',
  ),
  
  'direccion' => 
  array (
    'required' => false,
    'name' => 'direccion',
    'vname' => 'LBL_DIRECCION',
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
  
  'codigo_postal' => 
  array (
    'required' => false,
    'name' => 'codigo_postal',
    'vname' => 'LBL_CODIGO_POSTAL',
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
    'len' => '20',
    'size' => '20',
  ),
    
  'provincia' => 
  array (
    'required' => false,
    'name' => 'provincia',
    'vname' => 'LBL_PROVINCIA',
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
    'len' => 100,
    'size' => '20',    
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'poblacion' => 
  array (
    'required' => false,
    'name' => 'poblacion',
    'vname' => 'LBL_POBLACION',
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
    'len' => 150,
    'size' => '20',    
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'ccaa' => 
  array (
    'required' => false,
    'name' => 'ccaa',
    'vname' => 'LBL_CCAA',
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
    'len' => 90,
    'size' => '20',    
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'web' => 
  array (
    'required' => false,
    'name' => 'web',
    'vname' => 'LBL_WEB',
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
    'len' => 200,
    'size' => '20',    
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'chk_trabaja_consultora' => 
  array (
    'required' => false,
    'name' => 'chk_trabaja_consultora',
    'vname' => 'LBL_TRABAJA_CONSULTORA',
    'type' => 'enum',
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
    'options' => 'yes_no_list',    
    'len' => '4',
    'size' => '20',
  ),   
  
  'chk_es_proveedor' => 
  array (
    'required' => false,
    'name' => 'chk_es_proveedor',
    'vname' => 'LBL_ES_PROVEEDOR',
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
  
  'chk_es_competidor' => 
  array (
    'required' => false,
    'name' => 'chk_es_competidor',
    'vname' => 'LBL_ES_COMPETIDOR',
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
  
  'chk_es_cliente_potencial' => 
  array (
    'required' => false,
    'name' => 'chk_es_cliente_potencial',
    'vname' => 'LBL_ES_CLIENTE_POTENCIAL',
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
  
    
'email1' => array(
	'name'		=> 'email1',
	'vname'		=> 'LBL_EMAIL',
	'group'=>'email1',
	'type'		=> 'varchar',
	'function'	=> array(
	'name'		=> 'getEmailAddressWidget',
	   'returns'	=> 'html'
    ),
	'source'	=> 'non-db',
    'studio' => array('editField' => true, 'searchview' => false),
    'full_text_search' => array('boost' => 3, 'analyzer' => 'whitespace'), //bug 54567
), 
  
  'email_addresses_primary' => 
  array (
    'name' => 'email_addresses_primary',
    'type' => 'link',
    'relationship' => strtolower($object_name).'_email_addresses_primary',
    'source' => 'non-db',
    'vname' => 'LBL_EMAIL_ADDRESS_PRIMARY',
    'duplicate_merge' => 'disabled',
  ),  
  
  'email_addresses' =>
    array (
        'name' => 'email_addresses',
        'type' => 'link',
        'relationship' => strtolower($object_name).'_email_addresses',
        'source' => 'non-db',
        'vname' => 'LBL_EMAIL_ADDRESSES',
        'reportable'=>false,
        'unified_search' => true,
        'rel_fields' => array('primary_address' => array('type'=>'bool')),
    ),
    // Used for non-primary mail import
    'email_addresses_non_primary'=>
    array(
        'name' => 'email_addresses_non_primary',
        'type' => 'email',
        'source' => 'non-db',
        'vname' =>'LBL_EMAIL_NON_PRIMARY',
        'studio' => false,
        'reportable'=>false,
        'massupdate' => false,
    ),
    
    'telefono_contacto_1' => 
  array (
    'required' => false,
    'name' => 'telefono_contacto_1',
    'vname' => 'LBL_TELEFONO_CONTACTO1',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'telefono_contacto_observa1' => 
  array (
    'required' => false,
    'name' => 'telefono_contacto_observa1',
    'vname' => 'LBL_TELEFONO_CONTACTO_OBSERVA1',
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
    'len' => 200,
    'size' => '20'
  ),
  
  'telefono_contacto_2' => 
  array (
    'required' => false,
    'name' => 'telefono_contacto_2',
    'vname' => 'LBL_TELEFONO_CONTACTO2',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'telefono_contacto_observa2' => 
  array (
    'required' => false,
    'name' => 'telefono_contacto_observa2',
    'vname' => 'LBL_TELEFONO_CONTACTO_OBSERVA2',
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
    'len' => 200,
    'size' => '20'
  ),
  
  'telefono_contacto_3' => 
  array (
    'required' => false,
    'name' => 'telefono_contacto_3',
    'vname' => 'LBL_TELEFONO_CONTACTO3',
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
    'len' => '255',
    'size' => '20',
    'dbType' => 'varchar',
  ),
  
  'telefono_contacto_observa3' => 
  array (
    'required' => false,
    'name' => 'telefono_contacto_observa3',
    'vname' => 'LBL_TELEFONO_CONTACTO_OBSERVA3',
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
    'len' => 200,
    'size' => '20'
  ),
    
    
    
),
'relationships'=>array(
    strtolower($module).'_email_addresses' => 
    array(
        'lhs_module'=> $module, 'lhs_table'=> strtolower($module), 'lhs_key' => 'id',
        'rhs_module'=> 'EmailAddresses', 'rhs_table'=> 'email_addresses', 'rhs_key' => 'id',
        'relationship_type'=>'many-to-many',
        'join_table'=> 'email_addr_bean_rel', 'join_key_lhs'=>'bean_id', 'join_key_rhs'=>'email_address_id', 
        'relationship_role_column'=>'bean_module',
        'relationship_role_column_value'=>$module
    ),
    strtolower($module).'_email_addresses_primary' => 
    array('lhs_module'=> $module, 'lhs_table'=> strtolower($module), 'lhs_key' => 'id',
        'rhs_module'=> 'EmailAddresses', 'rhs_table'=> 'email_addresses', 'rhs_key' => 'id',
        'relationship_type'=>'many-to-many',
        'join_table'=> 'email_addr_bean_rel', 'join_key_lhs'=>'bean_id', 'join_key_rhs'=>'email_address_id', 
        'relationship_role_column'=>'primary_address', 
        'relationship_role_column_value'=>'1'
    ),
)
);
