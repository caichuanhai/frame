<?php

/**
 * 
 */
class Router
{
	private $classPath; /*控制器类所在controller目录下的子路径*/

	private $className; /*控制器类名*/

	private $methodName = 'index'; /*要运行的方法名*/

	private $paramArray = array(); /*传给方法的参数数组*/

	function __construct()
	{
		$this->_analyseUrl();
	}

	private function _analyseUrl()
	{
		$arrayUrl = explode('/', trim($_SERVER['PATH_INFO'], '/'));
		
		while(isset($arrayUrl[0]) AND is_dir(CONPATH.$this->classPath.$arrayUrl[0]))
		{
			$this->classPath .= array_shift($arrayUrl).'/';
		}

		$this->className = array_shift($arrayUrl);

		if(isset($arrayUrl[0])) $this->methodName = array_shift($arrayUrl);

		$this->paramArray = $arrayUrl;
	}

	function getClass()
	{
		return $this->className;
	}

	function getMethod()
	{
		return $this->methodName;
	}

	function getClassPath()
	{
		return $this->classPath;
	}

	function getParamArray()
	{
		return $this->paramArray;
	}
}