<?php
require('includes/autoloader.php');
show_errors();
page_setup();

?>

<!DOCTYPE HTML>
<html>

<head>
	<?= new TEMPLATE('header') ?>
</head>

<body class="u-fg--dingey-white">

<?= file_get_contents('symbols.html'); ?>

<div id="app">

	<div class="o-box">

		<!-- CHARACHTER CREATION -->
		<div v-if="user.character_creation == 1" class="o-layout o-layout--flush u-align-center">
			<div class="o-layout__item u-padding-hoz-regular u-padding-vert-small u-12/12">
				<p>Your old life is long forgotten, a new journey awaits.<span class="c-blink"></span></p>
			</div>
			<div class="o-layout__item u-12/12">
				<h1 class="u-margin-bottom-small">Your Survivor</h1>
				<character-creator v-bind:details="details"></character-creator>
			</div>
		</div>

		<!-- DETAIL BAR -->
		<detail-bar
				v-bind:user="user"
				v-bind:stats="stats"
				v-bind:panel="panel">
		</detail-bar>

		<!-- APP DRAW -->
		<app-draw
				v-bind:user="user"
				v-bind:panel="panel">
		</app-draw>

		<!-- SCREENS -->
		<screens
				v-bind:user="user"
				v-bind:panel="panel"
				v-bind:inventory="inventory">
		</screens>

	</div>

</div>

<?= new TEMPLATE("footer", [
	'survivor' => $survivor
]) ?>

</body>

</html>