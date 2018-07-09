<?php


namespace DevPledge\Domain;

/**
 * Class Data
 * @package DevPledge\Domain
 */
class Data {
	protected $jsonData;

	/**
	 * Data constructor.
	 *
	 * @param string $jsonData
	 */
	public function __construct( $jsonData = '{}' ) {
		$this->jsonData = $jsonData;
	}

	/**
	 * @return \stdClass
	 */
	public function getData() {
		return \json_decode( $this->jsonData );
	}

	/**
	 * @return string
	 */
	public function getJson() {
		return \json_encode( $this->getData() );
	}
}