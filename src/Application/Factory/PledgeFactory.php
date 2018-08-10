<?php

namespace DevPledge\Application\Factory;

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
			->setMethodToProductObject( 'value', 'setValue' )
			->setMethodToProductObject( 'currency', 'setCurrency' )
			->setMethodToProductObject( 'comment', 'setComment' );
	}
}