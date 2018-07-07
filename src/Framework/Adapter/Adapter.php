<?php


namespace DevPledge\Framework\Adapter;


use TomWright\Database\ExtendedPDO\Query;

/**
 * Interface Adapter
 * @package DevPledge\Framework\Adapter
 */
interface Adapter {

	/**
	 * @param string $resource
	 * @param string $id
	 * @param string $column
	 *
	 * @return null|\stdClass
	 */
	public function read( string $resource, string $id, string $column = 'id' ): ?\stdClass;

	/**
	 * @param string $resource
	 * @param null|Query $query
	 *
	 * @return \stdClass[]
	 * @throws \Exception
	 */
	public function readAll( string $resource, ?Query $query = null ): array;

	/**
	 * @param string $resource
	 * @param \stdClass $data
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function create( string $resource, \stdClass $data ): string;

	/**
	 * @param string $resource
	 * @param string $id
	 * @param \stdClass $data
	 * @param string $column
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function update( string $resource, string $id, \stdClass $data, string $column = 'id' ): int;

}