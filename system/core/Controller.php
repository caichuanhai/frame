<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class CCH_Controller
{
	private static $instance;

	function __construct()
	{
		self::$instance =& $this;

		foreach (isLoadedClass() as $var => $class)
		{
			$this->$var =& loadClass($class);
		}

		$this->load =& loadClass('Loader', 'core');
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}