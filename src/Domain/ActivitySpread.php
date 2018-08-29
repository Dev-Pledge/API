<?php

namespace DevPledge\Domain;


class ActivitySpread {
	/**
	 * @var string
	 */
	protected $id;
	/**
	 * @var string | null
	 */
	protected $parentId;
	/**
	 * @var AbstractDomain
	 */
	protected $domain;
	/**
	 * @var string | null
	 */
	protected $userId;
	/**
	 * @var Topics | null
	 */
	protected $topics;
	/**
	 * @var string | null
	 */
	protected $solutionGroupId;
	/**
	 * @var string |null
	 */
	protected $organisationId;

	/**
	 * ActivitySpread constructor.
	 *
	 * @param AbstractDomain $domain
	 */
	public function __construct( AbstractDomain $domain ) {
		$this->setDomain( $domain );
	}

	/**
	 * @param AbstractDomain $domain
	 *
	 * @return $this
	 */
	public function setDomain( AbstractDomain $domain ): ActivitySpread {
		$this->id = $domain->getId();
		if ( is_callable( [ $domain, 'getUserId' ] ) ) {

			$this->userId = $domain->getUserId();
		}
		if ( is_callable( [ $domain, 'getTopics' ] ) ) {

			$this->topics = $domain->getTopics();
		}
		if ( is_callable( [ $domain, 'getSolutionGroupId' ] ) ) {

			$this->solutionGroupId = $domain->getSolutionGroupId();
		}
		if ( is_callable( [ $domain, 'getOrganisationId' ] ) ) {

			$this->organisationId = $domain->getOrganisationId();
		}


		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getId(): string {
		return $this->id;
	}

	/**
	 * @return AbstractDomain
	 */
	public function getDomain(): AbstractDomain {
		return $this->domain;
	}

	/**
	 * @return null|string
	 */
	public function getUserId(): ?string {
		return $this->userId;
	}

	/**
	 * @return Topics|null
	 */
	public function getTopics(): ?Topics {
		return $this->topics;
	}

	/**
	 * @return null|string
	 */
	public function getSolutionGroupId(): ?string {
		return $this->solutionGroupId;
	}

	/**
	 * @return null|string
	 */
	public function getOrganisationId(): ?string {
		return $this->organisationId;
	}

	/**
	 * @param string $feedFunction
	 *
	 * @return \stdClass
	 */
	public function toFeed( string $feedFunction ): \stdClass {
		$ids   = [];
		$ids[] = $this->getId();
		if ( ! is_null( $this->getTopics() ) ) {

			$topics = $this->getTopics();
			$tops   = $topics->getTopics();
			foreach ( $tops as $top ) {
				$ids[] = $top->getId();
			}
		}
		if ( ! is_null( $this->getUserId() ) ) {
			$ids[] = $this->getUserId();
		}
		if ( ! is_null( $this->getSolutionGroupId() ) ) {
			$ids[] = $this->getSolutionGroupId();
		}
		if ( ! is_null( $this->getOrganisationId() ) ) {
			$ids[] = $this->getOrganisationId();
		}

		return (object) [
			'user_id'     => $this->getUserId(),
			'id'          => $this->getId(),
			'parent_id'   => $this->getParentId(),
			'related_ids' => $ids,
			'function'    => $feedFunction
		];
	}

	/**
	 * @param null|string $parentId
	 *
	 * @return ActivitySpread
	 */
	public function setParentId( ?string $parentId ): ActivitySpread {
		$this->parentId = $parentId;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getParentId(): ?string {
		return $this->parentId;
	}

}