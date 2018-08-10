<?php

namespace DevPledge\Domain;

/**
 * Class Count
 * @package DevPledge\Domain
 */
class Count {
	/**
	 * @var int
	 */
	protected $count = 0;

	public function __construct( int $count ) {
		$this->setCount( $count );
	}

	/**
	 * @return int
	 */
	public function getCount(): int {
		return $this->count;
	}

	/**
	 * @param int $count
	 */
	public function setCount( int $count ): void {
		$this->count = $count;
	}
}