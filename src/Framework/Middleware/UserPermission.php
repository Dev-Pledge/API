<?php

namespace DevPledge\Framework\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UserPermission
 * @package DevPledge\Framework\Middleware
 */
class UserPermission extends AbstractUserMiddleware {

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return mixed
	 */
	public function __invoke( Request $request, Response $response, callable $next ) {
		return $this->authorise( $request, $response, $this->matchUserFunction( $next ) );
	}

	/**
	 * @param $next
	 *
	 * @return \Closure
	 */
	public function matchUserFunction( $next ) {

		return function ( Request $request, Response $response ) use ( $next ) {
			$user = $this->getUserFromRequest( $request );

			if ( ! is_null( $user ) ) {

				$userId = $request->getAttribute( Token::class );
				var_dump( $userId );
				die( 'z' );
				if ( $user->getId() === $userId ) {
					$response = $next( $request, $response );

					return $response;
				}

			}

			return $response->withJson( [ 'error' => 'Permission Denied' ], 403 );
		};
	}

}