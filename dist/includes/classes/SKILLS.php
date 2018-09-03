<?php

use Medoo\Medoo;

class SKILLS
{

	private $skills = [];

	/**
	 * SKILLS constructor.
	 */
	public function __construct ()
	{
		$this->skills = [
			[
				'name' => 'Tech-Savvy',
				'description' => 'Advance understanding of alien and human technology.'
			],
			[
				'name' => 'Advance Mathematics',
				'description' => 'Improved mathematics abilities.'
			],
			[
				'name' => 'Hustler',
				'description' => 'Proficient at bartering.'
			],
			[
				'name' => 'Merchant',
				'description' => 'Gets the best values in the market.'
			],
			[
				'name' => 'Farming',
				'description' => 'Can grow their own food if given the right tools for the job.'
			],
			[
				'name' => 'Lockpicking',
				'description' => 'Lockpicking is a skill that really opens doors.'
			],
			[
				'name' => 'Athletics',
				'description' => 'Improved agility and phsyical performance.'
			],
			[
				'name' => 'Mechanics',
				'description' => 'Knows their way around mechanical parts.'
			],
			[
				'name' => 'Technician',
				'description' => "Can fix just about anything."
			],
			[
				'name' => 'Gunsmith',
				'description' => 'Make and repair firearms.'
			],
			[
				'name' => 'Fishing',
				'description' => 'Fish-whisperer.'
			],
			[
				'name' => 'Gunslinger',
				'description' => 'Proficient use of firearms.'
			],
			[
				'name' => 'Keeneye',
				'description' => 'Can detect danger a mile off.'
			],
		];
	}

	public function get_random() {
		return $this->skills[rand(0, count($this->skills)-1)];
	}

	/**
	 * @param null $val
	 */
	public  function get ( $val = null )
	{
		$result = [];
		if (isset($val) && gettype($val) == "array") {
			foreach ($val as $v) {
				foreach ($this->skills as $skill) {
					if ($skill['name'] == $v) {
						$result[] = $skill;
					}
				}
			}
			return $result;
		} else if (isset($val) && gettype($val) == "string") {
			foreach ($this->skills as $skill) {
				if ($skill['name'] == $val) {
					$result = $skill;
				}
			}
			return $result;
		} else {
			return $this->skills;
		}
	}

}

?>