# SlimIntegrations
DevPledge Standard Slim Integrations

Example usage

```
require __DIR__ . '/../dotenv.php';

Integrations::initSentry( getenv( 'SENTRY_DSN' ) );
Integrations::initApplication( require __DIR__ . '/../src/settings.php' );
Integrations::addCommonSettings();
Integrations::addCommonServices();
Integrations::addCommonHandlers();

Integrations::addExtrapolations( [
	new ExtrapolateSettings( __DIR__ . '/../src/Framework/Settings', "DevPledge\\Framework\\Settings" ),
	new ExtrapolateServiceProviders( __DIR__ . '/../src/Framework/ServiceProviders', "DevPledge\\Framework\\ServiceProviders" ),
	new ExtrapolateHandlers( __DIR__ . '/../src/Framework/Handlers', "DevPledge\\Framework\\Handlers" ),
	new ExtrapolateRepositoryDependencies( __DIR__ . '/../src/Framework/RepositoryDependencies', "DevPledge\\Framework\\RepositoryDependencies" ),
	new ExtrapolateControllerDependencies( __DIR__ . '/../src/Framework/ControllerDependencies', "DevPledge\\Framework\\ControllerDependencies" ),
	new ExtrapolateFactoryDependencies( __DIR__ . '/../src/Framework/FactoryDependencies', "DevPledge\\Framework\\FactoryDependencies" ),
	new ExtrapolateRouteGroups( __DIR__ . '/../src/Framework/RouteGroups', "DevPledge\\Framework\\RouteGroups" ),
	new ExtrapolateCommandHandlers( __DIR__ . '/../src/Application/CommandHandlers', "DevPledge\\Application\\CommandHandlers" ),
] );


Integrations::run();
```
