<?php

namespace DevPledge\Application\Repository;

/**
 * Class TopicsCommentRepository
 * @package DevPledge\Application\Repository
 */
class TopicsCommentRepository extends AbstractTopicRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'topic_comment_maps';
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
		return 'comment_id';
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
		return Comment::class;
	}
}