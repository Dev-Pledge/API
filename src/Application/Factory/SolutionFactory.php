<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\Fetcher\FetchCacheUser;

/**
 * Class SolutionFactory
 * @package DevPledge\Application\Factory
 */
class SolutionFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|SolutionFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'solution_group_id', 'setSolutionGroupId' )
			->setMethodToProductObject( 'problem_solution_group_id', 'setProblemSolutionGroupId' )
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'user_id', 'setUser', FetchCacheUser::class )
			->setMethodToProductObject( 'problemId', 'setProblemId' )
			->setMethodToProductObject( 'open_source_location', 'setOpenSourceLocation' );
	}
}