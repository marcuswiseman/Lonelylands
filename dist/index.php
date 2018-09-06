<?php
require('includes/autoloader.php');
show_errors();
page_setup();

?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Lonely Lands</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/main.min.css">
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

		<!-- USER DETAIL BAR -->
		<div v-if="user.character_creation == 0 && panel.active == ''">
			<div class="o-layout c-detailbar">

				<div class="o-layout__item u-3/12">
					<svg class="c-detailbar__icon">
						<use xlink:href="#detailbar-heart1" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					{{ stats.health }}
				</div>

				<div class="o-layout__item u-3/12">
					<svg class="c-detailbar__icon">
						<use xlink:href="#detailbar-stamina1" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					{{ stats.stamina }}
				</div>

			</div>
		</div>

		<!-- APP DRAW -->
		<div v-if="user.character_creation == 0 && panel.active == ''">

			<div class="o-layout c-appdraw o-layout--flush u-padding-hoz-regular">

				<div @click="panel.active = 'maps'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-maps" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					MAPS
				</div>

				<div @click="panel.active = 'inventory'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-inventory" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					INVENTORY
				</div>

				<div @click="panel.active = 'stats'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-stats" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					STATS
				</div>

				<div @click="panel.active = 'crafting'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-crafting" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					CRAFTING
				</div>

				<div @click="panel.active = 'cooking'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-cooking" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					COOKING
				</div>

				<div @click="panel.active = 'companions'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-companions" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					COMPANIONS
				</div>

				<div @click="panel.active = 'diary'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-diary" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					DIARY
				</div>

				<div @click="panel.active = 'friends'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-friends" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					FRIENDS
				</div>

				<div @click="panel.active = 'lootcrates'" class="c-layout__item c-appdraw__item u-4/12">
					<svg class="c-appdaw__icon">
						<use xlink:href="#appdraw-lootcrates" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					AIRDROPS
				</div>

			</div>

		</div>

		<!-- SCREENS -->

		<div v-else-if="user.character_creation == 0 && panel.active == 'maps'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'inventory'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'stats'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'crafting'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'cooking'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'companions'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'diary'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'friends'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

		<div v-else-if="user.character_creation == 0 && panel.active == 'lootcrates'" class="o-layout">
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
		</div>

	</div>

</div>

<script type="application/javascript" src="js/vue.js"></script>
<script type="application/javascript" src="js/vue-resource.js"></script>
<script type="application/javascript" src="js/main.min.js"></script>
<script>
	app.__vue__.set_user(<?= $survivor->user() ? json_encode($survivor->user()) : 'null' ?>);
	app.__vue__.set_stats(<?= $survivor->stats() ? json_encode($survivor->stats()) : 'null' ?>);
	app.__vue__.set_details({
		'skills':<?= json_encode($survivor->details->get_skills()) ?>,
		'traits':<?= json_encode($survivor->details->get_traits()) ?>,
		'occupations':<?= json_encode($survivor->details->get_occupations()) ?>
	});
</script>
</body>

</html>