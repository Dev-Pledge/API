<?php
require __DIR__ . '/vendor/autoload.php';

$message = $argv[1];

$cli = new \swoole_http_client( 'feed', 9501 );

$cli->upgrade( '/', function ( $cli ) use ( $message ) {
	echo $cli->body;
	$cli->push( $message);
	$cli->close();
} );



