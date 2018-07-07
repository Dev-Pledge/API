<?php

namespace DevPledge\Integrations\RepositoryDependency;

use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Extrapolate\AbstractExtrapolateForContainer;

/**
 * Class ExtrapolateRepositoryDependencies
 * @package DevPledge\Integrations\RepositoryDependency
 */
class ExtrapolateRepositoryDependencies extends AbstractExtrapolateForContainer {
	/**
	 * @param AbstractContainerCallable $callable
	 */
	protected function add( AbstractContainerCallable $callable ) {
		AddRepositoryDependency::dependency( $callable );
	}

}