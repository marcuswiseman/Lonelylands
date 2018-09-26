<?php

use Medoo\Medoo;

class SURVIVOR
{
	public $user_id;
	public $details;
	public $inventory;
	private $stats;
	private $user;

	/**
	 * STATS constructor.
	 * @param $user_id
	 */
	public function __construct ( $user_id )
	{
		global $DB;

		$this->user_id = $user_id;
		$this->details = new DETAILS();
		$this->inventory = new INVENTORY($user_id);

		$this->stats = $DB->get('tbl_survivor_stats', '*', ['user_id' => $user_id]);
		if ($this->stats == false) {
			$DB->update('tbl_users', ['character_creation' => 1], ['id' => $user_id]);
		}
		$this->user = $DB->get('tbl_users', '*', ['id' => $user_id]);
		if ($this->user == false) {
			header('location:login/logout.php');
		} else {
			$this->user['password'] = 'anonymised';
			$this->user['ip_address'] = 'anonymised';
			$this->user['login_token'] = 'anonymised';
		}
	}

	/**
	 * @return array|bool|mixed
	 */
	public function user ()
	{
		return !empty($this->user) ? $this->user : false;
	}

	/**
	 * @return array|bool|mixed
	 */
	public function stats ()
	{
		return !empty($this->stats) ? $this->stats : false;
	}

	/**
	 * @return array|bool|mixed
	 */
	public function inventory ()
	{
		return !empty($this->inventory) ? [
			'items'=>$this->inventory->getItems()->get(),
			'contents'=>$this->inventory->getContents()
		] : false;
	}

}

?>