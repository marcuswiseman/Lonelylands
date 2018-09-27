<?php

/**
 * Class INVENTORY
 * Handling of survivors inventroy.
 */
class INVENTORY
{

	public $items;
	private $user_id;
	private $contents;

	/**
	 * INVENTORY constructor.
	 * @param $user_id
	 */
	public function __construct ( $user_id )
	{
		global $DB;
		$this->user_id = $user_id;
		$db_contents = $DB->select('tbl_inventory', '*', ['user_id' => $user_id]);
		$this->contents = $db_contents;
		$this->items = new ITEMS();
	}

	/**
	 * @return array|bool
	 */
	public function getContents ()
	{
		return $this->contents;
	}

	/**
	 * @return ITEMS
	 */
	public function getItems ()
	{
		return $this->items;
	}

}

?>