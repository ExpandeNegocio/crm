<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
global $app_strings;

$dashletMeta['asol_ProcessDashlet'] = 
	array(
			'module' => 'asol_Process',
			'title' => translate('LBL_HOMEPAGE_TITLE', 'asol_Process'), 
			'description' => 'A customizable view into asol_Process',
			'icon' => 'icon_asol_Process_32.gif',
			'category' => 'Module Views'
	);