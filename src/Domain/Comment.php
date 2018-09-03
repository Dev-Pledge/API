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
	protected $replies;

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
		return $this->comment;
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
		return $this->entityId;
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
	 * @param Comments $replies
	 *
	 * @return Comment
	 */
	public function setReplies( Comments $replies ): Comment {
		$this->replies = $replies;

		return $this;
	}

	/**
	 * @return Comments
	 */
	public function getReplies(): Comments {
		return $this->replies;
	}

}