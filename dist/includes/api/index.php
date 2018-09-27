<?php

/*
 * Essentially the main model.
 * Ideally I should change this to auto load classes using the action variable.
 * This would reduce the amount of clutter put in here.
 */

require_once('../autoloader.php');

# GATHER POST DATA
$data = json_decode(file_get_contents('php://input'));

# GATHER ACTION & CONTROLLER
@$action = (isset($data->action) && $data->action != '') ? $data->action : error('No action specified.');

# GATHER DEBUG OPTIONS
$debug = (isset($data->debug) && $data->debug != '') ? $data->debug : null;

if (isset($debug) && $debug == "1") {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

# PUBLIC USE
if (in_array($action, ['login', 'register'])) {

	page_setup('no_login');

	if ($action == 'login') {
		return AUTH::login($data);
	} else if ($action == 'register') {
		return AUTH::register($data);
	}

} else {

	page_setup('api');

	if (isset($action)) {
		@list($controller, $action) = explode(':', $action);
		if (!isset($controller) || !isset($action)) {
			error('Invalid action. (#0)');
		}
	} else {
		error('Invalid action. (#1)');
	}

	if (method_exists(strtoupper($controller), "do_{$action}")
		&& is_callable([$controller, "do_{$action}"])) {
		call_user_func(
			[$controller, "do_{$action}"], $DB, $data
		);
	} else {
		error('Invalid action. (#2)');
	}

}

?>