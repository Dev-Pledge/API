<?php


namespace DevPledge\Domain\PreferredUserAuth;

/**
 * Class AuthDataArray
 * @package DevPledge\Domain\PreferredUserAuth
 */
class AuthDataArray {
	protected $array = [];

	public function __construct( array $array ) {
		$this->array = $array;
	}

	/**
	 * @return array
	 * @throws \DomainException
	 */
	public function getArray() {
		if ( ! isset( $this->array['username'] ) ) {
			throw new \DomainException( 'username required in AuthDataArray' );
		}

		return $this->array;
	}
}