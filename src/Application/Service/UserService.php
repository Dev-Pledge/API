<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\UserFactory;
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

	public function __construct( UserRepository $repository, UserFactory $factory ) {

		$this->repo    = $repository;
		$this->factory = $factory;
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

		$user = $this->factory->create( $data );

		return $this->repo->create( $user );
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