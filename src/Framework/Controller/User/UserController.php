<?php

namespace DevPledge\Framework\Controller\User;


use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * Class UserController
 * @package DevPledge\Framework\Controller\User
 */
class UserController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getProfileInfoByUsername( Request $request, Response $response ) {
		$username       = $request->getAttribute( 'username' );
		$userService    = UserServiceProvider::getService();
		$problemService = ProblemServiceProvider::getService();
		try {
			$user     = $userService->getUserFromUsernameCache( $username );
			$problems = $problemService->readAll( $user->getId() );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'User Not Found' ], 404 );
		}

		return $response->withJson( [
			'user'      => $user->toPublicAPIMap(),
			'problems'  => $problems->toAPIMap(),
			'solutions' => [],
			'comments'  => []
		] );
	}

}