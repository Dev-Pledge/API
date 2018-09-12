<?php

namespace DevPledge\Framework\Controller\Comment;


use DevPledge\Application\Commands\CommentCommands\CreateCommentCommand;
use DevPledge\Application\Commands\CommentCommands\CreateReplyCommand;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Sentry;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CommentController
 * @package DevPledge\Framework\Controller\Comment
 */
class CommentController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function createCommentOnEntity( Request $request, Response $response ) {
		$entityId = $request->getAttribute( 'entity_id' );
		$user     = $this->getUserFromRequest( $request );
		$data     = $this->getStdClassFromRequest( $request );
		$comment  = $data->comment ?? '';
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}

		try {
			if ( is_null( $entityId ) ) {
				throw new InvalidArgumentException( 'Missing Entity Id', 'entity_id' );
			}
			/**
			 * @var $comment Comment
			 */
			$comment = Dispatch::command( new CreateCommentCommand( $entityId, $comment, $user ) );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		} catch ( \TypeError | \Exception $exception ) {
			Sentry::get()->captureException( $exception );

			return $response->withJson(
				[
					'error' => 'Server Error ' . $exception->getMessage(),
					'trace' => $exception->getTraceAsString()
				]
				, 500 );
		}


		return $response->withJson( $comment->toAPIMap() );
	}

	public function createReply( Request $request, Response $response ) {
		$commentId = $request->getAttribute( 'comment_id' );
		$user      = $this->getUserFromRequest( $request );
		$data      = $this->getStdClassFromRequest( $request );
		$comment   = $data->comment ?? '';
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}

		try {
			if ( is_null( $commentId ) ) {
				throw new InvalidArgumentException( 'Missing Comment Id', 'comment_id' );
			}
			/**
			 * @var $comment Comment
			 */
			$comment = Dispatch::command( new CreateReplyCommand( $commentId, $comment, $user ) );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		} catch ( \TypeError | \Exception $exception ) {
			Sentry::get()->captureException( $exception );

			return $response->withJson(
				[
					'error' => 'Server Error ' . $exception->getMessage(),
					'trace' => $exception->getTraceAsString()
				]
				, 500 );
		}


		return $response->withJson( $comment->toAPIMap() );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getComment( Request $request, Response $response ) {
		$commentId      = $request->getAttribute( 'comment_id' );
		$commentService = CommentServiceProvider::getService();

		try {
			$comment = $commentService->read( $commentId );
			if ( ! $comment->isPersistedDataFound() ) {
				throw new \Exception( 'Not Found!' );
			}
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson(
				[ 'error' => 'Comment not found!' ]
				, 401 );
		}

		return $response->withJson( $comment->toAPIMap() );

	}
}