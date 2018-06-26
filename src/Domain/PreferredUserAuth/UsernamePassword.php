<?php

namespace DevPledge\Domain\PreferredUserAuth;

use DevPledge\Domain\User;

/**
 * Class UsernamePassword
 * @package DevPledge\Domain\PreferredUserAuth
 */
class UsernamePassword implements PreferredUserAuth {

	use PasswordTrait;
	use UsernameTrait;

	/**
	 * UsernamePassword constructor.
	 *
	 * @param string $username
	 * @param string|null $password
	 * @param string|null $hashedPassword
	 */
	public function __construct( string $username, string $password = null, string $hashedPassword = null ) {
		$this->username = $username;
		if ( isset( $password ) ) {
			$this->setPassword( $password );
		}
		if ( isset( $hashedPassword ) ) {
			$this->setHashedPassword( $hashedPassword );
		}
	}

	/**
	 * @throws PreferredUserAuthValidationException
	 */
	public function validate(): void {
		$this->validateUsername();
		$this->validatePassword();
	}

	/**
	 * @param User $user
	 */
	public function updateUserWithAuth( User $user ): void {
		$user->setHashedPassword( $this->getHashedPassword() );
		$user->setUsername( $this->getUsername() );
	}

	/**
	 * @return array
	 */
	public function getAuthDataArray() {
		return new AuthDataArray( [
			'hashed_password' => $this->getHashedPassword(),
			'username'        => $this->getUsername()
		] );
	}
}