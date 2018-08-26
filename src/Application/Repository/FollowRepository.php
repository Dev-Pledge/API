<?php

namespace DevPledge\Application\Repository;

use DevPledge\Uuid\DualUuid;

/**
 * Class FollowRepository
 * @package DevPledge\Application\Repository
 */
class FollowRepository extends AbstractRepository {


	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'user_follow_maps';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'user_id'.DualUuid::DUAL_UUID_STRING_SEPARATOR.'entity_id';
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