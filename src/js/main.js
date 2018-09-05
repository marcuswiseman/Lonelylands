// ---------------- GLOBAL VARS -----------------

var dev = true;
// Vue.config.devtools = false;
// Vue.config.debug = false;
// Vue.config.silent = true;

Array.prototype.random = function () {
	return this[Math.floor((Math.random()*this.length))];
}

function randBetween(min, max, decimalPlaces=0) {
	var rand = Math.random()*(max-min) + min;
	var power = Math.pow(10, decimalPlaces);
	return Math.floor(rand*power) / power;
}

function getAge(dateString)
{
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
	{
		age--;
	}
	return age;
}

// ---------------- CLASSES -----------------

class characterGen {
	constructor(details) {
		let day = randBetween(1, 29);
		let month = randBetween(1, 13);
		let year = randBetween(1970, 2001);
		this.dob = new Date(year, month, day).toISOString().substring(0, 10);
		this.age = getAge(this.dob);
		this.marital_status = Array('Married', 'Single', 'Divorced', 'Widowed').random();
		this.gender = Array('Male', 'Female').random();
		this.occupation = details.occupations.random();
		this.skills = this.occupation.skills;
		this.traits = this.occupation.traits;
		this.family = Array(
			'A brother',
			'A sister',
			'Two brothers',
			'A brother and a sister',
			'Two sisters',
			'A daughter',
			'None',
			'A son',
			'Two daughters',
			'Two sons',
			'Two sons and a daughter',
			'Two daughters and a son'
		).random();
		this.city = Array(
			'London',
			'Paris',
			'Dubai',
			'New York',
			'Singapre',
			'Tokyo',
			'Seoul',
			'Hong Kong',
			'Barcelona',
			'Milan',
			'Taipei',
			'Rome',
			'Los Angeles',
			'Miami',
			'Dublin',
			'Prague'
		).random();
		if (this.gender == "Male") {
			this.weight = randBetween(65, 81) + ' kg';
			this.height = randBetween(5, 7) + "ft " + randBetween(1, 9) + '';
		} else {
			this.weight = randBetween(60, 71) + ' kg';
			this.height = randBetween(4, 6);
			if (this.height == 4) {
				this.height += "ft " + randBetween(10, 12) + '';
			} else {
				this.height += "ft " + randBetween(1, 12) + '';
			}
		}
	}

	display_occupation() {
		return this.occupation['jobtitle'];
	}

	display_skills(tags=false) {
		var html = Array();
		this.skills.forEach(function(val) {
			if (tags) {
				html.push('<span class="c-skill-tag" title="' + val['description'] + '">' + val['name'] + '</span>');
			} else {
				html.push(val['name']);
			}
		});
		if (tags) {
			return html.join('');
		} else {
			return html.join(',');
		}
	}

	display_traits(tags=false) {
		var html = Array();
		this.traits.forEach(function(val) {
			if (tags) {
				html.push('<span class="c-trait-tag" title="' + val['description'] + '">' + val['name'] + '</span>');
			} else {
				html.push(val['name']);
			}
		});
		if (tags) {
			return html.join('');
		} else {
			return html.join(',');
		}
	}
}

class Form {
	constructor(target, actionUrl, fields) {
		this.target = target;
		this.actionUrl = actionUrl;
		this.fields = fields;
	}

	change(val) {
		this.target = val;
	}

	response(val) {
		this.prev_target = this.target;
		this.target = 'response';

		if (typeof val.response !== "undefined" && typeof val.response.data !== "undefined" && val.response.data != null) {

			switch (val.response.data.action) {
				case 'redirect':
					window.location.replace(val.response.data.url);
					break;
				case 'msg':
					this.reply = val.response.data.msg;
					break;
				case 'back_to_login': {
					this.fields = {
						username: '',
						email: '',
						con_email: '',
						password: '',
						con_password: ''
					};
					this.reply = val.response.data.msg;
					this.prev_target = 'login';
					break;
				}
			}

		} else {
			this.reply = val.msg;
		}
	}

	submit(event, values) {
		var post_data = {};
		var missing = [];
		var action = null;
		if (typeof event.target.elements.action !== 'undefined') {
			action = event.target.elements.action.value;
			post_data['action'] = action;
			if (dev) console.log(action);
			if (typeof values !== 'undefined') {
				values.forEach(function (value) {
					if (typeof event.target.elements.namedItem(value).value !== 'undefined' && event.target.elements.namedItem(value).value != '') {
						post_data[value] = event.target.elements.namedItem(value).value;
					} else {
						missing.push(value);
					}
				});
				if (typeof missing !== 'undefined' && missing.length > 0) {
					return this.response({
						status: 'error',
						msg: 'Missing field: ' + missing[0]
					});
				} else {
					if (dev) console.log(post_data);
					app.$http.post(this.actionUrl, post_data).then(reply => {
						if (dev) console.log(reply);
						if (reply.status == 200) {
							return this.response({
								status: 'ok',
								msg: reply.body.msg,
								response: reply.body
							});
						} else {
							return this.response({
								status: 'error',
								msg: 'Something went wrong, please report this issue to the site admin if it presists.'
							});
						}
					});
				}
			} else {
				return this.response({
					status: 'error',
					msg: 'Missing submit values, please specifiy submission values.'
				});
			}
		}
		else {
			return this.response({
				status: 'error',
				msg: 'Missing action value, attach name:action and value:??? to submit button.'
			});
		}

	}
}

