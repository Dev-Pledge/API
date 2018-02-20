<?php
return [
	'settings' => [
		'displayErrorDetails'    => true, // set to false in production
		'addContentLengthHeader' => false, // Allow the web server to send the content-length header

		// Renderer settings
		'renderer'               => [
			'template_path' => __DIR__ . '/../templates/',
		],

		// Monolog settings
		'logger'                 => [
			'name'  => 'slim-app',
			'path'  => isset( $_ENV['docker'] ) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
			'level' => \Monolog\Logger::DEBUG,
		],

		// MySQL settings
		'database'               => [
			'dsn'  => 'mysql:dbname=' . getenv( 'MYSQL_DB' ) . ';host=' . getenv( 'MYSQL_HOST' ),
			'user' => getenv( 'MYSQL_USER' ),
			'pass' => getenv( 'MYSQL_PASSWORD' ),
		],

		'security' => [
			'jwt' => [
				'algorithm' => 'SHA256',
				'secret'    => getenv( 'JWT_SECRET' ),
				'ttl'       => 3600,
				'ttr'       => 7200,
			],
		],
	],
];
