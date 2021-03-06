// ---------------- GLOBAL VARS -----------------

var dev = true;
// Vue.config.devtools = false;
// Vue.config.debug = false;
// Vue.config.silent = true;

Array.prototype.random = function () {
	return this[Math.floor(Math.random() * this.length)];
};

function randBetween(min, max, decimalPlaces = 0) {
	var rand = Math.random() * (max - min) + min;
	var power = Math.pow(10, decimalPlaces);
	return Math.floor(rand * power) / power;
}

function getAge(dateString) {
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || m === 0 && today.getDate() < birthDate.getDate()) {
		age--;
	}
	return age;
}


// ---------------- MAIN APP ----------------

var app = new Vue({
	el: '#app',
	data: {
		ver: '0.0.1a',
		loginForm: new Form(
			'login',
			'../includes/api/index.php',
			{
				username: '',
				email: '',
				con_email: '',
				password: '',
				con_password: ''
			}
		),
		user: {},
		stats: {},
		inventory: {},
		details: {},
		panel: {
			active: ''
		}
	},
	created() {
		if (dev) console.log("Application started: " + this.ver);
	},
	methods: {
		set_user(user) {
			if (dev) console.log(user);
			this.user = user;
		},
		set_stats(stats) {
			if (dev) console.log(stats);
			this.stats = stats;
		},
		set_inventory(inventory) {
			if (dev) console.log(inventory);
			this.inventory = inventory;
		},
		set_details(details) {
			if (dev) console.log(details);
			this.details = details;
		}
	}
});