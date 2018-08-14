<?php

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Framework\Adapter\Adapter;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;
use DevPledge\Framework\ServiceProviders\CurrencyServiceProvider;

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
	public function createPersist( AbstractDomain $domain ): AbstractDomain {
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
	public function update( AbstractDomain $domain ): AbstractDomain {
		$domain->setModified( new \DateTime() );
		$this->adapter->update( $this->getResource(), $domain->getId(), $domain->toPersistMap(), $this->getColumn() );
		if ( $this->getMapRepository() !== null ) {
			$this->getMapRepository()->update( $domain );
		}

		return $this->read( $domain->getId() );
	}

	/**
	 * @param string $id
	 *
	 * @return int|null
	 */
	public function delete( string $id ): ?int {
		return $this->adapter->delete( $this->getResource(), $id, $this->getColumn() );
	}

	/**
	 * @param Wheres $wheres
	 *
	 * @return int|null
	 */
	public function deleteWhere( Wheres $wheres ): ?int {
		return $this->adapter->deleteWhere( $this->getResource(), $wheres );
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
	 * @param null|string $orderByColumn
	 * @param bool $reverseOrderBy
	 * @param int|null $limit
	 * @param int|null $offset
	 * @param array|null $dataArray
	 *
	 * @return array|null
	 */
	public function readAll( string $idForAll, ?string $orderByColumn = null, bool $reverseOrderBy = false, ?int $limit = null, ?int $offset = null, array $dataArray = null ): ?array {
		$dataArray = isset( $dataArray ) ? $dataArray : $this->adapter->readAll( $this->getResource(), $idForAll, $this->getAllColumn(), $orderByColumn, $reverseOrderBy, $limit, $offset );
		if ( $this->getMapRepository() !== null && is_array( $dataArray ) ) {
			return $this->getMapRepository()->readAll( $idForAll, $orderByColumn, $reverseOrderBy, $limit, $offset, $dataArray );
		}


		if ( is_array( $dataArray ) ) {
			foreach ( $dataArray as &$data ) {
				$data = $this->factory->createFromPersistedData( $data );
			}
		}

		return $dataArray;
	}

	/**
	 * @param Wheres $wheres
	 * @param null|string $orderByColumn
	 * @param bool $reverseOrderBy
	 * @param int|null $limit
	 * @param int|null $offset
	 * @param array|null $dataArray
	 *
	 * @return array|null
	 */
	public function readAllWhere( Wheres $wheres, ?string $orderByColumn = null, bool $reverseOrderBy = false, ?int $limit = null, ?int $offset = null, array $dataArray = null ): ?array {
		$dataArray = isset( $dataArray ) ? $dataArray : $this->adapter->readAllWhere( $this->getResource(), $wheres, $orderByColumn, $reverseOrderBy, $limit, $offset, $offset );
		if ( $this->getMapRepository() !== null && is_array( $dataArray ) ) {
			return $this->getMapRepository()->readAllWhere( $wheres, $orderByColumn, $reverseOrderBy, $limit, $offset, $dataArray );
		}


		if ( is_array( $dataArray ) ) {
			foreach ( $dataArray as &$data ) {
				$data = $this->factory->createFromPersistedData( $data );
			}
		}

		return $dataArray;
	}

	/**
	 * @return int
	 * @throws \Exception
	 */
	public function countAllInResource(): int {
		return $this->adapter->count( $this->getResource(), new Wheres( [] ) );
	}

	/**
	 * @param string $allColumnId
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function countAllInAllColumn( string $allColumnId ): int {
		return $this->adapter->count(
			$this->getResource(),
			new Wheres(
				[ new Where( $this->getAllColumn(), $allColumnId ) ]
			)
		);
	}

	/**
	 * @param $sumColumn
	 * @param Wheres $wheres
	 *
	 * @return float
	 */
	public function sum( string $sumColumn, Wheres $wheres ) {
		return $this->adapter->sum( $this->getResource(), $sumColumn, $wheres );
	}

	/**
	 * @param string $sumColumn
	 * @param string $allColumnId
	 *
	 * @return float
	 * @throws \Exception
	 */
	public function sumInAllColumn( string $sumColumn, string $allColumnId ) {
		return $this->sum(
			$sumColumn,
			new Wheres(
				[ new Where( $this->getAllColumn(), $allColumnId ) ]
			)
		);
	}

	/**
	 * @param string $allColumnId
	 *
	 * @return float
	 * @throws \Exception
	 */
	public function sumInAllColumnCurrency( string $allColumnId ) {
		$currencyService = CurrencyServiceProvider::getService();
		$currencies      = [ 'USD' ];

		$total = 0;
		foreach ( $currencies as $currency ) {
			$total = $total + $currencyService->getSiteCurrency( $currency, $this->sum(
					'value',
					new Wheres(
						[
							new Where( $this->getAllColumn(), $allColumnId ),
							new Where( 'currency', $currency )
						]
					)
				) );
		}

		return (float) money_format( '%i', $total );
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