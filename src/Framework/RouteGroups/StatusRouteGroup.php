<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Domain\StatusComment;
use DevPledge\Framework\Controller\Comment\CommentStatusController;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class StatusRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class StatusRouteGroup extends AbstractRouteGroup {
	/**
	 * StatusRouteGroup constructor.
	 */
	public function __construct() {
		parent::__construct( '/status' );
	}

	protected function callableInGroup() {

		$this->get( '/{status_id}', CommentStatusController::class . ':getStatus', StatusComment::getExampleResponse() );
		$this->post( '/create', CommentStatusController::class . ':createStatus', StatusComment::getExampleRequest(), StatusComment::getExampleResponse(), new Authorise() );
		$this->get( 'es/user/{user_id}', CommentStatusController::class . ':getUserStatuses' );
	}
}