<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Twig
{
	private $_loader = null;
	private $_twig = null;

	function __construct()
	{
		$this->_loader = new \Twig\Loader\FilesystemLoader(VIWEPATH);
		$this->_twig = new \Twig\Environment($this->_loader);
	}

	function render($tpl, $param, $return = FALSE)
	{
		is_file(VIWEPATH.$tpl) OR exit('模板文件'.$tpl.'不存在');

		$output = $this->_twig->render($tpl, $param);

		if($return) return $output;
		else echo $output;
	}

	function __call($method, $param)
	{
		$return = call_user_func_array(array($this->_twig,$method), $param);
		if ($return) return $return;
	}
}