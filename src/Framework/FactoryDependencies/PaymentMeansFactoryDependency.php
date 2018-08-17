<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\PaymentMeansFactory;
use DevPledge\Domain\PaymentMeans;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class PaymentMeansFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class PaymentMeansFactoryDependency extends AbstractFactoryDependency {
	/**
	 * PaymentMeansFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentMeansFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentMeansFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new PaymentMeansFactory( PaymentMeans::class, 'payment_means', 'payment_means_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentMeansFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}