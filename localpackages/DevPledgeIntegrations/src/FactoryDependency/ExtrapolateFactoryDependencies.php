<?php

namespace DevPledge\Integrations\FactoryDependency;

use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Extrapolate\AbstractExtrapolateForContainer;

/**
 * Class ExtrapolateFactoryDependencies
 * @package DevPledge\Integrations\FactoryDependency
 */
class ExtrapolateFactoryDependencies extends AbstractExtrapolateForContainer {
	/**
	 * @param AbstractContainerCallable $callable
	 */
	protected function add( AbstractContainerCallable $callable ) {
		AddFactoryDependency::dependency( $callable );
	}

}