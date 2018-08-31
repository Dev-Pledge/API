<?php

namespace DevPledge\Integrations\ControllerDependency;


use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Extrapolate\AbstractExtrapolateForContainer;

/**
 * Class ExtrapolateControllerDependencies
 * @package DevPledge\Integrations\ControllerDependency
 */
class ExtrapolateControllerDependencies extends AbstractExtrapolateForContainer {
	/**
	 * @param AbstractContainerCallable $callable
	 */
	protected function add( AbstractContainerCallable $callable ) {
		AddControllerDependency::dependency( $callable );
	}

}