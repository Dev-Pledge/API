<?php

namespace DevPledge\Integrations\ServiceProvider;


use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Extrapolate\AbstractExtrapolateForContainer;

/**
 * Class ExtrapolateServices
 * @package DevPledge\Integrations\ServiceProvider
 */
class ExtrapolateServiceProviders extends AbstractExtrapolateForContainer {
	/**
	 * @param AbstractContainerCallable $callable
	 */
	protected function add( AbstractContainerCallable $callable ) {
		AddServiceProvider::service( $callable );
	}
}