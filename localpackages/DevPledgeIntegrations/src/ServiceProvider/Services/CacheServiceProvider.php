<?php

namespace DevPledge\Integrations\ServiceProvider\Services;


use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\Setting\Settings\RedisSettings;
use Predis\Client;
use Slim\Container;

/**
 * Class CacheServiceProvider
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class CacheServiceProvider extends AbstractServiceProvider {

	public function __construct() {
		parent::__construct( 'cache' );
	}

	/**
	 * @param Container $container
	 *
	 * @return Cache
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$settings = RedisSettings::getSetting();

		return new Cache( new Client( [
			'scheme' => $settings->getSchema(),
			'host'   => $settings->getHost(),
			'port'   => $settings->getPort(),
		] ), JSONServiceProvider::getService() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return Client
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}