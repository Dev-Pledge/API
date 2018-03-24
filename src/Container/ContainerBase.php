<?php

namespace DevPledge\Container;


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Base
 * @package DevPledge\Container
 */
abstract class ContainerBase {
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
	 */
	public static function setApp( App $app ): void {
		static::$app = $app;
	}


	abstract protected function do();
}