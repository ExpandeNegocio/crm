<?php

Chdir('../../../..');
$webservice_class = 'SugarSoapService2';
$webservice_path = 'service/v2/SugarSoapService2.php';
$registry_class = 'registry_custom';
$registry_path = 'custom/ZuckerReports2/service/v4/registry_custom.php';
$webservice_impl_class = 'SugarWebServiceImpl_v4_custom';
$location = 'custom/ZuckerReports2/service/v4/soap.php';
require_once('service/core/webservice.php');

?>