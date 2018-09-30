<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Application\Repository\UserRepository;

use DevPledge\Domain\PreferredUserAuth\PreferredUserAuth;
use DevPledge\Domain\Role\Role;
use DevPledge\Domain\TokenString;
use DevPledge\Domain\User;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Security\JWT\JWT;

/**
 * Class UserService
 * @package DevPledge\Application\Service
 */
class UserService {

	const USERNAME_CACHE_KEY = 'usrn::';
	/**
	 * @var UserRepository $repo
	 */
	protected $repo;
	/**
	 * @var UserFactory $factory
	 */
	private $factory;
	/**
	 * @var Cache
	 */
	private $cache;
	/**
	 * @var Role
	 */
	private $role;
	/**
	 * @var JWT
	 */
	protected $jwt;

	/**
	 * UserService constructor.
	 *
	 * @param UserRepository $repository
	 * @param UserFactory $factory
	 * @param Cache $cache
	 * @param Role $role
	 */
	public function __construct( UserRepository $repository, UserFactory $factory, Cache $cache, Role $role, JWT $jwt ) {

		$this->repo    = $repository;
		$this->factory = $factory;
		$this->cache   = $cache;
		$this->role    = $role;
		$this->jwt     = $jwt;
	}

	/**
	 * @param PreferredUserAuth $preferredUserAuth
	 *
	 * @return \DevPledge\Domain\User
	 * @throws \Exception
	 */
	public function create( PreferredUserAuth $preferredUserAuth ): User {

		$data               = (object) $preferredUserAuth->getAuthDataArray()->getArray();
		$defaultPermissions = $this->role->getDefaultPermissions();
		$user               = $this->factory->create( $data );
		$createdUser        = $this->repo->createPersist( $user );
		$createdUser        = $this->repo->createNewPermissions( $createdUser, $defaultPermissions );
		if ( $createdUser->isPersistedDataFound() ) {
			$rawData = $this->getRawDataFromUser( $createdUser );
			$this->cache->set( $createdUser->getId(), $rawData )
			            ->set( static::USERNAME_CACHE_KEY . $createdUser->getUsername(), $rawData );
		}

		return $createdUser;
	}

	/**
	 * @param User $user
	 * @param \stdClass $data
	 *
	 * @return User
	 * @throws \DevPledge\Application\Factory\FactoryException
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function update( User $user, \stdClass $data ): User {
		$user = $this->factory->update( $user, $data );
		/**
		 * @var $updatedUser User
		 */
		$updatedUser = $this->repo->update( $user );
		$updatedUser = $this->repo->readAppendExistingPermissions( $updatedUser );
		if ( $updatedUser->isPersistedDataFound() ) {
			$rawData = $this->getRawDataFromUser( $updatedUser );
			$this->cache->set( $updatedUser->getId(), $rawData )
			            ->set( static::USERNAME_CACHE_KEY . $updatedUser->getUsername(), $rawData );
		}

		return $updatedUser;
	}

	protected function getRawDataFromUser( User $user ) {
		$rawData              = $user->toPersistMap();
		$rawData->permissions = $user->getPermissions()->toPersistMapArray();

		return $rawData;
	}

	/**
	 * @param string $userId
	 *
	 * @return int|null
	 */
	public function delete( string $userId ): ?int {
		return $this->repo->delete( $userId );
	}

	/**
	 * @param string $username
	 *
	 * @return \DevPledge\Domain\User
	 */
	public function getByUsername( string $username ): User {
		return $this->repo->readByUsername( $username );
	}

	/**
	 * @param int $gitHubId
	 *
	 * @return \DevPledge\Domain\User
	 */
	public function getByGitHubId( int $gitHubId ): User {
		return $this->repo->readByGitHubId( $gitHubId );
	}

	/**
	 * @param string $userId
	 *
	 * @return \DevPledge\Domain\User
	 */
	public function getByUserId( string $userId ): User {
		return $this->repo->read( $userId );
	}

	/**
	 * @param string $userId
	 *
	 * @return User
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function getUserFromCache( string $userId ): User {
		return $this->factory->create( $this->cache->get( $userId ) );
	}

	/**
	 * @param string $username
	 *
	 * @return User
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function getUserFromUsernameCache( string $username ): User {
		return $this->factory->create( $this->cache->get( static::USERNAME_CACHE_KEY . $username ) );
	}

	/**
	 * @return UserFactory
	 */
	public function getFactory() {
		return $this->factory;
	}

	/**
	 * @param User $user
	 *
	 * @return TokenString
	 */
	public function getNewTokenStringFromUser( User $user ) {
		return new TokenString( $user, $this->jwt );
	}


}