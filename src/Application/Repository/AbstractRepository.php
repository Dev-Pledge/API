<?php

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Framework\Adapter\Adapter;
use DevPledge\Framework\Adapter\Wheres;

/**
 * Class AbstractRepository
 * @package DevPledge\Application\Repository
 */
abstract class AbstractRepository {
	/**
	 * @var Adapter
	 */
	protected $adapter;

	/**
	 * @var AbstractFactory
	 */
	protected $factory;


	/**
	 * AbstractRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param AbstractFactory $factory
	 */
	public function __construct( Adapter $adapter, AbstractFactory $factory ) {
		$this->adapter = $adapter;
		$this->factory = $factory;
	}

	/**
	 * @param AbstractDomain $domain
	 * @param $resource
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function createPersist( PersistMappable $domain ): AbstractDomain {
		$this->adapter->create( $this->getResource(), $domain->toPersistMap() );

		if ( $this->getMapRepository() !== null ) {
			$this->getMapRepository()->createPersist( $domain );
		}

		return $this->read( $domain->getId() );
	}

	/**
	 * @param AbstractDomain $domain
	 * @param $resource
	 * @param $column
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function update( PersistMappable $domain ): AbstractDomain {
		$domain->setModified( new \DateTime() );
		$this->adapter->update( $this->getResource(), $domain->getId(), $domain->toPersistMap(), $this->getColumn() );
		if ( $this->getMapRepository() !== null ) {
			$this->getMapRepository()->update( $domain );
		}

		return $this->read( $domain->getId(), $this->getResource(), $this->getColumn() );
	}

	/**
	 * @param string $id
	 * @param \stdClass|null $data
	 *
	 * @return AbstractDomain
	 */
	public function read( string $id, \stdClass $data = null ): AbstractDomain {

		$data = isset( $data ) ? $data : $this->adapter->read( $this->getResource(), $id, $this->getColumn() );
		if ( $this->getMapRepository() !== null ) {
			return $this->getMapRepository()->read( $id, $data );
		}

		return $this->factory->createFromPersistedData( $data );
	}

	/**
	 * @param string $idForAll
	 * @param int|null $limit
	 * @param int|null $offset
	 *
	 * @return array|null
	 */
	public function readAll( string $idForAll, ?int $limit = null, ?int $offset = null ): ?array {
		$dataArray = $this->adapter->readAll( $this->getResource(), $idForAll, $this->getAllColumn(), $limit, $offset );
		if ( is_array( $dataArray ) ) {
			foreach ( $dataArray as &$data ) {
				$data = $this->factory->createFromPersistedData( $data );
			}
		}

		return $dataArray;
	}

	/**
	 * @param Wheres $wheres
	 * @param int|null $limit
	 * @param int|null $offset
	 *
	 * @return array|null
	 */
	public function readAllWhere( Wheres $wheres, ?int $limit = null, ?int $offset = null ): ?array {
		$dataArray = $this->adapter->readAllWhere( $this->getResource(), $wheres, $limit, $offset, $offset );
		if ( is_array( $dataArray ) ) {
			foreach ( $dataArray as &$data ) {
				$data = $this->factory->createFromPersistedData( $data );
			}
		}

		return $dataArray;
	}

	/**
	 * @return string
	 */
	abstract protected function getResource(): string;

	/**
	 * @return string
	 */
	abstract protected function getColumn(): string;

	/**
	 * @return string
	 */
	abstract protected function getAllColumn(): string;

	/**
	 * @return AbstractRepository|null
	 */
	abstract protected function getMapRepository(): ?AbstractRepository;

}