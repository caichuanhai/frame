<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class CCH_Controller
{
	private static $instance = null;

	function __construct()
	{
		self::$instance =& $this;
	
		$this->load =& loadClass('Loader', 'core');

		$this->config =& loadClass('Config', 'core');

		$this->load->helper(array('common', 'password'));

		loadClass('Twig', 'core');

		loadClass('Autoload', 'core');
		Autoload::run();
		
		foreach (isLoadedClass() as $var => $class)
		{
			$this->$var =& loadClass($class);
		}
	}

	public static function &get_instance()
	{
		return self::$instance;
	}

	function __call($method, $arg)
	{
		caichuanhai\Router::redirect404();
	}
}