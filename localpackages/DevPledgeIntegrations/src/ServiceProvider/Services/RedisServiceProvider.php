<?php

namespace DevPledge\Integrations\ServiceProvider\Services;


use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\Setting\Settings\RedisSettings;
use Predis\Client;
use Slim\Container;

/**
 * Class RedisServiceProvider
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class RedisServiceProvider extends AbstractServiceProvider {

	public function __construct() {
		parent::__construct( 'redis' );
	}

	/**
	 * @param Container $container
	 *
	 * @return mixed|Client
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$settings = RedisSettings::getSetting();

		return new Client( [
			'scheme' => $settings->getSchema(),
			'host'   => $settings->getHost(),
			'port'   => $settings->getPort(),
		] );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return Client
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}