<?php
$popupMeta = array (
    'moduleMain' => 'Expan_Franquicia',
    'varName' => 'Expan_Franquicia',
    'orderBy' => 'expan_franquicia.name',
    'whereClauses' => array (
  'name' => 'expan_franquicia.name',
  'billing_address_city' => 'expan_franquicia.billing_address_city',
  'phone_office' => 'expan_franquicia.phone_office',
),
    'searchInputs' => array (
  0 => 'name',
  1 => 'billing_address_city',
  2 => 'phone_office',
  3 => 'industry',
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'type' => 'name',
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
  ),
),
);
