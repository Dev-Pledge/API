<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\Permissions;
use DevPledge\Domain\User;
use DevPledge\Integrations\Security\JWT\Token;
use Slim\Http\Request;

/**
 * Class UserFactory
 * @package DevPledge\Application\Factory
 * @method User create( \stdClass $rawData )
 */
class UserFactory extends AbstractFactory {
	/**
	 * @param Token $token
	 *
	 * @return User
	 * @throws FactoryException
	 */
	function createFromToken( Token $token ) {
		try {

			return $this->create( $token->getData() );
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
			->setMethodToProductObject( 'github_id', 'setGitHubId' )
			->setMethodToProductObject( 'permissions', 'setPermissions', Permissions::class );
	}
}