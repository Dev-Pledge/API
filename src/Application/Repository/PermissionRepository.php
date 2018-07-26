<?php

namespace DevPledge\Application\Repository;

/**
 * Class PermissionRepository
 * @package DevPledge\Application\Repository
 */
class PermissionRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'permissions';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'permission_id';
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