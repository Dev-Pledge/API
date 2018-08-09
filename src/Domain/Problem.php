<?php

namespace DevPledge\Domain;

/**
 * Class Problem
 * @package DevPledge\Domain
 */
class Problem extends AbstractDomain {
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
	protected $title;
	/**
	 * @var string
	 */
	protected $description;
	/**
	 * @var string
	 */
	protected $specification;
	/**
	 * @var \DateTime
	 */
	protected $activeDatetime;
	/**
	 * @var \DateTime | null
	 */
	protected $deadlineDatetime;
	/**
	 * @var bool
	 */
	protected $deleted = false;
	/**
	 * @var Topics
	 */
	protected $topics;
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var Solutions
	 */
	protected $solutions;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'problem_id'        => $this->getId(),
			'user_id'           => $this->getUserId(),
			'title'             => $this->getTitle(),
			'description'       => $this->getDescription(),
			'specification'     => $this->getSpecification(),
			'data'              => $this->getData()->getJson(),
			'active_datetime'   => $this->dateTimeStringOrNull( $this->getActiveDatetime() ),
			'deadline_datetime' => $this->dateTimeStringOrNull( $this->getDeadlineDatetime() ),
			'deleted'           => $this->boolAsTinyInt( $this->isDeleted() ),
			'modified'          => $this->getModified()->format( 'Y-m-d H:i:s' ),
			'created'           => $this->getCreated()->format( 'Y-m-d H:i:s' )
		];
	}

	/**
	 * @return \stdClass
	 * @throws \Exception
	 */
	public function toAPIMap(): \stdClass {
		$data            = parent::toAPIMap();
		$data->topics    = $this->getTopics()->toArray();
		$data->solutions = $this->getSolutions()->toAPIMapArray();
		$data->user      = $this->getUser()->toPublicAPIMap();

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
	 * @return $this
	 */
	public function setUserId( string $userId ) {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return $this
	 */
	public function setTitle( string $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): ?string {
		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return $this
	 */
	public function setDescription( string $description ) {
		$this->description = $description;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getSpecification(): ?string {
		return $this->specification;
	}

	/**
	 * @param string $specification
	 *
	 * @return $this
	 */
	public function setSpecification( string $specification ) {
		$this->specification = $specification;

		return $this;
	}

	/**
	 * @return \DateTime | null
	 */
	public function getActiveDatetime(): ?\DateTime {
		return $this->activeDatetime;
	}

	/**
	 * @param \DateTime $activeDatetime
	 *
	 * @return $this
	 */
	public function setActiveDatetime( \DateTime $activeDatetime ) {
		$this->activeDatetime = $activeDatetime;

		return $this;
	}

	/**
	 * @return \DateTime | null
	 */
	public function getDeadlineDatetime(): ?\DateTime {
		return $this->deadlineDatetime;
	}

	/**
	 * @param \DateTime $deadlineDatetime
	 *
	 * @return $this
	 */
	public function setDeadlineDatetime( \DateTime $deadlineDatetime ) {
		$this->deadlineDatetime = $deadlineDatetime;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDeleted(): bool {
		return $this->deleted;
	}

	/**
	 * @param bool $deleted
	 *
	 * @return Problem
	 */
	public function setDeleted( bool $deleted ): Problem {
		$this->deleted = $deleted;

		return $this;
	}

	/**
	 * @param Topics $topics
	 *
	 * @return Problem
	 */
	public function setTopics( Topics $topics ): Problem {
		$this->topics = $topics;

		return $this;
	}

	/**
	 * @return Topics
	 */
	public function getTopics(): Topics {

		return isset( $this->topics ) ? $this->topics : new Topics( [] );
	}


	/**
	 * @return string
	 */
	public function getOrganisationId(): string {
		return $this->organisationId;
	}

	/**
	 * @param string $organisationId
	 *
	 * @return Problem
	 */
	public function setOrganisationId( string $organisationId ): Problem {
		$this->organisationId = $organisationId;

		return $this;
	}

	/**
	 * @return Solutions
	 * @throws \Exception
	 */
	public function getSolutions(): Solutions {
		return isset( $this->solutions ) ? $this->solutions : new Solutions( [] );
	}

	/**
	 * @param Solutions $solutions
	 *
	 * @return Problem
	 */
	public function setSolutions( Solutions $solutions ): Problem {
		$this->solutions = $solutions;

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
	 * @return Problem
	 */
	public function setUser( ?User $user ): Problem {
		$this->user = $user;

		return $this;
	}
}