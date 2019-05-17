<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Loader
{
	private $_loadedHelper = array(); /*已经加载的helper*/

	function __construct()
	{
		
	}

	function view($tpl, $param = array(), $return = false)
	{
		$CCH = & get_instance();
		$output = $CCH->twig->render($tpl, $param, $return);
		if($return) return $output;
	}

	function helper($helpers = array())
	{
		is_array($helpers) OR $helpers = array($helpers);

		foreach ($helpers as $helper)
		{
			$filename = basename($helper);
			$filepath = ($filename === $helper) ? '' : substr($helper, 0, strlen($helper) - strlen($filename));

			if (isset($this->_loadedHelper[$helper]))
			{
				continue;
			}

			foreach (array(SYSPATH, APPPATH) as $path)
			{
				if (file_exists($path.'helpers/'.$helper.'.php'))
				{
					include_once $path.'helpers/'.$helper.'.php';

					$this->_loadedHelper[$helper] = TRUE;
					break;
				}
			}

			// 无法加载该helper
			if ( ! isset($this->_loadedHelper[$helper]))
			{
				exit("无法加载文件".$helper);
			}
		}

		return $this;
	}

	function library($libraries, $param = null)
	{
		if (empty($libraries))
		{
			return $this;
		}

		is_array($libraries) OR $libraries = array($libraries);

		foreach ($libraries as $library)
		{
			$filename = basename($library);
			$filepath = ($filename === $library) ? '' : substr($library, 0, strlen($library) - strlen($filename));
			$objectName = strtolower($library);

			$CCH = & get_instance();

			if (isset($CCH->$objectName))
			{
				exit($library."已经加载，请不要重复加载");
			}

			foreach (array(SYSPATH, APPPATH) as $path)
			{
				if (file_exists($path.'libraries/'.$library.'.php'))
				{
					include_once $path.'libraries/'.$library.'.php';

					$CCH->$objectName = new $library($param);
					break;
				}
			}

			// 无法加载该helper
			if ( ! isset($CCH->$objectName))
			{
				exit("无法加载类".$objectName);
			}
		}

		return $this;
	}
}