<?php

namespace DevPledge\Application\Repository;

/**
 * Class SolutionRepository
 * @package DevPledge\Application\Repository
 */
class SolutionRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'solutions';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'solution_id';
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
}