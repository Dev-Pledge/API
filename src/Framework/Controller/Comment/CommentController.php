<?php

namespace DevPledge\Framework\Controller\Comment;


use DevPledge\Application\Commands\CommentCommands\CreateCommentCommand;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Integrations\Command\Dispatch;
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
}