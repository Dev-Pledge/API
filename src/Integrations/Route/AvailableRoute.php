<?php

namespace DevPledge\Integrations\Route;

/**
 * Class AvailableRoute
 * @package DevPledge\Integrations\Route
 */
class AvailableRoute implements \JsonSerializable {
	protected $type;
	protected $fullPattern;
	protected $request;
	protected $response;
	protected $middleWares = [];

	/**
	 * AvailableRoute constructor.
	 *
	 * @param string $type
	 * @param string $fullPattern
	 * @param \Closure|null $request
	 * @param \Closure|null $response
	 * @param array $middleWares
	 */
	public function __construct( string $type, string $fullPattern, ?\Closure $request = null, ?\Closure $response = null, array $middleWares = [] ) {
		$this->type        = $type;
		$this->fullPattern = $fullPattern;
		$this->response    = $response;
		$this->request     = $request;
		$this->middleWares = $middleWares;
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
	 * @return \Closure|null
	 */
	public function getRequest(): ?\Closure {
		return isset( $this->request ) ? $this->request : function () {
			if ( $this->getType() != 'GET' ) {
				return 'coming soon';
			}

			return null;
		};
	}

	/**
	 * @return \Closure|null
	 */
	public function getResponse(): ?\Closure {

		return isset( $this->response ) ? $this->response : function () {

			return 'coming soon';

		};
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		$authRequirements = null;
		$middleWares      = $this->getMiddleWares();
		foreach ( $middleWares as $middleWare ) {
			if ( $middleWare instanceof MiddleWareAuthRequirement ) {
				if ( is_null( $authRequirements ) ) {
					$authRequirements = [];
				}
				$authRequirements = array_merge( $authRequirements, $middleWare->getAuthRequirement() );
			}
		}

		return [
			'http'             => $this->getType(),
			'path'             => $this->getFullPattern(),
			'example_request'  => $this->getRequest()(),
			'example_response' => $this->getResponse()(),
			'requirements'     => $authRequirements
		];
	}

	/**
	 * @return null|string
	 */
	public function getMiddleWares(): array {
		return $this->middleWares;
	}
}