<?php

namespace DevPledge\Framework\RouteGroups;

use DevPledge\Framework\Controller\Comment\CommentController;
use DevPledge\Framework\Controller\Comment\CommentStatusController;
use DevPledge\Framework\Middleware\UserPermission;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class CommentRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class CommentRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/comment', [ new Authorise() ] );
	}

	protected function callableInGroup() {
		$app = $this->getApp();
//		$app->get( '/{comment_id}' );
//		$app->get( 's/{entity_id}' );
//		$app->get( '/replies/{comment_id}' );
//
//		$app->get( 's/{entity_id}/page/{page}' );
//		$app->get( '/replies/{comment_id}/page/{page}' );
//		$app->post( '/reply/{comment_id}' );
		$app->post( '/{entity_id}', CommentController::class . ':createCommentOnEntity' );
		$app->post( 'Status', CommentStatusController::class . ':createStatus' );
//		$app->get( 's/contextual/{comment_id}' );
	}
}