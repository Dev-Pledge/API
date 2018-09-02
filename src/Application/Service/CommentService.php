<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Factory\CommentFactory;
use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Application\Repository\CommentRepository;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Comment;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Command\Dispatch;

/**
 * Class CommentService
 * @package DevPledge\Application\Service
 */
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
	 * @var EntityService
	 */
	protected $entityService;

	/**
	 * CommentService constructor.
	 *
	 * @param CommentRepository $repo
	 * @param CommentFactory $factory
	 * @param Cache $cache
	 * @param EntityService $entityService
	 */
	public function __construct( CommentRepository $repo, CommentFactory $factory, Cache $cache, EntityService $entityService ) {
		$this->repo          = $repo;
		$this->factory       = $factory;
		$this->cache         = $cache;
		$this->entityService = $entityService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Comment
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Comment {
		/**
		 * @var $comment Comment
		 */
		$comment = $this->factory->create( $data );

		$comment = $this->repo->createPersist( $comment );
		if ( $comment->isPersistedDataFound() ) {

			Dispatch::event( new CreatedDomainEvent( $comment, $comment->getEntityId() ) );
		}

		return $comment;
	}

	/**
	 * @param Comment $comment
	 *
	 * @return AbstractDomain | null
	 */
	public function getCommentEntity( Comment $comment ): ?AbstractDomain {
		$domain = $this->entityService->read( $comment->getEntityId(), [ 'user', 'pledge', 'solution', 'comment' ] );

		if ( $domain instanceof AbstractDomain ) {
			return $domain;
		}

		return null;
	}

	/**
	 * @param Comment $comment
	 * @param \stdClass $rawUpdateData
	 *
	 * @return Comment
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( Comment $comment, \stdClass $rawUpdateData ): Comment {
		$comment = $this->factory->update( $comment, $rawUpdateData );

		$comment = $this->repo->update( $comment );

		Dispatch::event( new UpdatedDomainEvent( $comment, $comment->getEntityId() ) );

		return $comment;
	}

	/**
	 * @param string $commentId
	 *
	 * @return Comment
	 */
	public function read( string $commentId ): Comment {
		return $this->repo->read( $commentId );
	}

	/**
	 * @param string $commentId
	 *
	 * @return int|null
	 */
	public function delete( string $commentId ): ?int {
		$comment  = $this->read( $commentId );
		$deleted = $this->repo->delete( $commentId );
		if ( $deleted ) {
			Dispatch::event( new DeletedDomainEvent( $comment , $comment->getEntityId()) );
		}

		return $deleted;
	}



}