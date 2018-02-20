<?php
/**
 * @var \Slim\App $app
 */

use Slim\Http\Request;
use Slim\Http\Response;

$container = $app->getContainer();

$container['notFoundHandler'] = function ( $c ) {
	return function ( Request $request, Response $response ) use ( $c ) {
		$data              = new stdClass();
		$data->error = 'Not Found';
		$data->errorStatus = '404';
		$data->sentRequestBody = $request->getBody();
		$data->sentRequestMethod = $request->getMethod();
		$data->sentAttributes = $request->getAttributes();
		$data->sentParams = $request->getParams();
		return $response->withJson( $data )->withStatus( 404 );
	};
};