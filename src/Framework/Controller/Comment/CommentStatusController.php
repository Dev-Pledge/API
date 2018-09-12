<?php

namespace DevPledge\Framework\Controller\Comment;

use DevPledge\Application\Commands\CommentCommands\CreateStatusCommand;
use DevPledge\Application\Service\StatusCommentService;
use DevPledge\Domain\Comment;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\StatusCommentServiceProvider;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Sentry;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CommentStatusController
 * @package DevPledge\Framework\Controller\Comment
 */
class CommentStatusController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function createStatus( Request $request, Response $response ) {
		$user = $this->getUserFromRequest( $request );
		$data = $this->getStdClassFromRequest( $request );

		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}
		try {
			/**
			 * @var $comment Comment
			 */
			$comment = Dispatch::command( new CreateStatusCommand( $data, $user ) );
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
	 * @throws \Exception
	 */
	public function getStatus( Request $request, Response $response ) {
		$commentId      = $request->getAttribute( 'status_id' );
		$commentService = StatusCommentServiceProvider::getService();

		try {
			$comment = $commentService->read( $commentId );
			if ( ! $comment->isPersistedDataFound() ) {
				throw new \Exception( 'Not Found!' );
			}
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson(
				[ 'error' => 'Status not found!' ]
				, 401 );
		}

		return $response->withJson( $comment->toAPIMap() );

	}

}