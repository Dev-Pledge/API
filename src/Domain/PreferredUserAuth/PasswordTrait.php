<?php

namespace DevPledge\Domain\PreferredUserAuth;

/**
 * Class AbstractPassword
 * @package DevPledge\Domain\PreferredUserAuth
 */
trait PasswordTrait {
	/**
	 * @var string
	 */
	protected $password;
	/**
	 * @var string
	 */
	protected $hashedPassword;

	/**
	 * @param string $password
	 *
	 * @return UsernameEmailPassword
	 */
	public function setPassword( string $password ) {
		$this->password = $password;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getHashedPassword(): string {
		return $this->hashedPassword;
	}

	/**
	 * @param null|string $hashedPassword
	 *
	 * @return $this
	 */
	public function setHashedPassword( ?string $hashedPassword ) {
		$this->hashedPassword = $hashedPassword;

		return $this;
	}


	/**
	 * @param $password
	 * @param null $salt
	 *
	 * @return string
	 */
	protected function encrypt( $password, $salt = null ): string {

		if ( ! isset( $salt ) ) {

			$salt = $this->generateSalt();
		}

		$hash_password = crypt( $password, sprintf( '$2a$07$%s$', $salt ) );

		return $hash_password . ':' . $salt;
	}

	/**
	 * @param int $size
	 * @param int $t
	 *
	 * @return bool|string
	 */
	protected function generateSalt( $size = 22, $t = 128 ) {
		$strong = false;
		if ( function_exists( 'openssl_random_pseudo_bytes' ) ) {
			$secureString = openssl_random_pseudo_bytes( $size + ( $t * 1024 ), $strong );
		}
		if ( ! $strong && function_exists( 'mcrypt_create_iv' ) ) {
			$secureString = mcrypt_create_iv( $size + ( $t * 1024 ), MCRYPT_DEV_URANDOM );
		} else if ( ! $strong ) {
			$fp           = fopen( '/dev/urandom', 'r' );
			$secureString = fread( $fp, $size + ( $t * 1024 ) );
			fclose( $fp );
		}
		// return a string valid for crypt blowfish
		$secureString = str_replace( array( '=', '+', '/' ), '', base64_encode( $secureString ) );

		return substr( $secureString, - $size );
	}


	protected function validatePassword(): void {
		if ( ! ( isset( $this->password ) ) ) {
			throw new PreferredUserAuthValidationException( 'Password Required', 'password' );
		}

		if ( ! preg_match( '/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/', $this->password ) ) {
			throw new PreferredUserAuthValidationException( 'Passwords are required to have Uppercase, Lowercase, Symbols and more than 6 characters', 'password' );
		}
		if ( ! isset( $this->hashedPassword ) ) {
			$this->setHashedPassword( $this->encrypt( $this->password ) );
		}
		$hashedPasswordArray = explode( ":", $this->getHashedPassword() );

		if ( ! (
			isset( $hashedPasswordArray[1] ) &&
			$this->encrypt( $this->password, $hashedPasswordArray[1] ) == $this->getHashedPassword()
		) ) {
			throw new PreferredUserAuthValidationException( 'Password Invalid', 'password' );
		}
	}
}