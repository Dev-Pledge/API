<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\FollowController;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;

class FollowRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/follow' );
	}

	protected function callableInGroup() {
		$app = $this->getApp();

		$app->post( '/{entity_id}', FollowController::class . ':createFollow' )->add( new Authorise() );
		$app->delete( '/{entity_id}', FollowController::class . ':deleteFollow' )->add( new Authorise() );
		$app->get( '/{user_id}', FollowController::class . ':getUserFollows' );
	
	}
}