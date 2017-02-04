<?php

global $db;

// Upgrade DB structure

$fields = Array('start', 'end');

foreach ($fields as $field) {
	$db->query("ALTER TABLE asol_projecttask ADD temp_{$field} bigint(20) DEFAULT NULL;");
	$db->query("UPDATE asol_projecttask SET temp_{$field} = {$field};");
	$db->query("ALTER TABLE asol_projecttask CHANGE {$field} {$field} date DEFAULT NULL;");
}

// Upgrade DB data

$query = $db->query("SELECT * FROM asol_projecttask");

while ($row = $db->fetchByAssoc($query)) {

	$start = date('Y-m-d', $row['temp_start']/1000);
	$end = date('Y-m-d', $row['temp_end']/1000 - 1);

	$db->query("
		UPDATE asol_projecttask 
		SET 
			start = '{$start}',
			end = '{$end}'
		WHERE id = '{$row['id']}'"
	);
}

// Upgrade DB structure

foreach ($fields as $field) {
	$db->query("ALTER TABLE asol_projecttask DROP temp_{$field};");
}
