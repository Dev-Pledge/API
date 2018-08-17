<?php


namespace DevPledge\Domain;

/**
 * Class PaymentMethod
 * @package DevPledge\Domain
 */
class PaymentMethod extends AbstractDomain {
	/**
	 * @var string
	 */
	protected $userId;
	/**
	 * @var string | null
	 */
	protected $organisationId;
	/**
	 * @var string
	 */
	protected $gateway;
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @return null|string
	 */
	public function getCardReference(): ?string {
		$data = $this->getData()->getData();
		if ( isset( $data->cardReference ) ) {
			return $data->cardReference;
		}
		if ( isset( $data->customerReference ) ) {
			return $data->customerReference;
		}

		return null;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'payment_method_id' => $this->getId(),
			'user_id'          => $this->getUserId(),
			'organisation_id'  => $this->getOrganisationId(),
			'gateway'          => $this->getGateway(),
			'name'             => $this->getName(),
			'data'             => $this->getData()->getJson(),
			'created'          => $this->getCreated()->format( 'Y-m-d H:i:s' ),
			'modified'         => $this->getModified()->format( 'Y-m-d H:i:s' )
		];
	}

	/**
	 * @return null| string
	 */
	public function getUserId(): ?string {
		return $this->userId;
	}

	/**
	 * @param string | null $userId
	 *
	 * @return PaymentMethod
	 */
	public function setUserId( ?string $userId ): PaymentMethod {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @param null|string $organisationId
	 *
	 * @return PaymentMethod
	 */
	public function setOrganisationId( ?string $organisationId ): PaymentMethod {
		$this->organisationId = $organisationId;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getOrganisationId(): ?string {
		return $this->organisationId;
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
	 * @return PaymentMethod
	 */
	public function setGateway( string $gateway ): PaymentMethod {
		$this->gateway = $gateway;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return PaymentMethod
	 */
	public function setName( string $name ): PaymentMethod {
		$this->name = $name;

		return $this;
	}
}