<?php


namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\PaymentFactory;
use DevPledge\Domain\Payment;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class PaymentFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class PaymentFactoryDependency extends AbstractFactoryDependency {
	/**
	 * PaymentFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new PaymentFactory( Payment::class, 'payment', 'payment_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}