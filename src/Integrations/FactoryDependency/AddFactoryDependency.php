<?php

namespace DevPledge\Integrations\FactoryDependency;


use DevPledge\Integrations\Container\AddCallable;

/**
 * Class AddFactoryDependency
 * @package DevPledge\Integrations\FactoryDependency
 */
class AddFactoryDependency extends AddCallable {
	/**
	 * @param AbstractFactoryDependency $dependency
	 */
	public static function dependency( AbstractFactoryDependency $dependency ) {

		static::callable( $dependency );

	}

	/**
	 * @param AbstractFactoryDependency $dependency
	 *
	 * @return $this
	 */
	public function addDependency( AbstractFactoryDependency $dependency ) {
		static::dependency( $dependency );

		return $this;
	}
}