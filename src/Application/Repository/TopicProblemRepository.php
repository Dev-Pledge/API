<?php

namespace DevPledge\Application\Repository;


class TopicProblemRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'topic_problem_maps';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'problem_id';
	}
}