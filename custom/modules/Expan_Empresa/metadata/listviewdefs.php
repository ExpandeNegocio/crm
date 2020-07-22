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

$module_name = 'Expan_Empresa';
$OBJECT_NAME = 'Expan_Empresa';
echo '<script type="text/javascript"  src="include/javascript/Expan_Empresa/ListViewEmpresa.js"></script>';


	global $current_user;

	$GLOBALS['log'] -> info('[ExpandeNegocio][listviewdef Empresa]$current_user->id-' . $current_user->id);

if  ($current_user->id=='71f40543-2702-4095-9d30-536f529bd8b6' || $current_user->id=='1')
{
	$listViewDefs[$module_name] = array(
		'NAME' => array(
			'width' => '30',
			'label' => 'LBL_NAME',
			'link' => true,
			'default' => true),
		'empresa_type' => array(
			'width' => '20',
			'label' => 'LBL_TYPE',
			'default' => true),
		'origen' => array(
			'width' => '10',
			'label' => 'LBL_ORIGEN',
			'default' => true),
		'pais' => array(
			'width' => '10',
			'label' => 'LBL_PAIS',
			'default' => true),
		'ccaa' => array(
			'width' => '10',
			'label' => 'LBL_CCAA',
			'default' => true),
		'sector' => array(
			'width' => '10',
			'label' => 'LBL_SECTOR',
			'default' => true),
		'fecha_contacto' => array(
			'width' => '10',
			'label' => 'LBL_FECHA_CONTACTO',
			'default' => true),
    'DATE_ENTERED' => array (
        'width' => '10%',
        'label' => 'LBL_DATE_ENTERED',
        'default' => true,),
		'rating' => array(
			'width' => '10',
			'label' => 'LBL_RATING',
			'default' => true),
		'estado_cp' => array(
			'width' => '10',
			'label' => 'LBL_ESTADO',
			'default' => true),
		'decision' => array(
			'width' => '10',
			'label' => 'LBL_DECISION',
			'default' => true),
		'f_plazo' => array(
			'width' => '10',
			'label' => 'LBL_PLAZO',
			'default' => true),
		'chk_corto_plazo' => array(
			'width' => '10',
			'label' => 'LBL_CORTO_PLAZO',
			'default' => true),
		'chk_es_proveedor' => array(
			'width' => '10',
			'label' => 'LBL_ES_PROVEEDOR',
			'default' => true),
		'chk_es_competidor' => array(
			'width' => '10',
			'label' => 'LBL_ES_COMPETIDOR',
			'default' => true),
		'chk_es_cliente_potencial' => array(
			'width' => '10',
			'label' => 'LBL_ES_CLIENTE_POTENCIAL',
			'default' => true),
		'chk_alianza' => array(
			'width' => '10',
			'label' => 'LBL_ALIANZA',
			'default' => true),
	);

}else{
	$listViewDefs[$module_name] = array(
		'NAME' => array(
			'width' => '30',
			'label' => 'LBL_NAME',
			'link' => true,
			'default' => true),
		'empresa_type' => array(
			'width' => '20',
			'label' => 'LBL_TYPE',
			'default' => true),
    'DATE_ENTERED' => array (
      'width' => '10%',
      'label' => 'LBL_DATE_ENTERED',
      'default' => true,),
		'chk_es_proveedor' => array(
			'width' => '10',
			'label' => 'LBL_ES_PROVEEDOR',
			'default' => true),
		'chk_es_competidor' => array(
			'width' => '10',
			'label' => 'LBL_ES_COMPETIDOR',
			'default' => true),
		'chk_alianza' => array(
			'width' => '10',
			'label' => 'LBL_ALIANZA',
			'default' => true),
	);
}
