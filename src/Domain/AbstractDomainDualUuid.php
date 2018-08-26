<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\DualUuid;

/**
 * Class AbstractDomainDualUuid
 * @package DevPledge\Domain
 */
abstract class AbstractDomainDualUuid extends AbstractDomain {
	/**
	 * @var DualUuid
	 */
	protected $dualUuid;

	/**
	 * @return string
	 */
	public function getId(): string {
		return $this->getDualUuid()->toString();
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
	public function setDualUuid( DualUuid $dualUuid ): AbstractDomainDualUuid {
		$this->dualUuid = $dualUuid;

		return $this;
	}
}