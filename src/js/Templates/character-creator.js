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
			character: new CharacterGen(this.details),
		}
	},
	methods: {
		genCharacter: function() {
			this.character = new CharacterGen(this.details);
		}
	}
});