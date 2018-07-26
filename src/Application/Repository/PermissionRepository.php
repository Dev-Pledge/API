<?php

namespace DevPledge\Application\Repository;
use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Application\Factory\PermissionFactory;
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