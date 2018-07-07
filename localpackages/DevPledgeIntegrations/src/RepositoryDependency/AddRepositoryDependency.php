<?php

namespace DevPledge\Integrations\RepositoryDependency;
use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Container\AddCallable;

/**
 * Class AddRepositoryDependency
 * @package DevPledge\Integrations\RepositoryDependency
 */
class AddRepositoryDependency extends AddCallable {
	/**
	 * @param AbstractRepositoryDependency $dependency
	 */
	public static function dependency( AbstractRepositoryDependency $dependency ) {

		static::callable( $dependency );

	}

	/**
	 * @param AbstractRepositoryDependency $dependency
	 *
	 * @return $this
	 */
	public function addDependency( AbstractRepositoryDependency $dependency ) {
		static::dependency( $dependency );

		return $this;
	}
}