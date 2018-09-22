<?php

namespace DevPledge\Integrations\Route;


class AvailableRoute implements \JsonSerializable {
	protected $type;
	protected $fullPattern;
	protected $request;
	protected $response;

	/**
	 * AvailableRoute constructor.
	 *
	 * @param $type
	 * @param $fullPattern
	 * @param null $request
	 * @param null $response
	 */
	public function __construct( string $type, string $fullPattern, \stdClass $request = null, \stdClass $response = null ) {
		$this->type        = $type;
		$this->fullPattern = $fullPattern;
		$this->response    = $response;
		$this->request     = $request;
	}

	public function getType(): string {
		return strtoupper( $this->type );
	}

	/**
	 * @return string
	 */
	public function getFullPattern(): string {
		return $this->fullPattern;
	}

	/**
	 * @return null|\stdClass|string
	 */
	public function getRequest(): ?\stdClass {
		return $this->request;
	}

	/**
	 * @return null|\stdClass|string
	 */
	public function getResponse(): ?\stdClass {
		return $this->response;
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		return [
			'http'             => $this->getType(),
			'path'             => $this->getFullPattern(),
			'example_request'  => $this->getRequest(),
			'example_response' => $this->getResponse()
		];
	}
}