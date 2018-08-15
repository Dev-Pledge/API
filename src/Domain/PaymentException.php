<?php


namespace DevPledge\Domain;


use Throwable;

/**
 * Class PaymentException
 * @package DevPledge\Domain
 */
class PaymentException extends \Exception {
	protected $redirectUrl;

	public function __construct( string $message = "", ?string $redirectUrl = null, int $code = 0, Throwable $previous = null ) {
		$this->redirectUrl = $redirectUrl;
		parent::__construct( $message, $code, $previous );
	}

	/**
	 * @return bool
	 */
	public function isRedirect(): bool {
		return (bool) isset( $this->redirectUrl );
	}

	/**
	 * @return null|string
	 */
	public function getRedirectUrl(): ?string {
		return $this->redirectUrl;
	}
}