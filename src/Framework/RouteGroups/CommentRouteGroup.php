<?php

namespace DevPledge\Framework\RouteGroups;

use DevPledge\Framework\Controller\Comment\CommentController;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class CommentRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class CommentRouteGroup extends AbstractRouteGroup {
	/**
	 * CommentRouteGroup constructor.
	 */
	public function __construct() {
		parent::__construct( '/comment' );
	}

	protected function callableInGroup() {
		$app = $this->getApp();
		$app->get( '/{comment_id}', CommentController::class . ':getComment' );
		$app->get( 's/{entity_id}', CommentController::class . ':getEntityComments' );
		$app->get( '/replies/{comment_id}', CommentController::class . ':getCommentReplies' );
		$app->get( 's/{entity_id}/page/{page}', CommentController::class . ':getEntityCommentsByPage' );
		$app->get( '/replies/{comment_id}/page/{page}', CommentController::class . ':getCommentRepliesByPage' );
		$app->post( '/reply/{comment_id}', CommentController::class . ':createReply' )->add( new Authorise() );
		$app->post( '/{entity_id}', CommentController::class . ':createCommentOnEntity' )->add( new Authorise() );

		$app->get( 's/contextual/{comment_id}',  CommentController::class . ':getContextualComments');
	}
}