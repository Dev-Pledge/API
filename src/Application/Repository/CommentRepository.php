<?php

namespace DevPledge\Application\Repository;

/**
 * Class CommentRepository
 * @package DevComment\Application\Repository
 */
class CommentRepository extends AbstractRepository {

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