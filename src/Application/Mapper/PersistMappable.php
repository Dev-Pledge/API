<?php


namespace DevPledge\Application\Mapper;

/**
 * Interface PersistMappable
 * @package DevPledge\Application\Mapper
 */
interface PersistMappable {
	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass;

	/**
	 * @return array
	 */
	function toPersistMapArray(): array;

	/**
	 * @return \stdClass
	 */
	function toAPIMap(): \stdClass;

	/**
	 * @return array
	 */
	function toAPIMapArray(): array;

}