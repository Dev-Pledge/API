<?php

namespace DevPledge\Framework\RouteGroups;


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
		parent::__construct( '/status', [ new Authorise() ] );
	}

	protected function callableInGroup() {
		$app = $this->getApp();
		$app->get( '/{status_id}', CommentStatusController::class . ':getStatus' );
		$app->post( '/create', CommentStatusController::class . ':createStatus' );
	}
}