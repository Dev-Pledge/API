<?php

namespace DevPledge\Domain;

/**
 * Class Pin
 * @package DevPledge\Domain
 */
class Pin {
	/**
	 * @var string
	 */
	protected $pin;

	const MIN_NUMBERS = 4;

	/**
	 * Pin constructor.
	 *
	 * @param string $pin
	 */
	public function __construct( string $pin ) {

		if ( strlen( $pin ) < static::MIN_NUMBERS ) {
			throw new InvalidArgumentException( static::MIN_NUMBERS . ' numbers are required for this pin number!', 'pin' );
		}

		$this->pin = $pin;
	}

	public function getPin() {
		return $this->pin;
	}
}