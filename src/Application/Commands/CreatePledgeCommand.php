<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreatePledgeCommand
 * @package DevPledge\Application\Commands
 */
class CreatePledgeCommand extends AbstractCommand {
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $problemId;

	/**
	 * CreatePledgeCommand constructor.
	 *
	 * @param string $problemId
	 * @param \stdClass $data
	 * @param User $user
	 */
	public function __construct( string $problemId, \stdClass $data, User $user ) {
		$this->user      = $user;
		$this->data      = $data;
		$this->problemId = $problemId;
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
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getProblemId(): string {
		return $this->problemId;
	}

}