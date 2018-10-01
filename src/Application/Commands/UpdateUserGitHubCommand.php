<?php

namespace DevPledge\Application\Commands;


use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class UpdateUserGitHubCommand
 * @package DevPledge\Application\Commands
 */
class UpdateUserGitHubCommand extends AbstractCommand {
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $code;
	/**
	 * @var string
	 */
	protected $state;

	/**
	 * UpdateUserGitHubCommand constructor.
	 *
	 * @param User $user
	 * @param string $code
	 * @param string $state
	 */
	public function __construct( User $user, string $code, string $state ) {
		$this->user  = $user;
		$this->code  = $code;
		$this->state = $state;
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
	public function getCode(): string {
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getState(): string {
		return $this->state;
	}


}