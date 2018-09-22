<?php

namespace DevPledge\Domain\PreferredUserAuth;

/**
 * Trait UsernameTrait
 * @package DevPledge\Domain\PreferredUserAuth
 */
trait UsernameTrait {
	protected $username;

	/**
	 * @return string
	 */
	public function getUsername(): string {
		return $this->username;
	}

	/**
	 * @param string $username
	 *
	 * @return $this
	 */
	public function setUsername( string $username ) {
		$this->username = $username;

		return $this;
	}

	public function validateUsername(): void {
		if ( ! preg_match( '/^[a-z\d_]{5,20}$/i', $this->username ) ) {
			throw new PreferredUserAuthValidationException( 'Username must be longer than 5 characters and contain no special characters or spaces - underscores are just fine though', 'username' );
		}
	}

}