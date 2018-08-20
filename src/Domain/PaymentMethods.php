<?php

namespace DevPaymentMethod\Domain;

use DevPledge\Domain\PaymentMethod;

/**
 * Class PaymentMethods
 * @package DevPaymentMethod\Domain
 */
class PaymentMethods extends AbstractDomain {
	/**
	 * @var PaymentMethod[]
	 */
	protected $paymentMethods = [];

	/**
	 * PaymentMethods constructor.
	 *
	 * @param array $paymentMethods
	 *
	 * @throws \Exception
	 */
	public function __construct( array $paymentMethods ) {
		$this->setPaymentMethods( $paymentMethods );
	}

	/**
	 * @param array $paymentMethods
	 *
	 * @return PaymentMethods
	 * @throws \Exception
	 */
	public function setPaymentMethods( array $paymentMethods ): PaymentMethods {
		foreach ( $paymentMethods as $paymentMethod ) {
			if ( ! $paymentMethod instanceof PaymentMethod ) {
				throw new \Exception( 'Not Payment Method' );
			}
		}
		$this->paymentMethods = $paymentMethods;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();

		$data->paymentMethods = [];
		if ( $this->paymentMethods ) {
			foreach ( $this->paymentMethods as $paymentMethod ) {
				$data->paymentMethods[] = $paymentMethod->toPersistMap();
			}
		}

		return $data;
	}

	/**
	 * @return \stdClass
	 */
	public function toAPIMap(): \stdClass {
		$data = new \stdClass();

		$data->paymentMethods = [];
		if ( $this->paymentMethods ) {
			foreach ( $this->paymentMethods as $paymentMethod ) {
				$data->paymentMethods[] = $paymentMethod->toPublicAPIMap();
			}
		}

		return $data;
	}

	/**
	 * @return array
	 */
	public function toAPIMapArray(): array {
		return $this->toAPIMap()->paymentMethods;
	}

	/**
	 * @param string $paymentMethodId
	 *
	 * @return null|PaymentMethod
	 */
	public function getPaymentMethod( string $paymentMethodId ): ?PaymentMethod {
		if ( $this->paymentMethods ) {
			foreach ( $this->paymentMethods as &$method ) {
				if ( $method->getId() == $paymentMethodId ) {
					return $method;
				}
			}
		}

		return null;
	}
}