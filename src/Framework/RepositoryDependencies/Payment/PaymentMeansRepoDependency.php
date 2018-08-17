<?php

namespace DevPledge\Framework\RepositoryDependencies\Payment;


use DevPledge\Application\Repository\PaymentMeansRepository;
use DevPledge\Framework\FactoryDependencies\PaymentMeansFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class PaymentMeansRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies\Payment
 */
class PaymentMeansRepoDependency extends AbstractRepositoryDependency {
	/**
	 * PaymentMeansRepoDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentMeansRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentMeansRepository
	 */
	public function __invoke( Container $container ) {
		return new PaymentMeansRepository( AdapterServiceProvider::getService(), PaymentMeansFactoryDependency::getFactory() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentMeansRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}