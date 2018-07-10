<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\User;

/**
 * Class UserFactory
 * @package DevPledge\Application\Factory
 * @method User create( \stdClass $rawData )
 */
class UserFactory extends AbstractFactory {


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