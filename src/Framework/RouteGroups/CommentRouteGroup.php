<?php

namespace DevPledge\Framework\RouteGroups;

use DevPledge\Domain\Comment;
use DevPledge\Domain\Comments;
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

		$this->get( '/{comment_id}', CommentController::class . ':getComment', Comment::getExampleResponse() );
		$this->get( 's/{entity_id}', CommentController::class . ':getEntityComments', Comments::getExampleResponse() );
		$this->get( '/replies/{comment_id}', CommentController::class . ':getCommentReplies', Comments::getExampleResponse() );
		$this->get( 's/{entity_id}/page/{page}', CommentController::class . ':getEntityCommentsByPage', Comments::getExampleResponse() );
		$this->get( '/replies/{comment_id}/page/{page}', CommentController::class . ':getCommentRepliesByPage', Comments::getExampleResponse() );
		$this->post( '/reply/{comment_id}', CommentController::class . ':createReply', Comment::getExampleRequest(), Comment::getExampleResponse(), new Authorise() );
		$this->post( '/{entity_id}', CommentController::class . ':createCommentOnEntity', Comment::getExampleRequest(), Comment::getExampleResponse(), new Authorise() );
		$this->get( 's/contextual/{comment_id}', CommentController::class . ':getContextualComments', Comments::getExampleResponse() );
	}
}