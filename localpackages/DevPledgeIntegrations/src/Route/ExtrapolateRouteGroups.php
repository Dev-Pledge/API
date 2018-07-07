<?php

namespace DevPledge\Integrations\Route;

use DevPledge\Integrations\Extrapolate\AbstractExtrapolate;

/**
 * Class ExtrapolateRouteGroups
 * @package DevPledge\Integrations\Route
 */
class ExtrapolateRouteGroups extends AbstractExtrapolate {
	/**
	 * @param callable $callable
	 */
	protected function extrapolate( callable $callable ) {
		$this->add( $callable );
	}

	/**
	 * @param AbstractRouteGroup $routeGroup
	 */
	protected function add( AbstractRouteGroup $routeGroup ) {
		call_user_func( $routeGroup );
	}
}