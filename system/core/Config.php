<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Config
{
	private $_loadedConfig = array(); /*已经加载的config*/

	function __construct()
	{
		/*默认自动加载config.php配置*/
		$this->load('config');
	}

	/**
	 * 加载配置，可以是单个配置也可以是多个配置数组
	 * @param  string||Array $config
	 */
	function load($config)
	{
		if(!is_array($config)) $config = array($config);

		foreach($config as $v)
		{
			$this->_loadedConfig[$v] = getConfig($v);
		}
	}

	/**
	 * 获取配置
	 * @param  string  $item    要获取的配置项，例：config.key1.key2，表示为获取config.php配置里的key1数组下的key2的值，只有一个时会默认config配置下的值
	 * @param  mixed $default 当配置不存在时返回的默认值
	 * @return 配置值
	 */
	function item($item, $default = null)
	{
		$item = explode('.', $item);
		if(count($item) == 1) array_unshift($item, 'config');

		$result = $this->_loadedConfig;
		foreach($item as $v)
		{
			if(isset($result[$v])) $result = $result[$v];
			else return $default;
		}

		return $result;
	}

	/**
	 * 设置配置
	 * @param string $item  要设置的配置项，不存在时会自动加上，例：config.key1.key2，表示为设置config.php配置里的key1数组下的key2的值，只有一个时会默认config配置下的值
	 * @param mixed $value 要设置的值
	 */
	function setItem($item, $value)
	{
		$item = explode('.', $item);
		if(count($item) == 0) array_unshift($item, 'config');

		$this->_setItemRecursion($this->_loadedConfig, $item, $value);
	}

	/**
	 * 以递归形式来设置配置项，因为涉及到层级问题
	 * @param Array $config 对当前涉及到的层级配置的引用
	 * @param Array $item   配置key的数组
	 * @param mixed $value  要设置的值
	 */
	private function _setItemRecursion(& $config, $item, $value)
	{
		$key = array_shift($item);

		if(empty($item))
		{
			$config[$key] = $value;
		}
		else
		{
			if(!isset($config[$key])) $config[$key] = array();
			$this->_setItemRecursion($config[$key], $item, $value);
		}
	}
}