<?php

namespace DevPledge\Integrations\Route;

/**
 * Interface Example
 * @package DevPledge\Integrations\Route
 */
interface Example {
	/**
	 * @return null|\stdClass
	 */
	public static function getExampleResponse(): ?\stdClass;

	/**
	 * @return null|\stdClass
	 */
	public static function getExampleRequest(): ?\stdClass;

	/**
	 * @return mixed
	 */
	public static function getExampleInstance();
}