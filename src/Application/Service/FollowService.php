<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\FollowFactory;
use DevPledge\Application\Repository\FollowRepository;
use DevPledge\Domain\Follow;
use DevPledge\Domain\Follows;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;
use DevPledge\Integrations\Cache\Cache;

/**
 * Class FollowService
 * @package DevPledge\Application\Service
 */
class FollowService {
	/**
	 * @var  FollowRepository
	 */
	protected $repo;

	/**
	 * @var FollowFactory $factory
	 */
	protected $factory;

	/**
	 * @var UserService
	 */
	protected $userService;
	/**
	 * @var Cache
	 */
	protected $cache;

	/**
	 * FollowService constructor.
	 *
	 * @param FollowRepository $repo
	 * @param FollowFactory $factory
	 * @param UserService $userService
	 * @param Cache $cache
	 */
	public function __construct( FollowRepository $repo, FollowFactory $factory, UserService $userService, Cache $cache ) {
		$this->repo        = $repo;
		$this->factory     = $factory;
		$this->userService = $userService;
		$this->cache       = $cache;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Follow
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Follow {

		$follow = $this->factory->create( $data );

		$follow = $this->repo->createPersist( $follow );

		return $follow;
	}

	/**
	 * followId is user_id|entity_id
	 *
	 * @param string $followId
	 *
	 * @return int|null
	 */
	public function delete( string $followId ): ?int {
		return $this->repo->delete( $followId );
	}

	/**
	 * followId is user_id|entity_id
	 *
	 * @param string $followId
	 *
	 * @return Follow
	 */
	public function read( string $followId ): Follow {
		return $this->repo->read( $followId );
	}

	/**
	 * @param string $userId
	 *
	 * @return Follows
	 * @throws \Exception
	 */
	public function readAll( string $userId ): Follows {
		$follows = $this->repo->readAll( $userId, 'created', true );
		if ( $follows ) {
			$allUserFollows = new Follows( $follows );

			return $allUserFollows;
		}

		return new Follows( [] );

	}

	/**
	 * @param string $userId
	 *
	 * @return Follows
	 * @throws \Exception
	 */
	public function getUserTopics( string $userId ) {
		$follows = $this->repo->readAllWhere( new Wheres( [
			new Where( 'user_id', $userId ),
			new Where( 'entity', 'topic' )
		] ), 'created', true );
		if ( $follows ) {
			$allUserFollows = new Follows( $follows );

			return $allUserFollows;
		}

		return new Follows( [] );
	}

}