<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\CommentFactory;
use DevPledge\Application\Repository\CommentRepository;
use DevPledge\Domain\Comment;
use DevPledge\Integrations\Cache\Cache;

class CommentService {
	/**
	 * @var CommentRepository
	 */
	protected $repo;
	/**
	 * @var CommentFactory
	 */
	protected $factory;
	/**
	 * @var Cache
	 */
	protected $cache;

	/**
	 * CommentService constructor.
	 *
	 * @param CommentRepository $repo
	 * @param CommentFactory $factory
	 * @param Cache $cache
	 */
	public function __construct( CommentRepository $repo, CommentFactory $factory, Cache $cache ) {
		$this->repo    = $repo;
		$this->factory = $factory;
		$this->cache   = $cache;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Comment
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Comment {

		$comment = $this->factory->create( $data );

		$comment = $this->repo->createPersist( $comment );

		return $comment;
	}

}