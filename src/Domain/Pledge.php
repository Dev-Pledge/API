<?php

namespace DevPledge\Domain;

/**
 * Class Pledge
 * @package DevPledge\Domain
 */
class Pledge extends AbstractDomain {
	/**
	 * @var string
	 */
	protected $userId;
	/**
	 * @var string
	 */
	protected $organisationId;
	/**
	 * @var string
	 */
	protected $problemId;
	/**
	 * @var int
	 */
	protected $kudosPoints;

	/**
	 * @var CurrencyValue
	 */
	protected $currencyValue;
	/**
	 * @var string
	 */
	protected $comment;
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var null| string
	 */
	protected $paymentReference;
	/**
	 * @var null | string
	 */
	protected $paymentGateway;
	/**
	 * @var null | string
	 */
	protected $solutionId;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'pledge_id'         => $this->getId(),
			'user_id'           => $this->getUserId(),
			'organisation_id'   => $this->getOrganisationId(),
			'problem_id'        => $this->getProblemId(),
			'kudos_points'      => $this->getKudosPoints(),
			'value'             => $this->getCurrencyValue()->getValue(),
			'currency'          => $this->getCurrencyValue()->getCurrency(),
			'comment'           => $this->getComment(),
			'data'              => $this->getData()->getJson(),
			'payment_gateway'   => $this->getPaymentGateway(),
			'payment_reference' => $this->getPaymentReference(),
			'solution_id'       => $this->getSolutionId(),
			'created'           => $this->getCreated()->format( 'Y-m-d H:i:s' ),
			'modified'          => $this->getModified()->format( 'Y-m-d H:i:s' ),
		];
	}

	/**
	 * @return \stdClass
	 */
	function toAPIMap(): \stdClass {
		$data              = parent::toAPIMap();
		$data->user        = $this->getUser()->toPublicAPIMap();
		$data->is_paid     = $this->isPaid();
		$data->is_verified = $this->isVerified();

		return $data;
	}

	/**
	 * @return \stdClass
	 */
	function toPublicAPIMap(): \stdClass {
		$data       = $this->toAPIMap();
		$data->user = $this->getUser()->toPublicAPIMap();
		$unsets     = [ 'data', 'payment_gateway', 'payment_reference' ];
		foreach ( $unsets as $unset ) {
			unset( $data->{$unset} );
		}


		return $data;
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
	 * @return Pledge
	 */
	public function setUserId( string $userId ): Pledge {
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
	 * @return Pledge
	 */
	public function setOrganisationId( string $organisationId ): Pledge {
		$this->organisationId = $organisationId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getProblemId(): string {
		return $this->problemId;
	}

	/**
	 * @param string $problemId
	 *
	 * @return Pledge
	 */
	public function setProblemId( string $problemId ): Pledge {
		$this->problemId = $problemId;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getKudosPoints(): int {
		return isset( $this->kudosPoints ) ? $this->kudosPoints : 0;
	}

	/**
	 * @param int $kudosPoints
	 *
	 * @return Pledge
	 */
	public function setKudosPoints( ?int $kudosPoints ): Pledge {
		$this->kudosPoints = $kudosPoints;

		return $this;
	}


	/**
	 * @return CurrencyValue
	 */
	public function getCurrencyValue(): CurrencyValue {
		return isset( $this->currencyValue ) ? $this->currencyValue : new CurrencyValue( 'USD', 0.00 );
	}

	/**
	 * @param CurrencyValue | null $currencyValue
	 *
	 * @return Pledge
	 */
	public function setCurrencyValue( ?CurrencyValue $currencyValue ): Pledge {
		$this->currencyValue = $currencyValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getComment(): string {
		return $this->comment;
	}

	/**
	 * @param string $comment
	 *
	 * @return Pledge
	 */
	public function setComment( string $comment ): Pledge {
		$this->comment = $comment;

		return $this;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @param User $user
	 *
	 * @return Pledge
	 */
	public function setUser( ?User $user ): Pledge {
		$this->user = $user;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getPaymentReference(): ?string {
		return $this->paymentReference;
	}

	/**
	 * @param null|string $paymentReference
	 *
	 * @return Pledge
	 */
	public function setPaymentReference( ?string $paymentReference ): Pledge {
		$this->paymentReference = $paymentReference;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isVerified() {
		return (bool) ( is_null( $this->solutionId ) && isset( $this->paymentReference ) );
	}

	/**
	 * @return bool
	 */
	public function isPaid() {
		return (bool) ( ! is_null( $this->solutionId ) && ! is_null( $this->paymentReference ) );
	}

	/**
	 * @return string | null
	 */
	public function getPaymentGateway() {
		return $this->paymentGateway;
	}

	/**
	 * @param $paymentGateway
	 *
	 * @return Pledge
	 */
	public function setPaymentGateway( ?string $paymentGateway ): Pledge {
		$this->paymentGateway = $paymentGateway;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getSolutionId(): ?string {
		return $this->solutionId;
	}

	/**
	 * @param null|string $solutionId
	 *
	 * @return Pledge
	 */
	public function setSolutionId( ?string $solutionId ): Pledge {
		$this->solutionId = $solutionId;

		return $this;
	}

}