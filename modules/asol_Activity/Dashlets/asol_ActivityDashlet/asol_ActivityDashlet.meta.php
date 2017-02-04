<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings;

$dashletMeta['asol_ActivityDashlet'] = 
	array(
			'module' => 'asol_Activity',
			'title' => translate('LBL_HOMEPAGE_TITLE', 'asol_Activity'), 
			'description' => 'A customizable view into asol_Activity',
			'icon' => 'icon_asol_Activity_32.gif',
			'category' => 'Module Views'
	);