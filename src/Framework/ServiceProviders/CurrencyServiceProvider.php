<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\CurrencyService;
use DevPledge\Framework\Settings\FixerIOSettings;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use FixerExchangeRates\AccessKey;
use FixerExchangeRates\Cache;
use Slim\Container;

/**
 * Class CurrencyServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class CurrencyServiceProvider extends AbstractServiceProvider {
	/**
	 * CurrencyServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( CurrencyService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return CurrencyService
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$settings   = FixerIOSettings::getSetting();

		$fixerCache = new Cache();
		$fixerCache->setCachePath( $settings->getCacheDir() );
		AccessKey::setAccessKey( $settings->getApiAccessKey() );

		return new CurrencyService();

	}

	/**
	 * usually return static::getFromContainer();
	 * @return CurrencyService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}