<?php

Chdir('../../../..');
require_once('SugarWebServiceImpl_v4_custom.php');
$webservice_class = 'SugarRestService';
$webservice_path = 'service/core/SugarRestService.php';
$registry_class = 'registry_custom';
$registry_path = 'custom/ZuckerReports2/service/v4/registry_custom.php';
$webservice_impl_class = 'SugarWebServiceImpl_v4_custom';
$location = 'custom/ZuckerReports2/service/v4/rest.php';
require_once('service/core/webservice.php');

?>