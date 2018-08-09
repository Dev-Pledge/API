<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\Fetcher\FetchCacheUser;
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
			->setMethodToProductObject( 'topics', 'setTopics', Topics::class );
	}
}