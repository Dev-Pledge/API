<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

class DeleteFollowCommand extends AbstractCommand {

	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $entityId;

	/**
	 * CreateFollowCommand constructor.
	 *
	 * @param User $user
	 * @param string $entityId
	 */
	public function __construct( User $user, string $entityId ) {
		$this->user     = $user;
		$this->entityId = $entityId;
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

}