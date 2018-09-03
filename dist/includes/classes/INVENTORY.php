<?php

use Medoo\Medoo;

class INVENTORY {

	private $user_id;
	private $contents;
	private $items;

	/**
	 * INVENTORY constructor.
	 * @param $user_id
	 */
	public function __construct ($user_id)
	{
		global $DB;
		$this->user_id = $user_id;

		$db_contents = $DB->select('tbl_inventory', '*', ['user_id'=>$user_id]);
		$this->contents = $db_contents;

		$this->items = new ITEMS();
	}

}

?>