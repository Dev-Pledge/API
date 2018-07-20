<?php

namespace DevPledge\Application\Repository;


class UserProblemRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		'users';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'user_id';
	}

	/**
	 * @return string
	 */
	protected function getAllColumn(): string {
		return 'user_id';
	}

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return null;
	}
}