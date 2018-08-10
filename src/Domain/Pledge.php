<?php

namespace DevPledge\Domain;


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
	 * @var float
	 */
	protected $value;
	/**
	 * @var string
	 */
	protected $currency;
	/**
	 * @var string
	 */
	protected $comment;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'pledge_id'       => $this->getId(),
			'user_id'         => $this->getUserId(),
			'organisation_id' => $this->getOrganisationId(),
			'problem_id'      => $this->getProblemId(),
			'kudos_point'     => $this->getKudosPoints(),
			'value'           => $this->getValue(),
			'currency'        => $this->getCurrency(),
			'comment'         => $this->getComment(),
			'data'            => $this->getData()->getJson(),
			'created'         => $this->getCreated()->format( 'Y-m-d H:i:s' ),
			'modified'        => $this->getModified()->format( 'Y-m-d H:i:s' ),
		];
	}

	/**
	 * @return \stdClass
	 */
	function toAPIMap(): \stdClass {
		$data       = parent::toAPIMap();
		$data->user = $this->getUser()->toAPIMap();

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
	 * @return string
	 */
	public function getKudosPoints(): string {
		return $this->kudosPoints;
	}

	/**
	 * @param string $kudosPoints
	 *
	 * @return Pledge
	 */
	public function setKudosPoints( string $kudosPoints ): Pledge {
		$this->kudosPoints = $kudosPoints;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue(): float {
		return $this->value;
	}

	/**
	 * @param float $value
	 *
	 * @return Pledge
	 */
	public function setValue( float $value ): Pledge {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCurrency(): string {
		return $this->currency;
	}

	/**
	 * @param string $currency
	 *
	 * @return Pledge
	 */
	public function setCurrency( string $currency ): Pledge {
		$this->currency = $currency;

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


}