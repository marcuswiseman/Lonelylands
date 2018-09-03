<?php
require('../includes/autoloader.php');
page_setup('no_login');
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Lonely Lands</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/main.min.css">
</head>

<body class="u-bg--dingey-green u-fg--dingey-white">

<div id="app">

	<!-- REGISTER FORM -->
	<form @submit.prevent="loginForm.submit($event, ['username', 'email', 'con_email', 'password', 'con_password'])" v-if="loginForm.target == 'register'" method="POST" class="o-layout o-layout--fit-height o-layout--flush u-padding-vert-regular u-margin-top-large">
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<h1 class="c-type">Register</h1>
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Username</label><br>
			<input class="c-field c-field-fit80" v-model="loginForm.fields.username" type="text" name="username">
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Email</label><br>
			<input class="c-field c-field-fit80" v-model="loginForm.fields.email" type="email" name="email">
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Confirm Email</label><br>
			<input class="c-field c-field-fit80" v-model="loginForm.fields.con_email" type="email" name="con_email">
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Password</label><br>
			<input class="c-field c-field-fit80" v-model="loginForm.fields.password" type="password" name="password">
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Confirm Password</label><br>
			<input class="c-field c-field-fit80" v-model="loginForm.fields.con_password" type="password" name="con_password">
		</div>
		<div class="o-layout__item u-align-center u-12/12">
			<button class="c-button c-button--dingey u-margin-bottom-small" name="action" value="register">Submit</button><br>
			or <a @click.prevent="loginForm.change('login')">Login</a>
		</div>
	</form>

	<!-- LOGIN FORM -->
	<form @submit.prevent="loginForm.submit($event, ['email', 'password'])" v-else-if="loginForm.target == 'login'" method="POST" class="o-layout o-layout--fit-height o-layout--flush u-padding-vert-regular u-margin-top-large">
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<h1>Login</h1>
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Email</label><br>
			<input class="c-field c-field-fit80" type="email" name="email">
		</div>
		<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
			<label>Password</label><br>
			<input class="c-field c-field-fit80" type="password" name="password">
		</div>
		<div class="o-layout__item u-align-center u-12/12">
			<button class="c-button c-button--dingey u-margin-bottom-small" name="action" value="login">Login</button><br>
			or <a @click.prevent="loginForm.change('register')">Register</a>
		</div>
	</form>

	<!-- RESPONSE -->
	<div v-else-if="loginForm.target == 'response'" class="o-layout o-layout--fit-height o-layout--flush u-padding-vert-regular u-margin-top-large">
		<div class="o-layout__item u-align-center u-margin-bottom-small u-padding-hoz-regular u-12/12">
			{{ loginForm.reply }}
		</div>
		<div class="o-layout__item u-align-center u-12/12">
			<button @click.prevent="loginForm.change(loginForm.prev_target)" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>
	</div>

</div>

<script type="application/javascript" src="../js/vue.js"></script>
<script type="application/javascript" src="../js/vue-resource.js"></script>
<script type="application/javascript" src="../js/main.min.js"></script>
</body>

</html>