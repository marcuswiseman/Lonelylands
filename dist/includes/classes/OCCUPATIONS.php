<?php

/**
 * Class OCCUPATIONS
 * Hardcoded dataset of occupations, uises skills class and traits.
 */
class OCCUPATIONS
{

	protected $skills = [];
	protected $traits = [];
	private $occupations = [];

	/**
	 * OCCUPATIONS constructor.
	 */
	public function __construct ()
	{
		$this->skills = new SKILLS;
		$this->traits = new TRAITS;

		$this->occupations = [
			[
				'jobtitle' => 'Programmer',
				'skills' => $this->skills->get(['Tech-Savvy']),
				'traits' => $this->traits->get(['Edgey', 'Introvert', 'Organised'])
			],
			[
				'jobtitle' => 'Mechanic',
				'skills' => $this->skills->get(['Mechanics']),
				'traits' => $this->traits->get(['Smoker', 'Endurance', 'Heavy Footed', 'Strong'])
			],
			[
				'jobtitle' => 'Personal Trainer',
				'skills' => $this->skills->get(['Athletics', $this->skills->get_random()['name']]),
				'traits' => $this->traits->get(['Light Footed', 'Endurance', 'Nutritionist', 'Strong'])
			],
			[
				'jobtitle' => 'Police Officer',
				'skills' => $this->skills->get(['Gunslinger', 'Gunsmith']),
				'traits' => $this->traits->get(['Reactive', 'Strong'])
			],
			[
				'jobtitle' => 'Bouncer',
				'skills' => $this->skills->get(['Keeneye']),
				'traits' => $this->traits->get(['Reactive', 'Strong', $this->traits->get_random()['name']])
			],
			[
				'jobtitle' => 'Burglar',
				'skills' => $this->skills->get(['Lockpicking']),
				'traits' => $this->traits->get(['Light Footed', 'Nightowl', 'Edgey'])
			],
			[
				'jobtitle' => 'Farmer',
				'skills' => $this->skills->get(['Farming']),
				'traits' => $this->traits->get(['Organised', 'Greenthumb', 'Heavy Footed'])
			],
			[
				'jobtitle' => 'Fisherman',
				'skills' => $this->skills->get(['Fishing']),
				'traits' => $this->traits->get(['Smoker', 'Nightowl', 'Reactive'])
			],
			[
				'jobtitle' => 'Salesman',
				'skills' => $this->skills->get(['Hustler', 'Merchant']),
				'traits' => $this->traits->get(['People Person', $this->traits->get_random()])
			],
			[
				'jobtitle' => 'Unemployed',
				'skills' => [$this->skills->get_random()],
				'traits' => [$this->traits->get_random(), $this->traits->get_random(), $this->traits->get_random()]
			],
		];
	}

	/**
	 * @param null $val
	 */
	public function get ( $val = null )
	{
		$result = [];
		if (isset($val) && gettype($val) == "array") {
			foreach ($val as $v) {
				foreach ($this->occupations as $occupation) {
					if ($occupation['jobtitle'] == $v) {
						$result[] = $occupation;
					}
				}
			}
			return $result;
		} else if (isset($val) && gettype($val) == "string") {
			foreach ($this->occupations as $occupation) {
				if ($occupation['jobtitle'] == $val) {
					$result = $occupation;
				}
			}
			return $result;
		} else {
			return $this->occupations;
		}
	}

}