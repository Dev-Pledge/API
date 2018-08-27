<?php

namespace DevPledge\Framework\Controller;

use DevPledge\Application\Commands\CreateFollowCommand;
use DevPledge\Application\Commands\DeleteFollowCommand;
use DevPledge\Domain\Follow;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\FollowServiceProvider;
use DevPledge\Integrations\Command\CommandException;
use DevPledge\Integrations\Command\Dispatch;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class FollowController
 * @package DevPledge\Framework\Controller
 */
class FollowController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws CommandException
	 */
	public function createFollow( Request $request, Response $response ) {
		$user = $this->getUserFromRequest( $request );
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}
		$entityId = $request->getAttribute( 'entity_id' );
		try {
			/**
			 * @var $follow Follow
			 */
			$follow = Dispatch::command( new CreateFollowCommand( $user, $entityId ) );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		}


		return $response->withJson( $follow->toAPIMap() );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function deleteFollow( Request $request, Response $response ) {
		$user = $this->getUserFromRequest( $request );
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}
		$entityId = $request->getAttribute( 'entity_id' );
		$deleted  = null;
		try {
			/**
			 * @var $follow Follow
			 */
			$deleted = Dispatch::command( new DeleteFollowCommand( $user, $entityId ) );
		} catch ( \TypeError | \Exception | CommandException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage() ]
				, 401 );
		}


		return $response->withJson( [ 'deleted' => $deleted ] );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getUserFollows( Request $request, Response $response ) {
		$followService = FollowServiceProvider::getService();

		$userId = $request->getAttribute( 'user_id' );
		try {
			return $response->withJson(
				$followService->readAll( $userId )->toAPIMapArray()
			);
		} catch ( \TypeError | \Exception $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage() ]
				, 401 );
		}
	}


}