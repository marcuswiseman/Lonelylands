<?php

require_once('../autoloader.php');

# GATHER POST DATA
$data = json_decode(file_get_contents('php://input'));

# GATHER ACTION
$action = (isset($data->action) && $data->action != '') ? $data->action : error('No action specified.');

# GATHER DEBUG OPTIONS
$debug = (isset($data->debug) && $data->debug != '') ? $data->debug : null;

if (isset($debug) && $debug == "1") {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

# PUBLIC USE
if (in_array($action, ['login', 'register'])) {

	if ($action == 'login') {
		return AUTH::login($data);
	} else if ($action == 'register') {
		return AUTH::register($data);
	}

}

# API USE BEYOND THIS POINT
page_setup('api');

if ($action == 'new-character') {

	foreach ($data as $i => $d) {
		if (gettype($d) == 'string') {
			$data->$i = clean($d);
		}
	}

	if (!isset($data->age)) {
		error('Missing age.');
	}
	if (!isset($data->city)) {
		error('Missing city.');
	}
	if (!isset($data->dob)) {
		error('Missing date of birth (dob).');
	}
	if (!isset($data->family)) {
		error('Missing family.');
	}
	if (!isset($data->fullname)) {
		error('Missing fullname.');
	}
	if (!isset($data->gender)) {
		error('Missing gender.');
	}
	if (!isset($data->height)) {
		error('Missing height.');
	}
	if (!isset($data->weight)) {
		error('Missing weight.');
	}
	if (!isset($data->marital_status)) {
		error('Missing marital status.');
	}
	if (!isset($data->prev_occupation)) {
		error('Missing previous occupation.');
	}
	if (!isset($data->skills)) {
		error('Missing skills.');
	}
	if (!isset($data->traits)) {
		error('Missing traits.');
	}

	$data->fullname = preg_replace('/[^A-Za-z0-9\-]/', '', $data->fullname);

	$sql_data = [];
	foreach ($data as $i => $d) {
		if ($i == 'action') {
			continue;
		}
		$sql_data[$i] = $d;
	}

	$sql_data['user_id'] = $survivor->user_id;

	$DB->delete('tbl_survivor_stats', ['user_id'=>$survivor->user_id]);
	$DB->insert('tbl_survivor_stats', $sql_data);
	$result = $DB->error();

	if (isset($result[2])) {
		error('Failed to insert values: ' . $result[2]);
	} else {
		$DB->update('tbl_users', ['character_creation'=>0], ['id'=>$survivor->user_id]);
		ok('Character created.', [
			'action' => 'game_start',
			'msg' => 'Character successfuly created, good luck out there.'
		]);
	}

}

?>