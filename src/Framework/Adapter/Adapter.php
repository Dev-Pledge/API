<?php

namespace DevPledge\Framework\Adapter;


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
	 * @param string $id
	 * @param string $column
	 * @param int|null $limit
	 * @param int|null $offset
	 *
	 * @return array|null
	 */
	public function readAll( string $resource, string $id, string $column = 'id', ?int $limit = null, ?int $offset = null ): ?array;

	/**
	 * @param string $resource
	 * @param Wheres $wheres
	 * @param int|null $limit
	 * @param int|null $offset
	 *
	 * @return array|null
	 */
	public function readAllWhere( string $resource, Wheres $wheres , ?int $limit = null, ?int $offset = null ): ?array;

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
	 *return affected rows
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function update( string $resource, string $id, \stdClass $data, string $column = 'id' ): int;

	/**
	 * @param string $resource
	 * @param Wheres $wheres
	 *
	 * @return int
	 */
	public function count(string $resource,Wheres $wheres): int;

}