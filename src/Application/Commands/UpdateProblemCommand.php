<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class UpdateProblemCommand
 * @package DevPledge\Application\Commands
 * @throws CommandPermissionException
 */
class UpdateProblemCommand extends AbstractCommand {
	/**
	 * @var string
	 */
	protected $problemId;
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * UpdateProblemCommand constructor.
	 *
	 * @param string $problemId
	 * @param \stdClass $data
	 * @param User $user
	 * @throws CommandPermissionException
	 */
	public function __construct( string $problemId, \stdClass $data, User $user ) {
		$this->problemId = $problemId;
		$this->data      = $data;
		$this->user      = $user;

	}

	/**
	 * @return string
	 */
	public function getProblemId(): string {
		return $this->problemId;
	}

	/**
	 * @return \stdClass
	 */
	public function getData(): \stdClass {
		return $this->data;
	}

	/**
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}
}