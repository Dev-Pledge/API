<?php

namespace DevPledge\Application\Repository;

use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Problem;
use DevPledge\Framework\RepositoryDependencies\UserProblemRepoDependency;

/**
 * Class TopicsProblemRepository
 * @package DevPledge\Application\Repository
 */
class TopicsProblemRepository extends AbstractTopicRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'topic_problem_maps';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'problem_id';
	}

	/**
	 * @return string
	 */
	protected function getAllColumn(): string {
		return 'problem_id';
	}

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return null;
	}

	/**
	 * @return string
	 */
	protected function getDomainClass(): string {
		return Problem::class;
	}
}