<?php

namespace DevPledge\Uuid;

/**
 * Class TopicUuid
 * @package DevPledge\Uuid
 */
class TopicUuid extends Uuid {
	/**
	 * @var int
	 */
	protected static $uuidParts = 1;

	/**
	 * TopicUuid constructor.
	 *
	 * @param string $uuid
	 */
	public function __construct( string $uuid ) {
		parent::__construct( $uuid, 'top' );
	}

	/**
	 * @param string $uuid
	 */
	public function setUuid( string $uuid ): void {
		$this->uuid = $uuid;
	}

}