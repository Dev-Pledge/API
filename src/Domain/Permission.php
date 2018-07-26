<?php


namespace DevPledge\Domain;

/**
 * Class Permission
 * @package DevPledge\Domain
 */
class Permission extends AbstractDomain {
	/**
	 * Permission constructor.
	 *
	 * @param string $entity
	 */
	public function __construct( string $entity = 'permission' ) {
		parent::__construct( $entity );
	}

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
	 * @var string
	 */
	protected $action;


	const ACTION_TYPES = [ 'create', 'read', 'write', 'delete' ];

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'permission_id' => $this->getId(),
			'user_id'       => $this->getUserId(),
			'resource'      => $this->getResource(),
			'resource_id'   => $this->getResourceId(),
			'action'        => $this->getAction()
		];
	}

	/**
	 * @return string
	 */
	public function getUserId(): string {
		return $this->userId;
	}

	/**
	 * @param string $userId
	 *
	 * @return Permission
	 */
	public function setUserId( string $userId ): Permission {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getResource(): string {
		return $this->resource;
	}

	/**
	 * @param string $resource
	 *
	 * @return Permission
	 */
	public function setResource( string $resource ): Permission {
		$this->resource = $resource;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getResourceId(): ?string {
		return $this->resourceId;
	}

	/**
	 * @param null|string $resourceId
	 *
	 * @return Permission
	 */
	public function setResourceId( ?string $resourceId ): Permission {
		$this->resourceId = $resourceId;

		return $this;
	}

	/**
	 * @param string $action
	 *
	 * @return Permission
	 */
	public function setAction( string $action ): Permission {
		if ( in_array( $action, static::ACTION_TYPES ) ) {
			$this->action = $action;
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAction(): string {

		return $this->action;
	}


}