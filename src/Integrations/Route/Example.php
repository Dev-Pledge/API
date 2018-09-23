<?php

namespace DevPledge\Integrations\Route;

/**
 * Interface Example
 * @package DevPledge\Integrations\Route
 */
interface Example {
	/**
	 * @return null|\Closure
	 */
	public static function getExampleResponse(): ?\Closure;

	/**
	 * @return null|\Closure
	 */
	public static function getExampleRequest(): ?\Closure;

	/**
	 * @return mixed
	 */
	public static function getExampleInstance();
}