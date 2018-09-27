Vue.component('screen-inventory', {
	template: `
		<div v-if="user.character_creation == 0 && panel.active == 'inventory'" class="o-container">
		
			<div v-if="inventory.contents" class="c-inventory o-layout">
				
				<div v-for="(item, key) in inventory.contents" class="c-inventory__item o-layout__item u-12/12">
				
					<svg class="c-inventory__item__icon">
						<use :xlink:href="generateIconURL(inventory, item.item_id)" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
					</svg>
					
					<div class="c-inventory__item__details">
						<p class="c-inventory__item__details--name">{{ getItemName(inventory, item.item_id) }}</p>
						<p class="c-inventory__item__details--description">{{ getItemDesc(getItem(inventory, item.item_id).description, item.quantity) }}</p>
					</div>
					
					<div class="c-inventory__item__amount">
						{{ item.quantity }}
					</div>
					
				</div>
				
			</div>
			
			<div v-else class="o-container">
			
				<p>There are no items in your inventory.</p>
				
			</div>
			
			<br>
			
			<button @click="panel.active = ''" class="c-button c-button--dingey u-margin-bottom-small u-pin-bottom">Go Back</button><br>
		
		</div>
	`,
	props: ['user', 'panel', 'inventory'],
	data() {
		return {

			getItem(inventory, id) {
				let item = {};
				inventory.items.forEach(function (v) {
					if (v.id == id) {
						item = v;
					}
				});
				return item;
			},

			// TODO - generateIconURL: put ? image where id is unknown
			generateIconURL(inventory, id) {
				let item = this.getItem(inventory, id);
				return "#inventory-item-" + item.icon_id;
			},

			getItemName(inventory, id) {
				let name = this.getItem(inventory, id).name;
				return name.replace('-', ' ');
			},

			getItemDesc(description, quantity) {
				return description.replace('{s}', quantity > 1 ? 's' : '');
			}

		}
	}
});