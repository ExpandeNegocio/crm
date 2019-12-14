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

  $dictionary['Expan_Local'] = array(
    'table' => 'expan_local',
    'audited' => true,
    'duplicate_merge' => true,
    'fields' => array(

      'origen_local' =>
        array(
          'required' => false,
          'name' => 'origen_local',
          'vname' => 'LBL_ORIGEN_LOCAL',
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
          'len' => 100,
          'size' => '20',
          'options' => 'lst_origen_local',
          'studio' => 'visible',
          'dependency' => false,
        ),

      'provincia' =>
        array (
          'required' => false,
          'name' => 'provincia',
          'vname' => 'LBL_PROVINCIA',
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

      'localidad' =>
        array (
          'required' => false,
          'name' => 'localidad',
          'vname' => 'LBL_LOCALIDAD',
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
          'options' => 'municipiosCC_list',
          'studio' => 'visible',
          'dependency' => false,
        ),

      'ubicacion_local' =>
        array(
          'required' => false,
          'name' => 'ubicacion_local',
          'vname' => 'LBL_UBICACION_LOCAL',
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
          'len' => 2,
          'size' => '20',
          'options' => 'lst_ubicacion_local',
          'studio' => 'visible',
          'dependency' => false,
        ),

      'propiedad' =>
        array(
          'required' => false,
          'name' => 'propiedad',
          'vname' => 'LBL_PROPIEDAD',
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
          'len' => 2,
          'size' => '20',
          'options' => 'lst_propiedad_local',
          'studio' => 'visible',
          'dependency' => false,
        ),

      'superficie_local' =>
        array(
          'required' => false,
          'name' => 'superficie_local',
          'vname' => 'LBL_SUPERFICIE_LOCAL',
          'type' => 'int',
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
          'size' => '5',
          'enable_range_search' => false,
          'disable_num_format' => '',
          'min' => 0,
          'max' => false,
          'validation' =>
            array(
              'type' => 'range',
              'min' => 0,
              'max' => false,
            ),
        ),

      'descripcion_local' =>
        array(
          'required' => false,
          'name' => 'descripcion_local',
          'vname' => 'LBL_DESCRIPCION_LOCAL',
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
          'rows' => '4',
          'cols' => '60',
        ),

      'renta_estimada' =>
        array (
          'required' => false,
          'name' => 'renta_estimada',
          'vname' => 'LBL_RENTA_ESTIMADA',
          'type' => 'varchar',
          'massupdate' => 0,
          'no_default' => false,
          'comments' => '',
          'help' => '',
          'importable' => 'true',
          'duplicate_merge' => 'disabled',
          'duplicate_merge_dom_value' => 0,
          'audited' => true,
          'reportable' => true,
          'unified_search' => false,
          'merge_filter' => 'disabled',
          'len' => 150,
          'size' => '20',
        ),

      'datos_contacto' =>
        array(
          'required' => false,
          'name' => 'datos_contacto',
          'vname' => 'LBL_DATOS_CONTACTO',
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
          'rows' => '4',
          'cols' => '60',
        ),

      'direccion' =>
        array(
          'required' => false,
          'name' => 'direccion',
          'vname' => 'LBL_DIRECCION',
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
          'rows' => '4',
          'cols' => '60',
        ),

    ),
    'relationships' => array(),
    'optimistic_locking' => true,
    'unified_search' => true,
  );
  if (!class_exists('VardefManager')) {
    require_once('include/SugarObjects/VardefManager.php');
  }
  VardefManager::createVardef('Expan_Local', 'Expan_Local', array('basic', 'assignable','security_groups'));