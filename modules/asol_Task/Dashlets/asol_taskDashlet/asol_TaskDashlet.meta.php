<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings;

$dashletMeta['asol_TaskDashlet'] = 
	array(
			'module' => 'asol_Task',
			'title' => translate('LBL_HOMEPAGE_TITLE', 'asol_Task'), 
			'description' => 'A customizable view into asol_Task',
			'icon' => 'icon_asol_Task_32.gif',
			'category' => 'Module Views'
	);