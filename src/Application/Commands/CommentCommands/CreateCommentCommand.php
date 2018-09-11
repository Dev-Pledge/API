<?php

namespace DevPledge\Application\Commands\CommentCommands;


use DevPledge\Domain\Organisation;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateCommentCommand
 * @package DevPledge\Application\Commands
 */
class CreateCommentCommand extends AbstractCommand {

	/**
	 * @var string
	 */
	protected $entityId;
	/**
	 * @var string
	 */
	protected $comment;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var Organisation|null
	 */
	protected $organisation;

	/**
	 * CreateCommentCommand constructor.
	 *
	 * @param string $entityId
	 * @param string $comment
	 * @param User $user
	 * @param Organisation|null $organisation
	 */
	public function __construct( string $entityId, string $comment, User $user, ?Organisation $organisation =null ) {
		$this->entityId     = $entityId;
		$this->comment      = $comment;
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
	public function getEntityId(): string {
		return $this->entityId;
	}

	/**
	 * @return string
	 */
	public function getComment(): string {
		return $this->comment;
	}

	/**
	 * @return Organisation|null
	 */
	public function getOrganisation(): ?Organisation {
		return $this->organisation;
	}
}