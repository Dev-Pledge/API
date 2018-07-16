<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\User;
use Slim\Http\Request;

/**
 * Class UserFactory
 * @package DevPledge\Application\Factory
 * @method User create( \stdClass $rawData )
 */
class UserFactory extends AbstractFactory {
	/**
	 * @param Request $request
	 *
	 * @return User
	 * @throws FactoryException
	 */
	function createFromRequest( Request $request ) {
		try {
			return $this->create( $request->getAttribute( Token::class )->getPayload() );
		} catch ( \Error $error ) {
			throw new FactoryException( $error->getMessage() );
		}
	}

	/**
	 * @return AbstractFactory|UserFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'username', 'setUsername' )
			->setMethodToProductObject( 'name', 'setName' )
			->setMethodToProductObject( 'email', 'setEmail' )
			->setMethodToProductObject( 'hashed_password', 'setHashedPassword' )
			->setMethodToProductObject( 'github_id', 'setGitHubId' );
	}
}