<?php

namespace DevPledge\Application\Repository;

use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Application\Factory\PermissionFactory;
use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Permissions;
use DevPledge\Domain\User;
use DevPledge\Framework\Adapter\Adapter;

/**
 * Class PermissionRepository
 * @package DevPledge\Application\Repository
 */
class PermissionRepository extends AbstractRepository {
	/**
	 * PermissionRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param PermissionFactory $factory
	 */
	public function __construct( Adapter $adapter, PermissionFactory $factory ) {
		parent::__construct( $adapter, $factory );
	}

	/**
	 * @param AbstractDomain $domain
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function createPersist( AbstractDomain $domain ): AbstractDomain {

		if ( ! ( $domain instanceof User ) ) {
			throw new \Exception( 'Not User Domain' );
		}

		/**
		 * @var $permissions Permissions
		 */
		$permissions      = call_user_func( [ $domain, 'getPermissions' ] );
		$permissionsArray = $permissions->getPermissions();
		if ( is_array( $permissionsArray ) && count( $permissionsArray ) ) {
			foreach ( $permissionsArray as $permission ) {
				parent::createPersist( $permission );
			}
		}


		return new Permissions( parent::readAll( $domain->getUserId() ) );
	}

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'permissions';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'permission_id';
	}

	/**
	 * @return string
	 */
	protected function getAllColumn(): string {
		return 'user_id';
	}

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return null;
	}
}