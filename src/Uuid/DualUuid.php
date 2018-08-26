<?php

namespace DevPledge\Uuid;
/**
 * Class DualUuid
 * @package DevPledge\Uuid
 */
class DualUuid {
	/**
	 * @var Uuid
	 */
	protected $uuid1;
	/**
	 * @var Uuid
	 */
	protected $uuid2;

	/**
	 * DualUuid constructor.
	 *
	 * @param string $uuid1
	 * @param string $uuid2
	 */
	public function __construct( string $uuid1, string $uuid2 ) {
		$this->uuid1 = new Uuid( $uuid1 );
		$this->uuid2 = new Uuid( $uuid2 );
	}

	/**
	 * @return string
	 */
	public function getPrimaryId(): string {
		return $this->uuid1->toString();
	}

	/**
	 * @return string
	 */
	public function getSecondaryId(): string {
		return $this->uuid1->toString();
	}

	/**
	 * @return string
	 */
	public function getPrimaryIdEntity(): string {
		return $this->uuid1->getEntity();
	}

	/**
	 * @return string
	 */
	public function getSecondaryIdEntity(): string {
		return $this->uuid2->getEntity();
	}
}