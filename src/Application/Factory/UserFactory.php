<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\Data;
use DevPledge\Domain\User;
use DevPledge\Uuid\Uuid;

/**
 * Class UserFactory
 * @package DevPledge\Application\Factory
 * @method User create( \stdClass $rawData )
 */
class UserFactory extends AbstractFactory {


	function creationProcess() {
		return $this->setMethodToProductObject( 'user_id', 'setUuid', Uuid::class );
	}

	function updateProcess() {
		return $this->setMethodToProductObject( 'username', 'setUsername' )
		            ->setMethodToProductObject( 'data', 'setData', Data::class )
		            ->setMethodToProductObject( 'name', 'setName' )
		            ->setMethodToProductObject( 'email', 'setEmail' )
		            ->setMethodToProductObject( 'hashed_password', 'setHashedPassword' )
		            ->setMethodToProductObject( 'github_id', 'setGitHubId' )
		            ->setMethodToProductObject( 'created', 'setCreated', \DateTime::class )
		            ->setMethodToProductObject( 'modified', 'setModified', \DateTime::class );
	}
}