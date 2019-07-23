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

$dictionary['Expan_CentroComercial'] = array(
	'table'=>'expan_centrocomercial',
	'audited'=>true,
	'duplicate_merge'=>true,
	'fields'=>array (

	  'id' =>
	  array (
	    'name' => 'id',
	    'vname' => 'LBL_ID',
	    'type' => 'id',
	    'required'=>true,
	    'reportable'=>true,
	    'comment' => 'Unique identifier'
	  ),
	  'name'=>
	    array(
	    'name'=>'name',
	    'vname'=> 'LBL_NAME',
	    'type'=>'name',
	    'link' => true, // bug 39288 
		'dbType' => 'varchar',
	    'len'=>255,
        'unified_search' => true,
        'full_text_search' => array('boost' => 3),
        'required'=>true,
		'importable' => 'required',
        'duplicate_merge' => 'enabled',
        //'duplicate_merge_dom_value' => '3',
        'merge_filter' => 'selected',
	    ),
	  'date_entered' =>
	  array (
	    'name' => 'date_entered',
	    'vname' => 'LBL_DATE_ENTERED',
	    'type' => 'datetime',
	    'group'=>'created_by_name',
	    'comment' => 'Date record created',
	    'enable_range_search' => true,
	  	'options' => 'date_range_search_dom',
	  ),
	  'date_modified' =>
	  array (
	    'name' => 'date_modified',
	    'vname' => 'LBL_DATE_MODIFIED',
	    'type' => 'datetime',
	    'group'=>'modified_by_name',
	    'comment' => 'Date record last modified',
	    'enable_range_search' => true,
	    'options' => 'date_range_search_dom',
	  ),
		'modified_user_id' =>
	  array (
	    'name' => 'modified_user_id',
	    'rname' => 'user_name',
	    'id_name' => 'modified_user_id',
	    'vname' => 'LBL_MODIFIED',
	    'type' => 'assigned_user_name',
	    'table' => 'users',
	    'isnull' => 'false',
	     'group'=>'modified_by_name',
	    'dbType' => 'id',
	    'reportable'=>true,
	    'comment' => 'User who last modified record',
        'massupdate' => false,
	  ),
	  'modified_by_name' => 
	  array (
	    'name' => 'modified_by_name',
	    'vname' => 'LBL_MODIFIED_NAME',
	    'type' => 'relate',
	    'reportable'=>false,
	    'source'=>'non-db',
	    'rname'=>'user_name',
	    'table' => 'users',
	    'id_name' => 'modified_user_id',
	    'module'=>'Users',
	    'link'=>'modified_user_link',
	    'duplicate_merge'=>'disabled',
        'massupdate' => false,
	  ),  
	  'created_by' =>
	  array (
	    'name' => 'created_by',
	    'rname' => 'user_name',
	    'id_name' => 'modified_user_id',
	    'vname' => 'LBL_CREATED',
	    'type' => 'assigned_user_name',
	    'table' => 'users',
	    'isnull' => 'false',
	    'dbType' => 'id',
	    'group'=>'created_by_name',
	    'comment' => 'User who created record',
        'massupdate' => false,
	  ),
	  	'created_by_name' => 
	  array (
	    'name' => 'created_by_name',
		'vname' => 'LBL_CREATED',
		'type' => 'relate',
		'reportable'=>false,
	    'link' => 'created_by_link',
	    'rname' => 'user_name',
		'source'=>'non-db',
		'table' => 'users',
		'id_name' => 'created_by',
		'module'=>'Users',
		'duplicate_merge'=>'disabled',
        'importable' => 'false',
        'massupdate' => false,
	),
	  'description' =>
	  array (
	    'name' => 'description',
	    'vname' => 'LBL_DESCRIPTION',
	    'type' => 'text',
	    'comment' => 'Full text of the note',
	    'rows' => 6,
	    'cols' => 80,
	  ),
	  'deleted' =>
	  array (
	    'name' => 'deleted',
	    'vname' => 'LBL_DELETED',
	    'type' => 'bool',
	    'default' => '0',
	    'reportable'=>false,
	    'comment' => 'Record deletion indicator'
	  ),

	'provincia_apertura' =>
	array (
		'required' => false,
		'name' => 'provincia_apertura',
		'vname' => 'LBL_PROVINCIA_APERTURA',
		'type' => 'enum',
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
		'options' => 'provincias_list',
		'studio' => 'visible',
		'dependency' => false,
	),

	'localidad_apertura' =>
	array (
		'required' => false,
		'name' => 'localidad_apertura',
		'vname' => 'LBL_LOCALIDAD_APERTURA',
		'type' => 'enum',
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
		'options' => 'municipios_list',
		'studio' => 'visible',
		'dependency' => false,
	),

	'codigo_postal' =>
	array (
		'name' => 'codigo_postal',
		'vname' => 'LBL_CODIGO_POSTAL',
		'type' => 'varchar',
		'len' => '20',
		'group'=>'primary_address',
		'comment' => 'Codigo Posal',
		'merge_filter' => 'enabled',
	),

	'num_locales' =>
	array(
		'name' => 'num_locales',
		'vname' => 'LBL_LOCALES',
		'type' => 'int',
		'len' => 5,
		'importable' => 'false',
		'massupdate' => false,
		'reportable' => false,
		'audited' => true,
		'studio' => 'false',
	),

	'superficie_alquilable' =>
	array(
		'name' => 'superficie_alquilable',
		'vname' => 'LBL_SUPERFICIE_ALQUILABLE',
		'type' => 'int',
		'len' => 5,
		'importable' => 'false',
		'massupdate' => false,
		'reportable' => false,
		'audited' => true,
		'studio' => 'false',
	),

	'num_visitantes' =>
	array(
		'name' => 'num_visitantes',
		'vname' => 'LBL_VISITANTES',
		'type' => 'int',
		'len' => 7,
		'importable' => 'false',
		'massupdate' => false,
		'reportable' => false,
		'audited' => true,
		'studio' => 'false',
	),

	'tipo_cc' =>
	array (
		'required' => false,
		'name' => 'tipo_cc',
		'vname' => 'LBL_TIPO_CC',
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
		'len' => 4,
		'size' => '20',
		'options' => 'tipo_cc_list',
		'studio' => 'visible',
		'dependency' => false,
	),

	'precio_suelo' =>
	array(
		'name' => 'precio_suelo',
		'vname' => 'LBL_PRECIO_SUELO',
		'type' => 'varchar',
		'len' => 150,
		'importable' => 'false',
		'massupdate' => false,
		'reportable' => false,
		'audited' => true,
		'studio' => 'false',
		'comment' => 'Precio de alquiler medio por metro de los locales',
	),

	'year_apertura' =>
	array(
		'name' => 'year_apertura',
		'vname' => 'LBL_YEAR_APERTURA',
		'type' => 'int',
		'len' => 5,
		'importable' => 'false',
		'massupdate' => false,
		'reportable' => false,
		'audited' => true,
		'studio' => 'false',
	),

	'valoracion_en' =>
	array (
		'required' => false,
		'name' => 'valoracion_en',
		'vname' => 'LBL_VALORACION_EN',
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
		'len' => 4,
		'size' => '20',
		'options' => 'valoracin_cc_en_list',
		'studio' => 'visible',
		'dependency' => false,
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
		'cols' => '60',
	),

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
		'len' => '255',
		'size' => '20',
		'dbType' => 'varchar',
	),

	'empresa_gestora' =>
	array (
		'required' => false,
		'name' => 'empresa_gestora',
		'vname' => 'LBL_EMPRESA_GESTORA',
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
		'len' => '255',
		'size' => '20',
	),

	'direccion' =>
	array (
		'required' => false,
		'name' => 'direccion',
		'vname' => 'LBL_DIRECCION',
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

	'gastos_comunidad' =>
		array(
			'required' => false,
			'name' => 'gastos_comunidad',
			'vname' => 'LBL_GASTOS_COMUNIDAD',
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

	'auditoria_anual' =>
		array(
			'required' => false,
			'name' => 'auditoria_anual',
			'vname' => 'LBL_AUDITORIA_ANUAL',
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

	'lid_provincia' =>
		array(
			'name' => 'lid_provincia',
			'vname' => 'LBL_LID_PROVINCIA',
			'type' => 'int',
			'len' => 5,
			'importable' => 'false',
			'massupdate' => false,
			'reportable' => false,
			'audited' => true,
			'studio' => 'false',
		),

/////////////////RELATIONSHIP LINKS////////////////////////////
	  'created_by_link' =>
  array (
     'name' => 'created_by_link',
    'type' => 'link',
    'relationship' => strtolower($module) . '_created_by',
    'vname' => 'LBL_CREATED_USER',
    'link_type' => 'one',
    'module'=>'Users',
    'bean_name'=>'User',
    'source'=>'non-db',
  ),
  'modified_user_link' =>
  array (
        'name' => 'modified_user_link',
    'type' => 'link',
    'relationship' => strtolower($module). '_modified_user',
    'vname' => 'LBL_MODIFIED_USER',
    'link_type' => 'one',
    'module'=>'Users',
    'bean_name'=>'User',
    'source'=>'non-db',
  ),

),
'indices' => array (
       'id'=>array('name' =>strtolower($module).'pk', 'type' =>'primary', 'fields'=>array('id')),
       ),
'relationships'=>array(
	strtolower($module).'_modified_user' =>
   array('lhs_module'=> 'Users', 'lhs_table'=> 'users', 'lhs_key' => 'id',
   'rhs_module'=> $module, 'rhs_table'=> strtolower($module), 'rhs_key' => 'modified_user_id',
   'relationship_type'=>'one-to-many')
   ,strtolower($module).'_created_by' =>
   array('lhs_module'=> 'Users', 'lhs_table'=> 'users', 'lhs_key' => 'id',
   'rhs_module'=> $module, 'rhs_table'=> strtolower($module), 'rhs_key' => 'created_by',
   'relationship_type'=>'one-to-many')
),


);
?>
