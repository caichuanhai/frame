<?php

return [
	'redis' => [
		'host' => '127.0.0.1',
		'port' => 6379,
		'password' => '',
		'database' => 1
	],

	'memcache' => [
		'host' => '127.0.0.1',
		'port' => 11211,
		'sasl_user' => false,
		'sasl_password' => false
	],

	'mongodb' => [
		'host' => '127.0.0.1',
		'port' => 27017,
		'username' => '',
		'password' => '',
		'timeout' => 1,
		'collectionName' => 'Cache',
		'databaseName' => 'database'
	]
];