<?php

namespace DevPledge\Application\Repository;

/**
 * Class SubCommentRepository
 * @package DevComment\Application\Repository
 */
class SubCommentRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'comments';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'comment_id';
	}

	/**
	 * @return string
	 */
	protected function getAllColumn(): string {
		return 'entity_id';
	}

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return null;
	}
	


}