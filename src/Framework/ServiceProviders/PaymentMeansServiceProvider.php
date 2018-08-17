<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\PaymentMeansService;
use DevPledge\Framework\FactoryDependencies\PaymentMeansFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\Payment\PaymentRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class PaymentMeansServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class PaymentMeansServiceProvider extends AbstractServiceProvider {
	public function __construct() {
		parent::__construct( PaymentMeansService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentMeansService
	 */
	public function __invoke( Container $container ) {
		return new PaymentMeansService(
			PaymentRepositoryDependency::getRepository(), PaymentMeansFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentMeansService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}