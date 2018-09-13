<?php

namespace DevPledge\Application\Repository;


use DevPledge\Domain\AbstractDomain;

/**
 * Class AbstractTopicRepository
 * @package DevPledge\Application\Repository
 */
abstract class AbstractTopicRepository extends AbstractRepository {
	/**
	 * @param AbstractDomain $domain
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function createPersist( AbstractDomain $domain ): AbstractDomain {
		if ( is_a( $domain, $this->getDomainClass() ) ) {
			if ( $topicsArray = $domain->getTopics()->toArray() ) {
				foreach ( $topicsArray as $topic ) {
					$this->adapter->create( $this->getResource(), (object) [
						'topic'            => $topic,
						$this->getColumn() => $domain->getId(),
						'created'          => $domain->getCreated()->format( 'Y-m-d H:i:s' )
					] );
				}
			}
		} else {
			throw new \Exception( $this->getDomainClass() . ' object expected!' );
		}

		return $domain;
	}

	/**
	 * @param AbstractDomain $domain
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function update( AbstractDomain $domain ): AbstractDomain {
		if ( is_a( $domain, $this->getDomainClass() ) ) {
			$this->adapter->delete( $this->getResource(), $domain->getId(), $this->getAllColumn() );
			if ( $topicsArray = $domain->getTopics()->toArray() ) {
				foreach ( $topicsArray as $topic ) {
					$this->adapter->create( $this->getResource(), (object) [
						'topic'            => $topic,
						$this->getColumn() => $domain->getId(),
						'created'          => $domain->getCreated()->format( 'Y-m-d H:i:s' )
					] );
				}
			}
		} else {

			throw new \Exception( $this->getDomainClass() . ' object expected!' );
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
			if ( is_null( $data ) ) {
				$data = new \stdClass();
			}
			$data->topics = [];
			foreach ( $topicData as $topic ) {
				$data->topics[] = $topic->topic;
			}
		}

		return $this->factory->createFromPersistedData( $data );
	}

	/**
	 * @param string $idForAll
	 * @param null|string $orderByColumn
	 * @param bool $reverseOrderBy
	 * @param int|null $limit
	 * @param int|null $offset
	 * @param array|null $dataArray
	 *
	 * @return array|null
	 */
	public function readAll( string $idForAll, ?string $orderByColumn = null, bool $reverseOrderBy = false, ?int $limit = null, ?int $offset = null, array $dataArray = null ): ?array {

		$dataArray = isset( $dataArray ) ? $dataArray : parent::readAll( $idForAll, $orderByColumn, $reverseOrderBy, $limit, $offset, $dataArray );
		if ( $dataArray ) {
			$col = $this->getColumn();
			foreach ( $dataArray as &$data ) {

				if ( isset( $data->{$col} ) ) {
					$data = $this->read( $data->{$col}, $data );
				}
			}
		}

		return $dataArray;
	}

	/**
	 * @return string
	 */
	abstract protected function getDomainClass(): string;


}