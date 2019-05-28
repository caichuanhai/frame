<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 加载system目录中的框架文件
 * @param  string $className 要加载的类名，与文件名一致
 * @param  string $folder    system或application下的子目录
 * @param  boolean $init    加载时是否同时实例化
 * @return obj            被加载的类的实例化对象的引用
 */
function &loadClass($className, $folder = 'core', $init = true)
{
	static $loadedClass = array();
	if(isset($loadedClass[$className])) return $loadedClass[$className];

	$classFile = false; 

	foreach(array(APPPATH, SYSPATH) as $path)
	{
		if (file_exists($path.$folder.'/'.$className.'.php'))
		{
			$classFile = $path.$folder.'/'.$className.'.php';
			if (class_exists($className, FALSE) === FALSE)
			{
				require_once($classFile);
			}

			break;
		}
	}

	$classFile OR exit('文件'.$classFile.'不存在');

	/*检查该类是否可以被实例化，可以则实例化对象保存，不可以则只保存类名*/
	$reflectionClass = new ReflectionClass($className);
	$loadedClass[$className] = ($init AND $reflectionClass->IsInstantiable()) ? new $className() : true;
	isLoadedClass($className);

	return $loadedClass[$className];
}

/**
 * 记录已经加载的类
 * @param  string  $class 核心类名
 * @return Array        已经加载的类名数组
 */
function &isLoadedClass($class = '')
{
	static $isLoaded = array();

	if ($class !== '')
	{
		$isLoaded[strtolower($class)] = $class;
	}

	return $isLoaded;
}

/**
 * 加载config文件夹中的配置文件
 * @param  string      $config  要加载的配置文件名
 * @param  Array $replace 后期动态添加或修改的配置项
 * @return Array               配置数组
 */
function getConfig($config = 'config', Array $replace = array())
{
	$filePath = CONFPATH.$config.'.php';

	file_exists($filePath) OR exit('配置文件'.$config.'不存在');

	$confData = require $filePath;

	/*动态修改或添加配置*/
	foreach ($replace as $key => $val)
	{
		$confData[$key] = $val;
	}

	return $confData;
}

/**
 * 解析根目录下.ini文件的配置
 * @param  string $key 查找的配置名
 * @param  string $default 找不到或找到值为空时设置的默认值
 * @return string      该配置的值
 */
function ini($key, $default = '')
{
	$configFile = SITEPATH.'.ini';
	if(!is_file($configFile)) return $default;

	static $iniConfig = array();
	if(empty($iniConfig)) $iniConfig = parse_ini_file($configFile, true);

	if(!isset($iniConfig[$key]) OR empty($iniConfig[$key])) return $default;
	else return $iniConfig[$key];
}

function &get_instance()
{
	return CCH_Controller::get_instance();
}

/**
 * 查找php版本比要求的大不大
 * @param	string
 * @return	bool	如果大于等于该版本返回true
 */
function is_php($version)
{
	static $isPhp;
	$version = (string) $version;

	if ( ! isset($isPhp[$version]))
	{
		$isPhp[$version] = version_compare(PHP_VERSION, $version, '>=');
	}

	return $isPhp[$version];
}

/**
 * 是否HTTPS
 * @return	bool
 */
function is_https()
{
	if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
	{
		return TRUE;
	}
	elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
	{
		return TRUE;
	}
	elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
	{
		return TRUE;
	}
	return FALSE;
}