<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Application\Repository\UserRepository;
use DevPledge\Domain\PreferredUserAuth\PreferredUserAuth;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Uuid\Uuid;

/**
 * Class UserService
 * @package DevPledge\Application\Service
 */
class UserService {
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
	 * UserService constructor.
	 *
	 * @param UserRepository $repository
	 * @param UserFactory $factory
	 * @param Cache $cache
	 */
	public function __construct( UserRepository $repository, UserFactory $factory, Cache $cache ) {

		$this->repo    = $repository;
		$this->factory = $factory;
		$this->cache   = $cache;
	}

	/**
	 * @param PreferredUserAuth $preferredUserAuth
	 *
	 * @return \DevPledge\Domain\User
	 * @throws \Exception
	 */
	public function create( PreferredUserAuth $preferredUserAuth ) {
		$uuid        = Uuid::make( 'user' )->toString();
		$userIdArray = [ 'user_id' => $uuid ];
		$data        = array_merge( $userIdArray, $preferredUserAuth->getAuthDataArray()->getArray() );
		$user        = $this->factory->create( $data );

		$createdUser = $this->repo->create( $user );
		if ( $createdUser ) {
			$this->cache->set( $uuid, $createdUser->toMap() )
			            ->set( 'usrn::' . $createdUser->getUsername(), $createdUser->toMap() );
		}

		return $createdUser;
	}

	/**
	 * @param User $user
	 *
	 * @return \DevPledge\Domain\User
	 * @throws \Exception
	 */
	public function update( User $user ) {
		$updatedUser = $this->repo->update( $user );
		if ( $updatedUser ) {
			$this->cache->set( $updatedUser->getId(), $updatedUser->getData() )
			            ->set( 'usrn::' . $updatedUser->getUsername(), $updatedUser->getData() );
		}

		return $updatedUser;
	}

	/**
	 * @param string $username
	 *
	 * @return \DevPledge\Domain\User
	 */
	public function getByUsername( string $username ) {
		return $this->repo->readByUsername( $username );
	}

	/**
	 * @param int $gitHubId
	 *
	 * @return \DevPledge\Domain\User
	 */
	public function getByGitHubId( int $gitHubId ) {
		return $this->repo->readByGitHubId( $gitHubId );
	}

}