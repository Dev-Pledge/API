<?php

namespace DevPledge\Application\Repository;


use DevPledge\Framework\RepositoryDependencies\Comment\TopicsCommentRepoDependency;

/**
 * Class StatusCommentRepository
 * @package DevPledge\Application\Repository
 */
class StatusCommentRepository extends AbstractRepository {

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
		return TopicsCommentRepoDependency::getRepository();
	}

}