<?php

namespace DevPledge\Framework\Middleware;


use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\User;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Integrations\Middleware\AbstractMiddleware;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Security\JWT\Token;

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

	public function authorise(){
		return new Authorise();
	}
}