<?php

namespace DevPledge\Domain\Role;


use DevPledge\Domain\Permission;
use DevPledge\Domain\Permissions;

/**
 * Class Member
 * @package DevPledge\Domain\Role
 */
class Member implements Role {

	public function toString(): string {
		return 'member';
	}

	/**
	 * @return Permissions
	 */
	public function getDefaultPermissions(): Permissions {
		return new Permissions( [
			( new Permission() )->setResource( 'problems' )->setAction( 'create' ),
			( new Permission() )->setResource( 'organisations' )->setAction( 'create' ),
			( new Permission() )->setResource( 'solutions' )->setAction( 'create' ),
		] );
	}
}