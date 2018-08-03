<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class UpdateUserCommand
 * @package DevPledge\Application\Commands
 */
class UpdateUserCommand extends AbstractCommand {
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;

	public function __construct( User $user, \stdClass $data ) {
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