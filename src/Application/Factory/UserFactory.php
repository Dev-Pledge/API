<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\User;


/**
 * Class UserFactory
 * @package DevPledge\Application\Factory
 */
class UserFactory {

	/**
	 * @param $data
	 *
	 * @return User
	 */
	public function create( $data ): User {
		if ( $data instanceof \stdClass ) {
			$data = (array) $data;
		}
		$user = new User();

		$set = function ( $key, $setMethod, $useClass = null ) use ( $data, $user ) {
			if ( ( $data ) && array_key_exists( $key, $data ) && isset( $data[ $key ] ) ) {

				if ( is_callable( array( $user, $setMethod ) ) ) {
					if ( ! is_null( $useClass ) ) {
						$user->{$setMethod}( new $useClass( $data[ $key ] ) );
					} else {
						$user->{$setMethod}( $data[ $key ] );
					}
				}
			}
		};

		$set( 'user_id', 'setId', Uuid::class );
		$set( 'username', 'setUsername' );
		$set( 'name', 'setName' );
		$set( 'email', 'setEmail' );
		$set( 'hashed_password', 'setHashedPassword' );
		$set( 'github_id', 'setGitHubId' );
		$set( 'created', 'setCreated', \DateTime::class );
		$set( 'modified', 'setModified', \DateTime::class );

		return $user;
	}

}