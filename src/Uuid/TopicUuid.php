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
	 * @param null|string $prefix
	 */
	public function __construct( string $uuid, ?string $prefix = 'top' ) {
		parent::__construct( $uuid, $prefix );
	}

	/**
	 * @param string $uuid
	 */
	public function setUuid( string $uuid ): void {
		$this->uuid = str_replace( [ '|', '%', ' ', '+' ], '-', urlencode( $uuid ) );
	}

}