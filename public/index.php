<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

date_default_timezone_set("PRC");

define('SITEPATH', __DIR__.'/../');

define('SYSPATH', SITEPATH.'system/');

define('APPPATH', SITEPATH.'application/');

define('CONFPATH', APPPATH.'config/');

define('CONPATH', APPPATH.'controller/');

define('VIWEPATH', APPPATH.'views/');

define('COREPATH', SYSPATH.'core/');


require COREPATH.'Cch.php';