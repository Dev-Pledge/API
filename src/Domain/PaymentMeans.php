<?php


namespace DevPledge\Domain;

/**
 * Class PaymentMeans
 * @package DevPledge\Domain
 */
class PaymentMeans extends AbstractDomain {
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
			'payment_means_id' => $this->getId(),
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
	 * @return string
	 */
	public function getUserId(): string {
		return $this->userId;
	}

	/**
	 * @param string $userId
	 *
	 * @return PaymentMeans
	 */
	public function setUserId( string $userId ): PaymentMeans {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @param null|string $organisationId
	 *
	 * @return PaymentMeans
	 */
	public function setOrganisationId( ?string $organisationId ): PaymentMeans {
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
	 * @return PaymentMeans
	 */
	public function setGateway( string $gateway ): PaymentMeans {
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
	 * @return PaymentMeans
	 */
	public function setName( string $name ): PaymentMeans {
		$this->name = $name;

		return $this;
	}
}