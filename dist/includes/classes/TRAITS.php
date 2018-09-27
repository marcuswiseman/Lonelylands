<?php

/**
 * Class TRAITS
 * Hardcoded dataset of survivor traits.
 */
class TRAITS
{

	private $traits = [];

	/**
	 * TRAITS constructor.
	 */
	public function __construct ()
	{
		$this->traits = [
			[
				'name' => 'Edgey',
				'description' => 'Easily startled but has fast reflexes.'
			],
			[
				'name' => 'Introvert',
				'description' => 'A shy and bad at conversation.'
			],
			[
				'name' => 'Light Footed',
				'description' => 'Movement noise reduced.'
			],
			[
				'name' => 'Foodie',
				'description' => 'Eats more than they can chew.'
			],
			[
				'name' => 'Abstemious',
				'description' => 'Eats less than the average jo.'
			],
			[
				'name' => 'Nightowl',
				'description' => "Requires little sleep to function."
			],
			[
				'name' => 'Smoker',
				'description' => "Reduced stanima."
			],
			[
				'name' => 'Addict',
				'description' => "Can't scratch the itch, highly paranoid."
			],
			[
				'name' => 'Heavy Footed',
				'description' => "Movement noise hightened."
			],
			[
				'name' => 'Nutritionist',
				'description' => "Performs better when eating healther foods."
			],
			[
				'name' => 'Reactive',
				'description' => 'Sharp reflexes and quicker response times.'
			],
			[
				'name' => 'Strong',
				'description' => 'Improved toughness and physical performance.'
			],
			[
				'name' => 'Organised',
				'description' => 'Better inventory management.',
			],
			[
				'name' => 'Greenthumb',
				'description' => 'Quick and clean food production.',
			],
			[
				'name' => 'People Person',
				'description' => "Everyone's slice of cake.",
			],
		];
	}

	/**
	 * @return mixed
	 */
	public function get_random ()
	{
		return $this->traits[rand(0, count($this->traits) - 1)];
	}

	/**
	 * @param null $val
	 */
	public function get ( $val = null )
	{
		$result = [];
		if (isset($val) && gettype($val) == "array") {
			foreach ($val as $v) {
				foreach ($this->traits as $trait) {
					if ($trait['name'] == $v) {
						$result[] = $trait;
					}
				}
			}
			return $result;
		} else if (isset($val) && gettype($val) == "string") {
			foreach ($this->traits as $trait) {
				if ($trait['name'] == $val) {
					$result = $trait;
				}
			}
			return $result;
		} else {
			return $this->traits;
		}
	}

}

?>