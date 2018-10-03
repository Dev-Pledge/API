<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

class PledgeRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/pledge', [ new Authorise() ] );
	}

	protected function callableInGroup() {
		// TODO: Implement callableInGroup() method.
	}
}