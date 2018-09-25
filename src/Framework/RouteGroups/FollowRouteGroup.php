<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Domain\Follow;
use DevPledge\Domain\Follows;
use DevPledge\Framework\Controller\FollowController;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;


class FollowRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/follow' );
	}

	protected function callableInGroup() {


		$this->post( '/{entity_id}', FollowController::class . ':createFollow', Follow::getExampleRequest(), Follow::getExampleResponse(), new Authorise() );
		$this->delete( '/{entity_id}', FollowController::class . ':deleteFollow', function () {
			return (object) [ 'deleted' => true ];
		}, new Authorise() );
		$this->get( 's/{user_id}', FollowController::class . ':getUserFollows', Follows::getExampleResponse() );

	}
}