class CharacterGen {
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