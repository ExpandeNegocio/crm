<?php
// created: 2012-04-26 12:45:20
$searchFields['DHA_PlantillasDocumentos'] = array (
  'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
  'document_name' => 
  array (
    'query_type' => 'default',
  ),
  'category_id' => 
  array (
    'query_type' => 'default',
    'options' => 'document_category_dom',
    'template_var' => 'CATEGORY_OPTIONS',
  ),
  'subcategory_id' => 
  array (
    'query_type' => 'default',
    'options' => 'document_subcategory_dom',
    'template_var' => 'SUBCATEGORY_OPTIONS',
  ),
  'active_date' => 
  array (
    'query_type' => 'default',
  ),
  'exp_date' => 
  array (
    'query_type' => 'default',
  ),
  'range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
);
?>
