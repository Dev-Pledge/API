<?php

namespace DevPledge\Domain\Role;


use DevPledge\Domain\Permissions;

interface Role {
	/**
	 * @return string
	 */
	public function toString(): string;

	public function getDefaultPermissions(): Permissions;

}