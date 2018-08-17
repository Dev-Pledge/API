<?php

namespace DevPledge\Application\Factory;

/**
 * Class PaymentMethodFactory
 * @package DevPledge\Application\Factory
 */
class PaymentMethodFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|PaymentMethodFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {

		return $this
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'organisation_id', 'setOrganisationId' )
			->setMethodToProductObject( 'gateway', 'setGateway' )
			->setMethodToProductObject( 'name', 'setName' );
	}
}