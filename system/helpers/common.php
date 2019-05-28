<?php

function get_current_url()
{
	$query = '';
	if(!empty($_SERVER['QUERY_STRING'])) $query = '?'.$_SERVER['QUERY_STRING'];
	$http_scheme = is_https() ? 'https' : 'https';
	return $http_scheme.'://'.$_SERVER['HTTP_HOST'].rtrim(str_replace('/index.php', '', $_SERVER['PHP_SELF']), '/').$query;
}

function request_method()
{
	return strtolower($_SERVER['REQUEST_METHOD']);
}