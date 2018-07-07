<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/dotenv.php';

$http = new swoole_http_server( getenv( 'API_DOMAIN' ), getenv( 'SWOOLE_PORT' ) );
$http->on( 'request', function ( $request, $response ) {
	$response->end( "<h1>AUTH Hello Devpledge Swoole Test. #" . rand( 1000, 9999 ) . "</h1>" );
} );
$http->start();