<?php

define('SITEPATH', __DIR__.'/');
define('SYSPATH', realpath('system').'/');
define('APPPATH', realpath('application').'/');
define('CONFPATH', APPPATH.'config/');
define('CONPATH', APPPATH.'controller/');
define('VIWEPATH', APPPATH.'views/');
define('COREPATH', SYSPATH.'core/');


require COREPATH.'Cch.php';