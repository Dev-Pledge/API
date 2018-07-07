<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Application\Repository\UserRepository;
use DevPledge\Domain\PreferredUserAuth\PreferredUserAuth;
use DevPledge\Uuid\Uuid;
use Predis\Client;

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
	 * @var Client
	 */
	private $cacheClient;

	/**
	 * UserService constructor.
	 *
	 * @param UserRepository $repository
	 * @param UserFactory $factory
	 * @param Client $cacheClient
	 */
	public function __construct( UserRepository $repository, UserFactory $factory, Client $cacheClient ) {

		$this->repo        = $repository;
		$this->factory     = $factory;
		$this->cacheClient = $cacheClient;
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
			$this->cacheClient->set( $uuid, json_encode( $createdUser->getData() ) );
			$this->cacheClient->set( 'usrn::' . $createdUser->getUsername(), json_encode( $createdUser->getData() ) );
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
			$this->cacheClient->set( $updatedUser->getId(), $updatedUser->getData() );
			$this->cacheClient->set( 'usrn::' . $updatedUser->getUsername(), json_encode( $updatedUser->getData() ) );
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