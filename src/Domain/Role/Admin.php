<?php

namespace DevPledge\Domain\Role;


use DevPledge\Domain\Permissions;

/**
 * Class Admin
 * @package DevPledge\Domain\Role
 */
class Admin implements Role
{
	/**
	 * @return string
	 */
    public function toString(): string
    {
        return 'admin';
    }

	/**
	 * @return Permissions
	 * @throws \Exception
	 */
	public function getDefaultPermissions(): Permissions {


		return new Permissions( [
			( new Permission() )->setResource( 'users' )->setAction( 'read' ),
			( new Permission() )->setResource( 'users' )->setAction( 'create' ),
			( new Permission() )->setResource( 'problems' )->setAction( 'read' ),
			( new Permission() )->setResource( 'problems' )->setAction( 'create' ),
			( new Permission() )->setResource( 'organisations' )->setAction( 'read' ),
			( new Permission() )->setResource( 'organisations' )->setAction( 'create' ),
			( new Permission() )->setResource( 'solutions' )->setAction( 'read' ),
			( new Permission() )->setResource( 'solutions' )->setAction( 'create' ),
		] );
	}
}