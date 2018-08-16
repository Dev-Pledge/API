<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\CurrencyValue;
use DevPledge\Domain\Fetcher\FetchCacheUser;

/**
 * Class PledgeFactory
 */
class PledgeFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|PledgeFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'user_id', 'setUser', FetchCacheUser::class )
			->setMethodToProductObject( 'organisation_id', 'setOrganisationId' )
			->setMethodToProductObject( 'problem_id', 'setProblemId' )
			->setMethodToProductObject( 'kudos_points', 'setKudosPoints' )
			->setMethodToProductObject( 'payment_id', 'setPaymentId' )
			->setMethodToProductObject( 'solution_id', 'setSolutionId' )
			->setMethodToProductObject( [ 'currency', 'value' ], 'setCurrencyValue', CurrencyValue::class )
			->setMethodToProductObject( 'comment', 'setComment' );
	}
}