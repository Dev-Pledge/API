<?php


namespace DevPledge\Domain;

/**
 * Class Data
 * @package DevPledge\Domain
 */
class Data {
	/**
	 * @var string
	 */
	protected $jsonData;

	/**
	 * Data constructor.
	 *
	 * @param string $jsonData
	 */
	public function __construct( string $jsonData = '{}' ) {
		$this->jsonData = $jsonData;
	}

	/**
	 * @return \stdClass
	 */
	public function getData(): \stdClass {
		return \json_decode( $this->jsonData );
	}

	/**
	 * @return string
	 */
	public function getJson(): string {
		return \json_encode( $this->getData() );
	}

	/**
	 * @param $data
	 *
	 * @return Data
	 */
	public function setData( \stdClass $data ): Data {

		$this->jsonData = \json_encode( $data );

		return $this;
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return Data
	 */
	public function addDataByKey( $key, $value ): Data {
		$data         = $this->getData() ?? new \stdClass();
		$data->{$key} = $value;
		$this->setData( $data );

		return $this;
	}
}