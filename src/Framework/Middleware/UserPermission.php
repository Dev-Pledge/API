<?php

namespace DevPledge\Framework\Middleware;


use DevPledge\Integrations\Route\MiddleWareAuthRequirement;
use DevPledge\Integrations\Security\JWT\Token;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UserPermission
 * @package DevPledge\Framework\Middleware
 */
class UserPermission extends AbstractUserMiddleware implements MiddleWareAuthRequirement {

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

				$userId = $this->getUserIdFromRequest( $request );
				if ( $user->getId() === $userId ) {
					$response = $next( $request, $response );

					return $response;
				}

			}

			return $response->withJson( [ 'error' => 'Permission Denied' ], 403 );
		};
	}

	public function getAuthRequirement(): ?array {
		return [
			'Header Required: "Authorization: Bearer {access_token}"',
			'User must own the entity being accessed'
		];
	}
}