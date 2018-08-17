<?php

namespace DevPledge\Application\Repository;

use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Problem;
use DevPledge\Framework\RepositoryDependencies\UserProblemRepoDependency;

/**
 * Class TopicsProblemRepository
 * @package DevPledge\Application\Repository
 */
class TopicsProblemRepository extends AbstractRepository {
	/**
	 * @param AbstractDomain $domain
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function createPersist( AbstractDomain $domain ): AbstractDomain {
		if ( $domain instanceof Problem ) {
			if ( $topicsArray = $domain->getTopics()->toArray() ) {
				foreach ( $topicsArray as $topic ) {
					$this->adapter->create( $this->getResource(), (object) [
						'topic'      => $topic,
						'problem_id' => $domain->getId(),
						'created'    => $domain->getCreated()->format( 'Y-m-d H:i:s' )
					] );
				}
			}
		} else {
			throw new \Exception( 'Problem object expected!' );
		}

		return $domain;
	}

	/**
	 * @param PersistMappable $domain
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function update( AbstractDomain $domain ): AbstractDomain {
		if ( $domain instanceof Problem ) {
			$this->adapter->delete( $this->getResource(), $domain->getId(), $this->getAllColumn() );
			if ( $topicsArray = $domain->getTopics()->toArray() ) {
				foreach ( $topicsArray as $topic ) {
					$this->adapter->create( $this->getResource(), (object) [
						'topic'      => $topic,
						'problem_id' => $domain->getId(),
						'created'    => $domain->getCreated()->format( 'Y-m-d H:i:s' )
					] );
				}
			}
		} else {
			throw new \Exception( 'Problem object expected!' );
		}

		return $domain;
	}

	/**
	 * @param string $id
	 * @param \stdClass|null $data
	 *
	 * @return AbstractDomain
	 */
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
	 * @param string $id
	 * @param int|null $limit
	 * @param int|null $offset
	 * @param array|null $dataArray
	 *
	 * @return array|null
	 */
	public function readAll( string $idForAll, ?string $orderByColumn = null, bool $reverseOrderBy = false, ?int $limit = null, ?int $offset = null, array $dataArray = null ): ?array {

		$dataArray = isset( $dataArray ) ? $dataArray : parent::readAll( $idForAll, $orderByColumn, $reverseOrderBy, $limit, $offset, $dataArray );
		if ( $dataArray ) {
			foreach ( $dataArray as &$problemData ) {
				if ( isset( $problemData->problem_id ) ) {
					$problemData = $this->read( $problemData->problem_id, $problemData );
				}
			}
		}

		return $dataArray;
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