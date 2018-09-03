<?php

# CONSTANTS
define('__ROOT__', dirname(dirname(__FILE__)));

require_once('ref/ref.php');
require_once('classes/Medoo/Medoo.php');
use Medoo\Medoo;

# DATABASE
$DB = new Medoo([
	'database_type' => 'mysql',
	'database_name' => 'lonelylands',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);

# AUTO LOADER
spl_autoload_register(function ( $class_name ) {
	require_once __ROOT__ . '\includes\classes\\' . $class_name . '.php';
});

# REQUIREMENTS
require_once(__ROOT__ . '\includes\functions.php');

?>