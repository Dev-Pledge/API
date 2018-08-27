<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\EntityService;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class EntityServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class EntityServiceProvider extends AbstractServiceProvider {
	/**
	 * EntityServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( EntityService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return EntityService
	 */
	public function __invoke( Container $container ) {
		return new EntityService();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return EntityService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}