<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

use caichuanhai\session as cchSession;

class Session
{
	
	private $_cchSession = null; /*caichuanhai\session类实例化对象的引用*/

	function __construct()
	{
		$this->_cchSession = new cchSession();
		$this->setDriver();
	}

	/**
	 * 设置session驱动
	 * @param string $driver 驱动名，可选驱动参见caichuanhai\session类
	 * @param array $config 对应驱动的配置，如果是xcache，apc，cookie，files则不需要该配置
	 */
	function setDriver($driver = '', $config = '')
	{
		$CCH = & get_instance();
		if(empty($driver))
		{
			/*从配置文件中获取session设置*/
			$driver = $CCH->config->item('config.session.driver');
			if(empty($driver)) $driver = 'files';
		}

		if(empty($config) AND !in_array($driver, array('xcache', 'apc', 'cookie', 'files')))
		{
			if($driver == 'redis' OR $driver == 'predis') $config = $CCH->config->item('cache.redis');
			if($driver == 'memcache' OR $driver == 'memcached') $config = $CCH->config->item('cache.memcache');
			else $config = $CCH->config->item('cache.'.$driver);
		}
		$this->_cchSession->setDriver($driver, $config);
	}

	function __call($method, $args)
	{
		return call_user_func_array(array(& $this->_cchSession, $method), $args);
	}
}