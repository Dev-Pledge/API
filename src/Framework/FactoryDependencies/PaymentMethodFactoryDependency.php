<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\PaymentMethodFactory;
use DevPledge\Domain\PaymentMethod;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class PaymentMethodFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class PaymentMethodFactoryDependency extends AbstractFactoryDependency {
	/**
	 * PaymentMethodFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentMethodFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentMethodFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new PaymentMethodFactory( PaymentMethod::class, 'payment_method', 'payment_method_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentMethodFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}