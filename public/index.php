<?php

use DevPledge\Integrations\Command\ExtrapolateCommandHandlers;
use DevPledge\Integrations\ControllerDependency\ExtrapolateControllerDependencies;
use DevPledge\Integrations\FactoryDependency\ExtrapolateFactoryDependencies;
use DevPledge\Integrations\Handler\ExtrapolateHandlers;
use DevPledge\Integrations\Integrations;
use DevPledge\Integrations\RepositoryDependency\ExtrapolateRepositoryDependencies;
use DevPledge\Integrations\Route\ExtrapolateRouteGroups;
use DevPledge\Integrations\ServiceProvider\ExtrapolateServices;
use DevPledge\Integrations\Setting\ExtrapolateSettings;


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


Integrations::initSentry( getenv( 'SENTRY_DSN' ) );
Integrations::initApplication( require __DIR__ . '/../src/settings.php' );
Integrations::addCommonSettings();
Integrations::addCommonServices();
Integrations::addCommonHandlers();

Integrations::addExtrapolations( [
	new ExtrapolateSettings( __DIR__ . '/../src/Framework/Settings', "DevPledge\\Framework\\Settings" ),
	new ExtrapolateServices( __DIR__ . '/../src/Framework/Services', "DevPledge\\Framework\\Services" ),
	new ExtrapolateServices( __DIR__ . '/../src/Application/Services', "DevPledge\\Application\\Services" ),
	new ExtrapolateHandlers( __DIR__ . '/../src/Framework/Handlers', "DevPledge\\Framework\\Handlers" ),
	new ExtrapolateRepositoryDependencies( __DIR__ . '/../src/Framework/RepositoryDependencies', "DevPledge\\Framework\\RepositoryDependencies" ),
	new ExtrapolateControllerDependencies( __DIR__ . '/../src/Framework/ControllerDependencies', "DevPledge\\Framework\\ControllerDependencies" ),
	new ExtrapolateFactoryDependencies( __DIR__ . '/../src/Framework/FactoryDependencies', "DevPledge\\Framework\\FactoryDependencies" ),
	new ExtrapolateRouteGroups( __DIR__ . '/../src/Framework/RouteGroups', "DevPledge\\Framework\\RouteGroups" ),
	new ExtrapolateCommandHandlers( __DIR__ . '/../src/Application/CommandHandlers', "DevPledge\\Application\\CommandHandlers" )
] );


Integrations::run();


