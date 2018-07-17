<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 13/06/2018
 * Time: 13:49
 */

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Domain\User;
use DevPledge\Framework\Adapter\Adapter;
use TomWright\Database\ExtendedPDO\Query;

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
}