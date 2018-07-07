<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\PreferredUserAuth\UsernameEmailPassword;
use DevPledge\Domain\PreferredUserAuth\PreferredUserAuth;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateUserCommand
 * @package DevPledge\Application\Commands
 */
class CreateUserCommand extends AbstractCommand {
	/**
	 * @var UsernameEmailPassword
	 */
	private $preferredUserAuth;
	/**
	 * @var string
	 */


	/**
	 * CreateUserCommand constructor.
	 *
	 * @param string $username
	 * @param PreferredUserAuth $preferredUserAuth
	 */
	public function __construct( PreferredUserAuth $preferredUserAuth ) {

		$this->preferredUserAuth = $preferredUserAuth;

	}

	/**
	 * @return PreferredUserAuth
	 */
	public function getPreferredUserAuth(): PreferredUserAuth {
		return $this->preferredUserAuth;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string {
		return $this->preferredUserAuth->getUsername();
	}


}