<?php
require __DIR__ . '/../../vendor/autoload.php';

$message = $argv[1];

$cli = new \swoole_http_client( 'feed', 9501 );

$cli->setHeaders( [ 'origin' => 'api' ] );

$cli->on( 'message', function ( swoole_http_client $client, swoole_websocket_frame $frame ) {

} );


$cli->upgrade( '/', function ( swoole_http_client $client ) use ( $message ) {

	$client->push( $message );
	sleep( 10 );
	$client->close();

} );

