<?php

namespace DevPledge\Integrations\ServiceProvider;

use DevPledge\Integrations\Container\AddCallable;

/**
 * Class AddService
 * @package DevPledge\Integrations\ServiceProvider
 */
class AddServiceProvider extends AddCallable {

	/**
	 * @param AbstractServiceProvider $service
	 */
	public static function service( AbstractServiceProvider $service ) {
		static::callable( $service );

	}

	/**
	 * @param AbstractServiceProvider $service
	 *
	 * @return $this
	 */
	public function addService( AbstractServiceProvider $service ) {
		static::service( $service );

		return $this;
	}


}