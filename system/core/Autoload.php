<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Autoload
{
	
	private function __construct(){}

	private function __clone(){}

	static function run()
	{
		$autoload = getConfig('autoload');

		$CCH = & get_instance();

		if(isset($autoload['config'])) $CCH->config->load($autoload['config']);
		
		if(isset($autoload['helper'])) $CCH->load->helper($autoload['helper']);

		if(isset($autoload['library'])) $CCH->load->library($autoload['library']);
	}
}