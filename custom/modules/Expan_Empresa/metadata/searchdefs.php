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

/*
 * Created on Aug 2, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

	global $current_user;

	$module_name = 'Expan_Empresa';
	$_module_name = '_Expan_Empresa';

	if  ($current_user->id=='71f40543-2702-4095-9d30-536f529bd8b6' || $current_user->id=='1'){

    $searchdefs[$module_name] = array(
      'templateMeta' => array(
        'maxColumns' => '3',
        'maxColumnsBasic' => '4',
        'widths' => array('label' => '10', 'field' => '30'),
      ),
      'layout' => array(
        'basic_search' => array(
          'name',
          array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),
        ),
        'advanced_search' => array(
          'name',
          'empresa_type',
          'origen',
          'sector' =>
            array (
              'type' => 'enum',
              'default' => true,
              'studio' => 'visible',
              'label' => 'LBL_SECTOR',
              'width' => '10%',
              'name' => 'sector',
            ),
          'chk_es_proveedor',
          'chk_es_competidor',
          'chk_es_cliente_potencial',
          'chk_alianza',
          'rating',
          'estado_cp',
          'estado_proyecto',
          'interes_en',
          'encaje_cliente',
          'chk_corto_plazo',
          'decision',
          'tipo_propuesta',
          'estado_alia',
        ),
      ),
    );
	}else{

    $searchdefs[$module_name] = array(
      'templateMeta' => array(
        'maxColumns' => '3',
        'maxColumnsBasic' => '4',
        'widths' => array('label' => '10', 'field' => '30'),
      ),
      'layout' => array(
        'basic_search' => array(
          'name',
          array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),
        ),
        'advanced_search' => array(
          'name',
          'empresa_type',
          'origen',
          'sector' =>
            array (
              'type' => 'enum',
              'default' => true,
              'studio' => 'visible',
              'label' => 'LBL_SECTOR',
              'width' => '10%',
              'name' => 'sector',
            ),
          'chk_es_proveedor',
          'chk_es_competidor',

        ),
      ),
    );

	}




/*
 $module_name = 'Expan_Empresa';
 $_module_name = '_Expan_Empresa';
  $searchdefs[$module_name] = array(
					'templateMeta' => array(
							'maxColumns' => '3',
  							'maxColumnsBasic' => '4', 
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
						'basic_search' => array(
						 	'name',
							array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),
							),
						'advanced_search' => array(
							'name',										
							'empresa_type',
							'origen',
							'sector' =>
								array (
									'type' => 'enum',
									'default' => true,
									'studio' => 'visible',
									'label' => 'LBL_SECTOR',
									'width' => '10%',
									'name' => 'sector',
								),
							'chk_es_proveedor',
							'chk_es_competidor',
							
						),
					),
 			   );

global $current_user;

echo "USUario-".$current_user->id;

if  ($current_user->id=='71f40543-2702-4095-9d30-536f529bd8b6' || $current_user->id=='1'
){
     
    $searchdefs [$module_name]['advanced_search']=
      array (
        'name',                                       
        'empresa_type',
        'origen',
				'sector' =>
					array (
						'type' => 'multienum',
						'default' => true,
						'studio' => 'visible',
						'label' => 'LBL_SECTOR',
						'width' => '10%',
						'name' => 'sector',
					),
        'chk_es_proveedor',
        'chk_es_competidor',
        'chk_es_cliente_potencial',
        'chk_alianza',
        'rating',
        'estado_cp',
        'estado_proyecto',
        'interes_en',
        'encaje_cliente',
        'chk_corto_plazo',
        'decision',
        'tipo_propuesta',
        'estado_alia',
      );
}
               
?>*/


