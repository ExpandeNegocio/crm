<?php
$popupMeta = array (
    'moduleMain' => 'Employees',
    'varName' => 'Employee',
    'orderBy' => 'employees.first_name, employees.last_name',
    'whereClauses' => array (
  'first_name' => 'employees.first_name',
  'last_name' => 'employees.last_name',
  'employee_status' => 'employees.employee_status',
  'departamento_c' => 'employees_cstm.departamento_c',
  'title' => 'employees.title',
  'phone' => 'employees.phone',
  'email' => 'employees.email',
  'address_street' => 'employees.address_street',
  'address_city' => 'employees.address_city',
  'address_state' => 'employees.address_state',
  'address_postalcode' => 'employees.address_postalcode',
  'address_country' => 'employees.address_country',
),
    'searchInputs' => array (
  0 => 'first_name',
  1 => 'last_name',
  2 => 'employee_status',
  3 => 'departamento_c',
  4 => 'title',
  5 => 'phone',
  6 => 'email',
  7 => 'address_street',
  8 => 'address_city',
  9 => 'address_state',
  10 => 'address_postalcode',
  11 => 'address_country',
),
    'searchdefs' => array (
  'first_name' => 
  array (
    'name' => 'first_name',
    'width' => '10%',
  ),
  'last_name' => 
  array (
    'name' => 'last_name',
    'width' => '10%',
  ),
  'employee_status' => 
  array (
    'name' => 'employee_status',
    'width' => '10%',
  ),
  'departamento_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DEPARTAMENTO',
    'width' => '10%',
    'name' => 'departamento_c',
  ),
  'title' => 
  array (
    'name' => 'title',
    'width' => '10%',
  ),
  'phone' => 
  array (
    'name' => 'phone',
    'label' => 'LBL_ANY_PHONE',
    'type' => 'name',
    'width' => '10%',
  ),
  'email' => 
  array (
    'name' => 'email',
    'label' => 'LBL_ANY_EMAIL',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_street' => 
  array (
    'name' => 'address_street',
    'label' => 'LBL_ANY_ADDRESS',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_city' => 
  array (
    'name' => 'address_city',
    'label' => 'LBL_CITY',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_state' => 
  array (
    'name' => 'address_state',
    'label' => 'LBL_STATE',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_postalcode' => 
  array (
    'name' => 'address_postalcode',
    'label' => 'LBL_POSTAL_CODE',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_country' => 
  array (
    'name' => 'address_country',
    'label' => 'LBL_COUNTRY',
    'type' => 'name',
    'width' => '10%',
  ),
),
);
