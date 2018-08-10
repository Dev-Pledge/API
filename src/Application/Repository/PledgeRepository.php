<?php

namespace DevPledge\Application\Repository;

/**
 * Class PledgeRepository
 * @package DevPledge\Application\Repository
 */
class PledgeRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'pledges';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'pledge_id';
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