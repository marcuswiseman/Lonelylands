<?php

use Medoo\Medoo;

class AUTH
{

	/**
	 * Generate a random token.
	 * @param $size
	 * @return string
	 * @throws Exception
	 */
	public static function token ( $size=32 ) {
		$bytes = random_bytes($size);
		return bin2hex($bytes);
	}

	/**
	 * Login using credentials from post data.
	 * @param $params
	 */
	public static function login ( $params )
	{
		global $DB;
		if (!empty($params)
			&& isset($params->email)
			&& isset($params->password)) {

			$user = $DB->select('tbl_users', ['id', 'password'], ['email'=>$params->email],['limit'=>1]);

			if (isset($user) && !empty($user) && password_verify($params->password, $user[0]['password'])) {
				$token = self::token();
				setcookie(
					'login_token',
					$user[0]['id'].'-'.$token,
					time() + (86400 * 365),
					"/"
				);
				$_SESSION['login_token'] = $user[0]['id'].'-'.$token;
				$DB->update('tbl_users', ['login_token'=>$token, 'ip_address'=>ip_address()], ['id'=>$user[0]['id']]);
				return ok('Systems are go.', [
					'action' => 'redirect',
					'url' => '../'
				]);
			} else {
				return error('Invalid details, try again.');
			}

		} else {
			error('No credentials provided.');
		}
	}

	/**
	 * Register a new profile
	 * @param $params
	 */
	public static function register ( $params )
	{
		global $DB;
		if (!empty($params)
			&& isset($params->username)
			&& isset($params->email)
			&& isset($params->con_email)
			&& isset($params->password)
			&& isset($params->con_password)) {

			if (strlen($params->username) < 4) {
				error('Username should be 4 or more characters in length. Try another.');
			}

			if (strlen($params->password) < 6) {
				error('Password should be 6 or more characters in length. Try another.');
			}

			if ($params->email != $params->con_email) {
				error('Emails do not match, give them a check!');
			}

			if ($params->password != $params->con_password) {
				error('Passwords do not match, give them a check!');
			}

			$username_exists = $DB->count('tbl_users', "username", ['username' => $params->username]);
			if ($username_exists > 0) {
				error('This username is already taken. Try another.');
			}

			$email_exists = $DB->count('tbl_users', "email", ['email' => $params->email]);
			if ($email_exists > 0) {
				error('This email is already in use. Try another.');
			}

			$DB->insert('tbl_users', [
				'username' => $params->username,
				'password' => password_hash($params->password, PASSWORD_DEFAULT),
				'email' => $params->email,
				'date_created' => Medoo::raw('CURRENT_TIMESTAMP')
			]);
			$id = $DB->id();
			ok('Account created.', [
				'action' => 'back_to_login',
				'msg' => 'Account successfuly created, go back and login.'
			]);
		} else {
			error('No registration details provided.');
		}
	}

}

?>