<?php

namespace DevPledge\Application\Repository;

use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Topics;

/**
 * Class TopicsProblemRepository
 * @package DevPledge\Application\Repository
 */
class TopicsProblemRepository extends AbstractRepository {
	/**
	 * @param Problem $problem
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function createPersist( Problem $problem ): AbstractDomain {

		if ( $topicsArray = $problem->getTopics()->toArray() ) {
			foreach ( $topicsArray as $topic ) {
				$this->adapter->create( $this->getResource(), (object) [
					'topic'      => $topic,
					'problem_id' => $problem->getId(),
					'created'    => $problem->getCreated()->format( 'Y-m-d H:i:s' )
				] );
			}
		}

		return $problem;
	}

	public function update( Problem $problem ): AbstractDomain {
		if ( $topicsArray = $problem->getTopics()->toArray() ) {
			foreach ( $topicsArray as $topic ) {
				$this->adapter->create( $this->getResource(), (object) [
					'topic'      => $topic,
					'problem_id' => $problem->getId(),
					'created'    => $problem->getCreated()->format( 'Y-m-d H:i:s' )
				] );
			}
		}

		return $problem;
	}

	public function read( string $id, \stdClass $data = null ): AbstractDomain {
		$topicData = $this->adapter->readAll( $this->getResource(), $id, $this->getAllColumn() );

		if ( $topicData ) {
			$data->topics = [];
			foreach ( $topicData as $topic ) {
				$data->topics[] = $topic->topic;
			}
		}

		return $this->factory->createFromPersistedData( $data );
	}

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