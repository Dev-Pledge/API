<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\Fetcher\FetchCacheUser;
use DevPledge\Domain\Fetcher\FetchProblemPledgesCount;
use DevPledge\Domain\Fetcher\FetchProblemPledgesLastest;
use DevPledge\Domain\Fetcher\FetchProblemPledgeValue;
use DevPledge\Domain\Fetcher\FetchProblemSolutions;
use DevPledge\Domain\Topics;

class ProblemFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|ProblemFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'user_id', 'setUser', FetchCacheUser::class )
			->setMethodToProductObject( 'organisation_id', 'setOrganisationId' )
			->setMethodToProductObject( 'title', 'setTitle' )
			->setMethodToProductObject( 'active_datetime', 'setActiveDatetime', \DateTime::class )
			->setMethodToProductObject( 'deadline_datetime', 'setDeadlineDatetime', \DateTime::class )
			->setMethodToProductObject( 'deleted', 'setDeleted' )
			->setMethodToProductObject( 'specification', 'setSpecification' )
			->setMethodToProductObject( 'description', 'setDescription' )
			->setMethodToProductObject( 'topics', 'setTopics', Topics::class )
			->setMethodToProductObject( 'problem_id', 'setSolutions', FetchProblemSolutions::class )
			->setMethodToProductObject( 'problem_id', 'setPledgesCount', FetchProblemPledgesCount::class )
			->setMethodToProductObject( 'problem_id', 'setPledgesValue', FetchProblemPledgeValue::class )
			->setMethodToProductObject( 'problem_id', 'setLatestPledges', FetchProblemPledgesLastest::class );
	}
}