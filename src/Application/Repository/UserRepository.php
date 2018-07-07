<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 13/06/2018
 * Time: 13:49
 */

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Application\Mapper\Mapper;
use DevPledge\Domain\User;
use DevPledge\Framework\Adapter\Adapter;
use TomWright\Database\ExtendedPDO\Query;

class UserRepository {
	/**
	 * @var Adapter
	 */
	private $adapter;

	/**
	 * @var Mapper
	 */
	private $mapper;

	/**
	 * @var OrganisationFactory
	 */
	private $factory;

	/**
	 * UserRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param Mapper $mapper
	 * @param UserFactory $factory
	 */
	public function __construct( Adapter $adapter, Mapper $mapper, UserFactory $factory ) {
		$this->adapter = $adapter;
		$this->mapper  = $mapper;
		$this->factory = $factory;
	}

	/**
	 * @param User $user
	 *
	 * @return User
	 * @throws \Exception
	 */
	public function create( User $user ): User {
		$user->setModified( new \DateTime() );
		$data = $this->mapper->toMap( $user );
		$this->adapter->create( 'users', $data );

		return $this->read( $user->getId()->toString() );
	}

	/**
	 * @param User $user
	 *
	 * @return User
	 * @throws \Exception
	 */
	public function update( User $user ): User {
		$user->setModified( new \DateTime() );
		$data = $this->mapper->toMap( $user );
		$id   = $this->adapter->update( 'users', $user->getId(), $data, 'user_id' );

		return $this->read( $id );
	}

	/**
	 * @param string $id
	 *
	 * @return User
	 */
	public function read( string $id ): User {
		$data = $this->adapter->read( 'users', $id, 'user_id' );

		return $this->factory->create( $data );
	}

	/**
	 * @param string $username
	 *
	 * @return User
	 */
	public function readByUsername( string $username ): User {
		$data = $this->adapter->read( 'users', $username, 'username' );

		return $this->factory->create( $data );
	}

	/**
	 * @param int $gitHubId
	 *
	 * @return User
	 */
	public function readByGitHubId( int $gitHubId ): User {
		$data = $this->adapter->read( 'users', $gitHubId, 'github_id' );

		return $this->factory->create( $data );
	}

	/**
	 * @param array $filters
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function readAll( array $filters ): array {

//		$query = new Query();
//		$query->
		/**
		 * TODO add filters into Query
		 */
		return $this->adapter->readAll( 'user' );


	}
}