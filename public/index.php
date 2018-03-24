<?php

use DevPledge\Container\ContainerBase;

if ( PHP_SAPI == 'cli-server' ) {
	// To help the built-in PHP dev server, check if the request was actually for
	// something which should probably be served as a static file
	$url  = parse_url( $_SERVER['REQUEST_URI'] );
	$file = __DIR__ . $url['path'];
	if ( is_file( $file ) ) {
		return false;
	}
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

require __DIR__ . '/../dotenv.php';

/**
 * SENTRY SET UP
 */
$client        = new Raven_Client( getenv( 'SENTRY_DSN' ) );
$error_handler = new Raven_ErrorHandler( $client );
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();

/**
 * Instantiate the app
 */
$settings = require __DIR__ . '/../src/settings.php';
$app         = new \Slim\App( $settings );

ContainerBase::setApp( $app );

require __DIR__ . '/../src/errors.php';

/**
 * Set up dependencies
 */
require __DIR__ . '/../src/dependencies.php';

/**
 * Register middleware
 */
require __DIR__ . '/../src/middleware.php';

/**
 * Register routes
 */
require __DIR__ . '/../src/routes.php';

/**
 * Run app
 */
$app->run();



