<?php
session_start();
setcookie(
	'login_token',
	$user[0]['id'] . '-' . $token,
	time() - 1000,
	"/"
);
unset($_SESSION['login_token']);
header('location:./');
?>