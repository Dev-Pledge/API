<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

class UpdateUserPasswordCommand extends AbstractCommand {
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $newPassword;
	/**
	 * @var string
	 */
	protected $oldPassword;

	/**
	 * UpdateUserPasswordCommand constructor.
	 *
	 * @param User $user
	 * @param string $oldPassword
	 * @param string $newPassword
	 */
	public function __construct( User $user, string $oldPassword, string $newPassword ) {
		$this->user        = $user;
		$this->newPassword = $newPassword;
		$this->oldPassword = $oldPassword;

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
	public function getNewPassword(): string {
		return $this->newPassword;
	}

	/**
	 * @return string
	 */
	public function getOldPassword(): string {
		return $this->oldPassword;
	}

}