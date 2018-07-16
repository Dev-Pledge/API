<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateProblemCommand
 * @package DevPledge\Application\Commands
 */
class CreateProblemCommand extends AbstractCommand {
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * CreateProblemCommand constructor.
	 *
	 * @param \stdClass $data
	 * @param User $user
	 */
	public function __construct( \stdClass $data, User $user ) {
		$this->data = $data;
		$this->user = $user;
	}

	/**
	 * @return \stdClass
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}

}