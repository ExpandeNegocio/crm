<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings;

$dashletMeta['asol_WorkingNodesDashlet'] = 
	array(
			'module' => 'asol_WorkingNodes',
			'title' => translate('LBL_HOMEPAGE_TITLE', 'asol_WorkingNodes'), 
			'description' => 'A customizable view into asol_WorkingNodes',
			'icon' => 'icon_asol_WorkingNodes_32.gif',
			'category' => 'Module Views'
	);