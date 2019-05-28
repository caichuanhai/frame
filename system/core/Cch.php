<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * composer第三方类库加载
 */
require_once SITEPATH.'vendor/autoload.php';

/**
 * 加载核心的公共函数
 */
require_once COREPATH.'Common.php';

/**
 * 加载基类
 */
loadClass('CCH_Controller', 'core', false);

/**
 * 运行路由
 */
if(is_file(CONFPATH.'routes.php')) include_once CONFPATH.'routes.php';
caichuanhai\Router::run(CONPATH);