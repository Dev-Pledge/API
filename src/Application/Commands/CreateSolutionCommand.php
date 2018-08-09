<?php

namespace DevPledge\Application\Commands;



use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateSolutionCommand
 * @package DevPledge\Application\Commands
 */
class CreateSolutionCommand extends AbstractCommand {
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;


	public function __construct( \stdClass $data, User $user ) {
		$this->user = $user;
		$this->data = $data;
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

}