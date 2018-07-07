<?php

namespace DevPledge\Domain\PreferredUserAuth;

use DevPledge\Domain\User;

/**
 * Interface ThirdPartyAuth
 * @package DevPledge\Domain\ThirdPartyAuth
 */
interface PreferredUserAuth {
	/**
	 * @return bool
	 * @throws ThirdPartyAuthValidationException
	 */
	public function validate(): void;

	/**
	 * @param User $user
	 */
	public function updateUserWithAuth( User $user ): void;

	/**
	 * @return AuthDataArray
	 */
	public function getAuthDataArray();

	/**
	 * @return string
	 */
	public function getUsername();

}