<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings;

if (empty($_REQUEST['record'])) die($mod_strings['LBL_REPORT_NOT_FOUND']);

require_once('modules/asol_Reports/include_basic/generateReport.php');


$fieldSort = (isset($_REQUEST['field_sort'])) ? $_REQUEST['field_sort'] : "";
$sortDirection = (isset($_REQUEST['sort_direction'])) ? $_REQUEST['sort_direction'] : "";
$pageNumber = (isset($_REQUEST['page_number'])) ? $_REQUEST['page_number'] : "";
$isDashlet = ((isset($_REQUEST['dashlet'])) && ($_REQUEST['dashlet'] == 'true')) ? true: false; 
$dashletId = (isset($_REQUEST['dashletId'])) ? $_REQUEST['dashletId'] : '';
$dashletWidth = (isset($_REQUEST['dashletWidth'])) ? $_REQUEST['dashletWidth'] : '';
$getLibraries = ((isset($_REQUEST['getLibraries'])) && ($_REQUEST['getLibraries'] == 'false')) ? false : true;
$contextDomainId = (isset($_REQUEST['contextDomainId'])) ? $_REQUEST['contextDomainId'] : null;

displayReport($_REQUEST['record'], $fieldSort, $sortDirection, $pageNumber, $isDashlet, $dashletId, $dashletWidth, $getLibraries, false, $contextDomainId);

?>