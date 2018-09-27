<?php

/**
 * Class ITEMS
 * Handling of items. We pass this list to the client end, so the framework can pull the details it needs.
 */
class ITEMS
{

	private $items;

	/**
	 * ITEMS constructor.
	 */
	public function __construct ()
	{
		global $DB;
		$items = $DB->select('tbl_items', '*');
		$this->items = $items;
	}

	/**
	 * Find item by id or name.
	 * @return array
	 */
	public function get ( $key = null )
	{
		$type = gettype($key);
		$result = null;
		switch ($type) {
			case 'integer':
				foreach ($this->items as $item) {
					if ($item['id'] == $key) {
						$result = $item;
						break;
					}
				}
				break;
			case 'string':
				foreach ($this->items as $item) {
					if ($item['name'] == $key) {
						$result = $item;
						break;
					}
				}
				break;
			default:
				$result = $this->items;
				break;
		}
		return $result;
	}

}

?>