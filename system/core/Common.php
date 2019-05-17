<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 加载system目录中的框架文件
 * @param  string $className 要加载的类名，与文件名一致
 * @param  string $folder    system或application下的子目录
 * @return obj            被加载的类的实例化对象的引用
 */
function &loadClass($className, $folder = 'core')
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

	$loadedClass[$className] = new $className();
	isLoadedClass($className);

	return $loadedClass[$className];
}

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

function &get_instance()
{
	return CCH_Controller::get_instance();
}