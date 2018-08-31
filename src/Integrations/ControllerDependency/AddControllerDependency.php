<?php

namespace DevPledge\Integrations\ControllerDependency;

use DevPledge\Integrations\Container\AddCallable;

/**
 * Class AddControllerDependency
 * @package DevPledge\Integrations\ControllerDependency
 */
class AddControllerDependency extends AddCallable {

	/**
	 * @param AbstractControllerDependency $dependency
	 */
	public static function dependency( AbstractControllerDependency $dependency ) {

		static::callable( $dependency );

	}

	/**
	 * @param AbstractControllerDependency $dependency
	 *
	 * @return $this
	 */
	public function addDependency( AbstractControllerDependency $dependency ) {
		static::dependency( $dependency );

		return $this;
	}


}