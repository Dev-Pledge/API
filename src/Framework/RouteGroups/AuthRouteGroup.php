<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Auth\AuthController;
use DevPledge\Integrations\Integrations;
use DevPledge\Integrations\Middleware\JWT\Present;
use DevPledge\Integrations\Middleware\JWT\Refresh;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class AuthRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class AuthRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/auth' );
	}

	protected function callableInGroup() {

		$this->post( '/login', AuthController::class . ':login' );

		$this->post( '/refresh', AuthController::class . ':refresh', null, null, new Refresh() );

		$this->get( '/payload', AuthController::class . ':outputTokenPayload', null, new Present() );
	}


}