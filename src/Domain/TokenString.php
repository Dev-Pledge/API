<?php

namespace DevPledge\Domain;

use DevPledge\Integrations\Security\JWT\JWT;

/**
 * Class TokenString
 * @package DevPledge\Domain
 */
class TokenString {
	/**
	 * @var User
	 */
	private $user;
	/**
	 * @var JWT
	 */
	private $jwt;
	/**
	 * @var string
	 */
	private $token;

	/**
	 * Token constructor.
	 *
	 * @param User $user
	 * @param JWT $jwt
	 */
	public function __construct( User $user, JWT $jwt ) {
		$this->jwt  = $jwt;
		$this->user = $user;
	}

	/**
	 * @return string
	 * @throws \TomWright\JSON\Exception\JSONEncodeException
	 */
	public function getTokenString() {

		if ( isset( $this->token ) ) {
			return $this->token;
		}

		$wildCardPermissions = new WildCardPermissions();
		$user                = $this->user;
		$token               = $this->jwt->generate(
			(object)
			(
			array_merge(
				$user->toMap(),
				[ 'perms' => $wildCardPermissions->getPerms() ]
			)
			)
		);

		return $this->token = $token;

	}
}