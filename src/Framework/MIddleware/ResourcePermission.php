<?php

namespace DevPledge\Framework\Middleware;

use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\Permission;
use DevPledge\Domain\User;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Integrations\Middleware\AbstractMiddleware;
use DevPledge\Integrations\Security\JWT\Token;
use DevPledge\Integrations\Sentry;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Permission
 * @package DevPledge\Framework\Middleware
 */
class ResourcePermission extends AbstractMiddleware {
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
	public function __construct( string $resource, string $action ) {
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


		$user = $this->getUserFromRequest( $request );

		if ( ! is_null( $user ) ) {

			$id = $request->getAttribute( 'id', null );

			if ( $user->getPermissions()->has( $this->resource, $this->action, $id ) ) {
				$response = $next( $request, $response );

				return $response;
			}

		}

		return $response->withJson( [ 'error' => 'Permission Denied' ], 403 );


	}

	/**
	 * @param Request $request
	 *
	 * @return User|null
	 */
	protected function getUserFromRequest( Request $request ): ?User {
		try {
			return UserFactoryDependency::getFactory()->createFromToken( $request->getAttribute( Token::class ) );
		} catch ( FactoryException $exception ) {
			return null;
		}
	}

}