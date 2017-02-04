<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings;

$dashletMeta['asol_EventsDashlet'] = 
	array(
			'module' => 'asol_Events',
			'title' => translate('LBL_HOMEPAGE_TITLE', 'asol_Events'), 
			'description' => 'A customizable view into asol_Events',
			'icon' => 'icon_asol_Events_32.gif',
			'category' => 'Module Views'
	);