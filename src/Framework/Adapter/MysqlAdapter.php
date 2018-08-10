<?php


namespace DevPledge\Framework\Adapter;


use TomWright\Database\ExtendedPDO\ExtendedPDO;
use TomWright\Database\ExtendedPDO\Like;
use TomWright\Database\ExtendedPDO\Query;

/**
 * Class MysqlAdapter
 * @package DevPledge\Framework\Adapter
 */
class MysqlAdapter implements Adapter {

	/**
	 * @var ExtendedPDO
	 */
	private $db;

	/**
	 * MysqlAdapter constructor.
	 *
	 * @param ExtendedPDO $db
	 */
	public function __construct( ExtendedPDO $db ) {
		$this->db = $db;
	}

	/**
	 * @param string $resource
	 * @param string $id
	 * @param string $column
	 *
	 * @return null|\stdClass
	 * @throws \Exception
	 */
	public function read( string $resource, string $id, string $column = 'id' ): ?\stdClass {
		$query = ( new Query( 'SELECT' ) )
			->setTable( $this->getResourceTable( $resource ) )
			->addWhere( $column, $id )
			->setLimit( 1 )
			->setOffset( 0 )
			->buildQuery();

		return $this->db->queryRow( $query->getSql(), $query->getBinds() );
	}


	/**
	 * @param string $resource
	 * @param string $id
	 * @param string $column
	 * @param null|string $orderByColumn
	 * @param bool $reverseOrderBy
	 * @param int|null $limit
	 * @param int|null $offset
	 *
	 * @return array|null
	 * @throws \Exception
	 */
	public function readAll( string $resource, string $id, string $column = 'id', ?string $orderByColumn = null, bool $reverseOrderBy = false, ?int $limit = null, ?int $offset = null ): ?array {
		$query = ( new Query( 'SELECT' ) )
			->setTable( $this->getResourceTable( $resource ) )
			->addWhere( $column, $id )
			->setLimit( $limit )
			->setOffset( $offset );
		if ( isset( $orderByColumn ) ) {
			$orderByColumn = $orderByColumn . ( $reverseOrderBy ? ' DESC' : '' );
			$query->addOrderBy( $orderByColumn );

		}
		$query->buildQuery();

		return $this->db->queryAll( $query->getSql(), $query->getBinds() );
	}

	/**
	 * @param string $resource
	 * @param \stdClass $data
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function create( string $resource, \stdClass $data ): string {
		$query = ( new Query( 'INSERT' ) )
			->setTable( $this->getResourceTable( $resource ) );

		foreach ( $data as $k => $v ) {
			$query->addValue( $k, $v );
		}

		$query->buildQuery();

		$lastInsertId = $this->db->dbQuery( $query->getSql(), $query->getBinds() );

		return $lastInsertId;
	}

	/**
	 * @param string $resource
	 * @param string $id
	 * @param \stdClass $data
	 * @param string $column
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function update( string $resource, string $id, \stdClass $data, string $column = 'id' ): int {
		$query = ( new Query( 'UPDATE' ) )
			->setTable( $this->getResourceTable( $resource ) )
			->addWhere( $column, $id );

		foreach ( $data as $k => $v ) {
			$query->addValue( $k, $v );
		}

		$query->buildQuery();

		return $this->db->dbQuery( $query->getSql(), $query->getBinds() );

	}

	/**
	 * @param $resource
	 *
	 * @return string
	 */
	private function getResourceTable( $resource ): string {
		return $resource;
	}


	/**
	 * @param string $resource
	 * @param Wheres $wheres
	 * @param null|string $orderByColumn
	 * @param bool $reverseOrderBy
	 * @param int|null $limit
	 * @param int|null $offset
	 *
	 * @return array|null
	 * @throws \Exception
	 */
	public function readAllWhere( string $resource, Wheres $wheres, ?string $orderByColumn = null, bool $reverseOrderBy = false, ?int $limit = null, ?int $offset = null ): ?array {
		$query = ( new Query( 'SELECT' ) )
			->setTable( $this->getResourceTable( $resource ) )
			->setLimit( $limit )
			->setOffset( $offset );
		if ( isset( $orderByColumn ) ) {
			$orderByColumn = $orderByColumn . ( $reverseOrderBy ? ' DESC' : '' );
			$query->addOrderBy( $orderByColumn );
		}
		$this->wheres( $query, $wheres )->buildQuery();

		return $this->db->queryAll( $query->getSql(), $query->getBinds() );
	}

	/**
	 * @param Query $query
	 * @param Wheres $wheres
	 *
	 * @return Query
	 */
	protected function wheres( Query $query, Wheres $wheres ): Query {
		if ( $wheres->getWheres() ) {
			foreach ( $wheres->getWheres() as $where ) {
				$column     = $where->getColumn();
				$value      = $where->getValue();
				$cleanValue = str_replace( "'", "\'", $value );
				switch ( $where->getType() ) {
					case 'equals':
						$query->addWhere( $column, $value );
						break;
					case 'like':
						$likeValue = new Like( 'contains', $value );
						$query->addWhere( $column, $likeValue );
						break;
					case 'like at start':
						$likeValue = new Like( 'starts_with', $value );
						$query->addWhere( $column, $likeValue );
						break;
					case 'like at end':
						$likeValue = new Like( 'ends_with', $value );
						$query->addWhere( $column, $likeValue );
						break;
					case 'more than':
						$query->addRawWhere( " `{$column}` > '{$cleanValue}' " );
						break;
					case 'more than equals':
						$query->addRawWhere( " `{$column}` >= '{$cleanValue}' " );
						break;
					case 'less than':
						$query->addRawWhere( " `{$column}` < '{$cleanValue}' " );
						break;
					case 'less than equals':
						$query->addRawWhere( " `{$column}` <= '{$cleanValue}' " );
						break;
				}
			}
		}

		return $query;
	}

	/**
	 * @param string $resource
	 * @param Wheres $wheres
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function count( string $resource, Wheres $wheres ): int {
		$query = new Query( 'SELECT' );
		$query->setTable( $this->getResourceTable( $resource ) )->setFields( [ 'COUNT(*) as total' ] );
		$this->wheres( $query, $wheres )->buildQuery();
		$data = $this->db->queryRow( $query->getSql(), $query->getBinds() );
		if ( isset( $data->total ) ) {
			return $data->total;
		}

		return 0;
	}

	/**
	 * @param string $resource
	 * @param string $id
	 * @param string $column
	 *
	 * @return int|null
	 * @throws \Exception
	 */
	public function delete( string $resource, string $id, string $column = 'id' ): ?int {
		$query = ( new Query( 'DELETE' ) )
			->setTable( $this->getResourceTable( $resource ) )
			->addWhere( $column, $id )->buildQuery();

		return $this->db->dbQuery( $query->getSql(), $query->getBinds() );
	}

	/**
	 * @param string $resource
	 * @param Wheres $wheres
	 *
	 * @return int|null
	 * @throws \Exception
	 */
	public function deleteWhere( string $resource, Wheres $wheres ): ?int {
		$query = ( new Query( 'DELETE' ) )
			->setTable( $this->getResourceTable( $resource ) );

		$this->wheres( $query, $wheres )->buildQuery();

		return $this->db->queryAll( $query->getSql(), $query->getBinds() );
	}
}