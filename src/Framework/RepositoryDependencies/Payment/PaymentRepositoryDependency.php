<?php

namespace DevPledge\Framework\RepositoryDependencies\Payment;


use DevPledge\Application\Repository\PaymentRepository;
use DevPledge\Framework\FactoryDependencies\PaymentFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class PaymentRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies\Payment
 */
class PaymentRepositoryDependency extends AbstractRepositoryDependency {
	/**
	 * PaymentRepositoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentRepository
	 */
	public function __invoke( Container $container ) {
		return new PaymentRepository( AdapterServiceProvider::getService(), PaymentFactoryDependency::getFactory() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}