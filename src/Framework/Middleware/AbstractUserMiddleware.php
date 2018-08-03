<?php

namespace DevPledge\Framework\Middleware;


use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\User;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Integrations\Middleware\AbstractMiddleware;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Security\JWT\Token;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AbstractUserMiddleware
 * @package DevPledge\Framework\Middleware
 */
abstract class AbstractUserMiddleware extends AbstractMiddleware {
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

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return mixed
	 */
	public function authorise( Request $request, Response $response, callable $next ) {
		return ( new Authorise() )( $request, $response, $next );
	}

	/**
	 * @param Request $request
	 *
	 * @return null|string
	 */
	protected function getIdFromRequest( Request $request ): ?string {
		if ( isset( $request->getAttribute( 'routeInfo' )[2] ) ) {
			if ( isset( $request->getAttribute( 'routeInfo' )[2]['id'] ) ) {
				return $request->getAttribute( 'routeInfo' )[2]['id'];
			}
		}

		return null;
	}

	/**
	 * @param Request $request
	 *
	 * @return null|string
	 */
	protected function getUserIdFromRequest( Request $request ): ?string {
		if ( isset( $request->getAttribute( 'routeInfo' )[2] ) ) {
			if ( isset( $request->getAttribute( 'routeInfo' )[2]['user_id'] ) ) {
				return $request->getAttribute( 'routeInfo' )[2]['user_id'];
			}
		}

		return null;
	}

}