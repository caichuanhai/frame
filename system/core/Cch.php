<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

require_once COREPATH.'Common.php';

$router =& loadClass('Router', 'core');

require_once SYSPATH.'core/Controller.php';

$controllerFile = CONPATH.$router->getClassPath().$router->getClass().'.php';
file_exists($controllerFile) OR exit('控制器'.$controllerFile.'不存在');


loadClass('Twig', 'core');

require_once $controllerFile;

$class = $router->getClass();

$method = $router->getMethod();

$CCH = new $class();

call_user_func_array(array(&$CCH, $method), $router->getParamArray());