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

  $viewdefs ['Expan_Local'] =
    array(
      'QuickCreate' =>
        array(
          'templateMeta' =>
            array(
              'form' =>
                array(
                  'hidden' =>
                    array(
                      '<input type="hidden" name="isSaveAndNew" value="false">',
                      '<input type="hidden" name="is_ajax_call" value="1">',
                    ),
                  'buttons' =>
                    array(
                      'SAVE',
                      'CANCEL',
                    ),
                ),
              'maxColumns' => '2',
              'widths' =>
                array(

                  array(
                    'label' => '10',
                    'field' => '30',
                  ),

                  array(
                    'label' => '10',
                    'field' => '30',
                  ),
                ),
              'javascript' => '{sugar_getscript file="include/javascript/Expan_Local/QuickCreateExpan_Local.js"}
                                <script type="text/javascript"> onload=CargaProvMun(); </script>',
              'useTabs' => false,
            ),
          'panels' =>
            array(
              'lbl_call_information' =>
                array(
                  0 =>
                    array(
                      0 =>
                        array(
                          'name' => 'provincia',
                          'label' => 'LBL_PROVINCIA',
                        ),
                      1 =>
                        array(
                          'name' => 'localidad',
                          'label' => 'LBL_LOCALIDAD',
                        ),
                    ),

                  1 =>
                    array(
                      0 =>
                        array(
                          'name' => 'ubicacion_local',
                          'label' => 'LBL_UBICACION_LOCAL',
                        ),
                      1 =>
                        array(
                          'name' => 'direccion',
                          'label' => 'LBL_DIRECCION',
                        ),
                    ),

                  2 =>
                    array(
                      0 =>
                        array(
                          'name' => 'propiedad',
                          'label' => 'LBL_PROPIEDAD',
                        ),
                      1 =>
                        array(
                          'name' => 'superficie_local',
                          'label' => 'LBL_SUPERFICIE_LOCAL',
                        ),
                    ),

                  3 =>
                    array(
                      0 =>
                        array(
                          'name' => 'renta_estimada',
                          'label' => 'LBL_RENTA_ESTIMADA',
                        ),
                      1 =>
                        array(
                          'name' => 'origen_local',
                          'label' => 'LBL_ORIGEN_LOCAL',
                        ),
                    ),

                  4 =>
                    array(
                      0 =>
                        array(
                          'name' => 'descripcion_local',
                          'label' => 'LBL_DESCRIPCION_LOCAL',
                        ),
                      1 =>
                        array(
                          'name' => 'datos_contacto',
                          'label' => 'LBL_DATOS_CONTACTO',
                        ),
                    ),
                ),
            ),
        ),
    );
?>
