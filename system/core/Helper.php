<?php

function get_instance()
{
	return cch::get_instance();
}

function get_http_scheme()
{
	return ((isset($_SERVER['HTTPS']) AND strtolower($_SERVER['HTTPS']) == 'on') OR (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) AND strtolower$_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https')) OR ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) AND strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') ? 'https' : 'http';
}

function get_current_url()
{
	return get_http_scheme().'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}