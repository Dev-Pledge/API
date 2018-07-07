<?php

namespace DevPledge\Domain\PreferredUserAuth;

use DevPledge\Domain\User;

/**
 * Class EmailPassword
 * @package DevPledge\Domain\ThirdPartyAuth
 */
class UsernameEmailPassword implements PreferredUserAuth {

	use PasswordTrait;
	use UsernameTrait;
	/**
	 * @var string
	 */
	private $email;

	/**
	 * UsernameEmailPassword constructor.
	 *
	 * @param string $username
	 * @param string $email
	 * @param string|null $password
	 * @param string|null $hashedPassword
	 */
	public function __construct( string $username, string $email, string $password = null, string $hashedPassword = null ) {
		$this->username = $username;
		$this->email    = $email;

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

		if ( ! filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
			throw new PreferredUserAuthValidationException( 'Email is not formatted correctly', 'email' );
		}

		$this->validatePassword();

	}


	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * @param User $user
	 */
	public function updateUserWithAuth( User $user ): void {
		$user->setHashedPassword( $this->getHashedPassword() );
		$user->setEmail( $this->getEmail() );
	}

	/**
	 * @return AuthDataArray
	 */
	public function getAuthDataArray() {
		return new AuthDataArray( [
			'hashed_password' => $this->getHashedPassword(),
			'email'           => $this->getEmail(),
			'username'        => $this->getUsername()
		] );
	}
}