<?php


namespace DevPledge\Domain;

/**
 * Class Permission
 * @package DevPledge\Domain
 */
class Permission extends AbstractDomain {
	/**
	 * @var string
	 */
	protected $userId;
	/**
	 * @var string
	 */
	protected $resource;

	/**
	 * @var string | null
	 */
	protected $resourceId;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		// TODO: Implement toPersistMap() method.
	}

	/**
	 * @return string
	 */
	public function getUserId(): string {
		return $this->userId;
	}

	/**
	 * @param string $userId
	 */
	public function setUserId( string $userId ): void {
		$this->userId = $userId;
	}

	/**
	 * @return string
	 */
	public function getResource(): string {
		return $this->resource;
	}

	/**
	 * @param string $resource
	 */
	public function setResource( string $resource ): void {
		$this->resource = $resource;
	}

	/**
	 * @return null|string
	 */
	public function getResourceId(): ?string {
		return $this->resourceId;
	}

	/**
	 * @param null|string $resourceId
	 */
	public function setResourceId( ?string $resourceId ): void {
		$this->resourceId = $resourceId;
	}


}