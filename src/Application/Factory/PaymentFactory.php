<?php


namespace DevPledge\Application\Factory;


use DevPledge\Domain\CurrencyValue;

/**
 * Class PaymentFactory
 * @package DevPledge\Application\Factory
 */
class PaymentFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|PaymentFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'reference', 'setReference' )
			->setMethodToProductObject( 'gateway', 'setGateway' )
			->setMethodToProductObject( 'refunded', 'setRefunded' )
			->setMethodToProductObject( [ 'currency', 'value' ], 'setCurrencyValue', CurrencyValue::class );
	}
}