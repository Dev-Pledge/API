<?php

namespace DevPledge\Integrations\Container;

use DevPledge\Integrations\AbstractAppAccess;

/**
 * Class AddCallable
 * @package DevPledge\Integrations\Container
 */
class AddCallable extends AbstractAppAccess {

	/**
	 * @param AbstractContainerCallable $callable
	 */
	public static function callable( AbstractContainerCallable $callable ) {

		$container = static::$app->getContainer();

		$container[ $callable->getContainerKey() ] = $callable;

	}

	/**
	 * @param AbstractContainerCallable $callable
	 *
	 * @return $this
	 */
	public function addCallable( AbstractContainerCallable $callable ) {
		static::callable( $callable );

		return $this;
	}


}