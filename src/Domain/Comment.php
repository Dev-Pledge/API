<?php

namespace DevPledge\Domain;

/**
 * Class Comment
 * @package DevPledge\Domain
 */
class Comment extends AbstractDomain {

	/**
	 * @var UserDefinedContent
	 */
	protected $comment;
	/**
	 * @var string
	 */
	protected $entityId;
	/**
	 * @var string | null
	 */
	protected $userId;
	/**
	 * @var string | null
	 */
	protected $organisationId;
	/**
	 * @var string | null
	 */
	protected $parentCommentId;
	/**
	 * @var Comments
	 */
	protected $lastFiveReplies;
	/**
	 * @var Count
	 */
	protected $totalReplies;
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var Topics
	 */
	protected $topics;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'comment_id'        => $this->getId(),
			'parent_comment_id' => $this->getParentCommentId(),
			'comment'           => $this->getComment()->getContent(),
			'user_id'           => $this->getUserId(),
			'organisation_id'   => $this->getOrganisationId(),
			'entity_id'         => $this->getEntityId(),
			'modified'          => $this->getModified()->format( 'Y-m-d H:i:s' ),
			'created'           => $this->getCreated()->format( 'Y-m-d H:i:s' )
		];
	}

	function toAPIMap(): \stdClass {
		$data                    = parent::toAPIMap();
		$data->last_five_replies = $this->getLastFiveReplies()->toAPIMapArray();
		$data->total_replies     = $this->getTotalReplies()->getCount();
		$data->comment_type      = $this->getCommentType();
		$data->user              = $this->getUser()->toPublicAPIMap();

		return $data;
	}

	/**
	 * @param UserDefinedContent $comment
	 *
	 * @return Comment
	 */
	public function setComment( UserDefinedContent $comment ): Comment {
		$this->comment = $comment;

		return $this;
	}

	/**
	 * @return UserDefinedContent
	 */
	public function getComment(): UserDefinedContent {
		return isset( $this->comment ) ? $this->comment : new UserDefinedContent( '' );
	}

	/**
	 * @param string $entityId
	 *
	 * @return Comment
	 */
	public function setEntityId( string $entityId ): Comment {
		$this->entityId = $entityId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEntityId(): string {
		return isset( $this->entityId ) ? $this->entityId : $this->getUserId();
	}

	/**
	 * @param null|string $userId
	 *
	 * @return Comment
	 */
	public function setUserId( ?string $userId ): Comment {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getUserId(): ?string {
		return $this->userId;
	}

	/**
	 * @param null|string $organisationId
	 *
	 * @return Comment
	 */
	public function setOrganisationId( ?string $organisationId ): Comment {
		$this->organisationId = $organisationId;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getOrganisationId(): ?string {
		return $this->organisationId;
	}

	/**
	 * @param null|string $parentCommentId
	 *
	 * @return Comment
	 */
	public function setParentCommentId( ?string $parentCommentId ): Comment {
		$this->parentCommentId = $parentCommentId;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getParentCommentId(): ?string {
		return $this->parentCommentId;
	}


	/**
	 * @return Count
	 */
	public function getTotalReplies(): Count {
		return isset( $this->totalReplies ) ? $this->totalReplies : new Count( 0 );
	}

	/**
	 * @param Comments $lastFiveReplies
	 *
	 * @return Comment
	 */
	public function setLastFiveReplies( Comments $lastFiveReplies ): Comment {
		$this->lastFiveReplies = $lastFiveReplies;

		return $this;
	}

	/**
	 * @return Comments
	 * @throws \Exception
	 */
	public function getLastFiveReplies(): Comments {
		return isset( $this->lastFiveReplies ) ? $this->lastFiveReplies : new Comments( [] );
	}

	/**
	 * @param Count $totalReplies
	 *
	 * @return Comment
	 */
	public function setTotalReplies( Count $totalReplies ): Comment {
		$this->totalReplies = $totalReplies;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isStatus(): bool {
		return (bool) ( $this->getUserId() === $this->getEntityId() || $this instanceof StatusComment );
	}

	/**
	 * @return bool
	 */
	public function isReply(): bool {
		return (bool) isset( $this->parentCommentId );
	}

	/**
	 * @return bool
	 */
	public function isCommentOnEntity(): bool {
		return (bool) ( ! $this->isReply() && ! $this->isStatus() && isset( $this->entityId ) );
	}

	/**
	 * @return Topics
	 */
	public function getTopics(): Topics {

		return isset( $this->topics ) ? $this->topics : new Topics( [] );
	}

	/**
	 * @param Topics $topics
	 *
	 * @return Comment
	 */
	public function setTopics( Topics $topics ): Comment {
		$this->topics = $topics;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCommentType(): string {
		if ( $this->isStatus() || $this instanceof StatusComment ) {
			return 'status';
		}
		if ( $this->isReply() ) {
			return 'reply';
		}
		if ( $this->isCommentOnEntity() ) {
			return 'comment_on_entity';
		}

		return 'comment';
	}


	/**
	 * @param User $user
	 *
	 * @return Comment
	 */
	public function setUser( ?User $user ): Comment {
		$this->user = $user;

		return $this;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

}