<?php

/**
 * Class TEMPLATE
 * Simple 'template' viewing class, used for loading in our reusable code.
 */
class TEMPLATE
{
	protected static $_path = '';

	protected static $_global_data = array();
	protected $_file;
	protected $_data = array();

	public function __construct ( $file = null, array $data = null )
	{
		self::set_path(__ROOT__ . '\\templates\\');

		if (!is_null($file)) {
			$this->set_filename($file . ".php");
		}

		if (!is_null($data)) {
			$this->_data = $data + $this->_data;
		}
	}

	public static function set_path ( $path )
	{
		self::$_path = $path;
	}

	public function set_filename ( $file )
	{
		// path + check exists
		$path = self::$_path;
		if (!file_exists($path . $file)) {
			throw new Exception("Unable to find '{$path}{$file}' to load view.");
			return;
		}

		$this->_file = $path . $file;

		return $this;
	}

	public static function factory ( $file = null, array $data = null )
	{
		return new self($file, $data);
	}

	public static function set_global ( $key, $value = null )
	{
		if (is_array($key)) {
			foreach ($key as $foreach_key => $value) {
				self::$_gobal_data[$foreach_key] = $value;
			}
		} else {
			self::$_global_data[$key] = $value;
		}
	}

	public function __get ( $key )
	{
		if (array_key_exists($key, $this->_data)) {
			return $this->_data[$key];
		} else if (array_key_exists($key, self::$_global_data)) {
			return self::$_global_data[$key];
		}
		throw new Exception("View variable is not set '{$key}'.");
	}


	public function __set ( $key, $value )
	{
		$this->set($key, $value);
	}

	public function set ( $key, $value = null )
	{
		if (is_array($key) || $key instanceof ViewData) {
			foreach ($key as $foreach_key => $value) {
				$this->_data[$foreach_key] = $value;
			}
		} else {
			$this->_data[$key] = $value;
		}

		return $this;
	}

	public function __isset ( $key )
	{
		return (isset($this->_data[$key]) || isset(self::$_global_data[$key]));
	}

	public function __unset ( $key )
	{
		unset($this->_data[$key], self::$_global_data[$key]);
	}

	public function __toString ()
	{
		try {
			return $this->render();
		} catch (Exception $e) {
			return '';
		}
	}

	public function render ( $file = null )
	{
		if (!is_null($file)) {
			$this->set_filename($file);
		}
		if (empty($this->_file)) {
			throw new Exception('You need to set the view file before rendering.');
		}

		return self::capture($this->_file, $this->_data);
	}

	protected static function capture ( $_view_filename, array $_view_data )
	{
		extract($_view_data, EXTR_SKIP);

		if (self::$_global_data) {
			extract(self::$_global_data, EXTR_SKIP | EXTR_REFS);
		}

		ob_start();

		try {
			include $_view_filename;
		} catch (Exception $e) {
			ob_end_clean();

			throw $e;
		}

		return ob_get_clean();
	}
}
