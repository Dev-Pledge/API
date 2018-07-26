<?php

namespace DevPledge\Application\Repository;

use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Framework\Adapter\Adapter;
use DevPledge\Framework\RepositoryDependencies\Problem\TopicsProblemRepoDependency;

/**
 * Class ProblemRepository
 * @package DevPledge\Application\Repository
 */
class ProblemRepository extends AbstractRepository {
	/**
	 * ProblemRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param ProblemFactory $factory
	 */
	public function __construct( Adapter $adapter, ProblemFactory $factory ) {
		parent::__construct( $adapter, $factory );
	}


	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'problems';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'problem_id';
	}

	protected function getAllColumn(): string {
		return 'user_id';
	}

	/**
	 * @return TopicsProblemRepository
	 */
	protected function getMapRepository(): ?AbstractRepository {

		return TopicsProblemRepoDependency::getRepository();
	}
}