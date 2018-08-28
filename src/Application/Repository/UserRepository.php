<?php

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Permissions;
use DevPledge\Domain\User;
use DevPledge\Framework\Adapter\Adapter;

/**
 * Class UserRepository
 * @package DevPledge\Application\Repository
 */
class UserRepository extends AbstractRepository {

	/**
	 * UserRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param UserFactory $factory
	 */
	public function __construct( Adapter $adapter, UserFactory $factory ) {
		$this->adapter = $adapter;
		$this->factory = $factory;

	}

	/**
	 * @param string $username
	 *
	 * @return User
	 */
	public function readByUsername( string $username ): User {
		$data = $this->adapter->read( 'users', $username, 'username' ) ?? new \stdClass();

		return $this->readAppendExistingPermissions( $this->factory->createFromPersistedData( $data ) );
	}

	/**
	 * @param int $gitHubId
	 *
	 * @return User
	 */
	public function readByGitHubId( int $gitHubId ): User {
		$data = $this->adapter->read( 'users', $gitHubId, 'github_id' );

		return $this->readAppendExistingPermissions( $this->factory->createFromPersistedData( $data ) );
	}


	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'users';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'user_id';
	}

	protected function getAllColumn(): string {
		return 'user_id';
	}

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return null;
	}

	/**
	 * @param $userId
	 *
	 * @return Permissions
	 */
	protected function getUserPermissions( $userId ): Permissions {
		$data = $this->adapter->readAll( 'permissions', $userId, 'user_id' );

		return new Permissions( $data );
	}

	/**
	 * @param User $user
	 * @param Permissions $permissions
	 *
	 * @return User
	 * @throws \Exception
	 */
	public function createNewPermissions( User $user, Permissions $permissions ): User {
		$perms = $permissions->getPermissions();
		if ( count( $perms ) ) {
			foreach ( $perms as $perm ) {
				$perm->setUserId( $user->getId() );
				$this->adapter->create( 'permissions', $perm->toPersistMap() );
			}
		}

		return $this->readAppendExistingPermissions( $user );

	}

	/**
	 * @param User $user
	 *
	 * @return User
	 */
	public function readAppendExistingPermissions( User $user ): User {
		return $user->setPermissions( $this->getUserPermissions( $user->getId() ) );
	}
}