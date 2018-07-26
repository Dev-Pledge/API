<?php

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Domain\User;
use DevPledge\Framework\Adapter\Adapter;
use DevPledge\Framework\RepositoryDependencies\Permission\PermissionRepositoryDependency;

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
		$data = $this->adapter->read( 'users', $username, 'username' );

		return $this->factory->createFromPersistedData( $data );
	}

	/**
	 * @param int $gitHubId
	 *
	 * @return User
	 */
	public function readByGitHubId( int $gitHubId ): User {
		$data = $this->adapter->read( 'users', $gitHubId, 'github_id' );

		return $this->factory->createFromPersistedData( $data );
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
		return PermissionRepositoryDependency::getRepository();
	}
}