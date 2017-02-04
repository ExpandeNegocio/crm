<?php
/* * *******************************************************************************
 * This file is part of KReporter. KReporter is an enhancement developed
 * by Christian Knoll. All rights are (c) 2012 by Christian Knoll
 *
 * This Version of the KReporter is licensed software and may only be used in
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * witten consent of Christian Knoll
 *
 * You can contact us at info@kreporter.org
 * ****************************************************************************** */
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$dictionary['KReportSnapshots'] = array(
	'table' => 'kreportsnapshots',
    'fields' => array (
	   'id' => array(
	        'name' => 'id',
	        'type' => 'id',
	   ),
	   'report_id' => array(
	   		'name' => 'report_id',
	        'type' => 'id',
	   ),
	   'snapshotdate' => array(
	   		'name' => 'snapshotdate',
	        'type' => 'date',
	   ),
	   'snapshotquery' =>array(
	   		'name' => 'snapshotquery',
	        'type' => 'text',
	   ),
	   'data' => array(
	   		'name' => 'data',
			'type' => 'longblob'
	    ),

   	),
   	'indices' => array (
	),
);

$dictionary['KReportFavorites'] = array(
	'table' => 'kreportsfavorites',
    'fields' => array (
	   'id' => array(
	          'name' => 'id',
	          'type' => 'id',
	   ),
	   'user_id' => array(
	          'name' => 'user_id',
	          'type' => 'id',
	   ),
	   'report_id' => array(
	   		'name' => 'report_id',
	        'type' => 'id',
	   ),
	   'description' => array(
	   		'name' => 'description',
	        'type' => 'varchar',
	   		'len' => 100,
	   ),
	   'report_where' => array(
	   		'name' => 'report_where',
	        'type' => 'text',
	   ),
   	),
   	'indices' => array (
	),
);


$dictionary['KReportStats'] = array(
	'table' => 'kreportstats',
    'fields' => array (
	   'id' => array(
	          'name' => 'id',
	          'type' => 'id',
	   ),
	   'user_id' => array(
	          'name' => 'user_id',
	          'type' => 'id',
	   ),
	   'report_id' => array(
	   		'name' => 'report_id',
	        'type' => 'id',
	   ),
	   'date' => array(
	   		'name' => 'date',
	        'type' => 'datetime'
	   ),

   	),
   	'indices' => array (
	),
);

$dictionary['KReportSnapshotsData'] = array(
	'table' => 'kreportsnapshotsdata',
    'fields' => array (
/*	   'id' => array(
	          'name' => 'id',
	          'type' => 'id',
	   ), */
	   'snapshot_id' => array(
	   		'name' => 'snapshot_id',
	        'type' => 'id',
	   ),
	   'record_id' => array(
	   		'name' => 'record_id',
	   		'type' => 'double',
	   ),
	   'data' => array(
	   		'name' => 'data',
	        'type' => 'blob',
	   ),
   	),
   	'indices' => array (
	      array('name' =>'snapshot_data', 'type' =>'primary', 'fields'=>array('snapshot_id', 'record_id'))
	),
);

$dictionary['KReportSchedules'] = array(
	'table' => 'kreportschedules',
    'fields' => array (
	   'id' => array(
	          'name' => 'id',
	          'type' => 'id',
	   ),
	   'date_entered' => array(
	   		'name' => 'date_entered',
	        'type' => 'datetime'
	   ),
	   'date_changed' => array(
	   		'name' => 'date_changed',
	        'type' => 'datetime'
	   ),
	   'user_id' => array(
	          'name' => 'user_id',
	          'type' => 'id',
	   ),
	   'report_id' => array(
	   		'name' => 'report_id',
	        'type' => 'id',
	   ),
	   'month' => array(
	   	   	'name' => 'month',
	        'len' => '2',
	        'type' => 'varchar'
	   ),
	   'dayofmonth' => array(
	   		'name' => 'dayofmonth',
	        'len' => '2',
	        'type' => 'varchar'
	   ),
	   'dayofweek' => array(
	   		'name' => 'dayofweek',
	        'len' => '1',
	        'type' => 'varchar'
	   ),
	   'hour' => array(
	   		'name' => 'hour',
	        'len' => '2',
	        'type' => 'varchar'
	   ),
	   'minutes' => array(
	   		'name' => 'minutes',
	        'len' => '2',
	        'type' => 'varchar'
	   ),
	   'action' => array(
	   		'name' => 'action',
	        'len' => '2',
	        'type' => 'varchar'
	   ),
	   'receipients' => array(
	   		'name' => 'receipients',
	        'type' => 'text'
	   ),
	   'deleted' => array(
	   		'name' => 'deleted',
	        'type' => 'bool'
	   ),
	   'ext_desc' => array(
	   		'name' => 'ext_desc',
	        'type' => 'text'
	   ),
	   'int_desc' => array(
	   		'name' => 'int_desc',
	        'type' => 'text'
	   ),
	   'selvar' => array(
	   		'name' => 'selvar',
	        'type' => 'varchar',
	        'len'  => 36
	   )
   	),
   	'indices' => array (
	),
);

$dictionary['KReportSchedulesLog'] = array(
	'table' => 'kreportscheduleslog',
    'fields' => array (
	   'id' => array(
	          'name' => 'id',
	          'type' => 'id',
	   ),
	   'job_id' => array(
	          'name' => 'job_id',
	          'type' => 'id',
	   ),
	   'timestamp' => array(
	   	      'name' => 'timestamp',
	          'type' => 'varchar',
	          'len' => 10
	   ),
	   'status' => array(
	   	  'name' => 'status',
	          'type' => 'varchar',
	          'len' => 1
	   )

   	),
   	'indices' => array (
	),
);