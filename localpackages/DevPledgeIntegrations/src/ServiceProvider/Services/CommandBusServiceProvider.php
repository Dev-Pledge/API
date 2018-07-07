<?php

namespace DevPledge\Integrations\ServiceProvider\Services;


use DevPledge\Integrations\Command\CommandBus;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class CommandBusService
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class CommandBusServiceProvider extends AbstractServiceProvider {
	/**
	 * CommandBusService constructor.
	 */
	public function __construct() {
		parent::__construct( 'commandBusService' );
	}

	/**
	 * @param Container $container
	 *
	 * @return CommandBus
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function __invoke( Container $container ) {

		if ( ! static::$app->getContainer()->has( CommandBus::class ) ) {
			static::$app->getContainer()[ CommandBus::class ] = function () {
				return new CommandBus();
			};
		}

		return static::$app->getContainer()->get( CommandBus::class );

	}

	/**
	 * usually return static::getFromContainer();
	 * @return CommandBus
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}
