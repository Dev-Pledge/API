<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 02/08/2018
 * Time: 21:29
 */

namespace DevPledge\Framework\Middleware;


use DevPledge\Integrations\Middleware\JWT\Authorise;
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
		return $this->authorise()( $request, $response, $this->matchUserFunction() );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return Response
	 */
	public function matchUserFunction() {
		return function ( Request $request, Response $response, callable $next ) {
			$user = $this->getUserFromRequest( $request );

			if ( ! is_null( $user ) ) {
				$userId = $request->getAttribute( 'id', null );
				if ( $user->getId() === $userId ) {
					$response = $next( $request, $response );

					return $response;
				}

			}

			return $response->withJson( [ 'error' => 'Permission Denied' ], 403 );
		};
	}

}