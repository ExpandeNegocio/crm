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

$relationships = array (
  'expan_franquicia_modified_user' => 
  array (
    'id' => '3b671c11-86a3-e1c8-14f8-5678f459d9f4',
    'relationship_name' => 'expan_franquicia_modified_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Expan_Franquicia',
    'rhs_table' => 'expan_franquicia',
    'rhs_key' => 'modified_user_id',
    'join_table' => NULL,
    'join_key_lhs' => NULL,
    'join_key_rhs' => NULL,
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
  ),
  'expan_franquicia_created_by' => 
  array (
    'id' => '3bde7b7c-291c-c7ff-ec58-5678f4e97cbd',
    'relationship_name' => 'expan_franquicia_created_by',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Expan_Franquicia',
    'rhs_table' => 'expan_franquicia',
    'rhs_key' => 'created_by',
    'join_table' => NULL,
    'join_key_lhs' => NULL,
    'join_key_rhs' => NULL,
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
  ),
  'expan_franquicia_assigned_user' => 
  array (
    'id' => '3c4a921a-3a5c-9349-e1da-5678f4fd3495',
    'relationship_name' => 'expan_franquicia_assigned_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Expan_Franquicia',
    'rhs_table' => 'expan_franquicia',
    'rhs_key' => 'assigned_user_id',
    'join_table' => NULL,
    'join_key_lhs' => NULL,
    'join_key_rhs' => NULL,
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
  ),
  'expan_franquicia_calls_1' => 
  array (
    'id' => 'd01c0bd6-5d6f-ad1b-4c59-5678f4a9ffdf',
    'relationship_name' => 'expan_franquicia_calls_1',
    'lhs_module' => 'Expan_Franquicia',
    'lhs_table' => 'expan_franquicia',
    'lhs_key' => 'id',
    'rhs_module' => 'Calls',
    'rhs_table' => 'calls',
    'rhs_key' => 'id',
    'join_table' => 'expan_franquicia_calls_1_c',
    'join_key_lhs' => 'expan_franquicia_calls_1expan_franquicia_ida',
    'join_key_rhs' => 'expan_franquicia_calls_1calls_idb',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'from_studio' => true,
    'is_custom' => true,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'expan_franquicia_documents_1' => 
  array (
    'id' => 'd08b96bf-066f-b1a4-80b6-5678f4bb2ccc',
    'relationship_name' => 'expan_franquicia_documents_1',
    'lhs_module' => 'Expan_Franquicia',
    'lhs_table' => 'expan_franquicia',
    'lhs_key' => 'id',
    'rhs_module' => 'Documents',
    'rhs_table' => 'documents',
    'rhs_key' => 'id',
    'join_table' => 'expan_franquicia_documents_1_c',
    'join_key_lhs' => 'expan_franquicia_documents_1expan_franquicia_ida',
    'join_key_rhs' => 'expan_franquicia_documents_1documents_idb',
    'relationship_type' => 'many-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'from_studio' => true,
    'is_custom' => true,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'expan_franquicia_expan_documentacion' => 
  array (
    'id' => 'd0fa2a58-9a61-a40c-8545-5678f4abef8a',
    'relationship_name' => 'expan_franquicia_expan_documentacion',
    'lhs_module' => 'Expan_Franquicia',
    'lhs_table' => 'expan_franquicia',
    'lhs_key' => 'id',
    'rhs_module' => 'Expan_Documentacion',
    'rhs_table' => 'expan_documentacion',
    'rhs_key' => 'id',
    'join_table' => 'expan_franquicia_expan_documentacion_c',
    'join_key_lhs' => 'expan_franquicia_expan_documentacionexpan_franquicia_ida',
    'join_key_rhs' => 'expan_franquicia_expan_documentacionexpan_documentacion_idb',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'relationship_only' => false,
    'for_activities' => false,
    'from_studio' => true,
  ),
  'expan_franquicia_expan_evento' => 
  array (
    'id' => 'd170b2c1-865d-0bef-fd00-5678f46c0be4',
    'relationship_name' => 'expan_franquicia_expan_evento',
    'lhs_module' => 'Expan_Franquicia',
    'lhs_table' => 'expan_franquicia',
    'lhs_key' => 'id',
    'rhs_module' => 'Expan_Evento',
    'rhs_table' => 'expan_evento',
    'rhs_key' => 'id',
    'join_table' => 'expan_franquicia_expan_evento_c',
    'join_key_lhs' => 'expan_franquicia_expan_eventoexpan_franquicia_ida',
    'join_key_rhs' => 'expan_franquicia_expan_eventoexpan_evento_idb',
    'relationship_type' => 'many-to-many',
    'relationship_role_column' => NULL,
    'relationship_role_column_value' => NULL,
    'reverse' => '0',
    'deleted' => '0',
    'readonly' => true,
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'is_custom' => true,
    'relationship_only' => false,
    'for_activities' => false,
    'from_studio' => true,
  ),
  'expan_franquicia_tasks_1' => 
  array (
    'rhs_label' => 'Tareas',
    'lhs_label' => 'Franquicia',
    'rhs_subpanel' => 'default',
    'lhs_module' => 'Expan_Franquicia',
    'rhs_module' => 'Tasks',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
    'relationship_name' => 'expan_franquicia_tasks_1',
  ),
);