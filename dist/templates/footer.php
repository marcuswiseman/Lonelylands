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
