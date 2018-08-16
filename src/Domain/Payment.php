<?php

namespace DevPledge\Domain;

use DevPledge\Application\Service\CurrencyService;

/**
 * Class Payment
 * @package DevPledge\Domain
 */
class Payment extends AbstractDomain {
	/**
	 * @var string
	 */
	protected $userId;
	/**
	 * @var string | null
	 */
	protected $organisationId;
	/**
	 * @var CurrencyValue
	 */
	protected $currencyValue;
	/**
	 * @var string
	 */
	protected $reference;
	/**
	 * @var string
	 */
	protected $gateway;
	/**
	 * @var bool
	 */
	protected $refunded = false;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {

		return (object) [
			'payment_id'      => $this->getId(),
			'user_id'         => $this->getUserId(),
			'organisation_id' => $this->getOrganisationId(),
			'value'           => $this->getCurrencyValue()->getValue(),
			'currency'        => $this->getCurrencyValue()->getCurrency(),
			'gateway'         => $this->getGateway(),
			'reference'       => $this->getReference(),
			'data'            => $this->getData()->getJson(),
			'created'         => $this->getCreated()->format( 'Y-m-d H:i:s' ),
			'modified'        => $this->getModified()->format( 'Y-m-d H:i:s' ),
		];
	}


	/**
	 * @return string
	 */
	public function getUserId(): string {
		return $this->userId;
	}

	/**
	 * @param string $userId
	 *
	 * @return Payment
	 */
	public function setUserId( string $userId ): Payment {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @return string | null
	 */
	public function getOrganisationId(): ?string {
		return $this->organisationId;
	}

	/**
	 * @param string $organisationId
	 *
	 * @return Payment
	 */
	public function setOrganisationId( ?string $organisationId ): Payment {
		$this->organisationId = $organisationId;

		return $this;
	}

	/**
	 * @return CurrencyValue
	 */
	public function getCurrencyValue(): CurrencyValue {
		return isset( $this->currencyValue ) ? $this->currencyValue : new CurrencyValue( CurrencyService::SITE_CURRENCY, 0 );
	}

	/**
	 * @param CurrencyValue $currencyValue
	 *
	 * @return Payment
	 */
	public function setCurrencyValue( CurrencyValue $currencyValue ): Payment {
		$this->currencyValue = $currencyValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getReference(): string {
		return $this->reference;
	}

	/**
	 * @param string $reference
	 *
	 * @return Payment
	 */
	public function setReference( string $reference ): Payment {
		$this->reference = $reference;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getGateway(): string {
		return $this->gateway;
	}

	/**
	 * @param string $gateway
	 *
	 * @return Payment
	 */
	public function setGateway( string $gateway ): Payment {
		$this->gateway = $gateway;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isRefunded(): bool {
		return $this->refunded;
	}

	/**
	 * @param int $refunded
	 *
	 * @return Payment
	 */
	public function setRefunded( int $refunded ): Payment {
		$this->refunded = (bool) $refunded;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getRefunded() {
		return (int) ( $this->refunded ? 1 : 0 );
	}
}