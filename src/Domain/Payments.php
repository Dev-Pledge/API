<?php

namespace DevPayment\Domain;

use DevPledge\Domain\Payment;

/**
 * Class Payments
 * @package DevPayment\Domain
 */
class Payments extends AbstractDomain {
	/**
	 * @var Payment[]
	 */
	protected $payments = [];

	/**
	 * Payments constructor.
	 *
	 * @param array $payments
	 *
	 * @throws \Exception
	 */
	public function __construct( array $payments ) {
		$this->setPayments( $payments );
	}

	/**
	 * @param array $payments
	 *
	 * @return Payments
	 * @throws \Exception
	 */
	public function setPayments( array $payments ): Payments {
		foreach ( $payments as $payment ) {
			if ( ! $payment instanceof Payment ) {
				throw new \Exception( 'Not Payment Method' );
			}
		}
		$this->payments = $payments;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();

		$data->payments = [];
		if ( $this->payments ) {
			foreach ( $this->payments as $payment ) {
				$data->payments[] = $payment->toPersistMap();
			}
		}

		return $data;
	}

	/**
	 * @return \stdClass
	 */
	public function toAPIMap(): \stdClass {
		$data = new \stdClass();

		$data->payments = [];
		if ( $this->payments ) {
			foreach ( $this->payments as $payment ) {
				$data->payments[] = $payment->toPublicAPIMap();
			}
		}

		return $data;
	}

	/**
	 * @return array
	 */
	public function toAPIMapArray(): array {
		return $this->toAPIMap()->payments;
	}

	/**
	 * @param string $paymentId
	 *
	 * @return null|Payment
	 */
	public function getPayment( string $paymentId ): ?Payment {
		if ( $this->payments ) {
			foreach ( $this->payments as &$method ) {
				if ( $method->getId() == $paymentId ) {
					return $method;
				}
			}
		}

		return null;
	}
}