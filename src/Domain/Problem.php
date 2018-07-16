<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 15/07/2018
 * Time: 20:36
 */

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

	function toMap(): \stdClass {
		return (object) [
			'problem_id'    => $this->getId(),
			'user_id'       => $this->getUserId(),
			'title'         => $this->getTitle(),
			'description'   => $this->getDescription(),
			'specification' => $this->getSpecification(),
			'data'          => $this->getData()->getJson(),
			'modified'      => $this->getModified()->format( 'Y-m-d H:i:s' ),
			'created'       => $this->getCreated()->format( 'Y-m-d H:i:s' ),
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
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription( string $description ): void {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getSpecification(): string {
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
	 * @return string
	 */
	public function getActiveDatetime(): string {
		return $this->activeDatetime;
	}

	/**
	 * @param string $activeDatetime
	 *
	 * @return $this
	 */
	public function setActiveDatetime( string $activeDatetime ) {
		$this->activeDatetime = $activeDatetime;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDeadlineDatetime(): string {
		return $this->deadlineDatetime;
	}

	/**
	 * @param string $deadlineDatetime
	 *
	 * @return $this
	 */
	public function setDeadlineDatetime( string $deadlineDatetime ) {
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
	 */
	public function setDeleted( bool $deleted ): void {
		$this->deleted = $deleted;

		return $this;
	}
}