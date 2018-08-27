<?php

namespace DevPledge\Domain;

/**
 * Class InvalidArgumentException
 * @package DevPledge\Domain
 */
class InvalidArgumentException extends \InvalidArgumentException {
	/**
	 * @var string
	 */
	private $field;

	/**
	 * ThirdPartyAuthValidationException constructor.
	 *
	 * @param string $message
	 * @param null $field
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct( string $message = "", $field = null, int $code = 0, Throwable $previous = null ) {
		if ( isset( $field ) ) {
			$this->setField( $field );
		}
		parent::__construct( $message, $code, $previous );

	}

	/**
	 * @return string
	 */
	public function getField(): string {
		return isset( $this->field ) ? $this->field : 'no field specified';
	}

	/**
	 * @param string $field
	 */
	public function setField( string $field ): void {
		$this->field = $field;
	}
}