<?php

namespace DevPledge\Domain;

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
	 * @throws \Exception
	 */
	public function __construct( array $permissions = null ) {
		parent::__construct( 'permission' );
		if ( ! is_null( $permissions ) ) {
			foreach ( $permissions as $permission ) {
				if ( ! ( $permission instanceof Permission ) ) {
					throw new \Exception( 'Not Permission' );
				}
			}
			$this->permissions = $permissions;
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
				$returnArray[] = $permission->toAPIMap();
			}
		}

		return $returnArray;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return $this->jsonSerialize();
	}

	/**
	 * @return Permission[]
	 */
	public function getPermissions(): array {
		return $this->permissions;
	}
}