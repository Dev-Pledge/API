<?php

namespace DevPledge\Framework\RepositoryDependencies\Payment;


use DevPledge\Application\Repository\PaymentMethodRepository;
use DevPledge\Framework\FactoryDependencies\PaymentMethodFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class PaymentMethodRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies\Payment
 */
class PaymentMethodRepoDependency extends AbstractRepositoryDependency {
	/**
	 * paymentMethodRepoDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentMethodRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentMethodRepository
	 */
	public function __invoke( Container $container ) {
		return new PaymentMethodRepository( AdapterServiceProvider::getService(), PaymentMethodFactoryDependency::getFactory() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentMethodRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}