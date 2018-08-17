<?php

namespace DevPledge\Application\Factory;

/**
 * Class PaymentMeansFactory
 * @package DevPledge\Application\Factory
 */
class PaymentMeansFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|PaymentMeansFactory
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