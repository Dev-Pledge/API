<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class UpdateSolutionCommand
 * @package DevPledge\Application\Commands
 */
class UpdateSolutionCommand extends AbstractCommand {
	/**
	 * @var string
	 */
	protected $solutionId;
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;

	public function __construct( string $solutionId, \stdClass $data, User $user ) {
		$this->solutionId = $solutionId;
		$this->data       = $data;
		$this->user       = $user;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return \stdClass
	 */
	public function getData(): \stdClass {
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getSolutionId(): string {
		return $this->solutionId;
	}


}