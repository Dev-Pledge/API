<?php


namespace DevPledge\Framework\Adapter;


use TomWright\Database\ExtendedPDO\ExtendedPDO;
use TomWright\Database\ExtendedPDO\Query;

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
	 * @param null|Query $query
	 *
	 * @return \stdClass[]
	 * @throws \Exception
	 */
	public function readAll( string $resource, ?Query $query = null ): array {
		if ( $query === null ) {
			$query = new Query( 'SELECT' );
		}
		$query
			->setTable( $this->getResourceTable( $resource ) )
			->buildQuery();

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

		$affectedRows = $this->db->dbQuery( $query->getSql(), $query->getBinds() );

		return $affectedRows;
	}

	/**
	 * @param $resource
	 *
	 * @return string
	 */
	private function getResourceTable( $resource ): string {
		return $resource;
	}

}