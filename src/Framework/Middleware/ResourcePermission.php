<?php

namespace DevPledge\Framework\Middleware;


use DevPledge\Domain\Permission;
use DevPledge\Integrations\Sentry;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Permission
 * @package DevPledge\Framework\Middleware
 */
class ResourcePermission extends AbstractUserMiddleware {
	/**
	 * @var
	 */
	protected $resource;
	/**
	 * @var string
	 */
	protected $action;

	/**
	 * ResourcePermission constructor.
	 *
	 * @param string $resource
	 * @param string $action
	 */
	public function __construct( string $resource, string $action) {
		try {
			if ( ! in_array( $action, Permission::ACTION_TYPES ) ) {
				throw new \Exception( 'Action has to be ' . join( ', ', Permission::ACTION_TYPES ) );
			}
		} catch ( \Exception $exception ) {
			Sentry::get()->captureException( $exception );
		}
		$this->action   = $action;
		$this->resource = $resource;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return mixed|Response
	 * @throws \Exception
	 */
	public function __invoke( Request $request, Response $response, callable $next ) {

		return $this->authorise( $request, $response, $this->hasPermissionFunction( $next ) );

	}

	/**
	 * @param $next
	 *
	 * @return \Closure
	 */
	public function hasPermissionFunction( $next ) {

		return function ( Request $request, Response $response ) use ( $next ) {

			$user = $this->getUserFromRequest( $request );

			if ( ! is_null( $user ) ) {

				$id = $this->getIdFromRequest( $request );

				if ( $user->getPermissions()->has( $this->resource, $this->action, $id ) ) {
					$response = $next( $request, $response );

					return $response;
				}

			}

			return $response->withJson( [ 'error' => 'Permission Denied' ], 403 );
		};
	}


}