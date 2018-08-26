<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\DualUuid;

/**
 * Class Follow
 * @package DevPledge\Domain
 */
class Follow extends AbstractDomain {
	/**
	 * @var DualUuid
	 */
	protected $dualUuid;

	/**
	 * @return string
	 */
	public function getUserId(): string {
		return $this->getDualUuid()->getPrimaryId();
	}

	/**
	 * @return string
	 */
	public function getId(): string {
		return $this->getDualUuid()->getSecondaryId();
	}

	/**
	 * @return string
	 */
	public function getEntity(): string {
		return $this->getDualUuid()->getSecondaryIdEntity();
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'user_id' => $this->getUserId(),
			'id'      => $this->getId(),
			'entity'  => $this->getEntity(),
			'created' => $this->getCreated()
		];
	}

	/**
	 * @return DualUuid
	 */
	public function getDualUuid(): DualUuid {
		return $this->dualUuid;
	}

	/**
	 * @param DualUuid $dualUuid
	 *
	 * @return Follow
	 */
	public function setDualUuid( DualUuid $dualUuid ): Follow {
		$this->dualUuid = $dualUuid;

		return $this;
	}


}