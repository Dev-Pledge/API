<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\PaymentMethodService;
use DevPledge\Framework\FactoryDependencies\PaymentMethodFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\Payment\PaymentMethodRepoDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class PaymentMethodServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class PaymentMethodServiceProvider extends AbstractServiceProvider {
	public function __construct() {
		parent::__construct( paymentMethodService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentMethodService
	 */
	public function __invoke( Container $container ) {
		return new PaymentMethodService(
			PaymentMethodRepoDependency::getRepository(), PaymentMethodFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentMethodService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}