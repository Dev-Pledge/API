<?php

namespace DevPledge\Integrations;
use Slim\App;

/**
 * Class AbstractAppAccess
 * @package DevPledge\Integrations
 */
abstract class AbstractAppAccess {
	/**
	 * @var App
	 */
	protected static $app;

	/**
	 * @return App
	 */
	public function getApp(): App {
		return static::$app;
	}

	/**
	 * @param App $app
	 *
	 * @return App
	 */
	public static function setApp( App $app ): App {
		return static::$app = $app;
	}
}