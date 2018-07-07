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

		$app = $this->getApp();

		$app->post( '/login', AuthController::class . ':login' );

		$app->post( '/refresh', AuthController::class . ':refresh' )
		    ->add( new Refresh() );

		$app->get( '/payload', AuthController::class . ':outputTokenPayload' )
		    ->add( new Present() );
	}


}