<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\User;
use DevPledge\Uuid\Uuid;

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

	/**
	 * @param User $user
	 * @param array $data
	 *
	 * @return User
	 */
	public function update( User $user, array $data ): User {

		if ( array_key_exists( 'username', $data ) ) {
			$user->setUsername( $data['username'] );
		}
		if ( array_key_exists( 'name', $data ) ) {
			$user->setName( $data['name'] );
		}
		if ( array_key_exists( 'email', $data ) ) {
			$user->setEmail( $data['email'] );
		}
		if ( array_key_exists( 'developer', $data ) ) {
			$user->setDeveloper( (bool) $data['developer'] );
		}
		if ( array_key_exists( 'hashed_password', $data ) ) {
			$user->setHashedPassword( $data['hashed_password'] );
		}
		if ( array_key_exists( 'github_id', $data ) ) {
			$user->setHashedPassword( $data['github_id'] );
		}
		if ( array_key_exists( 'created', $data ) ) {
			$user->setCreated( new \DateTime( $data['created'] ) );
		}
		if ( array_key_exists( 'modified', $data ) ) {
			$user->setModified( new \DateTime( $data['modified'] ) );
		}

		return $user;
	}
}