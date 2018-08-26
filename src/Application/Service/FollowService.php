<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\FollowFactory;
use DevPledge\Application\Repository\FollowRepository;
use DevPledge\Domain\Follow;

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
	 * FollowService constructor.
	 *
	 * @param FollowRepository $repo
	 * @param FollowFactory $factory
	 */
	public function __construct(FollowRepository $repo, FollowFactory $factory) {
		$this->repo = $repo;
		$this->factory = $factory;
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
	 * @param string $followId
	 *
	 * @return int|null
	 */
	public function delete( string $followId ): ?int {
		return $this->repo->delete( $followId );
	}

	/**
	 * followId is user_id|entity_id
	 * @param string $followId
	 *
	 * @return Follow
	 */
	public function read( string $followId ): Follow {
		return $this->repo->read( $followId );
	}

}