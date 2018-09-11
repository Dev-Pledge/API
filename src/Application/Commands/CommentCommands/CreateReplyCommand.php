<?php

namespace DevPledge\Application\Commands\CommentCommands;


use DevPledge\Domain\Organisation;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateReplyCommand
 * @package DevPledge\Application\Commands
 */
class CreateReplyCommand extends AbstractCommand {

	/**
	 * @var string
	 */
	protected $commentId;
	/**
	 * @var string
	 */
	protected $replyComment;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var Organisation|null
	 */
	protected $organisation;

	/**
	 * CreateReplyCommand constructor.
	 *
	 * @param string $commentId
	 * @param string $replyComment
	 * @param User $user
	 * @param Organisation|null $organisation
	 */
	public function __construct( string $commentId, string $replyComment, User $user, ?Organisation $organisation = null ) {
		$this->commentId    = $commentId;
		$this->replyComment = $replyComment;
		$this->user         = $user;
		$this->organisation = $organisation;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getReplyComment(): string {
		return $this->replyComment;
	}

	/**
	 * @return string
	 */
	public function getCommentId(): string {
		return $this->commentId;
	}

	/**
	 * @return Organisation|null
	 */
	public function getOrganisation(): ?Organisation {
		return $this->organisation;
	}
}