// --------------- COMPONENTS ---------------

// TODO - On click display description of skills and traits.

Vue.component('character-creator', {
	template: `
		<div class="c-character-creator">
				<form @submit.prevent="characterForm.submit($event, ['fullname', 'dob', 'gender', 'age', 'height', 'weight', 'marital_status', 'family', 'city', 'prev_occupation', 'skills', 'traits'])" 
					v-if="characterForm.target == 'setup'" method="POST" class="o-layout o-layout--flush">
					
					<div class="o-layout__item u-align-center u-margin-bottom-small u-12/12">
						<label>Full Name</label><br>
						<input class="c-field c-field-fit80" type="text" name="fullname">
					</div>
					
					<div class="o-layout__item u-align-center u-margin-bottom-small u-padding-hoz-regular u-12/12 ">
						<table class="c-table c-table--small u-vert-overflow" style="max-height:50vh">
							<tr>
								<th>Date of Birth</th>
								<td>
									{{ character.dob }}
									<input type="hidden" :value="character.dob" name="dob">
								</td>
							</tr>
							<tr>
								<th>Gender</th>
								<td>
									{{ character.gender }}
									<input type="hidden" :value="character.gender" name="gender">
								</td>
							</tr>
							<tr>
								<th>Age</th>
								<td>{{ character.age }}
									<input type="hidden" :value="character.age" name="age">
								</td>
							</tr>
							<tr>
								<th>Height</th>
								<td>
									{{ character.height }}
									<input type="hidden" :value="character.height" name="height">
								</td>
							</tr>
							<tr>
								<th>Weight</th>
								<td>
									{{ character.weight }}
									<input type="hidden" :value="character.weight" name="weight">
								</td>
							</tr>
							<tr>
								<th>Martial Status</th>
								<td>
									{{ character.marital_status }}
									<input type="hidden" :value="character.marital_status" name="marital_status">
								</td>
							</tr>
							<tr>
								<th>Family Members</th>
								<td>
									{{ character.family }}
									<input type="hidden" :value="character.family" name="family">
								</td>
							</tr>
							<tr>
								<th>Location</th>
								<td>
									{{ character.city }}
									<input type="hidden" :value="character.city" name="city">
								</td>
							</tr>
							<tr>
								<th>Previous Occupation:</th>
								<td>
									{{ character.display_occupation() }}
									<input type="hidden" :value="character.display_occupation()" name="prev_occupation">
								</td>
							</tr>
							<tr>
								<th colspan="2">Skills & Traits</th>
							</tr>
							<tr>
								<td colspan="2" v-html="character.display_skills(true) + character.display_traits(true)">
									
								</td>
								<td class="u-hide">
									<input type="hidden" :value="character.display_skills()" name="skills">
									<input type="hidden" :value="character.display_traits()" name="traits">
								</td>
							</tr>
						</table>
					</div>
					
					<div class="o-layout__item u-align-center u-12/12">
						<div class="o-layout u-padding-hoz-regular">
							<div class="o-layout__item u-6/12">
								<button class="c-button c-button--dingey u-margin-bottom-small" @click.prevent="genCharacter()">Randomise</button>
							</div>
							
							<div class="o-layout__item u-6/12">
								<button class="c-button c-button--dingey u-margin-bottom-small" name="action" value="new-character">Confirm</button>
							</div>

						</div>
					</div>
					
					
					<div class="o-layout__item u-align-center u-6/12">
					</div>
		
				</form>
				<div v-else-if="characterForm.target == 'response'" class="o-layout o-layout--fit-height o-layout--flush u-padding-vert-regular u-margin-top-large">
					<div class="o-layout__item u-align-center u-margin-bottom-small u-padding-hoz-regular u-12/12">
						{{ characterForm.reply != null ? characterForm.reply : 'Form submitted.' }}
					</div>
					<div class="o-layout__item u-align-center u-12/12">
						<button @click.prevent="characterForm.change(characterForm.prev_target)" class="c-button c-button--dingey u-margin-bottom-small">Go Back</button><br>
					</div>
				</div>
			</div>
		</div>
	`,
	props: ['details'],
	data() {
		return {
			characterForm: new Form(
				'setup',
				'includes/api/index.php',
				{
					'fullname': ''
				}
			),
			character: new characterGen(this.details),
		}
	},
	methods: {
		genCharacter: function() {
			this.character = new characterGen(this.details);
		}
	}
});

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
		details: {},
		panel: {
			active:''
		}
	},
	created: function () {
		if (dev) console.log("Application started: " + this.ver);
	},
	methods: {
		set_user: function (user) {
			if (dev) console.log(user);
			this.user = user;
		},
		set_stats: function (stats) {
			if (dev) console.log(stats);
			this.stats = stats;
		},
		set_details: function (details) {
			if (dev) console.log(details);
			this.details = details;
		}
	}
});