<?php

namespace DevPledge\Integrations\ServiceProvider\Services;

use DevPledge\Integrations\Event\EventBus;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class EventBusService
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class EventBusServiceProvider extends AbstractServiceProvider {
	/**
	 * EventBusService constructor.
	 */
	public function __construct() {
		parent::__construct( 'eventBusService' );
	}

	/**
	 * @param Container $container
	 *
	 * @return EventBus
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function __invoke( Container $container ) {
		if ( ! static::$app->getContainer()->has( EventBus::class ) ) {
			static::$app->getContainer()[ EventBus::class ] = function () {
				return new EventBus();
			};
		}

		return static::$app->getContainer()->get( EventBus::class );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return EventBus
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}