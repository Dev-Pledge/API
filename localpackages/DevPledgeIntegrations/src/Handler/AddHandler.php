<?php

namespace DevPledge\Integrations\Handler;

use DevPledge\Integrations\AbstractAppAccess;

/**
 * Class AddHandler
 * @package DevPledge\Integrations\Handler
 */
class AddHandler extends AbstractAppAccess {
	/**
	 * @param AbstractHandler $handler
	 */
	public static function handler( AbstractHandler $handler ) {
		$container = static::$app->getContainer();
		$callable = new HandlerCaller( $handler );
		$container[ $callable->getContainerKey() ] = $callable;
	}


	/**
	 * @param AbstractHandler $handler
	 *
	 * @return $this
	 */
	public function addHandler( AbstractHandler $handler ) {
		static::handler( $handler );

		return $this;
	}
}