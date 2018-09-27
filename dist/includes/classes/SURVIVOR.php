<?php

/**
 * Class SURVIVOR
 * Primary class for handling details about our survivor.
 */
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

	/**
	 * Create a new character.
	 */
	public static function do_newCharacter ( $DB, $data )
	{

		list($user_id, $token) = identity();

		foreach ($data as $i => $d) {
			if (gettype($d) == 'string') {
				$data->$i = clean($d);
			}
		}

		if (!isset($data->age)) {
			error('Missing age.');
		}
		if (!isset($data->city)) {
			error('Missing city.');
		}
		if (!isset($data->dob)) {
			error('Missing date of birth (dob).');
		}
		if (!isset($data->family)) {
			error('Missing family.');
		}
		if (!isset($data->fullname)) {
			error('Missing fullname.');
		}
		if (!isset($data->gender)) {
			error('Missing gender.');
		}
		if (!isset($data->height)) {
			error('Missing height.');
		}
		if (!isset($data->weight)) {
			error('Missing weight.');
		}
		if (!isset($data->marital_status)) {
			error('Missing marital status.');
		}
		if (!isset($data->prev_occupation)) {
			error('Missing previous occupation.');
		}
		if (!isset($data->skills)) {
			error('Missing skills.');
		}
		if (!isset($data->traits)) {
			error('Missing traits.');
		}

		$data->fullname = preg_replace('/[^A-Za-z0-9\-]/', '', $data->fullname);

		$sql_data = [];
		foreach ($data as $i => $d) {
			if ($i == 'action') {
				continue;
			}
			$sql_data[$i] = $d;
		}

		$sql_data['user_id'] = $user_id;

		$DB->delete('tbl_survivor_stats', ['user_id' => $user_id]);
		$DB->insert('tbl_survivor_stats', $sql_data);
		$result = $DB->error();

		if (isset($result[2])) {
			error('Failed to insert values: ' . $result[2]);
		} else {
			$DB->update('tbl_users', ['character_creation' => 0], ['id' => $user_id]);
			ok('Character created.', [
				'action' => 'game_start',
				'msg' => 'Character successfuly created, good luck out there.'
			]);
		}
	}

}

?>