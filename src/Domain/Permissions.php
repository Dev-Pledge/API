<?php

namespace DevPledge\Domain;

use DevPledge\Framework\FactoryDependencies\PermissionFactoryDependency;

/**
 * Class Permissions
 * @package DevPledge\Domain
 */
class Permissions extends AbstractDomain implements \JsonSerializable {
	/**
	 * @var Permission[]
	 */
	protected $permissions = [];

	/**
	 * Permissions constructor.
	 *
	 * @param array|null $permissions
	 *
	 */
	public function __construct( array $permissions = null ) {
		parent::__construct( 'permission' );
		if ( is_array( $permissions ) ) {
			$this->setPermissions( $permissions );
		}
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		$returnArray = [];

		if ( $this->permissions ) {
			foreach ( $this->permissions as $permission ) {
				$returnArray[] = $permission->toPersistMap();
			}
		}

		return $returnArray;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) $this->jsonSerialize();
	}

	/**
	 * @return array
	 */
	function toAPIMapArray(): array {
		$returnArray = [];

		if ( $this->permissions ) {
			foreach ( $this->permissions as $permission ) {
				$returnArray[] = $permission->toAPIMap();
			}
		}

		return $returnArray;
	}

	/**
	 * @param array $permissions
	 *
	 * @return Permissions
	 */
	public function setPermissions( array $permissions ): Permissions {
		$permissionFactory = PermissionFactoryDependency::getFactory();
		$this->permissions = [];
		if ( count( $permissions ) ) {
			foreach ( $permissions as $rawData ) {
				if ( ! ( $rawData instanceof Permission ) ) {
					$this->permissions[] = $permissionFactory->create( $rawData );
				} else {
					$this->permissions[] = $rawData;
				}
			}
		}

		return $this;
	}

	/**
	 * @return Permission[]
	 */
	public function getPermissions(): array {

		return $this->permissions;
	}

	/**
	 * @param string $resource
	 * @param string $action
	 * @param null $resourceId
	 *
	 * @return Permission|null
	 */
	public function getPermission( string $resource, string $action, $resourceId = null ): ?Permission {
		$permissions = $this->getPermissions();

		if ( count( $permissions ) ) {
			foreach ( $permissions as $permission ) {
				if ( $permission->getResource() == $resource && $permission->getResourceId() == $resourceId && $permission->getAction() == $action ) {
					return $permission;
				}
			}
		}

		return null;
	}

	/**
	 * @param string $resource
	 * @param string $action
	 * @param null $resourceId
	 *
	 * @return bool
	 */
	public function has( string $resource, string $action, $resourceId = null ): bool {
		return ! is_null( $this->getPermission( $resource, $action, $resourceId ) );
	}


}