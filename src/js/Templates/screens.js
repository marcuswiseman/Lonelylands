Vue.component('screens', {
	template: `
		<div class="c-screens">
			<screen-maps
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-maps>
	
			<screen-inventory
					v-bind:user="user"
					v-bind:panel="panel"
					v-bind:inventory="inventory">
			</screen-inventory>
	
			<screen-stats
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-stats>
	
			<screen-crafting
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-crafting>
	
			<screen-cooking
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-cooking>
	
			<screen-companions
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-companions>
	
			<screen-diary
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-diary>
	
			<screen-friends
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-friends>
	
			<screen-lootcrates
					v-bind:user="user"
					v-bind:panel="panel">
			</screen-lootcrates>
		</div>
	`,
	props: ['user', 'panel', 'inventory']
});