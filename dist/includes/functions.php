<?php

# RETURN OK JSON
function ok ( $msg, $data = null )
{
	die(json_encode([
		'status' => 'ok',
		'msg' => $msg,
		'data' => $data
	]));
}

# RETURN ERROR JSON
function error ( $msg )
{
	die(json_encode([
		'status' => 'error',
		'msg' => $msg
	]));
}

# GET IP ADDRESS
function ip_address ()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

# PAGE INITIATION
function page_setup ( $option = '' )
{
	global $DB;
	global $survivor;
	session_start();
	if ($option != "no_login") {

		if (isset($_SESSION['login_token']) || isset($_COOKIE['login_token'])) {
			$token = isset($_SESSION['login_token']) ? $_SESSION['login_token'] : $_COOKIE['login_token'];
			list($id, $token) = explode('-', $token);
			$user = $DB->count(
				'tbl_users',
				'id', [
					'id' => $id,
					'login_token' => $token,
					'ip_address' => ip_address()
				]
			);
			if ($user == false) {
				header('location:login/logout.php');
			} else {
				$survivor = new SURVIVOR($id);
			}
		} else {
			if ($option != 'api') {
				header('location:login/');
			} else {
				if (isset($_POST['secret']) && $_POST['secret'] != '') {
					// TODO - Check 3rd party access here
				} else {
					error('No API token specified');
				}
			}
		}

	}
}

# SHOW ERRORS
function show_errors() {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

# ENCRYPT A STRING
function encrypt_string ( $string, $key = '@Unic0rnPizza832!' )
{
	$secret_key = $key;
	$secret_iv = $key;
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
}

# DECRYPT A STRING
function decrypt_string ( $string, $key = '@Unic0rnPizza832!' )
{
	$secret_key = $key;
	$secret_iv = $key;
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	return $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
}

# CLEAN
function clean ($value) {
	$value = strtolower($value);
	$value = str_replace(' ', '-', $value);
	return $value;
}

?>