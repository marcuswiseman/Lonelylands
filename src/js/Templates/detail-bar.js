Vue.component('detail-bar', {
	template: `
		<div v-if="user.character_creation == 0 && panel.active == ''">
			<div class="o-layout c-detailbar">
		
				<div class="o-layout__item u-4/12">
					<svg class="c-detailbar__icon">
						<use xlink:href="#detailbar-heart1" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					{{ stats.health }}
				</div>
		
				<div class="o-layout__item u-4/12">
					<svg class="c-detailbar__icon">
						<use xlink:href="#detailbar-stamina1" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					{{ stats.stamina }}
				</div>
		
			</div>
		</div>
	`,
	props: ['user', 'stats', 'panel'],
	data() {
		return {

		}
	}
});