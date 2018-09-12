<?php

namespace DevPledge\Application\Repository;


use DevPledge\Framework\RepositoryDependencies\Comment\TopicsCommentRepoDependency;

class StatusCommentRepository extends CommentRepository {

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return TopicsCommentRepoDependency::getRepository();
	}

}