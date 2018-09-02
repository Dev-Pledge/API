<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Factory\CommentFactory;
use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Application\Repository\CommentRepository;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Comment;
use DevPledge\Domain\Comments;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;
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
	protected $cacheService;
	/**
	 * @var EntityService
	 */
	protected $entityService;

	/**
	 * CommentService constructor.
	 *
	 * @param CommentRepository $repo
	 * @param CommentFactory $factory
	 * @param Cache $cacheService
	 * @param EntityService $entityService
	 */
	public function __construct( CommentRepository $repo, CommentFactory $factory, Cache $cacheService, EntityService $entityService ) {
		$this->repo          = $repo;
		$this->factory       = $factory;
		$this->cacheService  = $cacheService;
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
		$comment = $this->read( $commentId );
		$deleted = $this->repo->delete( $commentId );
		if ( $deleted ) {
			Dispatch::event( new DeletedDomainEvent( $comment, $comment->getEntityId() ) );
		}

		return $deleted;
	}

	/**
	 * @param string $entityId
	 *
	 * @return Comments
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function readAll( string $entityId ): Comments {

		$key                    = 'all-cmt:' . $entityId;
		$allCacheEntityComments = $this->cacheService->get( $key );

		if ( $allCacheEntityComments ) {
			return unserialize( $allCacheEntityComments );
		}
		$comments = $this->repo->readAll( $entityId, 'created' );

		if ( $comments ) {
			$allEntityComments = new Comments( $comments );
			$this->cacheService->setEx( $key, serialize( $allEntityComments ), 30 );

			return $allEntityComments;
		}

		return new Comments( [] );

	}

	/**
	 * @param string $commentId
	 *
	 * @return Comments
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function readAllFromParentComment( string $commentId ): Comments {

		$key                    = 'all-cmt:' . $commentId;
		$allCacheEntityComments = $this->cacheService->get( $key );

		if ( $allCacheEntityComments ) {
			return unserialize( $allCacheEntityComments );
		}
		$comments = $this->repo->readAllWhere(
			new Wheres( [ new Where( 'parent_comment_id', $commentId ) ] ),
			'created'
		);

		if ( $comments ) {
			$allEntityComments = new Comments( $comments );
			$this->cacheService->setEx( $key, serialize( $allEntityComments ), 30 );

			return $allEntityComments;
		}

		return new Comments( [] );

	}


}