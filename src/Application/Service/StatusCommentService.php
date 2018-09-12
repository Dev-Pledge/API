<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Events\CreatedCommentEvent;
use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Events\DeletedDomainEvent;
use DevPledge\Application\Events\UpdatedDomainEvent;
use DevPledge\Application\Factory\CommentFactory;
use DevPledge\Application\Factory\StatusCommentFactory;
use DevPledge\Application\Repository\CommentRepository;
use DevPledge\Application\Repository\StatusCommentRepository;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Comment;
use DevPledge\Domain\Comments;
use DevPledge\Domain\StatusComment;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\WhereNull;
use DevPledge\Framework\Adapter\Wheres;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Command\Dispatch;

/**
 * Class CommentService
 * @package DevPledge\Application\Service
 */
class StatusCommentService {
	/**
	 * @var StatusCommentRepository
	 */
	protected $repo;
	/**
	 * @var StatusCommentFactory
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
	 * @param StatusCommentRepository $repo
	 * @param StatusCommentFactory $factory
	 * @param Cache $cacheService
	 * @param EntityService $entityService
	 */
	public function __construct( StatusCommentRepository $repo, StatusCommentFactory $factory, Cache $cacheService, EntityService $entityService ) {
		$this->repo          = $repo;
		$this->factory       = $factory;
		$this->cacheService  = $cacheService;
		$this->entityService = $entityService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return StatusComment
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): StatusComment {
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
		$domain = $this->entityService->read( $comment->getEntityId(), [
			'user',
			'pledge',
			'solution',
			'problem',
			'comment',
			'status'
		] );

		if ( $domain instanceof AbstractDomain ) {
			return $domain;
		}

		return null;
	}

	/**
	 * @param StatusComment $comment
	 * @param \stdClass $rawUpdateData
	 *
	 * @return StatusComment
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( StatusComment $comment, \stdClass $rawUpdateData ): StatusComment {
		$comment = $this->factory->update( $comment, $rawUpdateData );

		$comment = $this->repo->update( $comment );

		Dispatch::event( new UpdatedDomainEvent( $comment, $comment->getEntityId() ) );

		return $comment;
	}

	/**
	 * @param string $commentId
	 *
	 * @return StatusComment
	 */
	public function read( string $commentId ): StatusComment {
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
	 * @param $userId
	 *
	 * @return Comments
	 * @throws \Exception
	 */
	public function getUserStatuses( $userId ): Comments {
		/**
		 * @var $comments Comment[]
		 */
		$comments = $this->repo->readAllWhere( new Wheres( [
			new Where( 'user_id', $userId ),
			new Where( 'entity_id', $userId ),
			new WhereNull( 'parent_comment_id' )
		] ), 'created', true );
		$statuses = [];
		if ( $comments ) {
			foreach ( $comments as $comment ) {
				if ( $comment->isStatus() ) {
					$statuses[] = $comment;
				}
			}
		}

		return new Comments( $statuses );

	}


}