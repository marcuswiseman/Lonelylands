<?php

use Medoo\Medoo;

/**
 * Class DETAILS
 * Survivor background details
 */
class DETAILS
{

	private $occupations;
	private $skills;
	private $traits;

	/**
	 * DETAILS constructor.
	 */
	public function __construct ()
	{
		$this->skills = new SKILLS();
		$this->traits = new TRAITS();
		$this->occupations = new OCCUPATIONS();
	}

	public function get_skills() {
		return $this->skills->get();
	}

	public function get_traits() {
		return $this->traits->get();
	}

	public function get_occupations() {
		return $this->occupations->get();
	}

}

?>