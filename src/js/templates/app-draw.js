Vue.component('app-draw', {
	template: `
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
	`,
	props: ['user', 'panel'],
	data() {
		return {}
	}
});